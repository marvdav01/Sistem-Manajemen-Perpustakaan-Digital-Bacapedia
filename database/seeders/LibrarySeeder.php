<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Support\Str;

class LibrarySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Fiksi',
            'Sains & Teknologi',
            'Sejarah',
            'Pengembangan Diri',
            'Bisnis & Ekonomi',
            'Biografi',
            'Seni & Desain'
        ];

        $categoryIds = [];

        foreach ($categories as $cat) {
            $kategori = Kategori::firstOrCreate(['nama_kategori' => $cat]);
            $categoryIds[$cat] = $kategori->id;
        }

        $books = [
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori' => 'Fiksi',
                'stok' => 15
            ],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => 1980,
                'kategori' => 'Fiksi',
                'stok' => 10
            ],
            [
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'KPG',
                'tahun_terbit' => 2011,
                'kategori' => 'Sejarah',
                'stok' => 20
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2018,
                'kategori' => 'Pengembangan Diri',
                'stok' => 25
            ],
            [
                'judul' => 'The Lean Startup',
                'penulis' => 'Eric Ries',
                'penerbit' => 'Crown Business',
                'tahun_terbit' => 2011,
                'kategori' => 'Bisnis & Ekonomi',
                'stok' => 12
            ],
            [
                'judul' => 'Steve Jobs',
                'penulis' => 'Walter Isaacson',
                'penerbit' => 'Simon & Schuster',
                'tahun_terbit' => 2011,
                'kategori' => 'Biografi',
                'stok' => 8
            ],
            [
                'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'kategori' => 'Sains & Teknologi',
                'stok' => 30
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas Ilmu',
                'tahun_terbit' => 2018,
                'kategori' => 'Pengembangan Diri',
                'stok' => 18
            ],
            [
                'judul' => 'Design of Everyday Things',
                'penulis' => 'Don Norman',
                'penerbit' => 'Basic Books',
                'tahun_terbit' => 2013,
                'kategori' => 'Seni & Desain',
                'stok' => 5
            ]
        ];

        foreach ($books as $bookData) {
            Buku::firstOrCreate(
                ['judul' => $bookData['judul']],
                [
                    'buku_id' => Str::uuid()->toString(),
                    'penulis' => $bookData['penulis'],
                    'penerbit' => $bookData['penerbit'],
                    'tahun_terbit' => $bookData['tahun_terbit'],
                    'kategori_id' => $categoryIds[$bookData['kategori']],
                    'stok' => $bookData['stok']
                ]
            );
        }
    }
}
