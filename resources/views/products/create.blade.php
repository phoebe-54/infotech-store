
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un produit - InfoTech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            InfoTech Store
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-light">
            Retour au catalogue
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-4">
                    <h2 class="mb-1">Ajouter un équipement</h2>
                    <p class="text-secondary mb-0">
                        Remplis les informations du produit.
                    </p>
                </div>

                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nom du produit</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   placeholder="Ex. Ordinateur HP"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Décris le produit">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prix (FCFA)</label>
                                <input type="number"
                                       name="price"
                                       class="form-control"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('price') }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantité en stock</label>
                                <input type="number"
                                       name="stock"
                                       class="form-control"
                                       min="0"
                                       value="{{ old('stock', 0) }}"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select name="category_id" class="form-select">
                                <option value="">Choisir une catégorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Image du produit</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                                   accept="image/*">
                            <small class="text-secondary">
                                Image facultative, 2 Mo maximum.
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Enregistrer le produit
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
