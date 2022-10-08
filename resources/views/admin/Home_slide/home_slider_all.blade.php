 @extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route ('update.slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$homeSlide->id}}">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="example-text-input" value="{{$homeSlide->title}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="short_title" class="form-control" id="example-text-input" value="{{$homeSlide->short_title}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Home Slider</label>
                                <div class="col-sm-10">
                                    <input type="file" name="home_slide" class="form-control" id="image" value="{{$homeSlide->home_side}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Video Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="video_url" class="form-control" id="example-text-input" value="{{$homeSlide->video_url}}">
                                </div>
                            </div>
                      
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img  class="rounded avatar-xl" id="showImage" src="                        
                                    {{ (!empty($homeSlide->home_slide)) ? url($homeSlide->home_slide) : url('upload/no-image.jpg') }}" alt="Card image cap"/>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info  waves-effect waves-light" value="Update the Slide"> 
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