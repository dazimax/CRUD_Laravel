<?php

namespace App\Http\Controllers;

use App\Http\Controllers\View;
use DB;
use App\CoreConfig;

class BaseController extends Controller
{
	//define return response params
    public	$msg = '';
	public	$status = false;
	public	$data = null;
	protected $site_settings;
}
