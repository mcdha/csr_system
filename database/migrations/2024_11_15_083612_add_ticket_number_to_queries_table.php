<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('queries', function (Blueprint $table) {
        $table->string('ticket_number')->nullable()->after('resolved_at');
    });
}

public function down()
{
    Schema::table('queries', function (Blueprint $table) {
        $table->dropColumn('ticket_number');
    });
}
};
