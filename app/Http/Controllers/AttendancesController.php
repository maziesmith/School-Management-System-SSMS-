<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Student;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $attendances = Attendance::latest('working_day')
            ->WithStudent()
            ->paginate(50);

        return view('attendance.index', compact('attendances', 'students'));
    }

    public function create()
    {
        $students = Student::all();
        $attendance = new Attendance();
        return view('attendance.create', compact('students', 'attendance'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validateRequest());

        Attendance::create($request->all());

        flashy()->success('Attendance record has been created');

        return redirect()->back();
    }

    public function validateRequest()
    {
        return [
            'student_id' => ['required'],
            'working_day' => ['required', 'date'],
        ];
    }

    public function show(Attendance $attendance)
    {
        //
    }


    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        return view('attendance.edit', compact('students', 'attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate($this->validateRequest());

        $attendance->update($request->all());

        flashy()->success('Attendance record has been updated');

        return redirect()->route('attendances.index');
    }


    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        flashy()->success('Attendance record has been deleted');

        return redirect()->route('attendances.index');
    }
}
