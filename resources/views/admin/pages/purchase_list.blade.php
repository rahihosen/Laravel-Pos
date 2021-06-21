@extends('admin_master')  
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box_layout col-md-12 col-sm-12 col-xs-12" >

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3><i class="fa fa-money" aria-hidden="true"></i> Purchase List </h3>
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
                        <h3 class="panel-title">Purchase</h3>
                        <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                    </div>

                    <div class="panel-body"> 

                        @if ( $data = count($all_purchase) > 0 )
					
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
                                    <button class="search_purchase_list btn btn-primary btn-sm">Go</button>
                                    
                                    <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                </div>
                                
                            </div>

                            <div id="print_content">
                                
                                <h4 class="bottom_padding">Purchase:</h4>
                                <p class="show_date">Showing All Data</p>
                                
                                <div class="table-responsive">
                                
                                    <table class="table table-striped bulk_action table-responsive table-bordered">                                        
                                        <thead>
                                            <tr class="headings">                                            
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

                                        <tbody class="purchase_list_table">

                                            @foreach ( $all_purchase as $purchase )

                                                <tr class="even pointer">
                                                    <td class="text-center">{{$purchase->purchase_id}}</td>
                                                    <td class="text-center">{{$purchase->purchase_created_date}} / {{$purchase->purchase_created_time}}</td>
                                                    <td class="text-center">{{$purchase->buyer_name}}</td>
                                                    <td class="text-center">{{$purchase->purchase_total}} </td>
                                                    <td class="text-center">{{$purchase->purchase_discount}}</td>
                                                    <td class="text-center">{{$purchase->after_discount}} </td>
                                                    <td class="text-center">{{$purchase->purchase_vat}}% </td>
                                                    <td class="text-center">{{$purchase->total_ammount_payable}} </td>
                                                    <td class="text-center hidden"> 
                                                        <?php
                                                            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');
                                                            echo $data;
                                                        ?> 
                                                    </td>
                                                    <td class="text-center hidden"> 
                                                        <?php

                                                            $result = ($purchase->total_ammount_payable) - $data;

                                                            echo $result;
                                                        ?>
                                                    </td>
                                                    
                                                    <td class="text-center">{{$purchase->purchase_note}} </td>

                                                    <td class="last text-center hide_print_sec hidden">

                                                        <button
                                                            class="btn btn-primary btn-xs add_payment_purchase" 
                                                            amountDuePurchase="{{ $result = ($purchase->total_ammount_payable) - $data }}" 
                                                            value="{{$purchase->purchase_id}}"
                                                            ><i class="fa fa-edit"></i> Add 
                                                        </button>

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
                                                            buyer_id="{{$purchase->buyer_id}}"
                                                            ><i class="glyphicon glyphicon-eye-open"></i> View
                                                        </button>

                                                        <!--<button 
                                                            class="btn btn-danger btn-xs cancel_purchase" 
                                                            value="{{$purchase->purchase_id}}"
                                                            ><i class="glyphicon glyphicon-trash"></i> Cancel
                                                        </button>-->
                                                        <button 
                                                            class="btn btn-danger btn-xs del" 
                                                            value="{{$purchase->purchase_id}}"
                                                            ><i class="fa fa-trash"></i> 
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
                                        <li class="page-item"><a class="page-link" href="{{URL::to('/purchase-list?page=1')}}">First</a> </li>
                                    </ul>
                                        {{ $all_purchase->links() }}
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="{{URL::to('/purchase-list?page='.$all_purchase->lastPage())}}">Last</a> </li>
                                    </ul>
                                @endif
                            </div>

                        @else 
                            <h4 class="text-center">Nothing Found</h4>
                        @endif
                    </div>
                </div>
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
                            
                            <?php $accounts = DB::table('accounts')->get();?>
                                
                            @foreach($accounts as $accounts ) 
                                
                                <option value="<?= $accounts->account_id;?>" ><?= $accounts->account_name;?></option>
                            
                            @endforeach
                                
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


<!-- Modal view Purchase-->
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

                                <div style="padding:0;" class="col-md-4 col-sm-4 col-xs-5 invoice-col">
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

                                <div class="res_no_padding col-md-4 col-sm-4  col-xs-4 invoice-col">

                                    To (Supplier)
                                    <table class="pur_invoic_buyer"></table>
                                </div>

                                <div class="res_no_padding col-md-4 col-sm-4 col-xs-3 invoice-col">

                                    <table class="pur_invoic_pur_order text-right"></table>
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
                                        
                                        <h4 style="padding: 10px 5px;">Last Payment</h4>
                                        <div class="table-responsive">
                                             <table class="table">
                                                <tbody class="pur_invoic_last_pur_pay"></tbody>
                                            </table>
                                        </div>
                    
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
                            <button target="_blank" class="btn btn-info print_purchase_details"><i class="fa fa-print"></i> Print</button>
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
                        <input type="hidden"name="go_to" value="1">
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

@endsection


@push('script')

<script>
    $(document).ready(function() {

        $('.table').on('click', '.del', function() {

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
                        
                                url:"{{URL('/del-purchase')}}",
                        
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

        // Purchasre Payment Modal
        $(document).on('click', '.previous_payment', function() {

            var buyer = $(this).attr('buyer');

            var purchase = $(this).attr('purchase');

            $('.buyer').val(buyer);
            $('.purchase').val(purchase);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.extra_payment_modal').modal();

        });
    });
</script>

@endpush