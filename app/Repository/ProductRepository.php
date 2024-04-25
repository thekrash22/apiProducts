<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
    protected $model;
    public function __construct(Product $model){
        $this->model = $model;
    }
    public function create(array $data){
        return $this->model->create($data);
    }
    public function update(array $data, $id){
        $poduct = $this->model->update($data, $id);
        return $poduct;
    }
    public function delete($id){
        return $this->model->destroy($id);
    }
    public function find($id){
        return $this->model->where('id', $id)->first();
    }
    public function findBy($column, $value){
    }

    public function listAll($params){
            $query = $this->model->select('*');
            $query = $this->filters($query, $params);
            return $query->paginate($params['paginate'] ?? 10);
    }
    private function filters($query, array $params)
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'withuser':
                    $query->with(['user']);
                    break;
                case 'order':
                    $value = $value == 'desc' ? 'desc' : 'asc';
                    $query = $query->orderBy('created_at', $value);
                    break;
                case 'name':
                    $query = $query->where('name', 'like', '%'.$value.'%');
                    break;
                case 'is_active':
                    $query = $query->where('is_active', $value);
                    break;
            }
        }
        return $query;
    }
}
