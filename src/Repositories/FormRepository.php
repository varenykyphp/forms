<?php

namespace VarenykyForm\Repositories;

use Varenyky\Repositories\Repository;
use VarenykyForm\Models\Form;

class FormRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(Form $model)
    {
        $this->model = $model;
    }
}
