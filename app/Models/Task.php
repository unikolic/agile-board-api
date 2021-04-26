<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'status_id', 'project_id', 'priority_id', 'task_type_id', 'milestone_id', 'estimation', 'due_date', 'blocked'];

    /**
     * Get the task status.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the task priority.
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * Get the task type.
     */
    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    /**
     * Get the task milestone.
     */
    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    /**
     * Get the task project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the task assign users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tasks');

    }

    /**
     * Format task model.
     */
    public function format() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'date' => $this->due_date,
            'estimation' => $this->estimation,
            'taskType' => $this->taskType,
            'blocked' => $this->blocked,
            'milestone' => empty($this->milestone) ? null : $this->milestone,
            'project' => $this->project,
            'users' => $this->users
        ];
    }

}
