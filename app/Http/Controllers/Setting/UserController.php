<?php namespace App\Http\Controllers\Setting;

use App\Http\Controllers\WsController;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class UserController extends WsController
{
    public function index(Request $request)
    {
        if(Sentinel::check()) return Redirect::route('dashboard');
        try {
            DB::connection()->getPdo();
        }catch(\Exception $e){
            Log::info($e->getMessage());
            return View('user.login')->with('error','Could not connect to the database');
        }
        return View('user.login');
    }

    public function loginAdmin(Request $request){

        try {
            DB::connection()->getPdo();
        }catch(\Exception $e){
            return View('user.login')->with('error','Could not connect to the database');
        }

        try {
            $rules = array(
                'username'     => 'required',
                'password'  => 'required|between:3,32'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Redirect::route('login')->with('info','Please input correct values');
            }
            if(!DB::table('users as u')
                ->join('role_users as ru', 'ru.user_id', '=', 'u.id')
                ->join('roles as r', 'r.id', '=', 'ru.role_id')
                ->select('u.*','r.slug')
                ->where('u.username',$request->get('username'))->first())
            {
                return Redirect::route('login')->with('error', 'Incorrect Username or password!');
            }

            if (Sentinel::authenticate($request->only(['username','password'])))
            {
                return Redirect::route('task')->with('success', 'Welcome to Signing in IR Portal');
            }
            return Redirect::route('login')->with('error', 'Incorrect Username or password!');

        } catch (NotActivatedException $e) {
            return Redirect::route('login')->with('error', 'User can not login');

        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();

        } catch (\Exception $e){
            Log::info($e->getMessage());
        }
        return back()->withInput()->withErrors('error','User can not login');
    }
    public function getLogout()
    {
        Sentinel::logout();
        Session()->flush();
        return Redirect::route('login');
    }

}
