<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    protected $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index(Request $request) {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $data = $this->scheduleRepository->getListSchedule($startDate, $endDate);

        return $this->successResponse(200, 'Success', $data, Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $startTime = $request->get('start_time');
        $endTime = $request->get('end_time');
        $classId = $request->get('class_id');
        $dayName = $request->get('dayName');
        $data = $this->scheduleRepository->createSchedule($startDate, $endDate, $classId, $dayName, $startTime, $endTime);

        return $this->successResponse(201, 'Success', $data, Response::HTTP_CREATED);
    }

    public function show($id) {
        $data = $this->scheduleRepository->detailSchedule($id);
        $classRoom = $data->classRoom;
        $attendances = $data->attendance;

        $listStudent = $classRoom->students->map(function ($student) use ($attendances) {
            $student->attendance_status = 1;
            if (!$attendances->isEmpty()) {
                $attendances->map(function ($at) use ($student) {
                    if ($at->student_id == $student->id) {
                        $student->attendance_status = $at->status;
                    }
                    return $at;
                });
            }
            return $student;
        });
        $data->list_student = $listStudent;
        return $this->successResponse(200, 'Success', $data, Response::HTTP_OK);
    }

    public function edit(Request $request, $id) {
        $request->validate([
            'is_open' => ['required'],
            'note' => ['required']
        ]);
        $attributes = $request->only(['is_open', 'note']);
//        Log::info('edit schedule att', $attributes);
        $data = $this->scheduleRepository->editSchedule($attributes, $id);

        return $this->successResponse(200, 'Success', $data, Response::HTTP_OK);
    }
}
