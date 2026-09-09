@props(['currentCabinet'])

<section id="about" class="relative py-20 bg-none overflow-hidden">

    {{-- Aksen dekoratif sudut --}}
    <div class="absolute top-0 right-0 w-64 h-64 opacity-[0.06] pointer-events-none">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <circle cx="150" cy="50" r="120" fill="#0097A7"/>
        </svg>
    </div>
    <div class="absolute bottom-0 left-0 w-48 h-48 opacity-[0.07] pointer-events-none">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="150" r="100" fill="#F5C400"/>
        </svg>
    </div>

    <div class="container mx-auto px-20 py-10 max-w-7xl relative z-10">

        <div class="flex flex-col items-center gap-12">

            {{-- Bagian Logo — Tengah Atas --}}
            <div class="flex justify-center">
                <div class="relative">
                    <div class="absolute -inset-3 rounded-[2.8rem] border-2 border-dashed border-[#0097A7]/20 animate-spin-slow pointer-events-none"></div>
                    <div class="absolute -bottom-2 -right-2 w-6 h-6 rounded-full bg-[#F5C400] opacity-60 pointer-events-none"></div>
                    <div class="absolute -top-2 -left-2 w-3 h-3 rounded-full bg-[#0097A7] opacity-40 pointer-events-none"></div>
                    <div class="scroll-anim fade-in-up logo-box w-56 h-56 md:w-64 md:h-64 lg:w-72 lg:h-72 bg-white flex items-center justify-center rounded-[2.5rem] shadow-md border border-gray-100">
                        <img src="/assets/logo-dummy.png" alt="Logo Karismatif" class="w-full h-full object-contain p-5" />
                    </div>
                </div>
            </div>

            {{-- Bagian Teks (Visi & Misi) — Full Width --}}
            <div class="w-full space-y-12">

                {{-- Bagian Visi --}}
                <div class="space-y-4">

                    <h2 class="scroll-anim fade-in-left text-xl md:text-2xl font-black text-gray-900 tracking-tight">
                        Visi {{ $currentCabinet?->nama_kabinet ?? 'Kabinet' }}
                    </h2>

                    <div class="scroll-anim fade-in-up anim-delay-200 visi-card rounded-2xl border border-white/30 relative overflow-hidden cursor-pointer"
                         onclick="this.classList.toggle('visi-active')">
                        <div class="absolute bottom-4 right-4 w-8 h-8 rounded-full bg-white opacity-10 pointer-events-none"></div>
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-white/40 rounded-l-2xl pointer-events-none"></div>
                        <p class="relative z-10 text-sm md:text-base font-medium leading-relaxed text-white pl-4 pr-6 py-6 md:py-8">
                            {{-- [ Placeholder Teks Visi Karismatif ]<br><br> --}}
                            {{ $currentCabinet?->visi ?? 'Visi kabinet belum dikonfigurasi.' }}
                        </p>
                    </div>
                </div>

                {{-- Bagian Misi --}}
                <div class="w-full py-12">
                    <div class="flex flex-col items-center mb-12">
                        {{-- <span class="text-[#0097A7] font-bold tracking-widest uppercase text-sm mb-2">Pilar Organisasi</span> --}}
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight text-center">
                            Misi {{ $currentCabinet->nama_kabinet ?? 'Kabinet' }}
                        </h2>
                    </div>

                    @if($currentCabinet && $currentCabinet->missions->count() > 0)
                        <!-- Container: Stack di HP, Grid di Desktop -->
                        <div class="flex flex-col md:grid md:grid-cols-3 md:auto-rows-[280px] gap-4 md:gap-6 max-w-6xl mx-auto px-4 md:px-0">
                            
                            @foreach($currentCabinet->missions->sortBy('urutan') as $mission)
                                @php
                                    $isWide = ($loop->index % 4 == 0 || $loop->index % 4 == 3); 
                                    $colSpan = $isWide ? 'md:col-span-2' : 'md:col-span-1';

                                    if ($loop->last && $loop->count % 2 != 0) 
                                    {
                                        $colSpan = 'md:col-span-3';
                                    }
                                    
                                    $gradients = [
                                        'from-[#0097A7] to-[#00606B]',
                                        'from-[#F5C400] to-[#B38F00]',
                                        'from-gray-800 to-black',
                                    ];
                                    $bgClass = $gradients[$loop->index % 3];
                                    $formattedNumber = sprintf('%02d', $mission->urutan ?? ($loop->index + 1));
                                @endphp

                                <!-- ── MOBILE VIEW (Langsung Tampil, Tanpa Hover) ── -->
                                <div class="block md:hidden bg-gradient-to-br {{ $bgClass }} rounded-3xl p-6 shadow-lg relative overflow-hidden">
                                    <!-- Ornamen -->
                                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                                    
                                    <!-- Konten Mobile -->
                                    <div class="relative z-10 flex flex-col h-full">
                                        <div class="flex items-start gap-4 mb-4">
                                            <span class="text-white/40 font-black text-4xl">{{ $formattedNumber }}</span>
                                            <h3 class="text-lg font-bold text-white leading-snug pt-1">
                                                {{ $mission->nama_misi }}
                                            </h3>
                                        </div>
                                        <div class="bg-black/20 p-4 rounded-2xl border border-white/10 mt-auto">
                                            <p class="text-white/90 text-sm leading-relaxed">
                                                {{ $mission->keterangan_misi }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- ── DESKTOP VIEW (Bento Grid dengan Hover) ── -->
                                <div class="hidden md:block {{ $colSpan }} group relative rounded-3xl overflow-hidden shadow-lg transition-transform duration-300 hover:-translate-y-1 h-full min-h-[280px]">
                                    
                                    <div class="absolute inset-0 bg-gradient-to-br {{ $bgClass }} opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                                    <!-- Desktop Konten Default -->
                                    <div class="absolute inset-0 p-8 flex flex-col justify-between z-10 transition-all duration-500 group-hover:-translate-y-4 group-hover:opacity-0">
                                        <span class="text-white/40 font-black text-4xl">{{ $formattedNumber }}</span>
                                        <h3 class="text-2xl font-bold text-white leading-tight">
                                            {{ $mission->nama_misi }}
                                        </h3>
                                    </div>

                                    <!-- Desktop Konten Hover (Glassmorphism) -->
                                    <div class="absolute inset-0 p-8 bg-black/70 backdrop-blur-md flex flex-col justify-center translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 z-20">
                                        <div class="flex items-start gap-3 mb-4 shrink-0">
                                            <span class="text-[#F5C400] font-black text-xl mt-1">{{ $formattedNumber }}.</span>
                                            <!-- line-clamp dihapus agar judul panjang tidak kepotong -->
                                            <h4 class="text-lg font-bold text-white leading-tight">{{ $mission->nama_misi }}</h4>
                                        </div>
                                        <!-- Area deskripsi bisa di-scroll jika isinya sangat panjang -->
                                        <p class="text-white/90 text-base leading-relaxed overflow-y-auto custom-scrollbar pr-2">
                                            {{ $mission->keterangan_misi }}
                                        </p>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <!-- (Kondisi kosong tetap sama) -->
                        <div class="max-w-3xl mx-auto p-8 rounded-3xl border border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Blok misi belum dikonfigurasi.</p>
                        </div>
                    @endif
                </div>{{-- end bagian misi --}}
                
            </div>

        </div>{{-- end flex flex-col --}}
    </div>

    <style>
        /* ── Spin lambat ── */
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: spin-slow 18s linear infinite; }

        /* ── Scroll Animation ── */
        .scroll-anim {
            opacity: 0;
            transition: opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1),
                        transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: opacity, transform;
        }
        .fade-in-up    { transform: translateY(32px); }
        .fade-in-left  { transform: translateX(-32px); }
        .fade-in-right { transform: translateX(32px); }
        .scroll-anim.is-visible { opacity: 1; transform: translate(0, 0); }

        .anim-delay-100 { transition-delay: 80ms; }
        .anim-delay-200 { transition-delay: 180ms; }
        .anim-delay-300 { transition-delay: 280ms; }

        /* ── Visi Card — Gradient bergeser saat hover / active ── */
        .visi-card {
            background: linear-gradient(135deg, #0097A7 0%, #F5C400 100%);
            background-size: 200% 200%;
            background-position: 0% 50%;
            transition: background-position 0.8s cubic-bezier(0.22, 1, 0.36, 1),
                        box-shadow 0.4s ease,
                        transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @media (min-width: 768px) {
            .visi-card:hover {
                background-position: 100% 50%;
                box-shadow: 0 12px 40px -8px rgba(0, 151, 167, 0.35);
                transform: translateY(-2px);
            }
        }
        .visi-card.visi-active {
            background-position: 100% 50%;
            box-shadow: 0 12px 40px -8px rgba(0, 151, 167, 0.35);
        }

        /* ── Card Overlay Blur ── */
        .card-overlay-blur {
            background: linear-gradient(
                to top,
                rgba(0, 0, 0, 0.75) 0%,
                rgba(0, 0, 0, 0.30) 55%,
                rgba(0, 0, 0, 0.08) 100%
            );
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            transition: backdrop-filter 0.4s ease,
                        -webkit-backdrop-filter 0.4s ease,
                        background 0.4s ease,
                        height 0.45s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Desktop hover → blur lebih kuat */
        @media (min-width: 768px) {
            .accordion-card:hover .card-overlay-blur {
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                background: linear-gradient(
                    to top,
                    rgba(0, 0, 0, 0.85) 0%,
                    rgba(0, 0, 0, 0.50) 55%,
                    rgba(0, 0, 0, 0.15) 100%
                );
            }
        }

        /* ── Mobile Card: vertical accordion ── */
        .mobile-card {
            border-left: 3px solid transparent;
            transition: border-left-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Overlay */
        .mobile-card .card-overlay-blur {
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            transition: backdrop-filter 0.4s ease, background 0.4s ease;
        }

        /* Wrapper deskripsi: collapse via max-height */
        .mobile-desc-wrap {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            overflow: hidden;
        }
        .mobile-desc-wrap > p {
            overflow: hidden;
            min-height: 0;
        }

        /* Chevron */
        .mobile-card .mobile-chevron {
            display: inline-block;
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* State aktif */
        .mobile-card.card-active {
            border-left-color: #F5C400;
            box-shadow: 0 8px 28px -6px rgba(0, 151, 167, 0.22);
        }
        .mobile-card.card-active .card-overlay-blur {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background: linear-gradient(
                to top,
                rgba(0, 0, 0, 0.85) 0%,
                rgba(0, 0, 0, 0.50) 55%,
                rgba(0, 0, 0, 0.15) 100%
            );
        }
        .mobile-card.card-active .mobile-desc-wrap {
            grid-template-rows: 1fr; 
        }
        .mobile-card.card-active .mobile-chevron {
            transform: rotate(180deg);
        }

        /* ── Accordion — Desktop ── */
        @media (min-width: 768px) {
            .accordion-card, .accordion-spacer {
                flex: 1 1 0%;
                min-width: 0; /* Mencegah overflow teks */
                transition: flex-grow 0.55s cubic-bezier(0.22, 1, 0.36, 1),
                            border-left-color 0.3s ease,
                            box-shadow 0.3s ease;
            }

            .accordion-card {
                border-left: 3px solid transparent;
            }

            /* Saat grup di-hover, kartu yang di-hover langsung membesar pesat (flex-grow: 3.5) */
            .accordion-group .accordion-card:hover {
                flex-grow: 3.5 !important;
                border-left-color: #F5C400 !important;
                box-shadow: 0 16px 48px -10px rgba(0, 151, 167, 0.25);
            }

            /* Kartu lain & spacer secara otomatis akan menyusut proporsional (flex-grow: 1) */
            .accordion-group:hover .accordion-card:not(:hover) {
                flex-grow: 1;
            }

            .accordion-spacer {
                pointer-events: none !important;
            }

            /* Sembunyikan deskripsi di kartu yang TIDAK di-hover saat ada interaksi di dalam group */
            .accordion-group:has(.accordion-card:hover) .accordion-card:not(:hover) .card-desc {
                opacity: 0;
                transition: opacity 0.15s ease;
            }

            .accordion-group .accordion-card:hover .card-desc {
                opacity: 1 !important;
                transition: opacity 0.3s ease 0.2s;
            }

            .card-title {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
            }

            .accordion-group .accordion-card:hover .card-title {
                -webkit-line-clamp: unset;
            }

            .accordion-group .accordion-card:hover .card-number {
                color: #F5C400;
                transition: color 0.3s ease;
            }
        }

        /* ── Logo Box ── */
        .logo-box {
            transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.4s ease;
        }
        .logo-box:hover {
            transform: rotate(2deg) scale(1.03);
            box-shadow: 0 20px 56px -10px rgba(0,151,167,0.18);
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            /* ── Scroll Reveal ── */
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });
            document.querySelectorAll('.scroll-anim').forEach(el => observer.observe(el));
        });

        function toggleMobileCard(card) {
            const isActive = card.classList.contains('card-active');
            document.querySelectorAll('.mobile-card').forEach(c => c.classList.remove('card-active'));
            if (!isActive) card.classList.add('card-active');
        }
    </script>
</section>
