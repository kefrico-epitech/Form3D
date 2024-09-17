@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des formulaires</h1>

    <a href="{{ route('forms.create') }}" class="btn btn-primary mb-4">Créer un nouveau formulaire</a>

    @if($forms->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form)
            <tr>
                <td>{{ $form->name }}</td>
                <td>{{ $form->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('forms.show', $form->id) }}" class="btn btn-info btn-sm">Voir</a>
                    {{-- <a href="{{ route('forms.show', $form->id) }}" class="btn btn-primary btn-sm">Modifier</a> --}}
                    <a href="{{ route('forms.delete', $form->id) }}" class="btn btn-delete btn-sm">Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun formulaire disponible.</p>
    @endif
</div>
@endsection
