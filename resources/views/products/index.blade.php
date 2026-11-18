
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imprimantes - InfoTech Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            InfoTech Store
        </a>

        <a href="{{ route('products.create') }}"
           class="btn btn-light">
            + Ajouter un produit
        </a>
    </div>
</nav>

<div class="container py-5">

    <h1 class="mb-2">Nos équipements informatiques</h1>
    <p class="text-secondary mb-4">
        Découvrez nos ordinateurs et accessoires.
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">

                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            class="card-img-top"
                            alt="{{ $product->name }}"
                            style="height:220px; object-fit:contain;"
                        >
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $product->name }}
                        </h5>

                        <p class="text-secondary">
                            {{ $product->category?->name ?? 'Sans catégorie' }}
                        </p>

                        <p class="card-text">
                            {{ $product->description }}
                        </p>

                        <h4 class="text-primary">
                            {{ number_format($product->price, 0, ',', ' ') }}
                            FCFA
                        </h4>

                        <p>Stock : {{ $product->stock }}</p>

                        <a href="{{ route('products.edit', $product) }}"
                           class="btn btn-warning">
                            Modifier
                        </a>

                        <form
                            action="{{ route('products.destroy', $product) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Supprimer ce produit ?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Aucun produit disponible pour le moment.
                    Ajoutez votre premier équipement !
                </div>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
