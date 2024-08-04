<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateFileStatusValues extends Migration
{
    public function up()
    {
        // Update values in the `status` column
        DB::table('files')
            ->where('status', 'Sudah Diprint')
            ->update(['status' => 'Sudah di Print']);
    }

    public function down()
    {
        // Revert values if needed
        DB::table('files')
            ->where('status', 'Sudah di Print')
            ->update(['status' => 'Sudah Diprint']);
    }
}
