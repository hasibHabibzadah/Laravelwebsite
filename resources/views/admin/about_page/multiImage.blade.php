@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route ('store.multi.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Add Multi Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="multi_image[]" class="form-control" id="image" multiple="">
                                </div>
                            </div>
               
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img  class="rounded avatar-xl" id="showImage" src="                        
                                    {{ url('upload/no-image.jpg') }}" alt="Card image cap"/>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info  waves-effect waves-light" value="Add Multi Image"> 
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