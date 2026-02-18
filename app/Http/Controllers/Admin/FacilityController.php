<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ManageFileTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class FacilityController extends BaseController
{
    use ManageFileTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $facilities = Facility::latest()->get();
            return response()->json(['data' => $facilities]);
        }
        return view('admin.facilities.index');
    }

    public function show(Facility $facility)
    {
        return response()->json($facility);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // 10MB
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);

            if ($request->hasFile('image')) {
                $data['image'] = $this->storeFile($request->file('image'), 'facilities');
            }

            Facility::create($data);
            DB::commit();

            return redirect()->back()->with('swal-success', 'Fasilitas berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $this->updateFile($request->file('image'), 'facilities', $facility->image);
            }
            $facility->update($data);
            return redirect()->back()->with('swal-success', 'Fasilitas diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('swal-error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function destroy(Facility $facility)
    {
        try {
            if ($facility->image) {
                $this->deleteFile($facility->image);
            }
            $facility->delete();
            return response()->json(['success' => 'Fasilitas dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
