<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassesRequest;
use App\Repositories\Classes\ClassesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassesController extends Controller
{
    protected $classesRepository;

    public function __construct(ClassesRepositoryInterface $classesRepository)
    {
        $this->classesRepository = $classesRepository;
    }

    public function index(Request $request) {
        $data = $this->classesRepository->getListClasses($request->get('keyword'));

        return $this->successResponse(200, 'success', $data, 200);
    }

    public function getAll() {
        $data = $this->classesRepository->getAllClass();
        return $this->successResponse(200, 'success', $data, 200);
    }

    public function show($id) {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreClassesRequest $request) {

        $attributes = $request->only(['teacher_id', 'name', 'start_time', 'end_time', 'tuition_fee', 'description', 'status']);
        $attributes['sku'] = Str::slug($attributes['name']);
        $data = $this->classesRepository->createClasses($attributes);
        return $this->successResponse(201, 'Create classes success', $data, 201);
    }

    public function edit(Request $request, $id) {
        $attributes = $request->only(['teacher_id', 'name', 'start_time', 'end_time', 'tuition_fee', 'description', 'status']);
        $data = $this->classesRepository->updateClass($attributes, $id);
        return $this->successResponse(200, 'Create classes success', $data, 200);
    }

    public function delete($id) {
        $data = $this->classesRepository->delete($id);
        return $this->successResponse(200, 'Delete success', $data, 200);
    }
}
