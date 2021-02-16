<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'tbl_folder';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
