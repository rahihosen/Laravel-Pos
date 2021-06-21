@extends('admin_master')  
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box_layout col-md-12 col-sm-12 col-xs-12" >

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3><i class="fa fa-money" aria-hidden="true"></i> Purchase Cancelled </h3>
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
                        <h3 class="panel-title">Cancel Purchase</h3>
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
								<button class="search_cancel_purchase_list btn btn-primary btn-sm">Go</button>
								
								<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
							</div>
							
						</div>

                        <div id="print_content">
							
							<h4 class="bottom_padding">Purchase Cancelled:</h4>
							<p class="show_date">Showing All Data</p>

							<div class="table-responsive" style="width:100%;">
							
								<table class="table table-striped bulk_action table-responsive table-bordered">
									<thead>

										<tr class="headings">
											
											<th class="column-title text-center">Date/Time</th>
											<th class="column-title text-center">ID</th>
											<th class="column-title text-center">Supplier</th>
											<th class="column-title text-center">Total</th>
											<th class="column-title text-center">Disc.</th>
											<th class="column-title text-center">After Disc.</th>                                            
											<th class="column-title text-center">Vat</th>
											<th class="column-title text-center">Payable</th>
											<th class="column-title text-center">Paid</th>
											<th class="column-title text-center">Due</th>
											<th class="column-title text-center">Note</th>
											<th class="column-title text-center hide_print_sec">Payment</th>
											<th class="column-title text-center hide_print_sec" >Action</th>

										</tr>
									</thead>

									<tbody class="cancel_purchase_list_table">

										@foreach ( $all_purchase as $purchase )

											<tr class="even pointer">

												<td class="text-center">{{$purchase->purchase_created_date}} / {{$purchase->purchase_created_time}}</td>
												<td class="text-center">{{$purchase->purchase_id}}</td>
												<td class="text-center">{{$purchase->buyer_name}}</td>
												<td class="text-center">{{$purchase->purchase_total}} </td>
												<td class="text-center">{{$purchase->purchase_discount}}</td>
												<td class="text-center">{{$purchase->after_discount}} </td>
												<td class="text-center">{{$purchase->purchase_vat}} </td>
												<td class="text-center">{{$purchase->total_ammount_payable}} </td>
												<td class="text-center"> 
													<?php
														$data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');

														echo $data;
													?> 
												</td>
												<td class="text-center"> 
													<?php

														$result = ($purchase->total_ammount_payable) - $data;

														echo $result;
													?>
												</td>
												
												<td class="text-center">{{$purchase->purchase_note}} </td>

												<td class="last text-center hide_print_sec">


													<button 
														class="btn btn-info btn-xs view_payment_purchase"  
														value="{{$purchase->purchase_id}}" 
														><i class="fas fa-eye"></i> View
													</button>
												</td>

												<td class="text-center hide_print_sec">
													
													<button 
													   
														class="btn btn-info btn-xs pruchase_list_all_view"
														value="{{$purchase->purchase_id}}"
														dataId="{{$purchase->purchase_id}}"
														><i class="glyphicon glyphicon-eye-open"></i> View
													</button>

													<button 
														class="btn btn-success btn-xs return_cancel_purchase" 
														value="{{ $purchase->purchase_id }}"
														><i class="glyphicon glyphicon-backward"></i> Return
													</button>

												</td>
												
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
                        </div>						
						
						<div class="hide_pagi pull-right">

							@if ( $all_purchase != '')
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="{{URL::to('/cancel-purchase-list?page=1')}}">First</a> </li>
								</ul>
									{{ $all_purchase->links() }}
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="{{URL::to('/cancel-purchase-list?page='.$all_purchase->lastPage())}}">Last</a> </li>
								</ul>
							@endif
						</div>


                    </div>

                    
                </div>
            </div>    
        </div>
    </div>
    
</div>




