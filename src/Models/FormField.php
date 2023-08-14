<?php

namespace VarenykyForm\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'sort_order'
    ];
}