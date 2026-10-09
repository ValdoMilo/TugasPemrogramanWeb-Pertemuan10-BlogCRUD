@extends('layouts.app')

@section('title', 'Semua Artikel')

@section('content')
    <!-- Header -->
    <div class="mb-10">
        <span class="text-xs font-bold uppercase tracking-widest text-red-400 mb-3 block">Blog</span>
        <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-4">
            Semua <span class="text-gradient-red">Artikel</span>
        </h1>
        <p class="text-slate-400 max-w-2xl">
            Kumpulan tulisan, tutorial, dan catatan belajar seputar web development.
        </p>
    </div>

    <!-- Toolbar: Search + Filter + Create (1 baris rapi) -->
    <div class="card mb-8" style="padding: 16px;">
        <form method="GET" action="{{ route('posts.index') }}"
              class="flex flex-col md:flex-row gap-3 items-stretch">

            <!-- Search -->
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-input" placeholder="🔍 Cari judul artikel, kategori, atau isi...">
            </div>

            <!-- Filter Status -->
            <div class="md:w-48">
                <select name="status" class="form-input">
                    <option value="">📋 Semua Status</option>
                    <option value="published" @selected(request('status') === 'published')>✓ Published</option>
                    <option value="draft" @selected(request('status') === 'draft')>✎ Draft</option>
                </select>
            </div>

            <!-- Tombol Cari -->
            <button type="submit" class="btn-ghost btn-sm">Cari</button>

            @if (request('search') || request('status'))
                <a href="{{ route('posts.index') }}" class="btn-ghost btn-sm">Reset</a>
            @endif

            <!-- Divider -->
            <div class="hidden md:block w-px bg-slate-700/50 mx-1"></div>

            <!-- Tombol Tulis (cuma 1) -->
            <a href="{{ route('posts.create') }}" class="btn-primary">
                <span class="text-lg leading-none">+</span> Tulis Artikel
            </a>
        </form>
    </div>

    <!-- Info hasil -->
    @if (request('search') || request('status'))
        <div class="mb-6 text-sm text-slate-400">
            Menampilkan <strong class="text-white">{{ $posts->total() }}</strong> hasil
            @if (request('search'))
                untuk "<strong class="text-red-400">{{ request('search') }}</strong>"
            @endif
            @if (request('status'))
                dengan status <strong class="text-red-400">{{ request('status') }}</strong>
            @endif
        </div>
    @endif

    <!-- Posts Grid -->
    @if ($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($posts as $post)
                <x-card :hover="true">
                    <!-- Placeholder -->
                    @if ($post->image_url)
    <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
         class="w-full h-40 object-cover rounded-xl mb-4"
         loading="lazy">
@else
    <div class="w-full h-40 rounded-xl mb-4 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center border border-slate-700/50">
        <span class="text-4xl opacity-40">📝</span>
    </div>
@endif

                    <!-- Meta -->
                    <div class="flex items-center gap-2 mb-3 flex-wrap">
                        <span class="badge bg-red-500/10 text-red-400 border-red-500/30">
                            {{ $post->category }}
                        </span>
                        <span class="badge {{ $post->status_badge }} border">
                            {{ $post->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-base font-bold text-white leading-snug mb-2 line-clamp-2">
                        <a href="{{ route('posts.show', $post) }}" class="hover:text-red-400 transition">
                            {{ $post->title }}
                        </a>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-sm text-slate-400 leading-relaxed line-clamp-3 mb-4">
                        {{ $post->excerpt }}
                    </p>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-700/50">
                        <span class="text-xs text-slate-500 font-mono">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('posts.edit', $post) }}"
                               class="text-xs text-slate-400 hover:text-red-400 transition">Edit</a>
                            <span class="text-slate-700">·</span>
                            <a href="{{ route('posts.show', $post) }}"
                               class="text-xs text-red-400 hover:underline">Baca →</a>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    @else
        <x-card :hover="false" padding="p-12">
            <div class="text-center">
                <div class="text-5xl mb-4 opacity-40">📭</div>
                <h3 class="text-lg font-bold mb-2">Belum ada artikel</h3>
                <p class="text-slate-400 text-sm mb-6">
                    @if (request('search') || request('status'))
                        Tidak ada artikel yang cocok dengan filter Anda.
                    @else
                        Mulai tulis artikel pertama Anda.
                    @endif
                </p>
                <a href="{{ route('posts.create') }}" class="btn-primary">+ Tulis Artikel</a>
            </div>
        </x-card>
    @endif
@endsection