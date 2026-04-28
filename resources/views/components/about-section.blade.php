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
                        <img src="{{asset('assets/logo-dummy.png')}}" alt="Logo Karismatif" class="w-full h-full object-contain p-5" />
                    </div>
                </div>
            </div>

            {{-- Bagian Teks (Visi & Misi) — Full Width --}}
            <div class="w-full space-y-12">

                {{-- Bagian Visi --}}
                <div class="space-y-4">

                    <h2 class="scroll-anim fade-in-left text-xl md:text-2xl font-black text-gray-900 tracking-tight">
                        Visi Kami
                    </h2>

                    <div class="scroll-anim fade-in-up anim-delay-200 visi-card rounded-2xl border border-white/30 relative overflow-hidden cursor-pointer"
                         onclick="this.classList.toggle('visi-active')">
                        <div class="absolute bottom-4 right-4 w-8 h-8 rounded-full bg-white opacity-10 pointer-events-none"></div>
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-white/40 rounded-l-2xl pointer-events-none"></div>
                        <p class="relative z-10 text-sm md:text-base font-medium leading-relaxed text-white pl-4 pr-6 py-6 md:py-8">
                            [ Placeholder Teks Visi Karismatif ]<br><br>
                            Menjadi Rumah Ideologis yang menyatukan alumni lintas generasi SMA IT Ihsanul Fikri dalam semangat nilai, kontribusi, dan kesinambungan perjuangan untuk menghadirkan dampak nyata bagi alumni, almamater, dan masyarakat.
                        </p>
                    </div>
                </div>

                {{-- Bagian Misi --}}
                <div class="space-y-4">

                    <h2 class="scroll-anim fade-in-left text-xl md:text-2xl font-black text-gray-900 tracking-tight">
                        Misi Kami
                    </h2>

                    {{-- ── MOBILE: Vertical Stack ── --}}
                    <div class="flex flex-col gap-3 md:hidden">

                        {{-- Mobile Card 1 --}}
                        <div class="mobile-card scroll-anim fade-in-up anim-delay-100 rounded-xl border border-gray-100 cursor-pointer overflow-hidden w-full"
                            style="background-image:url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&q=80'); background-size:cover; background-position:center;"
                            onclick="toggleMobileCard(this)">
                            <div class="card-overlay-blur w-full px-4 pt-3 pb-3">
                                {{-- Header: selalu tampil --}}
                                <div class="flex items-center justify-between min-h-[48px]">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-white/50 tracking-widest flex-shrink-0">01</span>
                                        <h3 class="text-xs font-bold text-white leading-snug">Merawat Silaturahmi dan Identitas Kolektif</h3>
                                    </div>
                                    <span class="mobile-chevron text-white/60 text-xs ml-3 flex-shrink-0">▼</span>
                                </div>
                                {{-- Deskripsi: toggle --}}
                                <div class="mobile-desc-wrap">
                                    <p class="mobile-desc text-white/80 leading-relaxed text-xs pt-2 pb-1">Membangun kembali kepercayaan internal dan memperkuat citra organisasi melalui proses rebranding yang inklusif bagi seluruh angkatan.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Card 2 --}}
                        <div class="mobile-card scroll-anim fade-in-up anim-delay-200 rounded-xl border border-gray-100 cursor-pointer overflow-hidden w-full"
                            style="background-image:url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&q=80'); background-size:cover; background-position:center top;"
                            onclick="toggleMobileCard(this)">
                            <div class="card-overlay-blur w-full px-4 pt-3 pb-3">
                                <div class="flex items-center justify-between min-h-[48px]">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-white/50 tracking-widest flex-shrink-0">02</span>
                                        <h3 class="text-xs font-bold text-white leading-snug">Menjadi Jembatan Pengetahuan dan Informasi</h3>
                                    </div>
                                    <span class="mobile-chevron text-white/60 text-xs ml-3 flex-shrink-0">▼</span>
                                </div>
                                <div class="mobile-desc-wrap">
                                    <p class="mobile-desc text-white/80 leading-relaxed text-xs pt-2 pb-1">Berperan sebagai fasilitator yang mengalirkan peluang karier, beasiswa, dan jejaring sosial-ekonomi demi memastikan tidak ada alumni yang merasa berjalan sendiri.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Card 3 --}}
                        <div class="mobile-card scroll-anim fade-in-up anim-delay-300 rounded-xl border border-gray-100 cursor-pointer overflow-hidden w-full"
                            style="background-image:url('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=600&q=80'); background-size:cover; background-position:center;"
                            onclick="toggleMobileCard(this)">
                            <div class="card-overlay-blur w-full px-4 pt-3 pb-3">
                                <div class="flex items-center justify-between min-h-[48px]">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-white/50 tracking-widest flex-shrink-0">03</span>
                                        <h3 class="text-xs font-bold text-white leading-snug">Penguatan Kapasitas Melalui Mentoring Lintas Generasi</h3>
                                    </div>
                                    <span class="mobile-chevron text-white/60 text-xs ml-3 flex-shrink-0">▼</span>
                                </div>
                                <div class="mobile-desc-wrap">
                                    <p class="mobile-desc text-white/80 leading-relaxed text-xs pt-2 pb-1">Mengorganisir skema pendampingan sistematis di mana alumni senior membimbing alumni junior dalam bidang akademik, organisasi, dan pengembangan diri.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Card 4 --}}
                        <div class="mobile-card scroll-anim fade-in-up anim-delay-100 rounded-xl border border-gray-100 cursor-pointer overflow-hidden w-full"
                            style="background-image:url('https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=600&q=80'); background-size:cover; background-position:center;"
                            onclick="toggleMobileCard(this)">
                            <div class="card-overlay-blur w-full px-4 pt-3 pb-3">
                                <div class="flex items-center justify-between min-h-[48px]">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-white/50 tracking-widest flex-shrink-0">04</span>
                                        <h3 class="text-xs font-bold text-white leading-snug">Pendampingan Transisi Fase Kehidupan</h3>
                                    </div>
                                    <span class="mobile-chevron text-white/60 text-xs ml-3 flex-shrink-0">▼</span>
                                </div>
                                <div class="mobile-desc-wrap">
                                    <p class="mobile-desc text-white/80 leading-relaxed text-xs pt-2 pb-1">Memberikan panduan strategis bagi pelajar menuju dunia perkuliahan, serta mendukung alumni muda dalam transisi menuju dunia profesional dan kehidupan berkeluarga.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Card 5 --}}
                        <div class="mobile-card scroll-anim fade-in-up anim-delay-200 rounded-xl border border-gray-100 cursor-pointer overflow-hidden w-full"
                            style="background-image:url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=80'); background-size:cover; background-position:center;"
                            onclick="toggleMobileCard(this)">
                            <div class="card-overlay-blur w-full px-4 pt-3 pb-3">
                                <div class="flex items-center justify-between min-h-[48px]">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-white/50 tracking-widest flex-shrink-0">05</span>
                                        <h3 class="text-xs font-bold text-white leading-snug">Membangun Ekosistem Kolaborasi yang Mandiri</h3>
                                    </div>
                                    <span class="mobile-chevron text-white/60 text-xs ml-3 flex-shrink-0">▼</span>
                                </div>
                                <div class="mobile-desc-wrap">
                                    <p class="mobile-desc text-white/80 leading-relaxed text-xs pt-2 pb-1">Menciptakan ruang bagi alumni untuk mengekspresikan karya dan memperkuat kemandirian finansial organisasi melalui jaringan kewirausahaan yang berkelanjutan.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Card 6 --}}
                        <div class="mobile-card scroll-anim fade-in-up anim-delay-300 rounded-xl border border-gray-100 cursor-pointer overflow-hidden w-full"
                            style="background-image:url('https://images.unsplash.com/photo-1543269865-cbf427effbad?w=600&q=80'); background-size:cover; background-position:center;"
                            onclick="toggleMobileCard(this)">
                            <div class="card-overlay-blur w-full px-4 pt-3 pb-3">
                                <div class="flex items-center justify-between min-h-[48px]">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-white/50 tracking-widest flex-shrink-0">06</span>
                                        <h3 class="text-xs font-bold text-white leading-snug">Sinergi Strategis dengan Almamater</h3>
                                    </div>
                                    <span class="mobile-chevron text-white/60 text-xs ml-3 flex-shrink-0">▼</span>
                                </div>
                                <div class="mobile-desc-wrap">
                                    <p class="mobile-desc text-white/80 leading-relaxed text-xs pt-2 pb-1">Menjaga keterhubungan organik dengan SMA IT Ihsanul Fikri sebagai perpanjangan tangan nilai-nilai sekolah di masyarakat luas.</p>
                                </div>
                            </div>
                        </div>

                    </div>{{-- end mobile stack --}}

                    {{-- ── DESKTOP: 2 Baris x 3 Accordion ── --}}
                    <div class="hidden md:flex flex-col gap-3 w-full">

                        {{-- Baris 1 --}}
                        <div class="accordion-group flex flex-row gap-3 h-[220px] w-full">

                            <div class="scroll-anim fade-in-up anim-delay-100 accordion-card flex-none rounded-xl border border-gray-100 cursor-pointer overflow-hidden"
                                 style="background-image:url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&q=80'); background-size:cover; background-position:center;">
                                <div class="card-overlay-blur h-full p-5 flex flex-col justify-between">
                                    <div class="card-number text-[10px] font-bold text-white/60 tracking-widest">01</div>
                                    <div>
                                        <h3 class="card-title text-sm font-bold text-white mb-2 leading-snug">Merawat Silaturahmi dan Identitas Kolektif</h3>
                                        <p class="card-desc text-white/80 leading-relaxed text-xs">Membangun kembali kepercayaan internal dan memperkuat citra organisasi melalui proses rebranding yang inklusif bagi seluruh angkatan.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="scroll-anim fade-in-up anim-delay-200 accordion-card flex-none rounded-xl border border-gray-100 cursor-pointer overflow-hidden"
                                 style="background-image:url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&q=80'); background-size:cover; background-position:center top;">
                                <div class="card-overlay-blur h-full p-5 flex flex-col justify-between">
                                    <div class="card-number text-[10px] font-bold text-white/60 tracking-widest">02</div>
                                    <div>
                                        <h3 class="card-title text-sm font-bold text-white mb-2 leading-snug">Menjadi Jembatan Pengetahuan dan Informasi</h3>
                                        <p class="card-desc text-white/80 leading-relaxed text-xs">Berperan sebagai fasilitator yang mengalirkan peluang karier, beasiswa, dan jejaring sosial-ekonomi demi memastikan tidak ada alumni yang merasa berjalan sendiri.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="scroll-anim fade-in-up anim-delay-300 accordion-card flex-none rounded-xl border border-gray-100 cursor-pointer overflow-hidden"
                                 style="background-image:url('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=600&q=80'); background-size:cover; background-position:center;">
                                <div class="card-overlay-blur h-full p-5 flex flex-col justify-between">
                                    <div class="card-number text-[10px] font-bold text-white/60 tracking-widest">03</div>
                                    <div>
                                        <h3 class="card-title text-sm font-bold text-white mb-2 leading-snug">Penguatan Kapasitas Melalui Mentoring Lintas Generasi</h3>
                                        <p class="card-desc text-white/80 leading-relaxed text-xs">Mengorganisir skema pendampingan sistematis di mana alumni senior membimbing alumni junior dalam bidang akademik, organisasi, dan pengembangan diri.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Baris 2 --}}
                        <div class="accordion-group flex flex-row gap-3 h-[220px] w-full">

                            <div class="scroll-anim fade-in-up anim-delay-100 accordion-card flex-none rounded-xl border border-gray-100 cursor-pointer overflow-hidden"
                                 style="background-image:url('https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=600&q=80'); background-size:cover; background-position:center;">
                                <div class="card-overlay-blur h-full p-5 flex flex-col justify-between">
                                    <div class="card-number text-[10px] font-bold text-white/60 tracking-widest">04</div>
                                    <div>
                                        <h3 class="card-title text-sm font-bold text-white mb-2 leading-snug">Pendampingan Transisi Fase Kehidupan</h3>
                                        <p class="card-desc text-white/80 leading-relaxed text-xs">Memberikan panduan strategis bagi pelajar menuju dunia perkuliahan, serta mendukung alumni muda dalam transisi menuju dunia profesional dan kehidupan berkeluarga.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="scroll-anim fade-in-up anim-delay-200 accordion-card flex-none rounded-xl border border-gray-100 cursor-pointer overflow-hidden"
                                 style="background-image:url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=80'); background-size:cover; background-position:center;">
                                <div class="card-overlay-blur h-full p-5 flex flex-col justify-between">
                                    <div class="card-number text-[10px] font-bold text-white/60 tracking-widest">05</div>
                                    <div>
                                        <h3 class="card-title text-sm font-bold text-white mb-2 leading-snug">Membangun Ekosistem Kolaborasi yang Mandiri</h3>
                                        <p class="card-desc text-white/80 leading-relaxed text-xs">Menciptakan ruang bagi alumni untuk mengekspresikan karya dan memperkuat kemandirian finansial organisasi melalui jaringan kewirausahaan yang berkelanjutan.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="scroll-anim fade-in-up anim-delay-300 accordion-card flex-none rounded-xl border border-gray-100 cursor-pointer overflow-hidden"
                                 style="background-image:url('https://images.unsplash.com/photo-1543269865-cbf427effbad?w=600&q=80'); background-size:cover; background-position:center;">
                                <div class="card-overlay-blur h-full p-5 flex flex-col justify-between">
                                    <div class="card-number text-[10px] font-bold text-white/60 tracking-widest">06</div>
                                    <div>
                                        <h3 class="card-title text-sm font-bold text-white mb-2 leading-snug">Sinergi Strategis dengan Almamater</h3>
                                        <p class="card-desc text-white/80 leading-relaxed text-xs">Menjaga keterhubungan organik dengan SMA IT Ihsanul Fikri sebagai perpanjangan tangan nilai-nilai sekolah di masyarakat luas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>{{-- end desktop accordion --}}

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
            .accordion-card {
                width: calc(33.333% - 8px);
                border-left: 3px solid transparent;
                transition: width 0.55s cubic-bezier(0.22, 1, 0.36, 1),
                            border-left-color 0.3s ease,
                            box-shadow 0.3s ease;
            }
            .accordion-group:hover .accordion-card {
                width: calc(18% - 6px);
            }
            .accordion-group .accordion-card:hover {
                width: calc(64% - 8px) !important;
                border-left-color: #F5C400 !important;
                box-shadow: 0 16px 48px -10px rgba(0,151,167,0.25);
            }
            .accordion-group:hover .card-desc {
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