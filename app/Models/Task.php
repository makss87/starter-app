<?php

namespace App\Models;


use Core\Database\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * App\Domain\Models\Task
 *
 * @property-read mixed $edited_by_admin
 * @property-read mixed $status
 * @property-write mixed $email
 * @property-write mixed $username
 * @property boolean $edited
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task sort()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task withPerPage($perPage)
 * @mixin \Eloquent
 */
class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['username', 'email', 'text', 'done'];


    /**
     * Hooking to update event to be ables to set edited by admin prop
     */
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($entity) {
            /** @var Task $entity */
            $changedAttrs = $entity->getDirty();
            if (isset($changedAttrs['text'])) {
                $entity->edited = 1;
            }
        });
    }

    /**
     * Username mutator clearing data
     * @param $value
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = trim($value);
    }

    /**
     * Email mutator clearing data
     * @param $value
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = trim($value);
    }

    /**
     * Returns paginated result, to be executed in the end of the chaining
     * @param $query
     * @param $perPage
     * @return Paginator
     */
    public static function scopeWithPerPage($query, $perPage)
    {
        $offset = (request('page') - 1) * $perPage;
        $tasks  = $query->limit($perPage)->offset($offset)->get();

        return new Paginator($tasks, static::count(), $perPage, request('page'), [
            'path'  => request()->getPathInfo(),
            'query' => request()->query->all(),
        ]);
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeSort($query)
    {
        $param     = request('sort_by') ?: 'username';
        $direction = request('sort_dir') ?: 'asc';

        return $query->orderBy($param, $direction);
    }

    /**
     * Status accessor
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->done ? 'Выполнено' : 'Не выполнено';
    }

    /**
     * Edited by admin  accessor
     * @return string
     */
    public function getEditedByAdminAttribute()
    {
        return $this->edited ? 'Отредактировано администратором' : '';
    }
}