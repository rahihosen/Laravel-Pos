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
                        <h3><i class="fa fa-stack-exchange"></i> Cancelled</h3>
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
                            <h3 class="panel-title">Cancelled Order List</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="panel-body">

							@if(count($all_cancel_order_info) > 0)

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
										<button class="cancel_date_from_to btn btn-primary btn-sm">Go</button>
										
										<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
									</div>
									
								</div>
							
								
								<div id="print_content" class="col-md-12 col-sm-12 col-xs-12 no_padding">
								
									<h4 class="bottom_padding">Cancelled Orders:</h4>
									<p class="show_date">Showing All Data</p>
									
									<div class="table-responsive" style="width:100%;">
									
										<table class="table table-striped table-responsive table-bordered">
											
											<thead>
												<tr class="headings">
													
													<th class="text-center">Date/Time</th>
													<th class="text-center">ID</th>
													<th class="text-center">Customer</th>
													<th class="text-center">Total</th>
													<th class="text-center">Discount</th>                                            
													<th class="text-center">After Disc.</th>                                            
													<th class="text-center">Vat</th>
													<th class="text-center">Payable</th>
													<th class="text-center hidden">Paid</th>
													<th class="text-center hidden">Due</th>
													<th class="text-center hide_print_sec hidden">Payment</th>
													<th class="text-center hide_print_sec" style="width:20%;">Action</th>
												</tr>
											</thead>

											<tbody class="cancel_order_list_table">

												@foreach($all_cancel_order_info as $cancel_order)

													<tr class="even pointer">
														<td class="text-center">{{$cancel_order->order_created_date.' / '.$cancel_order->order_created_time}}</td>
														<td class="text-center">{{$cancel_order->order_id}}</td>
														<td class="text-center">{{$cancel_order->customer_name}}</td>
														<td class="text-center">{{$cancel_order->order_total}}</td>
														<td class="text-center">{{$cancel_order->order_discount}}</td>
														<td class="text-center">{{$cancel_order->after_discount}}</td>
														<td class="text-center">{{$cancel_order->order_vat}}%</td>
														<td class="text-center">{{$cancel_order->total_amount_payable}}</td>
														<td class="text-center hidden">
															<?php
																$data = DB::table('pament_details')->where('order_id', $cancel_order->order_id)->sum('amount');
																echo $data;
															?> 
														</td>
														<td class="text-center hidden">
															<?php
																$result = ($cancel_order->total_amount_payable) - $data;
																echo $result;
															?> 
														</td>
														<td class="last text-center hide_print_sec hidden">

															<button 
																class="btn btn-info btn-xs view_payment" 
																data-amountDue="{{ $result =  ($cancel_order->total_amount_payable) - $data }}" 
																value="{{$cancel_order->order_id}}"
																><i class="glyphicon glyphicon-eye-open"></i> View
															</button>
														</td>
														<td class="last text-center hide_print_sec">

															{{-- <a href="{{URL::to('/print-order-page/'.$cancel_order->order_id)}}" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a> --}}

															<a href="{{URL::to('/view-order/'.$cancel_order->order_id)}}" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>

															<button class="btn btn-success btn-xs return_cancel_order" value="{{ $cancel_order->order_id }}" > <i class="glyphicon glyphicon-backward"></i> Return Order</button>
															
														</td>
														
													</tr>

												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								
								<div class="pull-right hide_pagi">

									@if ( $all_cancel_order_info != '' )
										<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{URL::to('/cancel-order-list?page=1')}}">First</a> </li>
										</ul>
											{{ $all_cancel_order_info->links() }}
										<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{URL::to('/cancel-order-list?page='.$all_cancel_order_info->lastPage())}}">Last</a> </li>
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
</div>

<!-- /page content -->




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