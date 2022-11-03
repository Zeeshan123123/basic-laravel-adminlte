<?php

use App\Models\Review;
use App\Models\GiftCard;
use App\Models\Product;
use App\Models\Store;

use Carbon\Carbon;


/*
$server_protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
$base_path = $server_protocol . $_SERVER['SERVER_NAME'];
*/

// staging
// $base_path = 'https://affordit.co.nz/dev/gkf/public/';

// dev
$base_path = 'http://127.0.0.1:8000';


define('BASE_PATH', $base_path.'/');

define('ASSETS', BASE_PATH);

define('ASSETS_FRONTEND', BASE_PATH.'assets/frontend/');

define('ASSETS_BACKEND', BASE_PATH.'assets/backend/');

// Uploaded Images
define('UPLOADS', BASE_PATH.'images/profile/');

// Public Path
define('PUBLICS_PATH', BASE_PATH);


function getCurrentFoodTypeByTime() {
	$current_hours = \Carbon\Carbon::now()->format('H');
	$mealtype = 'other';

	if($current_hours >= 9 && $current_hours <= 17) {
	  $mealtype = 'launch';
	} else if($current_hours > 17 && $current_hours <= 21) {
	  $mealtype = 'dinner';
	}

	return $mealtype;
}

function getCurrentFoodTypeBySelectedTime($time = null) {
	/* commented previous code
	$convertedTimeTo24hrs = date("H", strtotime($time));
	$minutes = date("i", strtotime($time));
	
	$mealType = 'other';
	
	if($convertedTimeTo24hrs >= 9 && ($convertedTimeTo24hrs < 17)) {
	  $mealType = 'launch';
	} else if(($convertedTimeTo24hrs >= 17) && $convertedTimeTo24hrs <= 21) {
	  $mealType = 'dinner';
	}

	return $mealType;
	*/

	// $currentAucklandDateTime = Carbon::now()->subHours(12);
	
	$currentAucklandDateTime = Carbon::parse(request()->date);
    $currentTimeIn24hrs = date("H", strtotime(request()->time));
    
    $day = $currentAucklandDateTime->format('l');
    $mealType = 'other';

    $launchNormalDays = [
    	'Tuesday',
    	'Wednesday', 
    	'Thursday', 
    	'Friday',
    	'Saturday', 
    	'Sunday',
    ];

    // $launchWeekDays = [];

    $dinnerNormalDays = [
    	'Tuesday',
    	 'Wednesday', 
    	'Thursday', 
    	'Friday', 
    	'Saturday', 
    	'Sunday',
    ];


    if (array_search($day, $launchNormalDays) !== FALSE ) {
    	if($currentTimeIn24hrs >= 11 && $currentTimeIn24hrs < 17) {
		  $mealType = 'lunch';
		}
    }

    /*
    // separate lunch timings for sat, sun is removed by me bcz told by kamal;
    if (array_search($day, $launchWeekDays) !== FALSE ) {
    	if($currentTimeIn24hrs >= 9 && $currentTimeIn24hrs < 17) {
		  $mealType = 'lunch';
		}
    }
    */

    if (array_search($day, $dinnerNormalDays) !== FALSE ) {
    	if($currentTimeIn24hrs >= 17 && $currentTimeIn24hrs < 21) {
		  $mealType = 'dinner';
		}
    }

	return $mealType;
}

function getCurrentFoodTypeCurrentTime() {

    // just for local
    // $currentAucklandDateTime = Carbon::now()->subHours(12);
    
    $currentAucklandDateTime = Carbon::now();
    $currentTimeIn24hrs = date("H", strtotime($currentAucklandDateTime));

    
    $day = $currentAucklandDateTime->format('l');
    $mealType = 'other';

    $launchNormalDays = [
    	'Tuesday',
    	'Wednesday', 
    	'Thursday', 
    	'Friday',
    	'Saturday', 
    	'Sunday',
    ];

    //  $launchWeekDays = [];

    $dinnerNormalDays = [
    	'Tuesday',
    	'Wednesday', 
    	'Thursday', 
    	'Friday', 
    	'Saturday', 
    	'Sunday',
    ];


    if (array_search($day, $launchNormalDays) !== FALSE ) {
    	if($currentTimeIn24hrs >= 11 && $currentTimeIn24hrs < 17) {
		  $mealType = 'lunch';
		}
    }

    /* 
    // separate lunch timings for sat, sun is removed by me bcz told by kamal;
    if (array_search($day, $launchWeekDays) !== FALSE ) {
    	if($currentTimeIn24hrs >= 9 && $currentTimeIn24hrs < 17) {
		  $mealType = 'lunch';
		}
    }
    */

    if (array_search($day, $dinnerNormalDays) !== FALSE ) {
    	if($currentTimeIn24hrs >= 17 && $currentTimeIn24hrs < 21) {
		  $mealType = 'dinner';
		}
    }

	return $mealType;
}

