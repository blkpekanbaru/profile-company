<?php

namespace App\Http\Controllers\Public;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    public function about()
    {
        $profiles = Profile::all()->keyBy('key');

        return view('pages.profile', compact('profiles'));
    }
}
