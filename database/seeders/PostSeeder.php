<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();

        $posts = [
            [
                'title' => 'Pengenalan Laravel untuk Pemula: Kenapa Harus Laravel?',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=800&q=80',
                'excerpt' => 'Laravel adalah framework PHP paling populer saat ini. Pelajari kenapa Laravel jadi pilihan utama developer dalam membangun aplikasi web modern.',
                'body' => 'Laravel adalah framework PHP open-source yang dirancang untuk mempermudah pengembangan aplikasi web modern. Sejak pertama kali dirilis oleh Taylor Otwell pada tahun 2011, Laravel terus berkembang menjadi framework paling populer di ekosistem PHP.

Beberapa alasan mengapa Laravel layak dipelajari:

1. Sintaks yang Ekspresif dan Elegan
Laravel menawarkan sintaks yang bersih dan mudah dibaca. Hal ini membuat kode lebih mudah dipahami dan dipelihara dalam jangka panjang.

2. Fitur Bawaan yang Lengkap
Laravel sudah menyediakan banyak fitur siap pakai seperti routing, ORM (Eloquent), authentication, queue, dan masih banyak lagi. Kita tidak perlu membangun semuanya dari nol.

3. Ekosistem yang Matang
Ada ribuan package di Packagist yang bisa langsung diintegrasikan ke project Laravel. Dari admin panel, API, hingga integrasi payment gateway, semuanya tersedia.

4. Komunitas Aktif
Komunitas Laravel sangat besar dan aktif. Kalau menemui masalah, biasanya sudah ada yang membahasnya di forum atau GitHub.

5. Dokumentasi Terbaik
Dokumentasi resmi Laravel sangat lengkap dan terstruktur. Pemula pun bisa mengikuti dengan mudah.

Kesimpulan: Kalau kamu ingin belajar web development dengan PHP, Laravel adalah pilihan yang sangat tepat.',
            ],
            [
                'title' => 'Memahami MVC di Laravel: Konsep Dasar yang Wajib Dikuasai',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=800&q=80',
                'excerpt' => 'MVC (Model-View-Controller) adalah pola arsitektur yang membagi aplikasi menjadi tiga komponen utama. Yuk pahami cara kerjanya di Laravel.',
                'body' => 'MVC (Model-View-Controller) adalah pola arsitektur yang memisahkan aplikasi menjadi tiga komponen utama yang saling berinteraksi. Di Laravel, konsep ini diterapkan dengan sangat rapi.

1. Model
Model bertanggung jawab untuk mengelola data. Di Laravel, model biasanya berhubungan dengan tabel database menggunakan Eloquent ORM. Contoh: model User untuk tabel users.

2. View
View adalah tampilan yang dilihat oleh user. Di Laravel kita menggunakan Blade template engine untuk membuat view. Blade memungkinkan kita menulis HTML dengan tambahan sintaks dinamis.

3. Controller
Controller adalah jembatan antara Model dan View. Controller menerima request dari user, memproses data melalui Model, lalu mengirim hasilnya ke View untuk ditampilkan.

Alur Kerja:
User -> Route -> Controller -> Model -> Controller -> View -> User

Contoh Sederhana:
Route::get(\'/posts\', [PostController::class, \'index\']);

Saat user mengakses /posts, Laravel akan memanggil method index() di PostController. Method tersebut mengambil data dari Post model, lalu mengirimnya ke view posts.index.

Dengan memahami MVC, kode kamu akan lebih terstruktur dan mudah di-maintain.',
            ],
            [
                'title' => 'Route dan Controller di Laravel: Panduan Lengkap',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&q=80',
                'excerpt' => 'Route adalah pintu masuk aplikasi Laravel. Pelajari cara membuat route, resource route, dan mengaitkannya dengan controller.',
                'body' => 'Route di Laravel adalah cara untuk mendefinisikan URL apa saja yang bisa diakses oleh user, dan aksi apa yang harus dijalankan.

1. Route Dasar
Route::get(\'/halo\', function () {
    return \'Halo Dunia!\';
});

2. Route ke Controller
Route::get(\'/posts\', [PostController::class, \'index\']);

3. Route dengan Parameter
Route::get(\'/posts/{id}\', [PostController::class, \'show\']);

4. Resource Route
Ini yang paling sering dipakai. Resource route otomatis membuat 7 route untuk operasi CRUD:

Route::resource(\'posts\', PostController::class);

Route yang terbentuk:
- GET /posts -> index
- GET /posts/create -> create
- POST /posts -> store
- GET /posts/{post} -> show
- GET /posts/{post}/edit -> edit
- PUT /posts/{post} -> update
- DELETE /posts/{post} -> destroy

5. Route Model Binding
Laravel bisa otomatis mencari model berdasarkan ID di URL:

public function show(Post $post)
{
    return view(\'posts.show\', compact(\'post\'));
}

Dengan Route Model Binding, kita tidak perlu lagi query manual.

Route adalah fondasi aplikasi Laravel. Semakin paham route, semakin mudah membangun aplikasi yang kompleks.',
            ],
            [
                'title' => 'Eloquent ORM: Cara Mudah Berinteraksi dengan Database',
                'category' => 'Database',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800&q=80',
                'excerpt' => 'Eloquent adalah ORM bawaan Laravel yang membuat interaksi dengan database jadi lebih menyenangkan. Pelajari dasar-dasarnya di sini.',
                'body' => 'Eloquent adalah ORM (Object-Relational Mapping) bawaan Laravel. Dengan Eloquent, kita bisa berinteraksi dengan database menggunakan sintaks PHP yang elegan, tanpa perlu menulis query SQL manual.

1. Membuat Model
php artisan make:model Post -m

2. Query Dasar
- Ambil semua: Post::all();
- Ambil berdasarkan ID: Post::find(1);
- Filter dengan where: Post::where(\'status\', \'published\')->get();

3. Create Data
Post::create([
    \'title\' => \'Judul Artikel\',
    \'body\' => \'Isi artikel...\',
]);

4. Update Data
$post = Post::find(1);
$post->update([\'title\' => \'Judul Baru\']);

5. Delete Data
$post->delete();

6. Relationship
Satu post punya banyak comment:
public function comments()
{
    return $this->hasMany(Comment::class);
}

Kemudian bisa diakses dengan: $post->comments;

Eloquent membuat kode kita lebih ringkas dan mudah dibaca. Kalau biasanya butuh 10 baris SQL, dengan Eloquent bisa jadi 1 baris saja.',
            ],
            [
                'title' => 'Blade Template Engine: Tampilan Dinamis Tanpa Ribet',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?w=800&q=80',
                'excerpt' => 'Blade adalah template engine Laravel yang powerful. Pelajari directives, layout, component, dan berbagai fitur menariknya.',
                'body' => 'Blade adalah template engine bawaan Laravel yang memungkinkan kita menulis HTML dengan tambahan sintaks dinamis. File Blade disimpan dengan ekstensi .blade.php.

1. Menampilkan Data
Gunakan kurung kurawal ganda: {{ $nama }}

2. Kondisi
@if ($status === \'published\')
    <span>Published</span>
@else
    <span>Draft</span>
@endif

3. Loop
@foreach ($posts as $post)
    <h3>{{ $post->title }}</h3>
@endforeach

4. Layout Master
Buat file layouts/app.blade.php yang berisi HTML dasar. Di view anak, gunakan @extends(\'layouts.app\') dan @section(\'content\') ... @endsection.

5. Component
Buat components/alert.blade.php berisi markup alert. Pakai dengan tag <x-alert message="Berhasil disimpan!" />

6. Escaping
{{ $variable }} -> otomatis di-escape (aman untuk user input)
{!! $html !!} -> tidak di-escape (hati-hati!)

Blade membuat view kita rapi, reusable, dan mudah di-maintain.',
            ],
            [
                'title' => 'Memahami Migration dan Seeder di Laravel',
                'category' => 'Database',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&q=80',
                'excerpt' => 'Migration adalah version control untuk database. Seeder mengisi data dummy. Pelajari cara pakainya di sini.',
                'body' => 'Migration dan Seeder adalah dua fitur penting Laravel untuk mengelola database.

1. Migration
Migration adalah file PHP yang mendefinisikan struktur tabel. Dengan migration, kita tidak perlu lagi bikin tabel manual di phpMyAdmin.

Perintah: php artisan make:migration create_posts_table

Isi migration menggunakan Schema::create untuk mendefinisikan kolom-kolom tabel.

Jalankan dengan: php artisan migrate

2. Rollback
Batalkan migration terakhir: php artisan migrate:rollback
Reset semua: php artisan migrate:fresh

3. Seeder
Seeder digunakan untuk mengisi data awal atau data dummy.

Perintah: php artisan make:seeder PostSeeder

Isi seeder dengan Post::create([...]) untuk setiap data yang ingin dimasukkan.

Jalankan dengan: php artisan db:seed

4. Factory
Untuk generate data dummy dalam jumlah banyak, gunakan: Post::factory()->count(50)->create();

Kesimpulan: Migration dan seeder membuat setup database jadi konsisten di semua environment.',
            ],
            [
                'title' => 'Cara Validasi Input di Laravel yang Aman',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&q=80',
                'excerpt' => 'Validasi input wajib dilakukan agar data yang masuk ke aplikasi tetap bersih dan aman. Pelajari cara validasi di Laravel.',
                'body' => 'Validasi input adalah langkah wajib dalam membangun aplikasi web yang aman. Laravel menyediakan validator yang sangat powerful.

1. Validasi di Controller
Gunakan $request->validate([...]) di dalam method controller. Contoh rules: \'title\' => \'required|string|max:200\'.

2. Custom Message
Tambahkan array message sebagai parameter kedua:
$request->validate([
    \'title\' => \'required|max:200\',
], [
    \'title.required\' => \'Judul wajib diisi.\',
    \'title.max\' => \'Judul maksimal 200 karakter.\',
]);

3. Rule Lanjutan
- Rule::in([\'draft\', \'published\']) untuk enum
- \'nullable|image|max:2048\' untuk upload file
- \'required|min:8|confirmed\' untuk password

4. Menampilkan Error di View
Gunakan @error(\'title\') ... @enderror untuk menampilkan pesan error di bawah field.

5. Old Input
Supaya input tetap ada kalau validasi gagal, gunakan old(\'title\') di attribute value.

Dengan validasi yang baik, aplikasi kita terlindungi dari input yang tidak diinginkan.',
            ],
            [
                'title' => 'Route Model Binding: Kode Lebih Rapi dan Bersih',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=800&q=80',
                'excerpt' => 'Route Model Binding memungkinkan kita langsung mendapatkan model dari URL tanpa query manual. Fitur kecil tapi sangat berguna.',
                'body' => 'Route Model Binding adalah fitur Laravel yang memungkinkan kita mendapatkan instance model langsung dari parameter URL.

Tanpa Route Model Binding:
Route::get(\'/posts/{id}\', function ($id) {
    $post = Post::findOrFail($id);
    return view(\'posts.show\', compact(\'post\'));
});

Dengan Route Model Binding:
Route::get(\'/posts/{post}\', function (Post $post) {
    return view(\'posts.show\', compact(\'post\'));
});

Lebih Bersih Bukan?

Cara Kerja:
Laravel otomatis mencocokkan nama parameter di route dengan nama variable di closure/controller. Kalau cocok, Laravel akan query model berdasarkan ID.

Di Controller:
public function show(Post $post)
{
    return view(\'posts.show\', compact(\'post\'));
}

Custom Key:
Kalau mau pakai slug bukan ID, tambahkan method getRouteKeyName() di model Post yang mengembalikan \'slug\'.

Route Model Binding bisa menghemat banyak baris kode.',
            ],
            [
                'title' => 'Tips Belajar Laravel untuk Mahasiswa Pemula',
                'category' => 'Tips',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80',
                'excerpt' => 'Belajar Laravel memang menantang di awal. Berikut tips praktis supaya proses belajar jadi lebih efektif dan menyenangkan.',
                'body' => 'Belajar Laravel sebagai mahasiswa bisa jadi tantangan tersendiri. Berikut tips praktis dari pengalaman pribadi:

1. Kuasai PHP Dulu
Sebelum masuk Laravel, pastikan dasar PHP sudah kuat. Pahami OOP (Object Oriented Programming), array, function, dan namespace.

2. Ikuti Dokumentasi Resmi
Dokumentasi Laravel di laravel.com/docs sangat lengkap. Biasakan baca dokumentasi daripada langsung cari tutorial di YouTube.

3. Praktik Langsung
Setelah baca teori, langsung praktikkan. Bikin project kecil seperti blog sederhana, todo list, atau CRUD.

4. Pahami MVC
Konsep MVC adalah fondasi Laravel. Kalau bingung, ulangi sampai paham.

5. Jangan Takut Error
Error adalah guru terbaik. Setiap error yang berhasil di-fix akan menambah pemahaman.

6. Ikut Komunitas
Join grup Telegram, Discord, atau forum Laravel Indonesia.

7. Bangun Portofolio
Setiap project yang selesai, upload ke GitHub.

8. Konsisten
Belajar 1 jam setiap hari lebih baik daripada 10 jam sekali seminggu.

Selamat belajar, dan semoga sukses!',
            ],
            [
                'title' => 'Git dan GitHub untuk Developer Pemula',
                'category' => 'Tools',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=800&q=80',
                'excerpt' => 'Git adalah version control yang wajib dikuasai setiap developer. Pelajari perintah dasar Git dan cara pakai GitHub.',
                'body' => 'Git adalah sistem version control yang digunakan hampir semua developer di dunia. Dengan Git, kita bisa melacak setiap perubahan kode, kembali ke versi sebelumnya, dan berkolaborasi dengan tim.

1. Install Git
Download dari git-scm.com, install, lalu cek dengan perintah: git --version

2. Konfigurasi Awal
git config --global user.name "Nama Kamu"
git config --global user.email "email@example.com"

3. Perintah Dasar
- git init: inisialisasi repository
- git status: cek status
- git add .: tambah semua file ke staging
- git commit -m "Pesan commit": commit
- git log --oneline: lihat history

4. Remote ke GitHub
- git clone URL: clone repo
- git remote add origin URL: tambah remote
- git push -u origin main: push
- git pull origin main: pull

5. Branching
- git branch fitur-baru: buat branch
- git checkout fitur-baru: pindah branch
- git merge fitur-baru: merge

Tips: Biasakan commit kecil-kecil dengan pesan yang jelas.',
            ],
            [
                'title' => 'Mengenal Tailwind CSS: Utility-First Framework',
                'category' => 'CSS',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1507721999472-8ed4421c4af2?w=800&q=80',
                'excerpt' => 'Tailwind CSS mengubah cara kita menulis CSS. Pelajari kenapa banyak developer beralih ke Tailwind.',
                'body' => 'Tailwind CSS adalah framework CSS yang mengusung pendekatan utility-first. Artinya, kita menulis style langsung di HTML menggunakan class-class kecil yang spesifik.

Contoh:
<div class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
    Tombol
</div>

Kelebihan:
1. Tidak perlu bikin file CSS terpisah
2. Tidak ada naming class yang membingungkan
3. Konsisten karena pakai skala yang sudah ditentukan
4. Bisa langsung pakai tanpa build tool (via CDN)

Kekurangan:
1. HTML jadi terlihat "kotor" dengan banyak class
2. Butuh waktu untuk hafal nama-nama utility

Tips Belajar:
1. Mulai dari CDN dulu supaya cepat
2. Hafal utility yang sering dipakai: p-, m-, text-, bg-, flex, grid
3. Pakai VS Code extension Tailwind CSS IntelliSense
4. Baru migrasi ke build tool (Vite) kalau sudah nyaman

Kesimpulan: Tailwind CSS sangat cocok untuk developer yang ingin cepat membuat UI.',
            ],
            [
                'title' => 'Soft Delete di Laravel: Hapus Data Tanpa Benar-Benar Hilang',
                'category' => 'Database',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1591405351990-4726e331f141?w=800&q=80',
                'excerpt' => 'Soft delete memungkinkan kita "menghapus" data tanpa benar-benar menghapusnya dari database. Pelajari cara pakainya.',
                'body' => 'Soft delete adalah fitur yang memungkinkan kita menghapus data tanpa benar-benar menghapusnya dari database. Data tersebut hanya ditandai sebagai terhapus.

Kenapa Soft Delete?
- Data bisa dipulihkan kalau salah hapus
- History tetap terjaga
- Lebih aman untuk aplikasi production

Cara Pakai di Laravel:
1. Tambah kolom deleted_at di migration menggunakan $table->softDeletes();

2. Tambah trait di model:
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model { use SoftDeletes; }

3. Cara pakai:
- Soft delete: $post->delete();
- Lihat data yang terhapus: Post::withTrashed()->get();
- Hanya data yang terhapus: Post::onlyTrashed()->get();
- Pulihkan: $post->restore();
- Hapus permanen: $post->forceDelete();

Dengan soft delete, kita punya "jaring pengaman" kalau ada kesalahan hapus data.',
            ],
            [
                'title' => 'Cara Membuat REST API Sederhana dengan Laravel',
                'category' => 'Laravel',
                'status' => 'published',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&q=80',
                'excerpt' => 'Laravel memudahkan pembuatan REST API. Pelajari dasar-dasar API dan cara membuatnya di Laravel.',
                'body' => 'REST API adalah standar komunikasi antar aplikasi yang paling banyak dipakai saat ini. Laravel menyediakan tools lengkap untuk membuat API.

1. Buat API Route
Di routes/api.php, gunakan Route::apiResource(\'posts\', PostController::class);

Ini otomatis membuat 5 route:
- GET /api/posts -> index
- POST /api/posts -> store
- GET /api/posts/{id} -> show
- PUT /api/posts/{id} -> update
- DELETE /api/posts/{id} -> destroy

2. Return JSON
Gunakan return response()->json([\'status\' => \'success\', \'data\' => Post::all()]);
Atau lebih singkat: return Post::all();

3. Validasi
Gunakan $request->validate([\'title\' => \'required\', \'body\' => \'required\']);

4. Status Code
- 200: OK
- 201: Created
- 204: No Content
- 400: Bad Request
- 401: Unauthorized
- 404: Not Found

5. Authentication
Laravel Sanctum memudahkan auth untuk SPA dan mobile app.

6. Rate Limiting
Gunakan middleware throttle:60,1 untuk membatasi request.

Dengan Laravel, membuat REST API jadi jauh lebih mudah.',
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']) . '-' . uniqid(),
                'category' => $post['category'],
                'status' => $post['status'],
                'excerpt' => $post['excerpt'],
                'body' => $post['body'],
                'image' => $post['image'],
            ]);
        }
    }
}