<?php

namespace App\Http\Controllers\Public;

use App\Enums\PostCategoryEnum;
use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Facility;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Workshop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $totalDepartments = Department::where('status', 1)->count();
        $totalWorkshops = Workshop::where('status', 1)->count();

        $departments = Department::where('status', '1')->orderBy('name', 'asc')->get();

        $posts = Post::with(['images', 'categories'])
            ->where('status', PostStatusEnum::PUBLISHED)
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact('totalDepartments', 'totalWorkshops', 'departments', 'posts'));
    }

    public function about()
    {
        $profiles = Profile::all()->keyBy('key');

        $history = isset($profiles['history']) ? json_decode($profiles['history']->content) : [];

        $vmData = $profiles['vision_mission'] ?? null;
        $visi = '';
        $misiPoin = [];

        if ($vmData) {
            // Ambil teks di dalam tag <p> pertama sebagai Visi
            preg_match('/<p>(.*?)<\/p>/', $vmData->content, $matchVisi);
            $visi = $matchVisi[1] ?? '';

            // Ambil semua item <li> sebagai poin Misi
            preg_match_all('/<li>(.*?)<\/li>/', $vmData->content, $matchesMisi);
            $misiPoin = $matchesMisi[1] ?? [];
        }

        return view('pages.profile', compact('profiles', 'history', 'visi', 'misiPoin'));
    }

    public function showDepartment($slug)
    {
        $department = Department::with([
            'workshops' => function ($query) {
                $query->where('status', 1);
            }
        ])->where('slug', $slug)->firstOrFail();

        return view('pages.department_detail', compact('department'));
    }

    public function facilities()
    {
        $facilities = Facility::where('status', 1)->get();
        return view('pages.facilities', compact('facilities'));
    }

    public function registrationGuide()
    {
        return view('pages.registration_guide');
    }

    public function maklumat()
    {
        return view('pages.services.maklumat');
    }

    public function standar()
    {
        return view('pages.services.standar');
    }

    public function surveySatisfaction()
    {
        return view('pages.services.survey_satisfaction', [
            'title' => 'Survei Kepuasan Masyarakat',
            'form_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSfBWTKFX0pl4GzoSDt8cLijWNKGbtzMLzjCz3dq7hFGySwHNQ/viewform?embedded=true'
        ]);
    }

    public function complaint()
    {
        return view('pages.services.complaint', [
            'title' => 'Pelayanan dan Pengaduan Masyarakat',
            'form_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSdHJxZVnCJ4k3sR2FtIWHVGiSkdcappYWMjWXX3BFm_U_1AyA/viewform?embedded=true'
        ]);
    }

    public function surveyAlumni()
    {
        return view('pages.services.survey_alumni', [
            'title' => 'Survei Alumni Pelatihan',
            'form_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSdKX-0LEmgI8_KBQAbm_rXhKAFvYUBdp_WO3YIcWCQT2c5Nbw/viewform?embedded=true'
        ]);
    }

    public function news()
    {
        $posts = Post::with(['images', 'categories'])
            ->where('status', PostStatusEnum::PUBLISHED)
            ->whereHas('categories', function ($q) {
                $q->where('category', PostCategoryEnum::NEWS);
            })
            ->latest()
            ->paginate(9);

        $pageTitle = "Berita Terbaru";
        return view('pages.posts.index', compact('posts', 'pageTitle'));
    }

    public function trainingInfo()
    {
        $posts = Post::with(['images', 'categories'])
            ->where('status', PostStatusEnum::PUBLISHED)
            ->whereHas('categories', function ($q) {
                $q->where('category', PostCategoryEnum::TRAINING);
            })
            ->latest()
            ->paginate(9);

        $pageTitle = "Informasi Pelatihan";
        return view('pages.posts.index', compact('posts', 'pageTitle'));
    }

    public function postDetail(Post $post)
    {
        if ($post->status !== PostStatusEnum::PUBLISHED) {
            abort(404);
        }

        $relatedPosts = Post::with(['images'])
            ->where('status', PostStatusEnum::PUBLISHED)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.posts.show', compact('post', 'relatedPosts'));
    }

    public function faq()
    {
        // dd('hi');
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $pageTitle = "Pertanyaan Umum (FAQ)";

        return view('pages.faq', compact('faqs', 'pageTitle'));
    }
}
