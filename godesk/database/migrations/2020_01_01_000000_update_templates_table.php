<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function (Blueprint $table) {
            if(Schema::hasColumn('templates', 'title')) {
                $table->boolean('use_blocks')->default('0')->after('title');
                $table->longText('blocks')->nullable()->after('use_blocks');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('use_blocks');
            $table->dropColumn('blocks');
        });
    }
}
