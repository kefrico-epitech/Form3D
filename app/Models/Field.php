<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    // Définir les champs qui peuvent être remplis
    protected $fillable = ['form_id', 'type', 'label', 'required', 'options'];

    /**
     * Relation avec le formulaire
     * Un champ appartient à un seul formulaire
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Transformer les options en tableau si nécessaire
     */
    protected $casts = [
        'options' => 'array', // Transformer le champ options en tableau PHP
    ];
}
