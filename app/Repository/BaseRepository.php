<?php

namespace App\Repository;

/**
 * Base repository class
 */
abstract class BaseRepository
{
    protected $model;

    /**
     * Create new record
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Delete all records
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete_all()
    {
        try {
            return $this->model->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
