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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string("meetingID")->unique();
            $table->string("meetingName");
            $table->string("moderatorPW");
            $table->string("attendeePW");
            $table->string("fullName")->nullable();
            $table->text("welcome")->nullable();
            $table->string("logoutURL")->nullable();
            $table->string("duration")->default(0);
            $table->string("status")->default("open");
            $table->timestamp("finished_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
