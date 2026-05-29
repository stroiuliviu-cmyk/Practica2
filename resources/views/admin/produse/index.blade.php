@extends('admin.layouts.app')

@section('title', 'Produse')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Produse</h1>
        <a href="{{ route('admin.produse.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Adaugă produs
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                <label for="categorie_id" class="mb-0">Filtrează după categorie:</label>
                <select name="categorie_id" id="categorie_id" class="form-select form-select-sm" style="max-width: 280px;" onchange="this.form.submit()">
                    <option value="">Toate categoriile</option>
                    @foreach($categorii as $cat)
                        <option value="{{ $cat->id }}" {{ (string)$filterCategorie === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->denumire }}
                        </option>
                    @endforeach
                </select>
                @if($filterCategorie)
                    <a href="{{ route('admin.produse.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Denumire</th>
                        <th>Categorie</th>
                        <th>Preț de la</th>
                        <th>Status</th>
                        <th class="text-end">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produse as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->denumire }}</td>
                            <td><small class="text-muted">{{ $p->categorie->denumire ?? '—' }}</small></td>
                            <td>
                                @if($p->pret_de_la)
                                    {{ number_format($p->pret_de_la, 0, ',', ' ') }} MDL
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if($p->activ)
                                    <span class="badge bg-success">Activ</span>
                                @else
                                    <span class="badge bg-secondary">Inactiv</span>
                                @endif
                            </td>
                            <td class="text-end admin-actions">
                                <a href="{{ route('admin.produse.edit', $p) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Editează">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.produse.destroy', $p) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Sigur ștergi produsul „{{ $p->denumire }}"?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Șterge">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Nu există produse.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($produse->hasPages())
            <div class="card-footer">
                {{ $produse->links() }}
            </div>
        @endif
    </div>
@endsection
