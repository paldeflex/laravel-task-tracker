<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id Task identifier
 * @property int $user_id Owner user identifier
 * @property int|null $category_id Task category identifier
 * @property string $title Task title
 * @property string|null $description Task description
 * @property bool $is_recurring Whether the task is recurring
 * @property Carbon|null $task_date Scheduled task date and time
 * @property Carbon|null $completed_at Task completion timestamp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at Task soft deletion timestamp
 * @property-read Category|null $category
 * @property-read User $user
 * @method static Builder<static>|Task newModelQuery()
 * @method static Builder<static>|Task newQuery()
 * @method static Builder<static>|Task onlyTrashed()
 * @method static Builder<static>|Task query()
 * @method static Builder<static>|Task whereCategoryId($value)
 * @method static Builder<static>|Task whereCompletedAt($value)
 * @method static Builder<static>|Task whereCreatedAt($value)
 * @method static Builder<static>|Task whereDeletedAt($value)
 * @method static Builder<static>|Task whereDescription($value)
 * @method static Builder<static>|Task whereId($value)
 * @method static Builder<static>|Task whereIsRecurring($value)
 * @method static Builder<static>|Task whereTaskDate($value)
 * @method static Builder<static>|Task whereTitle($value)
 * @method static Builder<static>|Task whereUpdatedAt($value)
 * @method static Builder<static>|Task whereUserId($value)
 * @method static Builder<static>|Task withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Task withoutTrashed()
 * @mixin Eloquent
 */
#[Fillable(['user_id', 'category_id', 'title', 'description', 'is_recurring', 'task_date', 'completed_at'])]
class Task extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function casts(): array
    {
        return [
            'is_recurring' => 'boolean',
            'task_date' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
}
