<?php

namespace App\Services;

use App\Models\Developer;
use App\Repositories\DeveloperRepository;
use Illuminate\Database\Eloquent\Collection;

class DeveloperService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new DeveloperRepository();
    }

    private function prepareData(array $data): array
    {
        $data['nome'] = array_key_exists('nome', $data) ? $data['nome'] : null;
        $data['sexo'] = array_key_exists('sexo', $data) ? $data['sexo'] : null;
        $data['hobby'] = array_key_exists('hobby', $data) ? $data['hobby'] : null;
        $data['idade'] = array_key_exists('idade', $data) ? $data['idade'] : null;
        $data['perPage'] = array_key_exists('perPage', $data) ? $data['idade'] : 100;
        $data['page'] = array_key_exists('page', $data) ? $data['page'] : 1;
        $data['datanascimento'] = array_key_exists('data_nascimento', $data) ? $data['data_nascimento'] : null;

        return $data;
    }

    public function get(array $data)
    {
        return $this->repository->search($this->prepareData($data));
    }

    public function getById(int $id)
    {
        return $this->repository->getById($id);
    }

    public function create(array $data):Developer
    {
        return $this->repository->create($this->prepareData($data));
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }

    public function edit(array $data)
    {
        return $this->repository->update($this->prepareData($data));
    }
}
