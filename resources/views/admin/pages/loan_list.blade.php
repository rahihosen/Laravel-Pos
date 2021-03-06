@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Loan </h3>
                        
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
                    

                    <div class="res_no_padding no_padding right_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Loan</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-loan','method'=>'post']) !!}

                                    <div class="form-group form-group-sm">

                                        <label for="des">Description</label>
										
                                        <textarea class="form-control" placeholder="Description" aria-label="" id="des" name="loan_description" required></textarea>

                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="Ammount" style="padding-top: 10px;">Ammount</label>
										
                                        <input type="number" placeholder="Ammount"  name="loan_ammount" id="Ammount" class="form-control" required>
                                        
                                    </div> 
									
                                    <div class="form-group form-group-sm" >

                                        <label for="account" style="padding-top: 10px;">Select Account </label>

                                        <select id="account" name="account_id" class="form-control" required>
                                            
                                            <?php
                                                $accounts = DB::table('accounts')->get();
                                                foreach($accounts as $accounts ) {  ?>
                                                
                                                <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                            
                                            <?php } ?>
                                                
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

                    <div class="no_padding col-md-8 col-sm-8 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Loan List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                
                                @if ( $value = count($loans) > 0 )

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
                                            <button class="search_loans btn btn-primary btn-sm">Go</button>
                                            
                                            <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 no_padding" id="print_content">
                                        
                                        <p class="search_term"><b>Loans </b></p>
                                    
                                        <div class="table-responsive">
                                        
                                            <table class="table table-align table-striped bulk_action table-responsive table-bordered">
                                                
                                                
                                                    
                                                    
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="text-center">ID </th>
                                                        <th class="text-center">Description </th>
                                                        <th class="text-center">Ammount</th>
                                                        <th class="text-center">Due</th>
                                                        <th class="text-center">Account</th>
                                                        <th class="text-center">Created</th>
                                                        <th class="text-center">Date</th>
                                                        <th class="text-center hide_print_sec">Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="search_res">
                                                    
                                                    @foreach ($loans as $loan)

                                                        <tr class="even pointer">

                                                            <td class="text-center">{{$loan->loan_id}}</td>
                                                            <td class="text-center">{{$loan->loan_description}}</td>
                                                            <td class="text-center">{{$loan->loan_ammount}}</td>
                                                            
                                                            <?php 
                                                                $data = DB::table('refund_table')->where('loan_id', $loan->loan_id)->sum('refund_ammount');

                                                                $result = ($loan->loan_ammount) - $data;
                                                            ?>

                                                            <td class="text-center"><?= $result; ?> </td>
                                                            <td class="text-center">{{$loan->account_name}}</td>
                                                            <td class="text-center">{{$loan->name}}</td>
                                                            <td class="text-center">{{$loan->loan_created_date}} </td>

                                                            <td class="text-center hide_print_sec">

                                                                <button
                                                                    class="btn btn-primary btn-xs refund"
                                                                    
                                                                    value="{{$loan->loan_id}}"
                                                                    refundAmmount="{{ $result = ($loan->loan_ammount) - $data }}"

                                                                    ><i class="far fa-edit"></i> Refund 
                                                                </button>

                                                                <button
                                                                    class="btn btn-info btn-xs view_refund"

                                                                    value="{{$loan->loan_id}}"
                                                                    ><i class="fas fa-eye"></i> View
                                                                </button>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                    
                                                        
                                                </tbody>
                                                    
                                                        
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="hide_pagi pull-right">

                                        @if ( $loans != '') 

                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="{{URL::to('/loan-list?page=1')}}">First</a> </li>
                                            </ul>

                                            {{ $loans->links() }} 

                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="{{URL::to('/loan-list?page='.$loans->lastPage())}}">Last</a> </li>
                                            </ul>

                                        @endif

                                    </div>

                                @else 

                                    <h4 class="text-center">Nothing Found</h4>

                                @endif
								
								<div class="clearfix"></div>
								
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Add Refund loan -->
    <div style="z-index:9999999999" class="modal fade add_refund_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Refund Loan <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/add-refund', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">

                            <label style="padding-top: 10px;">Loan:</label>
							
                            <input type="text" class="refund form-control" disabled>
                            
                            <input type="hidden" name="loan_id" class="loan_id" value="">
                            

                        </div>

                        <div class="form-group form-group-sm">

                            <label for="RefundDes" style="padding-top: 10px;">Refund Description </label>
							
                            <textarea class="form-control" id="RefundDes" placeholder="Refund Description" name="refund_note" required></textarea>

                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="RefundAmn" style="padding-top: 10px;">Refund Ammount:</label>
							
                            <input type="number" id="RefundAmn" class="max_refund form-control" value="" name="refund_ammount" min="1" placeholder="Refund Ammount" required>
							
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="RefundAcc" style="padding-top: 10px;"> Select Account </label>

                            <select id="RefundAcc" name="account_id" class="form-control active" required>
                                
                                <?php
                                    $accounts = DB::table('accounts')->get();
                                    
                                    foreach($accounts as $accounts ) {  ?>
                                    
                                        <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                
                                    <?php 
                                    }
                                ?>
                                    
                            </select>
                        </div>

                        <div class="form-group form-group-sm" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary"  class="control-label">Add Payment</button>
                        </div>
                    {!!Form::close() !!}
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 


    <!-- Modal view loan-->
    <div style="z-index:9999999999" class="modal fade view_refund_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">View Refund <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date / Time</th>
                                    <th class="text-center">Create By</th>
                                    <th class="text-center">Account</th>
                                    <th class="text-center">Refund Description</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="return_refund">
                                
                                
								
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


@endsection