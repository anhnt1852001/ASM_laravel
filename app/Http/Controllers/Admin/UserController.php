<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request) {
        $pagesize = 20;
        $searchData = $request->except('page');
        if(count($request->all()) == 0){
            // Lấy ra danh sách sản phẩm & phân trang cho nó
            $users = User::paginate($pagesize);
        }else {
            $userQuery = User::where('name', 'like', "%" .$request->keyword . "%");
            if($request->has('order_by') && $request->order_by > 0){
                if($request->order_by == 1){
                    $userQuery = $userQuery->orderBy('name');
                }else {
                    $userQuery = $userQuery->orderByDesc('name');
                }
            }
            $users = $userQuery->paginate($pagesize)->appends($searchData);
        }
        return view('admin.Users.list', ['users' => $users,  'searchData' => $searchData]);
    }

    public function remove($id){
        User::destroy($id);
        return redirect()->back();
    }


    public function addForm(){
        return view('admin.users.add-form');
    }

    public function saveAdd(UserFormRequest $request){
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());
        $user->save();
        return redirect(route('user.index'));
    }

    public function editForm($id) {
        $model = User::find($id);
        if(!$model) {
            return redirect()->back();
        }
        return view('admin.users.edit-form', compact('model'));
    }
    public function saveEdit($id, UserFormRequest $request){
        $model = User::find($id);
        if(!$model){
            return redirect()->back();
        }
        $request->merge(['password' => Hash::make($request->password)]);
        $model->fill($request->all());
        $model->save();
        return redirect(route('user.index'));
    }
}
