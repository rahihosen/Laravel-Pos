@extends('admin_master')  
@section('admin_main_content')
    
    <div class="right_col right_col_back" role="main">
    
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                    <div class="col-md-12 col-sm-12 ol-xs-12">
                        <h3 class="no_padding"><i class="fa fa-shopping-bag"></i> Stock</h3>
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
                            <h3 class="panel-title">Stock List</h3>
                            <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                        </div>

                        <div class="panel-body">

                            @if ( $data = count($all_product_info) > 0 ) 

                                <div class="no_padding col-md-3 col-sm-3 col-xs-12 form-group-sm">
                                
                                    <input type="text" class="search_stock form-control" placeholder="Search...">
                                    <br>
                                    
                                </div>

                                <div class="no_padding col-md-3 col-sm-3 col-xs-12 form-group-sm">
                                    
                                    <select name="fk_category_id" class="form-control fk_category_id" >

                                        <option value="0">None</option>

                                        <?php  $categorys = DB::table('category')->get(); ?>
                                        
                                        @foreach ( $categorys as $category )

                                            <option value="{{$category->category_id }}">{{ $category->category_name }}</option>

                                        @endforeach

                                    </select>
                                    <br>
                                </div>
                                
                                <div class="res_no_padding col-md-3 col-sm-3 col-xs-12 form-group-sm">
                                
                                    <button type="button" class="name_from_to_stock_list btn btn-success btn-sm">Go!</button>
                                    
                                    <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                    
                                </div>

                                <div id="print_content" class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                
                                    <h4 class="bottom_padding top_padding">Stocks</h4>
                                    
                                    <div class="table-responsive" style="width:100%;">
                                        
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="headings">
                                                    
                                                    <th class="text-center"> Product ID </th>
                                                    <th class="text-center"> Product Name </th>                                        
                                                    <th class="text-center"> Current Stock </th>
                                                    <th class="text-center"> Last Stock In </th>
                                                    <th class="text-center"> Total Sold </th>
                                                    <th class="text-center"> Total Wastage </th>
                                                    <th class="text-center hide_print_sec"> Action </th>

                                                </tr>
                                            </thead>

                                            <tbody class="search_results">
                                            
                                                @foreach($all_product_info as $product)

                                                    <?php  $pid = $product->product_id; ?>

                                                    <tr class="even pointer">
                                                        
                                                        <td class="text-center">{{$product->product_id}}</td>
                                                        <td class="text-center">{{$product->product_name}}</td>
                                                        <td class="text-center">
                                                            <?php 
                                                                $total = DB::table('stock')->where('product_id', $pid)->sum('stock_quantity');
                                                                
                                                                $total2 = DB::table('wastage')->where('product_id', $pid)->sum('wastage_quantity');

                                                                $total3 = DB::table('order_details')->where('product_id', $pid)->where('order_details_status', 1)->sum('product_qty');
                                                                
                                                                $result = ($total - $total2 - $total3);

                                                                echo $result;
                                                            ?>
                                                        </td>                                            
                                                        <td class="text-center">

                                                            <?php
                                                                $single_product = DB::table('stock')->where('product_id', $product->product_id)->orderBy('stock_id', 'DESC')->value('stock_quantity');
                                                                
                                                                if($single_product == ''){
                                                                    $single_product = 0;
                                                                }

                                                                echo $single_product;
                                                            ?>
                                                            
                                                        </td>

                                                        <td class="text-center">
                                                            <?php 
                                                                $total = DB::table('order_details')->where('product_id', $pid)->where('order_details_status', 1)->sum('product_qty');
                                                                echo $total;
                                                            ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <?= DB::table('wastage')->where('product_id', $product->product_id)->sum('wastage_quantity');?>
                                                        </td>
                                                        
                                                        <td class="last text-center hide_print_sec">
                                                            
                                                            <button
                                                                class="btn btn-primary btn-xs add_stock" 
                                                                value="{{$product->product_id}}" 
                                                                data-productName="{{$product->product_name}}" 
                                                                ><i class="glyphicon glyphicon-plus-sign"></i> Add Stock
                                                            </button>

                                                            <button 
                                                                class="btn btn-info btn-xs view_stock" 
                                                                value="{{$product->product_id}}" 
                                                                data-productName="{{$product->product_name}}"
                                                                ><i class="glyphicon glyphicon-eye-open "></i> View Stock
                                                            </button>

                                                            <button 
                                                                class="btn btn-primary btn-xs add_wastage" 
                                                                value="{{$product->product_id}}" 
                                                                data-productName="{{$product->product_name}}"
                                                                ><i class="glyphicon glyphicon-plus-sign"></i> Add Wastage
                                                            </button>
                                                            
                                                            <button class="btn btn-info btn-xs view_wastage" value="{{$product->product_id}}" data-productName="{{$product->product_name}}">
                                                                <i class="glyphicon glyphicon-eye-open "></i> View Wastage
                                                            </button>

                                                        </td>
                                                    </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
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

    <!-- Modal Add Stock -->
    <div style="z-index:9999999999" class="modal fade add_stock_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Add Stock <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/update-stock', 'method'=>'post'])!!}
                        
                        <div class="form-group form-group-sm">
						
                            <input type="hidden" name="product_id" value="" class="form-control product_id" required>

                            <label >Product ID</label>
							
                            <input type="text" class="form-control product_id" value="" disabled>

                        </div>

                        <div class="form-group form-group-sm">

                            <label>Product Name</label>
							
                            <input type="text" name="product_name" value="" class="form-control product_name" disabled> 
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="Stock">New Stock Quantity</label>
							
                            <input type="number" placeholder="Quantity" id="Stock" name="stock_quantity" min="0" class="form-control stock_quantity" required>
                            
                        </div>       

						<div class="form-group form-group-sm">

                            <label for="purchase_price">Purchase Price</label>
							
       <!--                     <select id="purchase_price" name="purchase_price" class="form-control">-->
							<!--	<option value='0'>0</option>-->
							<!--</select>-->
							
							<input type="number" placeholder="Purchase Price" id="purchase_price" value="0" name="purchase_price" min="0" class="form-control" required>
                            
                        </div>  						

                        <div class="ln_solid"></div>
                        
                        <div class="form-group">
						
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

    <!-- Modal View Stock -->
    <div style="z-index:9999999999" class="modal fade view_stock_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Stock "<span class="product_name"></span>" <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date / Time</th>
                                    <th class="text-center">Added By</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Purchase Price</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="return_product">
                                
								
                            </tbody>
                        </table>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>


    <!-- Modal Add Wastage -->
    <div style="z-index:9999999999" class="modal fade add_wastage_modal" id="edit" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">Add Wastage <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    {!!Form::open(['url'=>'/store-wastage', 'method'=>'post'])!!}
                        
                        <div class="form-group form-group-sm">
						
                            <input type="hidden" name="product_id" value="" class="form-control product_id">

                            <label>Product ID</label>
                            <input type="text" class="form-control product_id" value="" disabled>

                        </div>

                        <div class="form-group form-group-sm">

                            <label>Product Name</label>
							
                            <input type="text" name="product_name" value="" class="form-control product_name" disabled>
							
                            
                        </div>

                        <div class="form-group form-group-sm">

                            <label for="purchase_price">Purchase Price</label>
							
                            <select id="purchase_price" name="purchase_price" class="form-control wastage_pur_prc">
								
							</select>
                            
                        </div>    

						<div class="form-group form-group-sm">

                            <label for="Quantity">Wastage Quantity</label>
							
                            <input type="number" id="Quantity" placeholder="Wastage Quantity" name="wastage_quantity" min="0" class="form-control wastage_quantity" required>
                            
                        </div>   						

                        <div class="ln_solid"></div>
                        
                        <div class="form-group">
						
                            <button type="submit" class="btn btn-success">Add Wastage</button>
                           
                        </div>

                    {!! Form::close()!!}
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>
	
	 <!-- Modal View Stock -->
    <div style="z-index:9999999999" class="modal fade view_wastage_modal" id="" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div class="modal-header">                    
                    <h4 class="modal-title">View Wastage "<span class="product_name"></span>" <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
                </div>

                <div class="modal-body">
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date / Time</th>
                                    <th class="text-center">Added By</th>
                                    <th class="text-center">Purchase Price</th>
                                    <th class="text-center">Quantity</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="return_product">
                                
                                
								
                            </tbody>
                        </table>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>	  
        </div>
    </div>

@endsection

