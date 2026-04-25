<?php

namespace App\Http\Controllers;

use App\Models\honorable_mention;
use App\Models\KarismatifProfile;
use App\Models\news;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // ambil profile kabinet paling baru
        $currentCabinet = KarismatifProfile::with([
            'missions',
            'responsiblePeople',
            'programKerja',
            'contactPerson'
        ])->latest()->first();

        // ambil News yang sudah di publish
        $news = news::where('isPublished', true)->latest()->take(6)->get();

        // ambil honorable mentions
        $mentions = honorable_mention::latest()->get();

        // kirim data ke view
        return view('home', compact('currentCabinet', 'mentions', 'news'));
    }
}
