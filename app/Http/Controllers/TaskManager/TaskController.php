<?php

declare(strict_types=1);

namespace App\Http\Controllers\TaskManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\AddCommentRequest;
use App\Http\Requests\Task\SearchRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Service\TaskManager\TaskService;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {
    }

    public function index(SearchRequest $request): JsonResponse
    {
        return response()->json(['objects' => $this->taskService->index($request->all())]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(['object' => $this->taskService->store($request->all())]);
    }

    public function update(Task $task, UpdateRequest $request): JsonResponse
    {
        return response()->json(['object' => $this->taskService->update($task, $request->all())]);
    }

    public function destroy(Task $task): JsonResponse
    {
        return response()->json(['status' => $this->taskService->destroy($task->id)]);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json(['object' => $this->taskService->show($task)]);
    }

    public function addComment(Task $task, AddCommentRequest $request): JsonResponse
    {
        return response()->json(['object' => $this->taskService->addComment($task, $request->all())]);
    }


}
