<?php

namespace App\Admin\Repositories;

use App\Models\ClassfeeCycle as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ClassfeeCycle extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
