@if ($paginator->hasPages())
    <nav class="flex items-center justify-between gap-3 flex-wrap">
        <div class="text-xs text-slate-500">
            Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
            dari {{ $paginator->total() }} artikel
        </div>

        <div class="flex items-center gap-1">
            {{-- Prev --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-slate-600 rounded-lg border border-slate-800 text-sm">←</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-3 py-2 text-slate-300 rounded-lg border border-slate-700 hover:border-red-500 hover:text-red-400 transition text-sm">←</a>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-slate-600 text-sm">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-2 text-slate-300 rounded-lg border border-slate-700 hover:border-red-500 hover:text-red-400 transition text-sm">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-3 py-2 text-slate-300 rounded-lg border border-slate-700 hover:border-red-500 hover:text-red-400 transition text-sm">→</a>
            @else
                <span class="px-3 py-2 text-slate-600 rounded-lg border border-slate-800 text-sm">→</span>
            @endif
        </div>
    </nav>
@endif