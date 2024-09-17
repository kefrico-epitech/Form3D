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
        /*  User::create([
            'name' => 'Admin',
            'email' => 'admin@agence3D.com',
            'password' => Hash::make('0000')
        ]); */
        // Prétraiter les données pour convertir les champs "required" en booléen
        $fields = collect($request->input('fields'))->map(function ($field) {
            $field['required'] = isset($field['required']) && $field['required'] == 'on'; // Convertir "on" en true
            return $field;
        })->toArray();

        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*.type' => 'required|string',
            'fields.*.label' => 'required|string',
            'fields.*.required' => 'nullable', // Peut être null si non coché, donc converti en booléen
        ]);

        // Créer le formulaire avec le nom
        $form = Form::create([
            'name' => $validatedData['name'],
            'user_id' => 1, // Assigner un user_id statique (user_id = 1) pour cet exemple
        ]);

        // dd($fields);
        // Associer les options des listes déroulantes aux champs select
        foreach ($fields as $fieldData) {
            $options = null;

            // Si le champ est un select, chercher les options
            if ($fieldData['type'] === 'select' && isset($fieldData['options'])) {
                $options = $fieldData['options'];
            }

            // Créer chaque champ du formulaire
            $form->fields()->create([
                'type' => $fieldData['type'],
                'label' => $fieldData['label'],
                'required' => $fieldData['required'],
                'options' => $options ? json_encode($options) : null, // Encoder les options en JSON si elles existent
            ]);
        }

        // Rediriger l'utilisateur vers la page de visualisation du formulaire avec un message de succès
        return redirect()->route('forms.show', $form->id)
            ->with('success', 'Formulaire créé avec succès!');
    }

    public function show(Form $form)
    {
        $fields = $form->fields;
        return view('forms.show', compact('form', 'fields'));
    }

    public function destroy($id)
    {
        $form = Form::findOrFail($id);
        $form->fields()->delete();
        $form->delete();
        return redirect()->route('forms.index')
            ->with('success', 'Le formulaire a été supprimé avec succès.');
    }
}
