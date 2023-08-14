<?php

namespace VarenykyForm\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function formFields()
    {
        return $this->hasMany(FormField::class);
    }
}