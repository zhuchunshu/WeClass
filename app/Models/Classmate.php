<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Classmate extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'classmates';

    protected $fillable = ['id','name','phone','sex','type','dormitory','remark','created_at','update_at','job'];
}