<!-- Modal Add due Pament-->
<!--<div style="z-index:9999999999" class="modal fade add_purchase_payment_modal" id="" role="dialog">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>
            <div class="modal-body">
            
                {!!Form::open(['url' => '/add-purchase-payment', 'method'=>'post']) !!}
                    
                    <div class="form-group form-group-sm">

                        <input type="hidden" name="purchase_id" class="purchase_id" >
                        
                        <label>Due:</label>

                        <input type="text" class="ammount_purchase_due form-control" placeholder="Due" disabled>
                                                
                    </div>

                    <div class="form-group form-group-sm">

                        <label class="control-label" for="account-name">Account Name </label>

                        <select id="account-name" name="account_id" class="form-control active" >
                            
                            <?php 
                                $accounts = DB::table('accounts')->get();
                                foreach($accounts as $accounts ) {  ?>
                                
                                <option value="<?= $accounts->account_id;?>" ><?= $accounts->account_name;?></option>
                            
                            <?php } ?>
                                
                        </select>
                    
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="payment">Add Payment:</label>
                        <input type="number" id="payment" class="due_payment form-control" name="pur_ammount" min="1" placeholder="Payment">
                                                
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="Check-No">Check No:</label>
                        <input type="text" id="Check-No" class="form-control" name="payment_check_no"  placeholder="Check No">
                                                
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="receipt">Receipt / Transaction No.</label>
                        <input type="text" id="receipt" class="form-control"  name="payment_transaction_no"  placeholder="Receipt / Transaction No">
                                                
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="payment-note">Payment Note</label>
                        <input type="text" id="payment-note" class="form-control"  name="pur_payment_note" placeholder="Payment Note"  >
                                                
                    </div>                          
                    
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                {!!Form::close() !!}
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>	  
    </div>
</div> -->


<!-- Modal view Pament-->
<div style="z-index:9999999999" class="modal fade view_purchase_payment_modal" id="" role="dialog">
    <div class="modal-dialog modal-lg">

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
                                <th class="text-center">Account</th>
                                <th class="text-center">Check No:</th>
                                <th class="text-center">Receipt / Transaction No.</th>
                                <th class="text-center">Payment Note</th>
                            </tr>
                        </thead>
                        <tbody class="return_purchase_due">
                            
                            
                                                                    
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


<!-- Modal view Purchase Invoice -->
<div style="z-index:9999999999" class="modal fade view_purchase_all_modal" id="" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">View Purchase <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>

            <div class="modal-body">
            
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 15px;">
                <div class="invoice" id="print_purchase">
                    
                    <!-- title row -->
                    <div class="row-cus">
                        <div class=" col-md-12 col-sm-12 col-xs-12">
                            <?php 
                            $company = DB::table('settings')->first();
                            ?>
                            <h4>
                                <i class="fas fa-file-medical"></i> <?= $company->company_name; ?>
                            </h4>
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <!-- /.col -->

                    <!-- info row -->
                    <div class="row-cus m-t">

                        <div class="col-md-12 col-sm-12 col-xs-12 ">

                            <div class="col-md-4 col-sm-4  col-xs-12 invoice-col" style="padding-left: 0;">
                                <span> From </span> 
                                <address>
                                    <strong><?= $company->company_name; ?>.</strong><br>
                                    Address: <?= $company->company_address; ?><br>
                                    Phone: <?= $company->company_mobile; ?><br>
                                    Email: <?= $company->company_email; ?>
                                </address>
                            </div>

                            <div class="col-md-4 col-sm-4  col-xs-12 invoice-col">

                                To (Supplier)
                                <address class="pur_invoic_buyer">
                                    
                                </address>
                            </div>

                            <div class="col-md-4 col-sm-4  col-xs-12 invoice-col" style="padding-right: 0;">
                                <span class="pur_invoic_pur_order"></span>                                
                            </div>

                        </div>
                        
                    </div>
                    <!-- /.row -->

                    <div class="row-cus">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>
                    </div>

                    <!-- Table row -->
                    <div class="row-cus">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody class="pur_invoic_pur_order_list">
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    

                    <div class="row-cus">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0;">
                                
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 0;">
                                

                                <div class="table-responsive">

                                    <p class="lead">Amount</p>

                                    <table class="table">
                                        <tbody class="pur_invoic_pur_order_ammount">
                                            
                                        </tbody>
                                    </table>

                                    <p class="lead">Payment</p>

                                    <table class="table">
                                        <tbody class="pur_invoic_pur_order_payment">
                                            
                                        </tbody>
                                    </table>

                                    

                                    <table class="table">
                                        <tbody class="pur_invoic_pur_order_due">
                                            
                                        </tbody>
                                    </table>

                                </div>

                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="row-cus">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr style="margin-top: 0;">
                        </div>
                    </div>

                   

                    <!-- this row will not appear when printing -->
                    <br>

                    
                </div>
                    
                <div class="row-cus no-print">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button  target="_blank" class="btn btn-info print_purchase_details"><i class="fa fa-print"></i> Print</button>
                            
                        </div>
                    </div>

                
            </div>  

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>	  
    </div>
</div> 

@endsection