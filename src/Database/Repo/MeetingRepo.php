<?php

namespace Nrz\Meeting\Database\Repo;

use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;
use Nrz\Meeting\Models\Meeting;

class MeetingRepo
{
    protected function getQuery()
    {
        return Meeting::query();
    }

    public function getAllMeetingWithPaginate()
    {
        return $this->getQuery()->latest()->paginate(25);
    }

    public function createMeeting(array $data)
    {
        Bigbluebutton::create($data);
        return $this->getQuery()->create($data);
    }

    public function deleteMeeting(Meeting $meeting)
    {
        Bigbluebutton::close([
            'meetingID' => $meeting->meetingID,
            'moderatorPW' => $meeting->moderatorPW //moderator password set here
        ]);
        return $meeting->update([
            "finished_at"=>now(),
            "status"=>"close"
        ]);
    }

    public function joinMeeting(Meeting $meeting, $userName, $moderatorRole = false)
    {
        return Bigbluebutton::join([
            'meetingID' => $meeting->meetingID,
            'userName' => $userName,
            'password' => $moderatorRole ? $meeting->moderatorPW : $meeting->attendeePW //which user role want to join set password here
        ]);
    }
}
