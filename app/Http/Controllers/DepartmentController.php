<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\MajorDepartment;
use App\Models\Employee;
use Exception;

class DepartmentController extends Controller
{
    public function ourteam(){
        $major = MajorDepartment::all();
        foreach ($major as $maj) {
            $maj->translation = $maj->translation();
            $maj->departments = $maj->departments()->orderBy('d_order')->get();
            foreach ($maj->departments as $dep) {
                $dep->translation = $dep->translation();
                // $dep->employees = $dep->employees();
                // dd($dep->employees);
                foreach ($dep->employees as $emp) {
                    $emp->translation = $emp->translation();
                }
            }
        }
        return view('home.aboutus.ourteam', compact('major'));
    }


    // Major Department
    public function major_manage(Request $request)
    {
        $major = MajorDepartment::all();
        foreach ($major as $maj) {
            $maj->translation = $maj->translation();
        }
        return view('admin.employee.major_department', compact('major'));
    }

    public function create_major(Request $request)
    {
        try {
            $majorDepartment = MajorDepartment::create([
                // "icon" => $request['icon'],
                "theme" => $request['theme'] ?? 'blue-theme',
                "locale" => [
                    'th' => $request['name-th'] ,
                    'en' => $request['name-en'] ,
                    'cn' => $request['name-cn'] ?? $request['name-en'],
                ]
            ]);

            return redirect('/admin/major_department');
        } catch (Exception $e) {
            return redirect('/admin/major_department')->withErrors(['message' => 'An error occurred while creating the major department: ' . $e->getMessage()]);
        }
    }

    public function edit_major(Request $request)
    {
        try {
            $major = MajorDepartment::findOrFail($request->id);
            $major->theme = $request['theme'] ?? $major->theme;
            $major->locale = [
                'th' => $request['name-th'] ?? $major->locale['th'],
                'en' => $request['name-en'] ?? $major->locale['en'],
                'cn' => $request['name-cn'] ?? $major->locale['cn'] ?? '',
            ];
            $major->save();
            return redirect('/admin/major_department')->with('message', 'Major Department updated successfully');
        } catch (Exception $e) {
            return redirect('/admin/major_department')->withErrors(['message' => 'An error occurred while editing the major department: ' . $e->getMessage()]);
        }
    }

    public function delete_major(Request $request)
    {
        MajorDepartment::findOrFail($request->id)->delete();
        return redirect('/admin/major_department');
    }


    // Department
    function create(Request $request)
    {
        $request = $request->json()->all();
        try {
            $major = MajorDepartment::findOrFail($request['major_id']);
            $department = $major->departments()->create([]);
            $department->d_order = $department->id;
            $department->save();
            $department->translations()->create([
                'locale' => $request['locale'],
                'name' => $request['name'],
            ]);

            return response()->json(['message' => 'Department created successfully', 'id' => $department->id]);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the department: ' . $e->getMessage()], 500);
        }
    }

    function edit(Request $request)
    {
        try {
            $department = Department::findOrFail($request->id);
            $request = $request->json()->all();
            $department->translations()->updateOrCreate(
                ['locale' => $request['locale']],
                ['name' => $request['name']]
            );

            return response()->json(['message' => 'Department updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred while editing the department: ' . $e->getMessage()], 500);
        }
    }

    function delete(Request $request)
    {
        Department::findOrFail($request->id)->delete();
    }

    function add_lang(Request $request)
    {
        $department = Department::findOrFail($request->id);
        $department->translations()->updateOrCreate(
            ['locale' => $request->locale],
            ['name' => $request->name]
        );

        return response()->json(['message' => 'Department language added successfully']);
    }

    function reorder(Request $request)
    {
        try {
            $order = $request->json()->all();
            for ($index = 0; $index < count($order); $index++) {
                $department = Department::findOrFail($order[$index]);
                if ($department) {
                    $department->d_order = $index;
                    $department->save();
                }
            }
            return response()->json(['message' => 'Departments reordered successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred while reordering departments: ' . $e->getMessage()], 500);
        }
    }
}
