<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function promotora(){
        return $this->belongsTo(Promotora::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'pedido_producto')->withPivot('cantidad');
    }
}
