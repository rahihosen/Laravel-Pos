<?php

use \App\Http\Controllers\UserSettingsController;
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Muktodhara Technology Limited">
	<meta name="description" content="Product Management Software">
	<meta name="keywords" content="Product Management Software by Muktodhara Technology Limited">

	<link rel="icon" href="<?= asset('/icon.png'); ?>">

	<?php $company = DB::table('settings')->first(); ?>
	<title><?= $company->company_name; ?></title>

	<!-- Font Awesome Update -->
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link href="{{asset('/public/admin_asset/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

	<!-- Google Font -->
	<!-- Fonts CDN LINK -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">

	{{-- jquery-confirm! css link --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<!-- JQuery UI-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	{{-- JQuery Confirm JS link --}}
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script> --}}

	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Custom Theme Style -->
	<link href="{{asset('/public/admin_asset/build/css/custom.min.css')}}" rel="stylesheet">
	<link href="{{asset('/public/css/my_custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('/public/css/jquery-confirm.min.css')}}">


	<link rel="stylesheet" href="{{ asset('/public/css/bootstrap-select.min.css') }}">

</head>

<body class="nav-md">

	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view" style="background-image: url('<?= asset('/right_col.png'); ?>');">

					<div class="navbar nav_title" style="border: 0;">
						<a href="{{URL::to('/home')}}" class="site_title">

							<span><?= $company->company_name; ?></span>

						</a>
					</div>

					<div class="clearfix"></div>

					<div class="profile clearfix">
						<div class="profile_pic">

							<?php
							$admin_data = Auth::user();
							$admin_id = $admin_data->id;
							$admin_image_query = DB::table('admin')->where('id', $admin_id)->first();

							?>

							<img src="<?= asset($admin_image_query->admin_image); ?>" alt="{{ $admin_data->name }}" class="img-circle profile_img">

						</div>

						<div class="profile_info">
							<span>Welcome,</span>
							<h2>{{ $admin_data->name }}</h2>
						</div>

						<div class="clearfix"></div>

						<br />
					</div>



					<!-- sidebar menu -->

					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">

								<li><a href="{{URL::to('/home')}}"><i class="fa fa-home"></i> DASHBOARD </a></li>

								@if(UserSettingsController::featuresCheck(4))

								<li><a><i class="fa fa-shopping-cart"></i> ORDERS<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">

										<li><a href="{{URL::to('/create-sales')}}">New Order</a></li>
										<li><a href="{{URL::to('/order-list')}}">Order List</a></li>
										<li><a href="{{URL::to('/cancel-order-list')}}">Cancel Order List</a></li>

									</ul>
								</li>

								@endif
								
								
									@if(UserSettingsController::featuresCheck(10))

								<li><a href="{{URL::to('/company-statement')}}"><i class="fa fa-shopping-cart"></i>Company Statement</a>
									
								</li>

								@endif
								
								
								
								
								
								
								

									@if(UserSettingsController::featuresCheck(9))

								<li><a href="{{URL::to('/totalsales-salesman')}}"><i class="fa fa-shopping-cart"></i> Sales Report</a></li>

								@endif

								

								@if(UserSettingsController::featuresCheck(5))

								<!--<li><a><i class="fa fa-cubes"></i> Medicine<span class="fa fa-chevron-down"></span></a>-->

								<!--	<ul class="nav child_menu">-->

										<!--<li><a href="{{URL::to('/category-list')}}">Generic</a></li>-->
										<!--<li><a href="{{URL::to('/type-list')}}">Medicine Type</a></li>-->
										<!--<li><a href="{{URL::to('/add-product')}}">Add Medicine</a></li>-->
										<!--<li><a href="{{URL::to('/product-list')}}">Medicine List</a></li>-->
										<!--<li><a href="{{URL::to('/stock')}}"> Stock</a></li>-->
										<!--<li><a href="{{URL::to('/out-of-stock')}}"> Out of Stock</a></li>-->
										<!--<li><a href="{{URL::to('/wastage')}}"> Wastage </a></li>-->

								<!--	</ul>-->

								<!--</li>-->

								@endif

								@if(UserSettingsController::featuresCheck(6))


								<li><a  href="{{URL::to('/customer-list')}}"><i class="fa fa-users"></i> CUSTOMERS</a>
									<!--<ul class="nav child_menu">-->

									<!--	<li><a>Customer </a></li>-->
									<!--	<li><a href="{{URL::to('/customer-group-list')}}">Group</a></li>-->

									<!--</ul>-->
								</li>
								<li><a href="{{URL::to('/purchase-add')}}"><i class="fas fa-calculator"></i> PURCHASE OR ADD</a></li>
							    <li><a href="{{URL::to('/expired-product')}}"><i class="fas fa-calculator"></i> Expired Product</a></li>

									@endif

									@if(UserSettingsController::featuresCheck(7))


								<li><a><i class="fas fa-calculator"></i> ACCOUNTS<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">

										<li><a href="{{URL::to('/accounts-list')}}">Account Opening Balance </a></li>
										<!--<li><a href="{{URL::to('/balance-list')}}">Deposit </a></li>-->
										{{-- <li><a href="{{URL::to('/withdraw')}}">Withdraw </a>
								</li> --}}
								<li><a href="{{URL::to('/loan-list')}}">Loan </a></li>
								{{-- <li><a href="{{URL::to('/transaction-list')}}">Transaction History</a></li> --}}

								<li><a href="{{URL::to('/balance-transfer')}}">Balance Transfer </a></li>

								<li><a href="{{URL::to('/expenses-list')}}">Expenses </a></li>
								<!--<li><a href="{{URL::to('/expenses-settings-list')}}">Expenses Settings </a></li>-->

								<li><a href="{{URL::to('/income-statement')}}">Income Statement </a></li>
								<li><a href="{{URL::to('/account-head-report')}}">Account Head report</a></li>

								<li><a href="{{URL::to('/balance-sheet')}}">Balance Sheet </a></li>

							</ul>
							</li>

							@endif

							@if(UserSettingsController::featuresCheck(8))

							<!--<li><a><i class="fas fa-shopping-basket"></i> PURCHASE <span class="fa fa-chevron-down"></span></a>-->

							<!--	<ul class="nav child_menu">-->

							<!--		<li><a href="{{URL::to('/buyer-list')}}">Supplier</a></li>-->
							<!--		<li><a href="{{URL::to('/new-purchase')}}">New Purchase</a></li>-->
							<!--		<li><a href="{{URL::to('/purchase-list')}}">Purchase List</a></li>-->
									<!--<li><a href="{{URL::to('/cancel-purchase-list')}}">Cancel Purchase List</a></li>-->
							<!--		<li><a href="{{URL::to('/due-purchase-list')}}">Due Purchase List</a></li>-->

							<!--	</ul>-->

							<!--</li>-->

							@endif

							@if(UserSettingsController::featuresCheck(3))

							<li><a><i class="fa fa-pie-chart"></i> REPORTS<span class="fa fa-chevron-down"></span></a>
								<ul class="nav child_menu">

									<li><a href="{{URL::to('/sales-report')}}">Sales Reports</a></li>
									<li><a href="{{URL::to('/order-report')}}">Order Reports</a></li>
									<!--<li><a href="{{URL::to('/due-report')}}">Due Reports</a></li>-->
									<li><a href="{{URL::to('/purchase-list')}}">Purchase List</a></li>
									<li><a href="{{URL::to('/due-purchase-list')}}">Due Purchase List</a></li>

								</ul>
							</li>

							@endif

							</ul>
						</div>
						<div class="menu_section">
							<h3>User Panel</h3>
							<ul class="nav side-menu">


								@if(UserSettingsController::featuresCheck(1))

								<li><a><i class="fa fa-user-plus"></i> USERS<span class="fa fa-chevron-down"></span></a>

									<ul class="nav child_menu">
										<li><a href="{{URL::to('/admin-list')}}">Admin</a></li>
									</ul>
								</li>

								@endif

								@if(UserSettingsController::featuresCheck(2))

								<li><a><i class="fa fa-cogs"></i> SETTINGS<span class="fa fa-chevron-down"></span></a>

									<ul class="nav child_menu">
										<li><a href="{{URL::to('/edit-settings')}}">Company Info</a></li>
										<li><a href="{{URL::to('/edit-role')}}">Role Settings</a></li>
									    <li><a href="{{URL::to('/type-list')}}">Primary Category</a></li>
										<!--<li><a href="{{URL::to('/table')}}">Table Settings</a></li>-->
										<li><a href="{{URL::to('/vat-list')}}">Vat Settings</a></li>
										<li><a href="{{URL::to('/category-list')}}">Category</a></li>
										<li><a href="{{URL::to('/product-list')}}">Product List</a></li>
										<li><a href="{{URL::to('/stock')}}"> Stock</a></li>
										<li><a href="{{URL::to('/out-of-stock')}}"> Out of Stock</a></li>
										<li><a href="{{URL::to('/wastage')}}"> Wastage </a></li>
									</ul>
								</li>
									<li><a href="{{URL::to('/about-app')}}"><i class="fa fa-cogs"></i> About Software</a></li>

								@endif

							</ul>
						</div>

					</div>

					<div class="sidebar-footer hidden-small">

						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						<a data-toggle="tooltip" data-placement="top" title="User Settings" href="{{URL::to('/user-settings')}}">

							<span class="fas fa-cog fa-spin" aria-hidden="true"></span>

						</a>
					</div>
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav hidden-print">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">

							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

									<img src="<?= asset($admin_image_query->admin_image); ?>" alt="{{ $admin_data->name }}"> {{ $admin_data->name }}

									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
											Log Out
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
									<li><a href="{{URL::to('/user-settings')}}"><i class="	fas fa-cog fa-spin"></i> User Settings</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->


			@yield('admin_main_content')


			<footer class="footer_shadow hidden-print">

				<div class="pull-right">
					Developed by: <a href="https://muktodharaltd.com"><b>Muktodhara Technology Ltd.</b></a>
				</div>

				<div class="clearfix"></div>

			</footer>

		</div>
	</div>


	<!-- Custom Theme Scripts -->
	<script src="{{asset('/public/admin_asset/build/js/custom.min.js')}}"></script>

	<script src="{{ asset('/public/js/jquery-confirm.min.js') }}"></script>
	<!-- Chart.js -->
	<script src="{{asset('/public/admin_asset/vendors/Chart.js/dist/Chart.min.js')}}"></script>
	<script src="{{asset('/public/admin_asset/vendors/echarts/dist/echarts.min.js')}}"></script>
	<script src="{{asset('/public/admin_asset/vendors/echarts/map/js/world.js')}}"></script>

	<script src="{{ asset('/public/js/bootstrap-selectpicker.js') }}"></script>

	@stack('script')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>

	<script>
		angular.module("app", []).controller("ctrl", function($scope) {

			// console.log("scope", $scope);

			$scope.printDiv = function(divName) {

				var prtContent = document.getElementById(divName).innerHTML;

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding:10px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;"><img src="<?= asset($company->company_logo); ?>" alt="<?= $company->company_name; ?>" height="40px" width="auto" style="margin:10px auto;display:block;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln('<h4>Out of Stock:</h4>');

				WinPrint.document.writeln(prtContent);

				WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');


				//	WinPrint.focus();
				//	WinPrint.print();
				//	WinPrint.close();



			};
		});
	</script>


	<?php $data = Cart::content(); ?>

	<!-- Cart Functions All -->
	<script>
		$(document).ready(function() {

			$(document).on('click', '.add_cart', function() {

				var product_id = $(this).data("productid");

				var vat_input = $(".vat_input").val();

				var purchase_prc = $(".pur_pro_id_" + product_id).val();

				// console.log(purchase_prc);

				$('.cart_list_table').html("<tr><td colspan='6'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1><td></tr>");

				$.ajax({

					url: "{{URL('/addTo')}}",
					method: "get",
					data: {
						product_id: product_id,
						purchase_prc: purchase_prc
					},

					success: function(data) {

						if (data == "1") {

							$('.cart_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							var af_splt = data.split("__sep__");

							$('.cart_list_table').html(af_splt[0]);

							$('.get_total_for_dis').html("Total TK. " + af_splt[1]);

							$('.get_total_for_dis').attr('data-total-dis', af_splt[1]);

							var after_vat = af_splt[1] * (vat_input / 100);
							var tot = af_splt[1] * 1;

							after_vat = Math.round((after_vat + tot) * 100) / 100;

							$(".discount_input").val("0");
							$(".ammount_received").val("");
							$(".ammount_return").val("");
							$(".ammount_due").val("");

							$(".after_discount_input").val(af_splt[1]);
							$(".after_vat_input").val(after_vat);

						}
					}
				});
			});


			// Page reload functions & Default values for discount.

			var vat_input = $(".vat_input").val();

			$(".after_discount_input").val("0");

			var dis_type = $('.order_discount_type').val() * 1;


			if (dis_type == 1) {

				if ($(".discount_input").val() >= 0) {

					var dis = $(".discount_input").val() * 1;

					var total = $(".get_total_for_dis").attr('data-total-dis') * 1;

					var am_pay = total - dis;

					// console.log(am_pay);

					var after_vat = am_pay * (vat_input / 100);

					var tot = am_pay * 1;

					after_vat = after_vat + tot;

					$(".after_discount_input").val(am_pay);
					$(".after_vat_input").val(after_vat);

				}

			}

			if (dis_type == 2) {

				if ($(".discount_input").val() >= 0 && $(".discount_input").val() <= 99.99) {

					var dis = $(".discount_input").val() * 1;

					var total = $(".get_total_for_dis").attr('data-total-dis') * 1;

					var am_pay = total - ((total * dis) / 100);

					var after_vat = am_pay * (vat_input / 100);

					var tot = am_pay * 1;

					after_vat = after_vat + tot;

					$(".after_discount_input").val(am_pay);
					$(".after_vat_input").val(after_vat);

				}
			}



			$(".discount_input").on('change keyup', function() {

				$(".ammount_received").val("");
				$(".ammount_return").val("");
				$(".ammount_due").val("");

				var vat_input = $(".vat_input").val();

				var dis_type = $('.order_discount_type').val();

				var total = $(".get_total_for_dis").attr('data-total-dis') * 1;

				if ($(this).val() != '') {

					if (dis_type == 1) {

						if ($(".discount_input").val() * 1 >= 0 && $(".discount_input").val() * 1 <= total) {

							var dis = $(".discount_input").val() * 1;

							var am_pay = Math.round((total - dis) * 100) / 100;

							var after_vat = am_pay * (vat_input / 100);

							var tot = am_pay * 1;

							after_vat = Math.round((after_vat + tot) * 100) / 100;

							$(".after_discount_input").val(am_pay);
							$(".after_vat_input").val(after_vat);

						} else {

							$(".after_discount_input").val("");
							$(".after_vat_input").val("");

						}
					}

					if (dis_type == 2) {

						if ($(".discount_input").val() * 1 >= 0 && $(".discount_input").val() * 1 <= 99.99) {

							var dis = $(".discount_input").val() * 1;

							var am_pay = Math.round((total - ((total * dis) / 100)) * 100) / 100;

							var after_vat = am_pay * (vat_input / 100);

							var tot = am_pay * 1;

							after_vat = Math.round((after_vat + tot) * 100) / 100;

							$(".after_discount_input").val(am_pay);
							$(".after_vat_input").val(after_vat);

						} else {

							$(".after_discount_input").val("");
							$(".after_vat_input").val("");

						}


					}
				}

				if ($(this).val() == '') {

					if (dis_type == 1) {

						var dis = 0;

						var am_pay = Math.round((total - dis) * 100) / 100;

						var after_vat = am_pay * (vat_input / 100);

						var tot = am_pay * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$(".after_discount_input").val(am_pay);
						$(".after_vat_input").val(after_vat);

					}

					if (dis_type == 2) {

						var dis = 0;

						var am_pay = Math.round((total - ((total * dis) / 100)) * 100) / 100;

						var after_vat = am_pay * (vat_input / 100);

						var tot = am_pay * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$(".after_discount_input").val(am_pay);
						$(".after_vat_input").val(after_vat);




					}

				}

			});


			$(".order_discount_type").on('change keyup', function() {

				$(".ammount_received").val("");
				$(".ammount_return").val("");
				$(".ammount_due").val("");

				var vat_input = $(".vat_input").val();

				var dis_type = $('.order_discount_type').val();

				var total = $(".get_total_for_dis").attr('data-total-dis') * 1;


				if ($(".discount_input").val() != '') {

					if (dis_type == 1) {

						if ($(".discount_input").val() * 1 >= 0 && $(".discount_input").val() * 1 <= total) {

							var dis = $(".discount_input").val() * 1;

							var am_pay = Math.round((total - dis) * 100) / 100;

							var after_vat = am_pay * (vat_input / 100);

							var tot = am_pay * 1;

							after_vat = Math.round((after_vat + tot) * 100) / 100;

							$(".after_discount_input").val(am_pay);
							$(".after_vat_input").val(after_vat);

						} else {

							$(".after_discount_input").val("");
							$(".after_vat_input").val("");

						}
					}

					if (dis_type == 2) {

						if ($(".discount_input").val() * 1 >= 0 && $(".discount_input").val() * 1 <= 99.99) {

							var dis = $(".discount_input").val() * 1;

							var am_pay = Math.round((total - ((total * dis) / 100)) * 100) / 100;

							var after_vat = am_pay * (vat_input / 100);

							var tot = am_pay * 1;

							after_vat = Math.round((after_vat + tot) * 100) / 100;

							$(".after_discount_input").val(am_pay);
							$(".after_vat_input").val(after_vat);

						} else {

							$(".after_discount_input").val("");
							$(".after_vat_input").val("");

						}


					}
				}

			});



			$(".vat_input").on('change keyup', function() {

				var vat_input = $(".vat_input").val();

				if (vat_input != "") {

					if ($(".after_discount_input").val() >= 0) {

						var total = Math.round(($(".after_discount_input").val() * 1) * 100) / 100;

						var after_vat = Math.round((total * (vat_input / 100)) * 100) / 100;

						var tot = total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$(".after_vat_input").val(after_vat);

						$(".ammount_received").val('');
						$(".ammount_return").val('');
						$(".ammount_due").val('');

					}

				}
			});


			// $(".after_discount_input").val("0");


			$(".ammount_received").on('change keyup', function() {

				if (!$(this).val()) {

					$(".ammount_return").val("");
					$(".ammount_due").val("");

				} else {

					// var payabl = parseInt($(".after_discount_input").val());

					var payabl_vat = $(".after_vat_input").val() * 1;
					var recv = $(this).val() * 1;

					if (recv > 0) {

						if (recv > payabl_vat) {

							var rec = $(this).val() * 1;
							var total = $(".after_vat_input").val() * 1;

							var ret = Math.round((rec - total) * 100) / 100;

							$(".ammount_return").val(ret);
							$(".ammount_due").val("0");

						} else {

							var rec = $(this).val() * 1;
							var total = $(".after_vat_input").val() * 1;

							var ret = Math.round((total - rec) * 100) / 100;

							$(".ammount_return").val("0");
							$(".ammount_due").val(ret);

						}

					} else {

						$(".ammount_due").val(payabl_vat);
						$(".ammount_return").val("0");

					}
				}
			});



			// Check Customer list All Functions Show / Hide

			$(".check_cust").on('click', function() {

				if ($(this).val() == '1') {

					$(".collapse_hide").slideUp();
					$(".collapse_hide_exist").slideUp();

				}

				if ($(this).val() == '2') {

					$(".collapse_hide").slideDown();
					$(".collapse_hide_exist").slideUp();

				}

				if ($(this).val() == '3') {

					$(".collapse_hide").slideUp();
					$(".collapse_hide_exist").slideDown();

				}

			});

		});


		function myFunction(aaa) {

			var product_id = aaa;
			var vat_input = $(".vat_input").val();

			// console.log(product_id);

			$('.cart_list_table').html("<tr><td colspan='6'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1><td></tr>");

			$.ajax({

				url: "{{URL('/addTo')}}",
				method: "get",
				data: {
					product_id: product_id
				},
				success: function(data) {

					if (data == "1") {

						$('.cart_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

					} else {

						var af_splt = data.split("__sep__");

						$('.cart_list_table').html(af_splt[0]);

						$('.get_total_for_dis').html("Total TK. " + af_splt[1]);

						$('.get_total_for_dis').attr('data-total-dis', af_splt[1]);

						var after_vat = af_splt[1] * (vat_input / 100);
						var tot = af_splt[1] * 1;

						after_vat = after_vat + tot;

						$(".discount_input").val("0");
						$(".ammount_received").val("");
						$(".ammount_return").val("");
						$(".ammount_due").val("");

						$(".after_discount_input").val(af_splt[1]);

						$(".after_vat_input").val(after_vat);
					}
				}
			});
		}

		function removeFunction(del_id) {

			var product_id = del_id;

			var vat_input = $(".vat_input").val();

			$('.rem_row_' + product_id).css("opacity", "0.6");

			$.ajax({

				url: "{{URL('cart/remove/')}}",
				method: "get",
				data: {
					rem_id: product_id
				},
				success: function(data) {

					if (data == "1") {

						$('.cart_list_table').html("<tr><td colspan='6'><h2>Cart is Empty!</h2></td></tr>");

						$('.get_total_for_dis').html("Total TK. 0");

						$('.get_total_for_dis').attr('data-total-dis', '0');

						$(".discount_input").val("0");
						$(".ammount_received").val("");
						$(".ammount_return").val("");
						$(".ammount_due").val("");

						$(".after_discount_input").val('0');
						$(".after_vat_input").val('0');

					} else {

						$('.rem_row_' + product_id).fadeOut("slow");

						var af_splt = data;

						$('.get_total_for_dis').html("Total TK. " + af_splt);

						$('.get_total_for_dis').attr('data-total-dis', af_splt);

						var after_vat = af_splt * (vat_input / 100);
						var tot = af_splt * 1;

						after_vat = after_vat + tot;

						$(".discount_input").val("0");
						$(".ammount_received").val("");
						$(".ammount_return").val("");
						$(".ammount_due").val("");

						$(".after_discount_input").val(af_splt);

						$(".after_vat_input").val(after_vat);

					}
				}
			});

		}


		$(document).on('change keyup', '.sell_input', function() {

			var x = $(this).attr('data-rID');

			var prrr = $(this).val();

			// var prrr = $('.sell_input').val();

			var po = $('.product_id_' + x).val() * 1;

			if (prrr > 0) {

				changeFunction(po, x, prrr);

				var shwTotal = Math.round((prrr * po) * 100) / 100;

				$(".shwTotal_" + x).html(shwTotal);

			}

		});

		$(document).on('change keyup', '.q_input', function() {

			var x = $(this).attr('data-rID');

			var prrr = $('.sell_p_' + x).val();
			// var prrr = $('.sell_input').val();

			var po = $(this).val() * 1;

			if (po > 0) {

				changeFunction(po, x, prrr);

				var shwTotal = Math.round((prrr * po) * 100) / 100;

				$(".shwTotal_" + x).html(shwTotal);

			}

		});

		function plusFunction(iiddd, prrr) {

			var x = iiddd;
			var po = $("." + x).val() * 1;

			if (po > 0) {

				var af_sp_id = x.split("product_id_");

				po = po + 1;
				$("." + x).val(po);

				var prrr = $('.sell_p_' + af_sp_id[1]).val();

				changeFunction(po, af_sp_id[1], prrr);

				var shwTotal = Math.round((prrr * po) * 100) / 100;

				$(".shwTotal_" + af_sp_id[1]).html(shwTotal);
			}
		}

		function minusFunction(iidd, prr) {

			var y = iidd;
			var lo = $("." + y).val() * 1;
			var af_sp_idd = y.split("product_id_");


			if (lo > 1) {

				lo = lo - 1;
				$("." + y).val(lo);

				var prr = $('.sell_p_' + af_sp_idd[1]).val();

				console.log(prr);

				changeFunction(lo, af_sp_idd[1], prr);

				var shwTotal = Math.round((prr * lo) * 100) / 100;

				$(".shwTotal_" + af_sp_idd[1]).html(shwTotal)
			}
		}

		function changeFunction(qqq, rrr, sell_p) {

			var qty = qqq;
			var rowid = rrr;

			var vat_input = $(".vat_input").val();

			// console.log(qty);
			// console.log(rowid);

			$.ajax({

				url: "{{URL('/cart/update')}}",
				data: 'qty=' + qty + '&rowid=' + rowid + '&sell_p=' + sell_p,
				type: 'get',

				success: function(dataaaa) {

					$('.get_total_for_dis').html("Total TK. " + dataaaa);

					$('.get_total_for_dis').attr('data-total-dis', dataaaa);

					$(".discount_input").val("0");
					$(".ammount_received").val("");
					$(".ammount_return").val("");
					$(".ammount_due").val("");

					$(".after_discount_input").val(dataaaa);

					var after_vat = dataaaa * (vat_input / 100);
					var tot = dataaaa * 1;
					after_vat = Math.round((after_vat + tot) * 100) / 100;

					$(".after_vat_input").val(after_vat);
				}
			});
		}
	</script>



	<!-- All Modal, cancel_order, panel_bootstrap, user Panel Show hide, alert hide Function -->
	<script>
		// All Modal
		$(document).ready(function() {

			// prescription
			$(document).on('click', '.new_prescription', function() {

				var customer_id = $(this).val();

				$('.customer_id').val(customer_id);

				$('.prescription_image').val('');

				$('.add_prescription_modal').modal();

			});

			// all_prescription
			$(document).on('click', '.all_prescription', function() {

				var customer_id = $(this).val();

				$.ajax({

					url: "{{URL('/all-prescription')}}",

					method: "GET",

					data: {
						customer_id: customer_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_pres').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_pres').html(data);

						}
					}

				});

				$('.view_prescription_modal').modal();

			});



			// Table Modal
			$('.table').on('click', '.edit_table', function() {

				var table_id = $(this).val();

				var table_name = $(this).attr('data-tableName');

				$('.table_id').val(table_id);

				$('.table_name').val(table_name);

				$('.edit_table_modal').modal();

			});


			// Payment Modal
			$('.table').on('click', '.add_payment', function() {

				var order_id = $(this).val();

				var amount = $(this).attr('data-amountDue');

				$('.order_id').val(order_id);

				$('.amount').val(amount);

				$('.due_payment').attr('max', amount);

				$('.add_payment_modal').modal();

			});


			// Payment view
			$('.table').on('click', '.view_payment', function() {

				var order_id = $(this).val();

				$(".return_due").html();

				$('.return_due').html("<td colspan='4'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/view-payment')}}",

					method: "GET",

					data: {
						order_id: order_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_due').html("<td colspan='4'><br><h5 class='text-center'> Nothing Found.</h5><br></td>");

						} else {

							$('.return_due').html(data);

						}
					}

				});

				$('.view_payment_modal').modal();

			});


			// view_payment_due_rep			
			$('.table').on('click', '.view_payment_due_rep', function() {

				var order_id = $(this).val();

				$(".return_due").html();

				$('.return_due').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-payment-due-rep')}}",

					method: "GET",

					data: {
						order_id: order_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_due').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_due').html(data);

						}
					}

				});

				$('.view_payment_modal').modal();

			});
			// view_payment_ord_rep

			$('.table').on('click', '.view_payment_ord_rep', function() {

				var order_id = $(this).val();

				$(".return_due").html();

				$('.return_due').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-payment-ord-rep')}}",

					method: "GET",

					data: {
						order_id: order_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_due').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_due').html(data);

						}
					}

				});

				$('.view_payment_modal').modal();

			});


			// Payment view in customer list 

			$('.table').on('click', '.view_payment_customer', function() {

				var order_id = $(this).val();

				$(".return_due").html();

				$('.return_due').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-payment-customer')}}",

					method: "GET",

					data: {
						order_id: order_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_due').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_due').html(data);

						}
					}

				});

				$('.view_payment_modal').modal();

			});


			// Add Stock Modal
			$('.table').on('click', '.add_stock', function() {

				var product_id = $(this).val();

				var product_name = $(this).attr('data-productName');

				$('.product_id').val(product_id);

				$('.product_name').val(product_name);

				$('.add_stock_modal').modal();

			});


			// View Stock Modal
			$('.table').on('click', '.view_stock', function() {

				var product_id = $(this).val();

				var product_name = $(this).attr('data-productName');

				$('.product_name').html(product_name);

				$(".return_product").html();

				$('.return_product').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-stock')}}",

					method: "GET",

					data: {
						product_id: product_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_product').html(data);
						}

					}

				});

				$('.view_stock_modal').modal();

			});


			// Add Wastage Modal
			$('.table').on('click', '.add_wastage', function() {

				var product_id = $(this).val();

				var product_name = $(this).attr('data-productName');

				$('.product_id').val(product_id);

				$('.product_name').val(product_name);

				$.ajax({

					url: "{{URL('/get-purchase-price-list')}}",

					method: "GET",

					data: {
						product_id: product_id
					},

					success: function(data) {

						$('.wastage_pur_prc').html(data);

					}

				});

				$('.add_wastage_modal').modal();

			});


			// View Wastage Modal
			$('.table').on('click', '.view_wastage', function() {

				var product_id = $(this).val();

				var product_name = $(this).attr('data-productName');

				$('.product_name').html(product_name);

				$(".return_product").html();

				$('.return_product').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-wastage')}}",

					method: "GET",

					data: {
						product_id: product_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_product').html(data);
						}

					}

				});

				$('.view_wastage_modal').modal();
			});


			// Edit Category Modal
			$('.table').on('click', '.edit_category', function() {

				var category_id = $(this).val();

				var catName = $(this).attr('data-catName');

				var catOrder = $(this).attr('data-catOrder');

				var specialMenu = $(this).attr('data-specialMenu');

				var status = $(this).attr('data-status');

				$('.category_id').val(category_id);

				$('.category_name').val(catName);

				$('.category_order').val(catOrder);

				if (specialMenu == 0) {

					$('.edit_cat_special_type_active').removeClass('active');
					$('.edit_cat_special_type_active').children('input').prop('checked', false);
					$('.edit_cat_special_type_inactive').addClass('active');
					$('.edit_cat_special_type_inactive').children('input').prop('checked', true);

				}
				if (specialMenu == 1) {

					$('.edit_cat_special_type_active').addClass('active');
					$('.edit_cat_special_type_active').children('input').prop('checked', true);

					$('.edit_cat_special_type_inactive').removeClass('active');
					$('.edit_cat_special_type_inactive').children('input').prop('checked', false);

				}


				if (status == 0) {

					$('.edit_cat_type_active').removeClass('active');
					$('.edit_cat_type_active').children('input').prop('checked', false);

					$('.edit_cat_type_inactive').addClass('active');
					$('.edit_cat_type_inactive').children('input').prop('checked', true);

				}

				if (status == 1) {

					$('.edit_cat_type_active').addClass('active');
					$('.edit_cat_type_active').children('input').prop('checked', true);

					$('.edit_cat_type_inactive').removeClass('active');
					$('.edit_cat_type_inactive').children('input').prop('checked', false);

				}

				$('.edit_category_modal').modal();

			});


			// Edit Category Modal

			$('.table').on('click', '.edit_type', function() {

				var type_id = $(this).val();

				var type_name = $(this).attr('data-typeName');


				$('.type_id').val(type_id);

				$('.type_name').val(type_name);


				$('.edit_type_modal').modal();

			});


			// Add Product Modal
			$('.box_layout').on('click', '.add_product', function() {

				$('.add_product_modal').modal();

			})


			// Edit Product Modal
			$('.table').on('click', '.edit_product', function() {

				var product_id = $(this).val();

				var productName = $(this).attr('productName');

				// var productPurchasePrice = $(this).attr('productPurchasePrice');

				var productSellPrice = $(this).attr('productSellPrice');



				if ($(this).attr('parent_cat') != 0) {
					$('.sub_div_edit').show();
					var productCategory = $(this).attr('parent_cat');
					var productCategory_sub = $(this).attr('productCategory');
				} else {
					var productCategory = $(this).attr('productCategory');
					var productCategory_sub = '';
				}

				var productType = $(this).attr('productType');

				var productTypeName = $(this).attr('productTypeName');

				var productImage = $(this).attr('productImage');

				var oldImage = $(this).attr('oldImage');

				var productStatus = $(this).attr('productStatus');

				var out_of_stock_range = $(this).attr('out_of_stock_range');

				$('.product_id').val(product_id);

				$('.product_name').val(productName);

				// $('.product_purchase_price').val(productPurchasePrice);

				$('.product_sell_price').val(productSellPrice);

				$('#product-category').val(productCategory);
				$('#product-category_sub').val(productCategory_sub);

				//$('.fk_category_id').html(productCategoryName);

				$('.product_type').val(productType);

				$('.out_of_stock_range').val(out_of_stock_range);

				$('.product_type').html(productTypeName);

				$('.product_img').attr('src', productImage);

				$('.old_image').val(oldImage);

				$('.clear_image').val('');

				if (productStatus == 0) {

					$('.edit_product_type_active').removeClass('active');
					$('.edit_product_type_active').children('input').prop('checked', false);

					$('.edit_product_type_inactive').addClass('active');
					$('.edit_product_type_inactive').children('input').prop('checked', true);

				}

				if (productStatus == 1) {

					$('.edit_product_type_active').addClass('active');
					$('.edit_product_type_active').children('input').prop('checked', true);

					$('.edit_product_type_inactive').removeClass('active');
					$('.edit_product_type_inactive').children('input').prop('checked', false);

				}

				$('.edit_product_modal').modal();

			});



			// View Product Modal
			$('.table').on('click', '.view_product', function() {

				var product_id = $(this).val();

				var productImage = $(this).attr('productImage');

				// var product_name = $(this).attr('data-productName');

				// $('.product_image').html(product_image);

				$(".return_product").html();

				$('.return_product').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-product')}}",

					method: "GET",

					data: {
						product_id: product_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_product').html(data);

						}
					}
				});

				$('.product_id').val(product_id);

				$('.view_product_modal').modal();

			});


			// Edit Customer Modal
			$('.table').on('click', '.edit_customer', function() {

				var customer_id = $(this).val();

				var customerName = $(this).attr('customerName');

				var customerMobile = $(this).attr('customerMobile');

				var customerEmail = $(this).attr('customerEmail');

				var customerNid = $(this).attr('customerNid');

				var customerGroupId = $(this).attr('customerGroupId');

				var customerGroupName = $(this).attr('customerGroupName');

				var credit_limit = $(this).attr('credit_limit');

				$('.customer_id').val(customer_id);

				$('.customer_name').val(customerName);

				$('.customer_mobile').val(customerMobile);

				$('.customer_email').val(customerEmail);

				$('.customer_nid').val(customerNid);

				$('.customer_group_id').val(customerGroupId);

				$('.credit_limit').val(credit_limit);

				$('.customer_group_id').html(customerGroupName);

				$('.edit_customer_modal').modal();

			});




			// View Customer due orders Modal

			$('.table').on('click', '.view_customer_dues', function() {

				var customer_id = $(this).val();

				var customerName = $(this).attr('customerName');

				var customerMobile = $(this).attr('customerMobile');

				var customerNid = $(this).attr('customerNid');

				var customerGroupName = $(this).attr('customerGroupName');

				$('.cus_detail').html("Name: " + customerName + " &nbsp;&nbsp;&nbsp;Mobile: " + customerMobile + "&nbsp;&nbsp;&nbsp; Group: " + customerGroupName + " &nbsp;&nbsp;&nbsp; NID: " + customerNid);

				$('.customer_id').val(customer_id);

				$(".return_product").html();

				$('.return_product').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-customer-due-orders')}}",

					method: "GET",

					data: {
						customer_id: customer_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<td colspan='12'><br><h5 class='text-center'>Nothing Found. </h5><br><br></td>");

						} else {

							$('.return_product').html(data);
						}
					}
				});

				$('.view_customer_due_modal').modal();

			});

			// View Customer orders Modal
			$('.table').on('click', '.view_customer', function() {

				var customer_id = $(this).val();

				var customerName = $(this).attr('customerName');

				var customerMobile = $(this).attr('customerMobile');

				var customerNid = $(this).attr('customerNid');

				var customerGroupName = $(this).attr('customerGroupName');
				var customerPriviousDue = $(this).attr('customerPreviousDue');

				$('.cus_detail').html("Name: " + customerName + " &nbsp;&nbsp;&nbsp;Mobile: " + customerMobile + "&nbsp;&nbsp;&nbsp; Group: " + customerGroupName + " &nbsp;&nbsp;&nbsp; NID: " + customerNid);

				$('.customer_id').val(customer_id);

				$(".return_product").html();

				$('.return_product').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/view-customer')}}",

					method: "GET",

					data: {
						customer_id: customer_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<td colspan='12'><br><h4 class='text-center'> Nothing Found.</h4><br><br></td>");

						} else {

							$('.return_product').html(data);
						}
					}
				});

				$('.view_customer_modal').modal();

			});


			// Edit Customer Group Modal
			$('.table').on('click', '.edit_customer_group', function() {

				var group_id = $(this).val();

				var groupName = $(this).attr('groupName');

				$('.group_id').val(group_id);

				$('.group_name').val(groupName);

				$('.edit_customer_group_modal').modal();

			});


			// Edit vat Modal
			$('.table').on('click', '.edit_vat', function() {

				var vat_id = $(this).val();

				var vatName = $(this).attr('vatName');

				var vatAmount = $(this).attr('vatAmount');

				var vatStatus = $(this).attr('vatStatus');

				$('.vat_id').val(vat_id);

				$('.vat_name').val(vatName);

				$('.vat_amount').val(vatAmount);

				if (vatStatus == 0) {

					$('.edit_vat_active').removeClass('active');
					$('.edit_vat_active').children('input').prop('checked', false);

					$('.edit_vat_inactive').addClass('active');
					$('.edit_vat_inactive').children('input').prop('checked', true);

				}
				if (vatStatus == 1) {

					$('.edit_vat_active').addClass('active');
					$('.edit_vat_active').children('input').prop('checked', true);

					$('.edit_vat_inactive').removeClass('active');
					$('.edit_vat_inactive').children('input').prop('checked', false);

				}

				$('.edit_vat_modal').modal();

			});


			// View Total Wastage
			$(document).on('click', '.view_wastage_total', function() {

				var date = $(this).val();

				$(".return_wastage").html();

				$('.return_wastage').html("<td colspan='3'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/view-wastage-total')}}",

					method: "GET",

					data: {
						dates: date
					},

					success: function(data) {

						if (data == "") {

							$('.return_wastage').html("<td colspan='3'><br><p class='text-center'> Nothing Found.</p></td></td>");

						} else {

							$('.return_wastage').html(data);
						}

					}

				});

				$('.view_wastage_modal').modal();

			});


			// View Total Sold
			$(document).on('click', '.view_sold', function() {

				var date = $(this).val();
				$('.s_date').val(date);

				$(".return_sold").html();

				$('.return_sold').html("<td colspan='4'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/view-sold')}}",

					method: "GET",

					data: {
						dates: date
					},

					success: function(data) {
						if (data == "") {

							$('.return_sold').html("<td colspan='4'><br><p class='text-center'> Nothing Found.</p><br></td>");

						} else {

							$('.return_sold').html(data);
						}

					}

				});

				$('.view_sold_modal').modal();

			});


			// view Orders by date "Reports"
			$('.table').on('click', '.view_order_report', function() {


				var date = $(this).val();

				$(".return_results").html();

				$('.return_results').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-order-report')}}",

					method: "GET",

					data: {
						dates: date
					},

					success: function(data) {

						if (data == "") {

							$('.return_results').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_results').html(data);
						}
					}
				});

				$('.view_order_report_modal').modal();

			});


			// View Cancelled Order by date "Reports"
			$('.table').on('click', '.view_cancelled_order', function() {


				var date = $(this).val();

				$(".return_results").html();

				$('.return_results').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-cancelled-order-report')}}",

					method: "GET",

					data: {
						dates: date
					},

					success: function(data) {

						if (data == "") {

							$('.return_results').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_results').html(data);
						}
					}
				});

				$('.view_cancelled_order_report_modal').modal();

			});


			// Add Payment Report Modal
			$('.table').on('click', '.add_payment_report', function() {

				var order_id = $(this).val();

				var amount = $(this).attr('data-amountDue');

				$('.order_id').val(order_id);

				$('.amount').val(amount);

				$('.due_payment').attr('max', amount);

				$('.add_payment_order_report_modal').modal();

			});


			// Edit Admin Modal
			$('.table').on('click', '.edit_admin', function() {

				var admin_id = $(this).val();

				var adminName = $(this).attr('adminName');

				var adminEmail = $(this).attr('adminEmail');

				// var adminPassword = $(this).attr('adminPassword');	

				var adminImage = $(this).attr('adminImage');

				var adminRole = $(this).attr('adminRole');

				var oldImage = $(this).attr('oldImage');

				var adminStatus = $(this).attr('adminStatus');


				$('.admin_id').val(admin_id);

				$('.admin_name').val(adminName);

				// $('.admin_password').val(adminPassword);

				$('.admin_email').val(adminEmail);

				$('.role').val(adminRole);

				if (adminRole == 1) {
					var role = 'Admin';
				} else if (adminRole == 2) {
					var role = 'Manager';
				} else if (adminRole == 3) {
					var role = 'Salesman';
				}

				$('.role').html(role);

				$('.admin_img').attr('src', adminImage);

				$('.old_image').val(oldImage);

				$('.clear_image').val('');

				if (adminStatus == 0) {

					$('.edit_admin_type_active').removeClass('active');
					$('.edit_admin_type_active').children('input').prop('checked', false);

					$('.edit_admin_type_inactive').addClass('active');
					$('.edit_admin_type_inactive').children('input').prop('checked', true);

				}

				if (adminStatus == 1) {

					$('.edit_admin_type_active').addClass('active');
					$('.edit_admin_type_active').children('input').prop('checked', true);

					$('.edit_admin_type_inactive').removeClass('active');
					$('.edit_admin_type_inactive').children('input').prop('checked', false);

				}

				$('.edit_admin_modal').modal();

			});


			// Edit Accounts Modal
			$('.table').on('click', '.edit_account', function() {

				var account_id = $(this).val();

				var accountName = $(this).attr('accountName');

				var accountBranch = $(this).attr('accountBranch');

				var accountNo = $(this).attr('accountNo');

				var accountType = $(this).attr('accountType');

				if (accountType == 1) {


					$('.account_type').html('Cash');

				}

				if (accountType == 2) {


					$('.account_type').html('Bank');

				}

				if (accountType == 3) {


					$('.account_type').html('Mobile Banking (Personal)');

				}

				$('.account_type').val(accountType);

				$('.account_id').val(account_id);

				$('.account_name').val(accountName);

				$('.branch_name').val(accountBranch);

				$('.account_no').val(accountNo);

				$('.edit_account_modal').modal();
			});


			// Add Refund Loan 
			$('.table').on('click', '.refund', function() {

				var loan_id = $(this).val();

				var accountId = $(this).attr('accountId');

				var refundAmmount = $(this).attr('refundAmmount');

				$('.loan_id').val(loan_id);

				$('.refund').val(refundAmmount);

				$('.max_refund').attr('max', refundAmmount);

				$('.add_refund_modal').modal();
			});


			// View Refund Loan
			$('.table').on('click', '.view_refund', function() {

				var loan_id = $(this).val();

				$(".return_refund").html();

				$('.return_refund').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-refund')}}",

					method: "GET",

					data: {
						loan_id: loan_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_refund').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_refund').html(data);

						}
					}

				});

				$('.view_refund_modal').modal();

			});



			// Edit Expenses head 
			$('.table').on('click', '.expenses_head', function() {

				var expensesHeadId = $(this).val();

				var expensesHeadName = $(this).attr('expensesHeadName');

				$('.expenses_head_id').val(expensesHeadId);

				$('.expenses_head_name').val(expensesHeadName);

				$('.edit_expenses_head_modal').modal();
			})


			// Edit Expenses head 
			$('.table').on('click', '.expenses_sub', function() {

				var expensesSubHeadId = $(this).val();

				var expensesSubHeadName = $(this).attr('expensesSubHeadName');

				var expansesHeadId = $(this).attr('expansesHeadId');

				var expansesHeadName = $(this).attr('expansesHeadName');

				$('.expenses_sub_head_id').val(expensesSubHeadId);

				$('.expenses_sub_head_name').val(expensesSubHeadName);

				$('.expansesHeadId').val(expansesHeadId);

				$('.expansesHeadId').html(expansesHeadName);

				$('.edit_expenses_sub_head_modal').modal();
			})


			// Edit Bayer 
			$('.table').on('click', '.edit_buyer', function() {

				var buyer_id = $(this).val();

				var buyerName = $(this).attr('buyerName');

				var buyerMobile = $(this).attr('buyerMobile');

				var buyerEmail = $(this).attr('buyerEmail');
				var previous_due = $(this).attr('previous_due');

				var buyerAddress = $(this).attr('buyerAddress');

				$('.buyer_id').val(buyer_id);

				$('.buyer_name').val(buyerName);

				$('.buyer_mobile').val(buyerMobile);

				$('.buyer_email').val(buyerEmail);
				$('.previous_due').val(previous_due);

				$('.buyer_address').val(buyerAddress);

				$('.edit_buyer_modal').modal();

			});


		});


		// Cancel Order
		$(document).ready(function() {

			// Cancel Order To list

			$('.table').on('click', '.cancel_order', function() {

				var this_data = $(this);
				var order_id = $(this).val();

				$.confirm({

					icon: 'fa fa-smile-o',
					theme: 'modern',
					closeIcon: true,
					animation: 'scale',
					type: 'red',
					autoClose: 'cancel|10000',
					escapeKey: 'cancel',

					buttons: {

						confirm: {
							btnClass: 'btn-red',

							action: function() {

								$.ajax({

									url: "{{URL('/cancel-order')}}",

									method: "GET",

									data: {
										order_id: order_id
									},

									success: function(data) {

										if (data == "1") {

											// console.log(data);
											this_data.parent().parent().fadeOut();

										} else {

											// console.log(data);

										}
									}
								});

								this.setCloseAnimation('zoom');
							}

						},

						cancel: function() {

							$.alert('Canceled!');

							this.setCloseAnimation('zoom');
						}
					}
				});


			});



			// Return Order To list.

			$('.table').on('click', '.return_cancel_order', function() {

				var this_data = $(this);
				var order_id = $(this).val();

				$.confirm({

					icon: 'fa fa-smile-o',
					theme: 'modern',
					closeIcon: true,
					animation: 'scale',
					type: 'blue',
					autoClose: 'cancel|10000',
					escapeKey: 'cancel',

					buttons: {

						confirm: {
							btnClass: 'btn-blue',

							action: function() {

								$.ajax({

									url: "{{URL('/return-cancel-order')}}",

									method: "GET",

									data: {
										order_id: order_id
									},

									success: function(data) {

										if (data == "1") {

											// console.log(data);
											this_data.parent().parent().fadeOut();

										} else {

											// console.log(data);

										}
									}
								});

								this.setCloseAnimation('zoom');
							}

						},

						cancel: function() {

							$.alert('Canceled!');

							this.setCloseAnimation('zoom');
						}
					}
				});

			});

		});


		//Panel bootstrap
		$(document).ready(function() {

			$(document).on('click', '.panel-heading span.clickable', function(e) {

				var $this = $(this);

				if (!$this.hasClass('panel-collapsed')) {

					$this.parents('.panel').find('.panel-body').slideUp();
					$this.addClass('panel-collapsed');
					$this.find('i').removeClass('fa fa-plus').addClass('fa fa-minus');

				} else {

					$this.parents('.panel').find('.panel-body').slideDown();
					$this.removeClass('panel-collapsed');
					$this.find('i').removeClass('fa fa-minus').addClass('fa fa-plus');

				}
			});

		});


		//user panel show hide in topbar
		$(document).ready(function() {

			$('.user_hover').hover(function() {

				$(this).find('.user_out').stop(true, true).fadeIn('fast');

			}, function() {

				$(this).find('.user_out').stop(true, true).fadeOut("slow");

			});

		});

		// Close success message
		$(document).ready(function() {

			$('.alert').fadeIn('slow', function() {

				$('.alert').delay(5000).fadeOut();

			});

		});
	</script>


	<!-- Search All Function -->
	<script>
		$(document).ready(function() {

			// Search Generics

			var search_results = $('.search_results').html();

			$(document).on('change keyup', '.search_generics', function() {

				if ($(this).val() != '') {

					var search_generics = $(".search_generics").val();

					$(".search_results").html();

					$('.search_results').html("<td colspan='5'><h1 class='text-center' style='color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

					$.ajax({

						url: "{{URL('/search-generics')}}",

						method: "GET",

						data: {
							search_generics: search_generics
						},

						success: function(data) {

							$('.search_results').html(data);
							$('.hide_pagi').hide();
						}
					});

				} else {

					$('.search_results').html(search_results);
					$('.hide_pagi').show();

				}
			});
			
			
	// Search soldinsold view admin
			
			
			
				$(document).on('click', '.scarch_created_by', function() {

				var admin_id = $(".admin_id").val();
				var date =$('.s_date').val();

				
				
			

				$("#result").html();

			

				$('#result').html("<td colspan='4'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-viewsold')}}",

					method: "GET",

					data: {
						admin_id: admin_id,
						 dates: date
					
					},

					success: function(data) {

						if (data == "1") {

							$('#result').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('#result').html(data);
						
						}
					}
				});
			});
			
			
			
//end

			// Search Product list
			$(document).on('click', '.name_from_to_product_list', function() {

				var search_product = $(".search_product").val();
				var fk_category_id = $(".fk_category_id_search").val();
				var product_type = $(".type_id_search").val();


				$(".search_results").html();

				$('.search_results').html("<td colspan='8'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-product-list')}}",

					method: "GET",

					data: {
						search_product: search_product,
						fk_category_id: fk_category_id,
						product_type: product_type
					},

					success: function(data) {

						$('.search_results').html(data);
						$('.hide_pagi').hide();
					}
				});
			});


			// scarch new ProductList


			$(document).on('click', '.name_from_to_product_list1', function() {

				var search_product = $(".search_product").val();
				var fk_category_id = $(".fk_category_id_search").val();
				var product_type = $(".type_id_search").val();


				$(".search_results").html();

				$('.search_results').html("<td colspan='8'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-product-listNew')}}",

					method: "GET",

					data: {
						search_product: search_product,
						fk_category_id: fk_category_id,
						product_type: product_type
					},

					success: function(data) {

						$('.search_results').html(data);
						$('.hide_pagi').hide();
					}
				});
			});






			// Search Stock list
			$(document).on('click', '.name_from_to_stock_list', function() {

				var search_stock = $(".search_stock").val();
				var fk_category_id = $(".fk_category_id").val();

				$(".search_results").html();

				$('.search_results').html("<td colspan='7'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-stock-list')}}",

					method: "GET",

					data: {
						search_stock: search_stock,
						fk_category_id: fk_category_id
					},

					success: function(data) {

						if (data == "1") {
							$('.search_results').html("<td colspan='7'><br><h5 class='text-center'> Nothing Found.</h5><br></td>");
						} else {
							$('.search_results').html(data);
							$('.hide_pagin').hide();
						}
					}
				});
			});


			// Search Wastage list
			$(document).on('click', '.name_from_to_wastage_list', function() {

				var search_wastage = $(".search_wastage").val();
				var fk_category_id = $(".fk_category_id").val();

				$(".wastage_list_table").html();

				$('.wastage_list_table').html("<td colspan='5'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-wastage-list')}}",

					method: "GET",

					data: {
						search_wastage: search_wastage,
						fk_category_id: fk_category_id
					},

					success: function(data) {

						if (data == "1") {

							$('.wastage_list_table').html("<td colspan='5'><br><h5 class='text-center'> Nothing Found.</h5> <br></td>");

						} else {

							$('.wastage_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});


			// Search Order List
			$(document).on('click', '.date_from_to', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$(".order_list_table").html();

				$('.order_list_table').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-order-date')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<td colspan='12'><br><h5 class='text-center'> Nothing Found.</h5> <br></td>");

						} else {

							$('.order_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});
			
			
			
				// Search company statement
			$(document).on('click', '.date_from_to_company', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$(".order_list_table").html();

				$('.order_list_table').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-order-date-company')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<td colspan='12'><br><h5 class='text-center'> Nothing Found.</h5> <br></td>");

						} else {

							$('.order_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});
			
			
			
			
			
			
			
			
			
				// Search Order List
			$(document).on('click', '.date_from_to2', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();
				var admin = <?= Auth::id(); ?>

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to );

				$(".order_list_table").html();

				$('.order_list_table').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-order-date2')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to,
						admin: admin
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<td colspan='12'><br><h5 class='text-center'> Nothing Found.</h5> <br></td>");

						} else {

							$('.order_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});
			
			
			
			
			
			


			// Search Cancel Order List
			$(document).on('click', '.cancel_date_from_to', function() {

				var date_from = $(".date_from").val();

				var date_to = $(".date_to").val();

				$(".cancel_order_list_table").html();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$('.cancel_order_list_table').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-cancel-order-date')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.cancel_order_list_table').html("<td colspan='12'><br><h5 class='text-center'> Nothing Found.</h5><br></td>");

						} else {

							$('.cancel_order_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});



			// Search Sales Reports
			$(document).on('click', '.date_from_to_sales_reports', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".return_results").html();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$('.return_results').html("<td colspan='4'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-sales-report')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.return_results').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_results').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});



			// Srearch Order Reports
			$(document).on('click', '.date_from_to_order_reports', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".return_order_reports").html();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$('.return_order_reports').html("<td colspan='8'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-order-report')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.return_order_reports').html("<td colspan='8'><br><p class='text-center'> Nothing Found.</p></td>");

						} else {

							$('.return_order_reports').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});



			// Search Due Reports
			$(document).on('click', '.date_from_to_due_reports', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".return_results").html();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$('.return_results').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-due-report')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.return_results').html("<td colspan='12'><br><p class='text-center'> Nothing Found.</p><br></td>");

						} else {

							$('.return_results').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});


			// Search Order List by order Id
			$(document).on('click', '.orderId_search', function() {

				var order_id = $(".order_id").val();
				

				

				$(".order_list_table").html();

				$('.order_list_table').html("<td colspan='12'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-order-id')}}",

					method: "GET",

					data: {
						order_id : order_id
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<td colspan='12'><br><h5 class='text-center'> Nothing Found.</h5> <br></td>");

						} else {

							$('.order_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});



			// Search Customer list
			var field_data = $('.search_results').html();
			var search_key = $('.search_key').html();

			$('.search_customer').on('focus focusout', function() {

				$(this).on('change keyup', function() {

					var search_val = $(this).val();

					$('.search_key').html("Your Searched: '" + search_val + "'");

					if (search_val != '') {

						$('.search_results').html("<td colspan='6'><h1 class='text-center'><i class='fa fa-spinner fa-spin'></i></h1></td>");

						$('.pagi_box').hide();

						$.ajax({

							url: "{{URL('/search-customer-list')}}",

							method: "GET",

							data: {
								search_val: search_val
							},

							success: function(data) {

								if (data == "1") {

									$('.search_results').html("<td colspan='6'><br><h4 class='text-center'>Nothing Found.</h4><br></td>");

								} else {

									$('.search_results').html(data);

								}

							}
						});
					}

					if (search_val == '') {

						$('.search_results').html(field_data);
						$('.search_key').html(search_key);
						$('.pagi_box').show();
					}

				});

			});



			// Search bayer list

			var field_data = $('.search_buyer_results').html();

			$('.search_buyer').on('focus focusout', function() {

				$(this).on('change keyup', function() {

					var search_val = $(this).val();

					$('.search_key').html("Your Searched: '" + search_val + "'");

					if (search_val != '') {

						$('.search_buyer_results').html("<td colspan='8'><h1 class='text-center'><i class='fa fa-spinner fa-spin'></i></h1></td>");

						$('.pagi_box').hide();

						$.ajax({

							url: "{{URL('/search-buyer-list')}}",

							method: "GET",

							data: {
								search_val: search_val
							},

							success: function(data) {

								if (data == "1") {

									$('.search_buyer_results').html("<td colspan='8'><br><h4 class='text-center'>Nothing Found.</h4><br></td>");

								} else {

									$('.search_buyer_results').html(data);

								}

							}
						});
					}

					if (search_val == '') {

						$('.search_buyer_results').html(field_data);
						$('.search_key').html(search_key);
						$('.pagi_box').show();
					}

				});

			});



			// Drop Down Expenses "Click head change sub head name" (Expenses Sub Head name)
			var search_val = $('.expenses_head').val();

			$.ajax({

				url: "{{URL('/drop-expenses-sub-head')}}",

				method: "GET",

				data: {
					search_val: search_val
				},

				success: function(data) {

					if (data == "1") {

						$('.search_results_expenses').html("<h4 class='text-center'>Nothing Found.</h4>");

					} else {

						$('.search_results_expenses').html(data);

					}

				}
			});

			$('.expenses_head').on('focus focusout', function() {

				$(this).on('change keyup', function() {

					var search_val = $(this).val();

					$.ajax({

						url: "{{URL('/drop-expenses-sub-head')}}",

						method: "GET",

						data: {
							search_val: search_val
						},

						success: function(data) {

							if (data == "1") {

								$('.search_results_expenses').html("<h4 class='text-center'>Nothing Found.</h4>");

							} else {

								$('.search_results_expenses').html(data);

							}

						}
					});

				});

			});



			// Search Expenses List
			$(document).on('click', '.date_from_to_expenses', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".return_expenses").html();

				$('.search_term').html("<b>Expenses </b>" + "( " + date_from + " to " + date_to + " )");

				$('.return_expenses').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-expenses')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.return_expenses').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_expenses').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});



			$(document).on('click', '.date_from_to_for_sales_order', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".order_list_table").html();

				$('.order_list_table').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-sales-report-order')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.order_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});


			$(document).on('click', '.date_from_to_due', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".order_list_table").html();

				$('.order_list_table').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-order-date-due')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.hide_pagi').hide();
							$('.order_list_table').html(data);

						}

						// $('.gen_range').html("Showing data from "+date_from+"to "+date_to);

					}

				});

			});


			$(document).on('click', '.date_from_to_cancel_order', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".order_list_table").html();

				$('.order_list_table').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-order-date-cancel-order')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.order_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.hide_pagi').hide();
							$('.order_list_table').html(data);

						}

						// $('.gen_range').html("Showing data from "+date_from+"to "+date_to);
					}

				});

			});


			$(document).on('click', '.search_deposits', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();
				var select_account = $(".select_account").val();

				$('.search_term').html("<b>Deposits </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-deposits')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to,
						select_account: select_account
					},

					success: function(data) {

						if (data == "1") {

							$('.search_res').html("<tr><td colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</td></tr>");

						} else {

							$('.hide_pagi').hide();

							$('.search_res').html(data);

						}

					}

				});

			});

			$(document).on('click', '.search_withdraws', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$('.search_term').html("<b>Withdraws </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-withdraws')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.search_res').html("<tr><td colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</td></tr>");

						} else {

							$('.hide_pagi').hide();

							$('.search_res').html(data);

						}

					}

				});

			});


			$(document).on('click', '.search_loans', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$('.search_term').html("<b>Loans </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-loans')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.search_res').html("<tr><td colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</td></tr>");

						} else {

							$('.hide_pagi').hide();

							$('.search_res').html(data);

						}

					}

				});

			});


			$(document).on('click', '.search_transfers', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$('.search_term').html("<b>Balance Transfers </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-transfers')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.search_res').html("<tr><td colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</td></tr>");

						} else {

							$('.hide_pagi').hide();

							$('.search_res').html(data);

						}

					}

				});

			});


			$(document).on('click', '.search_statement', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$('.search_term').html("<b>Showing Data </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<td colspan='8'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/statement-search')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						$('.search_res').html(data);

					}

				});

			});

			$(document).on('click', '.search_sheet', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$('.search_term').html("<b>Showing Data </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<td colspan='8'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-sheet')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						$('.search_res').html(data);

					}

				});

			});


			$(document).on('click', '.search_transactions', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				var select_type = $(".select_type").val();

				$('.search_term').html("<b>All Transactions </b>" + "( " + date_from + " to " + date_to + " )");

				$('.search_res').html("<td colspan='8'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/transaction-search')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to,
						select_type: select_type
					},

					success: function(data) {

						if (data == "1") {

							$('.search_res').html("<td colspan='8'><br><h5 class='text-center'> Nothing Found. </h5><br></td>");

						} else {

							$('.hide_pagi').hide();

							$('.search_res').html(data);

						}

					}

				});

			});


			$(document).on('click', '.cat_list_tag', function() {

				$(".cat_list_tag").removeClass('cat_list_tag_active');

				$(this).addClass('cat_list_tag_active');

				var cat_id = $(this).attr('data-cat-id');

				var cat_name = $(this).attr('data-cat-name');

				var all_pro = $(".show_pro_all").html();

				$('.show_pro_all').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$('.show_pro_small_cat').html("<i class='fa fa-spinner fa-spin'></i>");

				$.ajax({

					url: "{{URL('/search-pro-by-cat')}}",

					method: "GET",

					data: {
						by_cat_id: cat_id
					},

					success: function(data) {

						$('.show_pro_all').html(data);
						$('.show_pro_small_cat').html(cat_name.toUpperCase());

					}

				});

			});



			var all_pro = $(".show_pro_all").html();

			$('.search_sales_pro').on('focusout', function() {

			});

			$('.search_sales_pro').on('focus', function() {

				$(this).on('keyup', function() {

					var search_val = $(this).val();

					if (search_val != '') {

						$('.show_pro_all').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

						$('.show_pro_small_cat').html("You Searched: '" + search_val + "'");

						$.ajax({

							url: "search-pro-by-name",

							method: "GET",

							data: {
								search_val: search_val
							},

							success: function(data) {

								$('.show_pro_all').html(data);
								$(".cat_list_tag").removeClass('cat_list_tag_active');

							}

						});

					}
					if (search_val == '') {

						$('.show_pro_all').html(all_pro);
						$(".cat_list_tag").first().addClass('cat_list_tag_active');
						$('.show_pro_small_cat').html("ALL ITEMS");
					}

				});

			});

		});
	</script>


	<!-- Date Picker -->
	<script>
		$(function() {

			$(".datepicker").datepicker({
				dateFormat: 'yy-mm-dd'
			});

		});
	</script>

	<!-- Print Product & Customer -->
	<script>
		// Print for product list page view Print.

		$(document).ready(function() {

			$(document).on('click', '.print_details', function() {

				var prtContent = document.getElementById("client_details");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding:10px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				// WinPrint.document.writeln('<link href="files/backend/style.css" rel="stylesheet" type="text/css" />');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;"><img src="<?= asset($company->company_logo); ?>" alt="<?= $company->company_name; ?>" height="40px" width="auto" style="margin:10px auto;display:block;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				// WinPrint.document.writeln('<p><img src="files/backend/img/logo.png" width="auto" height="70px" alt="image"></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln('<h4>Product Details:</h4>');

				WinPrint.document.writeln(prtContent.innerHTML);

				WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');
				WinPrint.document.close();
				WinPrint.focus();
				//WinPrint.print();
				//WinPrint.close();

			});

			$(document).on('click', '.print_out_stock', function() {

				var prtContent = document.getElementById("print_stockout");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding:10px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;"><img src="<?= asset($company->company_logo); ?>" alt="<?= $company->company_name; ?>" height="40px" width="auto" style="margin:10px auto;display:block;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln('<h4>Out of Stock:</h4>');

				WinPrint.document.writeln(prtContent.innerHTML);

				WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');

				WinPrint.document.close();
				WinPrint.focus();
				//WinPrint.print();
				//WinPrint.close();

			});

		});


		// Print for Customer list page view Print.
		$(document).ready(function() {

			$(document).on('click', '.print_customer_details', function() {

				var prtContent = document.getElementById("customer_details");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding:10px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				// WinPrint.document.writeln('<link href="files/backend/style.css" rel="stylesheet" type="text/css" />');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;"><img src="<?= asset($company->company_logo); ?>" alt="<?= $company->company_name; ?>" height="40px" width="auto" style="margin:10px auto;display:block;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				// WinPrint.document.writeln('<p><img src="files/backend/img/logo.png" width="auto" height="70px" alt="image"></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln(prtContent.innerHTML);

				WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');

				WinPrint.document.close();
				WinPrint.focus();
				//WinPrint.print();
				//WinPrint.close();

			});

		});
		
		
		
			// Print for Customer list page view Print.
		$(document).ready(function() {

			$(document).on('click', '.print_customer_details', function() {

				var prtContent = document.getElementById("customer_details");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding:10px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				// WinPrint.document.writeln('<link href="files/backend/style.css" rel="stylesheet" type="text/css" />');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;"><img src="<?= asset($company->company_logo); ?>" alt="<?= $company->company_name; ?>" height="40px" width="auto" style="margin:10px auto;display:block;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				// WinPrint.document.writeln('<p><img src="files/backend/img/logo.png" width="auto" height="70px" alt="image"></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln(prtContent.innerHTML);

				WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');

				WinPrint.document.close();
				WinPrint.focus();
				//WinPrint.print();
				//WinPrint.close();

			});

		});


		// Print for Purchase list page view Print.
		$(document).ready(function() {

			$(document).on('click', '.print_purchase_details', function() {

				var prtContent = document.getElementById("print_purchase");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td, table th, table tr {padding:3px !important;font-size:12px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				// WinPrint.document.writeln('<link href="files/backend/style.css" rel="stylesheet" type="text/css" />');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;">');

				// WinPrint.document.writeln('<p><img src="files/backend/img/logo.png" width="auto" height="70px" alt="image"></p>');

				WinPrint.document.writeln('<br>');

				// WinPrint.document.writeln('<h4>Customer Details:</h4>');

				WinPrint.document.writeln(prtContent.innerHTML);

				WinPrint.document.writeln('</body></html>');
				WinPrint.document.close();
				WinPrint.focus();
				//WinPrint.print();
				//WinPrint.close();

			});

		});



		//// print for accounts
		$(document).ready(function() {

			$(document).on('click', '.print_now', function() {

				var prtContent = document.getElementById("print_content");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.label-dark {background:#000;}.hide_print_sec {display:none;} table td {padding:10px !important;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 10px;"><img src="<?= asset($company->company_logo); ?>" alt="<?= $company->company_name; ?>" height="40px" width="auto" style="margin:10px auto;display:block;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln(prtContent.innerHTML);

				WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');
				WinPrint.document.close();
				WinPrint.focus();

			});

		});
		
		
		
		
			// Print for Company Statement
		$(document).ready(function() {

			$(document).on('click', '.print_company_statement', function() {

				var prtContent = document.getElementById("customer_details");

				var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=700,toolbar=0,scrollbars=0,status=0');

				WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding: 0px !important;} .table-responsive{font-size: 12px;}</style>');

				WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

				// WinPrint.document.writeln('<link href="files/backend/style.css" rel="stylesheet" type="text/css" />');

				WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

				WinPrint.document.writeln('</head><body style="margin:0 15px;"><h4 style="margin:0;text-align:center;"><?= $company->company_name; ?></h4><p style="text-align:center;margin:0;">Address: <?= $company->company_address; ?></p><p style="text-align:center;margin:0;">Mobile: <?= $company->company_mobile; ?> E-mail: <?= $company->company_email; ?></p>');

				// WinPrint.document.writeln('<p><img src="files/backend/img/logo.png" width="auto" height="70px" alt="image"></p>');

				WinPrint.document.writeln('<br>');

				WinPrint.document.writeln(prtContent.innerHTML);

				// WinPrint.document.writeln('<p class="text-right">Powered by Muktodhara Technology Limited</p></body></html>');

				WinPrint.document.close();
				WinPrint.focus();
				//WinPrint.print();
				//WinPrint.close();

			});

		});
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	</script>
	
	
	
	
	
	
	

	<!--  Print-order-page -->
	<?php

	if (isset($_GET['oid'])) {

		if ($_GET['oid'] > 0) { ?>

			<script>
				window.open('{{ url(' / print - order - page '.$_GET['
					oid ']) }}', '_blank');
			</script>
	<?php

		}
	}

	?>

	<!-- New Purchase All Function -->
	<script>
		$(document).ready(function() {


			// Search Product for New Purchase and input the Value.
			$('body').on('keyup focus', ".search_allPros", function() {

				var search_val = $(this).val();
				var current_val = $(this);


				if (search_val != "") {

					$(this).next().show();

					$.ajax({

						url: "{{URL('/search-pros-purchase')}}",

						method: "GET",

						data: {
							search_val: search_val
						},

						success: function(data) {

							if (data == "1") {

								current_val.next().html("<br><p>&nbsp; Nothing Found.</p>");

							} else {

								current_val.next().html(data);

							}
						}

					});



				} else {

					$(this).parent().parent().next().find(".enable_field").prop('disabled', true);

					$(this).next().hide();
				}


			});


			$('body').on("mouseover", ".search_list_click", function() {

				var get_input = $(this).parent().parent().parent().find('.search_input');

				var get_product_id = $(this).parent().parent().parent().find('.get_product_id');

				get_input.val($(this).attr('data-pro-name'));

				get_product_id.val($(this).attr('data-pro-id'));

				$(this).parent().parent().parent().parent().next().find(".enable_field").prop('disabled', false);

				$(".sub_btn").prop('disabled', false);

			});


			$('body').on('focusout', ".search_input", function() {

				$('.search_box').hide();

			});


			$('body').on('keyup change', ".enable_field", function() {

				var current_val = $(this).val();

				if (current_val > 0) {

					$(this).parent().parent().next().find(".enable_field_que").prop('disabled', false);

					var this_qty = $(this).parent().parent().next().find(".product_quantity").val();

					if (this_qty > 0) {

						var pro_quan = this_qty;

						var get_pur = current_val;

						var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

						$(this).parent().parent().next().next().find(".upTotalPrice").val(total_prc);


						var totalPriceArray = $(".upTotalPrice_1");

						var subTotal = 0;

						for (var i = 0; i < totalPriceArray.length; i++) {

							subTotal += $(totalPriceArray[i]).val() * 1;

						}

						$('.sub_total').val(subTotal);

						$('.after_discount').val(subTotal);

						// $('.ammount_payable').val(subTotal);

						var vat_input = $(".total_vat").val();

						var total = $(".after_discount").val();

						var tot = 0;

						var after_vat = vat_input * (total / 100);

						var tot = total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

						$('.total_discount').val(0);

						$(".total_discount").prop('disabled', false);
						$(".total_vat").prop('disabled', false);
						$(".purchase_discount_type").prop('disabled', false);


					} else {

						var pro_quan = 0;

						var get_pur = current_val;

						var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

						$(this).parent().parent().next().next().find(".upTotalPrice").val(total_prc);


						var totalPriceArray = $(".upTotalPrice_1");

						var subTotal = 0;

						for (var i = 0; i < totalPriceArray.length; i++) {

							subTotal += $(totalPriceArray[i]).val() * 1;

						}

						$('.sub_total').val(subTotal);

						$('.after_discount').val(subTotal);

						// $('.ammount_payable').val(subTotal);

						var vat_input = $(".total_vat").val();

						var total = $(".after_discount").val();

						var tot = 0;

						var after_vat = vat_input * (total / 100);

						var tot = total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

						$('.total_discount').val(0);

						$(".total_discount").prop('disabled', false);
						$(".total_vat").prop('disabled', false);
						$(".purchase_discount_type").prop('disabled', false);

					}

				} else {

					$(this).parent().parent().next().find(".enable_field_que").prop('disabled', true);

					current_val = 0;

					var this_qty = $(this).parent().parent().next().find(".product_quantity").val();

					if (this_qty > 0) {

						var pro_quan = this_qty;

						var get_pur = current_val;

						var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

						$(this).parent().parent().next().next().find(".upTotalPrice").val(total_prc);


						var totalPriceArray = $(".upTotalPrice_1");

						var subTotal = 0;

						for (var i = 0; i < totalPriceArray.length; i++) {

							subTotal += $(totalPriceArray[i]).val() * 1;

						}

						$('.sub_total').val(subTotal);

						$('.after_discount').val(subTotal);

						// $('.ammount_payable').val(subTotal);

						var vat_input = $(".total_vat").val();

						var total = $(".after_discount").val();

						var tot = 0;

						var after_vat = vat_input * (total / 100);

						var tot = total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

						$('.total_discount').val(0);

						$(".total_discount").prop('disabled', false);
						$(".total_vat").prop('disabled', false);
						$(".purchase_discount_type").prop('disabled', false);


					} else {

						var pro_quan = 0;

						var get_pur = current_val;

						var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

						$(this).parent().parent().next().next().find(".upTotalPrice").val(total_prc);


						var totalPriceArray = $(".upTotalPrice_1");

						var subTotal = 0;

						for (var i = 0; i < totalPriceArray.length; i++) {

							subTotal += $(totalPriceArray[i]).val() * 1;

						}

						$('.sub_total').val(subTotal);

						$('.after_discount').val(subTotal);

						// $('.ammount_payable').val(subTotal);

						var vat_input = $(".total_vat").val();

						var total = $(".after_discount").val();

						var tot = 0;

						var after_vat = vat_input * (total / 100);

						var tot = total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;

						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

						$('.total_discount').val(0);

						$(".total_discount").prop('disabled', true);
						$(".total_vat").prop('disabled', true);
						$(".purchase_discount_type").prop('disabled', true);

					}

				}

			});


			// Add More Product Field for purchase list
			var content_data = $('.content_data').html();

			$(document).on('click', '.bill_add_more_field', function() {

				var val = parseInt($(this).val());

				val = val + 1;

				$(this).val(val);

				$(".bill_remove_field").val(val);

				$('<div class="delField_' + val + '"><div class="no_padding col-md-12 col-sm-12 col-xs-12"><br></div><div class="no_padding col-md-2 col-sm-2 col-xs-12"><div class="form-group-sm"><input type="text" class="form-control" value="# ' + val + '" disabled></div></div>' + content_data + '</div>').insertBefore(".field_to_add_before");

				$(".sub_btn").prop('disabled', true);

			});


			// Remove Product Field for purchase list
			$(document).on('click', '.bill_remove_field', function() {

				var delval = parseInt($(this).val());

				if (delval > 1) {

					$(this).val(delval - 1);

					$(".bill_add_more_field").val(delval - 1);

					$(".delField_" + delval).remove();

					var totalPriceArray = $(".upTotalPrice_1");

					var subTotal = 0;

					for (var i = 0; i < totalPriceArray.length; i++) {

						subTotal += parseInt($(totalPriceArray[i]).val());

					}

					$('.sub_total').val(subTotal);

					$('.total_discount').val(0);


					var vat_input = $(".total_vat").val();



					var tot = 0;

					var after_vat = vat_input * (subTotal / 100);

					var tot = parseInt(subTotal);

					after_vat = Math.round((after_vat + tot) * 100) / 100;


					$('.after_discount').val(subTotal);
					$('.ammount_payable').val(after_vat);
					$('.payment_ammount_max').attr('max', after_vat);

				}

			});


			// Add more quentity field value btn
			$(document).on('click', '.qun_add_field', function() {

				var qty_field = $(this).parent().parent().find('.product_quantity');

				var val = parseInt(qty_field.val());

				if (val > 0) {

				} else {
					val = 0;
				}

				val = val + 1;

				$(qty_field).val(val);



				var pro_quan = val;

				var get_pur = $(this).parent().parent().parent().prev().find(".upPurcPrice").val();

				var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

				$(this).parent().parent().parent().next().find(".upTotalPrice").val(total_prc);



				var totalPriceArray = $(".upTotalPrice_1");

				var subTotal = 0;

				for (var i = 0; i < totalPriceArray.length; i++) {

					subTotal += $(totalPriceArray[i]).val() * 1;

				}

				$('.sub_total').val(subTotal);

				$('.after_discount').val(subTotal);

				var total = $(".after_discount").val();

				var tot = 0;

				var vat_input = parseInt($(".total_vat").val());

				var after_vat = vat_input * (total / 100);

				var tot = total * 1;

				after_vat = Math.round((after_vat + tot) * 100) / 100;

				$('.ammount_payable').val(after_vat);
				$('.payment_ammount_max').attr('max', after_vat);

				$('.total_discount').val(0);

				$(".total_discount").prop('disabled', false);
				$(".total_vat").prop('disabled', false);
				$(".purchase_discount_type").prop('disabled', false);

			});


			// Remove quentity field value btn 
			$(document).on('click', '.qun_remove_field', function() {

				var qty_field = $(this).parent().parent().find('.product_quantity');

				var val = parseInt(qty_field.val());

				if (val > 0) {

				} else {
					val = 0;
				}

				if (val > 1) {

					val = val - 1;

					$(qty_field).val(val);
				}

				var pro_quan = val;

				var get_pur = $(this).parent().parent().parent().prev().find(".upPurcPrice").val();

				var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

				$(this).parent().parent().parent().next().find(".upTotalPrice").val(total_prc);



				var totalPriceArray = $(".upTotalPrice_1");

				var subTotal = 0;

				for (var i = 0; i < totalPriceArray.length; i++) {

					subTotal += $(totalPriceArray[i]).val() * 1;

				}

				$('.sub_total').val(subTotal);

				$('.after_discount').val(subTotal);

				var total = $(".after_discount").val();

				var tot = 0;

				var vat_input = parseInt($(".total_vat").val());

				var after_vat = vat_input * (total / 100);

				var tot = total * 1;

				after_vat = Math.round((after_vat + tot) * 100) / 100;

				$('.ammount_payable').val(after_vat);
				$('.payment_ammount_max').attr('max', after_vat);

				$('.total_discount').val(0);

				$(".total_discount").prop('disabled', false);
				$(".total_vat").prop('disabled', false);
				$(".purchase_discount_type").prop('disabled', false);




			});


			$(document).on('change keyup', '.product_quantity', function() {

				var pro_quan = $(this).val();

				if (pro_quan > 0) {

					var get_pur = $(this).parent().parent().prev().find(".upPurcPrice").val();

					var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

					$(this).parent().parent().next().find(".upTotalPrice").val(total_prc);


					var totalPriceArray = $(".upTotalPrice_1");

					var subTotal = 0;

					for (var i = 0; i < totalPriceArray.length; i++) {

						subTotal += $(totalPriceArray[i]).val() * 1;

					}

					$('.sub_total').val(subTotal);

					$('.after_discount').val(subTotal);

					// $('.ammount_payable').val(subTotal);

					var vat_input = $(".total_vat").val();

					var total = $(".after_discount").val();

					var tot = 0;

					var after_vat = vat_input * (total / 100);

					var tot = total * 1;

					after_vat = Math.round((after_vat + tot) * 100) / 100;

					$('.ammount_payable').val(after_vat);
					$('.payment_ammount_max').attr('max', after_vat);

					$('.total_discount').val(0);

					$(".total_discount").prop('disabled', false);
					$(".total_vat").prop('disabled', false);
					$(".purchase_discount_type").prop('disabled', false);


				} else {

					pro_quan = 0;

					var get_pur = $(this).parent().parent().prev().find(".upPurcPrice").val();

					var total_prc = Math.round((get_pur * pro_quan) * 100) / 100;

					$(this).parent().parent().next().find(".upTotalPrice").val(total_prc);


					var totalPriceArray = $(".upTotalPrice_1");

					var subTotal = 0;

					for (var i = 0; i < totalPriceArray.length; i++) {

						subTotal += $(totalPriceArray[i]).val() * 1;

					}

					$('.sub_total').val(subTotal);

					$('.after_discount').val(subTotal);

					// $('.ammount_payable').val(subTotal);

					var vat_input = $(".total_vat").val();

					var total = $(".after_discount").val();

					var tot = 0;

					var after_vat = vat_input * (total / 100);

					var tot = total * 1;

					after_vat = Math.round((after_vat + tot) * 100) / 100;

					$('.ammount_payable').val(after_vat);
					$('.payment_ammount_max').attr('max', after_vat);

					$('.total_discount').val(0);

					$(".total_discount").prop('disabled', false);
					$(".total_vat").prop('disabled', false);
					$(".purchase_discount_type").prop('disabled', false);


				}



			});


			$(document).on('change keyup', '.total_discount', function() {

				$('.ammount_payable').val(0);

				var total_discount = $(this).val();

				var sub_total = $(".sub_total").val();

				var purchase_discount_type = $(".purchase_discount_type").val();

				if (purchase_discount_type == 1) {

					if (sub_total * 1 >= total_discount) {

						var vat_input = $(".total_vat").val();

						var payable = 0;

						var payable = sub_total - total_discount;



						var tot = 0;

						var after_vat = vat_input * (payable / 100);

						var tot = payable * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(payable);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

					} else {

						var vat_input = $(".total_vat").val();

						var tot = 0;

						var after_vat = vat_input * (sub_total / 100);

						var tot = sub_total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(sub_total);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);
					}

				}

				if (purchase_discount_type == 2) {

					if (total_discount <= 100) {

						var vat_input = $(".total_vat").val();

						var payable = 0;

						var payable = sub_total - (sub_total * total_discount / 100);



						var tot = 0;

						var after_vat = vat_input * (payable / 100);

						var tot = payable * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(payable);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

					} else {

						var vat_input = $(".total_vat").val();

						var tot = 0;

						var after_vat = vat_input * (sub_total / 100);

						var tot = sub_total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(sub_total);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);
					}

				}


			});


			$(document).on('change keyup', '.purchase_discount_type', function() {

				$('.ammount_payable').val(0);

				var total_discount = $('.total_discount').val();

				var sub_total = $(".sub_total").val();

				var purchase_discount_type = $(this).val();

				if (purchase_discount_type == 1) {

					if (sub_total >= total_discount) {

						var vat_input = $(".total_vat").val();

						var payable = 0;

						var payable = sub_total - total_discount;



						var tot = 0;

						var after_vat = vat_input * (payable / 100);

						var tot = payable * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(payable);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

					} else {

						var vat_input = $(".total_vat").val();

						var tot = 0;

						var after_vat = vat_input * (sub_total / 100);

						var tot = sub_total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(sub_total);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);
					}

				}

				if (purchase_discount_type == 2) {

					if (total_discount <= 100) {

						var vat_input = $(".total_vat").val();

						var payable = 0;

						var payable = sub_total - (sub_total * total_discount / 100);



						var tot = 0;

						var after_vat = vat_input * (payable / 100);

						var tot = payable * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(payable);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);

					} else {

						var vat_input = $(".total_vat").val();

						var tot = 0;

						var after_vat = vat_input * (sub_total / 100);

						var tot = sub_total * 1;

						after_vat = Math.round((after_vat + tot) * 100) / 100;


						$('.after_discount').val(sub_total);
						$('.ammount_payable').val(after_vat);
						$('.payment_ammount_max').attr('max', after_vat);
					}

				}


			});


			var vat_input = $(".total_vat").val();

			$(document).on('change keyup', '.total_vat', function() {

				$('.ammount_payable').val(0);

				var vat_input = $(".total_vat").val();

				// var vat_input = parseInt($(this).val());(

				if ($(this).val() != '') {

					var total = $(".after_discount").val();

					var tot = 0;

					var after_vat = vat_input * (total / 100);

					var tot = total * 1;

					after_vat = Math.round((after_vat + tot) * 100) / 100;

					$('.ammount_payable').val(after_vat);
					$('.payment_ammount_max').attr('max', after_vat);

				}
			});


			// Purchasre Payment Modal
			$('.table').on('click', '.add_payment_purchase', function() {

				var purchase_id = $(this).val();

				var amountDuePurchase = $(this).attr('amountDuePurchase');

				$('.purchase_id').val(purchase_id);

				$('.ammount_purchase_due').val(amountDuePurchase);

				$('.due_payment').attr('max', amountDuePurchase);

				$('.add_purchase_payment_modal').modal();

			});



			// Purchase Payment view
			$('.table').on('click', '.view_payment_purchase', function() {

				var purchase_id = $(this).val();

				$(".return_purchase_due").html();

				$('.return_purchase_due').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/view-purchase-payment')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_purchase_due').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.return_purchase_due').html(data);

						}
					}

				});

				$('.view_purchase_payment_modal').modal();

			});

			// Due Purchase Payment Modal
			$('.table').on('click', '.add_payment_due_purchase', function() {

				var purchase_id = $(this).val();

				var amountDuePurchase = $(this).attr('amountDuePurchase');

				$('.purchase_id').val(purchase_id);

				$('.ammount_purchase_due').val(amountDuePurchase);

				$('.due_payment').attr('max', amountDuePurchase);

				$('.add_due_purchase_payment_modal').modal();

			});
			//model category


			$(".add_generic").click(function(e) {
				e.preventDefault();
				var $this = $(this);
				var fileName = $(this).data("file");
				$("#basicModal").data("fileName", fileName).modal("toggle", $this);

			});


			// ADD supplier

			$(".add_supplier").click(function(e) {
				e.preventDefault();
				var $this = $(this);
				var fileName = $(this).data("file");
				$("#basicModal1").data("fileName", fileName).modal("toggle", $this);

			});




			// Purchase all view Invoice modal
			$('.table').on('click', '.pruchase_list_all_view', function() {

				// var purchase_id = $(this).val();

				var purchase_id = $(this).attr('dataId');
				var buyer_id = $(this).attr('buyer_id');

				// Buyer details request information
				$.ajax({

					url: "{{URL('/view-purchase-invoice')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_buyer').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_buyer').html(data);
						}
					}
				});

				// Purchase details information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order').html(data);
						}
					}
				});

				// Purchase list information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-list')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_list').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_list').html(data);
						}
					}
				});

				// Purchase Ammount information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-ammount')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_ammount').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_ammount').html(data);
						}
					}
				});

				// Purchase payment information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-payment')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_payment').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_payment').html(data);
						}
					}
				});

				// Purchase payment Due information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-payment-due')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id,
						buyer_id: buyer_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_due').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_due').html(data);
						}
					}
				});
				// Purchase last  payment
				$.ajax({

					url: "{{URL('/view-pur-invoic-last-pur-pay')}}",

					method: "GET",

					data: {
						buyer_id: buyer_id
					},

					success: function(data) {
						if (data == "") {

							$('.pur_invoic_last_pur_pay').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_last_pur_pay').html(data);
						}
					}
				});


				$.ajax({

					url: "{{URL('/purchase-extra-data')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id,
						buyer_id: buyer_id
					},

					success: function(data) {

						$('.throw_extra_data').html(data);
					}
				});


				$('.view_purchase_all_modal').modal();

			});
			
			
			
			
			
			
			
				// Purchase all view Invoice modal
			$('.table').on('click', '.calan_view', function() {

				// var purchase_id = $(this).val();

				var purchase_id = $(this).attr('dataId');
				var buyer_id = $(this).attr('buyer_id');

				// Buyer details request information
				$.ajax({

					url: "{{URL('/view-purchase-invoice')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_buyer').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_buyer').html(data);
						}
					}
				});

				// Purchase details information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order').html(data);
						}
					}
				});

				// Purchase list information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-list')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_list').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_list').html(data);
						}
					}
				});

				// Purchase Ammount information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-ammount')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_ammount').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_ammount').html(data);
						}
					}
				});

				// Purchase payment information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-payment')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_payment').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_payment').html(data);
						}
					}
				});

				// Purchase payment Due information
				$.ajax({

					url: "{{URL('/view-purchase-invoice-order-payment-due')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id,
						buyer_id: buyer_id
					},

					success: function(data) {

						if (data == "") {

							$('.pur_invoic_pur_order_due').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_pur_order_due').html(data);
						}
					}
				});
				// Purchase last  payment
				$.ajax({

					url: "{{URL('/view-pur-invoic-last-pur-pay')}}",

					method: "GET",

					data: {
						buyer_id: buyer_id
					},

					success: function(data) {
						if (data == "") {

							$('.pur_invoic_last_pur_pay').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");


						} else {

							$('.pur_invoic_last_pur_pay').html(data);
						}
					}
				});


				$.ajax({

					url: "{{URL('/purchase-extra-data')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id,
						buyer_id: buyer_id
					},

					success: function(data) {

						$('.throw_extra_data').html(data);
					}
				});


				$('.calan_modal').modal();

			});







			// Search Purchase List
			$(document).on('click', '.search_purchase_list', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".purchase_list_table").html();


				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$('.purchase_list_table').html("<td colspan='13'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-purchase-list')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.purchase_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.purchase_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});


			// Search Cancel Purchase List
			$(document).on('click', '.search_cancel_purchase_list', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();


				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$(".cancel_purchase_list_table").html();

				$('.cancel_purchase_list_table').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

				$.ajax({

					url: "{{URL('/search-cancel-purchase-list')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.cancel_purchase_list_table').html("<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>");

						} else {

							$('.cancel_purchase_list_table').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});


			// Search Due Purchase List
			$(document).on('click', '.search_due_purchase_list', function() {

				var date_from = $(".date_from").val();
				var date_to = $(".date_to").val();

				$(".return_due_purchase_results").html();

				$(".show_date").html('Showing Data: ' + date_from + ' to ' + date_to);

				$('.return_due_purchase_results').html("<td colspan='13'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/search-due-purchase-list')}}",

					method: "GET",

					data: {
						dt_from: date_from,
						dt_to: date_to
					},

					success: function(data) {

						if (data == "1") {

							$('.return_due_purchase_results').html("<td colspan='13'><br><h4 class='text-center'> Nothing Found.</h4><br></td>");

						} else {

							$('.return_due_purchase_results').html(data);
							$('.hide_pagi').hide();

						}
					}
				});
			});


			// Cancel Purchase To list

			$('.table').on('click', '.cancel_purchase', function() {

				var this_data = $(this);
				var purchase_id = $(this).val();

				$.ajax({

					url: "{{URL('/cancel-purchase')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "1") {

							// console.log(data);
							this_data.parent().parent().fadeOut();

						} else {

							// console.log(data);

						}
					}
				});
			});

			// Return Order To list.		
			$('.table').on('click', '.return_cancel_purchase', function() {

				var this_data = $(this);
				var purchase_id = $(this).val();

				$.ajax({

					url: "{{URL('/return-cancel-purchase')}}",

					method: "GET",

					data: {
						purchase_id: purchase_id
					},

					success: function(data) {

						if (data == "1") {

							// console.log(data);
							this_data.parent().parent().fadeOut();

						} else {

							// console.log(data);

						}
					}
				});
			});

			// View Customer due orders Modal			
			$('.table').on('click', '.buyer_dues', function() {

				var customer_id = $(this).val();

				$(".return_product").html();

				$('.return_product').html("<td colspan='13'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/view-buyer-due-orders')}}",

					method: "GET",

					data: {
						customer_id: customer_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<br>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.<br><br>");

						} else {

							$('.return_product').html(data);
						}
					}
				});

				$('.view_customer_due_modal').modal();

			});

			// View Customer orders Modal
			$('.table').on('click', '.buyer_orders', function() {

				var customer_id = $(this).val();

				$(".return_product").html();

				$('.return_product').html("<td colspan='13'><h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1></td>");

				$.ajax({

					url: "{{URL('/view-buyer-orders')}}",

					method: "GET",

					data: {
						customer_id: customer_id
					},

					success: function(data) {

						if (data == "") {

							$('.return_product').html("<br><h4> Nothing Found. </h4><br><br>");

						} else {

							$('.return_product').html(data);
						}
					}
				});

				$('.view_customer_modal').modal();

			});


		});
	</script>

	<!-- Delete Function -->
	<script>
		function checkDelete() {

			check = confirm("Are you sure to delete?");

			if (check) {

				return true;

			} else {

				false;

			}
		}
	</script>


	<!-- Charts -->
	<script>
		<?php date_default_timezone_set('Asia/Dhaka'); ?>

		$(function() {

			if ($("#lineChartAmmount").length) {
				var f = document.getElementById("lineChartAmmount");
				new Chart(f, {
					type: "line",
					data: {
						labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31],
						datasets: [{
								label: "Total Tk: ",
								backgroundColor: "rgba(38, 185, 154, 0.31)",
								borderColor: "rgba(38, 185, 154, 0.7)",
								pointBorderColor: "rgba(38, 185, 154, 0.7)",
								pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "rgba(220,220,220,1)",
								pointBorderWidth: 1,
								data: [
									<?php
									for ($x = 1; $x <= intval(date('d')); $x++) {
										if ($x < 10) {
											$g = "0" . $x;
										} else {
											$g = $x;
										}

										echo DB::table('order')->where('order_created_date', date('Y-m-') . $g)->sum('total_amount_payable') . ",";
									}
									?>
								]
							},
							{
								label: "Total Paid: ",
								backgroundColor: "rgba(3, 88, 106, 0.3)",
								borderColor: "rgba(3, 88, 106, 0.70)",
								pointBorderColor: "rgba(3, 88, 106, 0.70)",
								pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "rgba(151,187,205,1)",
								pointBorderWidth: 1,
								data: [
									<?php
									for ($x = 1; $x <= intval(date('d')); $x++) {
										if ($x < 10) {
											$g = "0" . $x;
										} else {
											$g = $x;
										}

										echo DB::table('pament_details')->where('created_date', date('Y-m-') . $g)->sum('amount') . ",";
									}
									?>
								]
							},
							{
								label: "Total Due: ",
								backgroundColor: "rgba(0, 65, 179, 0.3)",
								borderColor: "rgba(0, 65, 179, 0.3)",
								pointBorderColor: "rgba(0, 65, 179, 0.3)",
								pointBackgroundColor: "rgba(0, 65, 179, 0.3)",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "rgb(0, 77, 116)",
								pointBorderWidth: 1,
								data: [
									<?php
									for ($x = 1; $x <= intval(date('d')); $x++) {
										if ($x < 10) {
											$g = "0" . $x;
										} else {
											$g = $x;
										}

										$tot_am = DB::table('order')->where('order_created_date', date('Y-m-') . $g)->sum('total_amount_payable');

										$tot_paid = DB::table('pament_details')->where('created_date', date('Y-m-') . $g)->sum('amount');

										$tot_due = $tot_am - $tot_paid;

										echo $tot_due . ",";
									}
									?>
								]
							}

						]
					}

				})
			}

		});
	</script>

	<!-- Charts -->
	<script>
		$(function() {

			if ($("#lineChart").length) {
				var f = document.getElementById("lineChart");
				new Chart(f, {
					type: "line",
					data: {
						labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31],
						datasets: [{
								label: "Orders: ",
								backgroundColor: "rgba(38, 185, 154, 0.31)",
								borderColor: "rgba(38, 185, 154, 0.7)",
								pointBorderColor: "rgba(38, 185, 154, 0.7)",
								pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "rgba(220,220,220,1)",
								pointBorderWidth: 1,
								data: [
									<?php
									for ($x = 1; $x <= intval(date('d')); $x++) {
										if ($x < 10) {
											$g = "0" . $x;
										} else {
											$g = $x;
										}

										echo DB::table('order')->where('order_created_date', date('Y-m-') . $g)->count('order_id') . ",";
									}
									?>
								]
							},
							{
								label: "Products Sold",
								backgroundColor: "rgba(3, 88, 106, 0.3)",
								borderColor: "rgba(3, 88, 106, 0.70)",
								pointBorderColor: "rgba(3, 88, 106, 0.70)",
								pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "rgba(151,187,205,1)",
								pointBorderWidth: 1,
								data: [
									<?php
									for ($x = 1; $x <= intval(date('d')); $x++) {
										if ($x < 10) {
											$g = "0" . $x;
										} else {
											$g = $x;
										}

										echo DB::table('order_details')->where('order_details_created_date', date('Y-m-') . $g)->sum('product_qty') . ",";
									}
									?>
								]
							}
						]
					}

				})
			}

			if ($("#mybarChart").length) {

				var f = document.getElementById("mybarChart");

				new Chart(f, {
					type: "bar",
					data: {
						labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
						datasets: [{
							label: "Products Sold",
							backgroundColor: "#26B99A",
							data: [
								<?php
								for ($x = 1; $x <= intval(date('m')); $x++) {

									if ($x < 10) {
										$g = "0" . $x;
									} else {
										$g = $x;
									}

									$rrt = date('Y-') . $g . '-';

									$ee = DB::table('order_details')->where('order_details_created_date', 'like', '%' . $rrt . '%')->sum('product_qty');

									echo $ee . ",";
								}
								?>
							]
						}, {
							label: "Total Orders",
							backgroundColor: "#26BA31",
							data: [
								<?php
								for ($x = 1; $x <= intval(date('m')); $x++) {

									if ($x < 10) {
										$g = "0" . $x;
									} else {
										$g = $x;
									}

									$rrt = date('Y-') . $g . '-';

									$ee = DB::table('order')->where('order_created_date', 'like', '%' . $rrt . '%')->count('order_id');

									echo $ee . ",";
								}
								?>
							]
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: !0
								}
							}]
						}
					}

				})
			}

			<?php

			$customer_pre_due = DB::table('customer')->sum('credit_limit');

			$buyer_pre_due = DB::table('buyers')->sum('previous_due');

			$customer_extra_payment = DB::table('customer_extra_payment')->sum('amount');

			$supplier_extra_payment = DB::table('supplier_extra_payment')->sum('amount');

			?>

			if ($("#piChart").length) {
				var f = document.getElementById("piChart"),
					i = {
						labels: ["Total Ammount", "Total Due"],
						datasets: [{
							data: [<?= DB::table('order')->where('order_status', 1)->sum('total_amount_payable'); ?>, <?= DB::table('order')->where('order_status', 1)->sum('total_amount_payable') + $customer_pre_due - $customer_extra_payment - DB::table('pament_details')->where('status', 1)->sum('amount'); ?>],
							backgroundColor: ["#26B99A", "#3498DB"],
							hoverBackgroundColor: ["#36CAAB", "#49A9EA"]
						}]
					};

				new Chart(f, {
					type: "doughnut",
					tooltipFillColor: "rgba(51, 51, 51, 0.55)",
					data: i
				})
			}
		});
	</script>

	<!-- category model -->




	<script>
		$('.selectpicker').selectpicker({});
	</script>
	<script src="{{asset('/public/admin_asset/js/manage.js')}}"></script>
	
	


</body>

</html>