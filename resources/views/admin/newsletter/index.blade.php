@extends('admin.layouts.app')

@section('title', 'Newsletter')

@section('content')
    <h1 class="h3 mb-4">Abonați newsletter</h1>

    <div class="card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Înscris la</th>
                        <th class="text-end">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td><a href="mailto:{{ $s->email }}">{{ $s->email }}</a></td>
                            <td>
                                @if($s->activ)
                                    <span class="badge bg-success">Activ</span>
                                @else
                                    <span class="badge bg-secondary">Inactiv</span>
                                @endif
                            </td>
                            <td><small>{{ $s->created_at->format('d.m.Y H:i') }}</small></td>
                            <td class="text-end">
                                <form action="{{ route('admin.newsletter.destroy', $s) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Sigur ștergi abonatul „{{ $s->email }}"?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Nu există abonați.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscribers->hasPages())
            <div class="card-footer">{{ $subscribers->links() }}</div>
        @endif
    </div>
@endsection
