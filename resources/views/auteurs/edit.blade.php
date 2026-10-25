<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un auteur</title>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11.8 15H9v-2.8l8.6-8.6z"/>
                    </svg>
                </div>
                <div>
                    <span class="fb-badge"><b></b> Modification</span>
                    <h1 class="fb-title">Modifier <em>l'auteur</em></h1>
                </div>
            </div>
            <p class="fb-sub">Modifiez les informations de l'auteur puis validez les changements.</p>
        </div>

        <div class="fb-body">
            <form action="{{ route('auteurs.update', $auteur) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="nom">Nom</label>
                        <input class="fb-input" id="nom" type="text" name="nom" value="{{ old('nom', $auteur->nom) }}">
                        @error('nom') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="prenom">Prénom</label>
                        <input class="fb-input" id="prenom" type="text" name="prenom" value="{{ old('prenom', $auteur->prenom) }}">
                        @error('prenom') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-field">
                    <label class="fb-label" for="email">Email</label>
                    <input class="fb-input" id="email" type="email" name="email" value="{{ old('email', $auteur->email) }}">
                    @error('email') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="date_naissance">Date de naissance</label>
                        <input class="fb-input" id="date_naissance" type="date" name="date_naissance"
                               value="{{ old('date_naissance', $auteur->date_naissance?->format('Y-m-d')) }}">
                        @error('date_naissance') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="nationalite">Nationalité</label>
                        <input class="fb-input" id="nationalite" type="text" name="nationalite" value="{{ old('nationalite', $auteur->nationalite) }}">
                        @error('nationalite') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-actions">
                    <button type="submit" class="fb-btn fb-grow">✓ Modifier l'auteur</button>
                    <a href="{{ route('auteurs.index') }}" class="fb-btn-ghost">Retour</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>