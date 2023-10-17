@extends('layouts.master')
@section("title","အကောင့်များ")
@section('content')
<div class="gap-3 mb-4 row mt-3">
    <!-- <div class="col-lg-4 col-xl-4 mb-3 align-items-right text-align-end"><a href="{{ route('users.create') }}" class="btn bg-light-success px-3  text-success"><i class="bx bxs-plus-square"></i>အကောင့်သစ်</a></div> -->
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Point</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
                @foreach($users as $key=>$user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('users.show',$user->id) }}">{{ $user->username }} </a></td>
                        <td>{{ $user->point }}</td>
                        <td>
                            @if($user->status == 0)
                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i> Active</div>
                            @else 
                                <div class="badge rounded-pill text-success bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i> Active</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="4" style="text-align:center"> There is no user</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="row mt-3">
        <div class="col-xl-8">{{ $users->links() }} </span></div>
        <div class="col-xl-4" style="text-align:right">Total ( {{$users->total() }} ) number of rows</div>
    </div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
            $(document).on("click",".delete-btn",function(){
              Swal.fire({
                      title: 'ပယ်ဖျက်မည်မှာသေချာလား?',
                      showCancelButton: true,
                      confirmButtonText: 'ဖျက်မည်',
                  }).then((result) => {
                  if (result.isConfirmed) {
                      var id = $(this).data("id");
                      var url = "{{ route('users.destroy', ":id") }}";
                          url = url.replace(':id', id);
                      $.ajax({
                          url: url,
                          type: "DELETE",
                          data:[],
                          cache:false,
                          processData:false,
                          contentType:false,
                          success:function(response)
                          {
                              console.log(response);
                              if(response.status == true)
                              {
                                  Swal.fire(response.msg, '', 'success');
                                  window.location.reload();
                              }else
                              {
                                  console.log(response);
                                  Swal.fire('Something wrong!', '', 'error');
                              }
                          },error: function (request, status, error) {
                              Swal.fire(error, '', 'error');
                          }
                      });
                  }
                });
            });

        });
    </script>
@endsection
