<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\User;
use App\Models\LiveSet;
use App\Models\Event;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Audio;
use Illuminate\Support\Str;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LiveSetController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AudioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\WishlistController;

// TARUH DI SINI (DI LUAR GROUP APAPUN)
Route::get('api/binderbyte/locations', function (Request $request) {
    return Http::get('https://api.binderbyte.com/v1/locations', [
        'api_key' => 'c3e7f9e66adcb94d549ffac93852a7cbf4af99b5a0d07c54be7d3453ab9df45a',
        'search' => $request->search
    ])->json();
});

Route::post('api/binderbyte/get-costs', function (Request $request) {
    return Http::asForm()->post('https://api.binderbyte.com/v1/cost', [
        'api_key' => 'c3e7f9e66adcb94d549ffac93852a7cbf4af99b5a0d07c54be7d3453ab9df45a',
        'origin' => 'village_34.04.07.2003', 
        'destination' => $request->destination,
        'weight' => max(1, ceil(($request->weight ?? 1000) / 1000)),
        'courier' => 'jnt'
    ])->json();
});

Route::post('/snap/token', function (Request $request) {

    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', true);
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // =========================
    // VALIDATION
    // =========================

    $request->validate([
        'email' => 'required|email',
        'first_name' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ]);

    // =========================
    // GET CART
    // =========================

    $cart = session()->get('direct_checkout');

    if (!$cart) {
        $cart = session()->get('cart', []);
    }

    if (empty($cart)) {
        return response()->json([
            'message' => 'Data produk tidak ditemukan (Keranjang Kosong)'
        ], 400);
    }

    // =========================
    // HITUNG TOTAL
    // =========================

    $subtotal = 0;
    $item_details = [];

    foreach ($cart as $item) {

        $price = (int) $item['price'];
        $qty   = (int) $item['qty'];

        $subtotal += $price * $qty;

        $item_details[] = [
            'id' => $item['id'] ?? uniqid(),

            'price' => $price,

            'quantity' => $qty,

            'name' => substr($item['name'], 0, 50)
        ];
    }

    // =========================
    // SHIPPING
    // =========================

    $shipping_cost = (int) $request->shipping_cost;

    if ($shipping_cost <= 0) {
        return response()->json([
            'message' => 'Harap pilih kurir pengiriman'
        ], 400);
    }

    $item_details[] = [
        'id' => 'SHIPPING',

        'price' => $shipping_cost,

        'quantity' => 1,

        'name' => 'Shipping Cost'
    ];

    $gross_amount = $subtotal + $shipping_cost;

    // =========================
    // CREATE ORDER
    // =========================

    $midtransOrderId = 'SFLAME-' . strtoupper(Str::random(10));

    $order = Order::create([

        // CUSTOMER
        'user_id' => auth()->id(),
        'email' => $request->email,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,

        // ADDRESS
        'address' => $request->address,
        'province' => $request->province,
        'postal_code' => $request->postal_code,

        // SHIPPING
        'shipping_cost' => $shipping_cost,
        'courier' => $request->courier,
        'courier_service' => $request->courier_service,
        'delivery_type' => $request->delivery_type,

        // TOTAL
        'subtotal' => $subtotal,
        'total' => $gross_amount,

        // PAYMENT
'payment_status' => 'pending',

'status' => 'pending',

'midtrans_order_id' => $midtransOrderId,
    ]);

    // =========================
    // SAVE ORDER ITEMS
    // =========================

    foreach ($cart as $item) {

        OrderItem::create([

            'order_id' => $order->id,

            'product_id' => $item['id'] ?? null,

            'product_name' => $item['name'],

            'image' => $item['image'],

            'size' => $item['size'],

            'price' => $item['price'],

            'qty' => $item['qty'],
        ]);
    }

    // =========================
    // MIDTRANS PARAMS
    // =========================

    $params = [

        'transaction_details' => [
            'order_id' => $midtransOrderId,
            'gross_amount' => $gross_amount,
        ],

        'item_details' => $item_details,

        'customer_details' => [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ]
    ];

    // =========================
    // GET SNAP TOKEN
    // =========================

    try {

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snapToken' => $snapToken
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'message' => $e->getMessage()
        ], 500);
    }
});

