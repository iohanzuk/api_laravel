<?php

namespace App\Repositories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class DeveloperRepository {

    public function create(array $data)
    {
        return Developer::create($data);
    }

    public function update(array $data)
    {
        $developer = $this->getById($data['id']);
        unset($data['id']);
        $developer->fill($data);
        $developer->save();
        return $developer;
    }

    public function search(array $data)
    {
        $builder = (new Developer())->select('*');

        $builder = $this->appendGenericFilter($builder, 'nome', $data['nome']);
        $builder = $this->appendGenericFilter($builder, 'sexo', $data['sexo']);
        $builder = $this->appendGenericFilter($builder, 'hobby', $data['hobby']);
        $builder = $this->appendGenericFilter($builder, 'idade', $data['idade']);
        $builder = $this->appendGenericFilter($builder, 'datanascimento', $data['datanascimento']);

        return $builder->paginate($data['perPage'], ['*'], 'page', $data['page']);
    }

    public function getById(int $id)
    {
        $developer = Developer::where('id', $id)->first();
        if (!$developer instanceof Developer) {
            throw new NotFoundHttpException('Developer not found');
        }
        return $developer;
    }

    public function delete(int $id)
    {
        $developer = Developer::where('id', $id)->first();
        if (!$developer instanceof Developer) {
            throw new NotFoundHttpException('Developer not found');
        }
        $developer->delete();
    }

    private function appendGenericFilter(Builder $builder, string $column, $value)
    {
        if (empty($value)) return $builder;

        $builder->where($column, $value);
        return $builder;
    }
}
