<?php

namespace App\Models;
use App\Models\Section;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];
    //protected $dates=['deleted_at'];
    public function refis(): BelongsTo
    {
       // return $this->belongsTo('App\section');

        return $this->belongsTo(Section::class,'section_id');
       // return $this->belongsTo(Section::class);

    }

}
