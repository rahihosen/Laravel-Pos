 @extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    @if (count($errors) > 0)

                        <div class="alert alert-danger alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    <li>Your Image Size is too big.</li>
                                    <li>Maximum Image Size 2MB</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-users"></i> Customer </h3>

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

                    <div class="res_no_padding no_padding right_padding col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-amin">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add Customer</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                {!! Form::open(['url' => '/save-customer','method'=>'post','enctype'=>'multipart/form-data']) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label for="Customer-name">Customer Name </label>
                                        <input type="text" id="Customer-name" placeholder="Name" name="customer_name" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="cus-Mobile">Customer Mobile </label>
										
                                        <input type="text" placeholder="Mobile" id="cus-Mobile" name="customer_mobile" class="form-control col-md-7 col-xs-12" required>
                                        
                                    </div>
                                    

                                    <div class="form-group form-group-sm">

                                        <label for="cus-Mobile">Customer Address </label>
										
                                        <input type="text" placeholder="Address" id="cus-address" name="customer_address" class="form-control col-md-7 col-xs-12" required>
                                        
                                    </div>
                                    
                                    <div class="form-group form-group-sm">
                                        <label style="padding-top: 10px;" for="prev-due">Previous Due</label>
                                        <input type="text" placeholder="Previous Due" id="prev-due" name="prev_due" class="form-control">
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
                                <h3 class="panel-title">Customer List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>
                            <div class="panel-body">

                                @if ( $data = count($all_customer_info) > 0 ) 
								
                                    <input type="text" class="search_customer form-control" placeholder="Search..." style="border-color: #023264;border-radius: 3px;">                                    
                                    <br>
                                    <p class="search_key" type="hidden"></p>                                
                                    <div class="table-responsive">
                                        <table class="table table-striped bulk_action table-responsive table-bordered">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="text-center">ID </th>
                                                    <th class="text-center">Name </th>
                                                    <th class="text-center">Mobile </th>
                                                    <th class="text-center">Group </th>
                                                    <th class="text-center">Address </th>
                                                    <th class="text-center">Previous Due</th>                                                    
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody class="search_results">
                                                @foreach($all_customer_info as $customer)
                                                    <tr class="even pointer">
                                                        <td class="text-center">{{$customer->customer_id}}</td>
                                                        <td class="text-center">{{$customer->customer_name}}</td>
                                                        <td class="text-center">{{$customer->customer_mobile}}</td>
                                                        <td class="text-center">{{$customer->group_name}}</td>
                                                         <td class="text-center">{{$customer->customer_address}}</td>
                                                        <td class="text-center">{{$customer->prev_due}}</td>                                                       
                                                        <td class="text-center">                                                        
                                                            <button 
                                                                class="btn btn-dark btn-xs edit_customer"
                                                                value="{{$customer->customer_id}}"
                                                                customerName="{{$customer->customer_name}}"
                                                                customerMobile="{{$customer->customer_mobile}}"
                                                                customerEmail="{{$customer->customer_email}}"
                                                                credit_limit="{{$customer->credit_limit}}"
                                                                customerNid="{{$customer->customer_nid}}"
                                                                customerGroupId="{{$customer->customer_group_id}}"
                                                                customerGroupName="{{$customer->group_name}}"                                                                
                                                                ><i class="far fa-edit"></i> Edit                                                            
                                                            </button>
                                                            <button 
                                                                class="btn btn-info btn-xs view_customer" 
                                                                customerNid="{{$customer->customer_nid}}" 
                                                                customerName="{{$customer->customer_name}}" 
                                                                customerMobile="{{$customer->customer_mobile}}" 
                                                                customerGroupName="{{$customer->group_name}}"
                                                                customerPreviousDue="{{$customer->credit_limit}}" 
                                                                value="{{$customer->customer_id}}"                                                                 
                                                                ><i class="far fa-eye"></i> Report                                                                
                                                            </button>                                                                                                                        
                                                            <button 
                                                                class="btn btn-warning btn-xs cust_payment" 
                                                                value="{{$customer->customer_id}}"                                                                 
                                                                ><i class="fa fa-money"></i> Payment
                                                            </button>                                                            
                                                            <button 
                                                                class="btn btn-warning btn-xs extra_payment" customer_id="{{$customer->customer_id}}" order_id="0"                                                                                                                                
                                                                ><i class="fa fa-plus"></i> Add Payment
                                                            </button>                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            
                                    <div class="pagi_box pull-right">
                                        @if ( $all_customer_info != '') 
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="{{URL::to('/customer-list?page=1')}}">First</a> </li>
                                            </ul>
                                                {{ $all_customer_info->links() }}
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="{{URL::to('/customer-list?page='.$all_customer_info->lastPage())}}">Last</a> </li>
                                            </ul>
                                        @endif
                                    </div>

                                @else

                                    <h4 class="text-center">Nothing Found...</h4>

                                @endif
								
								<div class="clearfix"></div>
								
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Extra Payment Customer --}}
    <div style="z-index:9999999999" class="modal fade extra_payment_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-extra-payment-customer-2', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">
                            <input type="hidden" class="customer_id" name="customer_id">
                            <input type="hidden" class="order_id" name="order_id">
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

    <!-- /page content -->

    <!-- Edit Customer Modal -->
    <div style="z-index:9999999999" class="modal fade edit_customer_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Edit Customer <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-customer','method'=>'post','enctype'=>'multipart/form-data','name'=>'edit_customer'])!!}

                        <div class="form-group form-group-sm">
						
                            <label>ID</label>
							
                            <input type="text" class="form-control customer_id" value="" disabled>
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="c-name">Customer Name </label>
                            <input type="text" id="c-name" placeholder="Customer Name" name="customer_name"  class="form-control customer_name" required>
							
                            <input type="hidden" name="customer_id" value="" class="form-control customer_id">
                            
                        </div>
                        
                        <div class="form-group form-group-sm">

                            <label for="mbl">Customer Mobile </label>
							
                            <input type="text" id="mbl" placeholder="Customer Mobile" name="customer_mobile" class="form-control customer_mobile">
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="mail">Customer Email </label>
                            <input type="text" id="mail" placeholder="Customer E-mail" name="customer_email" class="form-control customer_email">
                            
                        </div>
						
						
						<div class="form-group form-group-sm">

                            <label for="Customer-nid">Customer NID</label>
                            
							<input type="text" placeholder="Customer NID" id="Customer-nid" name="customer_nid" class="form-control customer_nid">
							
						</div>
                        
                        <div class="form-group form-group-sm">

                            <label for="cgrp">Customer Group </label>
							
                            <select name="customer_group_id" id="cgrp" class="form-control" required>
                                    
                                <option class="customer_group_id" value="" ></option>
								
                                <?php $cusromer_group = DB::table('customer_group')->get();?>

                                @foreach($cusromer_group as $cusromer_group ) 
                                    
                                    <option value="<?= $cusromer_group->group_id;?>"><?= $cusromer_group->group_name;?></option>
                                
                                @endforeach
                                
                            </select>
                            
                        </div>    
						
						<div class="form-group form-group-sm">

							<label style="padding-top: 10px;" for="cr-limit">Previous Due</label>
							
							<input type="text" placeholder="Previous Due" id="cr-limit" name="credit_limit" class="credit_limit form-control">
							
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
                    <h4 class="modal-title">View Customer's Orders <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body" id="customer_details">
				
					<h4 class="cus_detail"><h4>
						
					<h4 class="bottom_padding top_padding">All Orders</h4>
                
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
                                    <th class="text-center"> Previous Due</th>
                                    <th class="text-center"> Amount Payable</th>
                                    <th class="text-center hidden"> Paid</th>
                                    <th class="text-center hidden"> Due</th>
                                    <th class="text-center hide_print_sec hidden"> Payment</th>
                                    <th class="text-center hide_print_sec"> Payment</th>
                                </tr>
                            </thead>
                            <tbody class="return_product">
                                
								
                            </tbody>
                        </table>
                        
                        
                    </div> 

                </div>
                <button class="btn btn-warning previous_due_payment hide_print_sec"><i class="fa fa-money"></i> Payment Privous Due</button>
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
                    <h4 class="modal-title">View Customer's Due Orders <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body" id="print_content">
					
					<h4 class="cus_detail"><h4>
					
					<h4 class="bottom_padding top_padding">All Dues</h4>
                
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
                                    <th class="text-center"> Paid</th>
                                    <th class="text-center"> Due</th>
                                    <th class="text-center hide_print_sec"> Payment</th>
                                    <th class="text-center hide_print_sec"> Action</th>
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


    
    <!-- Modal Add due Payment-->
    <div style="z-index:9999999999" class="modal fade add_payment_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-payment-customer', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">

                            <input type="hidden" name="order_id" class="order_id" value="">
							
                            <label>Due:</label>
							
                            <input type="text" class="amount form-control" value="" disabled>
							
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
								
                                <?php $accounts = DB::table('accounts')->get();?>
                                
                                @foreach($accounts as $accounts )
									
									<option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
								
								@endforeach
								
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


    <!-- Modal view Payment-->
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

    
    <!-- Modal prescription -->
    <div style="z-index:9999999999" class="modal fade add_prescription_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Add Prescription <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-prescription', 'method'=>'post','enctype'=>'multipart/form-data']) !!}
                        
                        <div class="form-group form-group-sm">

                            <input type="hidden" name="customer_id" class="customer_id" value="">
							
                        </div>
						
						
						<div class="form-group form-group-sm">

							<label for="image">Image </label>
							
							<input type="file" id="image" name="prescription_image" class="form-control prescription_image" required>

							<div><br></div>
							
						</div> 
						
                        
                        <button type="submit" class="btn btn-primary">Add</button>
						
                    {!!Form::close() !!}
					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 


    <!-- Modal view prescription-->
    <div style="z-index:9999999999" class="modal fade view_prescription_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">View Prescription <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Prescription</th>
                                    <th class="text-center">Created By</th>
                                </tr>
                            </thead>
                            <tbody class="return_pres">
							
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
    	
    {{-- Modal view extra payment --}}
    <div class="modal fade view_extra_payment_modal" id="" role="dialog">
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
    
    
    
    
    
    
    
    //privous Due payment modal
    
    
    <div style="z-index:9999999999" class="modal fade previousDue_payment_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/previous_due_payment', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">
                            
                            <input type="hidden" class="customer_id" name="customer_id">
                            <input type="hidden" class="customer_id" >
                        </div>
                        
                      

                      

                        <div class="form-group form-group-sm">
                            
                        
                            <label for="payment">Payment Amount:</label>
                            <input id="payment" class="due_payment form-control" name="prev_due" type="number"  placeholder="Payment" required>
                            
                        </div>

                       

                        
                       
                        
                        <button type="submit" class="btn btn-primary">Payment</button>
                    {!!Form::close() !!}
                        
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
        
        $(document).on('click', '.extra_payment', function() {

            var customer_id = $(this).attr('customer_id');

            var order_id = $(this).attr('order_id');

            $('.customer_id').val(customer_id);
            $('.order_id').val(order_id);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.extra_payment_modal').modal();

        });

        $(document).on('click', '.cust_payment', function() {

            var customer_id = $(this).val();

            $(".throw_extra_payment").html();

            $('.throw_extra_payment').html("<h1 style='text-align:center;color:gray; padding:20px 0;'><i class='fa fa-spinner fa-spin'></i></h1>");

            $.ajax({

                url: "{{URL('/view-extra-payment-customer')}}",

                method: "GET",

                data: {
                    customer_id: customer_id
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
                        
                                url:"{{URL('/del-ext-payment-cus')}}",
                        
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


<script>
    $(document).ready(function() {
        
        $(document).on('click', '.previous_due_payment', function() {

            var customer_id =  $('.customer_id').val();

            // var order_id = $(this).attr('order_id');

            $('.customer_id').val(customer_id);
            // $('.order_id').val(order_id);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.previousDue_payment_modal').modal();

        });

       
    });
</script>


































@endpush