<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::get();
        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task_group_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'due_date' => ['date', 'nullable'],
            'status' => ['nullable', 'string'],
            'priority' => ['nullable'],
        ]);

        try {
            $tasks = $request->user()->task()->create($data);
            return response(['tasks' => $tasks], 200);
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
    public function show(Tasks $tasks)
    {
        return response([
            'task' => $tasks
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks)
    {
        $data = $request->validate([
            'task_group_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'due_date' => ['date', 'nullable'],
            'status' => ['nullable', 'string'],
            'priority' => ['nullable'],
        ]);

        $tasks->update($data);
        return response("", 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        $tasks->delete();
        return response("", 204);
    }
}
