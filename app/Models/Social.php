<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends Model
{
    // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name',
            'contract_name',
            'reconduction_name',
            'function',
            'city',
            'duration',
            'start_contract_date',
            'end_contract_date',
            'advance_notice_reconduction',
            'alarm1_date',
            'alarm2_date',
            'alarm3_date',
            'observation'   ];


    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class)->select(['name as text','id']);
    // }
}
