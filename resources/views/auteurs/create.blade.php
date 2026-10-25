<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un auteur</title>
    @include('auteurs._fb-style')
</head>

<body>
<div class="fb-page">
    <div class="fb-card">

        <div class="fb-head">
            <div class="fb-glow"></div>
            <a href="{{ route('auteurs.index') }}" class="fb-backlink">← Retour aux auteurs</a>
            <div class="fb-head-left">
                <div class="fb-head-ico">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#a7f3d0" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <span class="fb-badge"><b></b> Nouvel auteur</span>
                    <h1 class="fb-title">Ajouter un <em>auteur</em></h1>
                </div>
            </div>
            <p class="fb-sub">Remplissez les informations du nouvel auteur.</p>
        </div>

        <div class="fb-body">
            <form action="{{ route('auteurs.store') }}" method="POST">
                @csrf

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="nom">Nom</label>
                        <input class="fb-input" id="nom" type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom">
                        @error('nom') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="prenom">Prénom</label>
                        <input class="fb-input" id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Prénom">
                        @error('prenom') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-field">
                    <label class="fb-label" for="email">Email</label>
                    <input class="fb-input" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="auteur@email.com">
                    @error('email') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="date_naissance">Date de naissance</label>
                        <input class="fb-input" id="date_naissance" type="date" name="date_naissance" value="{{ old('date_naissance') }}">
                        @error('date_naissance') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="nationalite">Nationalité</label>
                        <input class="fb-input" id="nationalite" type="text" name="nationalite" value="{{ old('nationalite') }}" placeholder="Nationalité">
                        @error('nationalite') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-actions">
                    <button type="submit" class="fb-btn fb-grow">+ Ajouter l'auteur</button>
                    <a href="{{ route('auteurs.index') }}" class="fb-btn-ghost">Retour</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>