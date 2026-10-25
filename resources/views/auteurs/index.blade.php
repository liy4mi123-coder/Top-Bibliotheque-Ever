<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fichier des auteurs</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

    @php
        $ltr = fn ($s) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(\Illuminate\Support\Str::ascii((string) $s), 0, 1));
        $letters = [];
        foreach ($auteurs as $a) { $letters[$ltr($a->nom)] = true; }
        ksort($letters);
    @endphp

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; }
        body { font-family: 'Inter', sans-serif; color: #fff; background: #021f19; }
        [hidden] { display: none !important; }

        .fb-page {
            position: relative; min-height: 100vh; overflow-x: hidden;
            background:
                radial-gradient(900px 500px at 15% 10%, rgba(52,211,153,.22), transparent 60%),
                radial-gradient(800px 500px at 90% 95%, rgba(16,185,129,.20), transparent 60%),
                linear-gradient(160deg, #021f19 0%, #043d2f 50%, #064e3b 100%);
            background-attachment: fixed;
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
        .fb-wrap { position: relative; z-index: 1; max-width: 1150px; margin: 0 auto; padding: 24px; }

        /* ===== HEADER SCENE ===== */
        .fb-scene {
            position: relative; overflow: hidden; padding: 30px 40px 36px; border-radius: 28px;
            background: repeating-linear-gradient(90deg, rgba(255,255,255,.035) 0 2px, transparent 2px 24px), linear-gradient(160deg, #052e24 0%, #064e3b 100%);
            box-shadow: 0 40px 90px -30px rgba(0,0,0,.65), 0 0 0 1px rgba(255,255,255,.08);
            animation: fb-rise .7s ease-out both;
        }
        .fb-beam { position: absolute; top: -20%; left: 6%; width: 150px; height: 150%; transform: rotate(24deg); background: linear-gradient(180deg, rgba(209,250,229,.17), transparent 80%); filter: blur(6px); animation: fb-beam 9s ease-in-out infinite; pointer-events: none; }
        .fb-beam.b2 { left: 24%; width: 70px; animation-delay: -4s; }
        .fb-text { position: relative; max-width: 600px; }
        .fb-backlink { display: inline-flex; margin-bottom: 18px; font-size: 13px; font-weight: 600; color: #a7f3d0; text-decoration: none; }
        .fb-backlink:hover { color: #fff; }
        .fb-badge { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: #d1fae5; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2); padding: 6px 12px; border-radius: 999px; }
        .fb-badge b { width: 6px; height: 6px; border-radius: 50%; background: #6ee7b7; display: block; }
        .fb-title { margin: 14px 0 0; font-family: 'Playfair Display', serif; font-size: 42px; line-height: 1.12; font-weight: 700; }
        .fb-title em { font-style: italic; color: #a7f3d0; font-weight: 500; }
        .fb-sub { margin: 10px 0 0; font-size: 14px; line-height: 1.7; color: rgba(236,253,245,.8); }
        .fb-tools { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; margin-top: 20px; }
        .fb-chip { display: inline-flex; align-items: center; padding: 13px 18px; border-radius: 12px; text-decoration: none; font-size: 14px; font-weight: 700; color: #064e3b; background: #fff; box-shadow: 0 12px 26px -12px rgba(0,0,0,.5); transition: transform .2s, background .2s; }
        .fb-chip:hover { transform: translateY(-2px); background: #ecfdf5; }
        .fb-search { position: relative; flex: 1; min-width: 210px; max-width: 320px; }
        .fb-search svg { position: absolute; left: 14px; top: 50%; width: 18px; height: 18px; margin-top: -9px; color: #6ee7b7; pointer-events: none; }
        .fb-search input { width: 100%; padding: 13px 16px 13px 42px; font-family: inherit; font-size: 14px; color: #fff; background: rgba(255,255,255,.1); border: 1.5px solid rgba(255,255,255,.2); border-radius: 12px; transition: all .2s; }
        .fb-search input::placeholder { color: rgba(209,250,229,.6); }
        .fb-search input:focus { outline: none; background: rgba(255,255,255,.16); border-color: #6ee7b7; box-shadow: 0 0 0 4px rgba(110,231,183,.15); }

        /* lamp + books pile */
        .fb-aside { position: absolute; right: 70px; top: 0; }
        .fb-lamp { position: relative; width: 90px; height: 74px; transform-origin: 50% 0; animation: fb-sway 5s ease-in-out infinite; }
        .fb-lamp::before { content: ""; position: absolute; left: 50%; top: -50px; width: 2px; height: 84px; background: #6ee7b7; opacity: .5; }
        .fb-lamp i { position: absolute; left: 10px; top: 32px; width: 70px; height: 34px; border-radius: 70px 70px 6px 6px; background: linear-gradient(180deg, #10b981, #047857); box-shadow: 0 0 0 1px rgba(255,255,255,.2); }
        .fb-lamp b { position: absolute; left: 50%; top: 64px; width: 12px; height: 12px; margin-left: -6px; border-radius: 50%; background: #ecfdf5; box-shadow: 0 0 22px 8px rgba(209,250,229,.7); }
        .fb-lamp::after { content: ""; position: absolute; left: -45px; top: 70px; width: 180px; height: 230px; background: linear-gradient(180deg, rgba(209,250,229,.3), transparent); clip-path: polygon(38% 0, 62% 0, 100% 100%, 0 100%); pointer-events: none; }
        .fb-pile { position: absolute; right: 40px; bottom: 0; display: flex; flex-direction: column-reverse; align-items: flex-start; }
        .fb-flat { position: relative; display: block; height: 22px; width: var(--w); border-radius: 3px; background: var(--c); box-shadow: inset 0 0 0 1px rgba(0,0,0,.18); }
        .fb-flat::after { content: ""; position: absolute; right: 0; top: 3px; bottom: 3px; width: 12px; border-radius: 0 2px 2px 0; background: repeating-linear-gradient(180deg, #ecfdf5 0 2px, #a7f3d0 2px 3px); }

        /* ===== DRAWER ===== */
        .fb-drawer { position: relative; margin-top: 22px; padding-bottom: 22px; border-radius: 24px; background: linear-gradient(160deg, #0b4a39, #052e24); box-shadow: 0 40px 90px -20px rgba(0,0,0,.6), inset 0 0 0 1px rgba(167,243,208,.18); animation: fb-rise .8s ease-out .12s both; }
        .fb-tabs { display: flex; flex-wrap: wrap; align-items: flex-end; gap: 5px; padding: 16px 22px 0; }
        .fb-ltab { padding: 9px 15px 8px; border: 0; border-radius: 10px 10px 0 0; cursor: pointer; font-family: inherit; font-size: 13px; font-weight: 700; color: #d1fae5; background: #0f6b52; transition: background .2s, transform .2s, color .2s; }
        .fb-ltab:hover { background: #059669; transform: translateY(-3px); }
        .fb-ltab.on { color: #064e3b; background: #ecfdf5; transform: translateY(-3px); }
        .fb-inner { margin: 0 14px; padding: 36px 22px 34px; border-radius: 14px; background: rgba(0,0,0,.4); box-shadow: inset 0 14px 30px -8px rgba(0,0,0,.75); }
        .fb-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(262px, 1fr)); gap: 38px 24px; }

        .fb-fiche { position: relative; padding: 26px 20px 34px; border-radius: 12px; color: #022c22; background: repeating-linear-gradient(180deg, #ecfdf5 0 29px, #d1fae5 29px 30px); box-shadow: 0 20px 40px -22px rgba(0,0,0,.85); transform: rotate(var(--r, 0deg)); transition: transform .25s, box-shadow .25s; animation: fb-deal .6s cubic-bezier(.3,1.3,.5,1) both; animation-delay: var(--d, 0s); }
        .fb-fiche:nth-child(3n+1) { --r: -1.1deg; } .fb-fiche:nth-child(3n+2) { --r: .7deg; } .fb-fiche:nth-child(3n) { --r: -.4deg; }
        .fb-fiche:hover { transform: rotate(0) translateY(-8px); box-shadow: 0 32px 50px -22px rgba(0,0,0,.95); z-index: 2; }
        .fb-fiche::after { content: ""; position: absolute; bottom: 9px; left: 50%; width: 12px; height: 12px; margin-left: -6px; border-radius: 50%; background: #052e24; box-shadow: inset 0 2px 3px rgba(0,0,0,.7); }
        .fb-ctab { position: absolute; top: -15px; left: 22px; padding: 3px 16px; border-radius: 8px 8px 0 0; font-family: 'Playfair Display', serif; font-size: 14px; font-weight: 700; color: #064e3b; background: #a7f3d0; }
        .fb-stamp { position: absolute; top: 18px; right: 14px; padding: 3px 9px; border: 2px solid; border-radius: 6px; font-size: 10.5px; font-weight: 800; letter-spacing: .16em; transform: rotate(9deg); opacity: .9; animation: fb-stamp .45s ease-out .55s both; }
        .fb-stamp.ok { color: #047857; } .fb-stamp.no { color: #b91c1c; }
        .fb-num { font-size: 10px; font-weight: 700; letter-spacing: .16em; color: #6b7280; }
        .fb-who { display: flex; align-items: center; gap: 12px; margin: 12px 0 8px; }
        .fb-ava { flex: none; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #064e3b; background: linear-gradient(135deg, #a7f3d0, #6ee7b7); }
        .fb-who h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 20px; line-height: 1.15; }
        .fb-who h3 small { display: block; margin-top: 2px; font-family: 'Inter', sans-serif; font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: #047857; }
        .fb-mail { margin: 0 0 8px; font-size: 12.5px; color: #4b5563; word-break: break-all; }
        .fb-row { display: flex; justify-content: space-between; gap: 10px; font-size: 12.5px; line-height: 30px; }
        .fb-row span { font-size: 10.5px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: #047857; }
        .fb-row b { font-weight: 600; color: #064e3b; }
        .fb-acts { display: flex; gap: 6px; margin-top: 12px; padding-top: 12px; border-top: 1px dashed #6ee7b7; }
        .fb-acts form { margin: 0; }
        .fb-mini { display: inline-block; padding: 8px 12px; border-radius: 9px; border: 0; cursor: pointer; font-family: inherit; font-size: 12.5px; font-weight: 700; text-decoration: none; transition: transform .15s, background .15s; }
        .fb-mini:hover { transform: translateY(-1px); }
        .fb-mini-view { background: #047857; color: #fff; } .fb-mini-view:hover { background: #059669; }
        .fb-mini-edit { background: #fff; color: #047857; box-shadow: inset 0 0 0 1.5px #a7f3d0; } .fb-mini-edit:hover { background: #ecfdf5; }
        .fb-mini-del { background: #fef2f2; color: #b91c1c; } .fb-mini-del:hover { background: #fee2e2; }
        .fb-pull { transform: translateY(-26px) scale(1.06) rotate(0) !important; }
        .fb-burn { animation: fb-burn .45s ease-in both !important; }
        .fb-leave .fb-wrap { opacity: 0; transition: opacity .35s .15s; }

        .fb-none { padding: 50px 10px; text-align: center; font-family: 'Playfair Display', serif; font-size: 22px; color: #6ee7b7; }
        .fb-none small { display: block; margin-top: 8px; font-family: 'Inter', sans-serif; font-size: 13px; color: rgba(209,250,229,.65); }
        .fb-dfoot { display: flex; flex-direction: column; align-items: center; gap: 12px; padding-top: 22px; }
        .fb-label { padding: 6px 20px; border: 2px solid #6ee7b7; border-radius: 6px; font-size: 11px; font-weight: 700; letter-spacing: .24em; color: #064e3b; background: #ecfdf5; }
        .fb-handle { width: 130px; height: 12px; border-radius: 8px; background: linear-gradient(180deg, #a7f3d0, #059669); box-shadow: 0 6px 14px -4px rgba(0,0,0,.6); }
        .fb-copy { margin: 22px 0 4px; text-align: center; font-size: 11px; color: rgba(209,250,229,.55); }

        /* delete dialog */
        .fb-modal { position: fixed; inset: 0; z-index: 50; display: flex; align-items: center; justify-content: center; padding: 20px; background: rgba(2,31,25,.82); backdrop-filter: blur(4px); }
        .fb-dlg { width: min(390px, 100%); padding: 30px 28px 26px; border-radius: 20px; text-align: center; color: #022c22; background: #ecfdf5; box-shadow: 0 40px 80px -20px rgba(0,0,0,.8); animation: fb-pop .35s cubic-bezier(.3,1.5,.5,1) both; }
        .fb-dlg h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 24px; }
        .fb-dlg p { margin: 10px 0 22px; font-size: 14px; line-height: 1.6; color: #4b5563; }
        .fb-dlg div { display: flex; gap: 10px; }
        .fb-dlg button { flex: 1; padding: 13px; border: 0; border-radius: 12px; cursor: pointer; font-family: inherit; font-size: 14px; font-weight: 700; }
        #fbNo { color: #047857; background: #d1fae5; } #fbYes { color: #fff; background: #b91c1c; }

        @keyframes fb-rise { from { opacity: 0; transform: translateY(22px) scale(.98); } to { opacity: 1; transform: none; } }
        @keyframes fb-deal { from { opacity: 0; translate: 0 70px; scale: .9; } to { opacity: 1; translate: 0 0; scale: 1; } }
        @keyframes fb-stamp { from { opacity: 0; scale: 2.4; } to { opacity: .9; scale: 1; } }
        @keyframes fb-burn { to { opacity: 0; translate: 0 50px; scale: .8; rotate: 7deg; } }
        @keyframes fb-pop { from { opacity: 0; transform: scale(.85); } to { opacity: 1; transform: none; } }
        @keyframes fb-sway { 0%,100% { transform: rotate(-5deg); } 50% { transform: rotate(5deg); } }
        @keyframes fb-beam { 0%,100% { opacity: .55; } 50% { opacity: 1; } }
        @keyframes fb-up { from { transform: translate(0, 0); opacity: 0; } 10% { opacity: .9; } to { transform: translate(40px, -110vh); opacity: 0; } }
        @media (prefers-reduced-motion: reduce) { .fb-page *, .fb-dlg { animation: none !important; } }

        @media (max-width: 900px) { .fb-aside, .fb-pile { display: none; } }
        @media (max-width: 640px) {
            .fb-wrap { padding: 14px; }
            .fb-scene { padding: 24px 20px 28px; }
            .fb-title { font-size: 32px; }
            .fb-inner { margin: 0 8px; padding: 30px 12px 26px; }
            .fb-tabs { padding: 14px 12px 0; }
        }
    </style>
</head>

<body>
<div class="fb-page" id="fbPage">
    <div class="fb-light"></div>
    <div class="fb-dust"></div>

    <div class="fb-wrap">

        {{-- ===== HEADER ===== --}}
        <section class="fb-scene">
            <div class="fb-beam"></div><div class="fb-beam b2"></div>
            <div class="fb-aside"><div class="fb-lamp"><i></i><b></b></div></div>
            <div class="fb-pile">
                <span class="fb-flat" style="--w:120px; --c:#047857;"></span>
                <span class="fb-flat" style="--w:100px; --c:#d1fae5; margin-left:10px;"></span>
                <span class="fb-flat" style="--w:110px; --c:#059669; margin-left:4px;"></span>
            </div>

            <div class="fb-text">
                <a href="{{ route('dashboard') }}" class="fb-backlink">← Tableau de bord</a><br>
                <span class="fb-badge"><b></b> <span id="fbCount">{{ count($auteurs) }}</span>&nbsp;auteur(s)</span>
                <h1 class="fb-title">Fichier des <em>auteurs</em></h1>
                <p class="fb-sub">Chaque auteur a sa fiche. Feuilletez le tiroir, filtrez par lettre ou cherchez un nom.</p>

                <div class="fb-tools">
                    <a href="{{ route('auteurs.create') }}" class="fb-chip">+ Ajouter un auteur</a>
                    <label class="fb-search">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"/></svg>
                        <input type="search" id="fbQ" placeholder="Rechercher un auteur…" autocomplete="off">
                    </label>
                </div>
            </div>
        </section>

        {{-- ===== DRAWER ===== --}}
        <section class="fb-drawer">
            <div class="fb-tabs">
                <button type="button" class="fb-ltab on" data-l="*">Tous</button>
                @foreach($letters as $l => $_)
                    <button type="button" class="fb-ltab" data-l="{{ $l }}">{{ $l }}</button>
                @endforeach
            </div>

            <div class="fb-inner">
                <div class="fb-cards">
                    @foreach($auteurs as $auteur)
                        <article class="fb-fiche" style="--d: {{ min($loop->index, 14) * 0.05 }}s"
                                 data-l="{{ $ltr($auteur->nom) }}"
                                 data-s="{{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($auteur->nom.' '.$auteur->prenom.' '.$auteur->email.' '.$auteur->nationalite)) }}"
                                 data-name="{{ $auteur->prenom }} {{ $auteur->nom }}">

                            <span class="fb-ctab">{{ $ltr($auteur->nom) }}</span>
                            <span class="fb-stamp {{ $auteur->actif ? 'ok' : 'no' }}">{{ $auteur->actif ? 'ACTIF' : 'INACTIF' }}</span>

                            <div class="fb-num">N° {{ str_pad($auteur->id, 4, '0', STR_PAD_LEFT) }}</div>

                            <div class="fb-who">
                                <span class="fb-ava">{{ strtoupper(mb_substr($auteur->prenom, 0, 1) . mb_substr($auteur->nom, 0, 1)) }}</span>
                                <h3>{{ $auteur->prenom }}<small>{{ $auteur->nom }}</small></h3>
                            </div>

                            <p class="fb-mail">{{ $auteur->email }}</p>

                            <div class="fb-row"><span>Naissance</span><b>{{ $auteur->date_naissance?->format('d/m/Y') ?? '—' }}</b></div>
                            <div class="fb-row"><span>Nationalité</span><b>{{ $auteur->nationalite ?: '—' }}</b></div>

                            <div class="fb-acts">
                                <a href="{{ route('auteurs.show', $auteur) }}" class="fb-mini fb-mini-view" data-go>Voir</a>
                                <a href="{{ route('auteurs.edit', $auteur) }}" class="fb-mini fb-mini-edit" data-go>Modifier</a>
                                <form action="{{ route('auteurs.destroy', $auteur) }}" method="POST" class="fb-del">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="fb-mini fb-mini-del">Supprimer</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="fb-none" id="fbNone" @if(count($auteurs)) hidden @endif>
                    Aucune fiche trouvée
                    <small>@if(count($auteurs)) Essayez une autre lettre ou un autre nom. @else Le tiroir est vide pour le moment. @endif</small>
                </div>
            </div>

            <div class="fb-dfoot"><div class="fb-label">FICHIER · AUTEURS</div><div class="fb-handle"></div></div>
        </section>

        <p class="fb-copy">© {{ date('Y') }} FR.BIB — Gestion de votre bibliothèque</p>
    </div>
</div>

{{-- delete confirmation --}}
<div class="fb-modal" id="fbModal" hidden>
    <div class="fb-dlg">
        <h3>Retirer cette fiche ?</h3>
        <p>La fiche de <strong id="fbWho"></strong> sera supprimée définitivement.</p>
        <div><button type="button" id="fbNo">Annuler</button><button type="button" id="fbYes">Supprimer</button></div>
    </div>
</div>

<script>
(function () {
    var $ = function (s) { return document.querySelector(s); }, page = $('#fbPage');

    /* lantern light + dust */
    page.addEventListener('mousemove', function (e) { page.style.setProperty('--mx', e.clientX + 'px'); page.style.setProperty('--my', e.clientY + 'px'); });
    var dust = $('.fb-dust');
    for (var i = 0; i < 22; i++) {
        var s = document.createElement('span'), z = 2 + Math.random() * 3;
        s.style.cssText = 'left:' + Math.random() * 100 + '%;width:' + z + 'px;height:' + z + 'px;animation-duration:' + (14 + Math.random() * 16) + 's;animation-delay:-' + Math.random() * 20 + 's';
        dust.appendChild(s);
    }

    /* filter by letter + search */
    var cards = [].slice.call(document.querySelectorAll('.fb-fiche')), cur = '*', qs = '', none = $('#fbNone'), count = $('#fbCount');
    function norm(t) { return t.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim(); }
    function apply() {
        var n = 0;
        cards.forEach(function (c) {
            var ok = (cur === '*' || c.dataset.l === cur) && c.dataset.s.indexOf(qs) > -1;
            c.hidden = !ok; if (ok) n++;
        });
        count.textContent = n; none.hidden = n > 0;
    }
    document.querySelectorAll('.fb-ltab').forEach(function (t) {
        t.addEventListener('click', function () {
            document.querySelectorAll('.fb-ltab').forEach(function (x) { x.classList.remove('on'); });
            t.classList.add('on'); cur = t.dataset.l; apply();
        });
    });
    $('#fbQ').addEventListener('input', function (e) { qs = norm(e.target.value); apply(); });

    /* Voir / Modifier: the card is pulled out of the drawer, then we go */
    document.querySelectorAll('[data-go]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
            e.preventDefault();
            a.closest('.fb-fiche').classList.add('fb-pull');
            document.body.classList.add('fb-leave');
            setTimeout(function () { location.href = a.href; }, 450);
        });
    });

    /* delete: confirm, then the card drops away, then submit */
    var modal = $('#fbModal'), pending = null;
    document.querySelectorAll('.fb-del').forEach(function (f) {
        f.addEventListener('submit', function (e) {
            e.preventDefault();
            pending = f; $('#fbWho').textContent = f.closest('.fb-fiche').dataset.name; modal.hidden = false;
        });
    });
    $('#fbNo').addEventListener('click', function () { modal.hidden = true; pending = null; });
    modal.addEventListener('click', function (e) { if (e.target === modal) { modal.hidden = true; pending = null; } });
    $('#fbYes').addEventListener('click', function () {
        if (!pending) return;
        var f = pending; modal.hidden = true;
        f.closest('.fb-fiche').classList.add('fb-burn');
        setTimeout(function () { f.submit(); }, 450);
    });

    window.addEventListener('pageshow', function (e) {
        if (!e.persisted) return;
        document.body.classList.remove('fb-leave');
        document.querySelectorAll('.fb-pull, .fb-burn').forEach(function (c) { c.classList.remove('fb-pull', 'fb-burn'); });
    });
})();
</script>
</body>
</html>