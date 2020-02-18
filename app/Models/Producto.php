<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function pedidos(){
        return $this->belongsToMany(Pedido::class, 'pedido_producto')->withPivot('cantidad');
    }

    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }
}
