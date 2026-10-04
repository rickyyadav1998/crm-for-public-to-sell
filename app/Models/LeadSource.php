<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LeadSource extends Model {protected $fillable=['name','slug','is_active'];protected function casts():array{return ['is_active'=>'boolean'];}public function leads(){return $this->hasMany(Lead::class,'source_id');}}