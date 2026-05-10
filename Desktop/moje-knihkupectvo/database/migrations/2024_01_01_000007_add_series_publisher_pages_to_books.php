<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'series')) {
                $table->string('series')->nullable()->after('binding');
            }
            if (!Schema::hasColumn('books', 'publisher')) {
                $table->string('publisher')->nullable()->after('series');
            }
            if (!Schema::hasColumn('books', 'page_count')) {
                $table->integer('page_count')->nullable()->after('publisher');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['series', 'publisher', 'page_count']);
        });
    }
};