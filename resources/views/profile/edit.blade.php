<x-app-layout>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

    @php
        $user = auth()->user();
        $mustVerify = $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail();
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
            background-image:
                linear-gradient(rgba(110,231,183,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(110,231,183,.06) 1px, transparent 1px);
            background-size: 48px 48px;
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
        }
        .fb-wrap { position: relative; z-index: 1; max-width: 820px; margin: 0 auto; padding: 24px; }

        @keyframes fb-rise { from { opacity: 0; transform: translateY(20px) scale(.98); } to { opacity: 1; transform: none; } }
        @keyframes fb-pulse { 0%,100% { opacity: .5; transform: scale(1);} 50% { opacity: .9; transform: scale(1.12);} }

        /* ===== TOP BAR ===== */
        .fb-top {
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 12px 18px; border-radius: 18px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            animation: fb-rise .6s ease-out both;
        }
        .fb-brand { display: flex; align-items: center; gap: 12px; }
        .fb-brand-ico {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.25);
        }
        .fb-brand-name { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; letter-spacing: .04em; }
        .fb-brand-name i { font-style: normal; color: #6ee7b7; }
        .fb-top-right { display: flex; align-items: center; gap: 10px; }
        .fb-pill-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 14px; border-radius: 10px; cursor: pointer; text-decoration: none;
            font-family: inherit; font-size: 13px; font-weight: 600; color: #ecfdf5;
            background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2);
            transition: background .2s, transform .2s;
        }
        .fb-pill-btn:hover { background: rgba(255,255,255,.2); transform: translateY(-1px); }
        .fb-top-right form { margin: 0; }

        /* ===== HERO ===== */
        .fb-hero {
            position: relative; overflow: hidden; margin-top: 22px;
            display: flex; align-items: center; gap: 20px;
            padding: 32px 36px; border-radius: 28px;
            background: linear-gradient(155deg, #064e3b 0%, #047857 60%, #059669 100%);
            box-shadow: 0 40px 90px -30px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.08);
            animation: fb-rise .7s ease-out .08s both;
        }
        .fb-hero::before {
            content: ""; position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.07) 1px, transparent 1px);
            background-size: 36px 36px;
            -webkit-mask-image: linear-gradient(180deg, #000, transparent 90%);
            mask-image: linear-gradient(180deg, #000, transparent 90%);
        }
        .fb-glow {
            position: absolute; width: 300px; height: 300px; border-radius: 50%;
            right: -90px; top: -120px;
            background: radial-gradient(circle, rgba(167,243,208,.45), transparent 70%);
            animation: fb-pulse 6s ease-in-out infinite;
        }
        .fb-hero > * { position: relative; }
        .fb-hero > .fb-glow { position: absolute; }
        .fb-hero-ava {
            flex: none; width: 76px; height: 76px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif; font-size: 30px; font-weight: 700; color: #064e3b;
            background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
            box-shadow: 0 0 0 5px rgba(255,255,255,.18);
        }
        .fb-badge {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
            color: #d1fae5; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.2);
            padding: 5px 11px; border-radius: 999px;
        }
        .fb-badge b { width: 6px; height: 6px; border-radius: 50%; background: #6ee7b7; display: block; }
        .fb-hero h1 { margin: 10px 0 0; font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; line-height: 1.15; }
        .fb-hero h1 em { font-style: italic; color: #a7f3d0; font-weight: 500; }
        .fb-hero p { margin: 6px 0 0; font-size: 14px; color: rgba(236,253,245,.82); word-break: break-all; }

        /* ===== SECTIONS ===== */
        .fb-sec {
            margin-top: 22px; padding: 32px 36px; border-radius: 24px;
            background: #fff; color: #022c22;
            box-shadow: 0 30px 60px -28px rgba(0,0,0,.6);
            animation: fb-rise .7s ease-out both;
        }
        .fb-sec:nth-of-type(1) { animation-delay: .16s; }
        .fb-sec-head { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 26px; }
        .fb-sec-ico {
            flex: none; width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            background: #d1fae5; color: #047857;
        }
        .fb-sec-ico svg { width: 24px; height: 24px; }
        .fb-sec h2 { margin: 0; font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; color: #022c22; }
        .fb-sec-head p { margin: 6px 0 0; font-size: 14px; line-height: 1.6; color: #6b7280; }

        .fb-field { margin-bottom: 18px; }
        .fb-label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #064e3b; }
        .fb-input {
            display: block; width: 100%; padding: 14px 16px;
            font-family: inherit; font-size: 15px; color: #064e3b;
            background: #f6faf8; border: 1.5px solid #e0e9e5; border-radius: 12px;
            transition: all .2s ease;
        }
        .fb-input::placeholder { color: #9bb3a8; }
        .fb-input:focus { outline: none; background: #fff; border-color: #059669; box-shadow: 0 0 0 4px rgba(5,150,105,.15); }
        .fb-error { margin: 6px 0 0; padding: 0; list-style: none; font-size: 12px; color: #dc2626; }

        .fb-save { display: flex; align-items: center; gap: 14px; margin-top: 8px; flex-wrap: wrap; }
        .fb-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 10px;
            padding: 14px 24px; border: 0; cursor: pointer; text-decoration: none;
            font-family: inherit; font-size: 15px; font-weight: 600; color: #fff;
            border-radius: 12px;
            background: linear-gradient(135deg, #047857, #059669 55%, #10b981);
            box-shadow: 0 12px 26px -10px rgba(5,150,105,.7);
            transition: transform .2s, box-shadow .2s, filter .2s;
        }
        .fb-btn:hover { transform: translateY(-2px); filter: brightness(1.06); }
        .fb-btn-danger { background: linear-gradient(135deg, #b91c1c, #dc2626); box-shadow: 0 12px 26px -10px rgba(220,38,38,.6); }
        .fb-btn-ghost {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 14px 24px; cursor: pointer; font-family: inherit; font-size: 15px; font-weight: 600;
            color: #047857; background: #ecfdf5; border: 1.5px solid #d1fae5; border-radius: 12px;
            transition: background .2s;
        }
        .fb-btn-ghost:hover { background: #d1fae5; }
        .fb-saved { font-size: 13px; font-weight: 600; color: #047857; background: #ecfdf5; padding: 8px 14px; border-radius: 10px; }
        .fb-status { margin-top: 12px; font-size: 13px; color: #047857; background: #ecfdf5; padding: 10px 14px; border-radius: 10px; }
        .fb-note { margin: -4px 0 18px; font-size: 13px; line-height: 1.6; color: #92400e; background: #fffbeb; border: 1px solid #fde68a; padding: 12px 14px; border-radius: 10px; }
        .fb-linkbtn { border: 0; background: none; padding: 0; cursor: pointer; font-family: inherit; font-size: 13px; font-weight: 700; color: #047857; text-decoration: underline; }

        .fb-danger-ico { background: #fee2e2; color: #b91c1c; }
        .fb-sec-danger { border: 1.5px solid #fecaca; }

        .fb-copy { margin: 26px 0 6px; text-align: center; font-size: 11px; color: rgba(209,250,229,.6); }

        /* ===== MODAL ===== */
        .fb-modal {
            position: fixed; inset: 0; z-index: 10000; display: none;
            align-items: center; justify-content: center; padding: 20px;
            background: rgba(2,31,25,.75); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        }
        .fb-modal.open { display: flex; }
        .fb-modal-box {
            width: 100%; max-width: 480px; padding: 32px; border-radius: 24px;
            background: #fff; color: #022c22;
            box-shadow: 0 40px 90px -20px rgba(0,0,0,.6);
            animation: fb-rise .35s ease-out both;
        }
        .fb-modal-box h3 { margin: 0; font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; }
        .fb-modal-box p { margin: 10px 0 20px; font-size: 14px; line-height: 1.6; color: #6b7280; }
        .fb-modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 6px; }

        /* ===== MOBILE ===== */
        @media (max-width: 700px) {
            .fb-wrap { padding: 14px; }
            .fb-hero { padding: 24px; flex-direction: column; align-items: flex-start; }
            .fb-hero h1 { font-size: 26px; }
            .fb-sec { padding: 24px 22px; }
            .fb-pill-btn span { display: none; }
        }
    </style>

    <div class="fb-page">
        <div class="fb-wrap">

            {{-- ============ TOP BAR ============ --}}
            <div class="fb-top">
                <div class="fb-brand">
                    <div class="fb-brand-ico">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#a7f3d0" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/>
                        </svg>
                    </div>
                    <div class="fb-brand-name">FR<i>.</i>BIB</div>
                </div>

                <div class="fb-top-right">
                    <a href="{{ route('dashboard') }}" class="fb-pill-btn">← <span>Tableau de bord</span></a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="fb-pill-btn">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- ============ HERO ============ --}}
            <div class="fb-hero">
                <div class="fb-glow"></div>
                <div class="fb-hero-ava">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                <div>
                    <span class="fb-badge"><b></b> Mon profil</span>
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            {{-- ============ INFORMATIONS ============ --}}
            <div class="fb-sec">
                <div class="fb-sec-head">
                    <div class="fb-sec-ico">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2>Informations du profil</h2>
                        <p>Mettez à jour votre nom et votre adresse email.</p>
                    </div>
                </div>

                @if ($mustVerify)
                    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="fb-field">
                        <label class="fb-label" for="name">Nom</label>
                        <input class="fb-input" id="name" name="name" type="text"
                               value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="email">Email</label>
                        <input class="fb-input" id="email" name="email" type="email"
                               value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    @if ($mustVerify)
                        <div class="fb-note">
                            Votre adresse email n'est pas vérifiée.
                            <button form="send-verification" class="fb-linkbtn">Cliquez ici pour renvoyer l'email de vérification.</button>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="fb-status">Un nouveau lien de vérification a été envoyé à votre adresse email.</div>
                        @endif
                    @endif

                    <div class="fb-save">
                        <button type="submit" class="fb-btn">Enregistrer</button>
                        @if (session('status') === 'profile-updated')
                            <span class="fb-saved">✓ Enregistré</span>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ============ MOT DE PASSE ============ --}}
            <div class="fb-sec">
                <div class="fb-sec-head">
                    <div class="fb-sec-ico">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"/>
                        </svg>
                    </div>
                    <div>
                        <h2>Mot de passe</h2>
                        <p>Utilisez un mot de passe long et aléatoire pour sécuriser votre compte.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="fb-field">
                        <label class="fb-label" for="update_password_current_password">Mot de passe actuel</label>
                        <input class="fb-input" id="update_password_current_password" name="current_password"
                               type="password" autocomplete="current-password" placeholder="••••••••">
                        @error('current_password', 'updatePassword') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="update_password_password">Nouveau mot de passe</label>
                        <input class="fb-input" id="update_password_password" name="password"
                               type="password" autocomplete="new-password" placeholder="••••••••">
                        @error('password', 'updatePassword') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="update_password_password_confirmation">Confirmer le mot de passe</label>
                        <input class="fb-input" id="update_password_password_confirmation" name="password_confirmation"
                               type="password" autocomplete="new-password" placeholder="••••••••">
                        @error('password_confirmation', 'updatePassword') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-save">
                        <button type="submit" class="fb-btn">Enregistrer</button>
                        @if (session('status') === 'password-updated')
                            <span class="fb-saved">✓ Enregistré</span>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ============ SUPPRIMER LE COMPTE ============ --}}
            <div class="fb-sec fb-sec-danger">
                <div class="fb-sec-head">
                    <div class="fb-sec-ico fb-danger-ico">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.9 12.1A2 2 0 0116.1 21H7.9a2 2 0 01-2-1.9L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div>
                        <h2>Supprimer le compte</h2>
                        <p>Une fois votre compte supprimé, toutes ses données seront définitivement effacées. Téléchargez ce que vous souhaitez conserver avant de continuer.</p>
                    </div>
                </div>

                <button type="button" class="fb-btn fb-btn-danger" id="fbOpenDelete">Supprimer le compte</button>
            </div>

            <p class="fb-copy">© {{ date('Y') }} FR.BIB — Gestion de votre bibliothèque</p>
        </div>
    </div>

    {{-- ============ MODAL SUPPRESSION ============ --}}
    <div class="fb-modal {{ $errors->userDeletion->isNotEmpty() ? 'open' : '' }}" id="fbDeleteModal">
        <div class="fb-modal-box">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h3>Êtes-vous sûr ?</h3>
                <p>Cette action est définitive. Saisissez votre mot de passe pour confirmer la suppression de votre compte.</p>

                <div class="fb-field">
                    <label class="fb-label" for="delete_password">Mot de passe</label>
                    <input class="fb-input" id="delete_password" name="password" type="password" placeholder="••••••••">
                    @error('password', 'userDeletion') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-modal-actions">
                    <button type="button" class="fb-btn-ghost" id="fbCloseDelete">Annuler</button>
                    <button type="submit" class="fb-btn fb-btn-danger">Supprimer le compte</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('fbDeleteModal');
            document.getElementById('fbOpenDelete').addEventListener('click', function () {
                modal.classList.add('open');
                document.getElementById('delete_password').focus();
            });
            document.getElementById('fbCloseDelete').addEventListener('click', function () {
                modal.classList.remove('open');
            });
            modal.addEventListener('click', function (e) { if (e.target === modal) modal.classList.remove('open'); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') modal.classList.remove('open'); });
        })();
    </script>

</x-app-layout>