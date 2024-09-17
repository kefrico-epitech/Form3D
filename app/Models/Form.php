<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    // Définir les champs qui peuvent être remplis
    protected $fillable = ['name', 'user_id'];

    /**
     * Relation avec les champs (fields)
     * Un formulaire a plusieurs champs
     */
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
