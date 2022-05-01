<?php

namespace Nrz\Meeting\Http\Controllers;

use Illuminate\Http\Request;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;
use Nrz\Meeting\Database\Repo\MeetingRepo;
use Nrz\Meeting\Http\Requests\JoinMeetingRequest;
use Nrz\Meeting\Http\Requests\MeetingRequest;
use Nrz\Meeting\Http\Resources\MeetingResource;
use Nrz\Meeting\Models\Meeting;

class MeetingController extends ApiController
{
    public MeetingRepo $meetingRepo;

    public function __construct()
    {
        $this->meetingRepo = new MeetingRepo();
    }


    public function index()
    {
        $meetings = MeetingResource::collection($this->meetingRepo->getAllMeetingWithPaginate());
        return $this->successResponse([
            "meetings" => $meetings,
            "meta" => $meetings->response()->getData()->meta
        ], 200, null);
        // todo create meeting
    }


    public function store(MeetingRequest $request)
    {
        $meeting = $this->meetingRepo->createMeeting($request->all());
        return $this->successResponse([
            "moderator" => $this->meetingRepo->joinMeeting($meeting, "admin", true),
        ], 201, "میتینگ با موفقیت ایجاد شد");
    }

    public function show(Meeting $meeting)
    {
        return $this->successResponse(new MeetingResource(Bigbluebutton::getMeetingInfo([
            'meetingID' => $this->meetingID,
            'moderatorPW' => $this->moderatorPW,
        ])), 200, null);
    }


    public function destroy(Meeting $meeting)
    {
        $this->meetingRepo->deleteMeeting($meeting);
        // todo delete meeting
        return $this->successResponse(null, 200, "میتینگ با موفقیت حذف شد");
    }

    public function joinToMeeting(Meeting $meeting, JoinMeetingRequest $request)
    {
        return $this->successResponse([
            "link" => $this->meetingRepo->joinMeeting($meeting, $request->userName, $request->moderatorRole ?? false)
        ], 200, null);
    }

    public function callback(Meeting $meeting)
    {
         $meeting->update([
            "finished_at"=>now(),
            "status"=>"close"
        ]);
         return $this->successResponse(null,200,"میتینگ با نوفقیت پایان یافت");
    }
}
