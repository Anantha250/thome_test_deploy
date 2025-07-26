<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobwork;

class JobworkController extends Controller
{
    //

    public function view_jobwork()
    {
        $jobs = Jobwork::all();
        foreach ($jobs as $item) {
            $item->translation = $item->translation();
        }
        return view('home.contact.joinwithus', compact('jobs'));
    }


    // admin
    public function manage()
    {
        $jobs = Jobwork::all();
        foreach ($jobs as $item) {
            $item->translation = $item->translation();
            $item->th = $item->translation('th');
            $item->en = $item->translation('en');
        }

        return view('admin.jobwork.manage', compact('jobs'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'pos-th' => 'required|string|max:255',
            'pos-en' => 'required|string|max:255',
            'req-th' => 'required|string',
            'req-en' => 'required|string',
            'loc' => 'required|in:Office,Onsite,Hybrid,Remote,Other',
        ]);

        $job = Jobwork::create([
            'location' => $request['loc'],
        ]);
        $job->translations()->create([
            'locale' => 'th',
            'position' => $request['pos-th'],
            'requirements' => $request['req-th'],
        ]);

        $job->translations()->create([
            'locale' => 'en',
            'position' => $request['pos-en'],
            'requirements' => $request['req-en'],
        ]);

        return redirect()->back()->with('success', 'Jobwork created successfully.');
    }

    public function edit($id, Request $request)
    {
        $request->validate([
            'pos-th' => 'required|string|max:255',
            'pos-en' => 'required|string|max:255',
            'req-th' => 'required|string',
            'req-en' => 'required|string',
            'loc' => 'required|in:Office,Onsite,Hybrid,Remote,Other',
        ]);

        $job = Jobwork::findOrFail($id);
        $job->location = $request['loc'];
        $job->save();

        $job->translations()->updateOrCreate(
            ['locale' => 'th'],
            [
                'position' => $request['pos-th'],
                'requirements' => $request['req-th'],
            ]
        );

        $job->translations()->updateOrCreate(
            ['locale' => 'en'],
            [
                'position' => $request['pos-en'],
                'requirements' => $request['req-en'],
            ]
        );

        return redirect()->back()->with('success', 'Jobwork updated successfully.');
    }

    public function delete($id)
    {
        $job = Jobwork::findOrFail($id);
        $job->delete();

        return redirect()->back()->with('success', 'Jobwork deleted successfully.');
    }
}
