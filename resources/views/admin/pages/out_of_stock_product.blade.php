@extends('admin_master')  
@section('admin_main_content')
    
    <div class="right_col right_col_back" role="main">
    
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3><i class="fa fa-shopping-bag"></i> Out of Stock</h3>
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
                            <h3 class="panel-title">Out of Stock List</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>

                        <div class="panel-body">
						
							<div ng-app="app" ng-controller="ctrl">
							    
							    <button type="button" ng-click="printDiv('print_outstockout');" class="btn btn-danger">Print</button>
							
                                <div id="print_outstockout">
                                    <div class="table-responsive print_stockout">
                                        
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="headings">
                                                    
                                                    <th class="text-center"> Product ID </th>
                                                    <th class="text-center"> Product Name </th>
                                                    <th class="text-center"> Current Stock </th>
                                                    <th class="text-center"> Requirement </th>
                                                    <th class="text-center"> Value </th>
        
                                                </tr>
                                            </thead>
        
                                            <tbody class="search_results">
        									
                                                <?php foreach($all_product_info as $product) { ?>
        
                                                <?php  $pid = $product->product_id; 
        										
        											$total = DB::table('stock')->where('product_id', $pid)->sum('stock_quantity');
        											$total2 = DB::table('wastage')->where('product_id', $pid)->sum('wastage_quantity');
        											$total3 = DB::table('order_details')->where('product_id', $pid)->where('order_details_status', 1)->sum('product_qty');
        											$result = ($total - $total2 - $total3);
        											if($result < $product->out_of_stock_range){
        												
        										?>
        						
                                                    <tr class="even pointer">
                                                        
                                                        <td class="text-center">{{$product->product_id}}</td>
                                                        <td class="text-center">{{$product->product_name}}</td>
                                                        <td class="text-center">
                                                            <?php 
                                                                echo $result;
                                                            ?>
                                                        </td> 
                                                        <td class="text-center">
                                                        
                                                            <div class="form-group form-group-sm">
                                								
                                								<input ng-model="Requirement{{$product->product_id}}" ng-value="Requirement{{$product->product_id}}" type="text" class="form-control" />
                                								
                                							</div>
                                                        
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                        
                                                            <div class="form-group form-group-sm">
                                								
                                								<input ng-model="Value{{$product->product_id}}" ng-value="Value{{$product->product_id}}" type="text" class="form-control" />
                                								
                                							</div>
                                                        
                                                        </td>
                                                    </tr>
        
                                                <?php  }
        										
        										} ?>
        
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                                
                            </div>
							
                        </div>    
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

@endsection

