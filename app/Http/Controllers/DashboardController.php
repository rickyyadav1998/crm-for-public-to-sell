<?php
namespace App\Http\Controllers;
use App\Models\Deal;
use App\Models\Lead;
use Illuminate\View\View;
class DashboardController extends Controller {
 public function index():View {
  return view('dashboard',[
   'totalLeads'=>Lead::count(),
   'newLeads'=>Lead::whereHas('status',fn($q)=>$q->where('slug','new'))->count(),
   'openDealsValue'=>Deal::where('status','open')->sum('value'),
   'recentLeads'=>Lead::with(['source','status','assignee'])->latest()->limit(8)->get()
  ]);
 }
}