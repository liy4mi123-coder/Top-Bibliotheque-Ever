<x-app-layout>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

    @php
        $nbAuteurs = $nbLivres = $stockTotal = 0;
        try {
            if (class_exists(\App\Models\Auteur::class)) $nbAuteurs = \App\Models\Auteur::count();
            if (class_exists(\App\Models\Livre::class)) { $nbLivres = \App\Models\Livre::count(); $stockTotal = (int) \App\Models\Livre::sum('stock'); }
        } catch (\Throwable $e) {}
        $user  = Auth::user();
        $hour  = (int) date('G');
        $hello = $hour < 12 ? 'Bonjour' : ($hour < 18 ? 'Bon après-midi' : 'Bonsoir');
        $today = ucfirst(\Carbon\Carbon::now()->locale('fr')->isoFormat('dddd D MMMM YYYY'));
    @endphp

    <style>
        .fb-page, .fb-page * { box-sizing: border-box; }
        .fb-page {
            position: fixed; inset: 0; z-index: 9999; overflow: auto;
            font-family: 'Inter', sans-serif; color: #fff;
            background:
                radial-gradient(900px 500px at 15% 10%, rgba(52,211,153,.22), transparent 60%),
                radial-gradient(800px 500px at 90% 95%, rgba(16,185,129,.20), transparent 60%),
                linear-gradient(160deg, #021f19 0%, #043d2f 50%, #064e3b 100%);
        }
        .fb-page::before {
            content: ""; position: fixed; inset: 0; pointer-events: none;
            background-image: linear-gradient(rgba(110,231,183,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(110,231,183,.06) 1px, transparent 1px);
            background-size: 48px 48px;
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
        }
        .fb-light { position: fixed; inset: 0; pointer-events: none; background: radial-gradient(420px circle at var(--mx, 50%) var(--my, 30%), rgba(167,243,208,.11), transparent 60%); }
        .fb-dust { position: fixed; inset: 0; pointer-events: none; overflow: hidden; }
        .fb-dust span { position: absolute; bottom: -10px; border-radius: 50%; background: rgba(209,250,229,.55); animation: fb-up linear infinite; }
        .fb-wrap { position: relative; z-index: 1; max-width: 1100px; margin: 0 auto; padding: 24px; }

        /* top bar */
        .fb-top { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 12px 18px; border-radius: 18px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .fb-brand, .fb-user { display: flex; align-items: center; gap: 12px; }
        .fb-brand-ico { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.25); }
        .fb-brand-name { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; letter-spacing: .04em; }
        .fb-brand-name i { font-style: normal; color: #6ee7b7; }
        .fb-avatar { flex: none; width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #064e3b; background: linear-gradient(135deg, #a7f3d0, #6ee7b7); }
        .fb-user-name { font-size: 14px; font-weight: 600; }
        .fb-profile { display: flex; align-items: center; gap: 12px; padding: 4px 12px 4px 4px; border-radius: 999px; text-decoration: none; color: inherit; transition: background .2s; }
        .fb-profile:hover { background: rgba(255,255,255,.14); }
        .fb-user form { margin: 0; }
        .fb-logout { display: inline-flex; align-items: center; gap: 8px; padding: 9px 14px; border-radius: 10px; cursor: pointer; font-family: inherit; font-size: 13px; font-weight: 600; color: #ecfdf5; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); transition: background .2s, transform .2s; }
        .fb-logout:hover { background: rgba(255,255,255,.2); transform: translateY(-1px); }
        .fb-logout svg { width: 16px; height: 16px; }

        /* scene */
        .fb-scene {
            position: relative; overflow: hidden; margin-top: 20px; padding: 36px 40px 0; border-radius: 28px;
            background: repeating-linear-gradient(90deg, rgba(255,255,255,.035) 0 2px, transparent 2px 24px), linear-gradient(160deg, #052e24 0%, #064e3b 100%);
            box-shadow: 0 40px 90px -30px rgba(0,0,0,.65), 0 0 0 1px rgba(255,255,255,.08);
            animation: fb-rise .7s ease-out both;
        }
        .fb-beam { position: absolute; top: -20%; left: 6%; width: 150px; height: 150%; transform: rotate(24deg); background: linear-gradient(180deg, rgba(209,250,229,.17), transparent 80%); filter: blur(6px); animation: fb-beam 9s ease-in-out infinite; pointer-events: none; }
        .fb-beam.b2 { left: 22%; width: 70px; animation-delay: -4s; }
        .fb-text { position: relative; max-width: 560px; }
        .fb-badge { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: #d1fae5; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2); padding: 6px 12px; border-radius: 999px; }
        .fb-badge b { width: 6px; height: 6px; border-radius: 50%; background: #6ee7b7; display: block; }
        .fb-text h1 { margin: 14px 0 0; font-family: 'Playfair Display', serif; font-size: 42px; line-height: 1.12; font-weight: 700; }
        .fb-text h1 em { font-style: italic; color: #a7f3d0; font-weight: 500; }
        .fb-date { margin: 8px 0 0; font-size: 13px; font-weight: 600; color: #6ee7b7; }
        #fbQuote { min-height: 50px; margin: 12px 0 0; font-size: 15px; line-height: 1.7; font-style: italic; color: rgba(236,253,245,.82); transition: opacity .5s; }
        .fb-chips { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 16px; }
        .fb-chip { display: inline-flex; align-items: center; padding: 11px 16px; border-radius: 12px; text-decoration: none; font-size: 13px; font-weight: 700; color: #064e3b; background: #fff; box-shadow: 0 12px 26px -12px rgba(0,0,0,.5); transition: transform .2s, background .2s; }
        .fb-chip:hover { transform: translateY(-2px); background: #ecfdf5; }
        .fb-chip.g { color: #ecfdf5; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.22); box-shadow: none; }
        .fb-chip.g:hover { background: rgba(255,255,255,.2); }

        /* lamp + clock */
        .fb-aside { position: absolute; right: 60px; top: 0; display: flex; flex-direction: column; align-items: center; }
        .fb-lamp { position: relative; width: 90px; height: 74px; transform-origin: 50% 0; animation: fb-sway 5s ease-in-out infinite; }
        .fb-lamp::before { content: ""; position: absolute; left: 50%; top: -50px; width: 2px; height: 84px; background: #6ee7b7; opacity: .5; }
        .fb-lamp i { position: absolute; left: 10px; top: 32px; width: 70px; height: 34px; border-radius: 70px 70px 6px 6px; background: linear-gradient(180deg, #10b981, #047857); box-shadow: 0 0 0 1px rgba(255,255,255,.2); }
        .fb-lamp b { position: absolute; left: 50%; top: 64px; width: 12px; height: 12px; margin-left: -6px; border-radius: 50%; background: #ecfdf5; box-shadow: 0 0 22px 8px rgba(209,250,229,.7); }
        .fb-lamp::after { content: ""; position: absolute; left: -45px; top: 70px; width: 180px; height: 230px; background: linear-gradient(180deg, rgba(209,250,229,.3), transparent); clip-path: polygon(38% 0, 62% 0, 100% 100%, 0 100%); pointer-events: none; }
        .fb-clock { position: relative; width: 104px; height: 104px; margin-top: 24px; filter: drop-shadow(0 8px 14px rgba(0,0,0,.4)); }

        /* shelf */
        .fb-shelf { position: relative; margin: 30px -40px 0; padding: 0 40px 12px; height: 252px; display: flex; justify-content: center; align-items: flex-end; gap: 2px; overflow-x: clip; background: linear-gradient(180deg, rgba(0,0,0,.28), rgba(0,0,0,.5)); box-shadow: inset 0 14px 22px -12px rgba(0,0,0,.7); }
        .fb-shelf::after { content: ""; position: absolute; left: 0; right: 0; bottom: 0; height: 12px; background: linear-gradient(180deg, #0f6b52, #0a3d30); box-shadow: 0 -1px 0 rgba(167,243,208,.25); }
        .fb-spine { position: relative; flex: none; border-radius: 3px 3px 1px 1px; background: var(--c); box-shadow: inset 0 0 0 1px rgba(0,0,0,.12); transition: transform .25s; animation: fb-drop .85s cubic-bezier(.3,1.4,.5,1) both; }
        .fb-spine::before, .fb-book::before { content: ""; position: absolute; inset: 0; border-radius: inherit; background: linear-gradient(90deg, rgba(0,0,0,.28), rgba(255,255,255,.14) 35%, rgba(0,0,0,.2)); }
        .fb-spine::after { content: ""; position: absolute; left: 0; right: 0; top: 14px; height: 3px; background: rgba(0,0,0,.22); box-shadow: 0 8px 0 rgba(0,0,0,.22); }
        .fb-spine:hover { transform: translateY(-6px); }
        .fb-lean, .fb-lean:hover { transform: rotate(9deg); transform-origin: bottom left; }
        .fb-lean { margin-left: 8px; }
        .fb-book { position: relative; flex: none; width: 88px; height: 198px; padding: 18px 0 14px; margin: 0 4px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; border-radius: 4px 4px 1px 1px; text-decoration: none; color: var(--t); background: var(--c); box-shadow: 0 0 0 1.5px rgba(167,243,208,.6), 0 0 26px rgba(52,211,153,.45); animation: fb-glow 2.6s ease-in-out infinite, fb-drop .9s cubic-bezier(.3,1.4,.5,1) both; transition: transform .3s cubic-bezier(.3,1.5,.5,1); }
        .fb-book > * { position: relative; }
        .fb-book:hover { transform: translateY(-16px); }
        .fb-book svg { width: 26px; height: 26px; }
        .fb-book b { writing-mode: vertical-rl; transform: rotate(180deg); font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; }
        .fb-book i { display: block; width: 60%; height: 3px; border-radius: 2px; background: currentColor; opacity: .5; box-shadow: 0 -7px 0 currentColor; }
        .fb-pulled { transform: translateY(-30px) scale(1.06) !important; animation: none !important; }

        /* tea + plant */
        .fb-tea, .fb-plant { position: relative; flex: none; animation: fb-drop .85s cubic-bezier(.3,1.4,.5,1) both; }
        .fb-tea { margin: 0 8px; }
        .fb-tea svg { display: block; width: 42px; height: 54px; }
        .fb-steam { position: absolute; bottom: 52px; left: 12px; width: 6px; height: 26px; border-radius: 6px; background: linear-gradient(180deg, transparent, rgba(236,253,245,.6)); filter: blur(3px); animation: fb-steam 2.8s ease-in infinite; }
        .fb-steam.s2 { left: 20px; animation-delay: .9s; } .fb-steam.s3 { left: 28px; animation-delay: 1.8s; }
        .fb-plant { margin: 0 8px; }
        .fb-plant svg { display: block; width: 72px; height: 112px; }
        .fb-leaves { transform-origin: 35px 72px; animation: fb-leaf 4s ease-in-out infinite; }

        /* lower area */
        .fb-lower { display: grid; grid-template-columns: 320px 1fr; gap: 18px; margin-top: 18px; }
        .fb-member { position: relative; overflow: hidden; border-radius: 20px; color: #022c22; background: #ecfdf5; box-shadow: 0 30px 60px -28px rgba(0,0,0,.65); transition: transform .15s; animation: fb-rise .7s ease-out .15s both; }
        .fb-m-top { display: flex; justify-content: space-between; align-items: center; padding: 12px 18px; font-size: 10px; font-weight: 700; letter-spacing: .18em; color: #d1fae5; background: linear-gradient(135deg, #064e3b, #059669); }
        .fb-m-top b { font-family: 'Playfair Display', serif; font-size: 16px; letter-spacing: .04em; }
        .fb-m-top i { font-style: normal; color: #6ee7b7; }
        .fb-m-body { display: flex; align-items: center; gap: 14px; padding: 20px 18px 14px; }
        .fb-m-body h4 { margin: 0; font-family: 'Playfair Display', serif; font-size: 20px; }
        .fb-m-body p { margin: 3px 0 0; font-size: 12px; color: #6b7280; word-break: break-all; }
        .fb-barcode { height: 38px; margin: 4px 18px 0; background: repeating-linear-gradient(90deg, #064e3b 0 2px, transparent 2px 4px, #064e3b 4px 5px, transparent 5px 8px, #064e3b 8px 11px, transparent 11px 13px); }
        .fb-m-foot { padding: 10px 18px 16px; font-size: 11px; letter-spacing: .08em; color: #047857; font-weight: 600; }
        .fb-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .fb-fiche { position: relative; padding: 36px 20px 20px; border-radius: 14px; color: #022c22; background: repeating-linear-gradient(180deg, #ecfdf5 0 29px, #d1fae5 29px 30px); box-shadow: 0 24px 50px -24px rgba(0,0,0,.6); transform: rotate(var(--r, 0deg)); transition: transform .25s; animation: fb-rise .7s ease-out both; }
        .fb-fiche:nth-child(1) { --r: -1.4deg; animation-delay: .2s; } .fb-fiche:nth-child(2) { --r: .8deg; animation-delay: .27s; } .fb-fiche:nth-child(3) { --r: -.6deg; animation-delay: .34s; }
        .fb-fiche:hover { transform: rotate(0) translateY(-8px); }
        .fb-fiche::before { content: ""; position: absolute; top: 11px; left: 50%; width: 14px; height: 14px; margin-left: -7px; border-radius: 50%; background: #064e3b; box-shadow: inset 0 2px 4px rgba(0,0,0,.6); }
        .fb-fiche small { display: block; font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: #047857; }
        .fb-fiche strong { display: block; margin-top: 10px; font-family: 'Playfair Display', serif; font-size: 44px; line-height: 1; }
        .fb-fiche span { display: block; margin-top: 8px; font-size: 12px; color: #6b7280; }
        .fb-copy { margin: 24px 0 6px; text-align: center; font-size: 11px; color: rgba(209,250,229,.55); }

        /* book flying out */
        .fb-shade { position: fixed; inset: 0; z-index: 10000; pointer-events: none; background: rgba(2,31,25,0); transition: background .6s; }
        .fb-shade.on { background: rgba(2,31,25,.86); }
        .fb-flyer { position: fixed; z-index: 10001; perspective: 1400px; transition: left .65s cubic-bezier(.65,0,.25,1), top .65s cubic-bezier(.65,0,.25,1), width .65s cubic-bezier(.65,0,.25,1), height .65s cubic-bezier(.65,0,.25,1); }
        .fb-flyer > div { position: absolute; inset: 0; border-radius: 6px 14px 14px 6px; }
        .fb-fpage { display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #047857; background: repeating-linear-gradient(180deg, #ecfdf5 0 27px, #d1fae5 27px 28px); box-shadow: 0 40px 80px -20px rgba(0,0,0,.75); }
        .fb-fcover { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; background: var(--c); color: var(--t); box-shadow: inset 0 0 0 9px rgba(255,255,255,.07), inset 0 0 0 10px rgba(255,255,255,.28); transform-origin: left center; backface-visibility: hidden; -webkit-backface-visibility: hidden; transition: transform .7s cubic-bezier(.5,0,.2,1); }
        .fb-fcover > * { opacity: 0; transition: opacity .35s .25s; }
        .fb-flyer.big .fb-fcover > * { opacity: 1; }
        .fb-flyer.open .fb-fcover { transform: rotateY(-168deg); }
        .fb-fcover h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 32px; }
        .fb-fcover small { font-size: 11px; font-weight: 700; letter-spacing: .3em; opacity: .75; }
        .fb-fcover hr { width: 56px; border: 0; height: 2px; background: currentColor; opacity: .5; margin: 0; }

        @keyframes fb-rise { from { opacity: 0; transform: translateY(20px) scale(.98); } to { opacity: 1; } }
        @keyframes fb-drop { from { translate: 0 -260px; opacity: 0; } 55% { opacity: 1; } to { translate: 0 0; opacity: 1; } }
        @keyframes fb-glow { 0%,100% { box-shadow: 0 0 0 1.5px rgba(167,243,208,.5), 0 0 16px rgba(52,211,153,.3); } 50% { box-shadow: 0 0 0 2px rgba(167,243,208,.9), 0 0 34px rgba(52,211,153,.7); } }
        @keyframes fb-sway { 0%,100% { transform: rotate(-5deg); } 50% { transform: rotate(5deg); } }
        @keyframes fb-beam { 0%,100% { opacity: .55; } 50% { opacity: 1; } }
        @keyframes fb-steam { 0% { transform: translateY(0) scaleY(.6); opacity: 0; } 30% { opacity: .8; } 100% { transform: translateY(-34px) scaleY(1.3); opacity: 0; } }
        @keyframes fb-leaf { 0%,100% { transform: rotate(-3deg); } 50% { transform: rotate(3deg); } }
        @keyframes fb-up { from { transform: translate(0, 0); opacity: 0; } 10% { opacity: .9; } to { transform: translate(40px, -110vh); opacity: 0; } }
        @media (prefers-reduced-motion: reduce) { .fb-page * { animation: none !important; } }

        @media (max-width: 900px) {
            .fb-aside { display: none; }
            .fb-lower { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .fb-wrap { padding: 14px; }
            .fb-scene { padding: 26px 20px 0; }
            .fb-shelf { margin: 24px -20px 0; padding: 0 20px 12px; }
            .fb-text h1 { font-size: 32px; }
            .fb-stats { grid-template-columns: 1fr; }
            .fb-user-name { display: none; }
        }
    </style>

    <div class="fb-page" id="fbPage">
        <div class="fb-light"></div>
        <div class="fb-dust"></div>

        <div class="fb-wrap">

            {{-- ===== TOP BAR ===== --}}
            <div class="fb-top">
                <div class="fb-brand">
                    <div class="fb-brand-ico">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#a7f3d0" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/></svg>
                    </div>
                    <div class="fb-brand-name">FR<i>.</i>BIB</div>
                </div>
                <div class="fb-user">
                    <a href="{{ route('profile.edit') }}" class="fb-profile" title="Mon profil">
                        <div class="fb-avatar">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                        <span class="fb-user-name">{{ $user->name }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="fb-logout">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            {{-- ===== SCENE ===== --}}
            <section class="fb-scene">
                <div class="fb-beam"></div><div class="fb-beam b2"></div>

                <div class="fb-aside">
                    <div class="fb-lamp"><i></i><b></b></div>
                    <svg class="fb-clock" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="46" fill="rgba(2,31,25,.6)" stroke="#6ee7b7" stroke-width="2.5"/>
                        <path d="M50 8v6M50 86v6M8 50h6M86 50h6" stroke="#a7f3d0" stroke-width="2" stroke-linecap="round"/>
                        <line id="fbH" x1="50" y1="50" x2="50" y2="29" stroke="#fff" stroke-width="3.5" stroke-linecap="round"/>
                        <line id="fbM" x1="50" y1="50" x2="50" y2="18" stroke="#d1fae5" stroke-width="2.5" stroke-linecap="round"/>
                        <line id="fbS" x1="50" y1="56" x2="50" y2="14" stroke="#34d399" stroke-width="1.2" stroke-linecap="round"/>
                        <circle cx="50" cy="50" r="3" fill="#6ee7b7"/>
                    </svg>
                </div>

                <div class="fb-text">
                    <span class="fb-badge"><b></b> Tableau de bord</span>
                    <h1>{{ $hello }}, <br><em>{{ $user->name }}.</em></h1>
                    <p class="fb-date">{{ $today }}</p>
                    <p id="fbQuote">Un bon livre est une porte qui s'ouvre sans bruit.</p>
                    <div class="fb-chips">
                        <a href="{{ route('auteurs.create') }}" class="fb-chip">+ Nouvel auteur</a>
                        <a href="{{ route('livres.create') }}" class="fb-chip g">+ Nouveau livre</a>
                    </div>
                </div>

                {{-- The shelf: the two big books are the navigation --}}
                <div class="fb-shelf" id="fbShelf">
                    <span class="fb-tea">
                        <i class="fb-steam"></i><i class="fb-steam s2"></i><i class="fb-steam s3"></i>
                        <svg viewBox="0 0 40 52"><path d="M6 14h28l-3 34a4 4 0 01-4 4H13a4 4 0 01-4-4z" fill="rgba(110,231,183,.35)" stroke="#a7f3d0" stroke-width="2"/><path d="M8 26h24" stroke="#6ee7b7" stroke-width="1.5"/><path d="M20 22c4-9 11-9 11-9-1 9-6 10-11 9z" fill="#10b981"/></svg>
                    </span>

                    <a class="fb-book" href="{{ route('auteurs.index') }}" data-label="Auteurs" style="--c:#047857; --t:#fff;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <b>Auteurs</b><i></i>
                    </a>

                    <a class="fb-book" href="{{ route('livres.index') }}" data-label="Livres" style="--c:#d1fae5; --t:#064e3b;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/></svg>
                        <b>Livres</b><i></i>
                    </a>

                    <span class="fb-plant">
                        <svg viewBox="0 0 70 110"><g class="fb-leaves"><path d="M35 72C20 60 12 40 14 18c14 8 22 26 21 54z" fill="#10b981"/><path d="M35 72c4-24 14-44 30-54 2 24-8 46-30 54z" fill="#059669"/><path d="M35 72C32 50 34 30 40 8c10 18 6 42-5 64z" fill="#34d399"/></g><path d="M16 74h38l-5 32H21z" fill="#064e3b" stroke="#6ee7b7" stroke-width="1.5"/></svg>
                    </span>
                </div>
            </section>

            {{-- ===== MEMBER CARD + CATALOG CARDS ===== --}}
            <div class="fb-lower">
                <div class="fb-member">
                    <div class="fb-m-top"><span>CARTE DE MEMBRE</span><b>FR<i>.</i>BIB</b></div>
                    <div class="fb-m-body">
                        <div class="fb-avatar">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                        <div><h4>{{ $user->name }}</h4><p>{{ $user->email }}</p></div>
                    </div>
                    <div class="fb-barcode"></div>
                    <div class="fb-m-foot">N° {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}@if($user->created_at) · DEPUIS {{ $user->created_at->format('m/Y') }}@endif</div>
                </div>

                <div class="fb-stats">
                    <div class="fb-fiche"><small>Auteurs</small><strong data-count="{{ $nbAuteurs }}">0</strong><span>auteurs enregistrés</span></div>
                    <div class="fb-fiche"><small>Livres</small><strong data-count="{{ $nbLivres }}">0</strong><span>livres au catalogue</span></div>
                    <div class="fb-fiche"><small>Stock</small><strong data-count="{{ $stockTotal }}">0</strong><span>exemplaires en stock</span></div>
                </div>
            </div>

            <p class="fb-copy">© {{ date('Y') }} FR.BIB — Gestion de votre bibliothèque</p>
        </div>
    </div>

    <script>
    (function () {
        var $ = function (s) { return document.querySelector(s); };
        var page = $('#fbPage');

        /* lantern light following the mouse */
        page.addEventListener('mousemove', function (e) {
            page.style.setProperty('--mx', e.clientX + 'px');
            page.style.setProperty('--my', e.clientY + 'px');
        });

        /* floating dust */
        var dust = $('.fb-dust');
        for (var i = 0; i < 26; i++) {
            var s = document.createElement('span'), z = 2 + Math.random() * 3;
            s.style.cssText = 'left:' + Math.random() * 100 + '%;width:' + z + 'px;height:' + z + 'px;animation-duration:' + (14 + Math.random() * 16) + 's;animation-delay:-' + Math.random() * 20 + 's';
            dust.appendChild(s);
        }

        /* shelf: random books drop in around the big ones */
        var cols = ['#064e3b','#047857','#059669','#065f46','#0f766e','#115e59','#134e4a','#d1fae5','#a7f3d0','#ecfdf5','#10b981','#166534'];
        function rnd(a, b) { return Math.floor(a + Math.random() * (b - a + 1)); }
        function mk() {
            var e = document.createElement('span');
            e.className = 'fb-spine';
            e.style.cssText = '--c:' + cols[rnd(0, cols.length - 1)] + ';height:' + rnd(120, 205) + 'px;width:' + rnd(20, 40) + 'px;';
            return e;
        }
        var shelf = $('#fbShelf'), last;
        for (i = 0; i < 9; i++) shelf.insertBefore(mk(), shelf.firstChild);
        for (i = 0; i < 9; i++) { last = mk(); shelf.appendChild(last); }
        last.classList.add('fb-lean');
        Array.prototype.forEach.call(shelf.children, function (c, n) { c.style.animationDelay = (n * 0.06 + 0.2) + 's'; });

        /* counters */
        document.querySelectorAll('[data-count]').forEach(function (el) {
            var t = +el.dataset.count, t0 = performance.now();
            (function f(now) {
                var p = Math.max(0, Math.min((now - t0 - 500) / 1400, 1));
                el.textContent = Math.round(t * (1 - Math.pow(1 - p, 3)));
                if (p < 1) requestAnimationFrame(f);
            })(t0);
        });

        /* wall clock */
        function tick() {
            var d = new Date(), sec = d.getSeconds(), min = d.getMinutes() + sec / 60, h = (d.getHours() % 12) + min / 60;
            $('#fbH').setAttribute('transform', 'rotate(' + h * 30 + ' 50 50)');
            $('#fbM').setAttribute('transform', 'rotate(' + min * 6 + ' 50 50)');
            $('#fbS').setAttribute('transform', 'rotate(' + sec * 6 + ' 50 50)');
        }
        tick(); setInterval(tick, 1000);

        /* rotating sayings */
        var q = ["Un bon livre est une porte qui s'ouvre sans bruit.", "Chaque page tournée est un petit voyage.", "Une bibliothèque bien rangée, c'est l'esprit tranquille.", "Les livres attendent patiemment d'être ouverts."], qi = 0, qe = $('#fbQuote');
        setInterval(function () {
            qe.style.opacity = 0;
            setTimeout(function () { qi = (qi + 1) % q.length; qe.textContent = q[qi]; qe.style.opacity = 1; }, 500);
        }, 6000);

        /* 3D tilt on the member card */
        var m = $('.fb-member');
        m.addEventListener('mousemove', function (e) {
            var r = m.getBoundingClientRect(), x = (e.clientX - r.left) / r.width - .5, y = (e.clientY - r.top) / r.height - .5;
            m.style.transform = 'perspective(700px) rotateY(' + x * 14 + 'deg) rotateX(' + -y * 14 + 'deg)';
        });
        m.addEventListener('mouseleave', function () { m.style.transform = ''; });

        /* big books: pull out, fly to the centre, open, then go */
        function go(book, e) {
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
            e.preventDefault();
            if (document.body.classList.contains('fb-leaving')) return;
            document.body.classList.add('fb-leaving');
            var href = book.href;
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { location.href = href; return; }
            book.classList.add('fb-pulled');
            setTimeout(function () {
                var r = book.getBoundingClientRect(), cs = getComputedStyle(book);
                var shade = document.createElement('div'); shade.className = 'fb-shade';
                var fly = document.createElement('div'); fly.className = 'fb-flyer';
                fly.style.cssText = 'left:' + r.left + 'px;top:' + r.top + 'px;width:' + r.width + 'px;height:' + r.height + 'px;--c:' + cs.backgroundColor + ';--t:' + cs.color + ';';
                fly.innerHTML = '<div class="fb-fpage">FR.BIB</div><div class="fb-fcover"><small>FR.BIB</small><hr><h3>' + book.dataset.label + '</h3><hr></div>';
                document.body.appendChild(shade); document.body.appendChild(fly);
                book.style.visibility = 'hidden';
                requestAnimationFrame(function () { requestAnimationFrame(function () {
                    var W = Math.min(300, window.innerWidth - 48), H = Math.min(W * 1.35, window.innerHeight - 80);
                    shade.classList.add('on'); fly.classList.add('big');
                    fly.style.left = (window.innerWidth - W) / 2 + 'px'; fly.style.top = (window.innerHeight - H) / 2 + 'px';
                    fly.style.width = W + 'px'; fly.style.height = H + 'px';
                }); });
                setTimeout(function () { fly.classList.add('open'); }, 750);
                setTimeout(function () { location.href = href; }, 1400);
            }, 220);
        }
        document.querySelectorAll('.fb-book').forEach(function (b) { b.addEventListener('click', function (e) { go(b, e); }); });

        window.addEventListener('pageshow', function (e) {
            if (!e.persisted) return;
            document.body.classList.remove('fb-leaving');
            document.querySelectorAll('.fb-shade, .fb-flyer').forEach(function (el) { el.remove(); });
            document.querySelectorAll('.fb-book').forEach(function (b) { b.style.visibility = ''; b.classList.remove('fb-pulled'); });
        });
    })();
    </script>

</x-app-layout>