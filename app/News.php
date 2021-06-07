<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = 'news';
    protected $fillable = ['title','date','img','content','views'];
    // protected $guarded = ['view'];
    public $timestamps = false;
}
