<?php

namespace Nrz\Meeting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        "meetingID",
        "meetingName",
        "moderatorPW",
        "attendeePW",
        "fullName",
        "welcome",
        "logoutURL",
        "duration",
        "status",
        "finished_at",
    ];
}
