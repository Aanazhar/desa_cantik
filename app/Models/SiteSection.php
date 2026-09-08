<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSection extends Model
{
    protected $table = 'bagian_situs';

    protected $fillable = [
        'desa_id','type','title','description','icon','url','is_letter',
        'form_fields','requirements','active','sort_order'
    ];

    protected $casts = [
        'desa_id' => 'integer',
        'is_letter' => 'boolean',
        'form_fields' => 'array',
        'requirements' => 'array',
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function letterRequests() { return $this->hasMany(LetterRequest::class, 'service_id'); }
    public function desa() { return $this->belongsTo(DesaProfile::class, 'desa_id'); }
}
