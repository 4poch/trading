<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\NouvoproController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnotherGroupController;
use App\Http\Controllers\NpsController;
use App\Http\Controllers\NetflixDataController;
use App\Http\Controllers\MarketingController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\DepositRequestController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// sa se rout pou user a le li fin otantifyes
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// sa se route pou page netflix oders

Route::get('/marketing', function () {
    return view('user.marketing');
})->middleware(['auth', 'verified'])->name('marketing');

Route::get('/netflix', function () {
    return view('user.netflix');
})->middleware(['auth', 'verified'])->name('netflix');


Route::get('/finances', function () {
    return view('user.finances');
})->middleware(['auth', 'verified'])->name('finances');

Route::get('/marketingodered', function () {
    return view('user.marketingodered');
})->middleware(['auth', 'verified'])->name('marketingodered');


Route::get('/infosnetflix', function () {
    return view('user.infosnetflix');
})->middleware(['auth', 'verified'])->name('infosnetflix');

Route::get('/netflix/planstatus', function () {
    return view('user.netflixplanstatus');
})->middleware(['auth', 'verified'])->name('netflixplanstatus');

Route::get('/whatssapgrouplink', function () {
    return view('user.whatssapgrouplink');
})->middleware(['auth', 'verified'])->name('whatssapgrouplink');

Route::get('/digitalservice', function () {
    return view('user.digitalservice');
})->middleware(['auth', 'verified'])->name('digitalservice');


Route::get('/digitalservicehistory', function () {
    return view('user.digitalservicehistory');
})->middleware(['auth', 'verified'])->name('digitalservicehistory');

Route::get('/offers', function () {
    return view('user.offers');
})->middleware(['auth', 'verified'])->name('offers');

Route::get('/creatoffers', function () {
    return view('user.creatoffers');
})->middleware(['auth', 'verified'])->name('creatoffers');


Route::get('/showNotifications', function () {
    return view('user.showNotifications');
})->middleware(['auth', 'verified'])->name('showNotifications');



Route::get('/offeryouaccept', function () {
    return view('user.offeryouaccept');
})->middleware(['auth', 'verified'])->name('offeryouaccept');

// Wout pou afiche fòm nan
Route::get('/nps/create', [NpsController::class, 'create'])->name('createNetflixOrder');

// Wout pou resevwa done yo lè fòm nan soumèt
Route::post('/nps/store', [NpsController::class, 'postNetflixOrder'])->name('postNetflixOrder');

// Wout pou afiche paj siksè
Route::get('/success', [NpsController::class, 'successPage'])->name('successPage');



// sa se lyen pou afiche group list la pouw ka jwen klas la ki gen varyab la

Route::get('/grouplist',[AnotherGroupController::class,'groupList']);

Route::get('/netflixoders',[SubscriptionController::class,'index']);

// sa se rout pou whatssap group form nan 

// sa se rout pou whatssap group form nan
Route::get('/groups/create', 'App\Http\Controllers\AnotherGroupController@create')->name('groups.create');
Route::get('/groups', 'App\Http\Controllers\AnotherGroupController@index');
Route::post('/groups', 'App\Http\Controllers\AnotherGroupController@store')->name('groups.store');


// Route pou soumisyon fòm nan
Route::post('/marketing', [MarketingController::class, 'store'])->name('marketing.store');




// Route pour afficher le formulaire d'abonnement
Route::get('/subscription/form', [SubscriptionController::class, 'showSubscriptionForm'])->name('subscription.form');

// Route pour soumettre l'abonnement
Route::post('/subscription/submit', [SubscriptionController::class, 'submitSubscription'])->name('subscription.submit');

// Wout la pou afiche mesaj siksè abònman
Route::get('/subscription/success', [SubscriptionController::class, 'showSubscriptionSuccess'])->name('subscription.success');



Route::get('/netflixplanstatus', [SubscriptionController::class, 'indexx'])->name('netflixplanstatus');



/* sa se rout ki pou voye data bay user ki fe plan yo */
Route::get('/netflix-form', [NetflixDataController::class, 'create'])->name('netflix.form');

