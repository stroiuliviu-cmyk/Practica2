@extends('admin.layouts.app')

@section('title', $item->exists ? 'Editează lucrare' : 'Adaugă lucrare')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.galerie.index') }}">Galerie</a></li>
            <li class="breadcrumb-item active">{{ $item->exists ? 'Editare' : 'Adăugare' }}</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4">{{ $item->exists ? 'Editează lucrare' : 'Adaugă lucrare nouă' }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ $item->exists ? route('admin.galerie.update', $item) : route('admin.galerie.store') }}"
                  method="POST">
                @csrf
                @if($item->exists) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-12">
                        <label for="titlu" class="form-label">Titlu *</label>
                        <input type="text"
                               class="form-control @error('titlu') is-invalid @enderror"
                               id="titlu" name="titlu"
                               value="{{ old('titlu', $item->titlu) }}"
                               required>
                        @error('titlu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="descriere" class="form-label">Descriere</label>
                        <textarea class="form-control" id="descriere" name="descriere" rows="3" maxlength="500">{{ old('descriere', $item->descriere) }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="imagine" class="form-label">Cale imagine *</label>
                        <input type="text"
                               class="form-control @error('imagine') is-invalid @enderror"
                               id="imagine" name="imagine"
                               value="{{ old('imagine', $item->imagine) }}"
                               required>
                        @error('imagine') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="categorie_id" class="form-label">Categorie asociată</label>
                        <select class="form-select" id="categorie_id" name="categorie_id">
                            <option value="">— Fără categorie —</option>
                            @foreach($categorii as $cat)
                                <option value="{{ $cat->id }}" {{ (int)old('categorie_id', $item->categorie_id) === $cat->id ? 'selected' : '' }}>
                                    {{ $cat->denumire }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 col-md-2">
                        <label for="ordine_afisare" class="form-label">Ordine</label>
                        <input type="number"
                               class="form-control"
                               id="ordine_afisare" name="ordine_afisare"
                               value="{{ old('ordine_afisare', $item->ordine_afisare ?? 0) }}"
                               min="0">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activ" id="activ" value="1"
                                   {{ old('activ', $item->activ ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activ">Activă</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            {{ $item->exists ? 'Salvează' : 'Adaugă' }}
                        </button>
                        <a href="{{ route('admin.galerie.index') }}" class="btn btn-outline-secondary">Renunță</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
