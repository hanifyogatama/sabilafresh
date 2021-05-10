<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnAndAddcolumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->renameColumn('name', 'nama_depan');
            $table->string('nama_belakang')->nullable()->after('name');
            $table->string('no_hp')->nullable()->after('email');
            $table->string('jk')->nullable()->after('no_hp');
            $table->text('alamat')->nullable()->after('remember_token');
            $table->integer('provinsi_id')->nullable()->after('alamat');
            $table->integer('kota_id')->nullable()->after('provinsi_id');
            $table->integer('kode_pos')->nullable()->after('kota_id');
            $table->boolean('is_admin')->default(false);
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
            $table->renameColumn('nama_depan', 'name');
            $table->dropColumn('nama_belakang');
            $table->dropColumn('no_hp');
            $table->dropColumn('jk');
            $table->dropColumn('alamat');
            $table->dropColumn('provinsi_id');
            $table->dropColumn('kota_id');
            $table->dropColumn('kode_pos');
            $table->dropColumn('is_admin');
        });
    }
}
