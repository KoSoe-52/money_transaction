@extends('layouts.master')
@section("title","Create User -  M3 Car Spa")
@section('content')
<div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4  mx-auto">
    <h6 class="mb-0 text-uppercase text-primary" style="text-align:center">Create User Account</h6>
    <hr/>
    @if(session('status'))
        <div class="alert alert-success" style="text-align:center">
            {{session('status')}}
        </div>
    @endif
    <div class="card">
        <form class="card-body" action="{{ route('users.store') }}" method="POST">
            @csrf
            <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"   id="name" autocomplete="off"> 
                @error('name') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <label for="username" class="form-label">Username <b class="text-danger">*</b></label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autocomplete="off"> 
                @error('username') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <label for="password" class="form-label">Password <b class="text-danger">*</b></label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bx bx-key"></i></span>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="off"> 
                @error('password') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div style="float:right">
                <button type="submit" class="btn btn-primary"><i class="bx bx-paper-plane"></i> Create Account</button>
            </div>
        </form>
    </div>
</div>   
@endsection
