<?php

use App\Http\Controllers\Api\V1\NewYorkTimes\NewYorkTimeBestSellerController;

Route::get('nyt/best-sellers', NewYorkTimeBestSellerController::class);
