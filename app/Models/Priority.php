<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;
    /**
     * Format priority model.
     */
    public function format() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

}
