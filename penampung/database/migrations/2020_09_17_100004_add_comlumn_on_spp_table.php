<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComlumnOnSppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('t_pembayaran_spp', function (Blueprint $table) {
            if (!Schema::hasColumn('status','file')) {
                $table->boolean('status')->default(0)->after('keterangan');
                $table->text('file')->nullable()->after('status');
            }
        });

        Schema::table('t_pembayaran_akhir', function (Blueprint $table) {
            $table->text('file')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
