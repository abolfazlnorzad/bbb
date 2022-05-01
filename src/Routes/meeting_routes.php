<?php

use Illuminate\Support\Facades\Route;
use Nrz\Meeting\Http\Controllers\MeetingController;

Route::middleware("manage.meeting")->group(function () {
    Route::apiResource("meeting", MeetingController::class)->parameters([
        "meeting" => "meeting:meetingID"
    ]);
    Route::post("join/{meeting:meetingID}", [MeetingController::class, "joinToMeeting"]);
});

Route::get("{meeting:meetingID}" , [MeetingController::class , "callback"]);
