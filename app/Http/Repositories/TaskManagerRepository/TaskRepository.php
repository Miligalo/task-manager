<?php

declare(strict_types=1);

namespace App\Http\Repositories\TaskManagerRepository;

use App\Http\Repositories\Repository;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

final class TaskRepository extends Repository
{
    const PAGINATE_COUNT = 10;

    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $validated, User $user): LengthAwarePaginator
    {
        $query = $user->tasks()->select('tasks.*');

        if (isset($validated['name'])) {
            $query->where('tasks.name', 'like', '%' . $validated['name'] . '%');
        }

        if (isset($validated['description'])) {
            $query->where('tasks.name', 'like', '%' . $validated['name'] . '%');
        }

        if (isset($validated['status'])) {
            $query->where('tasks.name', 'like', '%' . $validated['name'] . '%');
        }

        return $query->orderBy('tasks.id')
            ->paginate(self::PAGINATE_COUNT);
    }

    public function addUser(array $validated, Team $team): bool
    {
        $user = User::find($validated['user_id']);

        $team->users()->attach($user);

        return true;
    }

    public function removeUser(Team $team, User $user): bool
    {
        $team->users()->detach($user);

        return true;
    }
}
