<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détail du livre</title>
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
                    <span class="fb-badge"><b></b> Fiche livre</span>
                    <h1 class="fb-title">{{ $livre->titre }}</h1>
                </div>
            </div>
        </div>

        <div class="fb-body">

            <div class="fb-info">
                <div class="fb-info-row">
                    <span class="fb-info-label">Auteur</span>
                    <span class="fb-info-value">
                        @if($livre->auteur)
                            {{ $livre->auteur->prenom }} {{ $livre->auteur->nom }}
                        @else
                            Aucun auteur
                        @endif
                    </span>
                </div>

                <div class="fb-info-row">
                    <span class="fb-info-label">ISBN</span>
                    <span class="fb-info-value">{{ $livre->isbn }}</span>
                </div>

                <div class="fb-info-row">
                    <span class="fb-info-label">Prix</span>
                    <span class="fb-info-value fb-price">{{ $livre->prix }} DH</span>
                </div>

                <div class="fb-info-row">
                    <span class="fb-info-label">Stock</span>
                    <span class="fb-info-value"><span class="fb-pill fb-pill-ok">{{ $livre->stock }}</span></span>
                </div>

                <div class="fb-info-row">
                    <span class="fb-info-label">Date de publication</span>
                    <span class="fb-info-value">{{ $livre->date_publication?->format('d/m/Y') ?? '—' }}</span>
                </div>
            </div>

            <div class="fb-actions">
                <a href="{{ route('livres.edit', $livre) }}" class="fb-btn fb-grow">Modifier le livre</a>
                <a href="{{ route('livres.index') }}" class="fb-btn-ghost">← Retour aux livres</a>
            </div>

        </div>

    </div>
</div>
</body>
</html>