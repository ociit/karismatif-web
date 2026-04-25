<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Karismatif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        html {
            scrollbar-gutter: stable;
        }
        
        ::-webkit-scrollbar {
            width: 8px;
            display: none;  /* to hide scrollbar so the video caraousel looks more clean */
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div id="preloader" class="fixed inset-0 z-[100] flex flex-col justify-center items-center overflow-hidden bg-transparent">
        <div class="panel fixed inset-0 z-[-1] flex">
            <div class="panel-col w-1/3 h-full bg-white border-r border-gray-100"></div>
            <div class="panel-col w-1/3 h-full bg-white border-r border-gray-100"></div>
            <div class="panel-col w-1/3 h-full bg-white"></div>
        </div>

        <div id="loader-content" class="flex flex-col items-center">
            <div id="progress-text" class="text-6xl font-black mb-4 text-blue-600">0%</div>
            <div class="w-64 h-2 bg-gray-200 rounded-full overflow-hidden">
                <div id="progress-bar" class="w-0 h-full bg-blue-600"></div>
            </div>
            <p class="mt-4 animate-pulse uppercase tracking-widest font-semibold text-blue-600 text-sm">Loading Karismatif website..</p>
        </div>
    </div>

    <header class="relative h-screen flex flex-col justify-center items-center text-white p-6 overflow-hidden">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-[-2]">
            <source src="{{ asset('assets/video/PPkarismatif_video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 bg-black/40 z-[-1]"></div>

        @if($currentCabinet)
            <h1 class="text-5xl font-bold mb-4 text-center" id="title">{{ $currentCabinet->nama_kabinet }}</h1>
            <p class="text-xl italic opacity-90 mx-5 text-center max-w-2xl" id="motto">"{{ $currentCabinet->visi }}"</p>
        @else
            <h1 class="text-4xl font-bold">Selamat Datang di Karismatif</h1>
        @endif
        
    </header>

    <section class="py-20 px-10">
        <h2 class="text-3xl font-bold text-center mb-10">Misi Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if($currentCabinet)
                @foreach($currentCabinet->missions as $misi)
                    <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
                        <h3 class="font-bold text-lg mb-2">Misi Ke-{{ $misi->urutan }}</h3>
                        <p>{{ $misi->nama_misi }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section class="bg-gray-100 py-20 px-10">
        <h2 class="text-3xl font-bold text-center mb-10">Berita Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                    <img src="/storage/{{ $item->photo_thumbnail_path }}" alt="News" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-xl mb-2">{{ $item->judul }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                        <a href="{{ $item->sumber }}" class="text-blue-500 font-semibold">Baca Selengkapnya →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if ('scrollRestoration' in history) { history.scrollRestoration = 'manual'; }
            document.body.classList.add('overflow-hidden');
            window.scrollTo(0, 0);

            // 1. Buat Timeline
            const tl = gsap.timeline({ paused: true });

            // Definisikan urutan (Pastikan ID & Class ini ada di HTML kamu!)
            tl.to("#loader-content", { opacity: 0, duration: 0.3 })
            .to(".panel-col", {
                y: "-100%",
                duration: 1.2,
                ease: "expo.inOut",
                stagger: 0.15,
                onStart: () => console.log("Animasi kolom dimulai..."),
                onComplete: function() {
                    document.getElementById("preloader").style.display = "none";
                    document.body.classList.remove('overflow-hidden');
                    console.log("Animasi selesai, scroll dibuka.");
                }
            })
            .from("#title", { duration: 1.2, y: 100, opacity: 0, ease: "power4.out" }, "-=0.8")
            .from("#motto", { duration: 1, y: 30, opacity: 0 }, "-=1");

            // 2. Logika Loading
            let count = { val: 0 };
            const minTime = new Promise(resolve => setTimeout(resolve, 2000));
            const assets = new Promise(resolve => {
                if (document.readyState === 'complete') resolve();
                else window.addEventListener('load', resolve);
            });

            // Simulasi angka
            gsap.to(count, {
                val: 90,
                duration: 2,
                onUpdate: () => {
                    document.getElementById("progress-text").innerText = Math.floor(count.val) + "%";
                    document.getElementById("progress-bar").style.width = count.val + "%";
                }
            });

            Promise.all([minTime, assets]).then(() => {
                console.log("Aset siap, menuju 100%...");
                gsap.to(count, {
                    val: 100,
                    duration: 0.5,
                    onUpdate: () => {
                        document.getElementById("progress-text").innerText = "100%";
                        document.getElementById("progress-bar").style.width = "100%";
                    },
                    onComplete: () => {
                        console.log("Memainkan timeline utama!");
                        tl.play(); // Jalankan animasi panel & hero
                    }
                });
            });
        });
    </script>
</body>
</html>