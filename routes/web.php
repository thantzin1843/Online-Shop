<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['begin_auth'])->group(function(){
    Route::redirect('/','/loginPage');
    Route::get('/loginPage',function(){
        return view('login');
    })->name("auth#login");

    Route::get('/registerPage', function(){
        return view('register');
    });
});
// delete sanctum => important
Route::middleware(['auth',config('jetstream.auth_session'),'verified'])->group(function () {

    // dashboard for distinguish admin? user?
    Route::get('/dashboard',[AuthController::class,'dashboard']);

    // admin
    Route::middleware(['admin_auth'])->group(function(){
        // category
        Route::group(['prefix'=>'/category'],function(){
            Route::get('/list',[CategoryController::class,'listPage'])->name('admin#category_list');
            Route::get('/createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('/create',[CategoryController::class,'create'])->name('category#create');
            Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('/editPage/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
            Route::post('/update',[CategoryController::class,'update'])->name('category#update');
        });

        // password section
        Route::prefix('/password')->group(function(){
            Route::get('/changePasswordPage',[AuthController::class,'changePasswordPage'])->name('admin#passwordChangePage');
            Route::post('/change',[AuthController::class,'changePassword'])->name('password#change');
        });

        // account
        Route::prefix('/account')->group(function(){
            Route::get('/detailsPage',[AdminController::class,'detailPage'])->name('account#details');
            Route::get('/edit',[AdminController::class,'editPage'])->name('admin_account#edit');
            Route::post('/update',[AdminController::class,'update'])->name('admin_account#update');
            Route::get('/admin/list',[AdminController::class,'adminList'])->name('admin#list');
            Route::get('/admin/delete/{id}',[AdminController::class,'deleteAdmin'])->name('admin#deleteAdmin');
            Route::get('/admin/change/role/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('/admin/change_role',[AdminController::class,'change_role'])->name('admin#change_role');
        });

        // product
        Route::prefix('/product')->group(function(){
            Route::get('/productList',[ProductController::class,'list'])->name('product#listPage');
            Route::get('/productCreatePage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('/create',[ProductController::class,'create'])->name('product#create');
            Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('/update',[ProductController::class,'update'])->name('product#update');
        });

        // user associate
        Route::prefix('/user')->group(function(){
            Route::get('/orderListPage',[AdminController::class,'orderList'])->name('admin#userOrder');
            Route::get('/order/detail/{order_code}',[AdminController::class,'orderDetail'])->name('order#detail');
            Route::get('/order/search',[AdminController::class,'orderSearch'])->name('order#search');
            Route::get('list',[AdminController::class,'userList'])->name('admin#user_list');
            Route::get('change/role/{id}',[AdminController::class,'changeUserRole'])->name('change#user_role');
            Route::get('/contact/user',[AdminController::class,'contact_page'])->name('admin#contact');
            Route::get('/delete/message/{id}',[AdminController::class,'deleteMessage'])->name('delete#message');

        });

        // admin ajax
        Route::prefix('/ajax')->group(function(){
            Route::get('/change/status',[AjaxController::class,'changeStatus'])->name('order#changeStatus');
            Route::get('/change/role',[AjaxController::class,'changeRole'])->name('user#changeRole');
        });
    });
    //category



    //User
    Route::group(['prefix'=>'user','middleware'=>'user_auth'], function(){
        Route::get('/home',function(){
            $cartProducts = Cart::where('user_id',Auth::user()->id)->get();
            $products = Product::get();
            $categories = Category::get();
            $orderItems = Order::where('user_id',Auth::user()->id)->paginate(5);
            // dd(count($cartProducts));
            return view('user.main.home',compact(['products','categories','cartProducts','orderItems']));
        })->name('user#home');
        Route::get('/change/password',[UserController::class,'changePassword'])->name('acc#changePassword');
        Route::post('/changePassword',[UserController::class,'changePass'])->name('user#changePassword');
        Route::get('/accountPage',[UserController::class,'accountPage'])->name('user#account');
        Route::get('/account/edit',[UserController::class,'editPage'])->name('account#edit');
        Route::post('/account/update',[UserController::class,'update'])->name('account#update');

        // product
        Route::get('/product/detail/{id}',[ProductController::class,'detail'])->name('product#detail');
        //cart
        Route::get('/cart',[CartController::class,'cart'])->name('cart#detail');
        Route::get('/cart/{id}',[CartController::class,'delete'])->name('cart#delete');
        Route::get('/order/history',[CartController::class,'historyPage'])->name('order#historyPage');
        Route::post('/post/comment',[UserController::class,'postComment'])->name('post#comment');
        // contact
        Route::get('/contactPage',[UserController::class,'contactPage'])->name('user#contact');
        Route::post('/send/contact',[UserController::class,'send'])->name('send#message');
        Route::prefix('ajax')->group(function(){
            Route::get('product/list',[AjaxController::class,'list'])->name('ajax#list');
            Route::get('filter/products/{id}',[AjaxController::class,'filter'])->name('user#filter');
            Route::get('/addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('/orderList',[AjaxController::class,'orderList'])->name('ajax#orderList');
            Route::get('/viewcount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
        });

    });

    // ajax


});

// Route::get('webTesting',function(){
//     $data = [
//         'message'=>'this is web testing'
//     ];
//     return response()->json($data,200);
// });

// localhost:8000/webTesting
