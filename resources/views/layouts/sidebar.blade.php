<!--navigation-->
<ul class="metismenu" id="menu">

	<li>
		<a href="{{ route('ledgers.index') }}">
			<div class="parent-icon"><i class="bx bx-transfer text-success"></i></div>
			<div class="menu-title">Daily Report</div>
		</a>
	</li>
	@if(Auth::user()->role_id == 1)
	<li>
		<a href="{{ route('users.index') }}">
			<div class="parent-icon"><i class="bx bx-user-plus text-success"></i></div>
			<div class="menu-title">ငွေကိုင်အကောင့်</div>
		</a>
	</li>
	@endif
	@if(Auth::user()->role_id == 2)
	@php $id = Auth::user()->id @endphp
	<li>
		<a href="{{ route('users.profile',$id) }}">
			<div class="parent-icon"><i class="bx bx-dollar text-success"></i></div>
			<div class="menu-title">Balance</div>
		</a>
	</li>
	@endif
	<!-- <li>
		<a href="#">
			<div class="parent-icon"><i class="bx bx-user text-success"></i></div>
			<div class="menu-title">ဌာနအကောင့်</div>
		</a>
	</li>
	<li>
		<a href="{{ route('categories.index') }}">
			<div class="parent-icon"><i class="bx bx-buildings text-success"></i></div>
			<div class="menu-title">ဌာနများ</div>
		</a>
	</li> -->
	<li>
		<a href="{{ route('monthly.report') }}">
			<div class="parent-icon"><i class="bx bx-repost text-success"></i></div>
			<div class="menu-title">Monthly Report</div>
		</a>
	</li>
	<li>
		<a href="{{ route('logout') }}">
			<div class="parent-icon"><i class="bx  bx-log-out text-success"></i></div>
			<div class="menu-title">Logout</div>
		</a>
	</li>
</ul>
<!--end navigation-->