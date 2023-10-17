<?php

namespace App\Repositories\Classes;

use App\Models\Classes;
use App\Repositories\BaseRepository;

class ClassesRepository extends BaseRepository implements ClassesRepositoryInterface
{

    public function __construct(Classes $model)
    {
        parent::__construct($model);
    }

    /**
     * @return mixed
     */
    public function getAllClass() {
        return $this->all();
    }

    /**
     * @param $className
     * @param null $teachName
     * @return mixed
     */
    public function getListClasses($className, $teachName = null)
    {
        return $this->model->with(['teacher'])
            ->when(!empty($className), function ($q) use ($className) {
                return $q->where('name', 'LIKE', '%' . $className . '%');
            })
//            ->when(!empty($teachName), function ($q) use ($teachName) {
//                return $q->whereHas('teacher', function ($query) use ($teachName) {
//                    $query->where('name', 'LIKE', '%' . $teachName . '%');
//                });
//            })
            ->orderBy('id', 'desc')->paginate(config('constants.LIMIT'));
    }

    public function createClasses($attributes) {
        return $this->create($attributes);
    }

    public function updateClass($attributes, $id) {
        return $this->update($attributes, $id);
    }
}
