<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 200)->nullable()->after('id');
            $table->string('lastname', 200)->nullable()->after('firstname');
            $table->string('phone', 100)->nullable()->after('password');
            $table->smallInteger('user_type')->default(0)->after('phone')->comment('1: Super Admin, 0: Customer');
            $table->smallInteger('status')->default(0)->after('user_type');
            $table->text('comments')->nullable()->after('status');
            $table->string('file_path',300)->nullable()->after('comments');
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
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('phone');
            $table->dropColumn('user_type');
            $table->dropColumn('status');
            $table->dropColumn('comments');
            $table->dropColumn('file_path');
        });
    }
}
