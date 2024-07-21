<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments(Task $task): JsonResponse
    {
        return response()->json(['objects' => $task->comments]);
    }

    public function deleteComment(Comment $comment): JsonResponse
    {
        return response()->json(['status' => $comment->delete()]);
    }
}
