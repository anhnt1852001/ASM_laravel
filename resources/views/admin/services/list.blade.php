@extends('admin.layouts.main')
@section('content')

<form action="" method="get">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên Dịch vụ</label>
                <input class="form-control" type="text" name="keyword" @isset($searchData['keyword']) value="{{$searchData['keyword']}}" @endisset>
            </div>
        </div>
        <div class="col-6">
            <div>
                <label for="">Sắp Xếp Theo</label>
                <select class="form-control" name="order_by" id="">
                    <option value="0">Mặc định</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 1) selected @endif  value="1">Tên alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 2) selected @endif  value="2">Tên giảm dần alphabet</option>
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
            <th>Tên dịch vụ</th>
            <th>Icon</th>
            <th>
                <a href="{{ route('service.add') }}" class="btn btn-primary">Tạo mới</a>
            </th>
        </thead>
        <tbody>
            @foreach($services as $s)
            <tr>
                <td>{{(($services->currentPage()-1)*20) + $loop->iteration}}</td>
                <td>{{$s->name}}</td>
                <td><img src="{{asset( 'storage/' . $s->icon)}}" width="70" /></td>
                <td>
                    <a href="{{route('service.edit', ['id' => $s->id])}}" class="btn btn-danger">Sửa</a>
                    <a href="{{route('service.remove', ['id' => $s->id])}}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    <div class="d-flex justify-content-end">
        {{$services->links()}}
    </div>
</div>

@endsection
