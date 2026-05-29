@extends('admin.layouts.app')

@section('title', 'Mesaje contact')

@section('content')
    <h1 class="h3 mb-4">Mesaje de contact</h1>

    <div class="card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Subiect</th>
                        <th>Primit</th>
                        <th>Status</th>
                        <th class="text-end">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mesaje as $m)
                        <tr class="{{ $m->citit ? '' : 'fw-semibold' }}">
                            <td>{{ $m->id }}</td>
                            <td>{{ $m->nume }}</td>
                            <td><a href="mailto:{{ $m->email }}">{{ $m->email }}</a></td>
                            <td>{{ \Illuminate\Support\Str::limit($m->subiect, 40) }}</td>
                            <td><small>{{ $m->created_at->format('d.m.Y H:i') }}</small></td>
                            <td>
                                @if($m->citit)
                                    <span class="badge bg-success">Citit</span>
                                @else
                                    <span class="badge bg-warning text-dark">Necitit</span>
                                @endif
                            </td>
                            <td class="text-end admin-actions">
                                <a href="{{ route('admin.mesaje.show', $m) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.mesaje.destroy', $m) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Sigur ștergi acest mesaj?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Nu există mesaje.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($mesaje->hasPages())
            <div class="card-footer">{{ $mesaje->links() }}</div>
        @endif
    </div>
@endsection
