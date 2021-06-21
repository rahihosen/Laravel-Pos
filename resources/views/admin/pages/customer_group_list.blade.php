@extends('admin_master')  
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                    <h3 class="no_padding"><i class="fa fa-users"></i> Group </h3>

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
                            <h3 class="panel-title">Add Group</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>

                        <div class="panel-body">        
                            
                            
                            {!! Form::open(['url' => '/save-customer-group', 'method'=>'post']) !!}
                            
                                <div class="form-group form-group-sm">

                                    <label for="Group-name">Group Name </label>
                                    <input type="text" id="Group-name" placeholder="Name" name="group_name" class="form-control" required>
                                    
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
                            <h3 class="panel-title">Group List</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-responsive table-bordered">

                                    @if ( $data = count($customer_group) > 0 ) 

                                        <thead>
                                            <tr class="headings">
                                                <th class="text-center">ID </th>
                                                <th class="text-center">Group Name </th>
                                                <th class="text-center">Created By </th>
                                                <th class="text-center">Created</th>
                                                <th class="text-center"> Action </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($customer_group as $customer_group)

                                                <tr class="even pointer">
                                                    <td class="text-center">{{$customer_group->group_id}}</td>
                                                    <td class="text-center">{{$customer_group->group_name}}</td>
                                                    <td class="text-center">{{$customer_group->name}}</td>
                                                    <td class="text-center">{{$customer_group->created_date}} / {{$customer_group->created_time}}</td>
                                                    <td class="text-center">

                                                        <button
                                                            class="btn btn-dark btn-xs edit_customer_group"

                                                            value="{{$customer_group->group_id}}"
                                                            groupName="{{$customer_group->group_name}}">

                                                            <i class="far fa-edit"></i> Edit
                                                        
                                                        </button>

                                                    </td>
                                                </tr>

                                            @endforeach                                         
                                                
                                        </tbody>

                                    @endif

                                </table>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

    <!-- Edit Customer Modal -->
    <div style="z-index:9999999999" class="modal fade edit_customer_group_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Edit Product <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-customer-group', 'method'=>'post'])!!}

                        <div class="form-group form-group-sm">

                            <label>ID</label>
                            <input type="text" class="form-control group_id" disabled>
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="name">Group Name </label>
							
                            <input type="text" id="name" name="group_name" value="" class="form-control group_name" placeholder="Group Name" required>
							
                            <input type="hidden" class="group_id" name="group_id">
                            
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