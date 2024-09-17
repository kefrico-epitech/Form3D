@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Liste des formulaires</h1>
        <a href="{{ route('forms.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Créer un nouveau formulaire
        </a>
    </div>

    @if($forms->count() > 0)
    <div class="row">
        @foreach($forms as $form)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">{{ $form->name }}</h5>
                    <p class="card-text text-muted">Créé le {{ $form->created_at->format('d/m/Y') }}</p>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('forms.show', $form->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i> Voir
                        </a>

                        <form action="{{ route('forms.destroy', $form->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce formulaire ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info">
        <p>Aucun formulaire disponible pour le moment. Cliquez sur "Créer un nouveau formulaire" pour en ajouter un.</p>
    </div>
    @endif
</div>
@endsection
