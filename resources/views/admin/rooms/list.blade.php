@extends('admin.layouts.main')
@section('content')

<form action="" method="get">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên Room</label>
                <input  class="form-control" type="text" name="keyword" @isset($searchData['keyword']) value="{{$searchData['keyword']}}" @endisset>
            </div>
        </div>
        <div class="col-6">
            <div>
                <label for="">Sắp Xếp Theo</label>
                <select class="form-control" name="order_by" id="">
                    <option value="0">Mặc định</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 1) selected @endif  value="1">Tên alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 2) selected @endif  value="2">Tên giảm dần alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 3) selected @endif  value="3">Giá tăng dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 4) selected @endif  value="4">Giá giảm dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 5) selected @endif  value="5">Floor tăng dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 6) selected @endif  value="6">Floor giảm dần</option>
                </select>
            </div>
        </div>
    </div>
    <div class="text-center mb-2">
        <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
    </div>
</form>
<div class="row">
    <table class="table table-striped">
        <thead>
            <th>STT</th>
            <th>Roon no</th>
            <th>floor</th>
            <th>Giá</th>
            <th>image</th>
            <th>Dịch vụ</th>
            <th>
                <a href="{{route('room.add')}}" class="btn btn-primary">Tạo mới</a>
            </th>
        </thead>
        <tbody>
            @foreach($rooms as $r)
            <tr>
                <td>{{(($rooms->currentPage()-1)*20) + $loop->iteration}}</td>
                <td>{{$r->room_no}}</td>
                <td>{{$r->floor}}</td>
                <td>{{$r->price}}</td>
                <td><img src="{{asset( 'storage/' . $r->image)}}" width="70" /></td>
                <td>
                    @foreach ($r->services as $nameSv)
                        <span>{{$nameSv->name}}</span><br>
                    @endforeach
                </td>
                <td>
                    <a href="{{route('room.edit', ['id' => $r->id])}}" class="btn btn-danger">Sửa</a>
                    <a href="{{route('room.remove', ['id' => $r->id])}}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    <div class="d-flex justify-content-end">
        {{$rooms->links()}}
    </div>
</div>

@endsection

