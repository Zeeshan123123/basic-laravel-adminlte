<?php

use App\Models\Review;
use App\Models\GiftCard;
use App\Models\Product;
use App\Models\Store;

use Carbon\Carbon;


// live
// $base_path = 'https://domain.com/public/';

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

function getModelDataBylimit( $model = null, $condition = null, $orderBy = 'DESC', $col = 'id', $limit = 9999 ) {
    $prefix = "\App\Models\\";
    $prefix = $prefix.ucfirst($model);
    
    return $prefix::
    when($condition, function($query) use ($condition) {
        $query->where($condition);
    })
    ->orderBy($col, $orderBy)
    ->take($limit)
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

function getDefaultStatuses()
{
    return ['active' => 'active', 'inactive' => 'inactive'];
}

function plural($string='')
{
    return \Str::plural($string);
}