// Route to display the form
Route::get('/netflix-form', [NetflixDataController::class, 'showForm'])->name('netflix.form');

// Route to handle form submission
Route::post('/send-data', [NetflixDataController::class, 'sendData'])->name('send.data');

Route::get('/infosnetflix', [NetflixDataController::class, 'newFunctionName']); // Modifye non fonksyon an nan rout la





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// sa se rout pou admin lan li li fin otantifye

Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->is_admin == 1) {
        return view('admin.dashboard');
    } else {
        return redirect(RouteServiceProvider::HOME);
    }
})->middleware(['auth', 'verified'])->name('admin.dashboard');




Route::get('/admin/netflixoders', [SubscriptionController::class, 'index'])->name('admin.netflixoders');





Route::get('/adminnotifications', function () {
    if (Auth::check() && Auth::user()->is_admin == 1) {
        return view('admin.adminnotifications');
    } else {
        return redirect(RouteServiceProvider::HOME);
    }
})->middleware(['auth', 'verified'])->name('admin.adminnotifications'); 





Route::put('/subscription/update/{subscription}', [SubscriptionController::class, 'update'])->name('subscription.update');


// Route::get('/marketingorders', [MarketingController::class, 'marketingOrders'])->name('marketingOrders');

Route::get('/marketingoders', [MarketingController::class, 'marketingOrders'])->middleware('admin');
// Route::put('/update-status/{id}', [MarketingController::class, 'updateStatus'])->name('updateStatus');
Route::post('/update-marketing-status', [MarketingController::class, 'updateStatus'])->name('updateMarketingStatus');
Route::get('/marketingodered', [MarketingController::class, 'userMarketingOrders'])->name('user.marketingordered');








Route::post('/store-nouvopro', [NouvoproController::class, 'storeData'])->name('nouvopro.storeData');
Route::get('/newdigitalsevis', [NouvoproController::class, 'showData'])->middleware('admin');
Route::put('/update-status/{id}', [NouvoproController::class, 'updateStatus'])->name('updateStatus');
Route::get('/digitalservicehistory', [NouvoproController::class, 'aficheData']);





Route::get('/offers/create', [OfferController::class, 'create'])->name('offers.create');
Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');
Route::get('/offers', [OfferController::class, 'index'])->name('offers');
Route::post('/offers/{offer}/accept', [OfferController::class, 'acceptOffer'])->name('accept.offer');



Route::get('/dashboard', [OfferController::class, 'dashboard'])->name('dashboard');


Route::post('/offers/{offer}/complete', [OfferController::class, 'completeOffer'])->name('offers.complete');

Route::get('/offeryouaccept', [OfferController::class, 'offersYouAccepted'])->name('offers.you.accepted');


Route::post('/offers/{offer}/approve', [OfferController::class, 'approveOffer'])->name('offers.approve');






Route::post('/deposits', [DepositController::class, 'store'])->name('deposits.store');
Route::get('/payment_proof/{filename}', 'DepositController@showProofOfPayment')->name('payment-proof.show');


Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');

// routes/web.php



Route::get('/finances', [BalanceController::class, 'show'])->name('finances');


// Route::get('/depositrequest', [DepositRequestController::class, 'depositRequests']);
Route::get('/depositrequest', [DepositRequestController::class, 'depositRequests'])->middleware('admin');



Route::post('/admin/deposit/complete', [DepositRequestController::class, 'completeDeposit'])->name('admin.completeDeposit');

Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send.notification');

Route::get('/showNotifications', [NotificationController::class, 'showNotifications'])->name('notifications');

Route::get('/withdrawrequest', [WithdrawalController::class, 'index'])->middleware('admin');

Route::put('/withdrawals/{id}/update-status', [WithdrawalController::class, 'updateStatus'])->name('withdrawals.update-status');

// Route::middleware('auth')->get('/finances', [WithdrawalController::class, 'userWithdrawals'])->name('user.withdrawals');
// Route::middleware('auth')->get('/finances', [DepositController::class, 'userDeposits'])->name('user.deposits');

Route::middleware('auth')->get('/finances', [WithdrawalController::class, 'userFinances'])->name('user.finances');


require __DIR__.'/auth.php';
