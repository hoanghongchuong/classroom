<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
{
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }

    public function getListSchedule($startDate, $endDate, $classId = null): Collection|array
    {
        $data = $this->model->select('schedules.id', 'schedules.is_open', 'schedules.schedule_date',
            DB::raw('CONCAT(schedules.schedule_date, " ", schedules.start_time) as start'),
            DB::raw('CONCAT(schedules.schedule_date, " ", schedules.end_time) as end'),
            'c.name as title')
            ->join('classes as c', 'c.id', '=', 'schedules.class_id')
            ->whereBetween('schedule_date', [$startDate, $endDate]);
        if($classId) {
            $data->where('schedules.class_id', '=', $classId);
        }

        return $data->get();
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param int $classId
     * @param array $dayName
     * @param $startTime
     * @param $endTime
     * @return array
     */
    public function createSchedule($startDate, $endDate, int $classId, array $dayName, $startTime, $endTime): array
    {

        $schedules = [];
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        while ($startDate <= $endDate) {
            if (in_array($startDate->format('l'), $dayName)) {
                array_push($schedules, [
                    'date' => $startDate->format('Y-m-d'),
                    'day_name' => $startDate->format('l')
                ]);
            }
            $startDate->addDay();
        }
        $createdItem = [];
        foreach ($schedules as $schedule) {
            $attributes = [
                'class_id' => $classId,
                'schedule_date' => $schedule['date'],
                'day_name' => $schedule['day_name'],
                'start_time' => $startTime,
                'end_time' => $endTime
            ];
            $item = $this->create($attributes);
            $createdItem[] = $item;
        }
        return $createdItem;
    }

    public function detailSchedule($id)
    {
//        DB::enableQueryLog();
        $data = $this->model->with(['classRoom.students', 'attendance'])->where('id', $id)->first();
//        $data = DB::select("SELECT s.id AS schedule_id, a.student_id, c.name AS class_name, a.id AS attendance_id, a.status as attendance_status, a.note
//                FROM schedules s
//                JOIN classes c ON s.class_id = c.id
//                LEFT JOIN attendances a ON s.id = a.schedule_id
//                WHERE s.id = $id");
//dd(DB::getQueryLog());
        return $data;
    }

    public function editSchedule($attributes, $id)
    {
        return $this->update($attributes, $id);
    }
}
