<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
 public function up():void { DB::unprepared(file_get_contents(database_path('schema.sql'))); }
 public function down():void { foreach(['audit_logs','settings','notifications','tasks','deals','pipeline_stages','pipelines','lead_activities','lead_notes','lead_tags','tags','leads','contacts','companies','lead_statuses','lead_sources','user_roles','users','role_permissions','permissions','roles'] as $table) DB::statement("DROP TABLE IF EXISTS ".$table); }
};