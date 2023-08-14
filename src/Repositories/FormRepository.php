<?php

namespace VarenykyFrom\Repositories;

use Varenyky\Repositories\Repository;
use VarenykyFrom\Models\Form;

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
