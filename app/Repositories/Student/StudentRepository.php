<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    const ACTIVE = 1;
    const INACTIVE = 2;

    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function getListStudent($studentName = '', $status = null)
    {
        $data = $this->model->with(['classes'])
            ->when(!empty($studentName), function ($q) use ($studentName) {
                return $q->where('name', 'LIKE', '%' . $studentName . '%');
            })
            ->when(!is_null($status), function($q) use ($status) {
                return $q->where('status', $status);
            })
            ->orderBy('id', 'desc')->paginate(config('constants.LIMIT'));
        return $data;
    }

    public function createStudent($attributes) {

        return $this->create($attributes);
    }

    public function getStudentById($id) {
     return $this->model->with(['classes'])->where('id', $id)->first();
    }

    public function updateStudent($attributes, $id) {
        return $this->update($attributes, $id);
    }
}
