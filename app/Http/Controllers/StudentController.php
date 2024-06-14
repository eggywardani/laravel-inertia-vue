<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\StudentResource;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentQuery = Student::query();

        $studentQuery = $this->applySearch($studentQuery, request('search'));

        return inertia('Student/Index', [
            'students' => StudentResource::collection(
                $studentQuery->paginate(5)
            ),
            'search' => request('search') ?? ''
        ]);
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms =  ClassroomResource::collection(Classroom::all());
        return inertia('Student/Create', ['classrooms'=> $classrooms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms =  ClassroomResource::collection(Classroom::all());
        return inertia('Student/Edit', [
            'student' => StudentResource::make($student),
            'classrooms'=> $classrooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}
