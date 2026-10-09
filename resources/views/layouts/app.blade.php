<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blog Laravel') — Revaldo Ginting</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                },
            },
        };
    </script>

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background: #0a0e1a; color: #e8edf5; min-height: 100vh; }
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            background-image: linear-gradient(to right, rgba(148,163,184,.08) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(148,163,184,.08) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, #000 30%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, #000 30%, transparent 80%);
            opacity: .5; pointer-events: none;
        }
        .bg-glow { position: fixed; border-radius: 50%; filter: blur(120px); pointer-events: none; z-index: 0; }
        .bg-glow-1 { width: 500px; height: 500px; background: #ff2d20; opacity: .1; top: -200px; left: -100px; }
        .bg-glow-2 { width: 600px; height: 600px; background: #6366f1; opacity: .08; top: 30%; right: -200px; }
        .content-wrapper { position: relative; z-index: 1; }
        .text-gradient-red {
            background: linear-gradient(135deg, #ff2d20 0%, #ff7a5c 100%);
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,14,26,.75);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(148,163,184,.12);
        }
        .nav-link {
            padding: 8px 16px; font-size: .88rem; font-weight: 500;
            color: #94a3b8; border-radius: 8px; transition: all .2s ease;
            text-decoration: none;
        }
        .nav-link:hover { color: #e8edf5; background: rgba(148,163,184,.08); }
        .nav-link.active { color: #ff2d20; background: rgba(255,45,32,.1); }
        .card {
            background: rgba(148,163,184,.04);
            border: 1px solid rgba(148,163,184,.12);
            border-radius: 18px; padding: 28px;
            transition: all .22s ease;
        }
        .card:hover { border-color: rgba(148,163,184,.22); }
        .form-label { display: block; font-size: .82rem; font-weight: 600; color: #cbd5e1; margin-bottom: 6px; }
        .form-input {
            width: 100%; padding: 11px 14px;
            background: rgba(148,163,184,.05);
            border: 1px solid rgba(148,163,184,.15);
            border-radius: 10px;
            color: #e8edf5; font-family: inherit; font-size: .9rem;
            outline: none; transition: all .2s ease;
        }
        .form-input::placeholder { color: #64748b; }
        .form-input:hover { border-color: rgba(148,163,184,.25); }
        .form-input:focus { border-color: #ff2d20; box-shadow: 0 0 0 3px rgba(255,45,32,.15); }
        .form-input.error { border-color: #ef4444; }

        /* Fix: select option warna */
        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'><path fill='%2394a3b8' d='M6 8L0 0h12z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
            cursor: pointer;
        }
        select.form-input option {
            background: #151b2e;
            color: #e8edf5;
            padding: 10px;
        }

        .form-error { font-size: .75rem; color: #f87171; margin-top: 4px; }
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px 22px; background: #ff2d20; color: white;
            border-radius: 10px; font-weight: 600; font-size: .88rem;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 4px 16px rgba(255,45,32,.25);
            white-space: nowrap;
        }
        .btn-primary:hover { background: #e0261b; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(255,45,32,.35); }
        .btn-ghost {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px 22px; background: rgba(148,163,184,.05);
            color: #e8edf5; border-radius: 10px; font-weight: 600;
            font-size: .88rem; text-decoration: none;
            border: 1px solid rgba(148,163,184,.22); cursor: pointer;
            transition: all .2s ease;
            white-space: nowrap;
        }
        .btn-ghost:hover { background: rgba(148,163,184,.1); border-color: #ff2d20; color: #ff2d20; }
        .btn-danger {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px 22px; background: rgba(239,68,68,.1); color: #f87171;
            border-radius: 10px; font-weight: 600; font-size: .88rem;
            text-decoration: none; border: 1px solid rgba(239,68,68,.3);
            cursor: pointer; transition: all .2s ease;
            white-space: nowrap;
        }
        .btn-danger:hover { background: rgba(239,68,68,.2); }
        .btn-sm { padding: 9px 16px; font-size: .82rem; }
        .badge {
            display: inline-flex; align-items: center;
            padding: 4px 10px; border-radius: 999px;
            font-size: .72rem; font-weight: 600;
            border-width: 1px;
        }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148,163,184,.2); border-radius: 5px; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="bg-grid" aria-hidden="true"></div>
    <div class="bg-glow bg-glow-1" aria-hidden="true"></div>
    <div class="bg-glow bg-glow-2" aria-hidden="true"></div>

    <div class="content-wrapper">
        <!-- NAVBAR -->
        <nav class="navbar">
            <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between gap-6">
                <a href="{{ route('posts.index') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg shadow-red-500/30 group-hover:scale-105 transition-transform">
                        <span class="text-white font-bold text-lg">R</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="font-bold text-sm leading-tight">Blog Revaldo</p>
                        <p class="text-xs text-slate-500 leading-tight">PSIK 25B · Unimed</p>
                    </div>
                </a>

                <div class="flex items-center gap-1">
                    <a href="{{ route('posts.index') }}"
                       class="nav-link {{ request()->routeIs('posts.index') || request()->routeIs('posts.show') ? 'active' : '' }}">
                        Blog
                    </a>
                    <a href="https://github.com/valdomilo" target="_blank" rel="noopener" class="nav-link">
                        GitHub ↗
                    </a>
                </div>

                <div class="hidden sm:block text-xs text-slate-500 font-mono">
                    @valdomilo
                </div>
            </div>
        </nav>

        <!-- FLASH MESSAGE -->
        <div class="max-w-6xl mx-auto px-6 pt-6">
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif
            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif
        </div>

        <!-- CONTENT -->
        <main class="max-w-6xl mx-auto px-6 py-8">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="border-t border-slate-800/60 mt-20">
            <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} Revaldo Ginting · 4253250033 · PSIK 25B</p>
                <p class="font-mono">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>