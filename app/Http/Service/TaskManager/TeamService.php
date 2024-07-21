<?php

declare(strict_types=1);

namespace App\Http\Service\TaskManager;

use App\Http\Repositories\TaskManagerRepository\TeamRepository;
use App\Models\Team;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class TeamService
{
    public function __construct(
        private TeamRepository $teamRepository,
    ) {
    }

    public function index(array $data): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->teamRepository->paginate($data, $user);

    }

    public function store(array $data): Team
    {
        /** @var Team $team */
        $team = $this->teamRepository->create($data);

        return $team;
    }

    public function addUser(array $data, Team $team): bool
    {
        return $this->teamRepository->addUser($data, $team);
    }

    public function removeUser(Team $team, User $user): bool
    {
        return $this->teamRepository->removeUser($team, $user);
    }
}
