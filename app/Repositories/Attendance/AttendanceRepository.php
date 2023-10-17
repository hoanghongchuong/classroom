<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class AttendanceRepository extends BaseRepository implements AttendanceRepositoryInterface
{
    public function __construct(Attendance $model)
    {
        parent::__construct($model);
    }

    public function attendance($payload)
    {
        $data = $this->model->upsert(
            $payload,
            ['student_id', 'schedule_id'],
            ['status']
        );
        return $data;
    }

    public function report($classId, $startDate, $endDate) {
//        DB::enableQueryLog();
        $data = $this->model
            ->selectRaw('attendances.id as att_id,attendances.status as att_status, attendances.student_id, c.name as class_name, s.schedule_date, s2.name as student_name, c.tuition_fee')
            ->leftjoin('classes as c', 'attendances.class_id', '=', 'c.id')
            ->leftjoin('schedules as s', 'attendances.schedule_id', '=', 's.id')
            ->leftjoin('students as s2', 'attendances.student_id', '=', 's2.id')
            ->where('c.id', $classId)
            ->whereBetween('s.schedule_date', [$startDate, $endDate])
            ->get();
//        dd(DB::getQueryLog());
        return $data;
    }
}
