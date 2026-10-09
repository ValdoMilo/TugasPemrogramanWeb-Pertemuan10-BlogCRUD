@props(['title' => null, 'subtitle' => null, 'hover' => true, 'padding' => 'p-6'])

<div {{ $attributes->merge([
    'class' => 'card ' . $padding . ($hover ? ' transition hover:-translate-y-0.5' : '')
]) }}>
    @if ($title || isset($header))
        <div class="flex items-start justify-between gap-4 mb-4">
            <div class="min-w-0">
                @if ($title)
                    <h3 class="text-lg font-bold text-white leading-tight">{{ $title }}</h3>
                @endif
                @if ($subtitle)
                    <p class="text-sm text-slate-400 mt-1">{{ $subtitle }}</p>
                @endif
            </div>
            @isset($header)
                <div class="flex-shrink-0">{{ $header }}</div>
            @endisset
        </div>
    @endif

    {{ $slot }}

    @isset($footer)
        <div class="mt-4 pt-4 border-t border-slate-700/50">{{ $footer }}</div>
    @endisset
</div>