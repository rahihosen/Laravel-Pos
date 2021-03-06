@extends('admin_master')  
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box_layout col-md-12 col-sm-12 col-xs-12" >

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3><i class="fa fa-stack-exchange"></i> Due Reports </h3>
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
                            <h3 class="panel-title">Due Reports </h3>
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
									<button class="date_from_to_due_reports btn btn-primary btn-sm">Go</button>
									
									<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
								</div>
								
							</div>
						
							<div id="print_content">
							
								<h4 class="bottom_padding">Due Reports:</h4>
								<p class="show_date">Showing All Data</p>
								<div class="table-responsive">
									<table class="table table-striped table-responsive table-bordered">

										<thead>
											<tr class="headings">
												
												<th class="text-center"> Order Date / Time</th>
												<th class="text-center"> Order ID </th>
												<th class="text-center"> Customer Name </th>
												<th class="text-center"> Total</th>
												<th class="text-center"> Discount</th>                                            
												<th class="text-center"> After Discount</th>                                            
												<th class="text-center"> Vat</th>
												<th class="text-center"> Total Amount Payable</th>
												<th class="text-center"> Paid </th>
												<th class="text-center"> Due </th>
												<th class="text-center hide_print_sec"> Payment </th>
												<th class="text-center hide_print_sec" style="width:12%;"> Action </th>

											</tr>
										</thead>

										<tbody class="return_results">

											<?php foreach($all_order_due as $all_orders) { ?>

												<?php 
													$data = DB::table('pament_details')->where('order_id', $all_orders->order_id)->sum('amount'); 
												
													$data2 = $all_orders->total_amount_payable;
												?>
												
												<?php if ( $data2 > $data ) { ?>

													<tr class="even pointer">
														<td class="text-center">{{$all_orders->order_created_date.' / '.$all_orders->order_created_time}}</td>
														<td class="text-center">{{$all_orders->order_id}}</td>
														<td class="text-center">{{$all_orders->customer_name}}</td>
														<td class="text-center">{{$all_orders->order_total}}</td>
														<td class="text-center">{{$all_orders->order_discount}}%</td>
														<td class="text-center">{{$all_orders->after_discount}}</td>
														<td class="text-center">{{$all_orders->order_vat}}%</td>
														<td class="text-center">{{$all_orders->total_amount_payable}}</td>
														<td class="text-center">
															<?php
																$data = DB::table('pament_details')->where('order_id', $all_orders->order_id)->sum('amount');
																echo $data;
															?> 
														</td>
														<td class="text-center">
															<?php
																$result = ($all_orders->total_amount_payable) - $data;
																echo $result;
															?> 
														</td>

														<td class="last text-center hide_print_sec">

															<button 
																class="btn btn-primary btn-xs add_payment" 
																data-amountDue="{{ $result =  ($all_orders->total_amount_payable) - $data }}" 
																value="{{$all_orders->order_id}}" 
																><i class="fa fa-edit"></i> Add 
															</button>

															<button 
																class="btn btn-info btn-xs view_payment_due_rep" 
																data-amountDue="{{ $result =  ($all_orders->total_amount_payable) - $data }}" 
																value="{{$all_orders->order_id}}"
																><i class="glyphicon glyphicon-eye-open"></i> View
															</button>
														</td>

														<td class="last text-center hide_print_sec">

															<a 
																href="{{URL::to('/print-order-page/'.$all_orders->order_id)}}" 
																target="_blank" class="btn btn-warning btn-xs"
																><i class="glyphicon glyphicon-print"></i> Print
															</a>

															<a 
																href="{{URL::to('/view-order/'.$all_orders->order_id)}}" 
																class="btn btn-info btn-xs"
																><i class="glyphicon glyphicon-eye-open"></i> View
															</a>
															
														</td>
													
													</tr>
												<?php } ?>
												
											<?php  } ?>
											
										</tbody>
									</table>
								</div>
                            </div>
							
							<div class="pull-right hide_pagi">

								@if ( $all_order_due != '' )
									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="{{URL::to('/due-report?page=1')}}">First</a> </li>
									</ul>
										{{ $all_order_due->links() }}
									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="{{URL::to('/due-report?page='.$all_order_due->lastPage())}}">Last</a> </li>
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
</div>

<!-- /page content -->


<!-- Modal Add due Pament-->
<div style="z-index:9999999999" class="modal fade add_payment_modal" id="" role="dialog">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>
            <div class="modal-body">
            
                {!!Form::open(['url' => '/add-payment-report', 'method'=>'post']) !!}
                    
                    <div class="form-group form-group-sm">

                        <input type="hidden" name="order_id" class="order_id" value="">
						
                        <label>Due:</label>
						
                        <input type="text" class="amount form-control" disabled>
						
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="ppayment">Add Payment:</label>
						
                        <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="due_payment form-control" value="" name="order_payment" min="1" placeholder="Payment" id="ppayment" required>
						
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