<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tienda extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }
}