@extends('admin_master')  
@section('admin_main_content')
    
    <div class="right_col right_col_back" role="main">
    
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <div class="col-md-12 col-sm-12 ol-xs-12">
                        <h3 class="no_padding"><i class="fa fa-shopping-bag"></i> About Software</h3>
                    </div>
                </div>


                <?php 

                    $message = Session::get('message');

                    if ( $message !='') { ?>

                        <div class="col-md-12 col-sm-12 col-xs-12 no_padding">

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
                
                <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                    <div class="panel panel-amin">
                        <div class="panel-heading">
                            <h3 class="panel-title">About Software</h3>
                            
                        </div>

                        <div class="panel-body">

                            @if ( $data = count($all_product_info) > 0 ) 

                                
                               
                                
                              

                                <div id="print_content" class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                    
                                    <h3 class="panel-title">Welcome to PhMS365</h3><br>
                          
                                       <p></p> Software Version: 2.0 <p></p><br>
                                         <p style="font-size: 20px"> What's New? </p>
                                        <p>
                                        - Updates User interface.<br>
                                        - More User Friendly<br>
                                        - Accounts System Updates<br>
                                        - Purchase and Stock System Updates<br>
                                        - Increase Setting Policy
                                        </p><br><br>
                                       <p style="font-size: 20px"> Additional Information</p>
                                       
                                       <p>
                                           
                                           Updated: November 20, 2020<br>
                                        Total User: 200+<br>
                                        Developed By Muktodhara Technology Ltd<br>
                                        Purchases: BDT 20,000 (One Time)<br>
                                        Rent: BDT 1,500/-mo.<br>
                                        Contact for any Support<br>
                                        Address : K.N. Tower (Level-09), Badamtoli Circle, 18 Agrabad C/A, Chattogram,<br> Bangladesh.<br>
                                       </p>
                                        
                                        <p><b>Contact Info</b></p>
                                        
                                       <p><i class="fa fa-archive"></i> Web : www.muktodharaltd.com<br>
                                        <i class="fa fa-envelope-square"></i>   Email : info@muktodhara.biz<br>
                                        <i class="fa fa-phone"></i> Phone : 031-717050<br>
                                        <i class="fa fa-phone"></i> Mobile : +8801982211000</p>
                                        
                                
                                    
                                    </div>
                                </div>
                                
                                <div class="hide_pagin pull-right">
                                    @if ( $all_product_info != '' )
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{URL::to('/add-stock?page=1')}}">First</a> </li>
                                        </ul>

                                        {{ $all_product_info->links() }} 

                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{URL::to('/add-stock?page='.$all_product_info->lastPage())}}">Last</a> </li>
                                        </ul>
                                    @endif
                                </div>

                            @else 

                                <h4 class="text-center">Nothing Found..</h4>

                            @endif
                                
							<div class="clearfix"></div>

							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

@endsection

