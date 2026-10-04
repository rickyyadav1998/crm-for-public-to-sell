<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lead extends Model {
 protected $fillable=['company_id','contact_id','assigned_to','source_id','status_id','first_name','last_name','email','phone','title','value','currency','source_reference','source_payload'];
 protected function casts():array{return ['source_payload'=>'array','value'=>'decimal:2'];}
 public function source(){return $this->belongsTo(LeadSource::class,'source_id');}
 public function status(){return $this->belongsTo(LeadStatus::class,'status_id');}
 public function assignee(){return $this->belongsTo(User::class,'assigned_to');}
 public function company(){return $this->belongsTo(Company::class);}
 public function contact(){return $this->belongsTo(Contact::class);}
}