@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route ('update.about') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$about->id}}">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="example-text-input" value="{{$about->title}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="short_title" class="form-control" id="example-text-input" value="{{$about->short_title}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Short description</label>
                                <div class="col-sm-10">
                                  <textarea name="short_description" id="" cols="30" rows="10" class="form-control">{{$about->short_description}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">long description</label>
                                <div class="col-sm-10">
                                  <textarea name="long_description" id="elm1" cols="30" rows="10" class="form-control">{{$about->long_description}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">About Image Slider</label>
                                <div class="col-sm-10">
                                    <input type="file" name="about_image" class="form-control" id="image" value="{{$about->about_image}}">
                                </div>
                            </div>
               
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img  class="rounded avatar-xl" id="showImage" src="                        
                                    {{ (!empty($about->home_slide)) ? url($about->about_image) : url('upload/no-image.jpg') }}" alt="Card image cap"/>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info  waves-effect waves-light" value="Update About"> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
})

    
</script>

@endsection