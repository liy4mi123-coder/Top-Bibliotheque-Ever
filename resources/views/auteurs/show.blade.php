<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détail de l'auteur</title>
    @include('auteurs._fb-style')
</head>

<body>
<div class="fb-page">
    <div class="fb-card">

        <div class="fb-head">
            <div class="fb-glow"></div>
            <a href="{{ route('auteurs.index') }}" class="fb-backlink">← Retour aux auteurs</a>
            <div class="fb-head-left">
                <div class="fb-hero-ava">{{ strtoupper(mb_substr($auteur->prenom, 0, 1) . mb_substr($auteur->nom, 0, 1)) }}</div>
                <div>
                    <span class="fb-badge"><b></b> Fiche auteur</span>
                    <h1 class="fb-title">{{ $auteur->prenom }} <em>{{ $auteur->nom }}</em></h1>
                </div>
            </div>
        </div>

        <div class="fb-body">

            <div class="fb-info">
                <div class="fb-info-row">
                    <span class="fb-info-label">Email</span>
                    <span class="fb-info-value">{{ $auteur->email }}</span>
                </div>

                <div class="fb-info-row">
                    <span class="fb-info-label">Nationalité</span>
                    <span class="fb-info-value">{{ $auteur->nationalite }}</span>
                </div>
            </div>

            <h2 class="fb-h2">Ses livres</h2>

            @if($auteur->livres->count() > 0)
                <ul class="fb-books">
                    @foreach($auteur->livres as $livre)
                        <li>
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 2H20v19H6.5A2.5 2.5 0 014 18.5v-14A2.5 2.5 0 016.5 2z"/>
                            </svg>
                            {{ $livre->titre }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="fb-nobooks">Aucun livre associé à cet auteur.</p>
            @endif

            <div class="fb-actions">
                <a href="{{ route('auteurs.edit', $auteur) }}" class="fb-btn fb-grow">Modifier l'auteur</a>
                <a href="{{ route('auteurs.index') }}" class="fb-btn-ghost">← Retour aux auteurs</a>
            </div>

        </div>

    </div>
</div>
</body>
</html>