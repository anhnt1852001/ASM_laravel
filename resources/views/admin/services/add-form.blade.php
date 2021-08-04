@extends('admin.layouts.main')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên Dịch vụ</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
            </div>
            @error('name')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="add-product-preview-img">

            </div>
            <div class="form-group">
                <label for="">Icon</label>
                <input type="file" name="uploadfile" class="form-control">
            </div>
            @error('uploadfile')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('service.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>

</form>
<br>
@endsection
