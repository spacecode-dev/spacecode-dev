<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            if(!Schema::hasColumn('pages', 'variables')) {
                $table->longText('variables')->nullable()->after('index');
            }
            if(!Schema::hasColumn('pages', 'is_system')) {
                $table->boolean('is_system')->default(0)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('variables');
            $table->dropColumn('is_system');
        });
    }
}
