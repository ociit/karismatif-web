@props(['events'])

@php
    use Carbon\Carbon;

    $today = Carbon::today();
    $upcomingEvents = $events->filter(fn ($event) => $event->event_date->gte($today))->values();
    $pastEvents = $events->filter(fn ($event) => $event->event_date->lt($today))->values();
    $featuredEvent = $upcomingEvents->first();
    $agendaEvents = $upcomingEvents->concat($pastEvents)->values();
    
    $eventPayload = $agendaEvents->map(fn ($event) => [
        'id' => $event->id,
        'title' => $event->title,
        'event_date' => $event->event_date->format('Y-m-d'),
        'caption' => $event->caption,
        'poster_url' => asset('storage/' . $event->poster),
    ]);
@endphp

<section id="calendar" 
         x-data="{ 
             events: {{ Js::from($eventPayload) }}, 
             selectedEvent: null,
             showModal: false,
             openModal(id) {
                 this.selectedEvent = this.events.find(e => e.id === id) || null;
                 if (this.selectedEvent) {
                     this.showModal = true;
                     document.body.style.overflow = 'hidden';
                 }
             },
             closeModal() {
                 this.showModal = false;
                 document.body.style.overflow = 'auto';
                 setTimeout(() => { this.selectedEvent = null; }, 200);
             },
             formatDate(dateStr) {
                 if (!dateStr) return '';
                 return new Date(`${dateStr}T00:00:00`).toLocaleDateString('id-ID', { 
                     weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' 
                 });
             }
         }" 
         class="relative overflow-hidden bg-slate-50 py-16 sm:py-24">
         
    {{-- Background Accent --}}
    <div class="absolute inset-x-0 top-0 h-80 bg-gradient-to-br from-[#083f66] via-[#0d4f7c] to-[#1678b7]"></div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6">
        
        {{-- Section Header --}}
        <div class="mb-10 flex flex-col gap-6 text-white sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#f8c104] px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-[#0d4f7c]">
                    Agenda Karismatif
                </span>
                <h2 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl lg:text-5xl">Kegiatan Mendatang</h2>
                <p class="mt-2 text-sm leading-relaxed text-sky-100 sm:text-base">Jangan lewatkan agenda, informasi, dan dokumentasi kegiatan Karismatif.</p>
            </div>
            
            <div class="flex items-center gap-3 self-start rounded-2xl border border-white/20 bg-white/10 px-5 py-3 backdrop-blur-md sm:self-auto">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-[#f8c104]">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider text-sky-200">Agenda Mendatang</p>
                    <p class="text-xl font-black">{{ $upcomingEvents->count() }} Event</p>
                </div>
            </div>
        </div>

        {{-- Featured Event Card --}}
        @if ($featuredEvent)
            <article class="group mb-10 overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-900/5 transition-all duration-300 hover:shadow-2xl md:grid md:grid-cols-12">
                <div class="relative min-h-[240px] overflow-hidden md:col-span-5 md:min-h-full">
                    <img src="{{ asset('storage/' . $featuredEvent->poster) }}" 
                         alt="{{ $featuredEvent->title }}" 
                         class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent md:hidden"></div>
                </div>
                
                <div class="flex flex-col justify-between p-6 sm:p-8 md:col-span-7 lg:p-10">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-widest text-[#1678b7]">
                                <span class="h-2 w-2 rounded-full bg-[#1678b7] animate-pulse"></span>
                                Event Terdekat
                            </span>
                            <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-[#0d4f7c]">
                                {{ $featuredEvent->event_date->diffForHumans() }}
                            </span>
                        </div>

                        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center">
                            <div class="flex h-16 w-16 shrink-0 flex-col items-center justify-center rounded-2xl bg-[#f8c104] font-black text-[#0d4f7c] shadow-md shadow-[#f8c104]/30">
                                <span class="text-2xl leading-none">{{ $featuredEvent->event_date->format('d') }}</span>
                                <span class="mt-0.5 text-[10px] uppercase tracking-wider">{{ $featuredEvent->event_date->translatedFormat('M') }}</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase text-slate-400">{{ $featuredEvent->event_date->translatedFormat('l, d F Y') }}</p>
                                <h3 class="mt-1 text-2xl font-black leading-snug text-[#0d4f7c] sm:text-3xl">{{ $featuredEvent->title }}</h3>
                            </div>
                        </div>

                        <p class="mt-4 line-clamp-3 text-sm leading-relaxed text-slate-600 sm:text-base">{{ $featuredEvent->caption }}</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <button type="button" 
                                @click="openModal({{ $featuredEvent->id }})" 
                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0d4f7c] px-6 py-3.5 text-sm font-bold text-white transition-all hover:bg-[#1678b7] active:scale-[0.98] sm:w-auto">
                            Lihat Detail Event
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </article>
        @endif

        {{-- Main Content Grid --}}
        <div class="grid gap-8 lg:grid-cols-12">
            
            {{-- Left: Event List --}}
            <div class="rounded-3xl bg-white p-6 shadow-xl shadow-slate-200/50 sm:p-8 lg:col-span-8">
                <div class="mb-6 flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-wider text-[#1678b7]">Daftar Kegiatan</p>
                        <h3 class="text-xl font-black text-[#0d4f7c] sm:text-2xl">Agenda Lengkap</h3>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                        {{ $agendaEvents->count() }} Total
                    </span>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($agendaEvents as $event)
                        @php
                            $isPast = $event->event_date->lt($today);
                        @endphp
                        
                        <button type="button" 
                                @click="openModal({{ $event->id }})" 
                                class="group flex w-full items-center gap-4 py-4 text-left transition-all duration-200 hover:translate-x-1 sm:gap-5">
                            
                            {{-- Date Badge --}}
                            <div class="flex h-14 w-14 shrink-0 flex-col items-center justify-center rounded-2xl transition-colors {{ $isPast ? 'bg-slate-100 text-slate-400' : 'bg-sky-50 text-[#0d4f7c] group-hover:bg-[#0d4f7c] group-hover:text-white' }}">
                                <span class="text-lg font-black leading-none">{{ $event->event_date->format('d') }}</span>
                                <span class="mt-0.5 text-[10px] font-bold uppercase tracking-wider">{{ $event->event_date->translatedFormat('M') }}</span>
                            </div>

                            {{-- Poster Thumbnail (Desktop) --}}
                            <img src="{{ asset('storage/' . $event->poster) }}" 
                                 alt="" 
                                 class="hidden h-14 w-14 rounded-xl object-cover sm:block" />

                            {{-- Info --}}
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    @if ($isPast)
                                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-slate-500">Selesai</span>
                                    @else
                                        <span class="rounded bg-emerald-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-700">Akan Datang</span>
                                    @endif
                                    <span class="text-xs font-medium text-slate-400">• {{ $event->event_date->translatedFormat('d F Y') }}</span>
                                </div>
                                <h4 class="mt-1 truncate font-bold text-slate-800 transition-colors group-hover:text-[#1678b7]">
                                    {{ $event->title }}
                                </h4>
                                <p class="mt-0.5 line-clamp-1 text-xs text-slate-500 sm:text-sm">{{ $event->caption }}</p>
                            </div>

                            {{-- Arrow Icon --}}
                            <div class="shrink-0 text-slate-300 transition-colors group-hover:text-[#1678b7]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </button>
                    @empty
                        <div class="py-12 text-center">
                            <p class="font-bold text-[#0d4f7c]">Belum Ada Agenda</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Right: Sidebar --}}
            <aside class="flex flex-col justify-between rounded-3xl bg-gradient-to-br from-[#0d4f7c] to-[#083f66] p-6 text-white shadow-xl lg:col-span-4 lg:p-8">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-[#f8c104]">Ringkasan</span>
                    <h3 class="mt-2 text-2xl font-black">Tetap Terhubung</h3>
                    <p class="mt-3 text-sm leading-relaxed text-sky-100">Klik salah satu agenda untuk melihat detail deskripsi dan brosur/poster kegiatan.</p>
                </div>

                <div class="mt-8 space-y-4 border-t border-white/10 pt-6">
                    <div class="flex items-center justify-between rounded-xl bg-white/5 p-3.5 backdrop-blur-sm">
                        <span class="text-sm font-medium text-sky-100">Mendatang</span>
                        <span class="rounded-lg bg-[#f8c104] px-2.5 py-0.5 text-sm font-black text-[#0d4f7c]">{{ $upcomingEvents->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-xl bg-white/5 p-3.5 backdrop-blur-sm">
                        <span class="text-sm font-medium text-sky-100">Arsip Selesai</span>
                        <span class="rounded-lg bg-white/10 px-2.5 py-0.5 text-sm font-black text-white">{{ $pastEvents->count() }}</span>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div x-show="showModal" 
         x-cloak 
         style="display: none;"
         @keydown.escape.window="closeModal()" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 p-4 sm:p-6">
        
        <div @click.outside="closeModal()" 
             class="relative flex max-h-[85vh] w-full max-w-3xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl md:flex-row">
            
            {{-- Close Button --}}
            <button type="button" 
                    @click="closeModal()" 
                    class="absolute right-4 top-4 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-black/60 text-white transition hover:bg-black/80 md:bg-slate-100 md:text-slate-500 md:hover:bg-slate-200">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <template x-if="selectedEvent">
                <div class="flex flex-col w-full md:flex-row min-h-0">
                    {{-- Modal Poster --}}
                    <div class="relative h-48 w-full shrink-0 bg-slate-900 md:h-auto md:w-1/2">
                        <img :src="selectedEvent.poster_url" 
                             :alt="selectedEvent.title" 
                             class="h-full w-full object-cover" />
                    </div>

                    {{-- Modal Content --}}
                    <div class="flex flex-1 flex-col overflow-y-auto p-6 sm:p-8">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#1678b7]" x-text="formatDate(selectedEvent.event_date)"></p>
                        <h3 class="mt-2 text-xl font-black text-[#0d4f7c] sm:text-2xl" x-text="selectedEvent.title"></h3>
                        <div class="my-3 h-0.5 w-12 bg-[#f8c104]"></div>
                        <p class="whitespace-pre-line text-sm leading-relaxed text-slate-600" x-text="selectedEvent.caption"></p>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>