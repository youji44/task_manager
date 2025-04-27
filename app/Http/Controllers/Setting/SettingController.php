<?php namespace App\Http\Controllers\Setting;

use App\Http\Controllers\WsController;
use Illuminate\Http\Request;
class SettingController extends WsController
{
    public function index(Request $request)
    {
        return View('settings.index');
    }
}
