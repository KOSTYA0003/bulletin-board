<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $posts = Post::paginate(8);

        return response()->json([
            'meta' => [
                'version' => '1.0',
                'device_type' => $request->is_mobile ? 'mobile' : 'desktop',
            ],
            'posts' => $posts->items(),
            'pagination' => $this->buildPagination($posts, $request->is_mobile),
        ]);
    }

    protected function buildPagination($paginator, $isMobile): array
    {
        if ($isMobile) {
            return [
                'simple' => true,
                'previous_page_url' => $paginator->previousPageUrl(),
                'next_page_url' => $paginator->nextPageUrl(),
                'current_page' => $paginator->currentPage(),
            ];
        }

        return [
            'simple' => false,
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'links' => $paginator->linkCollection()->toArray(),
        ];
    }
}
