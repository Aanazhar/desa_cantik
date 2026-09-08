<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaStructure extends Model
{
    protected $table = 'perangkat_desa';

    protected $fillable = [
        'desa_id','parent_id','name','position','photo','sort_order','active'
    ];

    protected $casts = [
        'desa_id' => 'integer',
        'parent_id' => 'integer',
        'sort_order' => 'integer',
        'active' => 'boolean',
    ];
}
