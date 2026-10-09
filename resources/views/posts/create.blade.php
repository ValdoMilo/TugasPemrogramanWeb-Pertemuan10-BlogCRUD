@extends('layouts.app')

@section('title', 'Tulis Artikel')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
            <a href="{{ route('posts.index') }}" class="hover:text-red-400 transition">Blog</a>
            <span>/</span>
            <span class="text-slate-300">Tulis Artikel</span>
        </div>

        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2">
                Tulis <span class="text-gradient-red">Artikel Baru</span>
            </h1>
            <p class="text-slate-400">Bagikan ide dan pengetahuanmu.</p>
        </div>

        <form method="POST"
              action="{{ route('posts.store') }}"
              enctype="multipart/form-data"
              class="card">
            @csrf

            <div class="space-y-5">
                <!-- Title -->
                <div>
                    <label for="title" class="form-label">
                        Judul Artikel <span class="text-red-400">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title') }}"
                           class="form-input @error('title') error @enderror"
                           placeholder="Contoh: Memulai Belajar Laravel dari Nol">
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="form-label">Ringkasan (opsional)</label>
                    <textarea id="excerpt"
                              name="excerpt"
                              rows="2"
                              class="form-input @error('excerpt') error @enderror"
                              placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Body -->
                <div>
                    <label for="body" class="form-label">
                        Isi Artikel <span class="text-red-400">*</span>
                    </label>
                    <textarea id="body"
                              name="body"
                              rows="10"
                              class="form-input @error('body') error @enderror"
                              placeholder="Tulis isi artikel di sini...">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Row: Category + Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="category" class="form-label">
                            Kategori <span class="text-red-400">*</span>
                        </label>
                        <input type="text"
                               id="category"
                               name="category"
                               value="{{ old('category', 'Umum') }}"
                               class="form-input @error('category') error @enderror"
                               placeholder="Contoh: Teknologi">
                        @error('category')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="form-label">
                            Status <span class="text-red-400">*</span>
                        </label>
                        <select id="status"
                                name="status"
                                class="form-input @error('status') error @enderror">
                            <option value="draft" @selected(old('status') === 'draft')>
                                Draft (belum publish)
                            </option>
                            <option value="published" @selected(old('status') === 'published')>
                                Published (tayang)
                            </option>
                        </select>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="form-label">Gambar Sampul (opsional)</label>
                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/*"
                           class="form-input @error('image') error @enderror">
                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-slate-700/50">
                <button type="submit" class="btn-primary">
                    <span>💾</span> Simpan Artikel
                </button>
                <a href="{{ route('posts.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection