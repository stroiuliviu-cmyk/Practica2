@extends('admin.layouts.app')

@section('title', 'Mesaj #' . $mesaj->id)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.mesaje.index') }}">Mesaje</a></li>
            <li class="breadcrumb-item active">#{{ $mesaj->id }}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">{{ $mesaj->subiect }}</h1>
            <div class="d-flex gap-2">
                <form action="{{ route('admin.mesaje.toggleCitit', $mesaj) }}" method="POST" class="m-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-{{ $mesaj->citit ? 'warning' : 'success' }}">
                        @if($mesaj->citit)
                            <i class="bi bi-envelope-open me-1"></i>Marchează ca necitit
                        @else
                            <i class="bi bi-envelope-check me-1"></i>Marchează ca citit
                        @endif
                    </button>
                </form>
                <form action="{{ route('admin.mesaje.destroy', $mesaj) }}"
                      method="POST"
                      onsubmit="return confirm('Sigur ștergi acest mesaj?');"
                      class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash me-1"></i>Șterge
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-2">De la:</dt>
                <dd class="col-sm-10">{{ $mesaj->nume }}</dd>

                <dt class="col-sm-2">Email:</dt>
                <dd class="col-sm-10"><a href="mailto:{{ $mesaj->email }}">{{ $mesaj->email }}</a></dd>

                @if($mesaj->telefon)
                    <dt class="col-sm-2">Telefon:</dt>
                    <dd class="col-sm-10"><a href="tel:{{ $mesaj->telefon }}">{{ $mesaj->telefon }}</a></dd>
                @endif

                <dt class="col-sm-2">Primit:</dt>
                <dd class="col-sm-10">{{ $mesaj->created_at->format('d.m.Y H:i:s') }} ({{ $mesaj->created_at->diffForHumans() }})</dd>
            </dl>

            <hr>
            <h5 class="mb-3">Mesaj:</h5>
            <div class="border rounded p-3 bg-light" style="white-space: pre-wrap;">{{ $mesaj->mesaj }}</div>

            <div class="mt-4">
                <a href="mailto:{{ $mesaj->email }}?subject=Re:%20{{ rawurlencode($mesaj->subiect) }}" class="btn btn-primary">
                    <i class="bi bi-reply me-1"></i>Răspunde prin email
                </a>
                <a href="{{ route('admin.mesaje.index') }}" class="btn btn-outline-secondary">Înapoi la listă</a>
            </div>
        </div>
    </div>
@endsection
