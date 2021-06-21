@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding bottom_padding"><i class="fa fa-arrow-up" aria-hidden="true"></i> Withdraw</h3>
                        
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
                    

                    <div class="no_padding right_padding res_no_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">New Withdraw</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-withdraw', 'method'=>'post' ]) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label class="control-label" for="account-name">Select Account </label>

                                        <select id="account-name" name="account_id" class="form-control ">
                                            
                                            <?php 
                                                $accounts = DB::table('accounts')->get();
                                                foreach($accounts as $accounts ) {  ?>
                                                
                                                <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                            
                                            <?php } ?>
                                                
                                        </select>
                                    
                                    </div>                                    
                                    
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="ammount" style="padding-top: 10px;"> Ammount </label>
                                        <input type="number" placeholder="Ammount" id="ammount" name="ammount" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="Note">Note </label>
										
                                        <textarea  placeholder="Note" class="form-control" aria-label="" id="Note" name="note" required></textarea>
                                        
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
                                <h3 class="panel-title">All Withdraws</h3>
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
										<button class="search_withdraws btn btn-primary btn-sm">Go</button>
										
										<button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
									</div>
									
								</div>
							
								<div class="col-md-12 col-sm-12 col-xs-12 no_padding" id="print_content">
									
									<p class="search_term"><b>Withdraws </b></p>
							
									<div class="table-responsive">
									
										<table class="table table-striped table-responsive table-bordered">
											
											<?php 
												$data = count($withdraws);

												if ( $data !='' ) { ?>

												

													<thead>
														<tr class="headings">
															<th class="text-center">Account</th>
															<th class="text-center">Branch </th>
															<th class="text-center">Account No. </th>
															<th class="text-center">Ammount</th>
															<th class="text-center">Note</th>
															<th class="text-center">Created By</th>
															<th class="text-center">Created Date / Time</th>
														</tr>
													</thead>

													<tbody class="search_res">
														
														<?php  foreach ( $withdraws as $withdraw) { ?>

															<tr class="even pointer">
																<td class="text-center">{{$withdraw->account_name}}</td>
																<td class="text-center">{{$withdraw->account_branch}}</td>
																<td class="text-center">{{$withdraw->account_no}}</td>
																<td class="text-center">{{$withdraw->ammount}}</td>
																<td class="text-center">{{$withdraw->note}}</td>
																<td class="text-center">{{$withdraw->admin_name}}</td>
																<td class="text-center">{{$withdraw->withdraw_created_date}} / {{$withdraw->withdraw_created_time}}</td>
																
															</tr>

														<?php
														}
														?>
														
															
													</tbody>

													<?php
												}else{
													echo "<h4>Nothing Found.</h4>";
												}
											?>
											
										</table>
										
									</div>
								
                                </div>
								
								
                                <div class="pull-right hide_pagi">

									@if ( $withdraws != '') 

										<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{URL::to('/withdraw?page=1')}}">First</a> </li>
										</ul>

										{{ $withdraws->links() }}
										
										<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{URL::to('/withdraw?page='.$withdraws->lastPage())}}">Last</a> </li>
										</ul>

									@endif

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