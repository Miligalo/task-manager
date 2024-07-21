<?php

declare(strict_types=1);

namespace App\Http\Service\TaskManager;

use App\Http\Repositories\TaskManagerRepository\TaskRepository;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    public function index(array $data): LengthAwarePaginator
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->taskRepository->paginate($data, $user);
    }

    public function store(array $data): Task
    {
        /** @var Task $task */
        $task = $this->taskRepository->create($data);

        return $task;
    }

    public function update(Task $task, array $data): Task
    {
        /** @var Task $task */
        $task = $this->taskRepository->update($data, $task->id);

        return $task;
    }

    public function show(Task $task): Task
    {
        return $task;
    }

    public function destroy(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }

    public function addComment(Task $task, array $data): Comment
    {
        return $task->comments()->create($data);
    }

}
