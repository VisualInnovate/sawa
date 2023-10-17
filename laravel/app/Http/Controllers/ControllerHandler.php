<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Child\Entities\Child;

/**
 * controller handel templete by model
 */
class ControllerHandler
{
    private $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)//model injection
    {
        $this->model = $model;

    }

    /**
     * @param $key : this for key fo vue
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getAll($key)//
    {
        return response([
            "$key" => $this->model::all(),
            "message" => "success",
            "status" => 200
        ], 200);
    }

    /**
     * @param $key : this for key fo vue
     * @param $model :specific child
     * @param $data :store data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store($key, $data)
    {
        return response([
            "$key" => $this->model::create($data),
            "message" => "success stored ".$key,
            "status" => 200
        ], 200);
    }

    /**
     * @param $key : this for key fo vue
     * @param $model :specific child
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show($key, $model)
    {
        return response([
            "$key" => $model,
            "message" => "success",
            "status" => 200
        ], 200);
    }

    /**
     * @param $key : this for key fo vue
     * @param $model :specific child
     * @param $data :store data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update($key, $model, $data)
    {
        return response([
            "updated" => $model->update($data),
            "$key" => $model,
            "message" => "success",
            "status" => 200
        ], 200);
    }

    /**
     * @param $key
     * @param $model
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */

    public function destory($key, $model)
    {
        return response([
            "deleted" => $model->delete(),
            "$key" => $this->model::all(),
            "status" => 200
        ], 200);

    }


}
