@extends('admin_master')  
@section('admin_main_content')
    
    <div class="right_col right_col_back" role="main">
    
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="no_padding"><i class="fa fa-shopping-bag"></i> Order Reports </h3>
                    </div>
                    
                    
                </div>

                <!-- Flash Messages -->
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
                            <h3 class="panel-title">Order Reports</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>

                        <div class="panel-body">
						
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
									<button class="date_from_to_order_reports btn btn-primary btn-sm">Go</button>
									
									<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
								</div>
								
							</div>
						
							<div id="print_content">
							
								<h4 class="bottom_padding">Order Reports:</h4>
								<p class="show_date">Showing All Data</p>

								<div class="table-responsive">
									<table class="table table-striped bulk_action table-responsive table-bordered">
										<thead>
											<tr class="headings">
												
												<th class="text-center">Date </th>
												<th class="text-center">Total Order </th>
												<th class="text-center">Total Ammount </th>
												<th class="text-center hidden">Total Received </th>
												<th class="text-center hidden">Total Due </th>
												<th class="text-center">Total Cancelled Orders </th>
												<th class="text-center">Total Cancelled Ammount </th>
												<th class="text-center hide_print_sec">Action </th>

											</tr>
										</thead>

										<tbody class="return_order_reports">
											
											@foreach ( $orders_info as $orders )

												<?php $date = $orders->order_created_date; ?>
												
												<tr class="even pointer">
													
													<td class="text-center">{{$date}}</td>
													
													<td class="text-center">

														<?= $total = DB::table('order')->where('order_created_date', $date)->where('order_status', 1)->count('order_id'); ?>

													</td>
													
													<td class="text-center"> 

														<?= $active_data = DB::table('order')->where('order_created_date', $date)->where('order_status', 1)->sum('total_amount_payable'); ?>

													</td>
													
													<td class="text-center hidden">

														<?= $total = DB::table('pament_details')->where('status', 1)->where('created_date', $date)->sum('amount'); ?>
													</td>

													<td class="text-center hidden">
													
														<?= $result = $active_data - $total; ?>

													</td>

													<td class="text-center">
														<?php
															$total = DB::table('order')->where('order_created_date', $date)->where('order_status', 0)->count('order_id');
															echo $total;
														?>
													</td>

													<td class="text-center"> 
														<?= $inactive_data = DB::table('order')->where('order_created_date', $date)->where('order_status', 0)->sum('total_amount_payable'); ?>
													</td>   
													
													<td class="last text-center hide_print_sec">
														
														<button 
															class="btn btn-info btn-xs view_order_report"
															value="{{$date}}" 
															><i class="glyphicon glyphicon-eye-open "></i> View Orders
														</button>

														<button 
															class="btn btn-primary btn-xs view_cancelled_order" 
															value="{{$date}}" 
															><i class="glyphicon glyphicon-eye-open"></i> View Cancelled Orders
														</button>

													</td>
												</tr>

											@endforeach

										</tbody>
									</table>
								</div>
                            </div>
							
							<div class="hide_pagi pull-right">

								@if ( $orders_info != '') 
									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="{{URL::to('/order-report?page=1')}}">First</a> </li>
									</ul>
										{{ $orders_info->links() }}
									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="{{URL::to('/order-list?page='.$orders_info->lastPage())}}">Last</a> </li>
									</ul>
								@endif
							</div>
							
							<div class="clearfix"></div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Order's Report's -->
    <div style="z-index:9999999999" class="modal fade view_order_report_modal" id="" role="dialog">
        <div class="modal-dialog modal-lg"style="width:95%;">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Order Report <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body" id="customer_details">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>                                    
                                    <th class="text-center"> Date / Time</th>
                                    <th class="text-center"> Added By</th>
                                    <!--<th class="text-center"> Table Number</th>-->
                                    <th class="text-center"> Order Id</th>
                                    <th class="text-center"> Order Total</th>
                                    <th class="text-center"> Discount</th>
                                    <th class="text-center"> After Discount</th>
                                    <th class="text-center"> Vat</th>
                                    <th class="text-center"> Amount Payable</th>
                                    <th class="text-center hidden"> Paid</th>
                                    <th class="text-center hidden"> Due</th>
                                    <th class="text-center hidden"> Payment</th>
                                    <th class="text-center"> Action</th>
                                </tr>
                            </thead>
                            <tbody class="return_results">
                                
                                
								
                            </tbody>
                        </table>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="print_customer_details btn btn-default" style="float: left;">Print</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>

    <!-- Modal View Cancelled Order's Report's -->
    <div style="z-index:9999999999" class="modal fade view_cancelled_order_report_modal" id="" role="dialog">
        <div class="modal-dialog modal-md"style="width: 95%;">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Cancelled Order Report <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                        <thead>
                                <tr>                                    
                                    <th class="text-center"> Date / Time</th>
                                    <th class="text-center"> Added By</th>
                                    <!--<th class="text-center"> Table Number</th>-->
                                    <th class="text-center"> Order Id</th>
                                    <th class="text-center"> Order Total</th>
                                    <th class="text-center"> Discount</th>
                                    <th class="text-center"> After Discount</th>
                                    <th class="text-center"> Vat</th>
                                    <th class="text-center"> Amount Payable</th>
                                    <th class="text-center hidden"> Paid</th>
                                    <th class="text-center hidden"> Due</th>
                                    <th class="text-center hidden"> Payment</th>
                                    <th class="text-center"> Action</th>
                                </tr>
                            </thead>
                            <tbody class="return_results">
                                
                                
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

    <!-- Modal Add due Payment for report's-->
    <div style="z-index:9999999999" class="modal fade add_payment_order_report_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-payment-order-report', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">

                            <input type="hidden" name="order_id" class="order_id" value="">
                            <label>Due:</label>
                            <input type="text" class="amount form-control" value="" disabled>
							
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="paymenttt">Add Payment:</label>
							
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="due_payment form-control" value="" name="order_payment" min="1" placeholder="Payment" id="paymenttt" required>
							
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

    <!-- Modal view Payment report's-->
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

