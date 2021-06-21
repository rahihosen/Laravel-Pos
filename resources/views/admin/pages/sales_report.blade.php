@extends('admin_master')  
@section('admin_main_content')
    
    <div class="right_col right_col_back" role="main">
    
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="no_padding"><i class="fa fa-shopping-bag"></i> Sales Reports </h3>
                    </div>
                </div>

                <!-- All Success Messages -->
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
                            <h3 class="panel-title">Sales Reports</h3>
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
									<button class="date_from_to_sales_reports btn btn-primary btn-sm">Go</button>
									
									<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
								</div>
								
							</div>
						
							<div id="print_content">
							
								<h4 class="bottom_padding">Sales Reports:</h4>
								<p class="show_date">Showing All Data</p>

								<div class="table-responsive">
									<table class="table table-striped bulk_action table-responsive table-bordered">
										<thead>
											<tr class="headings">
												
												<th class="column-title text-center"> Date </th>
												<th class="column-title text-center"> Total Product Sold </th>                                        
												<th class="column-title text-center"> Total Wastage </th>
												<th class="column-title text-center"> Created By </th>
												<th class="column-title text-center hide_print_sec"> Action </th>

											</tr>
										</thead>

										<tbody class="return_results">
										   
											@foreach( $sales_info as $sales )
											

												<tr class="even pointer">
													
													<td class="text-center">{{$sales->sales_report_date}} </td>
													
													<td class="text-center">
													    @php
													     $saless = DB::table('order_details')
                                                            ->where('order_details_status', 1)
                                                            ->where('order_details_created_date', $sales->sales_report_date)
                                                            ->SUM('product_qty'); 
                                                        @endphp
														{{$saless}}
													</td>

													<td class="text-center">
														{{$sales->total_wastage}}
														
													</td>   
													<td class="text-center">
														{{$sales->name}}
														
													</td>   
													
													<td class="last text-center hide_print_sec">
														
														<button class="btn btn-info btn-xs view_sold" value="{{$sales->sales_report_date}}">
															<i class="glyphicon glyphicon-eye-open"></i> View Sold
														</button>

														<button class="btn btn-primary btn-xs view_wastage_total" value="{{$sales->sales_report_date}}">
															<i class="glyphicon glyphicon-eye-open"></i> View Wastage
														</button>

													</td>
												</tr>

											@endforeach

										</tbody>
									</table>
								</div>
                            </div>
							
							<div class="hide_pagi pull-right">
								@if ( $sales_info != '')
									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="{{URL::to('/sales-report?page=1')}}">First</a> </li>
									</ul>

									{{ $sales_info->links() }} 

									<ul class="pagination">
										<li class="page-item"><a class="page-link" href="{{URL::to('/sales-report?page='.$sales_info->lastPage())}}">Last</a> </li>
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


    <!-- View Sold -->
    <div style="z-index:9999999999" class="modal fade view_sold_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Sold<button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                    
                    <div class="form-group">
                        
						<select id="admin-name" name="admin_id" class="form-control admin_id" required>
							
							<?php 
								$admin = DB::table('admin')->get();
								foreach($admin as $admin ) {  ?>
								
								<option value="<?= $admin->id;?>"><?= $admin->name;?></option>
							
							<?php } ?>
							
                        </select>
                        
									
						<div><br>
							<button type="button" class="scarch_created_by">scarch</button>
						</div>
					</div>
                    
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <div><input type="text" class="s_date" hidden></div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date / Time</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Sold Quantity</th>
                                    <th class="text-center">Sold Price</th>
                                    <th class="text-center">Created By</th>
                                </tr>
                            </thead>
                            <tbody class="return_sold" id="result">
							
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


    <!-- View Wastage -->
    <div style="z-index:9999999999" class="modal fade view_wastage_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Wastage<button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date / Time</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Wastage Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="return_wastage">
							
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

