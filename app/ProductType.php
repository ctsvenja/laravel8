<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $table = 'product_types';
    protected $fillable = ['name'];
    public $timestamps = false;
    public function products()
    {
        return $this->hasMany('App\Product','type_id','id');
    }
}
