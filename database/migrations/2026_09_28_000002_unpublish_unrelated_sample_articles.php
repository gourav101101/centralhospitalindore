<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('blogs')->whereIn('slug', [
            'future-of-erp-systems', 'choose-right-erp-inventory-system', 'crm-helps-startups-scale-faster',
        ])->update(['is_published' => false, 'updated_at' => now()]);
    }

    public function down(): void
    {
        // Do not republish unrelated sample content.
    }
};
