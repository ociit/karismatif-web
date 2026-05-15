<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event — Karismatif Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --navy:   #0d4f7c;
            --navy-dark: #09395a;
            --gold:   #f8c104;
            --gold-dark: #d4a500;
            --cyan-light: #e0f5ff;
            --cyan-mid:   #bde6fa;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #e0f5ff 0%, #bde6fa 40%, #d6eeff 100%);
            min-height: 100vh;
        }

        .brand-serif { font-family: 'DM Serif Display', serif; }

        /* Sidebar & layout */
        .sidebar {
            background: linear-gradient(180deg, #0d4f7c 0%, #09395a 100%);
        }

        /* Navy focus ring */
        .navy-input {
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .navy-input:focus {
            outline: none;
            border-color: #0d4f7c;
            box-shadow: 0 0 0 3px rgba(13, 79, 124, 0.18);
        }

        /* Gold button shine */
        .btn-gold {
            background: linear-gradient(135deg, #f8c104 0%, #f5a623 100%);
            transition: transform 0.18s, box-shadow 0.18s, filter 0.18s;
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(248, 193, 4, 0.45);
            filter: brightness(1.06);
        }
        .btn-gold:active { transform: translateY(0); }

        /* Drag-drop zone */
        .upload-zone {
            border: 2px dashed #bde6fa;
            transition: border-color 0.2s, background 0.2s;
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: #0d4f7c;
            background: rgba(13, 79, 124, 0.04);
        }

        /* Flash message */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .flash-anim { animation: slideDown 0.4s cubic-bezier(.22,.61,.36,1) both; }

        /* Floating label effect */
        .field-group { position: relative; }

        /* Decorative blob */
        .blob-bg {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>
<body class="antialiased" x-data="eventForm()">

    {{-- Decorative blobs --}}
    <div class="blob-bg w-96 h-96 bg-[#0d4f7c] -top-20 -right-20"></div>
    <div class="blob-bg w-72 h-72 bg-[#f8c104] bottom-10 left-10"></div>

    <div class="relative z-10 flex min-h-screen">

        {{-- ===================== SIDEBAR ===================== --}}
        <!-- <aside class="sidebar hidden lg:flex flex-col w-64 fixed top-0 left-0 h-full z-30 shadow-2xl">
            {{-- Logo --}}
            <div class="px-6 py-8 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#f8c104] flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-[#0d4f7c]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="brand-serif text-white text-lg leading-tight">Karismatif</p>
                        <p class="text-white/50 text-xs">Admin Panel</p>
                    </div>
                </div>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10"/></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/15 text-white text-sm font-semibold shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    Events
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    Users
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Settings
                </a>
            </nav>

            <div class="px-4 py-5 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#f8c104]/80 flex items-center justify-center text-[#0d4f7c] font-bold text-sm">A</div>
                    <div>
                        <p class="text-white text-sm font-semibold leading-tight">Admin</p>
                        <p class="text-white/40 text-xs">Superadmin</p>
                    </div>
                </div>
            </div>
        </aside> -->

        {{-- ===================== MAIN CONTENT ===================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-10 py-8">

            {{-- Top bar mobile --}}
            <div class="flex lg:hidden items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#0d4f7c] flex items-center justify-center shadow">
                        <svg class="w-5 h-5 text-[#f8c104]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <p class="brand-serif text-[#0d4f7c] text-lg">Karismatif</p>
                </div>
                <div class="w-9 h-9 rounded-full bg-[#0d4f7c] flex items-center justify-center text-[#f8c104] font-bold text-sm">A</div>
            </div>

            {{-- Breadcrumb --}}
            <!-- <div class="flex items-center gap-2 text-sm text-[#0d4f7c]/60 mb-6">
                <a href="#" class="hover:text-[#0d4f7c] transition-colors font-medium">Events</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span class="text-[#0d4f7c] font-semibold">Tambah Event Baru</span>
            </div> -->

            {{-- ============ FLASH MESSAGE ============ --}}
            @if(session('success'))
            <div class="flash-anim mb-6 flex items-start gap-4 bg-white border border-green-200 rounded-2xl px-5 py-4 shadow-lg"
                 x-data="{ show: true }" x-show="show" x-transition>
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-green-800 text-sm">Berhasil!</p>
                    <p class="text-green-700 text-sm mt-0.5">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-400 hover:text-green-600 transition-colors mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            @endif

            {{-- ============ PAGE HEADER ============ --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-2 bg-[#f8c104]/20 text-[#0d4f7c] text-xs font-bold px-3 py-1.5 rounded-full mb-3 uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    Event Baru
                </div>
                <h1 class="brand-serif text-3xl sm:text-4xl text-[#0d4f7c] leading-tight">Tambah Event <em class="not-italic text-[#f8c104]">Karismatif</em></h1>
                <p class="text-[#0d4f7c]/60 mt-2 text-sm">Isi semua informasi event dengan lengkap untuk ditampilkan di halaman publik.</p>
            </div>

            {{-- ============ FORM CARD ============ --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl shadow-[#0d4f7c]/8 border border-white/60 overflow-hidden">

                {{-- Card header strip --}}
                <div class="h-1.5 bg-gradient-to-r from-[#0d4f7c] via-[#1a7ab8] to-[#f8c104]"></div>

                <form
                    action="{{ route('events.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6 sm:p-8 lg:p-10 space-y-7"
                    @submit="submitting = true"
                >
                    @csrf

                    {{-- Validation Errors --}}
                    @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <p class="text-red-700 text-sm font-semibold">Mohon perbaiki kesalahan berikut:</p>
                        </div>
                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                            <li class="text-red-600 text-sm flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- ---- Grid: Title & Date ---- --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Title --}}
                        <div class="field-group sm:col-span-2 lg:col-span-1">
                            <label for="title" class="block text-[#0d4f7c] font-semibold text-sm mb-2">
                                Judul Event <span class="text-[#f8c104] ml-0.5">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-[#0d4f7c]/40">
                                    <svg class="w-4.5 h-4.5 w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </div>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    value="{{ old('title') }}"
                                    placeholder="cth. Seminar Nasional Kepemimpinan 2026"
                                    required
                                    class="navy-input w-full bg-[#e0f5ff]/40 border border-[#bde6fa] rounded-2xl pl-11 pr-4 py-3.5 text-[#0d4f7c] placeholder-[#0d4f7c]/35 text-sm font-medium @error('title') border-red-400 bg-red-50 @enderror"
                                >
                            </div>
                            @error('title')
                            <p class="mt-1.5 text-red-500 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div class="field-group">
                            <label for="event_date" class="block text-[#0d4f7c] font-semibold text-sm mb-2">
                                Tanggal Event <span class="text-[#f8c104] ml-0.5">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-[#0d4f7c]/40">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                </div>
                                <input
                                    type="date"
                                    name="event_date"
                                    id="event_date"
                                    value="{{ old('event_date') }}"
                                    required
                                    class="navy-input w-full bg-[#e0f5ff]/40 border border-[#bde6fa] rounded-2xl pl-11 pr-4 py-3.5 text-[#0d4f7c] text-sm font-medium @error('event_date') border-red-400 bg-red-50 @enderror"
                                >
                            </div>
                            @error('event_date')
                            <p class="mt-1.5 text-red-500 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>

                    {{-- ---- Poster Upload ---- --}}
                    <div class="field-group">
                        <label class="block text-[#0d4f7c] font-semibold text-sm mb-2">
                            Poster Event <span class="text-[#f8c104] ml-0.5">*</span>
                        </label>
                        <div
                            class="upload-zone rounded-2xl p-8 text-center cursor-pointer relative"
                            @dragover.prevent="$el.classList.add('dragover')"
                            @dragleave.prevent="$el.classList.remove('dragover')"
                            @drop.prevent="handleDrop($event)"
                            @click="$refs.posterInput.click()"
                        >
                            <input
                                type="file"
                                name="poster"
                                id="poster"
                                accept="image/*"
                                required
                                x-ref="posterInput"
                                @change="handleFileSelect($event)"
                                class="hidden"
                            >

                            {{-- Preview --}}
                            <template x-if="previewUrl">
                                <div class="space-y-3">
                                    <div class="mx-auto w-40 h-52 rounded-xl overflow-hidden shadow-lg border-2 border-[#0d4f7c]/20">
                                        <img :src="previewUrl" class="w-full h-full object-cover" alt="Preview">
                                    </div>
                                    <p class="text-[#0d4f7c] font-semibold text-sm" x-text="fileName"></p>
                                    <p class="text-[#0d4f7c]/50 text-xs">Klik untuk ganti gambar</p>
                                </div>
                            </template>

                            {{-- Placeholder --}}
                            <template x-if="!previewUrl">
                                <div class="space-y-3">
                                    <div class="mx-auto w-16 h-16 rounded-2xl bg-[#e0f5ff] border border-[#bde6fa] flex items-center justify-center">
                                        <svg class="w-8 h-8 text-[#0d4f7c]/50" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[#0d4f7c] font-semibold text-sm">Klik atau seret gambar ke sini</p>
                                        <p class="text-[#0d4f7c]/50 text-xs mt-1">PNG, JPG, WEBP — maks. 5MB. Disarankan rasio potret (3:4).</p>
                                    </div>
                                    <div class="inline-flex items-center gap-2 bg-[#0d4f7c]/8 text-[#0d4f7c] text-xs font-semibold px-4 py-2 rounded-full">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
                                        Pilih File
                                    </div>
                                </div>
                            </template>
                        </div>
                        @error('poster')
                        <p class="mt-1.5 text-red-500 text-xs flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- ---- Caption ---- --}}
                    <div class="field-group">
                        <label for="caption" class="block text-[#0d4f7c] font-semibold text-sm mb-2">
                            Caption / Deskripsi <span class="text-[#f8c104] ml-0.5">*</span>
                        </label>
                        <div class="relative">
                            <textarea
                                name="caption"
                                id="caption"
                                rows="5"
                                placeholder="Tuliskan deskripsi singkat yang menarik tentang event ini..."
                                required
                                x-model="captionText"
                                class="navy-input w-full bg-[#e0f5ff]/40 border border-[#bde6fa] rounded-2xl px-4 py-3.5 text-[#0d4f7c] placeholder-[#0d4f7c]/35 text-sm font-medium resize-none @error('caption') border-red-400 bg-red-50 @enderror"
                            >{{ old('caption') }}</textarea>
                            <div class="absolute bottom-3 right-4 text-xs text-[#0d4f7c]/40 font-medium" x-text="captionText.length + ' karakter'"></div>
                        </div>
                        @error('caption')
                        <p class="mt-1.5 text-red-500 text-xs flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- ---- Actions ---- --}}
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-4 pt-2 border-t border-[#bde6fa]/60">
                        <a href="{{ route('landing') }}#calendar"
                           class="w-full sm:w-auto text-center text-[#0d4f7c] font-semibold text-sm px-6 py-3.5 rounded-2xl border border-[#bde6fa] hover:bg-[#e0f5ff] transition-colors">
                            Batal
                        </a>
                        <button
                            type="submit"
                            :disabled="submitting"
                            class="btn-gold w-full sm:w-auto flex items-center justify-center gap-2.5 text-[#0d4f7c] font-bold text-sm px-8 py-3.5 rounded-2xl shadow-md disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none"
                        >
                            <template x-if="!submitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4.5 h-4.5 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                    Simpan Event
                                </span>
                            </template>
                            <template x-if="submitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg>
                                    Menyimpan...
                                </span>
                            </template>
                        </button>
                    </div>

                </form>
            </div>

            <p class="text-center text-[#0d4f7c]/40 text-xs mt-8">© {{ date('Y') }} Karismatif — All rights reserved.</p>
        </main>
    </div>

    <script>
        function eventForm() {
            return {
                previewUrl: null,
                fileName: '',
                captionText: '{{ old('caption') ?? '' }}',
                submitting: false,

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) this.setPreview(file);
                },

                handleDrop(event) {
                    event.currentTarget.classList.remove('dragover');
                    const file = event.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        // Assign to the actual input
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        this.$refs.posterInput.files = dt.files;
                        this.setPreview(file);
                    }
                },

                setPreview(file) {
                    this.fileName = file.name;
                    const reader = new FileReader();
                    reader.onload = (e) => { this.previewUrl = e.target.result; };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
</body>
</html>