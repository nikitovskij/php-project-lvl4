<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'status_id');
    }
}
