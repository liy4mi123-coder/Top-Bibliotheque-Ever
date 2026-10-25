<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un livre</title>
    @include('auteurs._fb-style')
    @include('livres._fb-extra')
</head>

<body>
<div class="fb-page">
    <div class="fb-card">

        <div class="fb-head">
            <div class="fb-glow"></div>
            <a href="{{ route('livres.index') }}" class="fb-backlink">← Retour aux livres</a>
            <div class="fb-head-left">
                <div class="fb-head-ico">
                    <svg fill="none" viewBox="0 0 24 24" stroke="#a7f3d0" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/>
                    </svg>
                </div>
                <div>
                    <span class="fb-badge"><b></b> Nouveau livre</span>
                    <h1 class="fb-title">Ajouter un <em>livre</em></h1>
                </div>
            </div>
            <p class="fb-sub">Remplissez les informations du nouveau livre.</p>
        </div>

        <div class="fb-body">
            <form action="{{ route('livres.store') }}" method="POST">
                @csrf

                <div class="fb-field">
                    <label class="fb-label" for="auteur_id">Auteur</label>
                    <select class="fb-input" id="auteur_id" name="auteur_id">
                        @foreach($auteurs as $auteur)
                            <option value="{{ $auteur->id }}" {{ old('auteur_id') == $auteur->id ? 'selected' : '' }}>
                                {{ $auteur->prenom }} {{ $auteur->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('auteur_id') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-field">
                    <label class="fb-label" for="titre">Titre</label>
                    <input class="fb-input" id="titre" type="text" name="titre" value="{{ old('titre') }}" placeholder="Titre du livre">
                    @error('titre') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="isbn">ISBN</label>
                        <input class="fb-input" id="isbn" type="text" name="isbn" value="{{ old('isbn') }}" placeholder="978-...">
                        @error('isbn') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="prix">Prix (DH)</label>
                        <input class="fb-input" id="prix" type="number" step="0.01" name="prix" value="{{ old('prix') }}" placeholder="0.00">
                        @error('prix') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="stock">Stock</label>
                        <input class="fb-input" id="stock" type="number" name="stock" value="{{ old('stock') }}" placeholder="0">
                        @error('stock') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="date_publication">Date de publication</label>
                        <input class="fb-input" id="date_publication" type="date" name="date_publication" value="{{ old('date_publication') }}">
                        @error('date_publication') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-actions">
                    <button type="submit" class="fb-btn fb-grow">+ Ajouter le livre</button>
                    <a href="{{ route('livres.index') }}" class="fb-btn-ghost">Retour</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>