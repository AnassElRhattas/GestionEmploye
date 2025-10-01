<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedTinyInteger('evaluation_stars')->default(0)->after('disponible');
            $table->text('evaluation_remark')->nullable()->after('evaluation_stars');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['evaluation_stars', 'evaluation_remark']);
        });
    }
};


