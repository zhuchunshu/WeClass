<?php

namespace App\Admin\Repositories;

use App\Models\ClassfeePayer as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ClassfeePayer extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
