@extends('admin.layouts.main')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên KH</label>
                <input type="text" name="name" class="form-control"value="{{ $model->name }}" value="{{old('name')}}" >
            </div>
            @error('name')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" value="{{ $model->password }}" value="{{old('password')}} " >
            </div>
            @error('password')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{ $model->email }}" value="{{old('email')}}" >
            </div>
            @error('email')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">SĐT</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $model->phone_number }}" value="{{old('phone_number')}}">
            </div>
            @error('phone_number')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('user.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>

</form>
<br>
@endsection
