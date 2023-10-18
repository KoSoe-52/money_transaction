@extends('layouts.masterprint')
@section('title', "adfadf" )
@section('content')
<div class="col-12 mb-3" style="text-align:center;font-weight:bold;">
    <h3> <?php echo date("d F, Y"); ?> ကုန်ကျငွေစာရင်း</h3>
</div>
<div class="table-responsive">
    <table class="table mb-0 table-hover">
        <thead class="table-light">
            <tr>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">#</th>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">အမျိုးအစား</th>
                <th style="border-bottom:2px solid #000;border-top:2px solid #000;text-align:center;">ကုန်ကျငွေ</th>
            </tr>
        </thead>
        <tbody>
           
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
