<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Article;


// Bài 1–2: Route cơ bản và Resource Controller
Route::resource('articles', ArticleController::class);



//Bài 3: Route có tham số động (ví dụ /articles/page/{page})
Route::get('/articles/page/{page}', function ($page) {
    return "Trang bài viết số: " . (int) $page;
})->whereNumber('page')->name('articles.page');



//Bài 4: Route có tham số tùy chọn + regex kiểm tra slug
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where('slug', '[a-z0-9-]+');


 //Bài 5: Route nhóm (Group) với tiền tố prefix 'admin'
Route::prefix('admin')->group(function () {
    Route::get('/articles', fn() => 'Trang quản trị bài viết')
        ->name('admin.articles.index');
});



//Bài 6: Route Model Binding (demo)
Route::get('/articles/demo/{article}', function (Article $article) {
    // Giả lập dữ liệu khi chưa có database
    $article->title = 'Bài viết mẫu (Route Model Binding)';
    $article->body = 'Nội dung mô phỏng từ binding (chưa gắn DB).';

    return view('articles.show', compact('article'));
})->name('articles.demo.show');



//Bài 7: Route xoá an toàn (Confirm + Method Spoofing)
Route::get('/', function () {
    return redirect('/articles');
});
