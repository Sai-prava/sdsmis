<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{Auth::user()->name}} Field Staff Panel | SDS MIS</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/toastr.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('user_asset/global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>

	<script src="{{asset('user_asset/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/form_select2.js')}}"></script>

	<script src="{{asset('user_asset/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('user_asset/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    
	<script src="{{asset('user_asset/global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>

	<script src="{{asset('user_asset/assets/js/app.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/datatables_basic.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/form_layouts.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/dashboard.js')}}"></script>
	<!-- /theme JS files -->
	
	<!-- Theme JS files -->

	<script src="{{asset('user_asset/global_assets/js/demo_pages/job_list.js')}}"></script>
	<!-- /theme JS files -->

	@yield('styles')
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="{{url('/')}}" class="text-light">
				<h3 class="m-0"><b>Field Staff Panel</b></h3>
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

			<ul class="navbar-nav">



				<li class="nav-item dropdown dropdown-user">
					<a href="" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="" class="rounded-circle mr-2" height="34" alt="">
						<span>{{Auth::user()->name}}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{route('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								{{--  <a href="{{asset(Auth::user()->image)}}"><img src="{{asset(Auth::user()->image)}}" width="38" height="38" class="rounded-circle" alt=""></a>  --}}
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{Auth::user()->name}}</div>
								<div class="font-size-xs opacity-50">SDS
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
							<!-- Main -->
						<li class="nav-item">
							<a href="{{route('field_staff.dashboard.index')}}" class="nav-link {{Request::is('field_staff/dashboard')?'active':''}}">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li>	
						<li class="nav-item nav-item-submenu {{Request::is('field_staff/farming_profile*') || Request::is('field_staff/monthly_farming_report*') ?'nav-item-open':''}}">
							<a href="#" class="nav-link"><i class="icon-home4"></i> <span>Fishery Project</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="{{Request::is('field_staff/farming_profile*')  || Request::is('field_staff/monthly_farming_report*') ?'display:block':''}}">
								<li class="nav-item"><a href="{{route('field_staff.farming_profile.index')}}" class="nav-link {{Request::is('field_staff/farming_profile') || Request::is('field_staff/farming_profile/*') ?'active':''}}">Farming Profile</a></li>
								<li class="nav-item"><a href="{{route('field_staff.monthly_farming_report.index')}}" class="nav-link {{Request::is('field_staff/monthly_farming_report') || Request::is('field_staff/monthly_farming_report/*') ?'active':''}}">Monthly Farming Report</a></li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu {{Request::is('field_staff/user*')?'nav-item-open':''}}">
							<a href="#" class="nav-link"><i class="icon-cart-remove"></i> <span>CRP Users</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="{{Request::is('field_staff/user*') ?'display:block':''}}">
							<li class="nav-item"><a href="{{route('field_staff.user.index')}}" class="nav-link {{Request::is('field_staff/user')?'active':''}}">All CRP(s)</a></li>
							</ul>
						</li>
						<li class="nav-item">
						<a href="{{route('field_staff.training_report.index')}}" class="nav-link {{Request::is('field_staff/training_report') || Request::is('field_staff/training_report/*') ?'active':''}}">
						<i class="icon-home4"></i>
						<span>Training Report</span>
						</a>
						</li>

						<li class="nav-item">
							<a href="{{route('field_staff.respondent_master.index')}}" class="nav-link {{Request::is('field_staff/respondent_master') || Request::is('field_staff/respondent_master/*')?'active':''}}">
								<i class="icon-home4"></i>
								<span>Repondent Master</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu {{Request::is('field_staff/report*') ?'nav-item-open':''}}">
							<a href="#" class="nav-link"><i class="icon-home4"></i> <span>Reports</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="{{Request::is('field_staff/report*')   ?'display:block':''}}">
								<li class="nav-item"><a href="{{route('field_staff.report.monthly-progress')}}" class="nav-link {{Request::is('field_staff/report/monthly-progress') ?'active':''}}">Monthly Progress</a></li>
								<li class="nav-item"><a href="{{route('field_staff.report.monthly-training')}}" class="nav-link {{Request::is('field_staff/report/monthly-training') ?'active':''}}">Monthly Training</a></li>
								<li class="nav-item"><a href="{{route('field_staff.report.basic-farmer-profile')}}" class="nav-link {{Request::is('field_staff/report/basic-farmer-profile') ?'active':''}}">Basic Farmer Profile</a></li>
							</ul>
						</li>
						{{-- <li class="nav-item">
							<a href="{{route('field_staff.training_report.index')}}" class="nav-link {{Request::is('project/project')?'active':''}}">
								<i class="icon-home4"></i>
								<span>Training Report</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('project.user.index')}}" class="nav-link {{Request::is('project/user')?'active':''}}">
								<i class="icon-user"></i>
								<span>User</span>
							</a>
						</li> --}}
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><a href="{{route('field_staff.dashboard.index')}}"><i class="icon-arrow-left52 mr-2"></i></a><span class="font-weight-semibold">@yield('title')</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center">

							<a href="#" class="btn btn-float mt-3">
								<h4><span id="ct" class="font-weight-semibold"></span></h4>
							</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				@yield('content')

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text ml-lg-auto">
						
					</span>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


	<script src="{{asset('user_asset/assets/js/toastr.js')}}"></script>
	@toastr_render
	@yield('scripts')
</body>
</html>
