<?php

use App\Http\Controllers\App\BlogPostController;

Route::post('blog/post', [BlogPostController::class, 'store']);
