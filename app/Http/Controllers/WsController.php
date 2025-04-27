<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class WsController extends Controller {

    public $isAdmin;
    public $user_id;
    public function _construct(){
        $this->isAdmin = false;
        $this->user_id = Sentinel::getUser()->id;
        if( Sentinel::inRole('admin') || Sentinel::inRole('superadmin'))$this->isAdmin = true;
    }
}
