@extends('layouts.master')
@section("title","အကောင့်များ")
@section('content')
<div class="gap-3 mb-4 row mt-3">
    <div class="col-lg-4 col-xl-4 mb-3 align-items-right text-align-end"><a href="{{ route('categories.create') }}" class="btn bg-light-success px-3  text-success"><i class="bx bxs-plus-square"></i>ဌာနထည့်သွင်းရန်</a></div>
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Activity</th>
            </tr>
        </thead>
        <tbody>
            @if(count($categories) > 0)
                @foreach($categories as $key=>$data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->name }} </td>
                        <td>
                            <div class="d-flex order-actions">
                                <a href="{{ route('categories.edit',$data->id) }}" class=""><i class='bx bxs-edit text-success'></i></a>
                                <a href="#" data-id="{{ $data->id }}" class="ms-3 delete-btn"><i class='bx bxs-trash text-danger'></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="3" style="text-align:center"> အချက်အလက်မရှိပါ</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="row mt-3">
        <div class="col-xl-8">{{ $categories->links() }} </span></div>
        <div class="col-xl-4" style="text-align:right">Total ( {{$categories->total() }} ) number of rows</div>
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
