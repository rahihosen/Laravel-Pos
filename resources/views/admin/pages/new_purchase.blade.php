@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <h3><i class="fa fa-plus" aria-hidden="true"></i> New Purchase </h3>
                    
                </div>

                <?php

                    $message = Session::get('message');

                    if ($message != '') { ?>

                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                            <h5 class="text-center">

                                <?php

                                if (isset($message)) { ?>

                                    <div class="alert alert-success alert-dismissible fade in" 
                                        style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong> <?php echo $message; ?> </strong>

                                    </div>
                                        
                                    <?php
                                    Session::put('message', '');
                                }
                                ?>

                            </h5>
                        </div> 
                            
                        <?php 
                    }

                ?>
            
                {!! Form::open(['url' => '/save-purchase-product', 'method'=>'post']) !!}

                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Purchase Description</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                
                                <div class="no_padding col-md-4 col-sm-4 col-xs-12">
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="select-buyer">Select Supplier:</label>
                                        
                                        <select id="select-buyer" class="form-control" name="buyer_id">
                                        
                                            <?php

                                                foreach ($all_buyers as $all_buyers) { ?>

                                                    <option 
                                                        value="<?= $all_buyers->buyer_id; ?>" ><?= $all_buyers->buyer_name; ?> (<?= $all_buyers->buyer_mobile; ?>)
                                                    </option>
                                                
                                                    <?php

                                                }
                                            ?>
                                            
                                        </select>

                                    </div>
                                </div>
                
                                <div class="res_no_padding right_no_pad col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group-sm">
                                        
                                        <label for="Purchase-note">Purchase Note: </label>
                                        
                                        <input id="Purchase-note" type="text" class="form-control" name="purchase_note" placeholder="Purchase Note" required>
                                        
                                        <br>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Purchase</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body add_product_panel">

                                <div class="no_padding col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1.5em;">
                                    <div class="form-group form-group-sm">
                                    
                                        <button type="button" value="1" class="bill_remove_field btn btn-danger btn-xs" style="padding: 5px 10px 5px 10px;"><i class="fa fa-minus"></i></button>
                                        
                                        <button type="button" value="1" class="bill_add_more_field btn btn-xs btn-primary" style="padding: 5px 10px 5px 10px;"><i class="fa fa-plus"></i></button>
                                    
                                    </div>
                                </div>
                                
                                <div class="text-center no_padding col-md-1 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">
                                        
                                        <label>SL</label>
                                    
                                    </div>
                                </div>
                                
                                <div class="text-center no_padding col-md-3 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">
                                        
                                        <label>Purchase Item</label>
                                    
                                    </div>
                                </div>
                                
                                <div class="text-center col-md-3 col-sm-3 col-xs-12" >
                                    <div class="form-group-sm">
                                        
                                        <label>Purchase Price</label>
                                    
                                    </div>
                                </div>
                                
                                
                                <div class="text-center  col-md-3 col-sm-3 col-xs-12" style="padding-left: 0;">
                                    <div class="form-group-sm">
                                        
                                        <label>Quantity</label>
                                    
                                    </div>
                                </div>
                                
                                <div class="text-center no_padding col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">
                                        
                                        <label>Total</label>
                                    
                                    </div>
                                </div>
                                
                                <!-- This line For Breake using br tag -->
                                <div class="text-center no_padding col-md-12 col-sm-12 col-xs-12">
                                    
                                </div>
                                
                                
                                <div class="no_padding col-md-1 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">
                                    
                                        <input type="text" class="res_marginBT10 form-control increment" value="# 1" disabled>
										
                                        
                                    </div>
                                </div>

                                <div class="content_data">

                                    <div class="no_padding col-md-3 col-sm-2 col-xs-12">

                                        <div class="form-group-sm">

                                            <input type="hidden" class="get_product_id" name="product_id[]" required>

                                            <input type="text" class="res_marginBT10 search_allPros search_input form-control" placeholder="Search..." required>

                                            <div class="search_box" style="display: none;"></div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="res_no_padding col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group-sm">
                                        
                                            <input name="product_purchase_price[]" type="text" title="Numbers Only" class="res_marginBT10 upPurcPrice enable_field form-control text-center" placeholder="Purchase Price" required disabled>

                                            
                                        </div>
                                    </div>
                                    
                                    <div class="no_padding col-md-3 col-sm-3 col-xs-12">

                                        <div class="form-group-sm" style="position: relative;">
                                        
                                            <input type="text" class="res_marginBT10 product_quantity form-control text-center enable_field_que" value="0" name="product_quantity[]" pattern="(^[0-9]{1,11})" title="Numbers Only" placeholder="Product Quantity" required disabled>
                                            
											<div class="form-group form-group-sm" style="position: absolute;top: 1px; width: 58px;right: 0;">
                                        
												<button type="button" value="1" class="qun_remove_field btn btn-danger btn-xs enable_field_que" disabled><i class="fa fa-minus"></i></button><button type="button" value="1" class="qun_add_field btn btn-xs btn-primary enable_field_que" disabled><i class="fa fa-plus"></i></button>
											
											</div>
                                        </div>
                                    </div>
                                    
                                    <div class="no_padding col-md-2 col-sm-2 col-xs-12">
                                        <div class="form-group-sm">
                                        
                                            <input type="text" class="res_marginBT10 upTotalPrice upTotalPrice_1 form-control text-center" value="0" placeholder="Total" disabled>
                                            
                                            <input type="hidden" name="order_total_price[]" class="upTotalPrice" required>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <span class="field_to_add_before"></span>
                                
                                <div class="no_padding col-md-12 col-sm-12 col-xs-12">
                                    <hr>
                                </div>
                                
                                
                                
                                <div class="no_padding col-md-7 col-sm-7 col-xs-12">
                                    <div class="form-group form-group-sm">
                                    
                                        <h4>Inportant Notes:</h4>
                                        <br>
                                        
                                        <p>
                                            <i class="fa fa-check"></i> Once Invoice Issued Can Not Be Changed.<br>
                                        </p>
                                    </div>
                                </div>				
                                
                                
                                <div class="no_padding col-md-5 col-sm-5 col-xs-12">
                                    <div class="form-group-sm text-center">
                                    
                                        <label>Sub Total</label>
                                        
                                        <input type="text" class="sub_total form-control text-center" value="0" placeholder="Sub Total" disabled> 
                                        
                                        <input type="hidden" name="purchase_total" class="sub_total" required>
                                        
                                        <br>
                                    </div>
                                    
                                    
                                    <div class="form-group-sm text-center" style="position:relative;">
                                    
                                        <label>Discount</label>
                                        
                                        <input type="text" class="total_discount form-control text-center" value="0" name="purchase_discount" pattern="(^[0-9]{1,11})" title="Numbers Only" placeholder="Discount" required disabled>
										
										<select name="purchase_discount_type" class="purchase_discount_type form-control" disabled>
											
											<option value="1">৳</option>
											<option value="2">%</option>
											
										</select>
                                        <br>
                                    </div>

                                    <div class="form-group-sm text-center">
                                    
                                        <label>After Discount</label>
                                        
                                        <input type="text" class="after_discount form-control text-center" value="0"  pattern="(^[0-9]{1,11})" title="Numbers Only" placeholder="After Discount" required disabled>

                                        <input type="hidden" class="after_discount" name="after_discount">
                                        <br>
                                    </div>
                                    
                                    <div class="form-group-sm text-center">
                                    
                                        <label>Vat</label>
                                        

                                        <select id="" name="purchase_vat" class="total_vat form-control text-center"  disabled>                                                

                                            <?php $vat = DB::table('vat')->where('vat_status', 1)->get(); ?>

                                            @foreach ( $vat as $vat )

                                                <option value="{{$vat->vat_amount }}">{{ $vat->vat_name }}</option>

                                            @endforeach
                                        </select>
                                        <br>
                                    </div>
                                    
                                    <div class="form-group-sm text-center">
                                    
                                        <label>Ammount Payable</label>
                                        
                                        <input type="text" class="ammount_payable form-control text-center" value="0" placeholder="Ammount Payable" disabled> 
                                        
                                        <input type="hidden" name="total_ammount_payable" class="ammount_payable">
                                        
                                        <br>
                                    </div>
                                    
                                    <div class="form-group-sm text-center">
                                        <label>Transportation Cost</label>
                                        <input type="text" class="form-control text-center" name="transport" value="0" placeholder="0.00"> 
                                        <br>
                                    </div>
                                    
                                </div>
                                
                                <div class="no_padding col-md-12 col-sm-12 col-xs-12">
                                    
                                    <h3>Payment</h3>

                                    <hr>

                                    <div class="text-center no_padding col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">
                                            
                                            <label for="income-accounts">Select Account</label>
                                            
                                            <select id="income-accounts" class="form-control active" name="payment_account_id">
                                                
                                                <?php

                                                    foreach ($all_accounts as $all_accounts) { ?>

                                                        <option value="<?= $all_accounts->account_id; ?>"><?= $all_accounts->account_name; ?> </option>
                                                
                                                        <?php 
                                                    }
                                                ?>
                                                
                                            </select>
                                            <br>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">
                                            
                                            <label for="income-check">Cheque No.</label>
                                            
                                            <input id="income-check" type="text" class="form-control" name="payment_check_no" placeholder="Cheque No." >
                                            <br>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center no_padding col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">
                                            
                                            <label for="income-transaction">Receipt / Transaction No.</label>
                                            
                                            <input id="income-transaction" type="text" class="form-control" name="payment_transaction_no" placeholder="Receipt / Transaction No.">
                                            <br>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center no_padding col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">
                                            
                                            <label for="income-ammount">Ammount</label>
                                            
                                            <input pattern="[0-9]+([\.,][0-9]+)?" min="0" step="0.01" title="Numbers Only" id="income-ammount" type="number" class="form-control payment_ammount_max" name="payment_ammount" placeholder="Ammount" required>
                                            
                                            <br>
											
                                        </div>
                                    </div>
                                    
                                    <div class="text-center right_no_pad col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group-sm">
                                            
                                            <label for="income-note">Note</label>
                                            
                                            <input id="income-note" type="text" class="form-control" name="payment_note" placeholder="Note">
                                            
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="text-center box_layout col-md-12 col-sm-12 col-xs-12">
		
                        <button type="submit" class="btn btn-primary sub_btn" disabled>Create</button>
                        
                    </div>

                {!! Form::close() !!}  

            </div>
        </div>
    </div>


   


@endsection