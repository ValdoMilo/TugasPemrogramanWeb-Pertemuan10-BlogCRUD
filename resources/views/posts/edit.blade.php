@extends('layouts.app')

@section('title', 'Edit: ' . $post->title)

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
            <a href="{{ route('posts.index') }}" class="hover:text-red-400 transition">Blog</a>
            <span>/</span>
            <a href="{{ route('posts.show', $post) }}" class="hover:text-red-400 transition truncate max-w-[200px]">
                {{ $post->title }}
            </a>
            <span>/</span>
            <span class="text-slate-300">Edit</span>
        </div>

        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2">
                Edit <span class="text-gradient-red">Artikel</span>
            </h1>
            <p class="text-slate-400">Perbarui artikel Anda di bawah ini.</p>
        </div>

        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="card">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label for="title" class="form-label">Judul Artikel <span class="text-red-400">*</span></label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $post->title) }}"
                           class="form-input @error('title') error @enderror">
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="form-label">Ringkasan</label>
                    <textarea id="excerpt" name="excerpt" rows="2"
                              class="form-input @error('excerpt') error @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="form-label">Isi Artikel <span class="text-red-400">*</span></label>
                    <textarea id="body" name="body" rows="10"
                              class="form-input @error('body') error @enderror">{{ old('body', $post->body) }}</textarea>
                    @error('body')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="category" class="form-label">Kategori <span class="text-red-400">*</span></label>
                        <input type="text" id="category" name="category"
                               value="{{ old('category', $post->category) }}"
                               class="form-input @error('category') error @enderror">
                        @error('category')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="form-label">Status <span class="text-red-400">*</span></label>
                        <select id="status" name="status" class="form-input @error('status') error @enderror">
                            <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $post->status) === 'published')>Published</option>
                        </select>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current image -->
                @@if ($post->image_url)
    <div>
        <label class="form-label">Gambar Saat Ini</label>
        <img src="{{ $post->image_url }}" alt="Current"
             class="w-full h-48 object-cover rounded-xl border border-slate-700/50">
    </div>
@endif

                <div>
                    <label for="image" class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="form-input @error('image') error @enderror">
                    <p class="text-xs text-slate-500 mt-1">Biarkan kosong jika tidak ingin mengganti.</p>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-700/50">
                <button type="submit" class="btn-primary">
                    <span>💾</span> Simpan Perubahan
                </button>
                <a href="{{ route('posts.show', $post) }}" class="btn-ghost">Batal</a>

                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                      class="ml-auto" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger btn-sm">
                        🗑 Hapus
                    </button>
                </form>
            </div>
        </form>
    </div>
@endsection