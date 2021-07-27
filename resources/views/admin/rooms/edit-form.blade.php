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
                <input type="text" name="room_no" class="form-control" value="{{ $room->room_no }}">
            </div>
            <div class="form-group">
                <label for="">Floor</label>
                <input type="text" name="floor" class="form-control" value="{{ $room->floor }}">
            </div>
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" name="price" class="form-control" value="{{ $room->price }}">
            </div>
            <div class="form-group">
                <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
                <div id="log">
                    @foreach ($room_service as $roomsItem)
                        <div class="row">
                            <div class="col-md-5">
                                <select name="service_id[]" class="form-select form-control">
                                    @foreach ($services as $service)
                                        <option @if ($roomsItem->service_id == $service->id) selected @endif value="{{ $service->id }}">
                                            {{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="{{ $roomsItem->additional_price }}"
                                    name="additional_price[]" class="form-control" placeholder="Giá dịch vụ">
                            </div>
                            <div class="col-md-2"> <button type="button"
                                    class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button> </div>
                        </div>
                    @endforeach
                </div>
                <a href="" class="mb-2 btn btn-primary mr-2 add_services">Thêm dịch vụ</a>
            </div>
        </div>
        <div class="col-6">
            <div class="add-product-preview-img">
                <img src="{{ asset(''.$room->image) }}" alt="">
            </div>
            <div class="form-group">
                <label for="">Ảnh sản phẩm</label>
                <input type="file" name="uploadfile" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Chi tiết sản phẩm:</label>
                <textarea name="detail" class=form-control  rows="10">{{ $room->detail }}</textarea>
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
