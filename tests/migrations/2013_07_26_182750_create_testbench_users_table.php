<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

class CreateTestbenchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('field1');
            $table->string('field2');
            $table->string('field3');
            $table->timestamps();
        });

        $now = Carbon::now();

        DB::table('users')->insert([
            'email' => 'hello@orchestraplatform.com',
            'password' => Hash::make('123'),
            'field1' => 'field1',
            'field2' => 'field2',
            'field3' => 'field3',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
