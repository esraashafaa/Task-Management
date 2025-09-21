<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $user = Auth::user();
        if ($user) {
            Log::info("Task created successfully", [
                'created_by' => $user->name,
                'user_email' => $user->email,
                'task_name' => $task->title,
                'task_id' => $task->id,
            ]);
        } else {
            Log::warning("Task created without authenticated user", [
                'task_name' => $task->title,
                'task_id' => $task->id,
            ]);
        }
    }
    

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
