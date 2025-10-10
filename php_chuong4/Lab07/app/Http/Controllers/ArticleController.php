<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Hiển thị danh sách bài viết.
     */
    public function index()
    {
        // Dữ liệu mẫu (mock)
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'],
            ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'],
        ];

        return view('articles.index', compact('articles'));
    }

    /**
     * Hiển thị form tạo bài viết mới.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Lưu bài viết mới.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
        ]);

        // Tạm thời giả lưu (sẽ dùng DB ở buổi sau)
        return redirect()
            ->route('articles.index')
            ->with('success', 'Tạo bài viết thành công (demo).');
    }

    /**
     * Hiển thị chi tiết 1 bài viết.
     */
    public function show(string $id)
    {
        return "Xem chi tiết bài viết ID: " . (int)$id;
    }

    /**
     * Hiển thị form chỉnh sửa.
     */
    public function edit(string $id)
    {
        $article = ['id' => $id, 'title' => 'Tiêu đề mẫu', 'body' => 'Nội dung mẫu'];
        return view('articles.edit', compact('article'));
    }

    /**
     * Cập nhật bài viết.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', "Cập nhật bài viết #$id thành công (demo).");
    }

    /**
     * Xoá bài viết.
     */
    public function destroy(string $id)
    {
        return redirect()
            ->route('articles.index')
            ->with('success', "Đã xoá bài viết #$id (demo).");
    }
}
