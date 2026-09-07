
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contrat - {{ $abonnement->code }}</title>

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-900 max-w-3xl mx-auto p-8">

    <!-- Impression -->
    <div class="no-print text-right mb-6">
        <button
            onclick="window.print()"
            class="bg-gray-800 text-white px-4 py-2 rounded text-sm">
            Imprimer
        </button>
    </div>


    <!-- En-tête -->
    <div class="text-center mb-8">

        <h1 class="text-xl font-bold">
            ESPOIR PLUS
        </h1>

        <h2 class="text-lg font-semibold mt-2">
            CONTRAT D'ABONNEMENT
        </h2>

        <p class="text-sm mt-2">
            N° {{ $abonnement->menage->code }}
        </p>

    </div>


    <!-- Informations -->
    <div class="border border-gray-300">

        <div class="bg-gray-100 px-4 py-2 font-semibold">
            Informations de l'abonnement
        </div>

        <div class="p-4 space-y-3">

            <div class="flex">
                <span class="w-48 text-gray-600">Date de début :</span>
                <span class="font-medium">
                    {{ $abonnement->date_debut
                        ? \Carbon\Carbon::parse($abonnement->date_debut)->format('d/m/Y')
                        : '—'
                    }}
                </span>
            </div>

            <div class="flex">
                <span class="w-48 text-gray-600">Date de fin :</span>
                <span class="font-medium">
                    {{ $abonnement->date_fin
                        ? \Carbon\Carbon::parse($abonnement->date_fin)->format('d/m/Y')
                        : '—'
                    }}
                </span>
            </div>

            <div class="flex">
                <span class="w-48 text-gray-600">Statut :</span>
                <span class="font-medium">
                    {{ str_replace('_', ' ', $abonnement->status) }}
                </span>
            </div>

            <div class="flex">
                <span class="w-48 text-gray-600">Situation :</span>
                <span class="font-medium">
                    {{ $abonnement->menage->est_en_regle ? 'En règle' : 'Pas en règle' }}
                </span>
            </div>

        </div>

    </div>


    <!-- Client -->
    <div class="border border-gray-300 mt-6">

        <div class="bg-gray-100 px-4 py-2 font-semibold">
            Informations du client
        </div>

        <div class="p-4 space-y-3">

            <div class="flex">
                <span class="w-48 text-gray-600">Nom :</span>
                <span class="font-medium">
                    {{ $abonnement->menage->client->user->nom ?? 'Non renseigné' }}
                </span>
            </div>

            <div class="flex">
                <span class="w-48 text-gray-600">Désignation :</span>
                <span class="font-medium">
                    {{ $abonnement->menage->designation ?? '—' }}
                </span>
            </div>

            <div class="flex">
                <span class="w-48 text-gray-600">Quartier :</span>
                <span class="font-medium">
                    {{ $abonnement->menage->quartier->designation ?? '—' }}
                </span>
            </div>

            <div class="flex">
                <span class="w-48 text-gray-600">Type d'habitat :</span>
                <span class="font-medium">
                    {{ $abonnement->menage->typeHabitat->designation ?? '—' }}
                </span>
            </div>

            @if($abonnement->latitude && $abonnement->longitude)

                <div class="flex">
                    <span class="w-48 text-gray-600">Position GPS :</span>
                    <span class="font-medium">
                        {{ $abonnement->latitude }},
                        {{ $abonnement->longitude }}
                    </span>
                </div>

            @endif

        </div>

    </div>


    <!-- Déclaration -->
    <div class="mt-8 text-sm leading-6">

        <p>
            Le présent document confirme l'enregistrement de l'abonnement
            du client auprès de <strong>ESPOIR PLUS</strong>.
        </p>

        <p class="mt-3">
            Le client reconnaît les informations indiquées dans ce document
            et accepte les conditions liées à son abonnement.
        </p>

    </div>


    <!-- Radiation -->
    @if($abonnement->est_radier)

        <div class="border border-gray-400 p-3 mt-6 text-sm">
            <strong>Remarque :</strong>
            cet abonnement est actuellement radié.
        </div>

    @endif


    <!-- Signature -->
    <div class="mt-16">

        <p class="mb-8">
            Fait à ________________ le {{ now()->format('d/m/Y') }}
        </p>


        <div class="grid grid-cols-2 gap-16">

            <div>

                <p class="font-semibold">
                    Le client
                </p>

                <div class="h-20 border-b border-gray-400 mt-8"></div>

                <p class="text-xs text-gray-500 mt-2">
                    Signature
                </p>

            </div>


            <div>

                <p class="font-semibold">
                    ESPOIR PLUS
                </p>

                <div class="h-20 border-b border-gray-400 mt-8"></div>

                <p class="text-xs text-gray-500 mt-2">
                    Signature et cachet
                </p>

            </div>

        </div>

    </div>


    <!-- Footer -->
    <div class="border-t border-gray-300 mt-12 pt-3 text-center text-xs text-gray-500">

        <p>
            Espoir Plus
        </p>

        <p>
            Référence : {{ $abonnement->code }}
        </p>

    </div>

</body>

</html>

