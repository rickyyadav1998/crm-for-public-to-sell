<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Company extends Model {protected $fillable=['name','email','phone','website','address','city','state','country','owner_id'];public function owner(){return $this->belongsTo(User::class,'owner_id');}}