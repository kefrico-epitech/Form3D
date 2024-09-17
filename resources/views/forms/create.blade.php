@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Créer un formulaire personnalisé</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('forms.store') }}">
        @csrf
        <!-- Nom du formulaire -->
        <div class="mb-4">
            <label for="name" class="form-label">Nom du formulaire</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ex: Formulaire de contact" required>
        </div>

        <!-- Conteneur pour les champs dynamiques -->
        <div id="fields-container" class="mb-4">
            <!-- Les champs personnalisés seront ajoutés ici -->
        </div>

        <!-- Bouton Ajouter un champ -->
        <div class="d-grid gap-2 mb-3">
            <button type="button" id="add-field" class="btn btn-outline-primary">
                <i class="bi bi-plus-circle"></i> Ajouter un champ
            </button>
        </div>

        <!-- Bouton Créer le formulaire -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Créer le formulaire</button>
        </div>
    </form>
</div>

<script>
    let fieldIndex = 0;

    // Fonction pour ajouter un champ dynamique
    document.getElementById('add-field').addEventListener('click', function() {
        const fieldContainer = document.createElement('div');
        fieldContainer.classList.add('card', 'p-3', 'mb-3', 'shadow-sm', 'field-card');
        fieldContainer.setAttribute('data-index', fieldIndex);

        fieldContainer.innerHTML = `
            <div class="mb-3">
                <label for="fields[${fieldIndex}][label]" class="form-label">Nom du champ</label>
                <input type="text" name="fields[${fieldIndex}][label]" class="form-control" placeholder="Ex: Adresse Email" required>
            </div>

            <div class="mb-3">
                <label for="fields[${fieldIndex}][type]" class="form-label">Type de champ</label>
                <select name="fields[${fieldIndex}][type]" class="form-select">
                    <option value="text">Texte</option>
                    <option value="email">Email</option>
                    <option value="textarea">Zone de texte</option>
                    <option value="select">Liste déroulante</option>
                    <option value="checkbox">Case à cocher</option>
                    <option value="button">Bouton</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="fields[${fieldIndex}][required]" class="form-check-input">
                <label class="form-check-label">Requis ?</label>
            </div>

            <!-- Conteneur pour les options de la liste déroulante (caché au départ) -->
            <div class="options-container" style="display: none;">
                <h5>Options de la liste déroulante</h5>
                <div class="options-wrapper"></div>
                <button type="button" class="btn btn-secondary btn-sm add-option-btn">Ajouter une option</button>
            </div>

            <!-- Bouton pour supprimer un champ -->
            <button type="button" class="btn btn-danger mt-2 remove-field">Supprimer ce champ</button>
        `;

        document.getElementById('fields-container').appendChild(fieldContainer);

        // Afficher le conteneur des options lorsque "select" est choisi
        fieldContainer.querySelector('select').addEventListener('change', function(event) {
            const optionsContainer = fieldContainer.querySelector('.options-container');
            if (event.target.value === 'select') {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
            }
        });

        // Ajouter des options dynamiques pour les listes déroulantes
        fieldContainer.querySelector('.add-option-btn').addEventListener('click', function() {
            const optionsWrapper = fieldContainer.querySelector('.options-wrapper');
            const optionIndex = optionsWrapper.children.length;

            const optionElement = document.createElement('div');
            optionElement.classList.add('input-group', 'mb-2');
            optionElement.innerHTML = `
                <input type="text" name="fields[${fieldIndex}][options][${optionIndex}]" class="form-control" placeholder="Option ${optionIndex + 1}" required>
                <button type="button" class="btn btn-danger btn-sm remove-option-btn">×</button>
            `;
            optionsWrapper.appendChild(optionElement);

            // Retirer l'option ajoutée
            optionElement.querySelector('.remove-option-btn').addEventListener('click', function() {
                optionElement.remove();
            });
        });

        // Bouton pour supprimer le champ entier
        fieldContainer.querySelector('.remove-field').addEventListener('click', function() {
            fieldContainer.remove();
        });

        fieldIndex++;
    });
</script>

@endsection
