@extends('admin_master') 

@section('admin_main_content')
   
    <div class="right_col right_col_back" role="main">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                    <h3 class="no_padding bottom_padding"><i class="fa fa-table"></i> Table</h3>
                    
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

                <div class="no_padding right_padding col-md-4 col-sm-4 col-xs-12">				
                    
                    <div class="panel panel-amin">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Table</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="panel-body">        
                            
                            
                            {!!Form::open(['url' => '/table', 'method'=>'post']) !!}
                            
                                <div class="form-group form-group-sm">
                                    <label for="table-name">Table Name:</label>
                                    <input type="text" class="form-control" value="" name="table_name" placeholder="Table Name" id="table-name" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Add Table</button>
                            {!!Form::close() !!}
                            
                            
                        </div>
                    </div>
                    
                </div>

                <div class="no_padding col-md-8 col-sm-8 col-xs-12">			
                    <div class="panel panel-amin">
                        <div class="panel-heading">
                            <h3 class="panel-title">Table List</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>
                        <div class="panel-body">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Table Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $tables as $table )
                                            <tr>
                                                <td class="text-center">{{ $table->table_name }}</td>
                                            
                                                <td class="text-center">
                                                
                                                    <button 
                                                        class="btn btn-primary btn-xs edit_table" type="button" data-tableName="{{$table->table_name}}" value="{{$table->table_id}}" >
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>

                                                    <!-- <a href="{{ URL::to('/table-delete/'.$table->table_id) }}" onclick="return confirm('Are You Sure?');" class="btn btn-danger btn-xs">                                                        
                                                    
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </a> -->
                                                    
                                                    
                                                </td>
                                            </tr>
                                        @endforeach                                           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Table-->
    <div style="z-index:9999999999" class="modal fade edit_table_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Edit Table <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                </div>
                <div class="modal-body">
                
                    {!!Form::open(['url' => '/table-up', 'method'=>'post']) !!}
                        
                        <div class="form-group form-group-sm">
                            <input type="hidden" name="table_id" class="table_id" value=""> 

                            <label for="table-name">Table Name:</label>
                            <input type="text" class=" form-control table_name" value="" name="table_name" placeholder="Table Name" id="table-name" required>
                                                    
                        </div>                    
                        
                        <button type="submit" class="btn btn-primary">Update Table</button>
                    {!!Form::close() !!}   
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div> 

@endsection