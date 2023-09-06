<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNameToFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file', function (Blueprint $table) {
            $table->string('path', 500)->after('name');
        });

        if ($files = \App\Models\File::get()) {
            foreach ($files as $file) {
                $oldPath = $file->name;
                $file->name = basename($oldPath);
                $file->path = $oldPath;
                $file->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file', function (Blueprint $table) {
            //
        });
    }
}
