<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ClassfeeCycle extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'classfee_cycle';

    protected $fillable = ['id','date','reason','amount','updated_at','created_at'];
}
