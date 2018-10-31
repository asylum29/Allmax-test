<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        $status = $request->has('status') ? $request->get('status') : -1;
        $priority = $request->has('priority') ? $request->get('priority') : -1;
        return view('task/tasks', [
            'tasks' => $this->tasks->forUser($request->user(), $status, $priority),
            'query_status' => $status,
            'query_priority' => $priority,
            'is_admin' => $request->user()->is_admin,
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'description' => 'required|max:1000',
                'priority'    => 'required|numeric|min:0|max:2',
                'status'      => 'required|numeric|min:0|max:2',
            ]);
            
            $request->user()->tasks()->create([
                'description' => $request->get('description'),
                'priority'    => $request->get('priority'),
                'status'      => $request->get('status'),
            ]);
            
            return redirect('tasks')->with('success', 'New task has been created!');
        }
        
        return view('task/create');
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'description' => 'required|max:1000',
                'priority'    => 'required|numeric|min:0|max:2',
                'status'      => 'required|numeric|min:0|max:2',
            ]);
            
            $task->description = $request->get('description');
            $task->priority = $request->get('priority');
            $task->status = $request->get('status');
            $task->save();
            
            return redirect('tasks')->with('success', 'Task has been updated!');
        }
        
        return view('task/update', [
            'task' => $task,
            'is_admin' => $request->user()->is_admin,
        ]);
    }

    public function delete(Task $task) {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect('tasks')->with('success', 'Task has been deleted!');
    }
}
