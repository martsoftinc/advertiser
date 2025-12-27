<?php
use App\Http\Controllers\AdgroupController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\advertiserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VerifyCampaign;






Route::get('/', [advertiserController::class, 'index']);  
Route::get('/logout', [advertiserController::class, 'logout'])->name('logout');  
Route::get('/login', [advertiserController::class, 'login'])->name('login');  
Route::get('/register', [advertiserController::class, 'register']);
Route::post('/login', [advertiserController::class, 'loginrequest'])->name('userlogin');  
Route::post('/register', [advertiserController::class, 'register'])->name('createAdvertiser');  
Route::get('/test', [advertiserController::class, 'test']); 

Route::middleware(['auth', 'advertiser'])->group(function () { 
Route::get('/dashboard', [advertiserController::class, 'advertiserDashboard'])->name('advertiser');
Route::get('/billing', [advertiserController::class, 'Transaction']);
Route::get('/analytics', [advertiserController::class, 'Analytics']);
Route::get('/userdata', [advertiserController::class, 'userdata']);


Route::post('/verify-campaign', [VerifyCampaign::class, 'verifyCode'])->name('verify.campaign');
// Email Routes
Route::get('/email-campaigns', [advertiserController::class, 'EmailCampagnShow']);
Route::post('/email-campaigns', [advertiserController::class, 'SendCampaignEmails'])->name('SendEmails');

//Route::get('/userlist', [advertiserController::class, 'userlist'])->name('userlist');
Route::get('/adgroup', [advertiserController::class, 'Adgroup'])->name('adgroup');
Route::post('/adgroup', [advertiserController::class, 'storeAdgroup'])->name('storeAdgroup');
Route::get('/support', [advertiserController::class, 'Support']);
Route::get('/campaign-list', [advertiserController::class, 'CampaignList'])->name('campaign.list');
Route::get('/create-campaign', [advertiserController::class, 'createCampaign']);
Route::get('/edit-campaign/{id}', [advertiserController::class, 'editCampaign'])->name('edit-campaign');
Route::get('/create-adgroup', [advertiserController::class, 'createAdgroup']);
Route::post('/create-campaign', [advertiserController::class, 'store'])->name('store');
Route::get('/delete-campaign/{id}', [advertiserController::class, 'deletecampaign'])->name('delete-campaign');

Route::get('/redirect/{id}', [advertiserController::class, 'redirectToArticle']);


Route::get('/adgroups/{adgroup}/campaigns', [AdgroupController::class, 'showCampaigns'])->name('adgroups.campaigns');
Route::patch('/campaigns/{campaign}/update-status', [CampaignController::class, 'updateStatus'])->name('campaigns.update-status');
Route::patch('/campaign/{id}/status', [advertiserController::class, 'toggleStatus'])->name('toggle-campaign-status');
Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::patch('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');

Route::post('/payment/topup', [PaymentController::class, 'initiateTopup'])->name('payment.topup');
Route::get('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
});
