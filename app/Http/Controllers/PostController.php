<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    // 1. INDEX - List + Search + Pagination
    public function index(Request $request)
    {
        $query = Post::query();

        // Bonus: pencarian
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $posts = $query->latest()->paginate(8)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    // 2. CREATE - Form tambah
    public function create()
    {
        return view('posts.create');
    }

    // 3. STORE - Simpan data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'min:5', 'max:200'],
            'excerpt'  => ['nullable', 'string', 'max:500'],
            'body'     => ['required', 'string', 'min:20'],
            'category' => ['required', 'string', 'max:50'],
            'status'   => ['required', Rule::in(['draft', 'published'])],
            'image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'title.min'         => 'Judul minimal 5 karakter.',
            'body.required'     => 'Isi artikel wajib diisi.',
            'body.min'          => 'Isi artikel minimal 20 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'status.required'   => 'Status wajib dipilih.',
            'image.image'       => 'File harus berupa gambar.',
            'image.max'         => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        // Bonus: upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    // 4. SHOW - Detail (Route Model Binding)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. EDIT - Form edit (Route Model Binding)
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6. UPDATE - Simpan perubahan (Route Model Binding)
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'min:5', 'max:200'],
            'excerpt'  => ['nullable', 'string', 'max:500'],
            'body'     => ['required', 'string', 'min:20'],
            'category' => ['required', 'string', 'max:50'],
            'status'   => ['required', Rule::in(['draft', 'published'])],
            'image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'title.min'         => 'Judul minimal 5 karakter.',
            'body.required'     => 'Isi artikel wajib diisi.',
            'body.min'          => 'Isi artikel minimal 20 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'status.required'   => 'Status wajib dipilih.',
        ]);

        // Update slug kalau judul berubah
        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        // Bonus: ganti gambar
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    // 7. DESTROY - Hapus (soft delete)
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete(); // soft delete

        return redirect()
            ->route('posts.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}