<?php

namespace App\Http\Controllers;

use App\Models\HonorableMention;
use App\Models\KarismatifProfile;
use App\Models\News;
use App\Models\Event;
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
            'contactPeople'
        ])->latest()->first();

        // ambil News yang sudah di publish
        $news = News::where('isPublished', true)->latest()->take(6)->get();

        // ambil honorable mentions
        $mentions = HonorableMention::latest()->get();
        
        // ambil events
        $events = Event::orderBy('event_date')->get();

        // kirim data ke view
        // === KODE BARU: Tambahkan 'events' ke dalam array compact() ===
        return view('home', compact('currentCabinet', 'mentions', 'news', 'events'));
    }
}