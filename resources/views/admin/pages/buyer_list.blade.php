@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fas fa-user-tag"></i> Supplier </h3>
                        
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
					
					<?php 

                        $message = Session::get('error');

                        if ( $message !='') { ?>

                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                <h5 class="text-center">

                                    <?php

                                        if(isset($message)) { ?>

                                            <div class="alert alert-danger alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> <?php echo $message;?> </strong>
                                            </div>
                                            
                                        <?php
                                            Session::put('error','');
                                        }
                                    ?>

                                </h5>
                            </div> 
                            
                            <?php 
                        }
                        
                    ?>
                    

                    <div class="no_padding res_no_padding right_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Add Supplier</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-buyer', 'method'=>'post']) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label for="buyer-name">Supplier Name</label>
										
                                        <input type="text" placeholder="Supplier Name" id="buyer-name" name="buyer_name" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="buyer-mobile">Supplier Mobile</label>
                                        <input type="text" placeholder="Supplier Mobile" id="buyer-mobile" name="buyer_mobile" class="form-control">
                                        
                                    </div>
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="buyer-email" placeholder="Supplier E-mail" style="padding-top: 10px;">Supplier E-mail </label>
										
                                        <input type="email" placeholder="Supplier E-mail" id="buyer-email" name="buyer_email"class="form-control">
                                        
                                    </div>
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="previous_due" placeholder="previous_due" style="padding-top: 10px;">Previous Due</label>
										
                                        <input type="number" placeholder="Previous Due" id="previous_due" name="previous_due"class="form-control">
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="buyer-address" style="padding-top: 10px;">Supplier Address </label>
										
                                        <textarea placeholder="Supplier Address" type="text" id="buyer-address" name="buyer_address" class="form-control"></textarea>
                                        
                                    </div>



                                    <div class="ln_solid"></div>

                                    <div class="form-group form-group-sm">
                                        
                                        <button type="submit" class="btn btn-success">Save</button>
                                        
                                    </div>

                                {!! Form::close() !!}                                
                                
                            </div>
                        </div>
                    </div>

                    <div class="no_padding col-md-8 col-sm-8 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Supplier List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">

                                @if ( $data = count($all_buyers) > 0 )
                                    
                                    <input type="text" class="search_buyer form-control" placeholder="Search..." style="border-color: #023264;border-radius: 3px;">
                                    <div><br></div>

                                    <p class="search_key" type="hidden"></p>
                                    
                                    <div class="table-responsive"> 

                                        <table class="table table-striped bulk_action table-responsive table-bordered table-align">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title text-center">ID </th>
                                                    <th class="column-title text-center">Name </th>
                                                    <th class="column-title text-center">Mobile </th>
                                                    <th class="column-title text-center">P. Due </th>
                                                    <!--<th class="column-title text-center">Email </th>
                                                    <th class="column-title text-center">Address </th>-->
                                                    <th class="column-title text-center">Created</th>
                                                    <th class="column-title text-center">Created Date</th>
                                                    <th class="column-title text-center">Updated</th>
                                                    <th class="column-title text-center">Updated Date</th>
                                                    <th class="column-title text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="search_buyer_results">
                                                
                                                @foreach($all_buyers as $buyers)

                                                    <tr class="even pointer">
                                                        <td class="text-center">{{$buyers->bid}}</td>
                                                        <td class="text-center">{{$buyers->bname}}</td>
                                                        <td class="text-center">{{$buyers->bmobile}}</td>
                                                        <td class="text-center">{{$buyers->previous_due}}</td>
                                                        <!--<td class="text-center">{{$buyers->bemail}}</td>
                                                        <td class="text-center">{{$buyers->baddress}}</td>-->
                                                        <td class="text-center">{{$buyers->created_admin_name}}</td>
                                                        <td class="text-center">{{$buyers->bcreated_date}} / {{$buyers->bcreated_time}}</td>
                                                        <td class="text-center">{{$buyers->updated_admin_name}}</td>
                                                        <td class="text-center"><?php if($buyers->bupdated_date != ''){?>{{$buyers->bupdated_date}} / {{$buyers->bupdated_time}}<?php }?></td>
                                                        
                                                        
                                                        <td class="text-center">

                                                            <button
                                                                class="btn btn-dark btn-xs edit_buyer"

                                                                value="{{$buyers->bid}}"
                                                                buyerName="{{$buyers->bname}}"
                                                                buyerMobile="{{$buyers->bmobile}}"
                                                                buyerEmail="{{$buyers->bemail}}"
                                                                previous_due="{{$buyers->previous_due}}"
                                                                buyerAddress="{{$buyers->baddress}}"

                                                                ><i class="fas fa-pencil-alt"></i> Edit
                                                            
                                                            </button>
                                                            
                                                            <button
                                                            
                                                                class="btn btn-primary btn-xs buyer_orders" 
                                                                value="{{$buyers->bid}}">
                                                                <i class="fas fa-eye"></i> Orders
                                                            </button>
                                                            
                                                            <!--<button 
                                                            
                                                                class="btn btn-danger btn-xs buyer_dues" 
                                                                value="{{$buyers->bid}}"><i class="fas fa-eye"></i> Dues
                                                            </button>-->

                                                            <button
                                                                class="btn btn-info btn-xs extra_payment" 
                                                                value="{{$buyers->bid}}"><i class="fa fa-money"></i> Payment
                                                            </button>         
                                                            <button
                                                                class="btn btn-info btn-xs previous_payment2" buyer="{{$buyers->bid}}" purchase="0"><i class="fa fa-money"></i> Add Payment
                                                            </button>                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else

                                    <h4 class="text-center">Nothing Found..</h4>

                                @endif
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Buyer Modal -->
    <div style="z-index:9999999999" class="modal fade edit_buyer_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Edit Supplier <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-buyer', 'method'=>'post'])!!}

                        <div class="form-group form-group-sm">
						
                            <label>ID</label>
							
                            <input type="text" class="form-control buyer_id" value="" disabled>
                            
							<input type="hidden" name="buyer_id" value="" class=" buyer_id">
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="name">Supplier Name</label>
							
                            <input type="text" id="name" placeholder="Supplier Name" name="buyer_name" value="" class="form-control buyer_name" required>

                        </div>

                        <div class="form-group form-group-sm">

                            <label for="mobile">Supplier Mobile</label>
							
                            <input type="text" id="mobile" placeholder="Supplier Mobile" name="buyer_mobile" class="form-control buyer_mobile">
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="email">Supplier E-mail</label>
							
                            <input type="email" id="email" placeholder="Supplier E-mail" name="buyer_email" class="form-control buyer_email">
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="previous_due" placeholder="Supplier E-mail" style="padding-top: 10px;">Previous Due</label>
                            
                            <input type="number" placeholder="Previous Due" id="previous_due" name="previous_due"class="form-control previous_due">
                            
                        </div>
                        
                        <div class="form-group form-group-sm">

                            <label for="address" style="padding-top: 10px;">Supplier Address </label>
							
                            <textarea id="address" type="text" placeholder="Supplier Address" name="buyer_address" class="form-control buyer_address"></textarea>
                            
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group form-group-sm">
                           
                            <button type="submit" class="btn btn-success">Update</button>
                        
                        </div>

                    {!! Form::close()!!}
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>
	
	
    <!-- View Customer orders Modal -->
    <div style="z-index:9999999999" class="modal fade view_customer_modal" role="dialog">
        <div class="modal-dialog modal-lg" style="width:95%;">
            <div class="modal-content">
                <div class="modal-header">                    
                    <h4 class="modal-title">View Purchases<button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body" id="customer_details">
				
					<h4 class="cus_detail"><h4>
						
					<h4 class="bottom_padding top_padding">All Purchases</h4>
                
                    <div class="table-responsive">
						
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
									<th class="text-center">Date/Time</th> 
									<th class="text-center">Supplier</th>
									<th class="text-center">Total</th>
									<th class="text-center">Disc.</th>
									<th class="text-center">A. Disc.</th>
									<th class="text-center">Vat</th>
									<th class="text-center">Payable</th>
									<th class="text-center hidden">Paid</th>
									<th class="text-center hidden">Due</th>
									<th class="text-center">Note</th>
									<th class="text-center hide_print_sec hidden">Payment</th>
									<th class="text-center hide_print_sec">Action</th>
                                </tr>
                            </thead>
                            <tbody class="return_product">
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
	
	
	<!-- View Customer due Modal -->
    <div style="z-index:9999999999" class="modal fade view_customer_due_modal" role="dialog">
        <div class="modal-dialog modal-lg" style="width:95%;">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Due Purchases <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body" id="print_content">
					
					<h4 class="cus_detail"><h4>
					
					<h4 class="bottom_padding top_padding">All Due Purchases</h4>
                
                    <div class="table-responsive">
						
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
									<th class="text-center">Date/Time</th> 
									<th class="text-center">Supplier</th>
									<th class="text-center">Total</th>
									<th class="text-center">Disc.</th>
									<th class="text-center">A. Disc.</th>
									<th class="text-center">Vat</th>
									<th class="text-center">Payable</th>
									<th class="text-center">Paid</th>
									<th class="text-center">Due</th>
									<th class="text-center">Note</th>
									<th class="text-center hide_print_sec">Payment</th>
									<th class="text-center hide_print_sec">Action</th>
                                </tr>
                            </thead>
                            <tbody class="return_product">
                                
								
                            </tbody>
                        </table>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="print_now btn btn-default" style="float: left;">Print</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>
	
	
	
	<!-- Modal Add due Pament-->
    <div style="z-index:9999999999" class="modal fade add_purchase_payment_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-purchase-payment', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">

                            <input type="hidden" name="purchase_id" class="purchase_id" >

                            <label for="due">Due:</label>
                            <input type="text" id="due" class="ammount_purchase_due form-control" placeholder="Due" id="ammount_purchase_due" disabled>
                        </div>

                        <div class="form-group form-group-sm">

                            <label class="control-label" for="account-name">Account Name </label>

                            <select id="account-name" name="account_id" class="form-control active" required>
                                
                                <?php 
                                    $accounts = DB::table('accounts')->get();
                                    foreach($accounts as $accounts ) {  ?>
                                    
                                    <option value="<?= $accounts->account_id;?>" ><?= $accounts->account_name;?></option>
                                
                                <?php } ?>
                                    
                            </select>
                        
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="payment">Add Payment:</label>
                            <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" type="number" id="payment" class="due_payment form-control" value="" name="pur_ammount" min="0.01" placeholder="Payment" required>
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="check-No">Check No:</label>
                            <input type="text" id="check-No" class="form-control" name="payment_check_no"  placeholder="Check No">
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="receipt-no">Receipt / Transaction No.</label>
                            <input type="text" id="receipt-no" class="form-control"  name="payment_transaction_no"  placeholder="Receipt / Transaction No">
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="payment-note">Payment Note</label>
                            <input type="text" id="payment-note" class="form-control"  name="pur_payment_note" placeholder="Payment Note">
                            
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


    <!-- Modal view calan-->
    <div style="z-index:9999999999" class="modal fade calan_modal" id="" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">View Calan <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 15px;">
                    <div class="invoice" id="print_purchase">
                        
                        <!-- title row 
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
                        </div>-->
                        
                        <!-- /.col -->

                        <!-- info row -->
                        <div class="row-cus m-t">

                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="col-md-12 col-sm-12 col-xs-12 no_padding" style="text-align: center;">
                                    
                                    <h1>Calan</h1>
                                    <br>
                                </div>

                                

                                <div class="res_no_padding col-md-4 col-sm-4  col-xs-12 invoice-col">

                                   
                                    <table class="pur_invoic_buyer"></table>
                                </div>

                                <div class="res_no_padding col-md-4 col-sm-4 col-xs-12 invoice-col">
                                 
                                    <table class="pur_invoic_pur_order"></table>                             
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                    <br>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Table row -->
                        <div class="row-cus">
                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial #</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>

                                    <tbody class="pur_invoic_pur_order_list"></tbody>
                                </table>
                            </div>
                        </div>
                        
                        <br/><br/>
                        	<div>
                            	<div class="col-md-6">
    							    <hr style="width:50%;text-align:left;margin-left:0; border-top: 1px solid #241919; margin-bottom:5px;">
    								<div style="margin-left: 37px;">Customer Signature</div>
    							</div>
    
    							
    							
    							<div class="col-md-6">
    							<hr style="width:50%;text-align:left;margin-left:0; border-top: 1px solid #241919; margin-bottom:5px;float">
    								<div style="margin-left: 37px;">Authorized By</div>
    
    							</div>
							</div>

                        

            
                        <br>

                        
                    </div>
                    <br/>
                    <br/>
                        
                    <div class=" no-print">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button  target="_blank" class="btn btn-info print_purchase_details"><i class="fa fa-print"></i> Print</button>
                            <span class="throw_extra_data"></span>
                        </div>
                    </div>
                </div>  
                </div>  

                <div style="border:0;" class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 
    
    
    
    
    <!-- Modal view Pament-->
    <div style="z-index:9999999999" class="modal fade view_purchase_all_modal" id="" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">View Purchase <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 15px;">
                    <div class="invoice" id="print_purchase">
                        
                        <!-- title row 
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
                        </div>-->
                        
                        <!-- /.col -->

                        <!-- info row -->
                        <div class="row-cus m-t">

                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                    <br>
                                </div>

                                <div style="padding:0;" class="col-md-4 col-sm-4 col-xs-12 invoice-col">
                                    <span> From </span> 
               
                                    <table>
                                        <tr>
                                            <td><strong>{{$company->company_name}}.</strong><br></td>
                                        </tr>
                                        <tr>
                                            <td>{{$company->company_address}}.<br></td>
                                        </tr>
                                        <tr>
                                            <td>{{$company->company_mobile}}.<br></td>
                                        </tr>
                                        <tr>
                                            <td>{{$company->company_email}}.<br></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="res_no_padding col-md-4 col-sm-4  col-xs-12 invoice-col">

                                    To (Supplier)
                                    <table class="pur_invoic_buyer"></table>
                                </div>

                                <div class="res_no_padding col-md-4 col-sm-4 col-xs-12 invoice-col">
                                 
                                    <table class="pur_invoic_pur_order"></table>                             
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                    <br>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Table row -->
                        <div class="row-cus">
                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
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

                                    <tbody class="pur_invoic_pur_order_list"></tbody>
                                </table>
                            </div>
                        </div>

                        

                        <div class="row-cus">

                            <div class="col-md-12 col-sm-12 col-xs-12 no_padding">

                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0;"></div>

                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
                                    <div class="table-responsive">

                                        <table class="table">
                                            <tbody class="pur_invoic_pur_order_ammount"></tbody>
                                        </table>

                                        <h4 style="padding: 10px 5px;">Payment</h4>

                                        <table class="no_margin table">
                                            <tbody class="pur_invoic_pur_order_payment"></tbody>
                                        </table>

                                        

                                        <table class="table">
                                            <tbody class="pur_invoic_pur_order_due"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <p class="text-center">Powered by Muktodhara Technology Limited</p>
                                </div>

                            </div>
                            
                        </div>                   

                        <!-- this row will not appear when printing -->
                        <br>

                        
                    </div>
                        
                    <div class="row-cus no-print">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button  target="_blank" class="btn btn-info print_purchase_details"><i class="fa fa-print"></i> Print</button>
                            <span class="throw_extra_data"></span>
                        </div>
                    </div>
                </div>  
                </div>  

                <div style="border:0;" class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 
    
    
    
    
    
    
    


    {{-- Extra Payment Supplier --}}
    <div style="z-index:9999999999" class="modal fade extra_payment_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-extra-payment-supplier', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">
                            <input type="hidden" class="buyer" name="buyer_id">
                            <input type="hidden" class="purchase" name="purchase_id">
                            <input type="hidden" name="go_to" value="2">
                        </div>

                        <div class="form-group form-group-sm">

                            <label class="control-label" for="account-name">Account Name </label>

                            <select id="account-name" name="account_id" class="form-control active" required>
                                
                                <?php $accounts = DB::table('accounts')->get();?>
                                    
                                @foreach($accounts as $accounts ) 
                                    
                                    <option value="<?= $accounts->account_id;?>" ><?= $accounts->account_name;?></option>
                                
                                @endforeach
                                    
                            </select>
                        
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="payment">Add Payment:</label>
                            <input id="payment" class="due_payment form-control" name="amount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" type="number"  placeholder="Payment" required>
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="check-No">Check No:</label>
                            <input type="text" id="check-No" class="form-control" name="check_no"  placeholder="Check No">
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="receipt-no">Receipt / Transaction No.</label>
                            <input type="text" id="receipt-no" class="form-control"  name="transaction"  placeholder="Receipt / Transaction No">
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="payment-note">Payment Note</label>
                            <input type="text" id="payment-note" class="form-control"  name="note" placeholder="Payment Note">
                            
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

    {{-- Extra Payment Supplier 2 --}}
    <div style="z-index:9999999999" class="modal fade extra_payment_modal2" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-extra-payment-supplier2', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">
                            <input type="hidden" class="buyer" name="buyer_id">
                            <input type="hidden" class="purchase" name="purchase_id">
                        </div>

                        <div class="form-group form-group-sm">

                            <label class="control-label" for="account-name">Account Name </label>

                            <select id="account-name" name="account_id" class="form-control active" required>
                                
                                <?php $accounts = DB::table('accounts')->get();?>
                                    
                                @foreach($accounts as $accounts ) 
                                    
                                    <option value="<?= $accounts->account_id;?>" ><?= $accounts->account_name;?></option>
                                
                                @endforeach
                                    
                            </select>
                        
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="payment">Add Payment:</label>
                            <input id="payment" class="due_payment form-control" name="amount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" type="number"  placeholder="Payment" required>
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="check-No">Check No:</label>
                            <input type="text" id="check-No" class="form-control" name="check_no"  placeholder="Check No">
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="receipt-no">Receipt / Transaction No.</label>
                            <input type="text" id="receipt-no" class="form-control"  name="transaction"  placeholder="Receipt / Transaction No">
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="payment-note">Payment Note</label>
                            <input type="text" id="payment-note" class="form-control"  name="note" placeholder="Payment Note">
                            
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

    {{-- Modal view extra payment --}}
    <div  class="modal fade view_extra_payment_modal" id="" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">View Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <span class="throw_extra_payment"></span>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 
