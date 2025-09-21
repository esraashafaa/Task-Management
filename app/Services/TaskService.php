<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Exceptions\TaskException;
use App\Exceptions\ProjectNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class TaskService
{
    public function createTask(array $data): Task
    {
        DB::beginTransaction();
        
        try {
            // Validate project exists
            $project = Project::find($data['project_id']);
            if (!$project) {
                throw new ProjectNotFoundException('Project not found with ID: ' . $data['project_id']);
            }
            
            // Validate assigned user exists if provided
            if (isset($data['assigned_to']) && $data['assigned_to']) {
                $user = User::find($data['assigned_to']);
                if (!$user) {
                    throw new TaskException('User not found with ID: ' . $data['assigned_to'], 404);
                }
            }
            
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'project_id' => $data['project_id'],
                'assigned_to' => $data['assigned_to'] ?? null,
            ]);
            
            DB::commit();
            
            return $task;
            
        } catch (ProjectNotFoundException $e) {
            DB::rollBack();
            throw $e;
        } catch (TaskException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            throw new TaskException('Failed to create task: ' . $e->getMessage(), 500);
        }
    }
    
    public function updateTask(Task $task, array $data): Task
    {
        DB::beginTransaction();
        
        try {
            // Validate project exists if provided
            if (isset($data['project_id'])) {
                $project = Project::find($data['project_id']);
                if (!$project) {
                    throw new ProjectNotFoundException('Project not found with ID: ' . $data['project_id']);
                }
            }
            
            // Validate assigned user exists if provided
            if (isset($data['assigned_to']) && $data['assigned_to']) {
                $user = User::find($data['assigned_to']);
                if (!$user) {
                    throw new TaskException('User not found with ID: ' . $data['assigned_to'], 404);
                }
            }
            
            $task->update($data);
            
            DB::commit();
            
            return $task->fresh();
            
        } catch (ProjectNotFoundException $e) {
            DB::rollBack();
            throw $e;
        } catch (TaskException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            throw new TaskException('Failed to update task: ' . $e->getMessage(), 500);
        }
    }
    
    public function deleteTask(Task $task): bool
    {
        DB::beginTransaction();
        
        try {
            $task->delete();
            DB::commit();
            
            return true;
            
        } catch (Exception $e) {
            DB::rollBack();
            throw new TaskException('Failed to delete task: ' . $e->getMessage(), 500);
        }
    }
}
