<?php
namespace App\Http\Controllers\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\model\task;
class TaskController extends Controller
{
    public function __construct() {
    }
    public function index() {
        $data['tasks'] = $this->listTasks();
        return view('tasks.list', $data);
    }
    public function addTaskForm() {
        $data['form_type'] = 'new'; 
        return view('tasks.form', $data);
    }
    public function updateTaskForm($id) {
        $data['form_type'] = 'edit';
        $data['task'] = task::find($id);
        
        return view('tasks.form', $data);
    }
    public function addTask(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|max:100',
            'description'=>'required|max:250'
        ]);
   
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $data['task_number'] = Str::random(16);
        if(task::create($data)){    
            $list['tasks'] = $this->listTasks();
            return redirect('/')->with('success', 'successfully added new task');
        } 
        return back()->with('error', 'Something went wrong!!');
    }
    public function updateTask(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|max:100',
            'description'=>'required|max:250'
        ]);
   
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        if(task::find($data['id'])->update($data)){
            $list['tasks'] = $this->listTasks();
            return redirect('/')->with('success', 'successfully updated task');
        }
        return back()->with('error', 'Something went wrong!!');
    }
    public function deleteTask($id){
        if(task::destroy($id)){
            return back()->with('success', 'Successfully delete task');
        }
        return back()->with('error', 'Something went wrong!!');
    }
    private function listTasks() {
        return task::all();
    }
    
}