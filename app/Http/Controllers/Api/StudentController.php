<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index(Request $request) {
        $data = $this->studentRepository->getListStudent($request->get('keyword'), $request->get('status'));

        return $this->successResponse(200, 'success', $data, 200);
    }

    public function show($id)
    {
        $student = $this->studentRepository->getStudentById($id);
        $student = collect($student);
        $student['birthday'] = Carbon::parse($student['birthday'])->format('d-m-Y');
        $student['date_checkin'] = Carbon::parse($student['date_checkin'])->format('d-m-Y');
        $student['date_checkout'] = Carbon::parse($student['date_checkout'])->format('d-m-Y');

        return $this->successResponse(200, 'success', $student, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $attributes = $request->only(['class_id', 'name', 'parent_name', 'birthday', 'phone', 'address','date_checkin', 'gender', 'date_checkout']);
        $data = $this->studentRepository->createStudent($attributes);
        return $this->successResponse(201, 'Create student success', $data, 201);
    }

    public function update(Request $request, $id) {
        $attributes = $request->only(['class_id', 'name', 'parent_name', 'birthday', 'phone', 'address','date_checkin', 'gender', 'date_checkout', 'status']);
        $data = $this->studentRepository->updateStudent($attributes, $id);
        return $this->successResponse(200, 'Update student success', $data, 201);
    }

    public function delete($id) {
        $data = $this->studentRepository->delete($id);
        return $this->successResponse(200, 'Delete success', $data, 200);
    }
}
