<?php


use App\Http\Controllers\Api\V1\Wink\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Wink\Auth\LoginController;
use App\Http\Controllers\Api\V1\Wink\AuthorController;
use App\Http\Controllers\Api\V1\Wink\BlogController;
use App\Http\Controllers\Api\V1\Wink\UploadImageController;
use App\Http\Controllers\Api\V1\Wink\User\LogoutController;
use App\Http\Controllers\Api\V1\Wink\User\PageController;
use App\Http\Controllers\Api\V1\Wink\User\PostsController;
use App\Http\Controllers\Api\V1\Wink\User\TagsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'author', 'as' => 'author.'], function () {
    Route::post('login', [LoginController::class, "login"])->name('login');
    Route::post('reset', [ForgotPasswordController::class, "reset"])->name('reset');

    Route::get("/", [AuthorController::class, 'index'])->name('index');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [LogoutController::class, "__invoke"])->name('logout');
        Route::apiResource("posts", PostsController::class)->parameters("post")->names("posts");
        Route::apiResource("tags", TagsController::class)->parameters("tag")->names("tags");
        Route::apiResource("pages", PageController::class)->parameters("page")->names("pages");
        Route::post('upload-image', [UploadImageController::class, "__invoke"])->name('upload_image');
    });
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('posts', [BlogController::class, "posts"])->name('posts');
});
