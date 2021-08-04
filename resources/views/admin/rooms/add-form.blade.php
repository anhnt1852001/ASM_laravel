@extends('admin.layouts.main')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function addServices(e) {
               e.preventDefault();

               $("#log").append('<div class="row"> <div class="col-md-5"><select name="service_id[]" class="form-select form-control">  @foreach ($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option> @endforeach </select>   </div> <div class="col-md-5"> <input type="text" name="additional_price[]" class="form-control" placeholder="Giá dịch vụ"> </div><div class="col-md-2"> <button type="button"    class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button> </div></div>');
           }
           function deleteServices(e){
               e.preventDefault();
               $(this).parent().parent().remove();
           }
           $(function() {
               $(document).on("click", '.add_services', addServices);
               $(document).on('click', '.delete_services', deleteServices);
           })
   </script>
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên Room</label>
                <input type="text" name="room_no" class="form-control" value="{{old('room_no')}}">
            </div>
            @error('room_no')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            <div class="form-group">
                <label for="">Floor</label>
                <input  min="1" max="30" type="number" name="floor" class="form-control" value="{{old('floor')}}">
            </div>
            @error('floor')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" name="price" class="form-control" value="{{old('price')}}">
            </div>
            @error('price')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            <div class="form-group">
                <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
                <div id="log">
                    <!-- <div class="row">
                                <div class="col-md-5">
                                    <select class="form-select form-control">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" placeholder="Nhập tên phòng">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="mb-2 btn btn-danger mr-2">Primary</button>
                                </div>
                            </div>  -->
                </div>
                <a href="" class="mb-2 btn btn-primary mr-2 add_services">Thêm dịch vụ</a>


            </div>
        </div>
        <div class="col-6">
            <div class="add-product-preview-img">

            </div>
            <div class="form-group">
                <label for="">Ảnh</label>
                <input type="file" name="uploadfile" class="form-control">
            </div>
            @error('uploadfile')
                    <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Chi tiết</label>
                <textarea name="detail" class=form-control  rows="10">{{old('detail')}}</textarea>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('room.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>

</form>
<br>
@endsection
