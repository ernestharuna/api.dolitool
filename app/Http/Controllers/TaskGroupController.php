<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use Illuminate\Http\Request;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = TaskGroup::with('task')->latest()->get();
        return response()->json($groups, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'importance' => ['string', 'nullable'],
            'theme' => ['nullable', 'string'],
        ]);

        try {
            $request->user()->task_group()->create($data);
            return response(null, 204);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ], 500);

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskGroup $taskGroup)
    {
        return response([
            'group' => $taskGroup->with('task')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskGroup $taskGroup)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'importance' => ['string', 'nullable'],
            'theme' => ['nullable', 'string'],
        ]);

        $taskGroup->update($data);
        return response("", 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskGroup $taskGroup)
    {
        $taskGroup->group();
        return response("", 204);
    }
}
