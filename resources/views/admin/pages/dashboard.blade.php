@extends('admin_master')
@section('admin_main_content')

<?php
date_default_timezone_set("Asia/Dhaka");
$today = date("Y-m-d");
?>

<div class="right_col" role="main">



	<?php

	if (isset($_GET['error'])) {

		$message = $_GET['error'];

		if ($message == 1) {  ?>

			<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

				<h5 class="text-center">


					<div class="alert alert-danger alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong> Access Denied ! </strong>
					</div>



				</h5>
			</div>

		<?php
		}
	}

	$admin_data = Auth::user();
	$admin_id = $admin_data->id;
	$admin_image_query = DB::table('admin')->where('id', $admin_id)->first();

	if ($admin_image_query->admin_role == 1) {
		?>




        <div class="row top_tiles">
			<a href="{{URL::to('/create-sales')}}">
			    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="tile-stats newShortCut bg-gradient-info" style="background:#3C4043!important">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<h3 style="padding: 35px;text-align: center;">NEW ORDER</h3>
				</div>
			</div>
			</a>

			<a href="{{URL::to('/purchase-add')}}">
			    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="tile-stats newShortCut bg-gradient-danger" style="background:#3C4043!important;">
					<h3 style="padding: 35px;text-align: center;">PURCHASE OR ADD</h3>
				</div>
			</div>
			</a>
			
			<a href="{{URL::to('/buyer-list')}}">
			    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="tile-stats newShortCut bg-gradient-danger" style="background:#3C4043!important;">
					<div class="icon"><i class="fa fa-shopping-basket"></i></div>
					<h3 style="padding: 35px;text-align: center;">SUPPLIER</h3>
				</div>
			</div>
			</a>
		</div>
		
        
		<div class="row top_tiles">

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-info">
					<div class="icon"><i class="fa fa-cubes"></i></div>
					<div class="count"><?= DB::table('product')->count('product_id'); ?></div>
					<h3>Total Product</h3>
					<p>Total Sum of All Product.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-danger">
					<div class="icon"><i class="fas fa-bezier-curve"></i></div>
					<div class="count"><?= DB::table('category')->count('category_id'); ?></div>
					<h3>Category</h3>
					<p>Total Sum of Category.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-default">
					<div class="icon"><i class="fa fa-users"></i></div>
					<div class="count"><?= DB::table('customer')->count('customer_id'); ?></div>
					<h3>Customers</h3>
					<p>Total Sum of All Customers.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-primary">
					<div class="icon"><i class="fa fa-user-plus"></i></div>
					<div class="count"><?= DB::table('admin')->count('id'); ?></div>
					<h3>Users</h3>
					<p>Total Sum of All Users.</p>
				</div>
			</div>

		</div>

		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12 col-sm-12 col-xs-12 ">

				<div class="col-md-12 col-sm-12 col-xs-12 no_padding">
					<div class="panel panel-amin">
						<div class="panel-heading">
							<h3 class="panel-title">Orders & Product Summary</h3>
							<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
						</div>

						<div class="panel-body">
							<br>
							<div class="no_padding right_padding res_no_padding col-md-6 col-sm-12 col-xs-12">
								<canvas id="lineChart"></canvas>
							</div>
							<div class="no_padding right_padding res_no_padding col-md-6 col-sm-12 col-xs-12">
								<canvas id="mybarChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row top_tiles">

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-primary">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<div class="count"><?= DB::table('order')->where('order_status', 1)->count('order_id'); ?></div>
					<h3>Orders</h3>
					<p>Total Sum of All Orders.</p>
				</div>
			</div>
			
			<?php
			
			$customer_pre_due = DB::table('customer')->sum('credit_limit');
        
            $buyer_pre_due = DB::table('buyers')->sum('previous_due');
            
            $customer_extra_payment = DB::table('customer_extra_payment')->sum('amount');
			
		    $supplier_extra_payment = DB::table('supplier_extra_payment')->sum('amount');
			
			?>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-default">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count"><?= DB::table('order')->where('order_status', 1)->sum('total_amount_payable'); ?></div>
					<h3>Order Amount</h3>
					<p>Total Sum of Amount of All Orders.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-danger">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count"><?= DB::table('pament_details')->where('status', 1)->sum('amount') + $customer_extra_payment; ?></div>
					<h3>Ammount Paid</h3>
					<p>Total Sum of Paid Amount of All Orders.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-info">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count"><?= DB::table('order')->where('order_status', 1)->sum('total_amount_payable') + $customer_pre_due - $customer_extra_payment - DB::table('pament_details')->where('status', 1)->sum('amount'); ?></div>
					<h3>Ammount Due</h3>
					<p>Total Sum of Dued Amount of All Orders.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-info">
					<div class="icon"><i class="fas fa-bezier-curve"></i></div>
					<div class="count"><?= DB::table('product_type')->count('type_id'); ?></div>
					<h3>Product Types</h3>
					<p>Total Sum of Product Types.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-primary">
					<div class="icon"><i class="fa fa-archive"></i></div>
					<div class="count"><?= DB::table('stock')->sum('stock_quantity'); ?></div>
					<h3>Total Stock</h3>
					<p>Total Sum of Product Stock.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-default">
					<div class="icon"><i class="fa fa-balance-scale"></i></div>
					<div class="count"><?= DB::table('order_details')->where('order_details_status', 1)->sum('product_qty'); ?></div>
					<h3>Product Sold</h3>
					<p>Total Sum of Product Sold.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-danger">
					<div class="icon"><i class="fa fa-trash"></i></div>
					<div class="count"><?= DB::table('wastage')->sum('wastage_quantity'); ?></div>
					<h3>Total Wastage</h3>
					<p>Total Sum of Product Wasted.</p>
				</div>
			</div>



			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-primary">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count">

						<?= DB::table('purchase')->count('purchase_id'); ?>

					</div>
					<h3>Total Purchase</h3>
					<p>Total Sum of Product Purchased.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-danger">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count"><?= DB::table('purchase')->sum('total_ammount_payable'); ?></div>
					<h3>Purchase Amount</h3>
					<p>Total Amount of Product Purchased.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-info">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count">

						<?php

						$stock_amnt = $wastage_amnt = $sell_amnt = 0;

						$stock_cal =  DB::table('stock')->get();

						foreach ($stock_cal as $stock_cal) {
							$stock_amnt += $stock_cal->purchase_price * $stock_cal->stock_quantity;
						}

						$wastage_cal =  DB::table('wastage')->get();

						foreach ($wastage_cal as $wastage_cal) {
							$wastage_amnt += $wastage_cal->purchase_price * $wastage_cal->wastage_quantity;
						}

						$sell_cal =  DB::table('order_details')->where('order_details_status', 1)->get();

						foreach ($sell_cal as $sell_cal) {
							$sell_amnt += $sell_cal->purchase_price * $sell_cal->product_qty;
						}

						$in_stock_amnt = $stock_amnt - $wastage_amnt - $sell_amnt;

						echo $in_stock_amnt;

						?>

					</div>
					<h3>Stock Amount</h3>
					<p>Total Amount of Product Stocked.</p>
				</div>
			</div>

			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats bg-gradient-default">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="count"><?= $wastage_amnt; ?></div>
					<h3>Wastage Amount</h3>
					<p>Total Amount of Product Wasteged.</p>
				</div>
			</div>

		</div>

		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12 col-sm-12 col-xs-12 ">

				<div class="col-md-12 col-sm-12 col-xs-12 no_padding">
					<div class="panel panel-amin">
						<div class="panel-heading">
							<h3 class="panel-title">Sales Summary (Total, Paid & Due)</h3>
							<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
						</div>

						<div class="panel-body">
							<br>
							<div class="no_padding right_padding res_no_padding col-md-7 col-sm-12 col-xs-12">
								<canvas id="lineChartAmmount"></canvas>
							</div>

							<div class="no_padding col-md-5 col-sm-12 col-xs-12">
								<span><i class="fa fa-square text-primary"></i> Total Order Amount</span>
								<br>
								<span><i class="fa fa-square text-info"></i> Total Due Amount</span>
								<br>
								<br>
								<canvas id="piChart" style="width: 484px; height: 242px;" width="484" height="242"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php
	} else {
	?>
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12 col-sm-12 col-xs-12 ">
				<?php $company = DB::table('settings')->first(); ?>
				<br>
				<br>
				<br>
				<br>
				<h1 class="text-center">Welcome</h1>
				<h1 class="text-center">to</h1>
				<h1 class="text-center"><?= $company->company_name; ?></h1>
			</div>
		</div>
	<?php
	}

	?>


</div>

<!-- /page content -->
@endsection