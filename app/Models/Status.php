<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * Format status model.
     */
    public function format() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
