<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\HonorableMention;
use App\Models\KarismatifProfile;
use App\Models\Mission;
use App\Models\News;
use App\Models\ProgramKerja;
use App\Models\ResponsiblePeople;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingPageSeeder001 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //? profile kabinet
        $profile = KarismatifProfile::create([
            'nama_kabinet' => 'Evolvere',
            'visi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus, a blandit ante sagittis. In congue ornare convallis. Donec condimentum accumsan ante, nec placerat quam euismod sit amet. Vestibulum viverra vulputate lorem sit amet aliquam. Nulla sit amet condimentum neque, quis efficitur libero. Vestibulum efficitur, lectus et pretium maximus, elit eros dictum mauris, sed dignissim turpis metus vitae libero. Vestibulum dapibus quam tortor, in efficitur nibh porta a.',
            'logo_path' => 'logos/karismatif-logo.png',
            'periode' => '2025/2026'
        ]);

        //? Misi 1
        $misi1 = Mission::create([
            'karismatif_profile_id' => $profile->id,
            'urutan' => 1,
            'nama_misi' => 'KARISMATIF selamatkan Dunia',
            'keterangan_misi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus, a blandit ante sagittis. In congue ornare convallis. Donec condimentum accumsan ante, nec placerat quam euismod sit amet. Vestibulum viverra vulputate lorem sit amet aliquam. Nulla sit amet condimentum neque, quis efficitur libero. Vestibulum efficitur, lectus et pretium maximus, elit eros dictum mauris, sed dignissim turpis metus vitae libero. Vestibulum dapibus quam tortor, in efficitur nibh porta a.'
        ]);

        //? Misi 2
        $misi2 = Mission::create([
            'karismatif_profile_id' => $profile->id,
            'urutan' => 2,
            'nama_misi' => 'KARISMATIF CONNECTION',
            'keterangan_misi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus, a blandit ante sagittis. In congue ornare convallis. Donec condimentum accumsan ante, nec placerat quam euismod sit amet. Vestibulum viverra vulputate lorem sit amet aliquam. Nulla sit amet condimentum neque, quis efficitur libero. Vestibulum efficitur, lectus et pretium maximus, elit eros dictum mauris, sed dignissim turpis metus vitae libero. Vestibulum dapibus quam tortor, in efficitur nibh porta a.'
        ]);

        //? Bidang 1
        $bidangHUMAS = Bidang::create([
            'nama_bidang' => 'HUMAS',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus, a blandit ante sagittis. In congue ornare convallis. Donec condimentum.'
        ]);

        //? Bidang 2
        $bidangPSDM = Bidang::create([
            'nama_bidang' => 'PSDM',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus, a blandit ante sagittis. In congue ornare convallis.'
        ]);

        //? Bidang 3
        $bidangKETUA = Bidang::create([
            'nama_bidang' => 'KOORDINATOR KARISMATIF',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus, a blandit ante sagittis. In congue ornare convallis.'
        ]);

        //? Responsible People 1
        $pengurus1 = ResponsiblePeople::create([
            'karismatif_profile_id' => $profile->id,
            'bidang_id' => $bidangKETUA->id,
            'nama_pengurus' => 'DEDE INDRASWARA',
            'nama_panggilan' => 'DEDE',
            'photo_profile_path' => 'photoProfiles/Dede indraswara.jpg'
        ]);

        //? Responsible People 2
        $pengurus2 = ResponsiblePeople::create([
            'karismatif_profile_id' => $profile->id,
            'bidang_id' => $bidangHUMAS->id,
            'nama_pengurus' => 'RASYID RIDHO',
            'nama_panggilan' => 'RASYID',
            'photo_profile_path' => 'photoProfiles/Rasyid Ridho.jpg'
        ]);

        //? proker 1
        ProgramKerja::create([
            'karismatif_profile_id' => $profile->id,
            'bidang_id' => $bidangHUMAS->id,
            'responsible_people_id' => $pengurus2->id,
            'mission_id' => $misi1->id,
            'nama_proker' => 'KARISMATIF WEBSITE',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus.',
            'photo_proker_path' => 'photoProker/web.png'
        ]);

        //? proker 2
        ProgramKerja::create([
            'karismatif_profile_id' => $profile->id,
            'bidang_id' => $bidangHUMAS->id,
            'responsible_people_id' => $pengurus2->id,
            'mission_id' => $misi2->id,
            'nama_proker' => 'KARISMATIF CONNECTION',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus.',
            'photo_proker_path' => 'photoProker/connection.png'
        ]);

        //? proker 3
        ProgramKerja::create([
            'karismatif_profile_id' => $profile->id,
            'bidang_id' => $bidangPSDM->id,
            'responsible_people_id' => $pengurus1->id,
            'mission_id' => $misi1->id,
            'nama_proker' => 'KARISMATIF TOGETHER',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus dui et felis finibus.',
            'photo_proker_path' => 'photoProker/together.png'
        ]);

        //? News
        News::create([
            'judul' => 'Peluncuran Website Karismatif 2026',
            'deskripsi' => 'Hari ini kabinet resmi meluncurkan portal berita dan sistem informasi organisasi.',
            'photo_thumbnail_path' => 'news/news-launching.png',
            'tanggal_kejadian' => now(),
            'sumber' => 'https://radarmagelang.jawapos.com/mungkid/687007325/pengurus-pusat-karismatif-dikukuhkan-membangun-ekosistem-kolaborasi-masa-depan?page=3#google_vignette',
            'isPublished' => true
        ]);

        //? honorable mentions
        HonorableMention::create([
            'nama' => 'Budi Santoso',
            'mention' => 'Ketua Teraktif Bulan Januari',
            'story' => 'Budi berhasil memimpin 3 proker sekaligus dalam sebulan.',
            'photo_appreciate_path' => 'awards/budi.jpg',
            'gallery_path' => json_encode(['gallery/1.jpg', 'gallery/2.jpg'])
        ]);
    }
}
