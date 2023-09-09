<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable=[
'section_name',
'descripation',
'created_by'
    ];


    public function ref()
    {

        return $this->hasOne(Product::class,'product_id');

    }
}
