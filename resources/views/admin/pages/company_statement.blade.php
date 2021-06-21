@extends('admin_master')  
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="box_layout col-md-12 col-sm-12 col-xs-12" >

				<div class="col-md-12 col-sm-12 col-xs-12">
					<h3><i class="fa fa-stack-exchange"></i> Company Statement</h3>
				</div>     
				
			</div>

			<?php 

				$message = Session::get('message');

				if ( $message !='') { ?>

					<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

						<h5 class="text-center">

							<?php

								if(isset($message)) { ?>

									<div class="alert alert-success alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong> <?php echo $message;?> </strong>
									</div>
									
								<?php
									Session::put('message','');
								}
							?>

						</h5>
					</div> 
					
					<?php 
				}
				
			?>
				

			<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
				<div class="panel panel-amin">
				
					<div class="panel-heading">
						<h3 class="panel-title"> Company Statement</h3>
						<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
					</div>

					<div class="panel-body">

					@if(count($all_order_info) > 0)

						<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
							<div class="marginBT10 form-group-sm">
								<input type="text" class="date_from datepicker form-control" value="{{date('Y-m-d')}}">
							</div>
							
						</div>
						
						<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
							<div class="marginBT10 form-group-sm">
								<input type="text" class="date_to datepicker form-control" value="{{date('Y-m-d')}}">
							</div>
							
						</div>
						
						<div class="col-md-4 col-sm-4 col-xs-12 res_no_padding">					
							<div class="marginBT10 form-group-sm">
								<button class="date_from_to_company btn btn-primary btn-sm">Go</button>
								
								<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
							</div>
							
						</div>

						<div id="print_content" class="col-md-12 col-sm-12 col-xs-12 no_padding">
						
							
							
						</div>
						
							
							<div class="table-responsive" style="width:100%;" id="customer_details">
								
								<table class="table table-striped table-responsive table-bordered">
									<thead>
										<tr class="headings">
											<th class="text-center">Invoice No#</th>
											<th class="text-center">Date/Time</th>
											<th class="text-center">Bill Added By</th>
											<th class="text-center">Customer Name</th>
											<th class="text-center">Previous Due</th>
											<th class="text-center">Adress</th>
											<th class="text-center">Bill Amount</th>
											
											                                         
											
											<th class="text-center">Receivable Amount </th>
											<th class="text-center hidden">Paid Amount</th>
											<th class="text-center ">Due</th>
											<th class="text-center hide_print_sec hidden">Payment</th>
											<th class="text-center hide_print_sec hidden" style="width:20%;">Action</th>
										</tr>
									</thead>

									<tbody class="order_list_table">

										@foreach($all_order_info as $order) 

											<tr class="even pointer">
											    <td class="text-center">{{$order->order_id}}</td>
												<td class="text-center">{{$order->order_created_date}} / {{$order->order_created_time}}</td>
                                                <td class="text-center">{{$order->name}}</td>
                                                <td class="text-center">{{$order->customer_name}}</td>
                                                </td>
												 <td class="text-center">
												     <?php
														$data1 = DB::table('customer')->where('customer_id', $order->customer_id)->value('prev_due');

														echo $data1;
													?> 
												     
												 </td>
                                                <td class="text-center">{{$order->customer_address }}</td>
												
												<td class="text-center">{{$order->order_total}}</td>
												
												
												<td class="text-center hidden">{{$order->total_amount_payable}}</td>
												<td class="text-center ">
													<?php
														$data = DB::table('pament_details')->where('order_id', $order->order_id)->sum('amount');

														echo $data;
													?> 
													</td>
												
												<td class="text-center ">
													<?php

														$result = ($order->total_amount_payable) - $data;

														echo $result;  
													
													?>
												</td>

												<td class="last text-center hide_print_sec hidden">

													<button 

														class="btn btn-primary btn-xs add_payment" 
														type="button" 
														data-amountDue="{{ $result =  ($order->total_amount_payable) - $data }}" 
														value="{{$order->order_id}}"
														><i class="fa fa-edit"></i> Add 
													</button>

													<button 
														class="btn btn-info btn-xs view_payment" 
														type="button" 
														data-amountDue="{{ $result =  ($order->total_amount_payable) - $data }}" 
														value="{{$order->order_id}}" 
														><i class="fas fa-eye"></i> View
													</button>
												</td>
												<td class="last text-center hide_print_sec hidden">

													{{-- <a 
														href="{{URL::to('/print-order-page/'.$order->order_id)}}" 
														target="_blank" 
														class="btn btn-warning btn-xs"

														><i class="glyphicon glyphicon-print"></i> Print
													</a> --}}

													<a 
														href="{{URL::to('/view-order/'.$order->order_id)}}" 
														class="btn btn-info btn-xs"
														><i class="glyphicon glyphicon-eye-open"></i> View
													</a>

													<button 
														class="btn btn-danger btn-xs cancel_order" 
														value="{{ $order->order_id }}" 
														><i class="glyphicon glyphicon-trash"></i> Cancel Order
													</button>

													
												</td>
											</tr>
										

										@endforeach
											<tr><td colspan="6" style="text-align: center"><b>Total:</b> 
											
										
											
										
									 </td>
													
													<td class="text-center">
													    <i class="fa fa-money" aria-hidden="true"></i>
													    <?php
														$data = DB::table('order')->sum('order_total');

														echo $data;
													?>
													</td>
													<td class="text-center">
													    <i class="fa fa-money" aria-hidden="true"></i>
													    <?php
														$data = DB::table('pament_details')->sum('amount');

														echo $data;
													?>
													</td>
													<td class="text-center">
													    <i class="fa fa-money" aria-hidden="true"></i>
													    <?php
														$data = DB::table('order')->sum('total_amount_payable');
														$data1 = DB::table('pament_details')->sum('amount');

														$reult = $data - $data1;
														echo 	$reult;
													?>
													</td>
													</tr>

									</tbody>
								</table>
							</div>
							
							 <button type="button" class="print_company_statement btn btn-default" style="float: left;">Print</button>
						</div>
						
						<div class="hide_pagi pull-right">

							@if ( $all_order_info != '') 
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="{{URL::to('/company-statement?page=1')}}">First</a> </li>
								</ul>
									{{ $all_order_info->links() }}
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="{{URL::to('/company-statement?page='.$all_order_info->lastPage())}}">Last</a> </li>
								</ul>
							@endif
						</div>
						
						<div class="clearfix"></div>
					
					@else
						<h4 class="text-center">Nothing Found.</h4>
					@endif

					</div>
					
					
				</div>
			</div>    
		</div>
	</div>
    
