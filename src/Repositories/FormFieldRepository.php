<?php

namespace VarenykyForm\Repositories;

use Varenyky\Repositories\Repository;
use VarenykyForm\Models\FormField;

class FormFieldRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(FormField $model)
    {
        $this->model = $model;
    }
}
