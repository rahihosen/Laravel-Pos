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

                        <h3><i class="fa fa-user-plus"></i> User Management </h3>
                        
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
                    

                    <div class="no_padding res_no_padding right_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Add User</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-admin','method'=>'post','enctype'=>'multipart/form-data']) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label for="Admin-name">Admin Name </label>
										
                                        <input type="text" id="Admin-name" placeholder="Name" name="admin_name" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="addminEmail">Admin E-mail</label>
										
                                        <input type="text"  placeholder="E-mail" id="addminEmail" name="admin_email" class="form-control" required>
                                        
                                    </div>
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="adminPhoto" style="padding-top: 10px;">Admin Photo </label>
										
                                        <input type="file" id="adminPhoto" name="admin_image" class="form-control" required>
                                    
                                    </div>
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="adminPassword" style="padding-top: 10px;">Admin Password </label>

                                        
                                        <input id="adminPassword" placeholder="Password" type="password" name="admin_password" class="form-control" required>
                                        
                                    </div>

                                    <div class="form-group form-group-sm">

                                        <label for="adminRole" style="padding-top: 10px;">Admin Role </label>

                                        
                                        <select id="adminRole" name="admin_role" class="form-control">
                                       
                                            <option value="1">Admin</option>
                                            <option value="2">Manager</option>
                                            <option value="3" selected>Salesman</option>
                                        
                                        </select>
                                        
                                    </div>
                                   

                                    <div class="form-group" style="padding-top: 10px;">
                                        <label>Active?</label>

                                        <div><br></div>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default active" >
                                                <input type="radio" name="admin_status" value="1" checked> &nbsp; Yes &nbsp;
                                            </label>

                                            <label class="btn btn-default">
                                                <input type="radio" name="admin_status" value="0" required> No
                                            </label>
                                        </div>
                                        
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="form-group form-group-sm">
									
                                        <button type="submit" class="btn btn-success">Save</button>
										<br>
										<br>
										<br>
                                        
                                    </div>

                                {!! Form::close() !!}                                
                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="no_padding col-md-8 col-sm-8 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">User List</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">                                    

                                    <table class="table table-striped table-responsive table-bordered">

                                        @if ( $data = count($all_admin_info) > 0 )

                                            <thead>
                                                <tr class="headings">
                                                    <th class="text-center">ID </th>
                                                    <th class="text-center">Name </th>
                                                    <th class="text-center">Email </th>
                                                    <th class="text-center">Photo </th>
                                                    <th class="text-center">Role</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action </th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($all_admin_info as $admin)
                                                
                                                    <?php
                                                        if($admin->admin_role == 1){
                                                            $admin_role = "Admin";
                                                        }
                                                        if($admin->admin_role == 2){
                                                            $admin_role = "Manager";
                                                        }
                                                        if($admin->admin_role == 3){
                                                            $admin_role = "Salesman";
                                                        }
                                                    
                                                    ?>

                                                    <tr class="even pointer">
                                                        <td class="text-center">{{$admin->id}}</td>
                                                        <td class="text-center">{{$admin->name}}</td>
                                                        <td class="text-center">{{$admin->email}}</td>
                                                        <td class="text-center"><img src="{{$admin->admin_image}}" width="auto" height="50"></td>
                                                        <td class="text-center">{{$admin_role}}</td>
                                                        <td class="text-center">

                                                            @if($admin->admin_status==1) 

                                                                <label class="label label-success">Publish</label>

                                                            @else 

                                                                <label class="label label-warning">Unpublish</label>

                                                            @endif
                                                            
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <button 
                                                                class="btn btn-dark btn-xs edit_admin"

                                                                value="{{$admin->id}}"
                                                                adminName="{{$admin->name}}"
                                                                adminEmail="{{$admin->email}}"
                                                                adminPassword="{{$admin->password}}"
                                                                adminImage="{{$admin->admin_image}}"
                                                                oldImage="{{$admin->admin_image}}"
                                                                adminRole="{{$admin->admin_role}}"
                                                                adminStatus="{{$admin->admin_status}}"

                                                                ><i class="far fa-edit"></i> Edit
                                                            
                                                            </button>
                                                              <a href="{{URL::to('/admin-delete/'.$admin->id)}}" onclick="return checkDelete()" class="btn btn-dark btn-xs"> <i class="glyphicon glyphicon-remove"></i> Delete</a>
                                                            
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                    
                                            </tbody>

                                        @else

                                            <h4 class="text-center">Nothing Found...</h4>
                                        
                                        @endif
                                        
                                    </table>
                                    
                                </div>
                        
                                <div class="pagi_box pull-right">

                                    @if ( $all_admin_info != '')
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{URL::to('/admin-list?page=1')}}">First</a> </li>
                                        </ul>
                                            {{ $all_admin_info->links() }}
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{URL::to('/admin-list?page='.$all_admin_info->lastPage())}}">Last</a> </li>
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

    <!-- /page content -->

    <!-- Edit Admin Modal -->
    <div style="z-index:9999999999" class="modal fade edit_admin_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Edit <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-admin','method'=>'post','enctype'=>'multipart/form-data'])!!}

                        <div class="form-group form-group-sm">
                            <label class="control-label" >ID </label>
							
                            <input type="text" class="form-control admin_id" disabled>
							
                            <input type="hidden" name="admin_id" class="form-control admin_id">
							
                            <input type="hidden" class="old_image" name="old_image" >
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="name">Admin Name </label>
							
                            <input type="text" name="admin_name" id='name' value="" class="form-control admin_name" placeholder="Admin Name" required>

                        </div>

                        <div class="form-group form-group-sm">

                            <label for="pass"> Admin Password </label>
                            <input type="password"  id="pass" name="admin_password" value="" class="form-control admin_password" placeholder="Password">
                            
                        </div>

                        <div class="form-group form-group-sm">
                        
                            <label for="email">Admin Email</label>
                            <input type="text" id="email" name="admin_email" class="form-control admin_email" placeholder="Admin Email" required>
                            
                        </div>
                        
                        <div class="form-group form-group-sm">

                            <label for="imge">Admin Image</label>
							
                            <input type="file" id="imge" name="admin_image"  class="clear_image form-control">
							
                            <img src="" alt="image" class="admin_img top_margin" width="auto" height="60px" >

                        </div>

                        <div class="form-group form-group-sm">

                            <label for="role" style="padding-top: 10px;">Admin Role</label>

                            
                            <select id="role" name="admin_role" class="form-control">
                            
                                <option class="role" value=""></option>

                                <option value="1">Admin</option>
                                <option value="2">Manager</option>
                                <option value="3">Salesman</option>
                            
                            </select>
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label> Active? </label>

                            <br>

                            <div class="btn-group" data-toggle="buttons">

                                <label class="edit_admin_type_active btn btn-default" >
                                    <input type="radio" name="admin_status" value="1"> &nbsp; Yes &nbsp;
                                </label>

                                <label class="edit_admin_type_inactive btn btn-default">
                                    <input type="radio" name="admin_status" value="0"> No
                                </label>

                            </div>
                            
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