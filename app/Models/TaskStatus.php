<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class TaskStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }

    public function getTaskStatusesNameList(): Collection
    {
        return static::pluck('name', 'id');
    }

    public function isDeletable(): bool
    {
        return !$this->tasks()->exists();
    }
}
