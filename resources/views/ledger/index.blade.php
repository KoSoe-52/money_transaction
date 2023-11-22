@extends('layouts.master')
@section("title",$titleDate)
@section('content')
<div class="gap-3 mb-4 row mt-1">
    @if(Auth::user()->role_id == 2)
        <div class="col-lg-4 col-xl-4 mb-3 align-items-right text-align-end"><a href="{{ route('ledgers.create') }}" class="btn bg-light-success px-3  text-success"><i class="bx bx-dollar"></i>ကုန်ကျငွေသွင်းရန်</a></div>
    @endif
    @if(Auth::user()->role_id == 1)
        <div class="col-lg-4 col-xl-4 mb-3 align-items-right text-align-end"><a href="{{ route('print.daily',$date) }}" target="_blank" class="btn bg-light-success px-3  text-success"><i class="bx bx-dollar"></i>ပရင့်ထုတ်ရန်</a></div>
    @endif
</div>
<div class="col-12">
    <h3>{{$titleDate}}</h3>
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;">#</th>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;">အမျိုးအစား</th>
                <th style="width:120px;max-width:120px;border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">ကုန်ကျငွေ</th>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">ငွေသွင်းချလံ</th>
                @if($delete == true)
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if(count($ledgers) > 0)
                @foreach($ledgers as $key=>$data)
                    @php $total[] = $data->price @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->title }} </td>
                        <td style="text-align:right">{{ number_format($data->price,2) }}</td>
                        <td style="text-align:center">
                            @if($data->image !="")
                                <button class="btn btn-sm btn-info view-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-id="{{$data->image}}"><i class="bx bx-eye"></i> View</button>
                            @else 
                                -
                            @endif
                        </td>
                        @if($delete == true)
                            <td style="text-align:center">
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $data->id }}">Delete</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align:center;font-weight:bold;">စုစုပေါင်း</td>
                    <td  style="font-weight:bold;font-size:20px;text-align:right">{{ number_format(array_sum($total),2) }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @else 
                <tr>
                    <td colspan="5" style="text-align:center"> No data available...</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-dark" id="exampleModalLabel">ဘောင်ချာအချက်အလက်များ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body image-area">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger " data-bs-dismiss="modal"> <i class="lni lni-close"></i> Close</button>
        </div>
    </div>
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
            $(document).on("click",".view-image",function(){

                var image = $(this).data("id");
                var imgLink ="{{ url('') }}"; // the document of project folder
                var img = "<img src='"+imgLink+"/"+image+"' style='width:100%;height:100%;object-fit:cover;'>";
                $(".image-area").html(img);
            });
            $(document).on("click",".delete-btn",function(){
				var id = $(this).data("id");
				Swal.fire({
					  title: 'ပယ်ဖျက်မည်မှာသေချာလား?',
                      showCancelButton: true,
                      confirmButtonText: 'ဖျက်မည်',
				}).then((result) => {
					if (result.isConfirmed) {
						var id = $(this).data("id");
						var url = "{{ route('ledgers.destroy', ":id") }}";
							url = url.replace(':id', id);
							$.ajax({
								url: url,
								type: "DELETE",
								data:  [],
								cache:false,
								contentType:false,
								processData:false,
								success: function(response) {
								console.log(JSON.stringify(response))
									if(response.status === true)
									{
										Swal.fire({
												title: response.msg,
												icon:'success',
												width: 300,
												color: '#716add',
												showCancelButton: false,
												showConfirmButton: false,
											});
										setInterval(() => {
											window.location.reload();
										}, 1000);
										
									}else
									{
										Swal.fire({
											title: response.msg,
											width: 300,
											color: '#716add',
											showCancelButton: false,
											showConfirmButton: false
										});
									}
								},error: function (request, status, error) {
									Swal.fire({
											title: error,
											icon:'error',
											width: 300,
											color: '#716add',
											showCancelButton: false,
											showConfirmButton: false
										});
								}
							});
					}
				});
			});
        });
    </script>
@endsection
