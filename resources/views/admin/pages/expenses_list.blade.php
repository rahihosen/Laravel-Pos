@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <div class="col-md-4 col-sm-3 col-xs-12">

                            <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Expenses </h3>

                        </div>

                        
                    </div>

                    <!-- All Success Messages -->
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
                            <li class="active"><a data-toggle="tab" href="#home1">Expenses</a></li>
                            <li><a data-toggle="tab" href="#menu5">Expenses Setting</a></li>
                           
                            

                        </ul>
                    </div>
                    
                    <div class="panel-body tab-content">
                        
                        
                        <div class="no_padding col-md-12 col-sm-12 col-xs-12 tab-pane fade in active" id="home1">
                             <div class="no_padding right_padding res_no_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Expenses Head</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-expenses','method'=>'post']) !!}

                                    <div class="form-group form-group-sm">

                                        <label for="expenses-head">Expenses Head </label>

                                        <select id="expenses-head" name="expenses_head_id" class="form-control active expenses_head" required>
                                            
                                            <?php 
                                                $expenses = DB::table('expenses_head')->get();

                                                foreach($expenses as $expenses ) {  ?>
                                                
                                                    <option value="<?= $expenses->expenses_head_id; ?>"><?= $expenses->expenses_head_name;?></option>
                                            
                                                    <?php
                                                } 
                                            ?>
                                                
                                        </select>

                                    </div>


                                    <div class="form-group form-group-sm">

                                        <label for="expenses-sub-head-name">Expenses Sub Head </label>

                                        <select id="expenses-sub-head-name" name="expenses_sub_head_id" class="form-control search_results_expenses" required>
										
                                        </select>

                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="account-name">Select Account </label>

                                        <select id="account-name" name="account_id" class="form-control" required>
                                            
                                            <?php $accounts = DB::table('accounts')->get(); ?>

                                            @foreach($accounts as $accounts )
                                                
                                                <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                            
                                            @endforeach
											
                                        </select>
                                    
                                    </div>     

                                    <div class="form-group form-group-sm">

                                        <label for="ammount"> Ammount </label>

                                        <input type="number" placeholder="Ammount" id="ammount" class="form-control" name="expenses_ammount" required>

                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="expenses-note">Note </label>
										
                                        <textarea id="expenses-note" class="form-control" placeholder="Note" name="expenses_note"></textarea>
                                        
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
                                <h3 class="panel-title">Expenses List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">

                                @if ( $data = count($all_expenses) > 0 )
							
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
                                            <button class="date_from_to_expenses btn btn-primary btn-sm">Go</button>
                                            
                                            <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 no_padding" id="print_content">
                                        
                                        <p class="search_term"><b>Expenses </b></p>
                                
                                        <div class="table-responsive">   

                                            <table class="table table-align table-striped table-responsive table-bordered">

                                                <thead>
                                                    <tr class="headings">
                                                        <th class="text-center">Date / Time </th>
                                                        <th class="text-center">Ammount </th>
                                                        <th class="text-center">Note </th>
                                                        <th class="text-center">Head </th>
                                                        <th class="text-center">Sub Head </th>
                                                        <th class="text-center">Account Name </th>
                                                        <th class="text-center">Created By </th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="return_expenses">
                                                    
                                                    @foreach ( $all_expenses as $expenses ) 

                                                        <tr class="even pointer">

                                                            <td class="text-center">{{$expenses->expenses_created_date}} / {{$expenses->expenses_created_time}}</td>
                                                            <td class="text-center">{{$expenses->expenses_ammount}}</td>
                                                            <td class="text-center">{{$expenses->expenses_note}}</td>
                                                            <td class="text-center">{{$expenses->expenses_head_name}}</td>
                                                            <td class="text-center">{{$expenses->expenses_sub_head_name}}</td>
                                                            <td class="text-center">{{$expenses->account_name}}</td>
                                                            <td class="text-center">{{$expenses->name}}</td>
                                                            <td class="text-center">
                                                                <button
                                                                    class="btn btn-danger btn-xs del"
                                                                    value="{{$expenses->expenses_id}}"

                                                                    ><i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>                                                            
                                                        </tr>
                                                    @endforeach                                                    
                                                </tbody>                                                
                                            </table>
                                        </div>
                                    </div>
                                @else 

                                    <h4 class="text-center">Nothing Found</h4>

                                @endif

                            </div>

                            <div class="hide_pagi pull-right">

                                @if ( $all_expenses != '') 

                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="{{URL::to('/expenses-list?page=1')}}">First</a> </li>
                                    </ul>

                                    {{ $all_expenses->links() }}
                                    
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="{{URL::to('/expenses-list?page='.$all_expenses->lastPage())}}">Last</a> </li>
                                    </ul>

                                @endif

                            </div>
                        </div>
                    </div>
                            
                            
                        </div>
                        
                        
                        
                        <div class="res_no_padding right_no_pad col-md-12 col-sm-12 col-xs-12 tab-pane fade" id="menu5">
                            
                            <div class="res_no_padding no_padding right_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Espenses Head</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-expenses-head','method'=>'post']) !!}

                                    <div class="form-group form-group-sm">

                                        <label class="control-label" for="account-name">Expenses Head</label>
                                        <input class="form-control" placeholder="Expenses Head" aria-label="" name="expenses_head_name" required="required" />

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
                                <h3 class="panel-title">Expenses Head List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">                                    

                                    <table class="table table-align table-striped bulk_action table-responsive table-bordered">
                                        
                                        @if ( $value = count($expenses_setting) > 0) 
                                            
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title text-center">ID </th>
                                                    <th class="column-title text-center">Expenses Head </th>
                                                    <th class="column-title text-center">Created By </th>
                                                    <th class="column-title text-center">Created Date / Time </th>
                                                    <!--<th class="column-title text-center">Updated By </th>
                                                    <th class="column-title text-center">Updated Date / Time</th>-->
                                                    <th class="column-title text-center">Actions </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                
                                                @foreach ($expenses_setting as $expenses_settings)

                                                    <tr class="even pointer">

                                                        <td class="text-center">{{$expenses_settings->expenses_head_id}}</td>
                                                        <td class="text-center">{{$expenses_settings->expenses_head_name }}</td>
                                                        <td class="text-center">{{$expenses_settings->name}}</td>
                                                        <td class="text-center">{{$expenses_settings->expenses_head_created_date}} / {{$expenses_settings->expenses_head_created_time}} </td>
                                                        
                                                        <td class="text-center">

                                                            <button
                                                                class="btn btn-primary btn-xs expenses_head"
                                                                
                                                                value="{{$expenses_settings->expenses_head_id}}"
                                                                expensesHeadName="{{$expenses_settings->expenses_head_name }}"

                                                                ><i class="fa fa-edit"></i> Edit 
                                                            </button>
                                                            
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        @else 

                                            <h4 class="text-center">Nothing Found..</h4>

                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <!-- Expenses Sub head Settings -->
                    <div class="no_padding col-md-12 col-sm-12 col-xs-12">			
                        
                        <!-- Save Expenses Sub Head Name -->
                        <div class="res_no_padding no_padding right_padding col-md-4 col-sm-4 col-xs-12">				
                            
                            <div class="panel panel-amin">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Espenses Sub Head</h3>
                                    <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                                </div>

                                <div class="panel-body">        
                                    
                                    
                                    {!! Form::open(['url' => '/save-expenses-sub-head','method'=>'post']) !!}

                                        <div class="form-group form-group-sm">

                                            <label for="account-name">Expenses Sub Head Name</label>
                                            <input class="form-control" placeholder="Expenses Sub Head Name" name="expenses_sub_head_name" required>

                                        </div>

                                        <div class="form-group form-group-sm">

                                            <label for="exp-Head">Expenses Head Name </label>

                                            <select id="exp-Head" name="expenses_head_id" class="form-control active" required="required">
                                                
                                                <?php $expenses = DB::table('expenses_head')->get();?>

                                                @foreach($expenses as $expenses ) 
                                                
                                                    <option value="<?= $expenses->expenses_head_id;?>" required="required"><?= $expenses->expenses_head_name;?></option>
                                            
                                                @endforeach
                                                    
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
                        
                        <!-- View Expenses Sub head & Edit -->
                        <div class="no_padding col-md-8 col-sm-8 col-xs-12">

                            <div class="panel panel-amin">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Expenses Sub Head List</h3>
                                    <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                                </div>

                                <div class="panel-body">
                                    <div class="table-responsive">                                    

                                        <table class="table table-align table-striped bulk_action table-responsive table-bordered">
                                            
                                            
                                            @if ( $data = count($expenses_sub_setting) > 0 ) 
                                                
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title text-center">ID </th>
                                                        <th class="column-title text-center">Sub Head </th>
                                                        <th class="column-title text-center"> Head </th>
                                                        <th class="column-title text-center">Created By </th>
                                                        <th class="column-title text-center">Created Date / Time </th>
                                                        <!--<th class="column-title text-center">Updated By </th>
                                                        <th class="column-title text-center">Updated Date / Time </th>-->
                                                        <th class="column-title text-center">Actions </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                    @foreach ($expenses_sub_setting as $expenses_sub) 

                                                        <tr class="even pointer">

                                                            <td class="text-center"><?= $expenses_sub->expenses_sub_head_id; ?></td>
                                                            <td class="text-center"><?= $expenses_sub->expenses_sub_head_name; ?></td>
                                                            <td class="text-center"><?= $expenses_sub->expenses_head_name; ?></td>
                                                            <td class="text-center"><?= $expenses_sub->name; ?></td>
                                                            <td class="text-center">
                                                                {{ $expenses_sub->expenses_sub_head_created_date }} / {{ $expenses_sub->expenses_sub_head_created_time }}
                                                            </td>
                                                            
                                                            
                                                            <td class="text-center">

                                                                <button
                                                                    class="btn btn-primary btn-xs expenses_sub"
                                                                    
                                                                    value="{{$expenses_sub->expenses_sub_head_id}}"
                                                                    expansesHeadId="{{$expenses_sub->expenses_head_id}}"
                                                                    expansesHeadName="{{$expenses_sub->expenses_head_name}}"
                                                                    expensesSubHeadName="{{$expenses_sub->expenses_sub_head_name }}"

                                                                    ><i class="fa fa-edit"></i> Edit 
                                                                </button>
                                                                
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            
                                            @else

                                                <h4 class="text-center">Nothing Found..</h4>

                                            @endif
                                        </table>
                                    </div>
									
									<div class="pull-right">

										@if ( $expenses_sub_setting != '') 

											<ul class="pagination">
												<li class="page-item"><a class="page-link" href="{{URL::to('/expenses-settings-list?page=1')}}">First</a> </li>
											</ul>

											{{ $expenses_sub_setting->links() }}
											
											<ul class="pagination">
												<li class="page-item"><a class="page-link" href="{{URL::to('/expenses-settings-list?page='.$expenses_sub_setting->lastPage())}}">Last</a> </li>
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
                       
                    </div>
                    

                   
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <!-- Edit Expenses head Modal -->
    <div style="z-index:9999999999" class="modal fade edit_expenses_head_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Edit Expenses Head <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-expenses-head', 'method'=>'post'])!!}

                        <div class="form-group form-group-sm">
                            <label class="control-label" > ID </label>
                            <input type="text" id="" class="form-control expenses_head_id" value="" disabled>
                            <input type="hidden" id=""  name="expenses_head_id" value="" class="form-control expenses_head_id">
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label class="control-label"> Expenses Head Name </label>
                            <input type="text"  name="expenses_head_name" required="required" class="form-control expenses_head_name " placeholder="Expenses Head Name" required>

                        </div>
                        

                        <div class="ln_solid"></div>

                        <div class="form-group form-group-sm">

                            <button type="submit" class="btn btn-primary">Update</button>
                        
                        </div>

                    {!! Form::close()!!}
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>

    <!-- Edit Expenses Sub head Modal -->
    <div style="z-index:9999999999" class="modal fade edit_expenses_sub_head_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Edit Expenses Sub Head <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-expenses-sub-head', 'method'=>'post'])!!}

                        <div class="form-group form-group-sm">
                            <label class="control-label" > ID </label>
                            <input type="text" id="" class="form-control expenses_sub_head_id" value="" disabled>
                            <input type="hidden" id=""  name="expenses_sub_head_id" value="" class="form-control expenses_sub_head_id">
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label class="control-label"> Expenses Sub Head Name </label>
                            <input type="text"  name="expenses_sub_head_name" required class="form-control expenses_sub_head_name" placeholder="Expenses Sub Head Name" required>

                        </div>

                        <div class="form-group form-group-sm">

                            <label class="control-label" for="account-name">Expenses Head Name </label>

                            <select id="" name="expenses_head_id" class="form-control active" required="required">
                                
                                <option class="expansesHeadId" value="" ></option>
                                
                                <?php $expenses = DB::table('expenses_head')->get(); ?>
                                
                                @foreach($expenses as $expenses )
                                    
                                    <option value="<?= $expenses->expenses_head_id;?>" required="required"><?= $expenses->expenses_head_name;?></option>
                            
                                @endforeach
                            </select>
                        
                        </div>
                        

                        <div class="ln_solid"></div>

                        <div class="form-group form-group-sm">

                            <button type="submit" class="btn btn-primary">Update</button>
                        
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
                        
                                url:"{{URL('/del-expenses')}}",
                        
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