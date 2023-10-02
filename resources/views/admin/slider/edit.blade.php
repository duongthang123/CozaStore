@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST" >
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control" placeholder="Nhập tên danh mục">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Đường dẫn</label>
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="upload">Ảnh Sản Phẩm</label>
                <input type="file" id="upload" class="form-control">
                <div class="mt-3" id="image_show">
                    <a href="{{$slider->thumb}}">
                        <img src="{{$slider->thumb}}" width="300px" />
                    </a>
                </div>
                <input type="hidden" value="{{$slider->thumb}}" name="thumb" id="thumb" />
            </div>

            
            <div class="form-group">
                <label>Sắp xếp</label>
                <input type="number" name="sort_by" value="{{$slider->sort_by}}" class="form-control">
            </div>
            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio"
                     id="active" name="active" {{$slider->active == 1 ? "checked" : ""}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" 
                    {{$slider->active == 0 ? "checked" : ""}} id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection