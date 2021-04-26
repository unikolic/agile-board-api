<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProjectRequest;
use App\Models\Milestone;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\User;

class ProjectController extends Controller
{

    /**
     * Method for retrieving all projects
     *
     * @return Project[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProjects() {
        return Project::all()
            ->map(function ($project) {
                return $project->format();
            });
    }

    /**
     * Method for retrieving single project data and project users
     *
     * @param $id
     *
     * @return mixed
     */
    public function getProject($id) {
        return Project::find($id)->format();
    }

    /**
     * Method for retrieving project tasks
     *
     * @param $id
     *
     * @return mixed
     */
    public function getProjectTasks($id, $name  = null, $user = null, $priority = null) {

        $name = substr($name, strpos($name, '=') + 1);
        $user = substr($user, strpos($user, '=') + 1);
        $priority = substr($priority, strpos($priority, '=') + 1);

        return Task::where('project_id', $id)
            ->where(function($query) use ($name) {
                if (!empty($name)) {
                    return $query->where('name', 'like' ,'%'.$name.'%');
                }
            })
            ->where(function($query) use ($user) {
                if (!empty($user)) {
                    return $query->where('user_id', intval($user));
                }
            })
            ->where(function($query) use ($priority) {
                if (!empty($priority)) {
                    return $query->where('priority_id', intval($priority));
                }
            })
            ->get()->map(function ($task) {
                return $task->format();
            });
    }

    /**
     * Method for creating new project with users
     *
     * @param SaveProjectRequest $request
     *
     * @return string
     */
    public function createProject(SaveProjectRequest $request) {
        $project = Project::create(
            [
                'name' => $request->name,
                'description' => $request->description
            ]
        );
        if ($request->users) {
            $project->users()->attach($request->users);
        }

        return 'Project '.$request->name.' is created!';
    }

    /**
     * Method for edit project with users
     *
     * @param SaveProjectRequest $request
     * @param integer            $id
     *
     * @return string
     */
    public function updateProject(SaveProjectRequest $request, $id) {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;

        //TODO remove old and add new or check diff and add/delete
        if ($request->users) {
            $project->users()->attach($request->users);

        }
        $project->save();

        return 'Project '.$project->name.' is updated!';
    }

    /**
     * Method for delete project
     *
     * @param integer $id
     *
     * @return string
     */
    public function deleteProject($id) {
        $project = Project::find($id);
        $project->delete();

        return 'Project '.$project->name.' is deleted!';
    }

    /**
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function getInitData($id) {
        //TODO get data for specific project
        return [
            "priorities" => Priority::all()->map(function ($priority) {
                return $priority->format();
            }),
            "statuses" => Status::all()->map(function ($status) {
                return $status->format();
            }),
            "milestones" => Milestone::all()->map(function ($milestone) {
                return $milestone->format();
            }),
            "taskTypes" => TaskType::all()->map(function ($taskType) {
                return $taskType->format();
            }),
            'users' => User::all()->map(function ($user) {
                return $user->format();
            }),
        ];
    }
}
