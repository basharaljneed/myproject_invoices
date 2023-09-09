<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_des',
        'product_name',
        'product_id',
        'section_name'
    ];

    public function refps(): BelongsTo
    {
       // return $this->belongsTo('App\section');

        return $this->belongsTo(Section::class,'product_id');
       // return $this->belongsTo(Section::class);

    }
}
