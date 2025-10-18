<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Post::with(['user', 'categories']);
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }
        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        return view('posts.index', compact('posts', 'categories'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required|min:10',
            'author' => 'required|string'
        ]);
        Post::create($validated);
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được tạo thành công!');
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // lấy danh mục để hiển thị ở sidebar
        $categories = Category::withCount('posts')->get();

        return view('posts.show', compact('post', 'categories'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Cập nhật
        $post->update([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
