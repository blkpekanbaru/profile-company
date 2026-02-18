<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class FaqController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = Faq::orderBy('sort_order', 'asc')->get();
            return response()->json(['data' => $faqs]);
        }
        return view('admin.faqs.index');
    }

    public function show(Faq $faq)
    {
        return response()->json($faq);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();

            Faq::create($data);

            DB::commit();
            return redirect()->back()->with('swal-success', 'FAQ berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', 'Gagal menambahkan FAQ: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();

            $faq->update($data);

            DB::commit();
            return redirect()->back()->with('swal-success', 'FAQ berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('swal-error', 'Gagal memperbarui FAQ: ' . $e->getMessage());
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();
            return response()->json(['success' => 'FAQ berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus: ' . $e->getMessage()], 500);
        }
    }

    
}
