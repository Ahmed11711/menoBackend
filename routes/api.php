<?php

use App\Http\Controllers\Api\Affiliate\AffiliateController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationCodeController;
use App\Http\Controllers\Api\Blogs\BlogController;
use App\Http\Controllers\Api\CreateTron\CReateTRonController;
use App\Http\Controllers\Api\Deposit\DepositController;
use App\Http\Controllers\Api\Kyc\KycController;
use App\Http\Controllers\Api\Service\ServiceController;
use App\Http\Controllers\Api\UserPlan\AffiliateAfterActiveAffiliate;
use App\Http\Controllers\Api\UserPlan\AffiliateAfterSubscribe;
use App\Http\Controllers\Api\UserPlan\UserPlanController;
use App\Http\Controllers\Api\Withdraw\WithdrawController;
use App\Http\Controllers\MenuoController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\JwtMiddleware;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;




Route::apiResource('categories', MenuoController::class);
Route::apiResource('products', ProductController::class);
Route::get('/categories/{id}/products', [ProductController::class, 'products']); // 👈 هذا الجديد


Route::get('ss', function () {

    return 'ss';
});
