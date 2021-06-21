@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Income Statement </h3>
                        
                    </div>

                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-body">

                                <form action="{{route('statement-search')}}" method="get">
									<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
										<div class="marginBT10 form-group-sm">
										   
											<input type="text" class=" datepicker form-control" name="date_from" value="@if(isset($_GET['date_from'])){{$_GET['date_from']}}@else{{date('Y-m-d')}}@endif">
										</div>
										
									</div>
									
									<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
										<div class="marginBT10 form-group-sm">
											<input type="text" class=" datepicker form-control" name="date_to" value="@if(isset($_GET['date_to'])){{$_GET['date_to']}}@else{{date('Y-m-d')}}@endif">
										</div>
										
									</div>
									
									
									<div class="col-md-4 col-sm-4 col-xs-12">					
										<div class="marginBT10 form-group-sm">
											<button type="submit" class="btn btn-primary btn-sm">Go</button>
											{{--<button type="submit" class="search_statement btn btn-primary btn-sm">Go</button>--}}
											
											<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
										</div>
									</div>
								</form>
									<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 no_padding" id="print_content">
										<br>
										<h4 class="text-center"><b>Income Statement</b></h4>
										<br>
										<p class="search_term">
										    @if(isset($_GET['date_to'])) <b>Showing Data </b> (  {{$_GET['date_from']}} to  {{$_GET['date_to']}} ) @else  Showing Lifetime Data @endif
										   </p>
										<div class="table-responsive">                                    

											<table class="inc_stsmnt_tbl table table-striped bulk_action table-responsive table-bordered">
													
												<thead>
													<tr class="headings">
														<th class="column-title text-center">Particulars</th>
														<th class="column-title text-center">Taka</th>
														<th class="column-title text-center">Taka</th>
														<th class="column-title text-center">Taka</th>
													</tr>
												</thead>

												<tbody class="search_res">
													
													<tr>
														<th colspan="4">Revenue</th>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sales</td>
														<td></td>
														<td class="text-right">{{$total_order->ot}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(-)Sales Discount </td>
														<td></td>
														<td class="text-right">{{ round(($total_order->ot - $total_order->ad),2)}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(+)Vat</td>
														<td></td>
														<td class="text-right">{{round(($total_order->tap  - $total_order->ad),2)}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td style="text-align:right; font-weight:bold">Total Sales</td>
														<td></td>
														<td></td>
														<td class="text-right">{{$total_order->tap}}</td>
													</tr>
													
													<tr>
														<th colspan="4">Cost of goods Sold</th>
													</tr>
													@if(isset($total_purchase_bal) && isset($total_wast_bal))
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Primary Inventory</td>
														<td></td>
														<td class="text-right">{{ (($total_purchase_bal->tap + $total_purchase_bal->trns) - $total_wast_bal->pw) }}</td>
														<td></td>
													</tr>
													@endif
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Purchase</td>
														<td></td>
														<td class="text-right">{{$total_purchase->ot}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(-)Purchase Discount </td>
														<td></td>
														<td class="text-right">{{ round(($total_purchase->ot - $total_purchase->ad),2)}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(-)Wastage Products </td>
														<td></td>
														<td class="text-right">{{ round(($total_wast->pw),2)}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(+)Purchase Transportation</td>
														<td></td>
														<td class="text-right">{{$total_purchase->trns}}</td>
														<td></td>
													</tr>
													
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(+)Vat</td>
														<td></td>
														<td class="text-right">{{round(($total_purchase->tap  - $total_purchase->ad),2)}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td style="text-align:right; font-weight:bold">Total Cost of Goods Sold</td>
														<td></td>
														<td></td>
														<td class="text-right">{{ (($total_purchase->tap + $total_purchase->trns) - $total_wast->pw) }}</td>
													</tr>
													
													<tr>
														<th colspan="4">Administrative Cost</th>
													</tr>
													
													<?php 
													
													$exp_sum = 0;
													
													foreach($total_expense as $total_expense){
														
														$exp_sum += $total_expense->exp_amnt;
														
													?>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$total_expense->head_name}}</td>
														<td class="text-right">{{$total_expense->exp_amnt}}</td>
														<td></td>
														<td></td>
													</tr>
													
													<?php }?>
													
													<tr>
														<td style="text-align:right; font-weight:bold">Total Administration Cost</td>
														<td></td>
														<td class="text-right">{{$exp_sum}}</td>
														<td></td>
													</tr>
													
													<tr>
														<td style="text-align:right; font-weight:bold">Total Cost</td>
														<td></td>
														<td></td>
														<td class="text-right">{{$exp_sum + (($total_purchase->tap + $total_purchase->trns) - $total_wast->pw) }}</td>
													</tr>
													
													<tr class="total_border">
													
													<?php
													
														$income = $total_order->tap - (($total_purchase->tap + $total_purchase->trns) - $total_wast->pw) - $exp_sum;
														
														$inc_loss = '';
														
														if($income >= 0){
															
															$inc_loss = 'Income';
															
														}else{
															$inc_loss = 'Loss';
														}
														
													?>
													
														<th class="text-right">Net {{$inc_loss}}</th>
														<th class="text-right"></th>
														<th class="text-right"></th>
														<th class="text-right">{{abs($income)}}</th>
													</tr>
													
												</tbody>
												
											</table>
											
										</div>
										
										<br>
										<br>
										<br>
										<br>
										<br>
									
									</div>
									

								<div class="clearfix"></div>
								
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection