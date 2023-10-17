<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(AttendanceRepositoryInterface $attendanceRepository, ScheduleRepositoryInterface $scheduleRepository) {
        $this->attendanceRepository = $attendanceRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function attendance(Request $request) {
        $payload = $request->get('payload');
        $input = $request->all();
        $data = $this->attendanceRepository->attendance($input);
        return $this->successResponse(201, 'Attendance success', $data, 201);
    }

    public function report(Request $request) {
        $classId = $request->get('class_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $data = $this->attendanceRepository->report($classId, $startDate, $endDate);
        $students = [];

        foreach ($data as $record) {
            if (!array_key_exists($record->student_id, $students)) {
                $students[$record->student_id] = [
                    'student_id' => $record->student_id,
                    'student_name' => $record->student_name,
                    'tuition_fee' => $record->tuition_fee,
                    'schedule' => []
                ];
            }

            $students[$record->student_id]['schedule'][] = [
                'schedule_date' => $record->schedule_date,
                'att_status' => $record->att_status
            ];
            $countItemCharge = count(array_filter($students[$record->student_id]['schedule'], function($item) {
                return $item['att_status'] == 1 || $item['att_status'] == 3;
            }));
            $totalMoney = $record->tuition_fee * $countItemCharge;
            $students[$record->student_id]['total_money'] = $totalMoney;
        }
        $resultReport = array_values($students);

        $schedules = $this->scheduleRepository->getListSchedule($startDate, $endDate, $classId);
        $result = [
          'students' => $resultReport,
          'schedules' => $schedules
        ];
        return $this->successResponse(200, 'success', $result, 200);
    }
}
