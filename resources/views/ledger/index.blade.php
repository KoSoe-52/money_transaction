@extends('layouts.master')
@section("title","အကောင့်များ")
@section('content')
<div class="gap-3 mb-4 row mt-3">
    @if(Auth::user()->role_id == 2)
        <div class="col-lg-4 col-xl-4 mb-3 align-items-right text-align-end"><a href="{{ route('ledgers.create') }}" class="btn bg-light-success px-3  text-success"><i class="bx bx-dollar"></i>ကုန်ကျငွေသွင်းရန်</a></div>
    @endif
</div>
<div class="col-12">
    <h3>ယနေ့ဝယ်ယူသည့်စာရင်း</h3>
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>အမျိုးအစား</th>
                <th>ကုန်ကျငွေ</th>
                <th>ငွေသွင်းချလံ</th>
            </tr>
        </thead>
        <tbody>
            @if(count($ledgers) > 0)
                @foreach($ledgers as $key=>$data)
                    @php $total[] = $data->price @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->title }} </td>
                        <td>{{ $data->price }}</td>
                        <td>
                            <a href="#" class="btn btn-md btn-info"><i class="bx bx-eye"></i> View </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align:center;font-weight:bold;">စုစုပေါင်း</td>
                    <td colspan="2">{{ array_sum($total) }}</td>
                </tr>
            @else 
                <tr>
                    <td colspan="5" style="text-align:center"> There is no user</td>
                </tr>
            @endif
        </tbody>
    </table>
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

        });
    </script>
@endsection
