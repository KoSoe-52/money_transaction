@extends('layouts.master')
@section("title","ရက်စွဲအလိုက်ကုန်ကျငွေစာရင်း")
@section('content')

<div class="col-12 mt-3">
    <h3>ရက်စွဲအလိုက်ကုန်ကျငွေစာရင်း</h3>
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;">#</th>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;">ရက်စွဲ</th>
                <th style="width:120px;max-width:120px;border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">ကုန်ကျငွေ</th>
            </tr>
        </thead>
        <tbody>
            @if(count($monthly_report) > 0)
                @foreach($monthly_report as $key=>$data)
                    @php $total[] = $data->price @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('ledgers.show',$data->date) }}">{{ $data->date }} </a></td>
                        <td style="text-align:right">{{ number_format($data->price,2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align:right;font-weight:bold;">စုစုပေါင်း</td>
                    <td  style="font-weight:bold;font-size:20px;text-align:right">{{ number_format(array_sum($total),2) }}</td>
                </tr>
            @else 
                <tr>
                    <td colspan="3" style="text-align:center"> No data available...</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="row mt-3">
        <div class="col-xl-8">{{ $monthly_report->links() }} </span></div>
        <div class="col-xl-4" style="text-align:right">Total ( {{$monthly_report->total() }} ) number of rows</div>
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
        });
    </script>
@endsection
