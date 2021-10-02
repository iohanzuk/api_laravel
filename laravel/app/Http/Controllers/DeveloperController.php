<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeveloperEditRequest;
use App\Http\Requests\DeveloperGetByIdRequest;
use App\Http\Requests\DeveloperGetRequest;
use App\Http\Requests\DeveloperStoreRequest;
use App\Http\Resources\DeveloperCollection;
use App\Http\Resources\DeveloperResource;
use App\Services\DeveloperService;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeveloperController extends Controller
{

    public function get(DeveloperGetRequest $request)
    {
        try {
            $service = new DeveloperService();
            $developers = $service->get($request->all());
            return new DeveloperCollection($developers);
        } catch (NotFoundHttpException $exception) {
            return response()->json(['mensage'=> $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

    }

    public function getById(DeveloperGetByIdRequest $request)
    {
        try {
            $id = $request->all()['id'];
            $service = new DeveloperService();
            $developer = $service->getById($id);
            return new DeveloperResource($developer);
        }  catch (NotFoundHttpException $exception) {
            return response()->json(['mensage'=> $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(DeveloperStoreRequest $request)
    {
        $service = new DeveloperService();
        $developer = $service->create($request->all());
        return new DeveloperResource($developer);
    }

    public function edit(DeveloperEditRequest $request)
    {
        try {
            $service = new DeveloperService();
            $developer = $service->edit($request->all());
            return new DeveloperResource($developer);
        } catch (NotFoundHttpException $exception) {
            return response()->json(['mensage'=> $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

    }

    public function delete(DeveloperGetByIdRequest $request)
    {
        try {
            $id = $request->all()['id'];
            $service = new DeveloperService();
            $service->delete($id);
            return response()->json(['mensage'=> 'Sucess'], Response::HTTP_OK);
        } catch (NotFoundHttpException $exception) {
            return response()->json(['mensage'=> $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

    }
}