</div>




<!-- Modal Add due Pament-->
<div style="z-index:9999999999" class="modal fade add_payment_modal" id="" role="dialog">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>
            <div class="modal-body">
            
                {!!Form::open(['url' => '/add-payment', 'method'=>'post']) !!}
                    
                    <div class="form-group form-group-sm">

                        <input type="hidden" name="order_id" class="order_id" value="">
						
                        <label>Due:</label>
						
                        <input type="text" class="amount form-control" value="" name="amount" disabled>
						
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="payment">Add Payment:</label>
						
                        <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="due_payment form-control" value="" name="order_payment" min="0.01" placeholder="Payment" id="payment" required>
						
                    </div>  
					
					<div class="form-group form-group-sm">
					
						<label for="Transaction">Transaction Number</label>
					
						<input type="text" name="transaction_no" id="Transaction" placeholder="Transaction Number" class="form-control">
						
					</div>  

					<div class="form-group form-group-sm">

						<label for="account-name">Select Account </label>

						<select id="account-name" name="account_id" class="form-control" required>
							
							<?php 
								$accounts = DB::table('accounts')->get();
								foreach($accounts as $accounts ) {  ?>
								
								<option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
							
							<?php } ?>
							
						</select>
					
					</div> 					
	
                    <button type="submit" class="btn btn-primary">Add Payment</button>
					
                {!!Form::close() !!}
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>	  
    </div>
</div> 


<!-- Modal view Pament-->
<div style="z-index:9999999999" class="modal fade view_payment_modal" id="" role="dialog">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">View Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>

            <div class="modal-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Date / Time</th>
                                <th class="text-center">Create By</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Transaction No.</th>
                            </tr>
                        </thead>
                        <tbody class="return_due">
                            
							
                        </tbody>
                    </table>
                </div> 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>	  
    </div>
</div> 

@endsection