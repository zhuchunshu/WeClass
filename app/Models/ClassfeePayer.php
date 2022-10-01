<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ClassfeePayer extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'classfee_payer';

    protected $fillable = ['id','cycle_id','name','image','created_at','updated_at'];

    public function cycle(){
        return $this->belongsTo(ClassfeeCycle::class,'cycle_id');
    }
}
