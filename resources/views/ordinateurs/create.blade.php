
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un PC - InfoTech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">InfoTech Store</a>
        <a href="{{ route('ordinateurs.index') }}" class="btn btn-light">Retour</a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-4">Ajouter un ordinateur</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('ordinateurs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nom du PC</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name') }}" placeholder="Ex. HP ProBook 450" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prix (FCFA)</label>
                                <input type="number" name="price" class="form-control"
                                       min="0" step="0.01" value="{{ old('price') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantité en stock</label>
                                <input type="number" name="stock" class="form-control"
                                       min="0" step="1" value="{{ old('stock', 0) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Marque</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Choisir une marque</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Image du PC</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-secondary">Image facultative, 2 Mo maximum.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Enregistrer l'ordinateur
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
