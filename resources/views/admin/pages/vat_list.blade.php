@extends('admin_master') 

@section('admin_main_content')
   
    <div class="right_col right_col_back" role="main">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                    <h3><i class="fas fa-percent" style="font-size: 18px;"></i> Vat</h3>
                    
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
                            <h3 class="panel-title">Add Vat</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="panel-body">        
                            
                            
                            {!!Form::open(['url' => '/vat-create', 'method'=>'post']) !!}
                            
                                <div class="form-group form-group-sm">
								
                                    <label for="vat-name">Vat Name </label>                                    
                                    <input id="vat-name" type="text" name="vat_name" class="form-control" placeholder="Vat Name" required>
									
                                </div>

                                <div class="form-group form-group-sm">
								
                                    <label for="ammount" style="padding-top: 10px;">Vat Amount</label>
									
                                    <input type="number" id="ammount" name="vat_amount" min="00.00" max="50.00" class="form-control" placeholder="Vat Ammount" required>
									
                                </div>
                                
                                
                                
                                <div class="form-group form-group-sm">
								
                                    <label style="padding-top: 5px;">Vat Status: </label>

                                    <div> <br /> </div>

                                    <div class="btn-group" data-toggle="buttons">

                                        <label class="btn btn-default active" >
                                            <input type="radio" name="vat_status" value="1" checked> &nbsp; Published &nbsp;
                                        </label>

                                        <label class="btn btn-default">
                                            <input type="radio" name="vat_status" value="0"> Unpublished
                                        </label>

                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
								
                                <button type="submit" class="btn btn-success">Save</button>
								
                            {!!Form::close() !!}
                            
                            
                        </div>
                    </div>
                    
                </div>

                <div class="no_padding col-md-8 col-sm-8 col-xs-12">			
                    <div class="panel panel-amin">
                        <div class="panel-heading">
                            <h3 class="panel-title">Vat List</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="panel-body">

                            @if ( $data = count($vat_info) > 0 ) 
                            
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">

                                        <thead>
                                            <tr>
                                                <th class="text-center">Vat Id</th>
                                                <th class="text-center">Vat Name</th>
                                                <th class="text-center">Vat Amount</th>
                                                <th class="text-center">Added By</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ( $vat_info as $vat_info)

                                                <tr>
                                                    <td class="text-center">{{$vat_info->vat_id}}</td>
                                                    <td class="text-center">{{$vat_info->vat_name}}</td>
                                                    <td class="text-center">{{$vat_info->vat_amount}}</td>
                                                    <td class="text-center">{{$vat_info->name}}</td>
                                                    <td class="text-center">

                                                        @if($vat_info->vat_status == 1)

                                                            <label class="label label-success">Active</label>

                                                        @else 

                                                            <label class="label label-warning">Inactive</label>

                                                        @endif

                                                    </td>
                                                
                                                    <td class="text-center">
                                                    
                                                        <button 
                                                            class="btn btn-primary btn-xs edit_vat" 
                                                            
                                                            value="{{$vat_info->vat_id}}"
                                                            vatName="{{$vat_info->vat_name}}"
                                                            vatAmount="{{$vat_info->vat_amount}}"
                                                            vatStatus="{{$vat_info->vat_status}}"
                                                            ><i class="far fa-edit"></i> Edit
                                                        </button>

                                                    </td>
                                                </tr>

                                            @endforeach   

                                        </tbody>
                                    </table>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit vat-->
    <div style="z-index:9999999999" class="modal fade edit_vat_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Edit Vat <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/vat-update', 'method'=>'post']) !!}

                        <div class="form-group form-group-sm">

                            <label>ID</label>
							
                            <input type="text" class="form-control vat_id" disabled>

                        </div>
                        
                        <div class="form-group form-group-sm">
						
                            <input type="hidden" name="vat_id" class="vat_id" value=""> 

                            <label for="name">Vat Name:</label>
							
                            <input type="text" id='name' class="form-control vat_name" value="" name="vat_name" placeholder="Vat name" required>
							
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="amnt">Vat Amount </label>
							
                            <input id='amnt' type="text" class="form-control vat_amount" name="vat_amount" step="0.01" placeholder="Vat amount" required>

                        </div>

                        <div class="form-group form-group-sm" style="margin-top: 30px;">

                            <label>Vat Status</label>
                            <br>
                            <div id="gender" class="btn-group" data-toggle="buttons">

                                <label class="edit_vat_active btn btn-default">
                                    <input type="radio" name="vat_status" value="1"> &nbsp; Published &nbsp;
                                </label>

                                <label class="edit_vat_inactive btn btn-default">
                                    <input type="radio" name="vat_status" value="0"> Unpublished
                                </label>
                                
                            </div>
                        </div>

                        <div><br></div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
						
                    {!!Form::close() !!}   
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 

@endsection