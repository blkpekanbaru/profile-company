<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Traits\ManageFileTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class ProfileController extends BaseController
{
    use ManageFileTrait;

    public function edit($key)
    {
        // Mencari data atau membuat instance baru jika belum ada
        $profile = Profile::where('key', $key)->first() ?? new Profile(['key' => $key]);

        // Mapping title agar dinamis di view
        $titles = [
            'history' => 'Sejarah & Transformasi',
            'vision_mission' => 'Visi dan Misi',
            'structure' => 'Struktur Organisasi',
            'main_task' => 'Tugas Pokok',
            'functions' => 'Fungsi',
        ];

        $pageTitle = $titles[$key] ?? 'Profil Konten';

        return view('admin.profiles.edit', compact('profile', 'key', 'pageTitle'));
    }

    public function update(Request $request, $key)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        DB::beginTransaction();
        try {
            $profile = Profile::where('key', $key)->first();

            $data = [
                'title' => $request->title,
                'content' => $request->input('content'),
            ];

            // Jika ada upload gambar (khusus struktur organisasi)
            if ($request->hasFile('image')) {
                if ($profile && $profile->image) {
                    $data['image'] = $this->updateFile($request->file('image'), 'profiles', $profile->image);
                } else {
                    $data['image'] = $this->storeFile($request->file('image'), 'profiles');
                }
            }

            // Simpan atau Update
            Profile::updateOrCreate(['key' => $key], $data);

            DB::commit();
            return redirect()->back()->with('swal-success', 'Konten ' . $request->title . ' berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }
}
