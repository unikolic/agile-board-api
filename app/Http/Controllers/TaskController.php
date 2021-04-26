<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTaskRequest;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Route;

class TaskController extends Controller
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getTask($id) {
        return Task::find($id)->format();
    }

    /**
     * Method for creating new project with users
     *
     * @param SaveTaskRequest $request
     *
     * @return string
     */
    public function createTask(SaveTaskRequest $request) {
        try{
            $task = Task::create(
                [
                    'project_id' => $request->projectId,
                    'name' => $request->name,
                    'description' => $request->description,
                    'status_id' => empty($request->statusId) ? 1 : $request->statusId,
                    'priority_id' => $request->priorityId,
                    'due_date' => $request->date,
                    'estimation' => $request->estimation,
                    'task_type_id' => $request->taskTypeId,
                    'milestone_id' => $request->milestoneId
                ]
            );

            if ($request->users) {
                $task->users()->attach($request->users);
            }

        } catch (QueryException $e) {
            //todo handle exception
        }

        return 'Task '.$request->name.' is created!';
    }

    /**
     * Method for edit task with users
     *
     * @param SaveTaskRequest $request
     * @param integer            $id
     *
     * @return string
     */
    public function updateTask(SaveTaskRequest $request, $id, Task $task) {
        $task = Task::find($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status_id = $request->statusId;
        $task->priority_id = $request->priorityId;
        $task->due_date = $request->date;
        $task->estimation = $request->estimation;
        $task->task_type_id = $request->taskTypeId;
        $task->milestone_id = $request->milestoneId;

        //TODO remove old and add new or check diff and add/delete
        if ($request->users) {
            $task->users()->attach($request->users);

        }
        try{
            $task->save();
        } catch (QueryException $e) {
            //todo handle exception
        }


        return 'Task '.$task->name.' is updated!';
    }

    /**
     * Method for delete task
     *
     * @param integer $id
     *
     * @return string
     */
    public function deleteTask($id) {
        $task = Task::find($id);
        $task->delete();

        return 'Task '.$task->name.' is deleted!';
    }

}
