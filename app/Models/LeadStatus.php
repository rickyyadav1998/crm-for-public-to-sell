<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LeadStatus extends Model {protected $fillable=['name','slug','color','sort_order','is_closed'];protected function casts():array{return ['is_closed'=>'boolean'];}public function leads(){return $this->hasMany(Lead::class,'status_id');}}