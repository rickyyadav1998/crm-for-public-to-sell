<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Deal extends Model {protected $fillable=['pipeline_id','stage_id','lead_id','contact_id','company_id','owner_id','title','value','currency','expected_close_date','status'];protected function casts():array{return ['value'=>'decimal:2','expected_close_date'=>'date'];}public function owner(){return $this->belongsTo(User::class,'owner_id');}}