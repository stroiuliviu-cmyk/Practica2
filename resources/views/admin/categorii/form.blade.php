@extends('admin.layouts.app')

@section('title', $categorie->exists ? 'Editează categorie' : 'Adaugă categorie')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.categorii.index') }}">Categorii</a></li>
            <li class="breadcrumb-item active">{{ $categorie->exists ? 'Editare' : 'Adăugare' }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ $categorie->exists ? 'Editează categorie' : 'Adaugă categorie nouă' }}</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ $categorie->exists ? route('admin.categorii.update', $categorie) : route('admin.categorii.store') }}"
                  method="POST">
                @csrf
                @if($categorie->exists)
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label for="denumire" class="form-label">Denumire *</label>
                        <input type="text"
                               class="form-control @error('denumire') is-invalid @enderror"
                               id="denumire" name="denumire"
                               value="{{ old('denumire', $categorie->denumire) }}"
                               required>
                        @error('denumire') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="slug" class="form-label">Slug URL</label>
                        <input type="text"
                               class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug"
                               value="{{ old('slug', $categorie->slug) }}"
                               placeholder="auto din denumire">
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="descriere_scurta" class="form-label">Descriere scurtă (afișată pe carduri)</label>
                        <input type="text"
                               class="form-control @error('descriere_scurta') is-invalid @enderror"
                               id="descriere_scurta" name="descriere_scurta"
                               value="{{ old('descriere_scurta', $categorie->descriere_scurta) }}"
                               maxlength="300">
                        @error('descriere_scurta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="descriere_completa" class="form-label">Descriere completă (afișată pe pagina categoriei)</label>
                        <textarea class="form-control @error('descriere_completa') is-invalid @enderror"
                                  id="descriere_completa" name="descriere_completa" rows="5">{{ old('descriere_completa', $categorie->descriere_completa) }}</textarea>
                        @error('descriere_completa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="imagine" class="form-label">Cale imagine</label>
                        <input type="text"
                               class="form-control"
                               id="imagine" name="imagine"
                               value="{{ old('imagine', $categorie->imagine) }}"
                               placeholder="img/placeholders/cat-x.svg">
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="ordine_afisare" class="form-label">Ordine afișare</label>
                        <input type="number"
                               class="form-control"
                               id="ordine_afisare" name="ordine_afisare"
                               value="{{ old('ordine_afisare', $categorie->ordine_afisare ?? 0) }}"
                               min="0">
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activ" id="activ" value="1"
                                   {{ old('activ', $categorie->activ ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activ">Activ</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            {{ $categorie->exists ? 'Salvează modificările' : 'Adaugă categorie' }}
                        </button>
                        <a href="{{ route('admin.categorii.index') }}" class="btn btn-outline-secondary">Renunță</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
