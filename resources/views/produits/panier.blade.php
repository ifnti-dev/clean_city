<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/cart.js'])
</head>

<body>

        <div class="drawer-side z-50">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="menu bg-base-100 text-base-content min-h-full w-80 p-4">
                <h2 class="text-xl font-bold mb-4">Votre Panier</h2>

                <div class="panier">
                    @if (session('panier'))
                        @foreach (session('panier') as $item)
                            <div>{{ $item['label'] }} - Quantité: {{ $item['quantity'] }}</div>
                        @endforeach
                    @else
                        <p>Votre panier est vide</p>
                    @endif
                </div>

                <form action="" method="post">
                    @csrf
                    <x-secondary-button class="w-full">Commander</x-secondary-button>
                    <input type="hidden" name="ligneCommandes" id="ligneCommandes">
                </form>
            </div>
        </div>



</body>

</html>
