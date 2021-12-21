<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewAttributesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('web_site_url')->nullable();
            $table->text('presentation')->nullable();
            $table->boolean('status')->default(false);
            $table->string('nickname')->unique();
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
            $table->dropColumn('web_site_url');
            $table->dropColumn('presentation');
            $table->dropColumn('status');
            $table->dropColumn('nickname');
        });
    }
}
