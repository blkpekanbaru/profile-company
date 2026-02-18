<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\PostStatusEnum;
use App\Enums\PostCategoryEnum;
use App\Traits\ManageFileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;

class PostController extends BaseController
{
    use ManageFileTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::with(['categories', 'images'])->latest()->get();
            return response()->json(['data' => $posts]);
        }
        return view('admin.posts.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories' => 'required|array',
            'images.*' => 'image|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . time(),
                'content' => $request->input('content'),
                'status' => PostStatusEnum::PUBLISHED,
            ]);

            foreach ($request->categories as $cat) {
                $post->categories()->create(['category' => $cat]);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $this->storeFile($file, 'posts');
                    $post->images()->create(['path' => $path]);
                }
            }

            DB::commit();
            return redirect()->back()->with('swal-success', 'Berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', $e->getMessage());
        }
    }

    public function show($slug)
    {
        $information = Post::with(['images', 'categories'])->where('slug', $slug)->firstOrFail();

        return response()->json($information);
    }

    public function detail(Post $post)
    {
        return view('admin.posts.detail', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        DB::beginTransaction();
        try {
            // 1. Update data dasar
            $post->update([
                'title' => $request->title,
                'content' => $request->input('content'),
                'status' => $request->status, // Pastikan status ikut terupdate
            ]);

            // 2. Hapus gambar yang dicentang
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = $post->images()->find($imageId);
                    if ($image) {
                        if (Storage::disk('public')->exists($image->path)) {
                            Storage::disk('public')->delete($image->path);
                        }
                        $image->delete();
                    }
                }
            }

            // 3. Tambah gambar baru jika ada
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $this->storeFile($file, 'posts');
                    $post->images()->create(['path' => $path]);
                }
            }

            // 4. Update Kategori
            $post->categories()->delete();
            if ($request->categories) {
                foreach ($request->categories as $cat) {
                    $post->categories()->create(['category' => $cat]);
                }
            }

            DB::commit();
            return redirect()->back()->with('swal-success', 'Berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', $e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        try {
            foreach ($post->images as $img) {
                $this->deleteFile($img->path);
            }

            $post->delete();

            return response()->json(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
