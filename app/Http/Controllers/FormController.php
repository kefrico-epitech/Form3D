<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FormController extends Controller
{
    /**
     * Affiche la liste de tous les formulaires.
     */
    public function index()
    {
        // Récupérer tous les formulaires
        $forms = Form::all();

        return view('forms.index', compact('forms'));
    }
    /**
     * Afficher la page de création de formulaire.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Enregistrer un nouveau formulaire avec des champs dynamiques.
     */
    public function store(Request $request)
    {
        dd($request->all());
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*.type' => 'required|string', // Valide tous les champs 'type'
            'fields.*.label' => 'required|string', // Valide tous les champs 'label'
            'fields.*.required' => 'boolean|nullable', // Peut être null si non coché
            'fields.*.options' => 'nullable|array', // Les options pour les 'select' peuvent être nulles
        ]);

        // Créer le formulaire avec le nom
        $form = Form::create([
            'name' => $validatedData['name'],
            'user_id' => 1, // Assigner un user_id statique (user_id = 1) pour cet exemple
        ]);

        // Associer les champs au formulaire
        foreach ($validatedData['fields'] as $fieldData) {
            $options = null;

            // Si le champ est un select, chercher les options
            if ($fieldData['type'] === 'select' && isset($fieldData['options'])) {
                $options = $fieldData['options']; // On récupère les options
            }

            // Créer chaque champ du formulaire
            $form->fields()->create([
                'type' => $fieldData['type'],
                'label' => $fieldData['label'],
                'required' => $fieldData['required'] ?? false, // Si 'required' n'est pas défini, il est mis à false
                'options' => $options ? json_encode($options) : null, // Encoder les options en JSON si elles existent
            ]);
        }

        // Rediriger l'utilisateur vers la page de visualisation du formulaire avec un message de succès
        return redirect()->route('forms.show', $form->id)
            ->with('success', 'Formulaire créé avec succès!');
    }


    /**
     * Afficher un formulaire avec ses champs.
     */
    public function show(Form $form)
    {
        // Charger les champs liés au formulaire
        $fields = $form->fields;

        return view('forms.show', compact('form', 'fields'));
    }

    public function destroy() {}
}
