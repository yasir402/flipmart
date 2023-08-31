 @extends('admin.admin_master')
 @section('admin')

 <div class="container-full">
<div class="row">
		<div class="box box-widget widget-user">
<!-- Add the bg color to the header using any of the bg-* classes -->
<div class="widget-user-header bg-black">
  <h3 class="widget-user-username">Admin Name: {{ $adminData->name }}</h3>
  <a href="{{ route('admin.profile.edit') }}" style="float: right;" class="btn btn-rounded btn-success mb-5">Edit Profile</a>
  <h6 class="widget-user-desc">Admin Email: {{ $adminData->email }}</h6>
</div>

<div class="widget-user-image mt-5">
  <img class="rounded-pill mx-auto d-block" src="{{ (!empty($adminData->profile_photo_path))? url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg')  }}  " style="width:150px;"  alt="User Avatar">
</div>

	  <!-- /.description-block -->
	</div>
	<!-- /.col -->
	
  </div>
  <center>
	<h2 class="p-2">Team-Supreame</h2>
	<table class"table">
		<tr>
			<h2>
		<th>Team members</th>
		</h2>
		</tr>
		<hr>
		<tr>
			<td>Muhammad Yasir</td>
</tr>
			<td>Muhammad Ahllam</td>
			</tr>
			<td>Imran</td>
			</tr>
			<td>Ali jan</td>
			</tr>
			<td>Rakhshi</td>
			</tr>
			<td>Saim</td>
			</tr>
			<td>Bilal</td>
			</tr>
		
		</tr>

	</table>
	</center>
  <!-- /.row -->
</div>
</div>

			</div>
		</section>
		<!-- /.content -->
	  </div>
	  @endsection