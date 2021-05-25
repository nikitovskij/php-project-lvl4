<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Label extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'label_task', 'label_id', 'task_id');
    }

    public function isDeletable(): bool
    {
        return !$this->tasks()->exists();
    }

    public function getLabelNameList(): Collection
    {
        return static::pluck('name', 'id');
    }
}