@endsection


@push('script')

<script>
    $(document).ready(function() {

        $(document).on('click', '.previous_payment', function() {

            var buyer = $(this).attr('buyer');

            var purchase = $(this).attr('purchase');

            $('.buyer').val(buyer);
            $('.purchase').val(purchase);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.extra_payment_modal').modal();

        });

        $(document).on('click', '.previous_payment2', function() {

            var buyer = $(this).attr('buyer');

            var purchase = $(this).attr('purchase');

            $('.buyer').val(buyer);
            $('.purchase').val(purchase);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.extra_payment_modal2').modal();

        });

        $(document).on('click', '.extra_payment', function() {

            var buyer_id = $(this).val();

            $(".throw_extra_payment").html();

            $('.throw_extra_payment').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

            $.ajax({

                url: "{{URL('/view-extra-payment-supplier')}}",

                method: "GET",

                data: {
                    buyer_id: buyer_id
                },

                success: function(data) {

                    $('.throw_extra_payment').html(data);
                }

            });


            $('.view_extra_payment_modal').modal();

        });

        $(document).on('click', '.del', function() {
                    
            var this_data = $(this);
            var id = $(this).val();
                    
            $.confirm({
                icon: 'fa fa-smile-o',
                theme: 'modern',
                closeIcon: true,
                animation: 'scale',
                type: 'red',
                autoClose: 'cancel|10000',
                escapeKey: 'cancel',
                    
                buttons: {
                    Delete: {
                        btnClass: 'btn-red',
                    
                        action: function() {
                    
                            $.ajax({
                        
                                url:"{{URL('/del-ext-payment')}}",
                        
                                method:"GET",
                                
                                data:{id:id},
                                
                                success: function(data) {
                        
                                    if(data == "1"){
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
</script>

@endpush