@extends('layouts.master')
@section("title","အကောင့်အသေးစိတ်")
@section('content')
<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                <div class="mt-3">
                    <h4>{{$user->username}}</h4>
                    <h5 class="text-secondary mb-1 badge bg-info" style="font-size:20px">{{ number_format($user->point,2) }} MMK</h5>
					@if(Auth::user()->role_id == 1)
                    	<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addMoney"><i class="bx bx-dollar"></i> ငွေသွင်း</button>
					@endif
				</div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
    <h4>ငွေသွင်းအချက်အလက်များ</h4>
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>ရက်စွဲ/အချိန်</th>
                <th>ငွေပမာဏ</th>
                <th>မှတ်ချက်</th>
            </tr>
        </thead>
        <tbody>
            @if(count($transactions) > 0)
                @foreach($transactions as $key=>$data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ date('d-m-Y H:i:s',strtotime($data->date)) }}</td>
                        <td>{{ $data->amount }}</td>
                        <td>{{ $data->description }}</td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="4" style="text-align:center"> There is no transaction...</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div class="modal fade" id="addMoney" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<form method="POST" id="addMoneyForm">
            @csrf
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="exampleModalLabel">ငွေထည့်သွင်းမည်</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div class="mb-1">
                    <label for="amount" class="form-label">ငွေပမာဏ <b class="text-danger">*</b></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bx bx-dollar"></i></span>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\.*?)\.*/g, '$1');"> 
                        @error('amount') 
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
				<div class="mb-1">
					<label for="description" class="col-form-label">မှတ်ချက် <b class="text-danger">*</b></label>
					<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"  style="font-size:20px;">

                    </textarea>
					<span class="invalid-feedback" role="alert">
						<strong class="description"></strong>
					</span>
				</div>
                <input type="hidden" name="user_id" value="{{$user->id}}">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"> <i class="bx bx-paper-plane"></i> ထည့်သွင်းမည်</button>
				<button type="button" class="btn btn-sm btn-danger " data-bs-dismiss="modal"> <i class="lni lni-close"></i> Close</button>
			</div>
		</form>
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
            $(document).on("submit","#addMoneyForm",function(ev){
				ev.preventDefault();
				var formdata = new FormData(this);
				Swal.fire({
					title: "ငွေထည့်သွင်းမှာ သေချာလား?",
					//text: "သေချာစစ်ဆေးပြီးမှ ဆောင်ရွက်ပါ!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'သေချာသည်'
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
							url:"{{ route('addMoney') }}",
							type: "POST",
							data:  formdata,
							cache:false,
							contentType:false,
							processData:false,
							success: function(response) {
							//console.log(JSON.stringify(response))
								if(response.status === true)
								{
									Swal.fire({
											title: response.msg,
											icon:'success',
											width: 300,
											color: '#716add',
											showCancelButton: false,
											showConfirmButton: false,
											timer:1500
										});
										setInterval(() => {
											window.location.reload();
										}, 1500);
								}else if(response.data.length < 1)
								{
									Swal.fire({
											title: response.msg,
											width: 300,
											color: '#716add',
											showCancelButton: false,
											showConfirmButton: false
										});
								}else
								{
									$.each( response.data, function( key, value ) {
										//console.log(key+"/"+value);
										$("."+key).text(value);
										$("#"+key).addClass("is-invalid");
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
				})
			});
        });
    </script>
@endsection
