<?php

namespace App\Repositories;

/**
 * Interface LisitngRepositoryInterface
 *
 * @package namespace App\Repositories;
 */
interface RegistrantRepositoryInterface
{
    public function getAll($data);

    public function getById($id);

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
