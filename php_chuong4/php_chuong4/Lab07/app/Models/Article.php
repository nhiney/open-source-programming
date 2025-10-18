<?php

namespace App\Models;

class Article
{
    public $id;
    public $title;
    public $body;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->body = $data['body'];
    }

    public static function allArticles()
    {
        return [
            1 => ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'],
            2 => ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'],
        ];
    }

    public static function findOrFail($id)
    {
        $articles = self::allArticles();

        if (!isset($articles[$id])) {
            abort(404, 'Bài viết không tồn tại.');
        }

        return new self($articles[$id]);
    }
}
