
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ordinateurs - InfoTech Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f3f6fb;
            font-family: Arial, sans-serif;
            color: #1e293b;
        }

        .navbar {
            background: linear-gradient(110deg, #123b70, #1769aa);
            padding: 16px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: .3px;
        }

        .hero {
            background: linear-gradient(120deg, #123b70, #2585d8);
            color: white;
            padding: 38px;
            border-radius: 20px;
            margin-bottom: 32px;
            box-shadow: 0 10px 30px rgba(18, 59, 112, .15);
        }

        .hero p {
            color: #e1edff;
        }

        .product-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            background: white;
            box-shadow: 0 5px 20px rgba(15, 23, 42, .07);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, .13);
        }

        .product-image {
            height: 230px;
            width: 100%;
            object-fit: contain;
            padding: 20px;
            background: #fff;
        }

        .image-placeholder {
            height: 230px;
            background: #edf3fa;
            color: #718096;
        }

        .product-name {
            font-size: 1.15rem;
            font-weight: 700;
            min-height: 28px;
        }

        .product-description {
            color: #64748b;
            font-size: .93rem;
            min-height: 44px;
        }

        .product-price {
            color: #1769aa;
            font-size: 1.3rem;
            font-weight: 800;
        }

        .stock-badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: .8rem;
            font-weight: 600;
        }

        .stock-ok {
            color: #166534;
            background: #dcfce7;
        }

        .stock-low {
            color: #92400e;
            background: #fef3c7;
        }

        .stock-empty {
            color: #991b1b;
            background: #fee2e2;
        }

        .btn-edit {
            background: #0d9488;
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-edit:hover {
            background: #0f766e;
            color: white;
        }

        .btn-add {
            background: #fbbf24;
            color: #172033;
            font-weight: 700;
            border: none;
            border-radius: 9px;
        }

        .btn-add:hover {
            background: #f59e0b;
            color: #172033;
        }

        .section-title {
            font-weight: 800;
            color: #17365d;
        }

        .empty-state {
            background: white;
            border-radius: 16px;
            padding: 45px 20px;
            text-align: center;
        }

        @media (max-width: 576px) {
            .hero {
                padding: 25px 20px;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .hero h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container d-flex flex-wrap justify-content-between gap-3">

        <a class="navbar-brand fw-bold"
           href="{{ route('home') }}">
            <span class="me-2"></span>InfoTech Store
        </a>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('ordinateurs.index') }}"
               class="btn btn-light fw-semibold">
                Ordinateurs
            </a>

            <a href="{{ route('imprimantes.index') }}"
               class="btn btn-outline-light">
                Imprimantes
            </a>

            <a href="{{ route('ordinateurs.create') }}"
               class="btn btn-add">
                + Ajouter un PC
            </a>
        </div>

    </div>
</nav>

<main class="container py-4 py-md-5">

    <section class="hero">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <span class="badge bg-light text-primary mb-3 px-3 py-2">
                    Espace informatique
                </span>

                <h1 class="fw-bold mb-3">
                    Nos ordinateurs
                </h1>

                <p class="mb-0">
                    Découvrez notre sélection d'ordinateurs HP, Dell,
                    Lenovo, Apple, ASUS et Acer.
                    Trouvez l'équipement adapté à vos besoins.
                </p>
            </div>

            <div class="col-lg-4 text-lg-end">
                <div class="fs-1"></div>
                <div class="mt-1">
                    <span class="badge bg-light text-primary px-3 py-2">
                        {{ $products->count() }}
                        produit(s) affiché(s)
                    </span>
                </div>
            </div>
        </div>
    </section>



<form method="GET" action="{{ route('ordinateurs.index') }}"
      class="d-flex flex-column flex-sm-row gap-2 mb-4">

    <input
        type="search"
        name="search"
        class="form-control"
        placeholder="Rechercher un ordinateur ou une marque..."
        value="{{ request('search') }}"
    >

    <button type="submit" class="btn btn-primary">
        Rechercher
    </button>

    @if(request('search'))
        <a href="{{ route('ordinateurs.index') }}"
           class="btn btn-outline-secondary">
            Réinitialiser
        </a>
    @endif
</form>



    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"
             role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fermer">
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h2 class="section-title h4 mb-1">
                Notre catalogue
            </h2>
            <p class="text-secondary mb-0">
                Consultez les détails de nos produits.
            </p>
        </div>

        <a href="{{ route('ordinateurs.create') }}"
           class="btn btn-primary px-4 py-2">
            + Nouveau produit
        </a>
    </div>

    <div class="row g-4">

        @forelse ($products as $product)

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                <div class="card product-card h-100">

                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            class="product-image"
                            alt="{{ $product->name }}"
                            loading="lazy"
                        >
                    @else
                        <div class="image-placeholder d-flex flex-column align-items-center justify-content-center">
                            <span class="fs-1"></span>
                            <span class="mt-2">Aucune image</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">

                        <div class="mb-3">
                            <span class="badge rounded-pill text-bg-primary px-3 py-2">
                                {{ $product->category?->name ?? 'Sans catégorie' }}
                            </span>
                        </div>

                        <h3 class="product-name">
                            {{ $product->name }}
                        </h3>

                        <p class="product-description mt-2">
                            {{ $product->description ?: 'Aucune description disponible.' }}
                        </p>

                        <div class="product-price mb-3">
                            {{ number_format($product->price, 0, ',', ' ') }}
                            FCFA
                        </div>

                        <div class="mb-3">
                            @if ($product->stock <= 0)
                                <span class="stock-badge stock-empty">
                                    Rupture de stock
                                </span>
                            @elseif ($product->stock <= 5)
                                <span class="stock-badge stock-low">
                                    Stock faible : {{ $product->stock }}
                                </span>
                            @else
                                <span class="stock-badge stock-ok">
                                    En stock : {{ $product->stock }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-auto pt-2">
                            <a href="{{ route('products.edit', $product) }}"
                               class="btn btn-edit w-100">
                                 Modifier le produit
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="empty-state shadow-sm">
                    <div class="fs-1 mb-3">💻</div>

                    <h3 class="h5 fw-bold">
                        Aucun ordinateur disponible
                    </h3>

                    <p class="text-secondary">
                        Ajoutez votre premier ordinateur au catalogue.
                    </p>

                    <a href="{{ route('ordinateurs.create') }}"
   class="btn btn-primary px-4 py-2">
    Ajouter un PC
</a>
                </div>
            </div>

        @endforelse

    </div>
    

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