function totalReviewsCount($product_id = null)
{
	return Review::
    when($product_id, function($query) use ($product_id) {
        $query->where('product_id', $product_id);
    })
    ->count();
}

function totalRatingCount($product_id = null)
{
	return Review::
    when($product_id, function($query) use ($product_id) {
        $query->where('product_id', $product_id);
    })
    ->avg('rating');
}

function countCartProducts() {
	$cartCollection = \Cart::getContent();
	
	return $cartCollection->count();
}

function getMerchandiseCount() {
	$cartCollection = \Cart::getContent();
	$countMerchandise = 0;

	foreach($cartCollection as $item) {
		$product = Product::find($item->id);

		if ($product->is_merchandise == 1) {
			$countMerchandise++;
		}

	}
	
	if ($cartCollection->count() == $countMerchandise) {
		return true;
	} else {
		return false;
	}
}


function maxAllowedCartQty()
{
	return 999;
}

function minAllowedCartQty()
{
	return 1;
}


function truncateText($string)
{
	return \Illuminate\Support\Str::limit($string, 80, $end='...');
}

function getShippingPrice()
{
	$price = 0;

	if(isset(session()->get('selected_filters')['order_method']) && (session()->get('selected_filters')['order_method']) == "Delivery") {
		$price = $price + 5;
	}
	
	return $price;
}

function getCoupenDiscount() {
	if (session()->get('coupen') && isset(session()->get('coupen')['discount'])) {
		return session()->get('coupen')['discount'];
	} else {
		return false;
	}
}

function getGiftVoucherDiscount() {
	
	if (session()->get('giftcard') && isset(session()->get('giftcard')['discount'])) {
		return session()->get('giftcard')['discount'];
	} else {
		return false;
	}
}

function getGrandTotal()
{
	$total = \Cart::getSubTotal()+getShippingPrice();
	
	if (session()->get('coupen') && isset(session()->get('coupen')['discount'])) {
		$total = $total - session()->get('coupen')['discount'];
	} 

	if (session()->get('giftcard') && isset(session()->get('giftcard')['discount'])) {
		$giftCard = GiftCard::where('code', '=', session()->get('giftcard')['name'])->first();

		if (session()->get('giftcard')['discount'] > $total) {
			$total = session()->get('giftcard')['discount']-$total;
			$giftCard->remaining_amount = $total;
			$giftCard->update();
		} else {
			$total = $total-session()->get('giftcard')['discount'];
			$giftCard->remaining_amount = 0;
			$giftCard->update();
		}
	}

	if (session()->has('tip')) {
		$total = $total + (session()->get('tip'));
	}

	return $total;
}


function itemExistsInCart($id = null) {
	$cart = \Cart::getContent();

	return $cart->contains('id', $id);
}


function getRecords($model = null, $where = [], $order = 'DESC')
{
	$model = "App\Models\\$model";
	
	return $model::
        when($where, function($query) use ($where) {
            $query->where($where);
        })
        ->orderBy('id', $order)
        ->get();
}

function getOrderMethods()
{
	return ['Take Away', 'Delivery', 'Dine-in'];
}

function getOrderMethodsByStore()
{
	if (getSelectedStoreID()) {
		return getOrderMethodsByStoreId(getSelectedStoreID());
	} else {
		return ['Take Away', 'Delivery', 'Dine-in'];
	}
}

function getOrderMethodsByStoreId($id = null)
{
	$store = Store::find($id);
	
	if ($store->order_methods) {
		return json_decode($store->order_methods);
	} else {
		return [];
	}
	
}

