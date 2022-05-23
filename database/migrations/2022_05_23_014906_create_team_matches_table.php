<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_matches', function (Blueprint $table) {
            $table->id();
            // $table->string("team_1",100)->nullable("false");
            // $table->string("team_2",100)->nullable("false");
            // $table->string("winner",100)->nullable("true");
            $table->enum('match_type',['Leage','QuarterFinal','SemiFinal','Final']);
            $table->timestamps();
            
            $table->bigInteger('team_1_id')->unsigned();
            $table->bigInteger('team_2_id')->unsigned();            
            $table->bigInteger('winner_id')->unsigned();
            
            $table->foreign('team_1_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_2_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('teams')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_matches');
    }
};
