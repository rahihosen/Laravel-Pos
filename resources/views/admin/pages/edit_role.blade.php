@extends('admin_master')  
@section('admin_main_content')

    <style>
        .right_margin input {
            margin-left: 10px;
        }
    </style>


    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <h3><i class="fa fa-cogs"></i> Role Settings </h3>
                    
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

                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                    <div class="panel panel-amin">

                        <div class="panel-heading">
                            <h3 class="panel-title">Admin Role </h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">

                                <table class="table table-striped  bulk_action table-responsive table-bordered">
                                    <thead>
                                        
                                    </thead>

                                    <tbody class="search_results">

                                        <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                            
                            

                                            {!!Form::open(['url'=>'/update-role','method'=>'post','enctype'=>'multipart/form-data','name'=>'edit_role'])!!}
                                        
                                                <?php

                                                    $str=DB::table('admin_role')->first();
                                                
                                                    $admin = explode(",",$str->admin_role_features);
                                                    $manager = explode(",",$str->manager_role_features);
                                                    $salesman = explode(",",$str->salesman_role_features);
                                                    
                                                    function check_function($op, $uo){
                                                        if(in_array($op,$uo)){
                                                            return "checked";
                                                        }else{
                                                            return " ";
                                                        }
                                                    }
                                                    $admin_checked_user = check_function(1,$admin);
                                                    $admin_checked_settings = check_function(2,$admin);
                                                    $admin_checked_report = check_function(3,$admin);
                                                    $admin_checked_order = check_function(4,$admin);
                                                    $admin_checked_product = check_function(5,$admin);
                                                    $admin_checked_customer = check_function(6,$admin);
                                                    $admin_checked_account = check_function(7,$admin);
                                                    $admin_checked_purchase = check_function(8,$admin);
                                                    
                                                    $manager_checked_user = check_function(1,$manager);
                                                    $manager_checked_settings = check_function(2,$manager);
                                                    $manager_checked_report = check_function(3,$manager);
                                                    $manager_checked_order = check_function(4,$manager);
                                                    $manager_checked_product = check_function(5,$manager);
                                                    $manager_checked_customer = check_function(6,$manager);
                                                    $manager_checked_account = check_function(7,$manager);
                                                    $manager_checked_purchase = check_function(8,$manager);
                                                    
                                                    $salesman_checked_user = check_function(1,$salesman);
                                                    $salesman_checked_settings = check_function(2,$salesman);
                                                    $salesman_checked_report = check_function(3,$salesman);
                                                    $salesman_checked_order = check_function(4,$salesman);
                                                    $salesman_checked_product = check_function(5,$salesman);
                                                    $salesman_checked_customer = check_function(6,$salesman);
                                                    $salesman_checked_account = check_function(7,$salesman);
                                                    $salesman_checked_purchase = check_function(8,$salesman);
                                                    
                                                ?>

                                                <br>

                                                <label style="margin-bottom: 15px;"><h4>Admin Role: </h4></label>

                                                    <br>

                                                    <div class="input-group">

                                                        <div class="input-group-prepend ">
                                                            <div class="input-group-text right_margin">

                                                                <input type="checkbox" style="margin: 0;" name="admin_role_features[]" value="1" {{$admin_checked_user}} disabled> User

                                                                <input type="checkbox" name="admin_role_features[]" value="2" {{$admin_checked_settings}} disabled> Settings

                                                                <input type="checkbox" name="admin_role_features[]" value="3" {{$admin_checked_report}} disabled> Report

                                                                <input type="checkbox" name="admin_role_features[]" value="4" {{$admin_checked_order}} disabled> Order

                                                                <input type="checkbox" name="admin_role_features[]" value="5" {{$admin_checked_product}} disabled> Product
																
                                                                <input type="checkbox" name="admin_role_features[]" value="6" {{$admin_checked_customer}} disabled> Customer
																
                                                                <input type="checkbox" name="admin_role_features[]" value="7" {{$admin_checked_account}} disabled> Accounts
																
                                                                <input type="checkbox" name="admin_role_features[]" value="8" {{$admin_checked_purchase}} disabled> Purchase
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    
                                                    <br>
                                                    <hr>

                                                <label style="margin-bottom: 15px;"><h4>Manager Role:</h4></label>
                                    
                                                    <br>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend ">
                                                            <div class="input-group-text right_margin">

                                                                <input type="checkbox" style="margin: 0;" name="manager_role_features[]" value="1" {{$manager_checked_user}}> User
                                                        
                                                                <input type="checkbox" name="manager_role_features[]" value="2" {{$manager_checked_settings}}> Settings

                                                                <input type="checkbox" name="manager_role_features[]" value="3" {{$manager_checked_report}}> Report

                                                                <input type="checkbox" name="manager_role_features[]" value="4" {{$manager_checked_order}}> Order

                                                                <input type="checkbox" name="manager_role_features[]" value="5" {{$manager_checked_product}}> Product
																
                                                                <input type="checkbox" name="manager_role_features[]" value="6" {{$manager_checked_customer}}> Customer
																
                                                                <input type="checkbox" name="manager_role_features[]" value="7" {{$manager_checked_account}}> Accounts
																
                                                                <input type="checkbox" name="manager_role_features[]" value="8" {{$manager_checked_purchase}}> Purchase

                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <br>
                                                    <hr>

                                                <label style="margin-bottom: 15px;"><h4>Salesman Role:</h4></label>
                                    
                                                    <br>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text right_margin">

                                                                <input type="checkbox" style="margin: 0;" name="salesman_role_features[]" value="1" {{$salesman_checked_user}}> User

                                                                <input type="checkbox" name="salesman_role_features[]" value="2" {{$salesman_checked_settings}}> Settings

                                                                <input type="checkbox" name="salesman_role_features[]" value="3" {{$salesman_checked_report}}> Report

                                                                <input type="checkbox" name="salesman_role_features[]" value="4" {{$salesman_checked_order}}> Order

                                                                <input type="checkbox" name="salesman_role_features[]" value="5" {{$salesman_checked_product}}> Product        
																
                                                                <input type="checkbox" name="salesman_role_features[]" value="6" {{$salesman_checked_customer}}> Customer
																
                                                                <input type="checkbox" name="salesman_role_features[]" value="7" {{$salesman_checked_account}}> Accounts
																
                                                                <input type="checkbox" name="salesman_role_features[]" value="8" {{$salesman_checked_purchase}}> Purchase
																

                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    
                                                    <br>
                                                    
                                                <div class="ln_solid"></div>

                                                <div class="form-group">
                                                        
                                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-cogs"></i> Update</button>
                                                    
                                                </div>

                                            {!! Form::close()!!}

                                        </div>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        

                    </div>

                </div>
                
            </div>
        </div>
    </div>

    <!-- /page content -->
@endsection