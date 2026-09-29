<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('brochures')->where('file_path', 'downloads/avark-hms-brochure.pdf')->delete();
    }

    public function down(): void
    {
        // Unrelated sample content must not be restored on rollback.
    }
};
