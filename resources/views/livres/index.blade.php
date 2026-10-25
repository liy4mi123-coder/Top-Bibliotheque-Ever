<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des livres</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; }
        body { font-family: 'Inter', sans-serif; color: #fff; background: #021f19; }
        a:focus-visible, button:focus-visible, input:focus-visible { outline: 2px solid #6ee7b7; outline-offset: 2px; }

        .lv-page {
            position: relative; min-height: 100vh; padding: 24px 16px 48px;
            background:
                radial-gradient(900px 500px at 15% 5%, rgba(52,211,153,.22), transparent 60%),
                radial-gradient(800px 500px at 90% 95%, rgba(16,185,129,.20), transparent 60%),
                linear-gradient(160deg, #021f19 0%, #043d2f 50%, #064e3b 100%);
        }
        .lv-wrap { position: relative; z-index: 1; max-width: 1180px; margin: 0 auto; }

        /* ===== HEADER + STATS ===== */
        .lv-back { display: inline-block; padding: 6px 0; font-size: 13px; font-weight: 600; color: #a7f3d0; text-decoration: none; }
        .lv-back:hover { color: #fff; }
        .lv-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px; margin-top: 6px; }
        .lv-title { margin: 0; font-family: 'Playfair Display', serif; font-size: clamp(34px, 5vw, 52px); line-height: 1.05; }
        .lv-sub { margin: 8px 0 0; max-width: 540px; font-size: 14px; line-height: 1.6; color: rgba(236,253,245,.75); }
        .lv-add { padding: 12px 18px; border-radius: 12px; text-decoration: none; font-size: 14px; font-weight: 700; color: #064e3b; background: #ecfdf5; box-shadow: 0 12px 26px -12px rgba(0,0,0,.5); transition: transform .2s; }
        .lv-add:hover { transform: translateY(-2px); }
        .lv-stats { display: flex; flex-wrap: wrap; margin-top: 20px; border-radius: 16px; overflow: hidden; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .lv-stat { flex: 1 1 130px; padding: 12px 18px; border-left: 1px solid rgba(255,255,255,.1); }
        .lv-stat:first-child { border-left: 0; }
        .lv-stat small { display: block; font-size: 12px; color: #a7f3d0; }
        .lv-stat strong { font-family: 'Playfair Display', serif; font-size: 24px; }
        .lv-stat strong span { margin-left: 3px; font: 600 11px 'Inter', sans-serif; color: #6ee7b7; }

        .lv-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; margin-top: 18px; }
        .lv-search { position: relative; flex: 1 1 260px; }
        .lv-search svg { position: absolute; left: 14px; top: 50%; width: 18px; height: 18px; margin-top: -9px; }
        .lv-search input { width: 100%; padding: 12px 16px 12px 42px; border-radius: 12px; border: 1px solid rgba(255,255,255,.2); background: rgba(2,31,25,.6); color: #fff; font: inherit; font-size: 14px; }
        .lv-search input::placeholder { color: rgba(209,250,229,.55); }
        .lv-chips { display: flex; gap: 8px; }
        .lv-chip { padding: 10px 14px; border-radius: 999px; border: 1px solid rgba(255,255,255,.22); background: transparent; color: #d1fae5; font: 600 13px 'Inter', sans-serif; cursor: pointer; }
        .lv-chip:hover { background: rgba(255,255,255,.12); }
        .lv-chip[aria-pressed="true"] { background: #ecfdf5; border-color: #ecfdf5; color: #064e3b; }
        .lv-hint { margin: 12px 2px 0; font-size: 13px; line-height: 1.6; color: rgba(209,250,229,.72); }
        .lv-hint b { color: #fff; font-weight: 600; }

        /* ===== BOOKCASE ===== */
        .lv-case { position: relative; isolation: isolate; margin-top: 12px; padding: 14px 14px 0; border-radius: 18px 18px 0 0; background: linear-gradient(160deg, #0b4a39, #052e24); box-shadow: 0 40px 90px -20px rgba(0,0,0,.6), inset 0 0 0 1px rgba(167,243,208,.18); }
        .lv-spot { position: absolute; inset: 0; z-index: 3; pointer-events: none; border-radius: inherit; mix-blend-mode: screen; background: radial-gradient(280px circle at var(--mx, -400px) var(--my, -400px), rgba(253,230,138,.20), transparent 70%); }
        .lv-shelf { position: relative; margin-bottom: 10px; padding: 24px 12px 14px; overflow-x: auto; background: linear-gradient(180deg, #0f6b52, #0a3d30) bottom / 100% 14px no-repeat, linear-gradient(180deg, rgba(0,0,0,.5), rgba(0,0,0,.22)); box-shadow: inset 0 14px 22px -12px rgba(0,0,0,.7); scrollbar-width: thin; scrollbar-color: #0f6b52 transparent; }
        .lv-shelf:last-child { margin-bottom: 0; }
        .lv-row { display: flex; align-items: flex-end; gap: 3px; width: max-content; min-width: 100%; min-height: 232px; }

        .lv-sp {
            position: relative; flex: none; width: var(--w); height: var(--h); padding: 0; border: 0; border-radius: 3px 3px 1px 1px;
            display: flex; align-items: center; justify-content: center; cursor: pointer;
            color: var(--t); background: var(--c); box-shadow: inset 0 0 0 1px rgba(0,0,0,.12);
            transition: transform .25s, opacity .3s, filter .3s;
            animation: lv-drop .8s cubic-bezier(.3,1.3,.5,1) both; animation-delay: calc(var(--i) * 35ms);
        }
        .lv-sp::before { content: ""; position: absolute; inset: 0; border-radius: inherit; background: linear-gradient(90deg, rgba(0,0,0,.28), rgba(255,255,255,.14) 35%, rgba(0,0,0,.2)); }
        .lv-sp::after { content: ""; position: absolute; left: 0; right: 0; top: 12px; height: 3px; background: currentColor; opacity: .3; box-shadow: 0 7px 0 currentColor; }
        .lv-sp:hover, .lv-sp:focus-visible { transform: translateY(-12px); }
        .lv-st { position: relative; writing-mode: vertical-rl; transform: rotate(180deg); max-height: calc(var(--h) - 58px); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font: 700 13px 'Playfair Display', serif; letter-spacing: .04em; }
        .lv-sk { position: absolute; bottom: 8px; left: 50%; width: 7px; height: 7px; margin-left: -3.5px; border-radius: 50%; background: #f87171; box-shadow: 0 0 8px #f87171; }
        .lv-sp.lv-off { filter: saturate(.4) brightness(.8); }
        .lv-sp.lv-dim { opacity: .14; filter: saturate(.3); pointer-events: none; }

        .lv-floor { height: 22px; margin: 0 -14px; background: linear-gradient(180deg, #0b4a39, #021f19); border-top: 1px solid rgba(167,243,208,.25); }
        .lv-none { position: relative; z-index: 3; margin: 24px 0; text-align: center; font-size: 15px; color: #d1fae5; }
        .lv-none a { color: #fff; font-weight: 700; }
        .lv-copy { margin: 24px 0 0; text-align: center; font-size: 11px; color: rgba(209,250,229,.5); }

        /* ===== THE PULLED-OUT BOOK ===== */
        .lv-ov { position: fixed; inset: 0; z-index: 100; display: flex; align-items: center; justify-content: center; background: rgba(1,20,15,.9); opacity: 0; transition: opacity .4s; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
        .lv-ov[hidden] { display: none; }
        .lv-ov.on { opacity: 1; }
        .lv-x { position: absolute; top: 18px; right: 18px; padding: 10px 16px; border-radius: 10px; border: 1px solid rgba(255,255,255,.28); background: rgba(255,255,255,.1); color: #ecfdf5; font: 600 13px 'Inter', sans-serif; cursor: pointer; }
        .lv-x:hover { background: rgba(255,255,255,.2); }
        .lv-sc { --W: 260px; --H: 372px; --k: 1; transform: translateY(40px) scale(var(--k)); opacity: 0; transition: transform .7s cubic-bezier(.2,.9,.3,1), opacity .5s; }
        .lv-ov.on .lv-sc { transform: scale(var(--k)); opacity: 1; }
        .lv-tilt { transition: transform .25s ease-out; }
        .lv-bk { position: relative; width: calc(var(--W) * 2); height: var(--H); perspective: 1800px; transform: translateX(calc(var(--W) / -2)); transition: transform 1.1s cubic-bezier(.6,0,.2,1); }
        .lv-bk.open { transform: none; }
        .lv-board { position: absolute; inset: -7px; border-radius: 8px 12px 12px 8px; background: var(--c); filter: brightness(.55); box-shadow: 0 50px 90px -20px rgba(0,0,0,.85); opacity: 0; transition: opacity .6s .2s; }
        .lv-bk.open .lv-board { opacity: 1; }

        .lv-pg { position: absolute; left: var(--W); top: 0; width: var(--W); height: var(--H); transform: translateZ(-1px); display: flex; flex-direction: column; gap: 10px; padding: 28px 26px 22px 30px; border-radius: 2px 8px 8px 2px; color: #022c22; font-size: 13px; background: repeating-linear-gradient(180deg, #ecfdf5 0 27px, #d1fae5 27px 28px); box-shadow: inset 12px 0 14px -10px rgba(0,0,0,.35); }
        .lv-cv { position: absolute; left: var(--W); top: 0; width: var(--W); height: var(--H); transform-origin: left center; transform-style: preserve-3d; transition: transform 1.1s cubic-bezier(.6,0,.2,1); }
        .lv-bk.open .lv-cv { transform: rotateY(-180deg); }
        .lv-fr, .lv-in { position: absolute; inset: 0; backface-visibility: hidden; -webkit-backface-visibility: hidden; border-radius: 3px 10px 10px 3px; }
        .lv-fr { display: flex; flex-direction: column; justify-content: space-between; padding: 34px 24px 26px 38px; color: var(--t); background: var(--c); box-shadow: inset 0 0 0 1px rgba(255,255,255,.1); }
        .lv-fr::before { content: ""; position: absolute; inset: 0 auto 0 0; width: 20px; border-radius: 3px 0 0 3px; background: linear-gradient(90deg, rgba(0,0,0,.4), rgba(255,255,255,.12) 60%, rgba(0,0,0,.12)); }
        .lv-fr::after { content: ""; position: absolute; inset: 12px 12px 12px 28px; border: 1px solid currentColor; border-radius: 4px 8px 8px 4px; opacity: .3; pointer-events: none; }
        .lv-in { transform: rotateY(180deg); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; padding: 40px 28px; text-align: center; color: #022c22; border-radius: 10px 3px 3px 10px; background: repeating-linear-gradient(180deg, #ecfdf5 0 27px, #d1fae5 27px 28px); box-shadow: inset -12px 0 14px -10px rgba(0,0,0,.3); }
        .lv-in::before { content: ""; position: absolute; inset: 14px; border: 2px double #6ee7b7; border-radius: 6px; pointer-events: none; }
        .lv-in::after { content: ""; position: absolute; top: 0; right: 36px; width: 22px; height: 96px; background: var(--c); clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 80%, 0 100%); }

        .lv-ft { font-family: 'Playfair Display', serif; font-size: 28px; line-height: 1.15; font-weight: 700; }
        .lv-fa { font-size: 13px; line-height: 1.5; }
        .lv-fa b { display: block; margin-top: 8px; font: 700 22px 'Playfair Display', serif; }
        .lv-flag { align-self: flex-start; padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; color: #fff; background: rgba(127,29,29,.92); }
        .lv-in h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 25px; line-height: 1.2; }
        .lv-in p { margin: 0; font-size: 14px; color: #047857; }
        .lv-in hr { width: 60px; margin: 4px 0; border: 0; height: 2px; background: #6ee7b7; }
        .lv-price { font: 700 36px 'Playfair Display', serif; line-height: 1; }
        .lv-price small { margin-left: 4px; font: 600 13px 'Inter', sans-serif; color: #047857; }
        .lv-line { display: flex; justify-content: space-between; gap: 10px; padding-bottom: 6px; border-bottom: 1px solid rgba(4,120,87,.25); }
        .lv-line span { color: #047857; font-weight: 600; }
        .lv-line b { font-weight: 600; text-align: right; word-break: break-all; }
        .lv-pill { align-self: flex-start; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .lv-ok { color: #065f46; background: #a7f3d0; }
        .lv-no { color: #7f1d1d; background: #fecaca; }
        .lv-acts { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: auto; }
        .lv-acts form { display: contents; }
        .lv-act { padding: 10px 6px; border-radius: 9px; border: 0; text-align: center; text-decoration: none; cursor: pointer; font: 700 13px 'Inter', sans-serif; transition: transform .15s; }
        .lv-act:hover { transform: translateY(-2px); }
        .lv-view { color: #ecfdf5; background: #047857; }
        .lv-edit { color: #064e3b; background: #fff; box-shadow: inset 0 0 0 1px #6ee7b7; }
        .lv-del { grid-column: 1 / -1; color: #991b1b; background: #fee2e2; }

        @keyframes lv-drop { from { translate: 0 -220px; opacity: 0; } 55% { opacity: 1; } to { translate: 0 0; opacity: 1; } }
        @media (prefers-reduced-motion: reduce) { .lv-sp { animation: none; } .lv-bk, .lv-cv, .lv-sc, .lv-ov, .lv-board { transition-duration: .01s; transition-delay: 0s; } }
        @media (max-width: 900px) { .lv-sc { --k: .8; } }
        @media (max-width: 640px) { .lv-sc { --k: .6; } .lv-case { padding: 10px 8px 0; } .lv-floor { margin: 0 -8px; } }
    </style>
</head>

<body>
@php
    $palette = [
        ['#047857', '#ffffff'], ['#064e3b', '#d1fae5'], ['#d1fae5', '#064e3b'],
        ['#0f766e', '#ffffff'], ['#a7f3d0', '#064e3b'], ['#115e59', '#ecfdf5'],
        ['#059669', '#ffffff'], ['#ecfdf5', '#065f46'],
    ];
    $all   = method_exists($livres, 'getCollection') ? $livres->getCollection() : collect($livres);
    $pMin  = (float) $all->min('prix');  $pMax = (float) $all->max('prix');
    $sMin  = (int) $all->min('stock');   $sMax = (int) $all->max('stock');
    $rows  = $all->chunk(16);
    $n     = 0;
@endphp

<div class="lv-page">
<div class="lv-wrap">

    <a href="{{ route('dashboard') }}" class="lv-back">← Tableau de bord</a>

    <div class="lv-head">
        <div>
            <h1 class="lv-title">Liste des livres</h1>
            <p class="lv-sub">Choisissez un dos sur l'étagère : le livre sort, s'ouvre, et vous pouvez le consulter, le modifier ou le retirer.</p>
        </div>
        <a href="{{ route('livres.create') }}" class="lv-add">+ Ajouter un livre</a>
    </div>

    {{-- ===== STATISTIQUES ===== --}}
    <div class="lv-stats">
        <div class="lv-stat"><small>Nombre de livres</small><strong>{{ $nombreLivres }}</strong></div>
        <div class="lv-stat"><small>Prix moyen</small><strong>{{ $prixMoyen }}<span>DH</span></strong></div>
        <div class="lv-stat"><small>Stock total</small><strong>{{ $stockTotal }}</strong></div>
        <div class="lv-stat"><small>Prix maximum</small><strong>{{ $prixMax }}<span>DH</span></strong></div>
        <div class="lv-stat"><small>Prix minimum</small><strong>{{ $prixMin }}<span>DH</span></strong></div>
    </div>

    <div class="lv-bar">
        <label class="lv-search">
            <svg fill="none" viewBox="0 0 24 24" stroke="#a7f3d0" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="M20 20l-3.5-3.5"/></svg>
            <input type="search" id="lvQ" placeholder="Chercher par titre, auteur ou ISBN" autocomplete="off">
        </label>
        <div class="lv-chips" role="group" aria-label="Filtrer par disponibilité">
            <button type="button" class="lv-chip" data-f="all" aria-pressed="true">Tous</button>
            <button type="button" class="lv-chip" data-f="1" aria-pressed="false">Disponibles</button>
            <button type="button" class="lv-chip" data-f="0" aria-pressed="false">Indisponibles</button>
        </div>
    </div>
    <p class="lv-hint"><b>Lire l'étagère :</b> plus un dos est haut, plus le livre coûte cher. Plus il est épais, plus il y a d'exemplaires en stock. Un point rouge signale un livre indisponible. <span id="lvCount">{{ $all->count() }}</span> livre(s) affiché(s).</p>

    {{-- ===== ETAGERES ===== --}}
    @if($all->isEmpty())
        <p class="lv-none">Aucun livre pour le moment. <a href="{{ route('livres.create') }}">Ajoutez le premier.</a></p>
    @else
    <div class="lv-case" id="lvCase">
        <div class="lv-spot"></div>
        @foreach($rows as $row)
            <div class="lv-shelf"><div class="lv-row">
            @foreach($row as $livre)
                @php
                    [$c, $t] = $palette[$livre->id % count($palette)];
                    $auteurNom = $livre->auteur ? trim($livre->auteur->prenom.' '.$livre->auteur->nom) : 'Aucun auteur';
                    $h = 150 + round(80 * ($pMax > $pMin ? ((float) $livre->prix - $pMin) / ($pMax - $pMin) : .5));
                    $w = 30 + round(26 * ($sMax > $sMin ? ((int) $livre->stock - $sMin) / ($sMax - $sMin) : .5));
                    $n++;
                @endphp
                <button type="button" class="lv-sp {{ $livre->disponible ? '' : 'lv-off' }}"
                        style="--c:{{ $c }}; --t:{{ $t }}; --h:{{ $h }}px; --w:{{ $w }}px; --i:{{ min($n, 30) }};"
                        data-id="{{ $livre->id }}" data-c="{{ $c }}" data-t="{{ $t }}"
                        data-d="{{ $livre->disponible ? 1 : 0 }}"
                        data-s="{{ mb_strtolower($livre->titre.' '.$auteurNom.' '.$livre->isbn) }}"
                        aria-label="Ouvrir {{ $livre->titre }}">
                    <span class="lv-st">{{ $livre->titre }}</span>
                    @unless($livre->disponible)<span class="lv-sk"></span>@endunless
                </button>
            @endforeach
            </div></div>
        @endforeach
        <div class="lv-floor"></div>
    </div>
    <p class="lv-none" id="lvEmpty" hidden>Aucun livre ne correspond à votre recherche. Essayez un autre titre ou retirez le filtre.</p>
    @endif

    <p class="lv-copy">© {{ date('Y') }} FR.BIB — Gestion de votre bibliothèque</p>
</div>
</div>

{{-- ===== LE LIVRE SORTI ===== --}}
<div class="lv-ov" id="lvOv" hidden>
    <button type="button" class="lv-x" id="lvX">Fermer</button>
    <div class="lv-sc"><div class="lv-tilt" id="lvTilt"><div class="lv-bk" id="lvBk">
        <div class="lv-board"></div>
        <div class="lv-pg" id="lvPg"></div>
        <div class="lv-cv"><div class="lv-fr" id="lvFr"></div><div class="lv-in" id="lvIn"></div></div>
    </div></div></div>
</div>

@foreach($all as $livre)
    @php $auteurNom = $livre->auteur ? trim($livre->auteur->prenom.' '.$livre->auteur->nom) : 'Aucun auteur'; @endphp
    <template id="lvT{{ $livre->id }}">
        <div class="t-fr">
            @unless($livre->disponible)<span class="lv-flag">Indisponible</span>@endunless
            <span class="lv-ft">{{ $livre->titre }}</span>
            <span class="lv-fa">{{ $auteurNom }}<b>{{ $livre->prix }} DH</b></span>
        </div>
        <div class="t-in">
            <h3>{{ $livre->titre }}</h3>
            <hr>
            <p>{{ $auteurNom }}</p>
        </div>
        <div class="t-pg">
            <div class="lv-price">{{ $livre->prix }}<small>DH</small></div>
            <div class="lv-line"><span>ISBN</span><b>{{ $livre->isbn }}</b></div>
            <div class="lv-line"><span>Stock</span><b>{{ $livre->stock }}</b></div>
            <div class="lv-line"><span>Publié le</span><b>{{ $livre->date_publication?->format('d/m/Y') ?? '-' }}</b></div>
            @if($livre->disponible)<span class="lv-pill lv-ok">Disponible</span>@else<span class="lv-pill lv-no">Indisponible</span>@endif
            <div class="lv-acts">
                <a href="{{ route('livres.show', $livre) }}" class="lv-act lv-view">Voir</a>
                <a href="{{ route('livres.edit', $livre) }}" class="lv-act lv-edit">Modifier</a>
                <form action="{{ route('livres.destroy', $livre) }}" method="POST" onsubmit="return confirm('Supprimer ce livre ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="lv-act lv-del">Supprimer</button>
                </form>
            </div>
        </div>
    </template>
@endforeach

<script>
(function () {
    var $c = document.getElementById('lvCase');
    if (!$c) return;

    var spines = [].slice.call($c.querySelectorAll('.lv-sp')),
        q = document.getElementById('lvQ'), chips = [].slice.call(document.querySelectorAll('.lv-chip')),
        empty = document.getElementById('lvEmpty'), count = document.getElementById('lvCount'), filter = 'all',
        ov = document.getElementById('lvOv'), bk = document.getElementById('lvBk'), tilt = document.getElementById('lvTilt'),
        fr = document.getElementById('lvFr'), inn = document.getElementById('lvIn'), pg = document.getElementById('lvPg'),
        last = null, timer = null;

    /* search + availability: matching spines stay lit, others fade */
    function run() {
        var t = q.value.trim().toLowerCase(), n = 0;
        spines.forEach(function (s) {
            var ok = (!t || s.dataset.s.indexOf(t) > -1) && (filter === 'all' || s.dataset.d === filter);
            s.classList.toggle('lv-dim', !ok);
            if (ok) n++;
        });
        count.textContent = n;
        empty.hidden = n > 0;
    }
    q.addEventListener('input', run);
    chips.forEach(function (c) {
        c.addEventListener('click', function () {
            filter = c.dataset.f;
            chips.forEach(function (x) { x.setAttribute('aria-pressed', x === c ? 'true' : 'false'); });
            run();
        });
    });

    /* warm lamp light following the cursor over the shelves */
    $c.addEventListener('mousemove', function (e) {
        var r = $c.getBoundingClientRect();
        $c.style.setProperty('--mx', (e.clientX - r.left) + 'px');
        $c.style.setProperty('--my', (e.clientY - r.top) + 'px');
    });
    $c.addEventListener('mouseleave', function () { $c.style.removeProperty('--mx'); $c.style.removeProperty('--my'); });

    /* pull a book out, then open its cover */
    function openBook(sp) {
        var tpl = document.getElementById('lvT' + sp.dataset.id);
        if (!tpl) return;
        var f = tpl.content;
        fr.innerHTML = f.querySelector('.t-fr').innerHTML;
        inn.innerHTML = f.querySelector('.t-in').innerHTML;
        pg.innerHTML = f.querySelector('.t-pg').innerHTML;
        bk.style.setProperty('--c', sp.dataset.c);
        bk.style.setProperty('--t', sp.dataset.t);
        bk.classList.remove('open');
        last = sp;
        ov.hidden = false;
        void ov.offsetWidth;
        ov.classList.add('on');
        clearTimeout(timer);
        timer = setTimeout(function () { bk.classList.add('open'); }, 750);
        document.getElementById('lvX').focus();
    }
    function closeBook() {
        if (ov.hidden) return;
        clearTimeout(timer);
        bk.classList.remove('open');
        ov.classList.remove('on');
        setTimeout(function () { ov.hidden = true; if (last) last.focus(); }, 420);
    }
    spines.forEach(function (s) { s.addEventListener('click', function () { openBook(s); }); });
    document.getElementById('lvX').addEventListener('click', closeBook);
    ov.addEventListener('click', function (e) { if (e.target === ov || e.target.classList.contains('lv-sc')) closeBook(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeBook(); });

    /* the open book tilts gently toward the cursor */
    ov.addEventListener('mousemove', function (e) {
        var x = e.clientX / window.innerWidth - .5, y = e.clientY / window.innerHeight - .5;
        tilt.style.transform = 'perspective(1400px) rotateY(' + (x * 9) + 'deg) rotateX(' + (-y * 7) + 'deg)';
    });
})();
</script>
</body>
</html>