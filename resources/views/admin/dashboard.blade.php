@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <span class="text-muted small">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="admin-stat-card">
                <div class="stat-number">{{ $stats['categorii'] }}</div>
                <div class="stat-label">Categorii ({{ $stats['categorii_active'] }} active)</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="admin-stat-card">
                <div class="stat-number">{{ $stats['produse'] }}</div>
                <div class="stat-label">Produse ({{ $stats['produse_active'] }} active)</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="admin-stat-card">
                <div class="stat-number">{{ $stats['galerie'] }}</div>
                <div class="stat-label">Lucrări galerie</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="admin-stat-card">
                <div class="stat-number">{{ $stats['newsletter'] }}</div>
                <div class="stat-label">Abonați newsletter</div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="admin-stat-card" style="border-left-color: var(--bs-warning);">
                <div class="stat-number">{{ $stats['mesaje_necitite'] }}<small class="text-muted h5"> / {{ $stats['mesaje'] }}</small></div>
                <div class="stat-label">Mesaje contact necitite / total</div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="admin-stat-card" style="border-left-color: var(--bs-success);">
                <div class="stat-number"><i class="bi bi-shield-check"></i></div>
                <div class="stat-label">Site funcțional și securizat</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Ultimele mesaje de contact</h2>
            <a href="{{ route('admin.mesaje.index') }}" class="btn btn-sm btn-outline-primary">Vezi toate</a>
        </div>
        <div class="card-body p-0">
            @if($ultimeleMesaje->isEmpty())
                <p class="text-muted text-center py-4 mb-0">Nu există mesaje încă.</p>
            @else
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Nume</th>
                                <th>Email</th>
                                <th>Subiect</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimeleMesaje as $mesaj)
                                <tr>
                                    <td>{{ $mesaj->nume }}</td>
                                    <td><a href="mailto:{{ $mesaj->email }}">{{ $mesaj->email }}</a></td>
                                    <td>{{ \Illuminate\Support\Str::limit($mesaj->subiect, 40) }}</td>
                                    <td><small>{{ $mesaj->created_at->diffForHumans() }}</small></td>
                                    <td>
                                        @if($mesaj->citit)
                                            <span class="badge bg-success">Citit</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Necitit</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.mesaje.show', $mesaj) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
