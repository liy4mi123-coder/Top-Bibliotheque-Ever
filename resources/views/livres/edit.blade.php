<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un livre</title>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11.8 15H9v-2.8l8.6-8.6z"/>
                    </svg>
                </div>
                <div>
                    <span class="fb-badge"><b></b> Modification</span>
                    <h1 class="fb-title">Modifier le <em>livre</em></h1>
                </div>
            </div>
            <p class="fb-sub">Modifiez les informations du livre puis validez les changements.</p>
        </div>

        <div class="fb-body">
            <form action="{{ route('livres.update', $livre) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="fb-field">
                    <label class="fb-label" for="auteur_id">Auteur</label>
                    <select class="fb-input" id="auteur_id" name="auteur_id">
                        @foreach($auteurs as $auteur)
                            <option value="{{ $auteur->id }}"
                                {{ old('auteur_id', $livre->auteur_id) == $auteur->id ? 'selected' : '' }}>
                                {{ $auteur->prenom }} {{ $auteur->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('auteur_id') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-field">
                    <label class="fb-label" for="titre">Titre</label>
                    <input class="fb-input" id="titre" type="text" name="titre" value="{{ old('titre', $livre->titre) }}">
                    @error('titre') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                </div>

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="isbn">ISBN</label>
                        <input class="fb-input" id="isbn" type="text" name="isbn" value="{{ old('isbn', $livre->isbn) }}">
                        @error('isbn') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="prix">Prix (DH)</label>
                        <input class="fb-input" id="prix" type="number" step="0.01" name="prix" value="{{ old('prix', $livre->prix) }}">
                        @error('prix') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-grid2">
                    <div class="fb-field">
                        <label class="fb-label" for="stock">Stock</label>
                        <input class="fb-input" id="stock" type="number" name="stock" value="{{ old('stock', $livre->stock) }}">
                        @error('stock') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>

                    <div class="fb-field">
                        <label class="fb-label" for="date_publication">Date de publication</label>
                        <input class="fb-input" id="date_publication" type="date" name="date_publication"
                               value="{{ old('date_publication', $livre->date_publication?->format('Y-m-d')) }}">
                        @error('date_publication') <ul class="fb-error"><li>{{ $message }}</li></ul> @enderror
                    </div>
                </div>

                <div class="fb-actions">
                    <button type="submit" class="fb-btn fb-grow">✓ Modifier le livre</button>
                    <a href="{{ route('livres.index') }}" class="fb-btn-ghost">Retour</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>