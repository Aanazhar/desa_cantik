<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SiteContent extends Model {
 protected $table='isi_situs'; protected $fillable=['desa_id','key','value','hero_image'];
 public function desa(){return $this->belongsTo(DesaProfile::class,'desa_id');}
}
