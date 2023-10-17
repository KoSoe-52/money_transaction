@extends('layouts.master')
@section("title","Dashboard - A Application")
@section('content')
<div class="row row-cols-1 row-cols-lg-4">
    <div class="col">
        <div class="card rounded-4 bg-gradient-rainbow bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Today Customers</p>
                    </div>
                    <div class="fs-1 text-white">
                    <i class='lni lni-users'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-burning bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Today Vehicle</p>
                    </div>
                    <div class="fs-1 text-white">
                    <i class='bx bx-car'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-moonlit bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Today Sale</p>
                    </div>
                    <div class="fs-1 text-white">
                        <i class='bx bx-cart' ></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-cosmic bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Today Purchase</p>
                    </div>
                    <div class="fs-1 text-white">
                        <i class='bx bx-cart'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-primary bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Total Vehicle</p>
                    </div>
                    <div class="fs-1 text-white">
                        <i class='bx bx-car'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-info bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Total Customer</p>
                    </div>
                    <div class="fs-1 text-white">
                        <i class='lni lni-users'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-warning bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Total Product</p>
                    </div>
                    <div class="fs-1 text-white">
                        <i class='lni lni-producthunt'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 bg-gradient-warning bubble position-relative overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-0">
                    <div class="">
                        <h4 class="mb-0 text-white">-</h4>
                        <p class="mb-0 text-white">Total Service</p>
                    </div>
                    <div class="fs-1 text-white">
                        <i class='lni lni-service'></i>
                    </div>
                </div>
                <!-- <small class="mb-0 text-white">+2.6% Since Last Week</small> -->
            </div>
        </div>
    </div>
</div><!--end row--> 


<div class="row">
    <div class="col-12  d-flex">
        <div class="card rounded-4 w-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h6 class="mb-0">Sales and Purchases</h6>
                </div>
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
                <div class="chart-container-0">
                <canvas id="chart1"></canvas>
                </div>
            </div>
        </div>
    </div>
</div><!--end row-->
@endsection
@section('script')

@endsection