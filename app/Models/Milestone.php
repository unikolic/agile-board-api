<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    /**
     * Get the milestone tasks.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Format milestone model.
     */
    public function format() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
