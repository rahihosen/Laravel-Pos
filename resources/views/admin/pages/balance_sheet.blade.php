@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Balance Sheet </h3>
                        
                    </div>

                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-amin">

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
									
									
									<div class="col-md-4 col-sm-4 col-xs-12">					
										<div class="marginBT10 form-group-sm">
											<button class="search_sheet btn btn-primary btn-sm">Go</button>
											
											<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
										</div>
										
									</div>
								
									<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 no_padding" id="print_content">
										<br>
										<h4 class="text-center"><b>Balance Sheet</b></h4>
										<br>
										<p class="search_term">Showing Lifetime Data</p>
										<div class="table-responsive">                                    

											<table class="inc_stsmnt_tbl table table-striped bulk_action table-responsive table-bordered">
													
												<thead>
													<tr class="headings">
														<th class="column-title text-center">Particulars</th>
														<th class="column-title text-center">Taka</th>
													</tr>
												</thead>

												<tbody class="search_res">
													
													<tr>
														<th colspan="2">Assets</th>
													</tr>
													
													<tr>
														<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Current Assets</b></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash</td>
														<td>{{$in_acc_cash}}</td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank</td>
														<td>{{$in_acc_bank}}</td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bkash Personal</td>
														<td>{{$in_acc_bkash}}</td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accounts Receivable</td>
														<td>{{$acc_receivable}}</td>
													</tr>
													
													<tr>
														<th class="text-right">Total Assets</th>
														<th class="text-right">{{$in_acc_cash+$in_acc_bank+$in_acc_bkash+$acc_receivable}}</th>
													</tr>
													
													<tr>
														<th colspan="2">Liabilities</th>
													</tr>
													
													<tr>
														<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Liabilities</b></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accounts Payable</td>
														<td>{{$acc_payable}}</td>
													</tr>
													
													<tr>
														<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Long Term Liabilities</b></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loans</td>
														<td>{{$loans}}</td>
													</tr>
													
													<tr>
														<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner's Equity</b></td>
													</tr>
													
													<tr>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invested Capital</td>
														<td>{{$invest}}</td>
													</tr>
													
													<tr>
													
													<?php
														
														$inc_loss = '';
														
														if($income >= 0){
															
															$inc_loss = 'Income';
															
														}else{
															$inc_loss = 'Loss';
														}
														
													?>
													
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Net {{$inc_loss}}</td>
														<td>{{abs($income)}}</td>
													</tr>
													
													<tr>
														<th class="text-right">Total Liabilities</th>
														<th class="text-right">{{$acc_payable+$loans+$invest+$income}}</th>
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