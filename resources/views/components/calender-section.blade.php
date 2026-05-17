<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.8/dist/cdn.min.js"></script>
<style>[x-cloak] { display: none !important; }</style>
@props(['events' => []])

@php
    use Carbon\Carbon;

    // ─── 1. Sort ascending by event_date ────────────────────────────────────────
    $sorted = collect($events)->sortBy('event_date')->values();

    // ─── 2. Grouped Kanban: "Mei 2026" => [events...] ──────────────────────────
    $groupedKanban = $sorted->groupBy(function ($e) {
        return Carbon::parse($e['event_date'])->translatedFormat('F Y');
    });

    // ─── 3. Calendar Grid: Logika Navigasi Bulan ───────────────────────────────
    $today = Carbon::today();
    $reqMonth = request('month'); // Menangkap parameter ?month=... dari URL

    if ($reqMonth) {
        // Jika user klik tombol navigasi, gunakan bulan dari URL
        $gridMonth = Carbon::parse($reqMonth)->startOfMonth();
    } else {
        // Default: Cari bulan event terdekat, atau bulan ini jika tidak ada
        $nearestEvent = $sorted->first(fn($e) => Carbon::parse($e['event_date'])->gte($today));
        $gridMonth = $nearestEvent
            ? Carbon::parse($nearestEvent['event_date'])->startOfMonth()
            : $today->copy()->startOfMonth();
    }

    $monthLabel   = $gridMonth->translatedFormat('F Y');
    $daysInMonth  = $gridMonth->daysInMonth;
    $startDow     = $gridMonth->dayOfWeek; // 0=Sun…6=Sat
    $totalCells   = $startDow + $daysInMonth;
    $trailingDays = (7 - ($totalCells % 7)) % 7;

    // Generate URL untuk tombol Prev & Next (beserta anchor #calendar agar tidak lompat ke atas)
    $prevMonthUrl = request()->fullUrlWithQuery(['month' => $gridMonth->copy()->subMonth()->format('Y-m')]) . '#calendar';
    $nextMonthUrl = request()->fullUrlWithQuery(['month' => $gridMonth->copy()->addMonth()->format('Y-m')]) . '#calendar';

    // Map events to Y-m-d for fast lookup in grid
    $eventsByDate = $sorted
        ->filter(fn($e) => Carbon::parse($e['event_date'])->format('Y-m') === $gridMonth->format('Y-m'))
        ->groupBy(fn($e) => Carbon::parse($e['event_date'])->format('Y-m-d'));
@endphp

<section
    id="calendar"
    x-data="calendarApp(@js($sorted))"
    class="relative py-20 px-4 overflow-hidden"
    style="background: linear-gradient(160deg, #e0f5ff 0%, #cdeefa 50%, #bde6fa 100%);"
