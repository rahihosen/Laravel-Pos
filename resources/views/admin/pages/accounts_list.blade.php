@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-money"></i> Accounts And Deposit </h3>
                        
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
                        <ul class="nav nav-tabs" style="border-bottom: 0px solid #843c3c!important;">
                            <li class="active"><a data-toggle="tab" href="#home1">Accounts</a></li>
                            <li><a data-toggle="tab" href="#menu5">Deposit</a></li>
                           
                            

                        </ul>
                    </div>
                    
                    
                    
                    
                    <div class="panel-body tab-content">
                        <div class="no_padding col-md-12 col-sm-12 col-xs-12 tab-pane fade in active" id="home1">
                            
                               <div class="no_padding right_padding res_no_padding col-md-3 col-sm-3 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Add Account</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                
                                
                                {!! Form::open(['url' => '/save-account','method'=>'post','enctype'=>'multipart/form-data']) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label for="account-name">Account Name </label>
										
                                        <input type="text" placeholder="Account Name" id="account-name" name="account_name" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="branch-name" style="padding-top: 10px;">Branch</label>
                                        <input type="text" placeholder="Branch" id="branch-name" name="branch_name" class="form-control" required>
                                        
                                    </div>                                    
                                    
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="account-no" style="padding-top: 10px;">Account No </label>
										
                                        <input id="account-no" placeholder="Account No" type="text" name="account_no" class="form-control" required>
                                        
                                    </div>
									
									<div class="form-group form-group-sm">

                                        <label for="account-type" style="padding-top: 10px;">Account Type </label>
										
                                        <select id="account-type" name="account_type" class="form-control">
											
											<option value="1">Cash</option>
											<option value="2">Bank</option>
											<option value="3">Mobile Banking (Personal)</option>
											
										</select>
                                        
                                    </div>
                                   

                                    <div class="ln_solid"></div>

                                    <div class="form-group form-group-sm">
									
                                        <button type="submit" class="btn btn-success">Save</button>
                                        
                                    </div>

                                {!! Form::close() !!}                                
                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="no_padding col-md-9 col-sm-9 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Account List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">                                    

                                    <table class="table table-striped bulk_action table-responsive table-bordered">


                                        @if ( $data = count($all_accounts) > 0 ) 

                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title text-center">Name </th>
                                                    <th class="column-title text-center">Branch </th>
                                                    <th class="column-title text-center">Acc. No. </th>
                                                    <th class="column-title text-center">Balance</th>
                                                    <th class="column-title text-center">Created </th>
                                                    <th class="column-title text-center">Created Date</th>
                                                    <th class="column-title text-center">Updated </th>
                                                    <th class="column-title text-center">Updated Date</th>
                                                    <th class="column-title text-center"> Action </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                
                                                @foreach($all_accounts as $account)

                                                    <tr class="even pointer">
                                                    
                                                        <td class="text-center">{{$account->name}}</td>
                                                        
                                                        <td class="text-center">{{$account->branch}}</td>
                                                        
                                                        <td class="text-center">{{$account->no}}</td>
														
                                                        <td class="text-center">
														
															<?php 
																
																$invested = DB::table('investment_table')->where('account_id', $account->aid)->sum('ammount');
																
																$order_payment = DB::table('pament_details')->where('account_id', $account->aid)->where('status',1)->sum('amount');
																
																$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->aid)->sum('pur_ammount');
																
																$loan_refund = DB::table('refund_table')->where('account_id', $account->aid)->sum('refund_ammount');
																
																$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->aid)->sum('ammount');
																
																$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->aid)->sum('ammount');
																
																$expenses = DB::table('expenses')->where('account_id', $account->aid)->sum('expenses_ammount');
																
																$loan_in = DB::table('loans_table')->where('account_id', $account->aid)->sum('loan_ammount');
																
																
																
																$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->aid)->sum('amount');
																
																$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->aid)->sum('amount');
																
																
																
																// $customer_pre_due = DB::table('customer')->sum('credit_limit');
																
																// $buyer_pre_due = DB::table('buyers')->sum('previous_due');
																
																
																
																
																$in_acc = $invested + $order_payment + $transfer_in + $loan_in + $customer_extra_payment - $supplier_extra_payment - $purchase_payment - $loan_refund - $transfer_out - $expenses;
																
																
																echo $in_acc;
																
															?>
															
														
														</td>
                                                        
                                                        <td class="text-center">{{$account->created_admin_name}}</td>
                                                        
                                                        <td class="text-center">{{$account->created_date}} / {{$account->created_time}}</td>
                                                        
                                                        <td class="text-center">{{$account->updated_admin_name}}</td>

                                                        <td class="text-center"><?php if($account->updated_date != ''){?>{{$account->updated_date}} / {{$account->updated_time}}<?php }?></td>
                                                        
                                                        <td class="text-center">

                                                            <button
                                                                class="btn btn-dark btn-xs edit_account"

                                                                value="{{$account->aid}}"
                                                                accountName="{{$account->name}}"
                                                                accountBranch="{{$account->branch}}"
                                                                accountNo="{{$account->no}}"
                                                                accountType="{{$account->type}}"

                                                                ><i class="far fa-edit"></i> Edit
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else

                                            <h4 class="text-center">Nothing Found</h4>

                                        @endif
                                                
                                    </table>
                                    
                                </div>
								
								<div class=" pull-right">

									@if ( $all_accounts != '') 

										<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{URL::to('/accounts-list?page=1')}}">First</a> </li>
										</ul>

										{{ $all_accounts->links() }} 

										<ul class="pagination">
											<li class="page-item"><a class="page-link" href="{{URL::to('/accounts-list?page='.$all_accounts->lastPage())}}">Last</a> </li>
										</ul>

									@endif

								</div>
								<div class="clearfix"></div>
								
                            </div>
                        </div>                        
                    </div>
                            
                            
                            
                        </div>
                        
                        
                        <div class="res_no_padding right_no_pad col-md-12 col-sm-12 col-xs-12 tab-pane fade" id="menu5">
                            
                            
                             <div class="no_padding right_padding res_no_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">New Deposit</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-balance', 'method'=>'post' ]) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label class="control-label" for="account-name">Select Account </label>

                                        <select id="account-name" name="account_id" class="form-control" required>
                                            
                                            <?php $accounts = DB::table('accounts')->get();?>

                                            @foreach($accounts as $accounts ) 
                                                
                                                <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                            
                                            @endforeach
                                                
                                        </select>
                                    
                                    </div>
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="ammount" style="padding-top: 10px;"> Ammount </label>
                                        <input type="number" placeholder="Ammount" id="ammount" name="ammount" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="Note">Note </label>
										
                                        <textarea placeholder="Note" class="form-control" aria-label="" id="Note" name="note"></textarea>
                                        
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
                                <h3 class="panel-title">All Deposits</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">

                                @if ( $data = count($balances) > 0)
								
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
                                                
                                                <option value="0">Select Account</option>
                                                
                                                <?php $accounts = DB::table('accounts')->get(); ?>
                                                
                                                @foreach( $accounts as $accounts )
                                                    
                                                    <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                                
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
                                        <div class="marginBT10 form-group-sm">
                                            <button class="search_deposits btn btn-primary btn-sm">Go</button>
                                            
                                            <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 no_padding" id="print_content">
                                        
                                        <p class="search_term"><b>Deposits </b></p>
                                    
                                        <div class="table-responsive">
                                            
                                            <table class="table table-striped table-responsive table-bordered">

                                                <thead>
                                                    <tr class="headings">
                                                        <th class="text-center">Account</th>
                                                        <th class="text-center">Branch </th>
                                                        <th class="text-center">Account No. </th>
                                                        <th class="text-center">Ammount</th>
                                                        <th class="text-center">Note</th>
                                                        <th class="text-center">Created By</th>
                                                        <th class="text-center">Created Date / Time</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="search_res">
                                                    
                                                    @foreach ( $balances as $balance)

                                                        <tr class="even pointer">
														
                                                            <td class="text-center">{{$balance->account_name}}</td>
                                                            <td class="text-center">{{$balance->account_branch}}</td>
                                                            <td class="text-center">{{$balance->account_no}}</td>
                                                            <td class="text-center">{{$balance->ammount}}</td>
                                                            <td class="text-center">{{$balance->note}}</td>
                                                            <td class="text-center">{{$balance->name}}</td>
                                                            <td class="text-center">{{$balance->balance_created_date}} / {{$balance->balance_created_time}}</td>
                                                            <td class="text-center">
                                                                <button
                                                                    class="btn btn-danger btn-xs del"
                                                                    value="{{$balance->investment_id}}"

                                                                    ><i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach                                                        
                                                </tbody>
                                            </table>                                            
                                        </div>
                                        
                                        <div class="pull-right hide_pagi">

                                            @if ( $balances != '') 

                                                <ul class="pagination">
                                                    <li class="page-item"><a class="page-link" href="{{URL::to('/balance-list?page=1')}}">First</a> </li>
                                                </ul>

                                                {{ $balances->links() }}
                                                
                                                <ul class="pagination">
                                                    <li class="page-item"><a class="page-link" href="{{URL::to('/balance-list?page='.$balances->lastPage())}}">Last</a> </li>
                                                </ul>

                                            @endif

                                        </div>                                        
                                        <div class="clearfix"></div>                                        
                                    </div>
                                @else 
                                    <h4 class="text-center">Nothing Found...</h4>
                                @endif                                
                            </div>
                        </div>                        
                    </div>
                            
                            
                        </div>
                        
                        
                        
                    </div>
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
                    

                 
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Accounts Modal -->
    <div style="z-index:9999999999" class="modal fade edit_account_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Edit Account <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-account','method'=>'post','enctype'=>'multipart/form-data'])!!}

                        <div class="form-group form-group-sm">
						
                            <label> ID </label>
							
                            <input type="text" class="form-control account_id" value="" disabled>
							
                            <input type="hidden" name="account_id" value="" class="form-control account_id">
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="name">Account Name </label>
                            <input type="text" id="name" name="account_name" value="" class="form-control account_name" required>

                        </div>

                        <div class="form-group form-group-sm">

                            <label for="bname">Branch</label>
                            <input type="text" id="bname" name="branch_name" class="form-control branch_name" required> 
                            
                        </div>
                        
                        <div class="form-group form-group-sm">

                            <label for="no">Account No</label>
							
                            <input type="number" name="account_no" id="no" class="form-control account_no" required>

                        </div>
						
						<div class="form-group form-group-sm">

							<label for="account-type" style="padding-top: 10px;">Account Type </label>
							
							<select id="account-type" name="account_type" class="form-control">
								
								<option class="account_type"></option>
								
								<option value="1">Cash</option>
								<option value="2">Bank</option>
								<option value="3">Mobile Banking (Personal)</option>
								
							</select>
							
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


@endsection

@push('script')

<script>
    $(document).ready(function() {
        
        // Edit Client Modal
        $('.table').on('click', '.edit', function() { 
        
            var a_id = $(this).val();
            
            var a_name = $(this).attr('a_name');
            
            var a_email = $(this).attr('a_email');
            
            var photo = $(this).attr('photo');

            var oldImage = $(this).attr('oldImage');

            var a_mobile = $(this).attr('a_mobile');

            var a_address = $(this).attr('a_address');
            
            
            $('.a_id').val(a_id);
            
            $('.a_name').val(a_name);
            
            $('.a_email').val(a_email);

            $('.a_mobile').val(a_mobile);

            $('.a_address').val(a_address);
            
            $('.admin_img').attr('src',photo);
            
            $('.admin_img').show();
            
            $('#thumb-output-modal').html('');
            
            $('.old_image').val(oldImage);
            
            $('.clear_image').val('');
            
            
            $('.edit__modal').modal();
            
        });

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
                        
                                url:"{{URL('/del-deposit')}}",
                        
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

@endpush










