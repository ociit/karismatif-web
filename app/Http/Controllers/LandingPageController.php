<?php

namespace App\Http\Controllers;

use App\Models\honorable_mention;
use App\Models\KarismatifProfile;
use App\Models\news;
use Illuminate\Http\Request;
// === KODE BARU START: Import Facade Storage untuk membaca JSON ===
use Illuminate\Support\Facades\Storage;
// === KODE BARU END ===

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

        // === KODE BARU START: Logika membaca events.json ===
        $events = [];
        
        // Cek apakah file events.json ada di public/storage, lalu baca isinya
        if (Storage::disk('public')->exists('events.json')) {
            $jsonString = Storage::disk('public')->get('events.json');
            $events = json_decode($jsonString, true) ?? [];
        }
        // === KODE BARU END ===

        // kirim data ke view
        // === KODE BARU: Tambahkan 'events' ke dalam array compact() ===
        return view('home', compact('currentCabinet', 'mentions', 'news', 'events'));
    }
}