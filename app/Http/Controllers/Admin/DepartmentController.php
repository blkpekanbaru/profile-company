<?php

namespace App\Http\Controllers\Admin;

use App\Models\Workshop;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ManageFileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\BaseController;

class DepartmentController extends BaseController
{
    use ManageFileTrait;

    public function index(Request $request)
    {
        $departments = Department::orderBy('name', 'asc')->get();

        if ($request->ajax()) {
            return response()->json([
                'data' => $departments
            ]);
        }
        return view('admin.departments.index', compact('departments'));
    }

    public function show(Request $request, Department $department)
    {
        if ($request->ajax()) {
            $workshops = Workshop::where('department_id', $department->id)->latest()->get();
            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $workshops->count(),
                'recordsFiltered' => $workshops->count(),
                'data' => $workshops
            ]);
        }

        return view('admin.departments.show', compact('department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',

        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            $data['total_workshops'] = 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->storeFile($request->file('image'), 'deparments');
            }

            Department::create($data);
            DB::commit();

            return redirect()->route('admin.department.index')->with('swal-success', 'Data Kejuruan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollback();

            if (isset($data['image'])) {
                $this->deleteFile($data['image']);
            }

            return redirect()->back()->withInput()->with('swal-error', 'Gagal Menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(Department $department)
    {
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'sometimes|nullable|string|max:1000',
            'status' => 'required|in:0,1',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'description', 'status']);
            $data['slug'] = Str::slug($request->name);

            if ($request->hasFile('image')) {
                if ($department->image) {
                    $this->deleteFile($department->image);
                }
                $data['image'] = $this->storeFile($request->file('image'), 'departments');
            }

            $department->update($data);
            DB::commit();

            return redirect()->route('admin.department.index')->with('swal-success', 'Kejuruan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('swal-error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Department $department)
    {
        DB::beginTransaction();
        try {
            $imagePath = $department->image;
            $department->delete();

            if ($imagePath) {
                $this->deleteFile($imagePath);
            }

            DB::commit();

            return redirect()->route('admin.department.index')->with('swal-success', 'Data Kejuruan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('swal-error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
