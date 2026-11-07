<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier - Market place</title>

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/cart.js'])
</head>

<body class="bg-[#F0F2F5] min-h-screen text-gray-800 font-sans antialiased">

   <div class="max-w-6xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-extrabold tracking-tight uppercase mb-8">Votre Panier</h1>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Zone où le JS va injecter les produits -->
        <div id="liste-panier" class="lg:col-span-2 space-y-4"></div>

        <!-- Résumé à droite -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-6">
            <h2 class="text-lg font-bold text-gray-900">Order Summary</h2>
            <div class="flex justify-between items-baseline pt-2">
                <span class="text-base font-bold text-gray-900">Total</span>
                <span id="total-panier" class="text-2xl font-extrabold text-[#2F44DE]">0 FCFA</span>
            </div>
            <form action="" method="post" class="pt-2">
                @csrf
                <input type="hidden" name="ligneCommandes" id="ligneCommandes">
                <button type="submit" class="w-full bg-[#2F44DE] text-white font-bold py-3.5 px-4 rounded-xl">
                    Go to Checkout
                </button>
            </form>
        </div>
    </div>
</div>


</body>

</html>
