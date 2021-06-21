@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Transaction History </h3>
                        
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

                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Transation List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">

								@if ( $data = count($transactions) > 0 ) 

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
									
									<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
										<div class="marginBT10 form-group-sm">
											<select class="form-control select_type">
												
												<option value="0">Transaction Type</option>
												<option value="1">Deposit</option>
												<option value="2">Loan</option>
												<option value="3">Loan Refunds</option>
												<!--<option value="4">Transaction Type</option>-->
												<option value="5">Expense (Office)</option>
												<option value="6">Income</option>
												<option value="7">Balance Transfer (Withdraw)</option>
												<option value="8">Balance Transfer (Deposit)</option>
												<option value="9">Expense (Supply/Purchase)</option>
												
											</select>
										</div>
										
									</div>
									
									<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
										<div class="marginBT10 form-group-sm">
											<button class="search_transactions btn btn-primary btn-sm">Go</button>
											
											<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
										</div>
										
									</div>
								
									<div class="col-md-12 col-sm-12 col-xs-12 no_padding" id="print_content">
										
										<p class="search_term"><b>All Transactions </b></p>
										
										<div class="table-responsive">                                    

											<table class="table table-striped bulk_action table-responsive table-bordered">
													
												<thead>
													<tr class="headings">
														<th class="column-title text-center">Account </th>
														<th class="column-title text-center">Branch </th>
														<th class="column-title text-center">Account No. </th>
														<th class="column-title text-center">Ammount</th>
														<th class="column-title text-center">Note</th>
														<th class="column-title text-center">Transaction Type</th>
														<th class="column-title text-center">Created By</th>
														<th class="column-title text-center">Created Date / Time</th>
													</tr>
												</thead>

												<tbody class="search_res">
													
													@foreach ( $transactions as $transaction)

														<tr class="even pointer">
														
															<td class="text-center">{{$transaction->account_name}}</td>
															<td class="text-center">{{$transaction->account_branch}}</td>
															<td class="text-center">{{$transaction->account_no}}</td>
															<td class="text-center">{{$transaction->ammount}}</td>
															<td class="text-center">{{$transaction->note}}</td>
															
															<td class="text-center">

																@if($transaction->balance_type==1)

																	<span class="label label-success">Deposit</span>

																@elseif ($transaction->balance_type==2)

																	<span class="label label-warning">Loan</span>

																@elseif ($transaction->balance_type==3)

																	<span class="label label-info">Loan Refunds</span>

																@elseif ($transaction->balance_type==4)

																	<span class="label label-primary">Withdraw</span>

																@elseif ($transaction->balance_type==5)

																	<span class="label label-danger">Expense (Office)</span>

																@elseif ($transaction->balance_type==6)

																	<span class="label label-default">Income</span>

																@elseif ($transaction->balance_type==7)

																	<span class="label label-dark">Balance Transfer (Withdraw)</span>

																@elseif ($transaction->balance_type==8)

																	<span class="label label-dark">Balance Transfer (Deposit)</span>

																@elseif ($transaction->balance_type == 9)

																	<span class="label label-danger">Expense (Supply/Purchase)</span>

																@endif

															</td>
															
															<td class="text-center">{{$transaction->name}}</td>
															<td class="text-center">{{$transaction->balance_created_date}} / {{$transaction->balance_created_time}}</td>
															
														</tr>

													@endforeach
														
												</tbody>
												
											</table>
											
										</div>
									
									</div>
									
									<div class="hide_pagi pull-right">

										@if ( $transactions != '') 

											<ul class="pagination">
												<li class="page-item"><a class="page-link" href="{{URL::to('/transaction-list?page=1')}}">First</a> </li>
											</ul>

											{{ $transactions->links() }} 

											<ul class="pagination">
												<li class="page-item"><a class="page-link" href="{{URL::to('/transaction-list?page='.$transactions->lastPage())}}">Last</a> </li>
											</ul>

										@endif

									</div>

								@else 

									<h4 class="text-center">Nothing Found..</h4>

								@endif

								<div class="clearfix"></div>
								
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection