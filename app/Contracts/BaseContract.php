<?php

namespace App\Contracts;

interface BaseContract
 {
    /**
     * Create a model instance
     * @param array $attributes
     *
     */
    public function create(array $attributes);

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): mixed;

    /**
     * Update or create model instance
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values);

    /**
     * Return all model rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc'): mixed;

    /**
     * Find one by id
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * Find one by ID or throw exception
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail(int $id): mixed;

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data): mixed;

    /**
     * Find one based on a different column
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data): mixed;

    /**
     * Find one based on a different column or through exception
     * @param array $data
     * @return mixed
     */
    public function findOneByOrFail(array $data): mixed;

    /**
     * Delete one by Id
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;
 }
