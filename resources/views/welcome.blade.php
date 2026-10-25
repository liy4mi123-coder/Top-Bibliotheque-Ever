<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bibliothèque</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; }
        body { font-family: 'Inter', sans-serif; color: #fff; background: #021f19; }

        .fb-page {
            position: relative; min-height: 100vh; overflow: hidden;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 28px 16px 22px; text-align: center;
            background:
                radial-gradient(900px 500px at 15% 10%, rgba(52,211,153,.22), transparent 60%),
                radial-gradient(800px 500px at 90% 95%, rgba(16,185,129,.20), transparent 60%),
                linear-gradient(160deg, #021f19 0%, #043d2f 50%, #064e3b 100%);
        }
        .fb-page::before {
            content: ""; position: fixed; inset: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(110,231,183,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(110,231,183,.06) 1px, transparent 1px);
            background-size: 48px 48px;
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
        }
        .fb-main { position: relative; z-index: 1; width: 100%; max-width: 960px; }

        /* ===== HEADER ===== */
        .fb-badge {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
            color: #d1fae5; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
            padding: 6px 13px; border-radius: 999px;
        }
        .fb-badge b { width: 6px; height: 6px; border-radius: 50%; background: #6ee7b7; display: block; }
        .fb-title { margin: 14px 0 0; font-family: 'Playfair Display', serif; font-size: 44px; line-height: 1.1; font-weight: 700; }
        .fb-title em { font-style: italic; font-weight: 500; color: #a7f3d0; }
        .fb-sub { margin: 10px auto 0; max-width: 480px; font-size: 14px; line-height: 1.7; color: rgba(236,253,245,.78); }

        /* ===== CASE + SHELVES ===== */
        .fb-stage { position: relative; width: 100%; margin: 26px auto 0; }
        .fb-case {
            padding: 14px 14px 0; border-radius: 18px 18px 0 0;
            background: linear-gradient(160deg, #0b4a39, #052e24);
            box-shadow: 0 40px 90px -20px rgba(0,0,0,.6), inset 0 0 0 1px rgba(167,243,208,.18);
            animation: fb-rise .8s ease-out both;
        }
        .fb-shelf {
            position: relative; height: 208px; padding: 0 10px 12px;
            display: flex; justify-content: center; align-items: flex-end; gap: 2px;
            overflow-x: clip;
            background: linear-gradient(180deg, rgba(0,0,0,.5), rgba(0,0,0,.22));
            box-shadow: inset 0 14px 22px -12px rgba(0,0,0,.7);
        }
        .fb-shelf + .fb-shelf { margin-top: 10px; }
        .fb-shelf:last-child { margin-bottom: 0; }
        .fb-shelf::after {
            content: ""; position: absolute; left: 0; right: 0; bottom: 0; height: 12px;
            background: linear-gradient(180deg, #0f6b52, #0a3d30);
            box-shadow: 0 -1px 0 rgba(167,243,208,.25);
        }

        /* ordinary book spines */
        .fb-spine {
            position: relative; flex: none; border-radius: 3px 3px 1px 1px;
            background: var(--c); box-shadow: inset 0 0 0 1px rgba(0,0,0,.12);
            transition: transform .25s ease;
        }
        .fb-spine::before {
            content: ""; position: absolute; inset: 0; border-radius: inherit;
            background: linear-gradient(90deg, rgba(0,0,0,.28), rgba(255,255,255,.14) 35%, rgba(0,0,0,.2));
        }
        .fb-spine::after {
            content: ""; position: absolute; left: 0; right: 0; top: 14px; height: 3px;
            background: rgba(0,0,0,.22); box-shadow: 0 8px 0 rgba(0,0,0,.22);
        }
        .fb-spine:hover { transform: translateY(-6px); }
        .fb-lean { transform: rotate(9deg); transform-origin: bottom left; margin-left: 8px; }
        .fb-lean:hover { transform: rotate(9deg); }

        /* the two special books */
        .fb-book {
            position: relative; flex: none; width: 58px; height: 170px; padding: 14px 0 12px;
            display: flex; flex-direction: column; align-items: center; justify-content: space-between;
            border-radius: 4px 4px 1px 1px; text-decoration: none; color: #fff;
            background: var(--c);
            box-shadow: 0 0 0 1.5px rgba(167,243,208,.6), 0 0 26px rgba(52,211,153,.45);
            animation: fb-glow 2.6s ease-in-out infinite;
            transition: transform .3s cubic-bezier(.3,1.5,.5,1);
        }
        .fb-book::before {
            content: ""; position: absolute; inset: 0; border-radius: inherit;
            background: linear-gradient(90deg, rgba(0,0,0,.25), rgba(255,255,255,.14) 35%, rgba(0,0,0,.18));
        }
        .fb-book > * { position: relative; }
        .fb-book:hover { transform: translateY(-16px); }
        .fb-book svg { width: 22px; height: 22px; }
        .fb-book b {
            writing-mode: vertical-rl; transform: rotate(180deg);
            font-family: 'Playfair Display', serif; font-size: 15px; font-weight: 700;
            letter-spacing: .16em; text-transform: uppercase;
        }
        .fb-book i { display: block; width: 60%; height: 3px; border-radius: 2px; background: currentColor; opacity: .5; box-shadow: 0 -7px 0 currentColor; }
        .fb-book.fb-light { color: #064e3b; }
        .fb-pulled { transform: translateY(-30px) scale(1.06) !important; animation: none !important; }

        /* ===== FLOOR ===== */
        .fb-ground {
            position: relative; left: 50%; transform: translateX(-50%);
            width: 100vw; height: 22px;
            background: linear-gradient(180deg, #0b4a39, #021f19);
            border-top: 1px solid rgba(167,243,208,.25);
        }
        .fb-floor {
            position: absolute; left: 0; right: 0; bottom: 22px;
            display: flex; justify-content: space-between; align-items: flex-end;
            padding: 0 4px; pointer-events: none;
        }
        .fb-pile { display: flex; flex-direction: column-reverse; align-items: flex-start; transform-origin: bottom left; }
        .fb-flat {
            position: relative; display: block; height: 26px; width: var(--w);
            border-radius: 3px; background: var(--c); box-shadow: inset 0 0 0 1px rgba(0,0,0,.18);
        }
        .fb-flat::after {
            content: ""; position: absolute; right: 0; top: 3px; bottom: 3px; width: 14px; border-radius: 0 2px 2px 0;
            background: repeating-linear-gradient(180deg, #ecfdf5 0 2px, #a7f3d0 2px 3px);
        }
        .fb-standing { display: flex; align-items: flex-end; gap: 3px; transform-origin: bottom right; padding-right: 6px; }
        .fb-standing .fb-spine { pointer-events: auto; }

        .fb-hint { margin: 20px 0 0; font-size: 13px; color: rgba(209,250,229,.75); }
        .fb-hint span { display: inline-block; animation: fb-bob 1.6s ease-in-out infinite; color: #6ee7b7; }
        .fb-copy { margin: 8px 0 0; font-size: 11px; color: rgba(209,250,229,.5); }

        /* ===== BOOK FLYING OUT ===== */
        .fb-shade { position: fixed; inset: 0; z-index: 50; pointer-events: none; background: rgba(2,31,25,0); transition: background .6s; }
        .fb-shade.on { background: rgba(2,31,25,.85); }
        .fb-flyer {
            position: fixed; z-index: 60; perspective: 1400px;
            transition: left .65s cubic-bezier(.65,0,.25,1), top .65s cubic-bezier(.65,0,.25,1),
                        width .65s cubic-bezier(.65,0,.25,1), height .65s cubic-bezier(.65,0,.25,1);
        }
        .fb-flyer > div { position: absolute; inset: 0; border-radius: 6px 14px 14px 6px; }
        .fb-fpage {
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #047857;
            background: repeating-linear-gradient(180deg, #ecfdf5 0 27px, #d1fae5 27px 28px);
            box-shadow: 0 40px 80px -20px rgba(0,0,0,.75);
        }
        .fb-fcover {
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px;
            background: var(--c); color: var(--t);
            box-shadow: inset 0 0 0 9px rgba(255,255,255,.07), inset 0 0 0 10px rgba(255,255,255,.28);
            transform-origin: left center; backface-visibility: hidden; -webkit-backface-visibility: hidden;
            transition: transform .7s cubic-bezier(.5,0,.2,1);
        }
        .fb-fcover > * { opacity: 0; transition: opacity .35s .25s; }
        .fb-flyer.big .fb-fcover > * { opacity: 1; }
        .fb-flyer.open .fb-fcover { transform: rotateY(-168deg); }
        .fb-fcover h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; }
        .fb-fcover small { font-size: 11px; font-weight: 700; letter-spacing: .3em; opacity: .75; }
        .fb-fcover hr { width: 56px; border: 0; height: 2px; background: currentColor; opacity: .5; margin: 0; }

        /* ===== ANIMATIONS ===== */
        @keyframes fb-rise { from { opacity: 0; transform: translateY(24px) scale(.98); } to { opacity: 1; transform: none; } }
        @keyframes fb-glow { 0%,100% { box-shadow: 0 0 0 1.5px rgba(167,243,208,.5), 0 0 16px rgba(52,211,153,.3); } 50% { box-shadow: 0 0 0 2px rgba(167,243,208,.9), 0 0 34px rgba(52,211,153,.7); } }
        @keyframes fb-bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
        @media (prefers-reduced-motion: reduce) { .fb-book { animation: none; } .fb-case { animation: none; } }

        /* ===== MOBILE ===== */
        @media (max-width: 640px) {
            .fb-title { font-size: 32px; }
            .fb-case { padding: 10px 8px 0; }
            .fb-pile { transform: scale(.6); }
            .fb-standing { transform: scale(.6); }
        }
    </style>
</head>

<body>
<div class="fb-page">
    <div class="fb-main">

        <span class="fb-badge"><b></b> Bibliothèque </span>
        <h1 class="fb-title">Chaque livre <em>trouve sa place.</em></h1>
        <p class="fb-sub">Ouvrez un livre pour entrer : connectez-vous ou créez votre compte.</p>

        <div class="fb-stage">

            <div class="fb-case">
                <div class="fb-shelf" data-fill="13"></div>

                {{-- Middle shelf: the two special books --}}
                <div class="fb-shelf" data-fill="11">
                    @auth
                        <a class="fb-book" href="{{ route('dashboard') }}" data-label="Tableau de bord" style="--c:#047857; --t:#fff;">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <b>Tableau</b>
                            <i></i>
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a class="fb-book" href="{{ route('login') }}" data-label="Connexion" style="--c:#047857; --t:#fff;">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                                <b>Connexion</b>
                                <i></i>
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a class="fb-book fb-light" href="{{ route('register') }}" data-label="Inscription" style="--c:#d1fae5; --t:#064e3b;">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                <b>Inscription</b>
                                <i></i>
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="fb-shelf" data-fill="13"></div>
            </div>

            {{-- Books on the floor, in front of the case --}}
            <div class="fb-floor">
                <div class="fb-pile">
                    <span class="fb-flat" style="--w:190px; --c:#064e3b;"></span>
                    <span class="fb-flat" style="--w:160px; --c:#d1fae5; margin-left:14px;"></span>
                    <span class="fb-flat" style="--w:175px; --c:#059669; margin-left:4px;"></span>
                    <span class="fb-flat" style="--w:120px; --c:#a7f3d0; margin-left:22px;"></span>
                </div>

                <div class="fb-standing">
                    <span class="fb-spine" style="--c:#047857; width:30px; height:132px;"></span>
                    <span class="fb-spine" style="--c:#ecfdf5; width:36px; height:152px;"></span>
                    <span class="fb-spine" style="--c:#065f46; width:26px; height:118px;"></span>
                    <span class="fb-spine" style="--c:#10b981; width:30px; height:140px; transform: rotate(-16deg); transform-origin: bottom left; margin-left:10px;"></span>
                </div>
            </div>

            <div class="fb-ground"></div>
        </div>

        <p class="fb-hint"><span>↑</span> Cliquez sur un livre lumineux pour l'ouvrir</p>
        <p class="fb-copy">© {{ date('Y') }} FR.BIB — Gestion de votre bibliothèque</p>
    </div>
</div>

<script>
(function () {
    var cols = ['#064e3b','#047857','#059669','#065f46','#0f766e','#115e59','#134e4a','#d1fae5','#a7f3d0','#ecfdf5','#10b981','#166534'];
    function rnd(a, b) { return Math.floor(a + Math.random() * (b - a + 1)); }
    function mk() {
        var s = document.createElement('span');
        s.className = 'fb-spine';
        s.style.cssText = '--c:' + cols[rnd(0, cols.length - 1)] + ';height:' + rnd(112, 178) + 'px;width:' + rnd(20, 40) + 'px;';
        return s;
    }

    /* fill the shelves with random books around the special ones */
    document.querySelectorAll('.fb-shelf').forEach(function (shelf) {
        var n = parseInt(shelf.dataset.fill, 10) || 12, i, last;
        for (i = 0; i < n; i++) shelf.insertBefore(mk(), shelf.firstChild);
        for (i = 0; i < n; i++) { last = mk(); shelf.appendChild(last); }
        last.classList.add('fb-lean');
    });

    /* clicking a book: pull it out, fly to the centre, open it, then go */
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
            document.body.appendChild(shade);
            document.body.appendChild(fly);
            book.style.visibility = 'hidden';

            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    var W = Math.min(300, window.innerWidth - 48), H = Math.min(W * 1.35, window.innerHeight - 80);
                    shade.classList.add('on');
                    fly.classList.add('big');
                    fly.style.left = (window.innerWidth - W) / 2 + 'px';
                    fly.style.top = (window.innerHeight - H) / 2 + 'px';
                    fly.style.width = W + 'px';
                    fly.style.height = H + 'px';
                });
            });

            setTimeout(function () { fly.classList.add('open'); }, 750);
            setTimeout(function () { location.href = href; }, 1400);
        }, 220);
    }

    document.querySelectorAll('.fb-book').forEach(function (b) {
        b.addEventListener('click', function (e) { go(b, e); });
    });

    /* coming back with the browser's back button */
    window.addEventListener('pageshow', function (e) {
        if (!e.persisted) return;
        document.body.classList.remove('fb-leaving');
        document.querySelectorAll('.fb-shade, .fb-flyer').forEach(function (el) { el.remove(); });
        document.querySelectorAll('.fb-book').forEach(function (b) { b.style.visibility = ''; b.classList.remove('fb-pulled'); });
    });
})();
</script>
</body>
</html>