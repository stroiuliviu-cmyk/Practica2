@extends('admin.layouts.app')

@section('title', 'Categorii')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Categorii</h1>
        <a href="{{ route('admin.categorii.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Adaugă categorie
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Denumire</th>
                        <th>Slug</th>
                        <th>Produse</th>
                        <th>Ordine</th>
                        <th>Status</th>
                        <th class="text-end">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorii as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td><strong>{{ $cat->denumire }}</strong></td>
                            <td><code>{{ $cat->slug }}</code></td>
                            <td>{{ $cat->produse_count }}</td>
                            <td>{{ $cat->ordine_afisare }}</td>
                            <td>
                                @if($cat->activ)
                                    <span class="badge bg-success">Activ</span>
                                @else
                                    <span class="badge bg-secondary">Inactiv</span>
                                @endif
                            </td>
                            <td class="text-end admin-actions">
                                <a href="{{ route('servicii.show', $cat->slug) }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="btn btn-sm btn-outline-secondary"
                                   title="Vezi pe site">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.categorii.edit', $cat) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Editează">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.categorii.destroy', $cat) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Sigur ștergi categoria „{{ $cat->denumire }}"? Această acțiune va șterge și toate produsele ei.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Șterge">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Nu există categorii.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
