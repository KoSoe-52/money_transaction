@extends('layouts.masterprint')
@section('title', $reprotDate )
@section('content')
<div class="col-12 mb-3" style="text-align:center;font-weight:bold;">
    <h3> <?php echo date("d F, Y"); ?> ကုန်ကျငွေစာရင်း</h3>
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;">#</th>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;">အမျိုးအစား</th>
                <th style="width:120px;max-width:120px;border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">ကုန်ကျငွေ</th>
                
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
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td style="text-align:center;font-weight:bold;">စုစုပေါင်း</td>
                    <td  style="font-weight:bold;font-size:20px;text-align:right">{{ number_format(array_sum($total),2) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td  style="text-align:center;font-weight:bold;">လက်ကျန်ငွေစုစုပေါင်း</td>
                    <td  style="font-weight:bold;font-size:20px;text-align:right">{{ number_format($point,2) }}</td>
                </tr>
            @else 
                <tr>
                    <td colspan="3" style="text-align:center"> အချက်အလက်မရှိပါ </td>
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