>

    {{-- ── Decorative Background Elements ───────────────────────────────────── --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl"
             style="background: #0d4f7c;"></div>
        <div class="absolute bottom-10 left-0 w-72 h-72 rounded-full opacity-15 blur-3xl"
             style="background: #f8c104;"></div>
    </div>

    <div class="relative max-w-6xl mx-auto">

        {{-- ── Section Header ────────────────────────────────────────────────── --}}
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-4"
                  style="background: #f8c104; color: #0d4f7c;">
                📅 Jadwal Kegiatan
            </span>
            <div class="flex gap-4 justify-center">
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight" style="color: #0d4f7c;">
                    Event
                </h2>
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight" style="color: #f8c104;">
                    Karismatif
                </h2>
            </div>
            <p class="mt-3 text-slate-500 max-w-md mx-auto text-sm">
                Temukan dan ikuti berbagai kegiatan inspiratif yang kami selenggarakan.
            </p>
        </div>

        {{-- ── View Toggle ────────────────────────────────────────────────────── --}}
        <div class="flex justify-center mb-10">
            <div class="inline-flex rounded-2xl p-1 shadow-inner" style="background: rgba(13,79,124,0.1);">
                <button
                    @click="view = 'kanban'"
                    :class="view === 'kanban'
                        ? 'text-white shadow-md'
                        : 'text-[#0d4f7c] hover:bg-white/40'"
                    :style="view === 'kanban' ? 'background: #0d4f7c;' : ''"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                    </svg>
                    Kanban
                </button>
                <button
                    @click="view = 'calendar'"
                    :class="view === 'calendar'
                        ? 'text-white shadow-md'
                        : 'text-[#0d4f7c] hover:bg-white/40'"
                    :style="view === 'calendar' ? 'background: #0d4f7c;' : ''"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Kalender
                </button>
            </div>
        </div>

        {{-- ════════════════════════════════════════════════════════════════════ --}}
        {{-- ── VIEW 1: KANBAN ─────────────────────────────────────────────── --}}
        {{-- ════════════════════════════════════════════════════════════════════ --}}
        <div x-show="view === 'kanban'" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">

            @forelse ($groupedKanban as $monthLabel => $monthEvents)
            <div class="mb-10">
                {{-- Month Badge --}}
                <div class="flex items-center gap-3 mb-5">
                    <div class="flex items-center gap-2 px-4 py-1.5 rounded-full font-bold text-sm"
                         style="background: #0d4f7c; color: #f8c104;">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        {{ $monthLabel }}
                    </div>
                    <div class="flex-1 h-px" style="background: linear-gradient(to right, #0d4f7c33, transparent);"></div>
                    <span class="text-xs text-slate-400">{{ $monthEvents->count() }} event</span>
                </div>

                {{-- Cards Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($monthEvents as $event)
                    @php
                        $eventArr = is_array($event) ? $event : $event->toArray();
                        $parsedDate = \Carbon\Carbon::parse($eventArr['event_date']);
                    @endphp
                    <div
                        x-data="{{ json_encode(['eventData' => $eventArr]) }}"
                        @click="openEventModal(eventData)"
                        class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-md hover:shadow-xl
                               border border-white/70 overflow-hidden cursor-pointer
                               transition-all duration-300 hover:-translate-y-1"
                    >
                        {{-- Poster --}}
                        @if(!empty($eventArr['poster']))
                        <div class="h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . $eventArr['poster']) }}"
                                 alt="{{ $eventArr['title'] }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        </div>
                        @else
                        <div class="h-40 flex items-center justify-center"
                             style="background: linear-gradient(135deg, #e0f5ff, #bde6fa);">
                            <svg class="w-12 h-12 opacity-30" style="color: #0d4f7c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif

                        {{-- Date badge overlay --}}
                        <div class="absolute top-3 left-3 flex flex-col items-center justify-center w-12 h-12
                                    rounded-xl shadow-lg font-extrabold"
                             style="background: #f8c104; color: #0d4f7c;">
                            <span class="text-lg leading-none">{{ $parsedDate->format('d') }}</span>
                            <span class="text-xs leading-none uppercase">{{ $parsedDate->format('M') }}</span>
                        </div>

                        {{-- Content --}}
                        <div class="p-4">
                            <h3 class="font-bold text-sm leading-snug line-clamp-2 mb-1" style="color: #0d4f7c;">
                                {{ $eventArr['title'] }}
                            </h3>
                            <p class="text-xs text-slate-400 line-clamp-2">{{ $eventArr['caption'] }}</p>
                        </div>

                        {{-- Hover arrow --}}
                        <div class="absolute bottom-3 right-3 w-7 h-7 rounded-full flex items-center justify-center
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                             style="background: #0d4f7c;">
                            <svg class="w-3.5 h-3.5 text-[#f8c104]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="text-center py-20">
                <div class="w-20 h-20 rounded-3xl mx-auto flex items-center justify-center mb-4"
                     style="background: #e0f5ff;">
                    <svg class="w-10 h-10" style="color: #0d4f7c; opacity:0.4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-slate-400 text-sm">Belum ada event yang terdaftar.</p>
            </div>
            @endforelse
        </div>

        {{-- ════════════════════════════════════════════════════════════════════ --}}
        {{-- ── VIEW 2: GRID CALENDAR (ALPINE MODE - BERSIH) ──────────────────── --}}
        {{-- ════════════════════════════════════════════════════════════════════ --}}
        <div x-show="view === 'calendar'" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak>

            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border border-white/70 overflow-hidden">
                {{-- Calendar Header & Navigation --}}
                <div class="px-6 py-6 border-b border-slate-100" style="background: #0d4f7c;">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <button @click="prevMonth()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/25 text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-white min-w-[160px] text-center tracking-wide" x-text="monthLabel"></h3>
                            <button @click="nextMonth()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/25 text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <span class="bg-[#f8c104] px-4 py-1.5 rounded-full text-[#0d4f7c] text-sm font-extrabold shadow-sm" x-text="currentMonthEventsCount > 0 ? currentMonthEventsCount + ' Hari Ada Event' : 'Bulan Ini Kosong'">
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Day of Week Headers --}}
                <div class="grid grid-cols-7 border-b border-slate-200 bg-slate-50/50">
                    @foreach(['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $i => $day)
                    <div class="py-4 text-center text-xs sm:text-sm font-extrabold uppercase tracking-widest {{ $i === 0 ? 'text-red-500' : 'text-slate-500' }}">
                        <span class="block sm:hidden">{{ substr($day, 0, 3) }}</span>
                        <span class="hidden sm:block">{{ $day }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Calendar Grid (Alpine.js Loop) --}}
                {{-- Calendar Grid (Alpine.js Loop Terpusat) --}}
                <div class="grid grid-cols-7">
                    <template x-for="(cell, index) in gridCells" :key="index">
                        
                        {{-- SATU BUNGKUSAN ROOT UNTUK X-FOR (Wajib bagi Alpine.js) --}}
                        <div class="relative min-h-[100px] sm:min-h-[130px] border-b border-slate-200/60 transition-all duration-200"
                             :class="{
                                 'border-r': (index + 1) % 7 !== 0,
                                 'bg-slate-100/50': cell.type === 'blank',
                                 'p-2 sm:p-3': cell.type === 'day',
                                 'cursor-pointer hover:bg-[#e0f5ff]/80 hover:shadow-inner group': cell.type === 'day' && cell.events && cell.events.length > 0,
                                 'bg-blue-50/30': cell.type === 'day' && cell.isToday
                             }"
                             @click="if(cell.type === 'day' && cell.events && cell.events.length > 0) openDayModal(cell.events)">
                             
                            {{-- Isi kotak hanya muncul jika ini bukan hari kosong --}}
                            <template x-if="cell.type === 'day'">
                                <div class="h-full flex flex-col">
                                    
                                    {{-- Angka Tanggal --}}
                                    <div class="flex justify-start mb-2">
                                        <span class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full text-sm sm:text-lg font-bold transition-colors"
                                              :class="{
                                                  'text-white shadow-md bg-[#0d4f7c]': cell.isToday,
                                                  'text-red-500': !cell.isToday && cell.isSunday,
                                                  'text-slate-700': !cell.isToday && !cell.isSunday
                                              }" x-text="cell.dayNum">
                                        </span>
                                    </div>

                                    {{-- Indikator Event --}}
                                    <template x-if="cell.events && cell.events.length > 0">
                                        <div class="space-y-1.5">
                                            <template x-for="ev in cell.events.slice(0, 2)">
                                                <div class="flex items-center gap-1.5 px-2 py-1 rounded-md text-[10px] sm:text-xs font-bold truncate transition-colors group-hover:bg-[#0d4f7c] group-hover:text-white shadow-sm" style="background: #e0f5ff; color: #0d4f7c; border: 1px solid #bde6fa;">
                                                    <span class="w-2 h-2 rounded-full flex-shrink-0" style="background: #f8c104;"></span>
                                                    <span class="truncate" x-text="ev.title"></span>
                                                </div>
                                            </template>
                                            <template x-if="cell.events.length > 2">
                                                <div class="text-[10px] sm:text-xs font-extrabold pl-1 pt-1" style="color: #0d4f7c;" x-text="'+' + (cell.events.length - 2) + ' lainnya'"></div>
                                            </template>
                                        </div>
                                    </template>

                                </div>
                            </template>

                        </div>
                    </template>
                </div>
            </div>
        </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- ── MODAL 1: Day Events List ────────────────────────────────────────── --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div
        x-show="isDayModalOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click.self="isDayModalOpen = false"
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-4 bg-white/40 backdrop-blur-sm"
        x-cloak
    >
        <div
            x-show="isDayModalOpen"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            class="w-full max-w-sm bg-white rounded-3xl shadow-2xl overflow-hidden"
        >
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100"
                 style="background: linear-gradient(135deg, #0d4f7c, #1a6fa8);">
                <div>
                    <h4 class="text-white font-bold text-sm">Event Hari Ini</h4>
                    <p class="text-[#bde6fa] text-xs mt-0.5">
                        <span x-text="selectedDayEvents.length"></span> kegiatan terdaftar
                    </p>
                </div>
                <button @click="isDayModalOpen = false"
                        class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors"
                        style="background: rgba(255,255,255,0.15);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Event List --}}
            <div class="p-4 space-y-2 max-h-72 overflow-y-auto">
                <template x-for="(ev, idx) in selectedDayEvents" :key="idx">
                    <button
                        @click="openEventModal(ev)"
                        class="w-full flex items-center gap-3 p-3 rounded-2xl text-left transition-all hover:shadow-md group"
                        style="background: #f0f9ff; border: 1px solid #e0f5ff;"
                        :style="{}"
                        @mouseover="$el.style.background='#e0f5ff'; $el.style.borderColor='#0d4f7c22';"
                        @mouseout="$el.style.background='#f0f9ff'; $el.style.borderColor='#e0f5ff';"
                    >
                        {{-- Poster thumb --}}
                        <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100">
                            <template x-if="ev.poster">
                                <img :src="'/storage/' + ev.poster" :alt="ev.title"
                                     class="w-full h-full object-cover" />
                            </template>
                            <template x-if="!ev.poster">
                                <div class="w-full h-full flex items-center justify-center" style="background:#e0f5ff;">
                                    <svg class="w-5 h-5 opacity-40" style="color:#0d4f7c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                    </svg>
                                </div>
                            </template>
                        </div>
                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold truncate" style="color: #0d4f7c;" x-text="ev.title"></p>
                            <p class="text-xs text-slate-400 mt-0.5 truncate" x-text="ev.caption"></p>
                        </div>
                        {{-- Arrow --}}
                        <svg class="w-4 h-4 flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity" style="color:#f8c104;"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </template>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- ── MODAL 2: Event Detail (Poster di Tengah & Scroll Rapi) ──────────── --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div
        x-show="isEventModalOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click.self="isEventModalOpen = false"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-white/40 backdrop-blur-md"
        x-cloak
    >
        <div
            x-show="isEventModalOpen"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            {{-- Wrapper luar membatasi tinggi maksimum pop-up --}}
            class="relative w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl flex flex-col max-h-[90vh] md:max-h-[85vh] overflow-hidden"
        >
            {{-- Tombol Tutup (X) Floating --}}
            <button @click="isEventModalOpen = false"
                    class="absolute top-4 right-4 z-[60] w-9 h-9 rounded-full flex items-center justify-center shadow-md transition-transform active:scale-95 bg-white/90 backdrop-blur-md text-slate-800 hover:bg-slate-100 border border-slate-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <template x-if="selectedEvent">
                {{-- Di Mobile: Semua ikut ter-scroll. Di Desktop: Grid dikunci tingginya --}}
                <div class="grid grid-cols-1 md:grid-cols-2 flex-1 min-h-0 overflow-y-auto md:overflow-hidden" x-ref="modalContainer">
                    
                    {{-- SISI KIRI: POSTER (Ditengah & Ber-Padding di Desktop) --}}
                    <div class="relative w-full h-full bg-slate-50/80 flex flex-col items-center justify-center p-0 md:p-10 border-b md:border-b-0 md:border-r border-slate-100">
                        
                        {{-- Wrapper Gambar (Dikunci 1:1) --}}
                        <div class="w-full relative md:rounded-2xl overflow-hidden md:shadow-lg bg-slate-100">
                            <template x-if="selectedEvent.poster">
                                <img :src="'/storage/' + selectedEvent.poster"
                                     :alt="selectedEvent.title"
                                     class="w-full h-full object-containt" />
                            </template>
                            <template x-if="!selectedEvent.poster">
                                <div class="w-full h-full flex items-center justify-center"
                                     style="background: linear-gradient(135deg,#e0f5ff,#bde6fa);">
                                    <svg class="w-20 h-20 opacity-20" style="color:#0d4f7c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </template>

                            {{-- Date Badge Overlay --}}
                            <div class="absolute bottom-4 left-4 px-3 py-1.5 rounded-xl font-bold text-[10px] sm:text-xs shadow-md"
                                 style="background: #f8c104; color: #0d4f7c;">
                                <span x-text="new Date(selectedEvent.event_date + 'T00:00:00').toLocaleDateString('id-ID',{weekday:'short',day:'numeric',month:'short',year:'numeric'})"></span>
                            </div>
                        </div>
                    </div>

                    {{-- SISI KANAN: KONTEN TEKS --}}
                    {{-- Di Desktop, kolom ini dikunci tingginya dan di-scroll bagian dalamnya --}}
                    <div class="flex flex-col h-full bg-white min-h-0 md:overflow-hidden">
                        
                        {{-- Area Deskripsi (Scrollable independen pada Desktop) --}}
                        <div class="p-6 md:p-8 md:overflow-y-auto flex-1" x-ref="textContent">
                            {{-- Header ala profil IG --}}
                            <div class="flex items-center gap-3 mb-5 pb-5 border-b border-slate-50">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-inner shrink-0" style="background: #0d4f7c; color: #f8c104;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-extrabold truncate" style="color: #0d4f7c;">Karismatif Official</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Detail Acara</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-black leading-tight mb-4" style="color: #0d4f7c;" x-text="selectedEvent.title"></h3>
                            <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-wrap font-medium" x-text="selectedEvent.caption"></p>
                        </div>

                        {{-- Footer Tombol (Selalu nempel di dasar) --}}
                        <div class="p-5 md:p-6 bg-slate-50/50 border-t border-slate-100 shrink-0">
                            <button @click="isEventModalOpen = false"
                                    class="w-full py-3.5 rounded-2xl text-sm font-bold text-white transition-all active:scale-95 shadow-md hover:shadow-lg"
                                    style="background: linear-gradient(135deg, #0d4f7c, #1a6fa8);">
                                Tutup
                            </button>
                        </div>
                    </div>

                </div>
            </template>
        </div>
    </div>

</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('calendarApp', (serverEvents) => ({
            view: 'calendar',
            isDayModalOpen: false,
            isEventModalOpen: false,
            selectedDayEvents: [],
            selectedEvent: null,
            events: serverEvents, 
            currentDate: new Date(),

            init() {
                const today = new Date();
                today.setHours(0,0,0,0);
                const upcoming = this.events.find(e => new Date(e.event_date) >= today);
                if (upcoming) {
                    const parts = upcoming.event_date.split('-');
                    this.currentDate = new Date(parts[0], parts[1] - 1, 1);
                } else {
                    this.currentDate = new Date(today.getFullYear(), today.getMonth(), 1);
                }
            },

            get monthLabel() {
                return this.currentDate.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
            },

            get currentMonthEventsCount() {
                const year = this.currentDate.getFullYear();
                const month = String(this.currentDate.getMonth() + 1).padStart(2, '0');
                const prefix = `${year}-${month}`;
                // Perbaikan: gunakan startsWith
                return this.events.filter(e => e.event_date.startsWith(prefix)).length;
            },

            nextMonth() {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
            },
            prevMonth() {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
            },

            get gridCells() {
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();
                const firstDay = new Date(year, month, 1).getDay(); 
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const totalCells = firstDay + daysInMonth;
                const trailingDays = (7 - (totalCells % 7)) % 7;

                let cells = [];
                for(let i = 0; i < firstDay; i++) cells.push({ type: 'blank' });
                
                const today = new Date();
                today.setHours(0,0,0,0);

                for(let i = 1; i <= daysInMonth; i++) {
                    const cellDate = new Date(year, month, i);
                    const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(i).padStart(2,'0')}`;
                    
                    // Perbaikan: gunakan startsWith agar aman dari jam/menit
                    const dayEvents = this.events.filter(e => e.event_date.startsWith(dateStr));

                    cells.push({
                        type: 'day',
                        dayNum: i,
                        isToday: cellDate.toDateString() === today.toDateString(),
                        isSunday: cellDate.getDay() === 0,
                        events: dayEvents
                    });
                }
                
                for(let i = 0; i < trailingDays; i++) cells.push({ type: 'blank' });

                return cells;
            },

            openDayModal(events) {
                this.selectedDayEvents = events;
                this.isDayModalOpen = true;
            },
            openEventModal(event) {
            this.selectedEvent = event;
            this.isDayModalOpen = false;
            this.isEventModalOpen = true;

            // Tambahkan perintah reset scroll ini:
            this.$nextTick(() => {
                if (this.$refs.modalContainer) this.$refs.modalContainer.scrollTop = 0;
                if (this.$refs.textContent) this.$refs.textContent.scrollTop = 0;
            });
        },
        }));
    });
</script>