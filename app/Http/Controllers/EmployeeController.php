<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorDepartment;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Exception;

class EmployeeController extends Controller
{
    //
    function manage(Request $request)
    {
        $major = MajorDepartment::all();

        $major_id = $request->major ?? $major->first()->id;
        $departments = MajorDepartment::where('id', '=', $major_id)
            ->first()
            ->departments;

        foreach ($major as $maj) {
            $maj->translation = $maj->translation();
        }

        // dd($departments);
        foreach ($departments as $department) {
            $department->translation = $department->translation();
            $department->employees = $department->employees()->with('translations')->get();
            foreach ($department->employees as $employee) {
                $employee->translation = $employee->translation();
            }
        }
        // dd($departments);
        return view('admin.employee.manage', compact('departments', 'major', 'major_id'));
    }

    function create(Request $request)
    {
        $request = $request->json()->all();
        try {
            $request['department_id'] = (int)$request['department_id'];

            $department = Department::findOrFail($request['department_id']);
            if (!$department) {
                return response()->json(['message' => 'Department not found'], 404);
            }

            $fileName = basename($request['cover_image']);

            if (Storage::exists('public/temp_uploads/' . $fileName)) {
                Storage::move('public/temp_uploads/' . $fileName, 'public/' . $department->id . "/" . $fileName);
            }

            $employee = $department->employees()->create([
                'cover_image' => "/storage/$department->id/$fileName",
            ]);

            $employee->translations()->create([
                'locale' => $request['locale'],
                'name' => $request['name'],
                'position' => $request['position'],
            ]);

            return response()->json(['message' => 'Employee created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the employee: ' . $e->getMessage()], 500);
        }
    }

    function edit(Request $request)
    {
        try {
            $employee_id = $request->id;
            $request = $request->json()->all();
            $employee = Employee::find($employee_id);
            if (!$employee) {
                return response()->json(['message' => 'Employee not found'], 404);
            }
            if (isset($request['cover_image'])) {
                $employee->update([
                    'cover_image' => $request['cover_image'],
                ]);
                $employee->save();
            }
            $employee->translations()->updateOrCreate(
                ['locale' => $request['locale']],
                [
                    'name' => $request['name'],
                    'position' => $request['position']
                ]
            );
            return response()->json(['message' => 'Employee updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred while editing the employee: ' . $e->getMessage()], 500);
        }
    }

    function delete(Request $request)
    {
        try {
            $employee = Employee::findOrFail($request->id);
            if (!$employee) {
                return response()->json(['message' => 'Employee not found'], 404);
            }
            $employee->translations()->delete();
            $employee->delete();
            return response()->json(['message' => 'Employee deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the employee: ' . $e->getMessage()], 500);
        }
    }

    function add_lang(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        $employee->translations()->updateOrCreate(
            ['locale' => $request->locale],
            ['name' => $request->name, 'position' => $request->position]
        );

        return response()->json(['message' => 'Employee language added successfully']);
    }
}
