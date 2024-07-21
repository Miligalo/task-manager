<?php

declare(strict_types=1);

namespace App\Http\Controllers\TaskManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest\AddUserTeamRequest;
use App\Http\Requests\TeamRequest\SearchRequest;
use App\Http\Requests\TeamRequest\StoreRequest;
use App\Http\Service\Auth\AuthService;
use App\Http\Service\TaskManager\TeamService;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(
        private readonly TeamService $teamService
    ) {
    }

    public function index(SearchRequest $request): JsonResponse
    {
        return response()->json(['objects' => $this->teamService->index($request->all())]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(['object' => $this->teamService->store($request->all())]);
    }

    public function addUser(AddUserTeamRequest $request, Team $team): JsonResponse
    {
        return response()->json(['status' => $this->teamService->addUser($request->all(), $team)]);
    }

    public function removeUser(Team $team, User $user): JsonResponse
    {
        return response()->json(['status' => $this->teamService->removeUser($team, $user)]);
    }

}
