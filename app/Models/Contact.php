<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model {protected $fillable=['company_id','owner_id','first_name','last_name','email','phone','job_title','notes'];public function company(){return $this->belongsTo(Company::class);}public function owner(){return $this->belongsTo(User::class,'owner_id');}}