<?php

namespace App\Repositories\Schedule;

interface ScheduleRepositoryInterface {
    public function getListSchedule($startDate, $endDate, $classId);
    public function createSchedule($startDate, $endDate, int $classId, array $dayName, $startTime, $endTime);
    public function detailSchedule($id);
    public function editSchedule($attributes, $id);
}