// VIEW
Route::get('/signup', function () {
    return view('signup');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::post(
    '/api/shipping-rate',
    [ShippingController::class, 'calculate']
);


Route::get('/api/location', function (Request $request) {

    try {

        $response = Http::withHeaders([

            'Authorization' => env('BITESHIP_API_KEY'),
            'Content-Type' => 'application/json',

        ])->get(
            'https://api.biteship.com/v1/maps/areas',
            [

                'countries' => 'ID',

                'input' => $request->input,

                'type' => 'single'
            ]
        );

        return response()->json(
            $response->json()
        );

    } catch (\Exception $e) {

        return response()->json([

            'success' => false,

            'message' => $e->getMessage()

        ], 500);
    }
});


Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle']);


// ACTION
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/shop', [ShopController::class, 'index']);

Route::get('/product/{product}', function (Product $product) {

    $product->load('images', 'sizes');

    return view('product-detail', compact('product'));

});

Route::get('/events', function () {

    $events = Event::latest()->get();

    return view('events', compact('events'));

});

Route::get('/events/{slug}', function ($slug) {

    $event = Event::where('slug', $slug)
        ->firstOrFail();

    return view('event-detail', compact('event'));

});

Route::get('/sessions', function () {
    $sessions = LiveSet::latest()->get();
    return view('sessions', compact('sessions'));
});

Route::get('/rosters', function () {
    return view('rosters');
});

Route::get('/audio', function () {
    try {
        $audios = Audio::with(['tracks' => function ($q) {
            $q->where('is_active', true);
        }])->latest()->get();
    } catch (\Throwable $e) {
        $audios = collect();
    }
    return view('audio', compact('audios'));
});

Route::get('/audio/{slug}', function ($slug) {
    $audio = Audio::with(['tracks' => function ($q) {
        $q->where('is_active', true);
    }])->where('slug', $slug)->first();

    if (!$audio) {
        // Fallback: If not found by slug, try by ID or fallback
        $audio = Audio::with(['tracks' => function ($q) {
            $q->where('is_active', true);
        }])->find($slug);
    }

    if (!$audio) {
        // Mock fallback if user clicks supernova before database entry
        $audio = (object)[
            'id' => 0,
            'title' => 'SUPERNOVA EDIT PACK',
            'slug' => 'supernova-edit-pack',
            'artist' => 'SUPERFLAME',
            'category' => 'EDIT PACK',
            'description' => 'Raw industrial grooves and underground energy recorded live during SUPERFLAME sessions.',
            'image' => 'audio/supernova.png',
            'audio_url' => 'https://soundcloud.com/superflame99/sets/supernova',
            'buy_url' => 'https://lynk.id/superflame',
            'buy_label' => 'Buy Now',
            'release_date' => date('Y-m-d'),
            'tracks' => collect()
        ];
    }

    return view('audio-detail', compact('audio'));
});

Route::get('/profile', function () {

    if (!auth()->check()) {

        return view('profile', [
            'wishlists' => collect(),
            'orders' => collect()
        ]);
    }

    $wishlists = auth()->user()
        ->wishlists()
        ->with('product.images')
        ->latest()
        ->get();

    $orders = \App\Models\Order::with('items')
    ->where(function ($query) {

        $query->where('user_id', auth()->id())

              ->orWhere('email', auth()->user()->email);

    })
    ->latest()
    ->get();

    return view('profile', compact(
        'wishlists',
        'orders'
    ));

});


Route::get('/checkout', function (Request $request) {

    // 🔥 kalau user klik dari cart → hapus direct_checkout
    if ($request->has('from_cart')) {
        session()->forget('direct_checkout');
    }

    // 🔥 PRIORITAS: direct_checkout dulu
    $cart = session('direct_checkout') ?? session('cart', []);

    // 🔥 kalau kosong → balik ke shop
    if (empty($cart)) {
        return redirect('/shop');
    }

    return view('checkout', compact('cart'));
});

Route::post('/checkout/process', [PaymentController::class, 'checkout']);
Route::get('/payment/success', [PaymentController::class, 'success']);

view()->composer('*', function ($view) {
    $cart = session('cart', []);
    $view->with('cart', $cart);
});

Route::post('/cart/remove/{index}', function ($index) {

    $cart = session()->get('cart', []);

    unset($cart[$index]); // hapus item

    $cart = array_values($cart); // reset index biar rapi

    session(['cart' => $cart]);

    return redirect()->back()->with('openCart', true);
});

Route::post('/cart/add', function (Request $request) {

    $cart = session()->get('cart', []);

    $qty = max(1, (int) $request->input('qty'));

    $found = false;

    foreach ($cart as &$item) {

        if (
            $item['id'] == $request->input('id') &&
            $item['size'] == $request->input('size')
        ) {

            $item['qty'] += $qty;

            $found = true;

            break;
        }
    }

    if (!$found) {

        $cart[] = [

            'id' => $request->input('id'),

            'name' => $request->input('name'),

            'price' => $request->input('price'),

            'image' => $request->input('image'),

            'size' => $request->input('size'),

            'qty' => $qty
        ];
    }

    session(['cart' => $cart]);

    return redirect()->back()->with('openCart', true);
});


Route::post('/cart/update/{index}', function ($index, Request $request) {

    $cart = session()->get('cart', []);

    if (isset($cart[$index])) {
        $cart[$index]['qty'] += $request->input('change');

        // kalau qty <= 0 → hapus
        if ($cart[$index]['qty'] <= 0) {
            unset($cart[$index]);
            $cart = array_values($cart);
        }
    }

    session(['cart' => $cart]);

    return redirect()->back()->with('openCart', true);
});

Route::post(
'/checkout/direct',
function(Request $request){

    // RESET DIRECT CHECKOUT DULU
    session()->forget('direct_checkout');

    $directCart = [[
        'id' => $request->id,
        'name' => $request->name,
        'price' => $request->price,
        'image' => $request->image,
        'size' => $request->size,
        'qty' => $request->qty
    ]];

    session(['direct_checkout' => $directCart]);

    return redirect('/checkout');
});

/*
|--------------------------------------------------------------------------
| WISHLIST
|--------------------------------------------------------------------------
*/

Route::post(
    '/wishlist/toggle/{id}',
    [WishlistController::class, 'toggle']
);





Route::get('/test-biteship', function () {

    $order = \App\Models\Order::with('items')
        ->latest()
        ->first();

    $controller =
        new \App\Http\Controllers\MidtransCallbackController;

    $reflection = new ReflectionClass($controller);

    $method = $reflection->getMethod('createBiteshipOrder');

    $method->setAccessible(true);

    return $method->invoke($controller, $order);
});

Route::post('/api/fake-shipping', function (Request $request) {

    $city = strtolower($request->city);
    $weight = $request->weight ?? 1000; // gram

    // 🔥 DETEKSI ZONA
    if (str_contains($city, 'yogyakarta') || str_contains($city, 'jogja') || str_contains($city, 'solo') || str_contains($city, 'semarang')) {
        $zone = 1;
        $etd = "1-2";
        $pricePerKg = 10000;
    } elseif (str_contains($city, 'jakarta') || str_contains($city, 'bandung') || str_contains($city, 'bogor')) {
        $zone = 2;
        $etd = "2-3";
        $pricePerKg = 15000;
    } else {
        $zone = 3;
        $etd = "3-5";
        $pricePerKg = 25000;
    }

    // 🔥 HITUNG BERAT (per kg dibulatkan ke atas)
    $kg = ceil($weight / 1000);

    $cost = $kg * $pricePerKg;

    return response()->json([
        "success" => true,
        "results" => [
            [
                "courier" => "JNE",
                "service" => "REG",
                "price" => $cost,
                "etd" => $etd
            ],
            [
                "courier" => "J&T",
                "service" => "EZ",
                "price" => $cost + 2000,
                "etd" => $etd
            ],
            [
                "courier" => "SiCepat",
                "service" => "REG",
                "price" => $cost + 1000,
                "etd" => $etd
            ]
        ]
    ]);


    Route::get('/test-base-rajaongkir', function () {

    $baseUrl = env('RAJAONGKIR_BASE_URL');

    $res = Http::withHeaders([
        'key' => env('RAJAONGKIR_API_KEY')
    ])->get($baseUrl);

    return [
        'url' => $baseUrl,
        'status' => $res->status(),
        'body' => $res->body()
    ];
});

});

// halaman notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// proses verify
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {

    $user = User::findOrFail($id);

    // VALIDASI HASH
    if (! hash_equals(
        sha1($user->getEmailForVerification()),
        $hash
    )) {

        abort(403);
    }

    // VERIFY EMAIL
    if (! $user->hasVerifiedEmail()) {

        $user->markEmailAsVerified();
    }

    // AUTO LOGIN
    Auth::login($user);

    // REDIRECT HOME
    return redirect('/')
        ->with('success', 'Email verified successfully!');

})->middleware(['signed'])->name('verification.verify');


// resend email
Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');

})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/test-midtrans', function () {

    return env('MIDTRANS_SERVER_KEY');

});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index']);

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        Route::resource('products', ProductController::class);

        Route::delete(
            '/products/gallery/{image}',
            [ProductController::class, 'deleteGallery']
        );

        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */

        Route::resource('orders', OrderController::class)
    ->only(['index', 'show', 'update']);

        /*
        |--------------------------------------------------------------------------
        | LIVESETS
        |--------------------------------------------------------------------------
        */

        Route::resource('livesets', LiveSetController::class);

        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        Route::resource('events', EventController::class);

        /*
        |--------------------------------------------------------------------------
        | AUDIOS
        |--------------------------------------------------------------------------
        */

        Route::post('/audios/track/{track}/toggle', [AudioController::class, 'toggleTrackStatus']);
        Route::delete('/audios/track/{track}', [AudioController::class, 'deleteTrack']);
        Route::resource('audios', AudioController::class);

    });
    
    
