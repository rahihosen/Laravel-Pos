@extends('admin_master')  
@section('admin_main_content')    

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    @if (count($errors) > 0)

                        <div class="alert alert-danger alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    <li>Your Image Size is too big.</li>
                                    <li>Maximum Image Size 2MB</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    
                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                        <h3><i class="fas fa-cog fa-spin"></i> Settings </h3>

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
                                    

                    <div class="box_layout right_padding col-md-12 col-sm-12 col-xs-12">
                               
                        {!!Form::open(['url'=>'/update-user-settings','method'=>'post','enctype'=>'multipart/form-data'])!!}

                            <h3>
                                <i class="fas fa-user-cog"></i> User Settings </h3> 
                            <hr>

                            <div class="no_padding right_padding col-md-5 col-sm-12 col-xs-12">

                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
								
                                    <label>ID:</label>

                                    <?php $admin_data = Auth::user()?>
									
                                    <input type="text" class="form-control admin_id" value="{{ $admin_data->id }}" disabled>
									
                                    <input type="hidden" name="admin_id" value="{{ $admin_data->id }}">
									
                                    <input type="hidden" class="old_image" name="old_image" >
                                    
                                </div>

                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
								
                                    <label for="user-name">User Name:</label>
									
                                    <input type="text" class="form-control" value="{{ $admin_data->name }}" name="admin_name" placeholder="User Name" id="user-name" required>
                                </div>
                                
                                
                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
                                
                                    <label for="user-image">User Image:</label>
                                    
                                    <input type="file" class="form-control" name="admin_image" id="user-image">
                                    
                                    <br>
                                    
                                    <img src="{{asset($admin_data->admin_image)}}" alt="{{ $admin_data->name }}" class="img-circle" height="80px" width="auto">
                                    
                                </div>

                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
                                    <label for="Old-Email">Old Email:</label>
                                    <input type="email" class="form-control" value="" name="old_email" placeholder="Old Email" id="Old-Email">
                                </div>
                                
                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
                                    <label for="New-Email">New Email:</label>
                                    <input type="email" class="form-control" value="" name="admin_email" placeholder="New Email" id="New-Email">
                                </div>
                                
                                
                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
                                    <label for="old-pass">Old Password:</label>
                                    <input type="psw" class="form-control" value="" name="old_password" placeholder="Old Password" id="old-pass">
                                </div>
                                
                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
                                    <label for="New-pass">New Password:</label>
                                    <input type="psw" class="form-control" value="" name="admin_password" placeholder="New Password" id="New-pass">
                                </div>
                                
                                <div class="form-group form-group-sm" style="margin-bottom: 25px;">
                                    <label for="RetypeNew-pass">Retype New Password:</label>
                                    <input type="psw" class="form-control" value="" name="retype_password" placeholder="Retype New Password" id="RetypeNew-pass">
                                </div>
				

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-cogs"></i> Save Settings</button>
                                </div> 

                            </div> 

                        {!! Form::close() !!}

                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection