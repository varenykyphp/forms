<?php

namespace VarenykyForm\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'form_id',
        'name',
        'slug',
        'type',
        'sort_order'
    ];
}