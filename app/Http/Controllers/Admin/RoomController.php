<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomFormRequest;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Room_service;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Room_serviceSeeder;



class RoomController extends Controller
{
    public function __construct(Room $rooms, Service $services)
    {
        $this->room = $rooms;
        $this->service = $services;
    }
    public function index(Request $request){
        $services = Room::with('services')->get();
        $pagesize = 20;
        $searchData = $request->except('page');
        if(count($request->all()) == 0){
            // Lấy ra danh sách sản phẩm & phân trang cho nó
            $rooms = Room::paginate($pagesize);
        } else {
            $roomQuery = Room::where('room_no', 'like', "%" .$request->keyword . "%");
            if($request->has('order_by') && $request->order_by > 0){
                if($request->order_by == 1){
                    $roomQuery = $roomQuery->orderBy('room_no');
                }else if($request->order_by == 2){
                    $roomQuery = $roomQuery->orderByDesc('room_no');
                }else if($request->order_by == 3){
                    $roomQuery = $roomQuery->orderBy('price');
                }else if($request->order_by == 4) {
                    $roomQuery = $roomQuery->orderByDesc('price');
                }else if($request->order_by == 5) {
                    $roomQuery = $roomQuery->orderBy('floor');
                }else {
                    $roomQuery = $roomQuery->orderByDesc('floor');
                }
            }
            $rooms = $roomQuery->paginate($pagesize)->appends($searchData);
        }
        return view('admin.rooms.list', ['rooms' => $rooms,'services' => $services,  'searchData' => $searchData]);
    }
    public function remove($id){
        $model = Room::find($id);
        if (!$model) {
            return redirect()->back();
        }
        $path_image = 'storage/' . $model->image;
        if (file_exists($path_image)) {
            unlink($path_image);
        }
        Room_service::where('room_id', $id)->delete();
        $model->delete();
        return redirect()->back();

    }


    public function addForm(){
        $services = Service::all();
        return view('admin.rooms.add-form', ['services' =>$services]);
    }

    public function saveAdd(RoomFormRequest $request){
        $model = new Room();
        $model->fill($request->all());
        // upload ảnh
        if($request->hasFile('uploadfile')){
            $model->image  = $request->file('uploadfile')->storeAs('uploads/rooms', uniqid() . '-' . $request->uploadfile->getClientOriginalName());
        }
        $model->save();
        if ($request->service_id) {
            foreach ($request->service_id as $key => $value) {
                $dataCreated = [
                    'room_id' => $model->id,
                    'service_id' => $value,
                    'additional_price' => $request->additional_price[$key],
                ];
                Room_service::create($dataCreated);
            }
        }
        return redirect(route('room.index'));
    }


    public function editForm($id) {
        $services = Service::all();
        $room = Room::find($id);
        $room_service = Room_service::where('room_id', $id)->get();
        return view('admin.rooms.edit-form', compact('room', 'services', 'room_service'));
    }
    public function saveEdit($id, RoomFormRequest $request){
        $model = Room::find($id);
        $path_image = 'storage/' . $model->image;
        if (file_exists($path_image)) {
            unlink($path_image);
        }
        $model->fill($request->all());
        if ($request->hasFile('uploadfile')) {
            $model->image  = $request->file('uploadfile')->storeAs('uploads/rooms', uniqid() . '-' . $request->uploadfile->getClientOriginalName());
        }
        $model->save();
        if ($request->service_id){
            Room_service::where('room_id', $id)->delete();
            foreach ($request->service_id as $key => $value) {
            $dataUpdateServiceRoom = [
                'room_id' => $id,
                'service_id' => $value,
                'additional_price' => $request->additional_price[$key],
                ];
                Room_service::create($dataUpdateServiceRoom);
            }
        }
        return redirect(route('room.index'));
    }
}
