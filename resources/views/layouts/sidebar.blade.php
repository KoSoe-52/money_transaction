<!--navigation-->
<ul class="metismenu" id="menu">
	<!-- <li>
		<a href="{{ route('dashboard') }}">
			<div class="parent-icon"><i class="lni lni-dashboard text-success"></i></div>
			<div class="menu-title">Dashboard</div>
		</a>
	</li> -->
	<li>
		<a href="{{ route('ledgers.index') }}">
			<div class="parent-icon"><i class="bx bx-transfer text-success"></i></div>
			<div class="menu-title">Daily Report</div>
		</a>
	</li>
	<li>
		<a href="{{ route('users.index') }}">
			<div class="parent-icon"><i class="bx bx-user-plus text-success"></i></div>
			<div class="menu-title">ငွေကိုင်အကောင့်</div>
		</a>
	</li>
	<li>
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
	</li>
	<li>
		<a href="#">
			<div class="parent-icon"><i class="bx bx-repost text-success"></i></div>
			<div class="menu-title">Monthly Transactions</div>
		</a>
	</li>
</ul>
<!--end navigation-->