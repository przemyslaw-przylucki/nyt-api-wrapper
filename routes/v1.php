<?php

use App\Http\Controllers\Api\V1\BlogPostController;

Route::post('blog/post', [BlogPostController::class, 'store']);
