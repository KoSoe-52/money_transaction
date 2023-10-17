@extends('layouts.master')
@section("title","ဌာနထည့်သွင်းခြင်း")
@section('content')
<div class="col-md-8 col-lg-6 col-xl-6 col-xxl-6  mx-auto">
    <h4 class="mb-0 text-uppercase text-primary" style="text-align:center">ဌာနအမည်ထည့်သွင်းရန်</h4>
    <hr/>
    @if(session('status'))
        <div class="alert alert-success" style="text-align:center">
            {{session('status')}}
        </div>
    @endif
    <div class="card">
        <form class="card-body" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <label for="name" class="form-label">ဌာနအမည် <b class="text-danger">*</b></label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bx bx-buildings"></i> </span>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  id="name" autocomplete="off"> 
                @error('name') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div style="float:right">
                <button type="submit" class="btn btn-primary"><i class="bx bx-paper-plane"></i> ထည့်သွင်းမည်</button>
            </div>
        </form>
    </div>
</div>   
@endsection
