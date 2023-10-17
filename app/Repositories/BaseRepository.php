<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): mixed
    {
        $record = $this->model->find($id);
        $record->update($attributes);
        return $record;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values): mixed
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc'): mixed
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @param $orderBy
     * @param $sortBy
     * @return mixed
     */
    public function findBy(array $data, $orderBy = 'id', $sortBy = 'desc'): mixed
    {
        return $this->model->where($data)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data): mixed
    {
        return $this->model->where($data)->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findOneByOrFail(array $data): mixed
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->model->find($id)->delete();
    }
}