function getOrderTimes()
{
	return [
		'09:00 AM',
		'09:30 AM',
		'10:00 AM',
		'10:30 AM',
		'11:00 AM',
		'11:30 AM',
		'12:00 PM',
		'12:30 PM',
		'01:00 PM',
		'01:30 PM',
		'02:00 PM',
		'02:30 PM',
		'03:00 PM',
		'03:30 PM',
		'04:00 PM',
		'04:30 PM',
		'05:00 PM',
		'05:30 PM',
		'06:00 PM',
		'06:30 PM',
		'07:00 PM',
		'07:30 PM',
		'08:00 PM',
		'08:30 PM',
		'08:45 PM',
	];
}


function getSelectedOrderMethod() {
	if (session()->get('selected_filters') && isset(session()->get('selected_filters')['order_method'])) {
		return session()->get('selected_filters')['order_method'];
	} else {
		return false;
	}
}

function getSelectedStoreID() {
	if (session()->get('selected_filters') && isset(session()->get('selected_filters')['store_id'])) {
		return session()->get('selected_filters')['store_id'];
	} else {
		return false;
	}
}

function getSelectedOrderDate() {
	if (session()->get('selected_filters') && isset(session()->get('selected_filters')['date'])) {
		return session()->get('selected_filters')['date'];
	} else {
		return false;
	}
}

function getSelectedOrderTime() {
	if (session()->get('selected_filters') && isset(session()->get('selected_filters')['time'])) {
		return session()->get('selected_filters')['time'];
	} else {
		return false;
	}
}

function getCurrencySymbol($symbol='$')
{
	return $symbol;
}


function getOrderStatuses()
{
	return ['pending', 'placed', 'in progress', 'completed', 'paid'];
}

function getStoreStatuses()
{
	return ['active' => 'Active', 'inactive' => 'Inactive'];
}

function getProductStatuses()
{
	return ['Active' => 'Active', 'Inactive' => 'Inactive'];
}

function getDefaultStatuses()
{
	return ['Active' => 'Active', 'Inactive' => 'Inactive'];
}

function getDefaultBookingStatuses()
{
	return ['new' => 'new', 'pending' => 'pending', 'confirmed' => 'confirmed', 'cancelled' => 'cancelled'];
}

function getDefaultContactUsStatuses()
{
	return ['new' => 'new', 'seen' => 'seen', 'unseen' => 'unseen'];
}

function getDefaultGiftCardStatuses()
{
	return ['active' => 'active', 'inactive' => 'inactive'];
}

function getDefaultCoupenAmountTypes()
{
	return ['fixed' => 'fixed', 'percent' => 'percent'];
}


// pass status when want to get according to status type
function getModelData( $model = null, $condition = null, $orderBy = 'DESC' ) {
	$prefix = "\App\Models\\";
	$prefix = $prefix.ucfirst($model);
	
    return $prefix::
    when($condition, function($query) use ($condition) {
        $query->where($condition);
    })
    ->orderBy('id', $orderBy)
    ->get();
}

function getModelSingleRowData( $model = null, $condition = null ) {
	$prefix = "\App\Models\\";
	$prefix = $prefix.ucfirst($model);
	
    return $prefix::
    when($condition, function($query) use ($condition) {
        $query->where($condition);
    })
    ->first();
}

function getProductTypes()
{
	return ['vegan' => 'vegan', 'vegetarian' => 'vegetarian', 'special' => 'special', 'gluten free' => 'gluten free'];
}

function removeSqareBrackets($string='')
{
	$string = str_replace( array('[',']') , ''  , $string );
	return $string;
}

function getUserTypes()
{
	return [
		// 'web user' => 'web user', 
		'chef' => 'chef', 
		'waiter' => 'waiter'
	];
}

function isAdmin()
{
	if((auth()->user() && auth()->user()->is_admin == 1) && (auth()->user()->type == 'admin')) { 
        return true;
    } else {
    	return false;
    }
}

function isChef()
{
	if((auth()->user() && auth()->user()->is_admin == 0) && (auth()->user()->type == 'chef')) { 
        return true;
    } else {
    	return false;
    }
}

function isWaiter()
{
	if((auth()->user() && auth()->user()->is_admin == 0) && (auth()->user()->type == 'waiter')) { 
        return true;
    } else {
    	return false;
    }
}