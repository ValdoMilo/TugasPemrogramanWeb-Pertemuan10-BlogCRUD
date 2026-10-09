@props(['type' => 'info', 'message' => null, 'dismissible' => true])

@php
    $styles = [
        'success' => 'bg-green-500/10 border-green-500/30 text-green-400',
        'error'   => 'bg-red-500/10 border-red-500/30 text-red-400',
        'warning' => 'bg-yellow-500/10 border-yellow-500/30 text-yellow-400',
        'info'    => 'bg-blue-500/10 border-blue-500/30 text-blue-400',
    ][$type] ?? 'bg-slate-500/10 border-slate-500/30 text-slate-400';

    $icons = [
        'success' => '✓',
        'error'   => '✕',
        'warning' => '⚠',
        'info'    => 'ℹ',
    ][$type] ?? 'ℹ';
@endphp

<div x-data="{ show: true }" x-show="show" x-transition
     class="flex items-start gap-3 px-4 py-3 rounded-xl border {{ $styles }} mb-4">
    <span class="flex-shrink-0 font-bold">{{ $icons }}</span>
    <div class="flex-1 text-sm font-medium">
        {{ $message ?? $slot }}
    </div>
    @if ($dismissible)
        <button @click="show = false" type="button"
                class="flex-shrink-0 opacity-60 hover:opacity-100 transition text-lg leading-none">&times;</button>
    @endif
</div>