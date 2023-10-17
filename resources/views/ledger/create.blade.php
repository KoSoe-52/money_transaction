@extends('layouts.master')
@section("title","စာရင်းသွင်းခြင်း")
@section('content')
<div class="gap-3 mb-4 row mt-3">
    <form  id="purchaseForm" method="POST" class="col-lg-8 col-xl-8 row" enctype="multipart/form-data">
        <div class="mb-0 col-md-4">
             @php $date=date("d F, Y"); @endphp
            <label for="date">Date</label>
            <input type="text" class="form-control datepicker" value="{{ $date }}" name="date" id="date">
        </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table mb-0 purchase-table">
        <thead class="table-info">
            <tr>
                <th>ငွေစာရင်းခေါင်းစဉ်</th>
                <!-- <th>အရေအတွက်</th> -->
                <th>ကုန်ကျငွေ</th>
                <th>ဘောင်ချာ</th>
                <th style="text-align:center"><button type="button" class="btn-md btn-icon btn-success btn-plus"><i class="bx bx-plus"></i></button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:45%">
                    <input type="text" class="form-control" name="title[]" form="purchaseForm" required>
                </td>
                <!-- <td style="width:10%"><input type="text" class="form-control" name="quantity[]" form="purchaseForm"></td> -->
                <td style="width:25%"><input type="text" class="form-control" name="price[]" form="purchaseForm" required></td>
                <td style="width:25%"><input type="file" class="form-control" name="image_url[]" form="purchaseForm"></td>
                <td style="text-align:center"><button type="button" class="btn-danger btn-icon btn-md"><i class="bx bx-trash"></i></button></td>
            </tr>
        </tbody>
    </table>
</div>
<div style="text-align:center;width:100%;"><button type="submit" class="btn btn-info mt-4 pl-4 pr-4" form="purchaseForm"><i class="bx bx-paper-plane"></i> စာရင်းသွင်းမည်</button></div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
            $(document).on("submit","#purchaseForm",function(ev){
				ev.preventDefault();
                    var formdata = new FormData(this);
                    Swal.fire({
                        title: "ပစ္စည်းစာရင်းသွင်းမှာလား?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'သွင်းမည်'
				}).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('ledgers.store') }}",
                            type:'POST',
                            data:  formdata,
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
                                        timer:1500
                                    });
                                    setInterval(() => {
                                        window.location.href= "{{ route('ledgers.index') }}";
                                    }, 1500);
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
            $(document).on("click",".btn-plus",function(){
                 let row="<tr>";
                    row+="<td style='width:45%'>"+
                        "<input type='text' class='form-control' name='title[]' form='purchaseForm' required>";
                    row+="</select>"+
                    "</td>"+
                    // "<td style='width:10%'><input type='text' class='form-control' name='quantity[]' form='purchaseForm'></td>"+
                    "<td style='width:25%'><input type='text' class='form-control' name='price[]' form='purchaseForm' required></td>"+
                    "<td style='width:25%'><input type='file' class='form-control' name='image_url[]' form='purchaseForm'></td>"+
                    "<td style='text-align:center'><button type='button' class='btn-danger btn-icon btn-md btn-minus'><i class='bx bx-trash'></i></button></td>"+
                "</tr>";
                $(".purchase-table tbody").append(row);
                $('.single-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
            $(document).on("click",".btn-minus",function(){
                $(this).parent().parent().remove();
            });
        });
    </script>
@endsection
