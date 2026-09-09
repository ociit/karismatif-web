<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan form input untuk Admin
    public function create(Request $request)
    {
        $this->ensureAdmin($request);

        return view('admin.events.create');
    }

    // Memproses data dari form Admin dan menyimpannya ke Database
    public function store(Request $request)
    {
        $this->ensureAdmin($request);

        // Validasi input agar tidak ada data kosong yang masuk
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'caption' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Simpan file gambar ke folder public/posters.
        $posterPath = $request->file('poster')->store('posters', 'public');

        // Bentuk format data event baru
        Event::create([
            'title' => $request->title,
            'event_date' => $request->event_date,
            'caption' => $request->caption,
            'poster' => $posterPath,
        ]);

        return back()->with('success', 'Event berhasil disimpan ke database.');
    }

    private function ensureAdmin(Request $request): void
    {
        abort_unless($request->user()?->role?->nama_role === 'admin', 403);
    }
}
