<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillagePage extends Model
{
    protected $table = 'village_pages';
    protected $fillable = ['desa_id','category','title','slug','excerpt','body','image','sort_order','active'];
    protected $casts = ['active'=>'boolean'];
    public function desa(){ return $this->belongsTo(DesaProfile::class,'desa_id'); }
}
