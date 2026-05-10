<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'language')) {
                $table->string('language')->nullable()->after('category');
            }
            if (!Schema::hasColumn('books', 'binding')) {
                $table->string('binding')->nullable()->after('language');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['language', 'binding']);
        });
    }
};