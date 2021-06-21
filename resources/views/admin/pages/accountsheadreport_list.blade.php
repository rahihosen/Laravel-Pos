@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			
                        <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Account Head Report</h3>
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
                    <?php } ?>

                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-amin">
                            <div class="panel-heading">
                                <h3 class="panel-title">Transation List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>
                            <div class="panel-body">
								@if ( $data = count($all_accounts) > 0 ) 
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
											<select class="form-control select_account">
												@if($all_accounts)
												    @foreach($all_accounts as $acc)
												        <option value="{{ $acc->aid }}">{{ $acc->name }}</option>
												    @endforeach
												@endif
											</select>
										</div>
										
									</div>
									
									<div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
										<div class="marginBT10 form-group-sm">
											<button class="search_accountHeadReportSearch btn btn-primary btn-sm">Go</button>
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
													
												
														
												</tbody>
												
											</table>
											
										</div>
									
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