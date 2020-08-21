<?php

namespace App\Controllers\Database;

use Core\Database\Manager;
use Illuminate\Database\Schema\Blueprint;

class MigrationsController
{

    public function index()
    {
        /** @var Manager $database */
        $database = app('Database');

        $database->schema()->create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->text('text')->nullable();
            $table->boolean('done')->default(0);
            $table->boolean('edited')->default(0);
            $table->timestamps();
        });

    }
}