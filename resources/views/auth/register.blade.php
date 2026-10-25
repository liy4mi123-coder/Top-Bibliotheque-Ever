<x-guest-layout>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

    <style>
        .fb-page, .fb-page * { box-sizing: border-box; }

        .fb-page {
            position: fixed; inset: 0; z-index: 9999; overflow: auto;
            display: flex; align-items: center; justify-content: center;
            padding: 24px;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(900px 500px at 15% 10%, rgba(52,211,153,.22), transparent 60%),
                radial-gradient(800px 500px at 90% 95%, rgba(16,185,129,.20), transparent 60%),
                linear-gradient(160deg, #021f19 0%, #043d2f 50%, #064e3b 100%);
        }
        .fb-page::before {
            content: ""; position: absolute; inset: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(110,231,183,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(110,231,183,.06) 1px, transparent 1px);
            background-size: 48px 48px;
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
        }

        /* ===== CARD ===== */
        .fb-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 980px;
            display: grid; grid-template-columns: 1.05fr 1fr;
            background: #fff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 40px 90px -20px rgba(0,0,0,.55), 0 0 0 1px rgba(255,255,255,.08);
            animation: fb-rise .7s ease-out both;
        }
        @keyframes fb-rise { from { opacity: 0; transform: translateY(20px) scale(.98); } to { opacity: 1; transform: none; } }

        /* ===== LEFT PANEL ===== */
        .fb-side {
            position: relative; overflow: hidden;
            padding: 44px 40px;
            display: flex; flex-direction: column; justify-content: space-between;
            color: #fff;
            background: linear-gradient(155deg, #064e3b 0%, #047857 60%, #059669 100%);
        }
        .fb-side::before {
            content: ""; position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.07) 1px, transparent 1px);
            background-size: 36px 36px;
            -webkit-mask-image: linear-gradient(180deg, #000, transparent 85%);
            mask-image: linear-gradient(180deg, #000, transparent 85%);
        }
        .fb-glow {
            position: absolute; width: 320px; height: 320px; border-radius: 50%;
            right: -90px; bottom: -90px;
            background: radial-gradient(circle, rgba(167,243,208,.45), transparent 70%);
            animation: fb-pulse 6s ease-in-out infinite;
        }
        @keyframes fb-pulse { 0%,100% { opacity: .5; transform: scale(1);} 50% { opacity: .9; transform: scale(1.12);} }

        .fb-brand { position: relative; display: flex; align-items: center; gap: 12px; }
        .fb-brand-ico {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
        }
        .fb-brand-name { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; letter-spacing: .04em; }
        .fb-brand-name i { font-style: normal; color: #6ee7b7; }

        .fb-book { position: relative; display: flex; justify-content: center; padding: 20px 0; animation: fb-float 6s ease-in-out infinite; }
        @keyframes fb-float { 0%,100% { transform: translateY(0);} 50% { transform: translateY(-9px);} }

        .fb-quote { position: relative; }
        .fb-quote h2 {
            margin: 0; font-family: 'Playfair Display', serif;
            font-size: 30px; line-height: 1.2; font-weight: 700;
        }
        .fb-quote h2 em { font-style: italic; color: #a7f3d0; font-weight: 500; }
        .fb-quote p { margin: 14px 0 0; font-size: 14px; line-height: 1.7; color: rgba(236,253,245,.8); max-width: 340px; }
        .fb-tags { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 22px; }
        .fb-tags span {
            font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 999px;
            background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
        }

        /* ===== RIGHT FORM ===== */
        .fb-form-wrap { padding: 44px 48px; display: flex; flex-direction: column; justify-content: center; }
        .fb-badge {
            display: inline-flex; align-items: center; gap: 8px; align-self: flex-start;
            font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
            color: #047857; background: #d1fae5; padding: 6px 12px; border-radius: 999px;
        }
        .fb-badge b { width: 6px; height: 6px; border-radius: 50%; background: #059669; display: block; }
        .fb-title { margin: 16px 0 0; font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #022c22; }
        .fb-sub { margin: 8px 0 24px; font-size: 14px; color: #6b7280; line-height: 1.6; }

        .fb-field { margin-bottom: 16px; }
        .fb-label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #064e3b; }
        .fb-input-box { position: relative; }
        .fb-input-box .fb-ico {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 20px; height: 20px; color: #059669; pointer-events: none;
        }
        .fb-input {
            display: block; width: 100%;
            padding: 14px 16px 14px 44px;
            font-family: inherit; font-size: 15px; color: #064e3b;
            background: #f6faf8;
            border: 1.5px solid #e0e9e5; border-radius: 12px;
            transition: all .2s ease;
        }
        .fb-input::placeholder { color: #9bb3a8; }
        .fb-input:focus {
            outline: none; background: #fff; border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5,150,105,.15);
        }
        .fb-eye {
            position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
            width: 36px; height: 36px; border: 0; background: transparent; cursor: pointer;
            display: flex; align-items: center; justify-content: center; color: #9ca3af; border-radius: 8px;
        }
        .fb-eye:hover { color: #047857; background: #ecfdf5; }
        .fb-eye svg { width: 20px; height: 20px; }

        .fb-btn {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 15px; margin-top: 8px; border: 0; cursor: pointer;
            font-family: inherit; font-size: 15px; font-weight: 600; color: #fff;
            border-radius: 12px;
            background: linear-gradient(135deg, #047857, #059669 55%, #10b981);
            box-shadow: 0 12px 26px -10px rgba(5,150,105,.7);
            transition: transform .2s, box-shadow .2s, filter .2s;
        }
        .fb-btn:hover { transform: translateY(-2px); filter: brightness(1.06); box-shadow: 0 16px 32px -10px rgba(5,150,105,.8); }
        .fb-btn svg { width: 18px; height: 18px; }

        .fb-register { margin-top: 24px; padding-top: 20px; border-top: 1px solid #e5efe9; text-align: center; font-size: 13px; color: #6b7280; }
        .fb-register a { margin-left: 4px; font-weight: 700; color: #047857; text-decoration: none; }
        .fb-register a:hover { color: #022c22; text-decoration: underline; }
        .fb-copy { margin: 18px 0 0; text-align: center; font-size: 11px; color: #9ca3af; }

        .fb-error { margin-top: 6px; font-size: 12px; color: #dc2626; list-style: none; padding: 0; }
        .fb-status { margin-bottom: 16px; font-size: 13px; color: #047857; background: #ecfdf5; padding: 10px 14px; border-radius: 10px; }

        /* ===== MOBILE ===== */
        @media (max-width: 860px) {
            .fb-card { grid-template-columns: 1fr; max-width: 460px; }
            .fb-side { display: none; }
            .fb-form-wrap { padding: 36px 26px; }
            .fb-mobile-brand { display: flex !important; }
        }
        .fb-mobile-brand {
            display: none; align-items: center; gap: 10px; margin-bottom: 22px;
            font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #064e3b;
        }
        .fb-mobile-brand i { font-style: normal; color: #10b981; }
        .fb-mobile-brand span.ic { width: 38px; height: 38px; border-radius: 10px; background: #047857; display: flex; align-items: center; justify-content: center; }
    </style>

    <div class="fb-page">
        <div class="fb-card">

            {{-- ============ LEFT ============ --}}
            <div class="fb-side">
                <div class="fb-glow"></div>

                <div class="fb-brand">
                    <div class="fb-brand-ico">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#a7f3d0" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/>
                        </svg>
                    </div>
                    <div class="fb-brand-name">bibliothèque<i>.</i></div>
                </div>

                {{-- Open book illustration --}}
                <div class="fb-book">
                    <svg width="260" height="170" viewBox="0 0 260 170" fill="none">
                        <ellipse cx="130" cy="155" rx="105" ry="9" fill="rgba(0,0,0,.25)"/>
                        <path d="M130 30 C100 14 55 14 22 28 V138 C55 124 100 124 130 140 Z" fill="#ecfdf5"/>
                        <path d="M130 30 C160 14 205 14 238 28 V138 C205 124 160 124 130 140 Z" fill="#d1fae5"/>
                        <path d="M130 30 V140" stroke="#059669" stroke-width="2.5"/>
                        <g stroke="#34d399" stroke-width="3" stroke-linecap="round" opacity=".85">
                            <path d="M40 52 C62 44 90 44 112 52"/>
                            <path d="M40 70 C62 62 90 62 112 70"/>
                            <path d="M40 88 C62 80 90 80 112 88"/>
                            <path d="M40 106 C62 98 90 98 100 104"/>
                            <path d="M148 52 C170 44 198 44 220 52"/>
                            <path d="M148 70 C170 62 198 62 220 70"/>
                            <path d="M148 88 C170 80 198 80 220 88"/>
                        </g>
                        <circle cx="205" cy="26" r="3" fill="#a7f3d0"/>
                        <circle cx="228" cy="12" r="2" fill="#6ee7b7"/>
                        <circle cx="38" cy="14" r="2.5" fill="#6ee7b7"/>
                    </svg>
                </div>

                <div class="fb-quote">
                    <h2>Chaque livre <br><em>trouve sa place.</em></h2>
                    <p>Gérez vos auteurs et votre catalogue depuis une plateforme simple, rapide et sécurisée.</p>
                    <div class="fb-tags">
                        <span>Auteurs</span>
                        <span>Livres</span>
                        <span>Catalogue</span>
                    </div>
                </div>
            </div>

            {{-- ============ RIGHT ============ --}}
            <div class="fb-form-wrap">

                <div class="fb-mobile-brand">
                    <span class="ic">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/>
                        </svg>
                    </span>
                    <div>FR<i>.</i>BIB</div>
                </div>

                <span class="fb-badge"><b></b> Nouveau compte</span>
                <h1 class="fb-title">Inscription</h1>
                <p class="fb-sub">Créez votre compte pour commencer à gérer votre bibliothèque.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="fb-field">
                        <label for="name" class="fb-label">Nom complet</label>
                        <div class="fb-input-box">
                            <svg class="fb-ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input id="name" class="fb-input" type="text" name="name"
                                   value="{{ old('name') }}" required autofocus autocomplete="name"
                                   placeholder="Votre nom">
                        </div>
                        @error('name') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="fb-field">
                        <label for="email" class="fb-label">Adresse email</label>
                        <div class="fb-input-box">
                            <svg class="fb-ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input id="email" class="fb-input" type="email" name="email"
                                   value="{{ old('email') }}" required autocomplete="username"
                                   placeholder="votre@email.com">
                        </div>
                        @error('email') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    {{-- Password --}}
                    <div class="fb-field">
                        <label for="password" class="fb-label">Mot de passe</label>
                        <div class="fb-input-box">
                            <svg class="fb-ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"/>
                            </svg>
                            <input id="password" class="fb-input" type="password" name="password"
                                   required autocomplete="new-password"
                                   placeholder="••••••••" style="padding-right: 48px;">
                            <button type="button" class="fb-eye" data-target="password" aria-label="Afficher le mot de passe">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.46 12C3.73 7.94 7.52 5 12 5c4.48 0 8.27 2.94 9.54 7-1.27 4.06-5.06 7-9.54 7-4.48 0-8.27-2.94-9.54-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="fb-field">
                        <label for="password_confirmation" class="fb-label">Confirmer le mot de passe</label>
                        <div class="fb-input-box">
                            <svg class="fb-ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"/>
                            </svg>
                            <input id="password_confirmation" class="fb-input" type="password" name="password_confirmation"
                                   required autocomplete="new-password"
                                   placeholder="••••••••" style="padding-right: 48px;">
                            <button type="button" class="fb-eye" data-target="password_confirmation" aria-label="Afficher le mot de passe">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.46 12C3.73 7.94 7.52 5 12 5c4.48 0 8.27 2.94 9.54 7-1.27 4.06-5.06 7-9.54 7-4.48 0-8.27-2.94-9.54-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <button type="submit" class="fb-btn">
                        Créer mon compte
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>

                <div class="fb-register">
                    Vous avez déjà un compte ?
                    <a href="{{ route('login') }}">Se connecter</a>
                </div>

                <p class="fb-copy">© {{ date('Y') }} FR.BIB — Gestion de votre bibliothèque</p>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.fb-eye').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var i = document.getElementById(btn.dataset.target);
                i.type = i.type === 'password' ? 'text' : 'password';
            });
        });
    </script>

</x-guest-layout>