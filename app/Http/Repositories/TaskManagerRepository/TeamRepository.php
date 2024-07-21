<?php

declare(strict_types=1);

namespace App\Http\Repositories\TaskManagerRepository;

use App\Http\Repositories\Repository;
use App\Models\Team;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

final class TeamRepository extends Repository
{
    const PAGINATE_COUNT = 10;

    public function __construct(Team $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $validated, User $user): LengthAwarePaginator
    {
        $query = $user->teams()->select('teams.*');


        if (isset($validated['name'])) {
            $query->where('teams.name', 'like', '%' . $validated['name'] . '%');
        }

        return $query->orderBy('teams.id')
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
