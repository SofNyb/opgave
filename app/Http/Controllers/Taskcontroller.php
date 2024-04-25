<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return response()->json([
            "tasks" => $tasks
        ], 200);
    }

    public function store(Request $request)
    {
        $task = Task::create(
            $request->toArray()
        );
        if(!is_null($task)) {
            $msg = 'task is created';
        }else {
            $msg = 'could not create task';
        }
        return response()->json(
            [
                "msg" => $msg,
                "task" => $task
            ], 200);
    }

    public function complete(Request $request)
    {
        $task = Task::whereId($request->id)->first();
        if(!is_null($task)){
            $task->completed = !$task->completed;
            $task->save();
        }
        $task_changed = Task::whereId($request->id)->first();
        return response()->json(
            $task_changed, 200
        );
    }

    public function delete(Request $request)
    {
        $message = 'task not found';
        $task = Task::whereId($request->id)->first();
        if(!is_null($task)){
            $task->delete();
            $message = 'task deleted successfully';
        }
        return response()->json(
            $message, 200
        );
    }
}
