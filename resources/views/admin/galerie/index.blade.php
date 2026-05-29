@extends('admin.layouts.app')

@section('title', 'Galerie')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Galerie lucrări</h1>
        <a href="{{ route('admin.galerie.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Adaugă lucrare
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 80px;">Imagine</th>
                        <th>Titlu</th>
                        <th>Categorie</th>
                        <th>Ordine</th>
                        <th>Status</th>
                        <th class="text-end">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($itemuri as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ asset($item->imagine) }}" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td>{{ $item->titlu }}</td>
                            <td><small class="text-muted">{{ $item->categorie->denumire ?? '—' }}</small></td>
                            <td>{{ $item->ordine_afisare }}</td>
                            <td>
                                @if($item->activ)
                                    <span class="badge bg-success">Activ</span>
                                @else
                                    <span class="badge bg-secondary">Inactiv</span>
                                @endif
                            </td>
                            <td class="text-end admin-actions">
                                <a href="{{ route('admin.galerie.edit', $item) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.galerie.destroy', $item) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Sigur ștergi această lucrare?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Nu există lucrări în galerie.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($itemuri->hasPages())
            <div class="card-footer">{{ $itemuri->links() }}</div>
        @endif
    </div>
@endsection
