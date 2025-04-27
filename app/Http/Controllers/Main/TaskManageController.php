<?php namespace App\Http\Controllers\Main;

use App\Http\Controllers\WsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Validator;
class TaskManageController extends WsController
{
    public function index(Request $request)
    {
        try {
            $task = DB::table('task_list')
                ->where('status','<',2)
                ->orderBy('priority','asc')
                ->get();

            return View('task.index', compact('task'));

        }catch(\Exception $e){
            Log::info($e->getMessage());
            return back()->with('error', "Failed!");
        }
    }

    public function add($id, Request $request)
    {
        $task = DB::table('task_list')->where('id',$id)->first();
        return View('task.add',compact('task'));
    }

    public function save(Request $request)
    {
        $user_id = '';
        if(Sentinel::check()) $user_id = Sentinel::getUser()->id;

        $id = $request->get('id');
        $date = $request->get('date');
        $time = $request->get('time');
        $task_name = $request->get('task_name');
        $last_priority = DB::table('task_list')->max('priority')??0;

        $validator = Validator::make($request->all(), ['task_name' => 'required']);
        if ($validator->fails()) {
            return Redirect::route('task')->with('info','Please input a Task name!');
        }
        try {
            DB::beginTransaction();

            if(empty($id)){
                DB::table('task_list')->Insert(
                    [
                        'user_id' => $user_id,
                        'date' => $date,
                        'time' => $time,
                        'task_name' => $task_name,
                        'priority' => $last_priority+1,
                    ]
                );
            }else{
                DB::table('task_list')->where('id',$id)->update(
                    [
                        'user_id' => $user_id,
                        'date' => $date,
                        'time' => $time,
                        'task_name' => $task_name,
                    ]
                );
            }

            DB::commit();
            return Redirect::route('task')->with('success', 'Successful saved');

        }catch(\Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            return Redirect::route('task')->with('error', "Failed Adding");
        }
    }

    public function change(Request $request)
    {

        $tasks = $request->get('tasks');
        try {
            DB::beginTransaction();
            foreach ($tasks as $key=>$task) {
                DB::table('task_list')->where('id',$task['id'])->update(
                    [
                        'priority' => $key+1,
                    ]
                );
            }
            DB::commit();
            return response()->json(['success'=>$tasks]);
        }catch(\Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['error'=>"Failed!"]);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        Log::info($id);
        if(DB::table('task_list')->where('id',$id)->update(['status'=>2]))
            return;
        else
            return;
    }
}
