<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    /**
     * Format task type model.
     */
    public function format() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
