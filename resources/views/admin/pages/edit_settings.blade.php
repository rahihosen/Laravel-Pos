@extends('admin_master')  
@section('admin_main_content')    

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                        <h3><i class="fa fa-cogs"></i> Company Info</h3>

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
				{!!Form::open(['url'=>'/update-settings','method'=>'post','enctype'=>'multipart/form-data'])!!}
				
                    <div class="no_padding right_padding res_no_padding col-md-6 col-sm-6 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Edit</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                            
                                    <div class="form-group" style="margin-top: 5px;">

                                        <label>ID</label>
										
                                        <input type="text" class="form-control" value="{{$settings_by_id->settings_id}}" disabled>

                                        <input type="hidden" name="settings_id" value="{{$settings_by_id->settings_id}}">
										
                                        <input type="hidden" name="old_logo" value="{{$settings_by_id->company_logo}}">
                                        
                                    </div>

                                    <div class="form-group" style="margin-top: 20px;">

                                        <label for="company-name">Company Name</label>
										
                                        <input type="text" id="company-name" name="company_name" value="{{$settings_by_id->company_name}}" class="form-control" placeholder="Company name" required>
                                        
                                    </div>                                    
                                    
                                    
                                    <div class="form-group" style="margin-top: 20px;">

                                        <label for="logo">Company Logo</label>
										
                                        <input type="file" id="logo" name="company_logo" class="form-control">
										
                                        <img class="top_margin" src="{{asset($settings_by_id->company_logo)}}" width="auto" height="50">

                                        <div class="marginTP5"><br><br></div>
                                        
                                    </div> 
                                    
                            </div>

                        </div>
                    </div>

                    
                    <div class="no_padding col-md-6 col-sm-6 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Edit</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">

                                <div class="form-group">

                                    <label class="mobile" for="mobile">Mobile Number </label>
									
                                    <input type="text" id="mobile" name="company_mobile" value="{{$settings_by_id->company_mobile}}" class="form-control" placeholder="Company Mobile Number" required>

                                </div>

                                <div class="form-group">

                                    <label for="email">Company Email </label>
                                    <input type="email" id="email" name="company_email" value="{{$settings_by_id->company_email}}" class="form-control" placeholder="Company Email" required>

                                </div>

                                <div class="form-group">

                                    <label for="address">Company Address </label>
									
                                    <textarea id="address" class="form-control" aria-label="" name="company_address" placeholder="Company Address">{{$settings_by_id->company_address}}</textarea>

                                </div>

                                <div><br></div>

                                <!-- <div class="form-group" >

                                    <label>Publication Status</label> <br>
									
                                    <div class="btn-group" data-toggle="buttons">

                                        <label class="btn btn-default active" >
                                            <input type="radio" name="product_status" value="1" checked> &nbsp; Published &nbsp;
                                        </label>
                                        
                                        <label class="btn btn-default" >
                                            <input type="radio" name="product_status" value="0"> Unpublished
                                        </label>
                                        
                                    </div>

                                    <div><br></div>

                                </div> -->
                            </div>
                        </div>
                    </div>
					
					<div class="no_padding col-md-12 col-sm-12 col-xs-12">
					<br>
						<button type="submit" class="btn btn-success btn-lg"><i class="fa fa-cogs"></i> Save</button>
					</div>
					
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection