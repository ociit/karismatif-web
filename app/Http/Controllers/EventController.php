<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Menampilkan form input untuk Admin
    public function create()
    {
        return view('admin.events.create');
    }

    // Memproses data dari form Admin dan menyimpannya ke JSON
    public function store(Request $request)
    {
        // 1. Validasi input agar tidak ada data kosong yang masuk
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'caption' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal ukuran poster 2MB
        ]);

        // 2. Ambil data event lama dari JSON (jika ada)
        $events = [];
        if (Storage::disk('public')->exists('events.json')) {
            $jsonString = Storage::disk('public')->get('events.json');
            $events = json_decode($jsonString, true) ?? [];
        }

        // 3. Simpan file gambar ke folder public/posters
        $posterPath = $request->file('poster')->store('posters', 'public');

        // 4. Bentuk format data event baru
        $newEvent = [
            'id' => uniqid(),
            'title' => $request->title,
            'event_date' => $request->event_date,
            'caption' => $request->caption,
            'poster' => $posterPath,
            'created_at' => now()->toDateTimeString(),
        ];

        // 5. Gabungkan data baru ke data lama, lalu tulis ulang file JSON-nya
        $events[] = $newEvent;
        Storage::disk('public')->put('events.json', json_encode($events, JSON_PRETTY_PRINT));

        // 6. Kembalikan admin ke halaman form dengan pesan sukses
        return back()->with('success', 'Event berhasil ditambahkan ke kalender!');
    }
}