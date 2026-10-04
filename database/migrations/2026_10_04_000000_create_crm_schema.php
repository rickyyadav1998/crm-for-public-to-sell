<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
 public function up():void {
  $sql=file_get_contents(database_path('schema.sql'));
  foreach(array_filter(array_map('trim',preg_split('/;\\s*(?:\\r?\\n|$)/',$sql))) as $statement) DB::statement($statement);
 }
 public function down():void {
  foreach(['audit_logs','settings','notifications','tasks','deals','pipeline_stages','pipelines','lead_activities','lead_notes','lead_tags','tags','leads','contacts','companies','lead_statuses','lead_sources','user_roles','users','role_permissions','permissions','roles'] as $table) DB::statement("DROP TABLE IF EXISTS ".$table);
 }
};