@extends('admin_master')  
@section('admin_main_content')
<style>
	.print_page {
		margin:3px;
		padding:7px;
		border:1px solid lightgray;
	}
	.print_page img{
		margin:0 auto;
		padding:0;
		width: 400px;
		height: auto;
	}
	.print_page .com_name{
		margin:0;
		padding:5px 0 0 0;
		text-align:center;
		color: #136734;
		font-size: 25px;
	}
	.print_page p{
		margin:0;
		padding:3px 0;
		text-align:center;
		font-size:15px;
	}
	table {
		width:100%;
		text-align:left;
		margin:0;
		padding:3px 0;
	}
	table td{
		text-align:left;
		font-size:14px;
		padding:5px 0;
	}
	table.table_prc td{
		text-align:right;
	}
	.pr-1 {
		padding-right: 1rem;
	}
</style>
<div class="right_col right_col_back" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">  
                    <div class="x_content"> 
						<div class="no_padding col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12"> 
						
						    <div id="print_page">
						
						        <br/><br/><br/><br/><br/><br/>

                                    <h3 style="text-align: center">BILL</h3><br/>
                                    
                                      <!-- insert your custom barcode setting your data in the GET parameter "data" -->
                                      <img alt='Barcode'
                                           src='https://barcode.tec-it.com/barcode.ashx?data={{ $single_order_info_customer->order_id}}&code=Code93&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=72&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&eclevel=M&dmsize=Default'/>
                                    
                                    <div style='padding-top:8px; text-align:center; font-size:15px; font-family: Source Sans Pro, Arial, sans-serif;'>
                                        <div style="text-align: right; margin-right: 150px;">Billing Date And Time:  {{ $single_order_info_customer->order_created_date.$single_order_info_customer->order_created_time }}</div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <table class="single_order_view_address1">
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>:  &nbsp;</td>
                                                        <td> {{$single_order_info_customer->customer_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                         <td>: &nbsp;</td>
                                                        <td> {{$single_order_info_customer->customer_address }}</td>
                                                    </tr>
                                                     <tr>
                                                        <td>Contact Details  :</td>
                                                         <td>: &nbsp;</td>
                                                        <td> {{$single_order_info_customer->customer_mobile }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sold By</td>
                                                         <td>: &nbsp;</td>
                                                        <td> {{$single_order_info_customer->name }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right">
                                                <table class="single_order_view_address">
                                                    <tr>
                                                        <td>Inv No</td>
                                                         <td>: &nbsp;</td>
                                                        <td> {{$single_order_info_customer->order_id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date</td>
                                                         <td>: &nbsp;</td>
                                                        <td> <?=date('Y-m-d H:i:s'); ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td>Customer ID</td>
                                                         <td>: &nbsp;</td>
                                                        <td> {{$single_order_info_customer->customer_id }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
        						
        								<table class="table_prc" style="border-top:1px solid lightgray;">
        
        									<tr style="background-color: #fbf4f4; border-bottom: 1px solid black; border-top: 1px solid black;">
        										<td class="pr-1"><b>Product ID</b></td>
        										<td class="pr-1"><b>Description</b></td>
        										<td class="pr-1"><b>Pack Size</b></td>
        										<td class="pr-1"><b>Qty</b></td>
        										<td class="pr-1"><b>Price</b></td>
        										<td class="pr-1"><b>S.Total</b></td>
        									</tr>
        
        										
        									@foreach($single_order_info as $order)
        
        										<tr>
        											<td class="pr-1">{{$order->product_id}}</td>
        											<td class="pr-1">{{$order->product_name}}</td>
        											<td class="pr-1">{{$order->pack_size}}</td>
        											<td class="pr-1">{{$order->product_qty}}</td>
        											<td class="pr-1">{{$order->product_sale_price}}</td>
        											<td class="pr-1">{{$order->product_qty*$order->product_sale_price}}</td>
        										</tr>
        
        									@endforeach
        
        									<tr style="border-top:1px solid lightgray;">
        										<?php $order_id=$order->order_id;?>
        										
        										<td colspan="3"><b>Total:</b></td>
        										<td colspan="3"><b>TK. {{$order = DB::table('order')
        											->where('order_id',$order_id)
        											->sum('order_total')
        											}} </b>
        										</td>
        
        									</tr>
        											
        								
        									
        									
        
        									
        
        									
        								
        
        									
        									
        									<?php
        										$order_id = $single_order_info_customer->order_id;
        
        										$data = DB::table('pament_details')->where('order_id', $order_id)->get();
        										$tot_paid = 0;
        										foreach($data as $data){
        											
        											$tot_paid += $data->amount;
        									?> 
        
        									
        									
        									<?php }?>
        
        									<tr style="border-top:1px dotted gray;">
        										
        										<td colspan="3"><b>Total Paid:</b></td>
        										<td colspan="3"><b>TK. <?=$tot_paid;?></b></td>
        									
        									</tr>
        									
        									<tr>
        										
        										<td colspan="3"><b>Discount:</b></td>
        										<td colspan="3"><b><?= $single_order_info_customer->order_discount; ?></b></td>
        									
        									</tr>
        									
        									
        
        									<tr style="border-top:1px dotted gray;">
        										
        										<td colspan="3"><b>Due:</b></td>
        										<td colspan="3"><b>TK. 
        											<?php
        												$result =  ($single_order_info_customer->total_amount_payable) - $tot_paid;
        												echo $result; 
        											?></b>
        										</td>
        									</tr>
        									
        								
        									
        									<?php
        									
        									if($customer_last_payment){
        									 ?>
        									 
                                            
        									<tr style="border-top:1px dotted gray;">
        										<td colspan="3"><b>Last payment:</b></td>
        										<td colspan="3"><b>TK. <?= $customer_last_payment->amount; ?> </b></td>
        									</tr>
        									
        									<tr style="border-top:1px dotted gray;">
        										<td colspan="2"><b>Last payment Date:</b></td>
        										<td colspan="2"><b>TK. <?= $customer_last_payment->created_date; ?> </b></td>
        									</tr>
        									 <?php
        									}
        									
        									?>
        
        
        									<tr style="border-top:1px dotted gray;">
        										<td colspan="4"></td>
        										<td colspan="4"></td>
        									</tr>
        									
        
        									<!--<tr>-->
        									<!--	<td colspan="4" style="text-align: center;">Powered by Muktodhara Technology Limited </td>										-->
        									<!--</tr>-->
        
        								</table>
        								<br/><br/><br/><br/><br/><br/><br/><br/>
        								<table style="width: 150%;">
        								    <tr>
        										<td colspan="4"><hr style="width: 130px;margin-left: 0;border-top: 1px solid #241919;"></td>
        										<td><hr style="width: 90px;margin-left: 0;border-top: 1px solid #241919;"></td>
        									</tr>
        								    
        								    <tr>
        										<td colspan="4" >Customer Signature</td>
        										<td>Authorized By</td>
        									</tr>
        								    
        								</table>
                                							<!--<div class="row">-->
                                							<!-- <div class="col-md-6">-->
                                							      <!--<hr style="width: 49px;margin-left: 0;border-top: 1px solid #241919;">-->
                                							<!-- <div style="">Customer Signature</div>-->
                                							<!--    </div>-->
                                    			            <!-- <div  class="col-md-6">-->
                                    			            <!--<hr style="width:53px;text-align:left; border-top: 1px solid #241919;">-->
                                    		            	<!-- <div style="">Authorized By</div>-->
                                    		            	<!--</div>-->
                                							<!--</div>-->
							</div>
						</div>
							<br>
							<br>
							<div class="col-md-12 text-center">
								{{-- <a class="btn btn-success" href="{{url('/print-order-page/'.$single_order_info_customer->order_id)}}" target="_blank"><i class="fa fa-print"></i> Print</a> --}}
								<button target="_blank" class="btn btn-info print"><i class="fa fa-print"></i> Print</button>
								<button class="btn btn-warning extra_payment" customer_id="{{$single_order_info_customer->customer_id}}" order_id="{{$single_order_info_customer->order_id}}"><i class="fa fa-money"></i> Payment</button>
							</div>

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
                
                    {!!Form::open(['url' => '/add-extra-payment-customer', 'method'=>'post']) !!}
                    
                    <?php
    	$order_id = $single_order_info_customer->order_id;
 $payable_amount = DB::table('order')->where('order_id', $order_id)->sum('total_amount_payable');
 $paid_amount = DB::table('pament_details')->where('order_id', $order_id)->sum('amount');
 $due_amount = $payable_amount - $paid_amount;
?>
                        
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
                            <input id="payment" class="due_payment form-control" name="amount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" type="number"  placeholder="Your Due Amount: <?php echo $due_amount; ?>" required>
                            
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
                        
                        <button type="submit" class="btn btn-primary" id="pay_due">Add Payment</button>
                    {!!Form::close() !!}
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 
    
    <?php
    	$order_id = $single_order_info_customer->order_id;
 $payable_amount = DB::table('order')->where('order_id', $order_id)->sum('total_amount_payable');
 $paid_amount = DB::table('pament_details')->where('order_id', $order_id)->sum('amount');
 $due_amount = $payable_amount - $paid_amount;
?>
@endsection



@push('script')

<script>
    $(document).ready(function() {
        
		$(document).on('click', '.print', function() {

			var prtContent = document.getElementById("print_page");

			var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');

			WinPrint.document.writeln('<html><head><title></title><style>.hide_print_sec {display:none;} table td {padding:0px !important; }</style>');
			WinPrint.document.writeln('<html><head><title></title><style>.print_page { margin:3px;padding:7px;border:1px solid lightgray;} .print_page img{margin:0 auto;padding:0;width: 400px;height: auto;}.print_page .com_name{margin:0;padding:5px 0 0 0;text-align:center;color: #136734;font-size: 25px;}.print_page p{margin:0;padding:3px 0;text-align:center;font-size:15px;}table {width:100%;text-align:left;margin:0;padding:3px 0;}table td{text-align:left;font-size:20px;padding:5px 0;}table.table_prc td{text-align:right;}.pr-1 {padding-right: 1rem;}.print_hide{display:none}</style>');

			WinPrint.document.writeln('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');

			WinPrint.document.writeln('<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> ');

			WinPrint.document.writeln('</head><body style="margin:0 10px;">');

			WinPrint.document.writeln('<br>');

			WinPrint.document.writeln(prtContent.innerHTML);

			WinPrint.document.writeln('</body></html>');
			WinPrint.document.close();
			WinPrint.focus();

		});
		
        $(document).on('click', '.extra_payment', function() {

            var customer_id = $(this).attr('customer_id');

            var order_id = $(this).attr('order_id');

            $('.customer_id').val(customer_id);
            $('.order_id').val(order_id);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.extra_payment_modal').modal();

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
    });
</script>



<script type="text/javascript">


    var javaScriptVar = "<?php echo $due_amount; ?>";
    if(javaScriptVar <= 0){
        // $(".extra_payment").attr("disabled", true);
        $(".extra_payment").hide();
    }
</script>




<script type="text/javascript">


$(document).ready(function(){
    
     
  $(".due_payment").change(function(){
    
    var javaScriptVar = "<?php echo $due_amount; ?>";
    var due_payment = $(".due_payment").val();
    if(Math.round(due_payment) > Math.round(javaScriptVar)){
        
        alert("You have due only " + javaScriptVar +" Tk");
        $("#pay_due").attr("disabled", true);
    } else {
        $("#pay_due").attr("disabled", false);
    }
    
  });
});

    
</script>














@endpush