
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contrat d'Abonnement - {{ $abonnement->code }}</title>

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
</head>

<body class="bg-white text-black font-serif text-sm max-w-3xl mx-auto p-8 print:p-0">

    <!-- BOUTON IMPRESSION -->
    <div class="no-print flex justify-end mb-8">
        <button
            onclick="window.print()"
            class="px-4 py-2 bg-gray-800 text-white font-sans text-sm rounded">
            Imprimer / PDF
        </button>
    </div>


    <!-- EN-TÊTE -->
    <header class="text-center border-b-2 border-black pb-5 mb-8">

        <h1 class="text-lg font-bold uppercase">
            ESPOIR PLUS
        </h1>

        <p class="text-xs mt-1">
            Contrat d'abonnement
        </p>

        <p class="text-xs mt-3">
            Référence : <strong>{{ $abonnement->code }}</strong>
        </p>

    </header>


    <!-- INTRODUCTION -->
    <div class="text-justify leading-6 mb-6">

        <p>
            Entre les soussignés, <strong>ESPOIR PLUS</strong>, ci-après
            dénommé « le Prestataire », et le titulaire du présent
            abonnement, il est convenu ce qui suit :
        </p>

    </div>


    <!-- ARTICLE 1 -->
    <section class="mb-6">

        <h2 class="font-bold uppercase mb-3">
            Article 1 — Identification du titulaire
        </h2>

        <p class="leading-6">
            Nom du client :
            <strong>
                {{ $abonnement->menage->client->user->nom ?? 'Non renseigné' }}
            </strong>
        </p>

        <p class="leading-6">
            Désignation :
            <strong>
                {{ $abonnement->menage->designation ?? '—' }}
            </strong>
        </p>

        <p class="leading-6">
            Quartier :
            <strong>
                {{ $abonnement->menage->quartier->designation ?? '—' }}
            </strong>
        </p>

        <p class="leading-6">
            Type d'habitat :
            <strong>
                {{ $abonnement->menage->typeHabitat->designation ?? '—' }}
            </strong>
        </p>

        @if($abonnement->latitude && $abonnement->longitude)

            <p class="leading-6">
                Coordonnées GPS :
                <strong>
                    {{ $abonnement->latitude }} ,
                    {{ $abonnement->longitude }}
                </strong>
            </p>

        @endif

    </section>


    <!-- ARTICLE 2 -->
    <section class="mb-6">

        <h2 class="font-bold uppercase mb-3">
            Article 2 — Objet de l'abonnement
        </h2>

        <p class="text-justify leading-6">
            Le présent contrat a pour objet de définir les conditions
            d'abonnement du titulaire aux services proposés par
            <strong>ESPOIR PLUS</strong>.
        </p>

        <p class="text-justify leading-6 mt-2">
            Le titulaire reconnaît avoir pris connaissance des
            conditions applicables à son abonnement et s'engage à
            respecter les obligations qui en découlent.
        </p>

    </section>


    <!-- ARTICLE 3 -->
    <section class="mb-6">

        <h2 class="font-bold uppercase mb-3">
            Article 3 — Durée de l'abonnement
        </h2>

        <p class="text-justify leading-6">
            Le présent abonnement prend effet à compter du
            <strong>
                {{ $abonnement->date_debut
                    ? \Carbon\Carbon::parse($abonnement->date_debut)->format('d/m/Y')
                    : '—'
                }}
            </strong>
            et arrive à échéance le
            <strong>
                {{ $abonnement->date_fin
                    ? \Carbon\Carbon::parse($abonnement->date_fin)->format('d/m/Y')
                    : '—'
                }}
            </strong>.
        </p>

    </section>


    <!-- ARTICLE 4 -->
    <section class="mb-6">

        <h2 class="font-bold uppercase mb-3">
            Article 4 — Statut de l'abonnement
        </h2>

        <p class="leading-6">
            Statut de la demande :
            <strong>
                {{ str_replace('_', ' ', $abonnement->status) }}
            </strong>
        </p>

        <p class="leading-6">
            Situation financière :
            <strong>
                {{ $abonnement->est_en_regle ? 'En règle' : 'Pas en règle' }}
            </strong>
        </p>

        <p class="leading-6">
            État du raccordement :
            <strong>
                {{ $abonnement->est_abonnee ? 'Abonné' : 'Non abonné' }}
            </strong>
        </p>

    </section>


    <!-- ARTICLE 5 -->
    <section class="mb-8">

        <h2 class="font-bold uppercase mb-3">
            Article 5 — Engagement des parties
        </h2>

        <p class="text-justify leading-6">
            Le titulaire s'engage à fournir des informations exactes,
            à respecter les conditions de l'abonnement et à s'acquitter
            des obligations financières liées au service.
        </p>

        <p class="text-justify leading-6 mt-2">
            ESPOIR PLUS s'engage, dans la mesure de ses possibilités,
            à assurer le service conformément aux conditions
            applicables à l'abonnement.
        </p>

    </section>


    <!-- VALIDATION -->
    <section class="mb-10">

        <h2 class="font-bold uppercase mb-3">
            Article 6 — Validation
        </h2>

        @if($abonnement->status === 'APPROUVER')

            <p class="leading-6">
                Le présent abonnement a été approuvé par :
            </p>

            <p class="leading-6">
                <strong>
                    {{ $abonnement->employe_approuve->user->nom ?? '—' }}
                    {{ $abonnement->employe_approuve->user->prenom ?? '' }}
                </strong>
            </p>

        @elseif($abonnement->status === 'REJETER')

            <p class="leading-6">
                La demande d'abonnement a été rejetée.
            </p>

            <p class="leading-6">
                Motif :
                <strong>
                    {{ $abonnement->motif_rejet ?? 'Non spécifié' }}
                </strong>
            </p>

        @else

            <p class="leading-6 italic">
                La demande est en attente de validation.
            </p>

        @endif

    </section>


    <!-- DATE -->
    <div class="text-center mb-12">

        <p>
            Fait à ____________________, le {{ now()->format('d/m/Y') }}
        </p>

    </div>


    <!-- SIGNATURES -->
    <div class="grid grid-cols-2 gap-16">

        <div class="text-center">

            <p class="font-bold uppercase">
                Le titulaire
            </p>

            <p class="text-xs mt-1">
                Lu et approuvé
            </p>

            <div class="mt-16 border-b border-black"></div>

            <p class="text-xs mt-2">
                Signature
            </p>

        </div>


        <div class="text-center">

            <p class="font-bold uppercase">
                Pour ESPOIR PLUS
            </p>

            <p class="text-xs mt-1">
                Lu et approuvé
            </p>

            <div class="mt-16 border-b border-black"></div>

            <p class="text-xs mt-2">
                Signature et cachet
            </p>

        </div>

    </div>


    <!-- PIED DE PAGE -->
    <footer class="border-t border-black mt-12 pt-3 text-center">

        <p class="text-xs">
            ESPOIR PLUS — Contrat d'abonnement
        </p>

        <p class="text-xs mt-1">
            Référence : {{ $abonnement->code }}
        </p>

    </footer>

</body>

</html>

