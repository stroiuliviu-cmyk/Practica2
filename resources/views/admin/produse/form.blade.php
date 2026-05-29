@extends('admin.layouts.app')

@section('title', $produs->exists ? 'Editează produs' : 'Adaugă produs')

@php
    $caracteristiciRaw = '';
    if (! empty($produs->caracteristici) && is_array($produs->caracteristici)) {
        $caracteristiciRaw = collect($produs->caracteristici)
            ->map(fn($v, $k) => "{$k}: {$v}")
            ->implode("\n");
    }
@endphp

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.produse.index') }}">Produse</a></li>
            <li class="breadcrumb-item active">{{ $produs->exists ? 'Editare' : 'Adăugare' }}</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4">{{ $produs->exists ? 'Editează produs' : 'Adaugă produs nou' }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ $produs->exists ? route('admin.produse.update', $produs) : route('admin.produse.store') }}"
                  method="POST">
                @csrf
                @if($produs->exists) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label for="denumire" class="form-label">Denumire *</label>
                        <input type="text"
                               class="form-control @error('denumire') is-invalid @enderror"
                               id="denumire" name="denumire"
                               value="{{ old('denumire', $produs->denumire) }}"
                               required>
                        @error('denumire') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="categorie_id" class="form-label">Categorie *</label>
                        <select class="form-select @error('categorie_id') is-invalid @enderror"
                                id="categorie_id" name="categorie_id" required>
                            <option value="" disabled {{ $produs->categorie_id ? '' : 'selected' }}>Alege...</option>
                            @foreach($categorii as $cat)
                                <option value="{{ $cat->id }}" {{ (int)old('categorie_id', $produs->categorie_id) === $cat->id ? 'selected' : '' }}>
                                    {{ $cat->denumire }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="descriere" class="form-label">Descriere</label>
                        <textarea class="form-control @error('descriere') is-invalid @enderror"
                                  id="descriere" name="descriere" rows="4">{{ old('descriere', $produs->descriere) }}</textarea>
                        @error('descriere') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="imagine" class="form-label">Cale imagine</label>
                        <input type="text"
                               class="form-control"
                               id="imagine" name="imagine"
                               value="{{ old('imagine', $produs->imagine) }}"
                               placeholder="img/placeholders/prod-x-1.svg">
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="pret_de_la" class="form-label">Preț de la (MDL)</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               class="form-control @error('pret_de_la') is-invalid @enderror"
                               id="pret_de_la" name="pret_de_la"
                               value="{{ old('pret_de_la', $produs->pret_de_la) }}">
                        @error('pret_de_la') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activ" id="activ" value="1"
                                   {{ old('activ', $produs->activ ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activ">Activ</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="caracteristici_raw" class="form-label">
                            Caracteristici (câte una pe linie, format <code>cheie: valoare</code>)
                        </label>
                        <textarea class="form-control"
                                  id="caracteristici_raw"
                                  name="caracteristici_raw"
                                  rows="5"
                                  placeholder="material: ceramică&#10;dimensiune: 330ml&#10;culoare: alb">{{ old('caracteristici_raw', $caracteristiciRaw) }}</textarea>
                        <small class="text-muted">
                            Exemplu: <code>material: ceramică</code> &nbsp;<code>dimensiune: 330ml</code>
                        </small>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            {{ $produs->exists ? 'Salvează modificările' : 'Adaugă produs' }}
                        </button>
                        <a href="{{ route('admin.produse.index') }}" class="btn btn-outline-secondary">Renunță</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
