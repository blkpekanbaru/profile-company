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
        $profile = Profile::where('key', $key)->first() ?? new Profile(['key' => $key]);

        $titles = [
            'history' => 'Sejarah & Transformasi',
            'vision_mission' => 'Visi dan Misi',
            'structure' => 'Struktur Organisasi',
            'main_task' => 'Tugas Pokok',
            'functions' => 'Fungsi',
            'registration_guide' => 'Tata Cara Pendaftaran',
        ];

        $pageTitle = $titles[$key] ?? 'Profil Konten';

        return view('admin.profiles.edit', compact('profile', 'key', 'pageTitle'));
    }

    public function update(Request $request, $key)
    {
        $mediaValidation = $key === 'registration_guide'
            ? 'nullable|file|mimes:mp4,webm,jpeg,png,jpg|max:51200'
            : 'nullable|image|mimes:jpeg,png,jpg|max:5120';

        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
            'image' => $mediaValidation,
        ]);

        DB::beginTransaction();
        try {
            $profile = Profile::where('key', $key)->first();

            $data = [
                'title' => $request->title,
                'content' => $request->input('content'),
            ];

            if ($request->hasFile('image')) {
                if ($profile && $profile->image) {
                    $data['image'] = $this->updateFile($request->file('image'), 'profiles', $profile->image);
                } else {
                    $data['image'] = $this->storeFile($request->file('image'), 'profiles');
                }
            }

            Profile::updateOrCreate(['key' => $key], $data);

            DB::commit();
            return redirect()->back()->with('swal-success', 'Konten ' . $request->title . ' berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }
}
