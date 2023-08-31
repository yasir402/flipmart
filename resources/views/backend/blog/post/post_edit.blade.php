@extends('admin.admin_master')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <!-- Basic Forms -->
    <div class="box">
      <div class="box-header with-border">
        <h4 class="box-title">Edit Blog Post </h4>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col">
            <form method="post" action="{{ route('post-update') }}" enctype="multipart/form-data"> 
              @csrf
              <input type="hidden" name="id" value="{{ $blogpost->id }}"> 
              <div class="row">
                <div class="col-12">
                  <div class="row">
                    <!-- start 2nd row  -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <h5>Post Title En <span class="text-danger">*</span>
                        </h5>
                        <div class="controls">
                          <input type="text" name="post_title_en" class="form-control" required="" value="{{ $blogpost->post_title_en }}"> 
                          @error('post_title_en') 
                          <span class="text-danger">{{ $message }}</span> 
                          @enderror
                        </div>
                      </div>
                    </div>
                    <!-- end col md 6 -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <h5>Post Title Hin <span class="text-danger">*</span>
                        </h5>
                        <div class="controls">
                          <input type="text" name="post_title_hin" class="form-control" required="" value="{{ $blogpost->post_title_hin }}"> @error('post_title_hin') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                      </div>
                    </div>
                    <!-- end col md 6 -->
                  </div>
                  <!-- end 2nd row  -->
                  <div class="row">
                    <!-- start 6th row  -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <h5>BlogCategory Select <span class="text-danger">*</span>
                        </h5>
                        <div class="controls">
                          <select name="category_id" class="form-control" required="">
                            <option value="" selected="" disabled="">Select BlogCategory</option> 
                            @foreach($blogcategories as $category) 
                            <option value="{{ $category->id }}" {{ $category->id == $blogpost->category_id ? 'selected' : '' }}>{{ $category->blog_category_name_en }}</option> 
                            @endforeach
                          </select> 
                          @error('category_id') 
                          <span class="text-danger">{{ $message }}</span> 
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end 6th row  -->
                  <div class="row">
                    <!-- start 8th row  -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <h5>Post Details English <span class="text-danger">*</span>
                        </h5>
                        <div class="controls">
                          <textarea id="editor1" name="post_details_en" rows="10" cols="80" required="">
		                        {!! $blogpost->post_details_en !!}
					              	</textarea>
                        </div>
                      </div>
                    </div>
                    <!-- end col md 6 -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <h5>Post Details Hindi <span class="text-danger">*</span>
                        </h5>
                        <div class="controls">
                          <textarea id="editor2" name="post_details_hin" rows="10" cols="80">
		                       {!! $blogpost->post_details_hin !!}
						             </textarea>
                        </div>
                      </div>
                    </div>
                    <!-- end col md 6 -->
                  </div>
                  <!-- end 8th row  -->
                  <hr>
                  <div class="text-xs-right">
                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                  </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
  </section>

  <!-- /.content -->
  <section class="content">
  <div class="row">

<div class="col-md-12">
        <div class="box bt-3 border-info">
          <div class="box-header">
     <h4 class="box-title">Blog Post Image <strong>Update</strong></h4>
          </div>


    <form method="post" action="{{ route('update-post-image') }}" enctype="multipart/form-data">
        @csrf

     <input type="hidden" name="id" value="{{ $blogpost->id }}">
    <input type="hidden" name="old_img" value="{{ $blogpost->post_image }}">

      <div class="row row-sm">

        <div class="col-md-3">

<div class="card">
  <img src="{{ asset($blogpost->post_image) }}" class="card-img-top" style="height: 130px; width: 280px;">
  <div class="card-body">

    <p class="card-text"> 
      <div class="form-group">
        <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
    <input type="file" name="post_image" class="form-control" onChange="mainThamUrl(this)"  >
     <img src="" id="mainThmb">
      </div> 
    </p>

  </div>
</div>    

        </div><!--  end col md 3     -->  


      </div>      

      <div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
     </div>
<br><br> 
    </form>      
    </div>

        </div>
        </div>

  </div> <!-- // end row  -->

 </section>
</div>
<script type="text/javascript">
  function mainThamUrl(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#mainThmb').attr('src', e.target.result).width(80).height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
 @endsection