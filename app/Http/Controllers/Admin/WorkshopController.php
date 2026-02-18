<?php

namespace App\Http\Controllers\Admin;

use App\Models\Workshop;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ManageFileTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class WorkshopController extends BaseController
{
    use ManageFileTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $workshops = Workshop::with('department')->latest()->get();
            return response()->json([
                'data' => $workshops
            ]);
        }

        $departments = Department::where('status', 1)->get();
        return view('admin.workshops.index', compact('departments'));
    }

    public function show(Workshop $workshop)
    {
        $workshop->load('department');
        return view('admin.workshops.show', compact('workshop'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'external_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        DB::beginTransaction();
        try {
            $workshop = new Workshop();
            $workshop->name = $request->name;
            $workshop->department_id = $request->department_id;
            $workshop->external_link = $request->external_link;
            $workshop->slug = Str::slug($request->name);
            $workshop->status = 1;

            if ($request->hasFile('image')) {
                $workshop->image = $this->storeFile($request->file('image'), 'workshops');
            }

            $workshop->save();

            Department::find($request->department_id)->increment('total_workshops');

            DB::commit();
            return redirect()->back()->with('swal-success', 'Program Pelatihan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('swal-error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit(Workshop $workshop)
    {
        return response()->json($workshop);
    }

    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'external_link' => 'required|url',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        DB::beginTransaction();
        try {
            $oldDepartmentId = $workshop->getOriginal('department_id');
            $newDepartmentId = (int) $request->department_id;

            $workshop->name = $request->name;
            $workshop->department_id = $request->department_id;
            $workshop->external_link = $request->external_link;
            $workshop->slug = Str::slug($request->name);
            $workshop->status = 1;

            if ($request->hasFile('image')) {
                $workshop->image = $this->updateFile($request->file('image'), 'workshops', $workshop->image);
            }

            $workshop->save();

            if ($oldDepartmentId !== $newDepartmentId) {
                Department::where('id', $oldDepartmentId)->decrement('total_workshops');

                Department::where('id', $newDepartmentId)->increment('total_workshops');
            }
            DB::commit();
            return redirect()->back()->with('swal-success', 'Program Pelatihan berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('swal-error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Workshop $workshop)
    {
        DB::beginTransaction();
        try {
            $deparmentId = $workshop->department_id;
            $imagePath = $workshop->image;

            $workshop->delete();

            if ($imagePath) {
                $this->deleteFile($imagePath);
            }

            Department::find($deparmentId)->decrement('total_workshops');
            DB::commit();
            return redirect()->back()->with('swal-success', 'Program Pelatihan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal-error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
