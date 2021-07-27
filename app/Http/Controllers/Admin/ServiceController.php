<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Room_service;



class ServiceController extends Controller
{
    public function index(Request $request) {
        $pagesize = 20;
        $searchData = $request->except('page');
        if(count($request->all()) == 0){
            // Lấy ra danh sách sản phẩm & phân trang cho nó
            $services = Service::paginate($pagesize);
        }else {
            $serviceQuery = Service::where('name', 'like', "%" .$request->keyword . "%");
            if($request->has('order_by') && $request->order_by > 0){
                if($request->order_by == 1){
                    $serviceQuery = $serviceQuery->orderBy('name');
                }else {
                    $serviceQuery = $serviceQuery->orderByDesc('name');
                }
            }
            $services = $serviceQuery->paginate($pagesize)->appends($searchData);
        }
        return view('admin.services.list', ['services' => $services,  'searchData' => $searchData]);
    }
    public function remove(Request $request){
        $id = $request->id;
        $service = Service::find($id);
        // dump($service);
        $service->rooms()->detach($request->service_id);
        $service->delete();
        return redirect(route('service.index'));

    }


    public function addForm(){
        return view('admin.services.add-form');
    }
    public function saveAdd(Request $request){
        $model = new Service();
        $model->fill($request->all());
        // upload ảnh
        if($request->hasFile('uploadfile')){
            $model->icon  = $request->file('uploadfile')->storeAs('uploads/services', uniqid() . '-' . $request->uploadfile->getClientOriginalName());
        }
        $model->save();
        return redirect(route('service.index'));
    }
    public function editForm($id) {
        $model = Service::find($id);
        if(!$model) {
            return redirect()->back();
        }
        return view('admin.services.edit-form', compact('model'));
    }
    public function saveEdit($id, Request $request){
        $model = Service::find($id);
        if(!$model){
            return redirect()->back();
        }
        $model->fill($request->all());
        // upload ảnh
        if($request->hasFile('uploadfile')){
            $model->icon = $request->file('uploadfile')->storeAs('uploads/services', uniqid() . '-' . $request->uploadfile->getClientOriginalName());
        }
        $model->save();
        return redirect(route('service.index'));
    }
}
