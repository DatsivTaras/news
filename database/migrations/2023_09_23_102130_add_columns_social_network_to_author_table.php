<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsSocialNetworkToAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            if (!Schema::hasColumn('authors', 'instagram')) {
                $table->string('instagram')->nullable();
            }
            if (!Schema::hasColumn('authors', 'facebook')) {
                $table->string('facebook')->nullable();
            }
            if (!Schema::hasColumn('authors', 'twitter')) {
                $table->string('twitter')->nullable();
            }
            if (!Schema::hasColumn('authors', 'youTube')) {
                $table->string('youTube')->nullable();
            }
            if (!Schema::hasColumn('authors', 'tikTok')) {
                $table->string('tikTok')->nullable();
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
        Schema::table('author', function (Blueprint $table) {
            //
        });
    }
}
