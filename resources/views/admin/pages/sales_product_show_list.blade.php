
@extends('admin_master')  
@section('admin_main_content')
<!-- page content -->

<div class="right_col right_col_back" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="box_layout col-md-12 col-sm-12 col-xs-12">
					<h3 class="no_padding"><i class="fa fa-plus"></i> Invoice</h3>
				</div>
				<?php 
					$message = Session::get('message');
					if ( $message !='') { ?>
						<div class="no_padding col-md-12 col-sm-12 col-xs-12">
							<h5 class="text-center">
								<?php
									if(isset($message)) { ?>
										<div class="alert alert-success alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong> <?php echo $message;?> </strong>
										</div>
								<?php Session::put('message',''); } ?>
							</h5>
						</div> 
						<?php  } ?>
				
				<?php 
					$message = Session::get('error');

					if ( $message !='') { ?>

						<div class="no_padding col-md-12 col-sm-12 col-xs-12">

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
                <div class="x_panel">   				
                    <div class="x_content">						
						<div class="no_padding col-lg-12 col-md-12 col-sm-7 col-xs-12 payment_board" >
							<div style="padding:10px 0 10px 15px;" class="res_marginTP15 res_no_padding" id="cart_details">												
                                {!!Form::open(['url'=>'/save-order','method'=>'post'])!!}
								<tr style="padding-top: 25px;">
											<div class="btn-group btn-group-toggle col-md-12 col-sm-12 text-center" data-toggle="buttons">
												<label>Coustomer Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
											
												<label for="cus_1"><input id="cus_1" type="radio" class="check_cust" name="default_customer" value="1" checked> Default &nbsp;&nbsp;</label>
												
												<label for="cus_2"><input id="cus_2" type="radio" class="check_cust" name="default_customer" value="2"> Add Customer &nbsp;&nbsp;</label>

												<label for="cus_3"><input id="cus_3" type="radio" class="check_cust" name="default_customer" value="3"> Exist Customer </label>                     
											
											</div>

											<div><br></div>
							
											<div style="display:none;" class="collapse_hide form-group-sm">											
												<label for="Name">Customer Name:</label>
												<input type="text" name="customer_names" class="form-control" placeholder="Name" id="Name">												
												<br>
												<label for="Mobile">Customer Mobile:</label>
												<input type="text" name="customer_mobile" class="form-control" placeholder="Mobile" id="Mobile">												
												<br>
												<label for="address">Address</label>
												<input type="text" name="customer_address" class="form-control" placeholder="Address" id="customer_address">
												<br>
												<label for="privous due">previous Due</label>												
												<input type="text" id="prev_due" name="prev_due" placeholder="Previous Due" class="form-control">												
												<br>												
																						
											</div>											
											<br>
											<div style="display:none;" class="collapse_hide_exist">
												<label for="exist_cus">Customer:</label>												
												<select id="exist_cus" name="customer_name" class="form-control selectpicker" data-live-search="true" >												
													<option value="1" disabled selected style="margin-bottom: 20px;"><b>Away Customer (Default Customer)</b></option>
													@php
														$customer = DB::table('customer')->where('customer_id', '!=', 0 )->get();
													@endphp
													@foreach ($customer as $customer)												
														<b><option value="{{$customer->customer_id }}" style="font-weight: 539!important;">{{ $customer->customer_name}}&nbsp&nbsp {{ $customer->customer_address  }}</option></b>
													@endforeach
												</select>
												<br>
											</div>
										</tr>                                
								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12 col-md-12 col-sm-3 col-xs-12" style="background:#e1e1e1;height:245px;overflow-y:hidden;">
											<h4 class="show_pro_small_cat" style="padding:7px;text-align:center;margin:10px 0 0 0;">Brand Name</h4>							
											<input type="text" class="search_sales_pro form-control" placeholder="Search..." style="margin:10px 0;">  
											
											<div class="table-responsive show_pro_all">	
											<?php foreach($all_product_info as $products) { ?>
                                                <?php  $pid = $products->product_id; 
        											$total = DB::table('stock')->where('product_id', $pid)->sum('stock_quantity');
        											$total2 = DB::table('wastage')->where('product_id', $pid)->sum('wastage_quantity');
        											$result = ($total - $total2);
        											if($result > 0 ){
        												
        										?>  
                                                    <div class="col-md-3 col-sm-12 col-xs-6 product_block text-center">                                        
														<!--<a style="cursor:pointer;position:relative;" class="add_cart" data-productid="{{$products->product_id}}">-->
														<!--	<img src="{{$products->product_image}}" class="img-thumbnail" style="height:70px; width:100px;"/>-->
														<!--	<span class="type_name_show">{{$products->type_name}}</span>-->
														<!--</a>										-->
														<!--<br>                                        -->
														<h6 style="padding:5px 0 0 0;margin:0;" class="hover_css">
															<a style="cursor:pointer;" class="add_cart" data-productid="{{$products->product_id}}">
																{{strlen($products->product_name) > 50 ? substr($products->product_name,0,50)."..." : $products->product_name}}
															</a>
														</h6>	
														<div style="padding:5px 0 0 0;margin:0;">
														pack size:	{{$products->pack_size}}
														</div>	
														
														<div class="purchase_prc_div">										
															<label>P. Prc:</label>
															@php
																$purchase_prc = DB::table('purchase_details')->where('product_id',$products->product_id)->get();
															@endphp
															<select class="pro_prc_select pur_pro_id_{{$products->product_id}}">																							
															<?php 											
															$pages_printed = array();											
															foreach($purchase_prc as $purchase_prc){												
																$pprice = $purchase_prc->product_purchase_price.'';												
																if (!isset($pages_printed[$pprice])) {
																	$pages_printed[$pprice] = true;											
															?>
																<option value="{{$pprice}}">{{$pprice}}</option>												
															<?php }} ?>												
																<option value="0">0.00</option>
															</select>											
															<p>
																<b>In Stock:</b> 											
															<?php 
																$total = DB::table('stock')->where('product_id', $products->product_id)->sum('stock_quantity');												
																$total2 = DB::table('wastage')->where('product_id', $products->product_id)->sum('wastage_quantity');
																$total3 = DB::table('order_details')->where('product_id', $products->product_id)->where('order_details_status', 1)->sum('product_qty');												
																$result = ($total - $total2 - $total3);
																echo $result;
															?>										
															</p>
														</div>
													</div>
                                                 
                                                <?php  }
        										
        										} ?>
											</div>
										</div>
									</div>
									<div class="col-lg-6" style="background:#e1e1e1;">
											<?php 
										$data=Cart::content();
									?>
									<div class="table-responsive" style="margin: 10px 0 0 0;">
										<table id="cart" class="table table-responsive">
											<thead >
												<tr class="text-center" style="background:#023264;color:#fff;">
													<!--<th class="text-center">Image</th>-->
													<th class="text-center">Brand Name</th>
													<th class="text-center">P.Prc</th>
													<th class="text-center">S.Prc</th>
													<th class="text-center">Quantity</th> 
													<th class="text-center">Total</th>
													<th class="text-center">Del</th>
													

												</tr>
											</thead>																	
											<tbody class="cart_list_table">												
												@if(Cart::count() != "0")												
													@foreach($data as $products)
														<tr class="rem_row_{{$products->rowId}}">
															<!--<td>
															<!--	<img src="{{$products->options['image']}}" alt="Product Image" width="50px" height='40px'/>-->
															<!--</td>-->-->
															<td><h5>{{$products->name}}</h5></td>
															<td>{{$products->options['purchase_prc']}}</td>
															<td class="q_input_fields">
																<input style="margin-left: 0px;" type="text" data-rID="{{$products->rowId}}" value="{{$products->price}}" class="sell_input sell_p_{{$products->rowId}}">															
															</td>
															<td>
																<div style="width:95px;" class="q_input_fields">
																	<input style="margin-left: 30px;" value="{{$products->qty}}" class="product_id_{{$products->rowId}} q_input" type="text" data-rID="{{$products->rowId}}" data-prc="{{$products->price}}">																
																</div>
															</td>														
															<td class="shwTotal_{{$products->rowId}} text-center">{{$products->price*$products->qty}}</td>
															<td class="actions">	
																<button type="button" onclick="removeFunction('<?php echo $products->rowId; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
															</td>
														</tr>
													@endforeach
												@else
													<tr>
														<td colspan="6">
															<h2>Cart is Empty!</h2>
														</td>
													</tr>
												@endif   											
											</tbody>
										</table>								
									</div>
									</div>									
								</div>																																	  							
                                    <div class="col-lg-6 col-md-offset-6 calc">
										<table class="table ">
										  										                        
                                        <tr>
                                            <td colspan="5">
                                                <h3 data-total-dis="{{Cart::total()}}" class="get_total_for_dis text-right">Total TK.  {{Cart::total()}}</h3>
                                            </td>
										</tr>
																				
										

                                        <tr colspan="">
                                            <td style="text-align:right;"><b>Discount:</b>
											</td>
											<td class="form-group-sm" style="position:relative;">
											
                                                <input type="text" pattern="^(0|[1-9][0-9]*)$" title="Numbers only" value="0" class="discount_input form-control" name="order_discount" required>
												
												<select name="order_discount_type" class="order_discount_type form-control">
													
													<option value="1">???</option>
													<option value="2">%</option>
													
                                                </select>
												
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:right;"><b>After Discount: </b>
											</td>
											<td class="form-group-sm">
                                                <input type="text" class="after_discount_input form-control" disabled>
                                                <input type="hidden" name="after_discount" class="after_discount_input form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            {{-- <td style="text-align:right;"><b>Vat: </b>
											</td> --}}
											<td class="form-group-sm " style="display: none;">
                                                <select id="" name="order_vat" class="vat_input form-control">                                                

                                                    <?php  $vat = DB::table('vat')->where('vat_status', 1)->get(); ?>

                                                    @foreach ( $vat as $vat )

                                                        <option value="{{$vat->vat_amount }}">{{ $vat->vat_name }}</option>

                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            {{-- <td style="text-align:right;"><b>Net Total: </b>
											</td> --}}
											<td class="form-group-sm" style="display: none;">
                                                <input type="text" class="after_vat_input form-control" disabled>
                                                <input type="hidden" name="total_amount_payable" class="after_vat_input form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:right;"><b>Ammount Received: </b>
											</td>
											<td class="form-group-sm">
                                                <input type="text" pattern="(^[0-9]{1,11})+(\.[0-9]{0,2})?" title="Numbers only" name="amount_received" placeholder="Ammount Received" class="ammount_received form-control" required>
                                            </td>
                                        </tr>
										
										<tr>
                                            {{-- <td style="text-align:right;"><b>Transaction No: </b>
											</td> --}}
											<td class="form-group-sm" style="display: none;">
                                                <input type="text" name="transaction_no" placeholder="Transaction No" class="form-control">
                                            </td>
                                        </tr>
										
                                        <tr>
                                            <td style="text-align:right;"><b>Select Account: </b>
											</td>
											<td class="form-group-sm" >
                                                <select class='form-control' name="account_id" required>
                                            
													<?php 
														$accounts = DB::table('accounts')->get();
														foreach($accounts as $accounts ) {  ?>
														
														<option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
													
													<?php } ?>
													
												</select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:right;"><b>Ammount Return: </b>
											</td>
											<td class="form-group-sm">
                                            <input type="text" placeholder="Ammount Return" class="ammount_return form-control" disabled>
                                            <input name="amount_return" type="hidden" class="ammount_return form-control"></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align:right;"><b>Due: </b>
											</td>
											<td class="form-group-sm">
												<input type="text" placeholder="Due" class="ammount_due form-control" disabled>
												<input name="amount_due" type="hidden" class="ammount_due form-control">
											</td>
                                        </tr>

                                    </table>
									</div>                                   									                               		 
                                    <br>
                                    <div style="margin:0 auto; width:212px;" >
                                        <button type="submit" name="save_or_print" value="1" id="pc" class="btn btn-primary">Save Order</button>
                                        <button type="submit" name="save_or_print" value="2" id="pc1"  class="btn btn-success">Save & Print</button>
                                    </div>
                                {!!Form::close()!!}
                                <br>
                                {!!Form::open(['url'=>'/destoryCart','method'=>'POST'])!!}
                                    <button type="submit" style="margin:0 auto; width:100px;" class="btn btn-block btn-danger">Clear All</button> 
                                {!!Form::close()!!}								
                            </div>
                        </div>                                              
                    </div>
                </div>
            </div>           
        </div>
    </div>
</div>

<script>
    function search_cat(e){
        var v=$(e).val().toLowerCase();
        $(".search_cat").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(v) > -1)
        })
    }
</script>


<script>
$(document).ready(function(){
    
     
  $("#pc").hover(function(){
    var cus = $('.check_cust:checked').val();
    var due = $(".ammount_due").val();
    if(cus == 1 && due > 0 ){
       alert("Default Customer Can Not Have Due Please check Your Customer");
        $("#pc").attr("disabled", true);
        $("#pc1").attr("disabled", true);
    }else{
         $("#pc").attr("disabled", false);
          $("#pc1").attr("disabled", false);
    }
    
    
    
  });
});
</script>



















@endsection