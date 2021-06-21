@extends('admin_master')
@section('admin_main_content')

<!-- page content -->
<div class="right_col right_col_back" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box_layout col-md-12 col-sm-12 col-xs-12">

                <h3><i class="fa fa-plus" aria-hidden="true"></i>Purchase or Add </h3>

            </div>

            <?php

            $message = Session::get('message');

            if ($message != '') { ?>

                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                    <h5 class="text-center">

                        <?php

                        if (isset($message)) { ?>

                            <div class="alert alert-success alert-dismissible fade in" style="margin: 0;margin-bottom: 12px;box-shadow: 4px 4px 5px rgb(204, 203, 203);">

                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong> <?php echo $message; ?> </strong>

                            </div>

                        <?php
                            Session::put('message', '');
                        }
                        ?>

                    </h5>
                </div>

            <?php
            }

            ?>



            <div class="no_padding col-md-12 col-sm-12 col-xs-12">

                <div class="panel panel-amin">

                    <div class="panel-heading">
                        <ul class="nav nav-tabs" style="border-bottom: 0px solid #843c3c!important;">
                            <li class="active"><a data-toggle="tab" href="#home1">Add purchase</a></li>
                            <li><a data-toggle="tab" href="#menu5">Add Stock</a></li>
                            <li><a data-toggle="tab" href="#outofstock">Out of Stock Product</a></li>
                            

                        </ul>
                    </div>

                    <div class="panel-body tab-content">
                                     
                                     
                                     <!--Add Or purchase    tab one-->
                        <div class="no_padding col-md-12 col-sm-12 col-xs-12 tab-pane fade in active" id="home1">
                            {!! Form::open(['url' => '/save-purchase-new', 'method'=>'post']) !!}


                            <div class="form-group form-group-sm">

                                <label for="select-buyer">Select Supplier:</label>

                                <select id="select-buyer" class="form-control" name="buyer_id">

                                    <?php

                                    foreach ($all_buyers as $all_buyers) { ?>

                                        <option value="<?= $all_buyers->buyer_id; ?>"><?= $all_buyers->buyer_name; ?> (<?= $all_buyers->buyer_mobile; ?>)
                                        </option>

                                    <?php

                                    }
                                    ?>

                                </select>

                            </div>

                            <div class="form-group-sm">

                                <label for="Purchase-note">Purchase Note: </label>

                                <input id="Purchase-note" type="text" class="form-control" name="purchase_note" placeholder="Purchase Note" required>

                                <br>
                            </div>


                            <div class="panel-heading">
                                <h3 class="panel-title">Purchase</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body add_product_panel">

                                <div class="no_padding col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1.5em;">
                                    <div class="form-group form-group-sm">

                                        <button type="button" value="1" class="bill_remove_field btn btn-danger btn-xs" style="padding: 5px 10px 5px 10px;"><i class="fa fa-minus"></i></button>

                                        <button type="button" value="1" class="bill_add_more_field btn btn-xs btn-primary" style="padding: 5px 10px 5px 10px;"><i class="fa fa-plus"></i></button>
                                         <button type="button" value="1" class="btn btn-xs btn-primary add_supplier" style="margin-left: 7px;"><i class="fa fa-pencil-square-o"></i>Add Product</button>

                                    </div>
                                    <!-- <label for="select-buyer">Add Product:</label><button type="button" value="1" class="btn btn-xs btn-primary add_supplier" style="margin-left: 7px;"><i class="fa fa-pencil-square-o"></i></button> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       
                                    </div>
                                </div>

                                <div class="text-center no_padding col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">

                                        <label>SL</label>

                                    </div>
                                </div>

                                <div class="text-center no_padding col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">

                                        <label>Purchase Item</label>

                                    </div>
                                </div>

                                <div class="text-center col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">

                                        <label>Purchase Price</label>

                                    </div>
                                </div>


                                <div class="text-center  col-md-2 col-sm-2 col-xs-12" style="padding-left: 0;">
                                    <div class="form-group-sm">

                                        <label>Quantity</label>

                                    </div>
                                </div>

                                <div class="text-center no_padding col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">

                                        <label>Total</label>

                                    </div>
                                </div>
                                <div class="text-center no_padding col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">

                                        <label>Expired Date</label>

                                    </div>
                                </div>

                                <!-- This line For Breake using br tag -->
                                <div class="text-center no_padding col-md-12 col-sm-12 col-xs-12">

                                </div>


                                <div class="no_padding col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group-sm">

                                        <input type="text" class="res_marginBT10 form-control increment" value="# 1" disabled>


                                    </div>
                                </div>

                                <div class="content_data">

                                    <div class="no_padding col-md-2 col-sm-2 col-xs-12">

                                        <div class="form-group-sm">

                                            <input type="hidden" class="get_product_id" name="product_id[]" required>

                                            <input type="text" class="res_marginBT10 search_allPros search_input form-control" name="product_name" placeholder="Search..." required>

                                            <div class="search_box" style="display: none;"></div>

                                        </div>
                                    </div>

                                    <div class="res_no_padding col-md-2 col-sm-2 col-xs-12">
                                        <div class="form-group-sm">

                                            <input name="product_purchase_price[]" type="text" title="Numbers Only" class="res_marginBT10 upPurcPrice enable_field form-control text-center" placeholder="Purchase Price" required disabled>


                                        </div>
                                    </div>

                                    <div class="no_padding col-md-2 col-sm-2 col-xs-12">

                                        <div class="form-group-sm" style="position: relative;">

                                            <input type="text" class="res_marginBT10 product_quantity form-control text-center enable_field_que" value="0" name="product_quantity[]" pattern="(^[0-9]{1,11})" title="Numbers Only" placeholder="Product Quantity" required disabled>

                                            <div class="form-group form-group-sm" style="position: absolute;top: 1px; width: 58px;right: 0;">

                                                <button type="button" value="1" class="qun_remove_field btn btn-danger btn-xs enable_field_que" disabled><i class="fa fa-minus"></i></button><button type="button" value="1" class="qun_add_field btn btn-xs btn-primary enable_field_que" disabled><i class="fa fa-plus"></i></button>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="no_padding col-md-2 col-sm-2 col-xs-12">
                                        <div class="form-group-sm">

                                            <input type="text" class="res_marginBT10 upTotalPrice upTotalPrice_1 form-control text-center" value="0" placeholder="Total" disabled>

                                            <input type="hidden" name="order_total_price[]" class="upTotalPrice" required>

                                        </div>
                                    </div>
                                    <div class="no_padding col-md-2 col-sm-2 col-xs-12">
                                        <div class="form-group-sm">

                                            <input type="date" name="expire_date" class="expire_date form-control text-center" placeholder="date" required>

                                            

                                        </div>
                                    </div>
                                </div>

                                <span class="field_to_add_before"></span>

                                <div class="no_padding col-md-12 col-sm-12 col-xs-12">
                                    <hr>
                                </div>



                                <div class="no_padding col-md-7 col-sm-7 col-xs-12">
                                    <div class="form-group form-group-sm">

                                        <h4>Important Notes:</h4>
                                        <br>

                                        <p>
                                            <i class="fa fa-check"></i> Once Invoice Issued Can Not Be Changed.<br>
                                        </p>
                                    </div>
                                </div>


                                <div class="no_padding col-md-5 col-sm-5 col-xs-12">
                                    <div class="form-group-sm text-center">

                                        <label>Sub Total</label>

                                        <input type="text" class="sub_total form-control text-center" value="0" placeholder="Sub Total" disabled>

                                        <input type="hidden" name="purchase_total" class="sub_total" required>

                                        <br>
                                    </div>


                                    <div class="form-group-sm text-center" style="position:relative;">

                                        <label>Discount</label>

                                        <input type="text" class="total_discount form-control text-center" value="0" name="purchase_discount" pattern="(^[0-9]{1,11})" title="Numbers Only" placeholder="Discount" required disabled>

                                        <select name="purchase_discount_type" class="purchase_discount_type form-control" disabled>

                                            <option value="1">৳</option>
                                            <option value="2">%</option>

                                        </select>
                                        <br>
                                    </div>

                                    <div class="form-group-sm text-center">

                                        <label>After Discount</label>

                                        <input type="text" class="after_discount form-control text-center" value="0" pattern="(^[0-9]{1,11})" title="Numbers Only" placeholder="After Discount" required disabled>

                                        <input type="hidden" class="after_discount" name="after_discount">
                                        <br>
                                    </div>

                                    <div class="form-group-sm text-center" style="display: none;">

                                        <label>Vat</label>


                                        <select id="" name="purchase_vat" class="total_vat form-control text-center" disabled>

                                            <?php $vat = DB::table('vat')->where('vat_status', 1)->get(); ?>

                                            @foreach ( $vat as $vat )

                                            <option value="{{$vat->vat_amount }}">{{ $vat->vat_name }}</option>

                                            @endforeach
                                        </select>
                                        <br>
                                    </div>



                                    <div class="form-group-sm text-center">

                                        <label>Ammount Payable</label>

                                        <input type="text" class="ammount_payable form-control text-center" value="0" placeholder="Ammount Payable" disabled>

                                        <input type="hidden" name="total_ammount_payable" class="ammount_payable">

                                        <br>
                                    </div>


                                </div>

                                <div class="no_padding col-md-12 col-sm-12 col-xs-12">

                                    <h3>Payment</h3>

                                    <hr>

                                    <div class="text-center no_padding col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">

                                            <label for="income-accounts">Select Account</label>

                                            <select id="income-accounts" class="form-control active" name="payment_account_id">

                                                <?php

                                                foreach ($all_accounts as $all_accounts) { ?>

                                                    <option value="<?= $all_accounts->account_id; ?>"><?= $all_accounts->account_name; ?> </option>

                                                <?php
                                                }
                                                ?>

                                            </select>
                                            <br>
                                        </div>
                                    </div>



                                    <div class="text-center col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">

                                            <label for="income-check">Cheque No.</label>

                                            <input id="income-check" type="text" class="form-control" name="payment_check_no" placeholder="Cheque No.">
                                            <br>
                                        </div>
                                    </div>

                                    <div class="text-center no_padding col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">

                                            <label for="income-transaction">Receipt / Transaction No.</label>

                                            <input id="income-transaction" type="text" class="form-control" name="payment_transaction_no" placeholder="Receipt / Transaction No.">
                                            <br>
                                        </div>
                                    </div>

                                    <div class="text-center no_padding col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group-sm">

                                            <label for="income-ammount">Ammount</label>

                                            <input pattern="[0-9]+([\.,][0-9]+)?" min="0" step="0.01" title="Numbers Only" id="income-ammount" type="number" class="form-control payment_ammount_max" name="payment_ammount" placeholder="Ammount" required>

                                            <br>

                                        </div>
                                    </div>

                                    <div class="text-center right_no_pad col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group-sm">

                                            <label for="income-note">Note</label>

                                            <input id="income-note" type="text" class="form-control" name="payment_note" placeholder="Note">

                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center box_layout col-md-12 col-sm-12 col-xs-12">

                                <button type="submit" class="btn btn-primary">Create</button>

                            </div>

                            {!! Form::close() !!}
                            <br>
                            <br>

                            <div class="row">
                                <h4 class="bottom_padding top_padding" style="text-align: center;"><b>Product List</b></h4>

                                <div id="print_content" class="col-md-12 col-sm-12 col-xs-12 no_padding">



                                    <div class="no_padding col-sm-4 col-xs-12 form-group-sm">

                                        <input type="text" class="search_product form-control" placeholder="Search...">
                                        <br>

                                    </div>

                                    <div class="no_padding col-md-2 col-sm-4 col-xs-12 form-group-sm">
                                        <select class="form-control fk_category_id_search">
                                            
                                            <option value="0">Category</option>
                                            @foreach($published_category as $category)

                                            <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                             @endforeach


                                        </select>
                                        <br>
                                    </div>



                                    <div class="no_padding col-md-2 col-sm-4 col-xs-12 form-group-sm">
                                       
                                        <select class="form-control type_id_search">
                                           
                                              <option value="">Type</option>
                                                @foreach($type as $type2)
                                            

                                        <option value="{{$type2->type_id}}">{{$type2->type_name}}</option>
                                        @endforeach



                                        </select>
                                        
                                        <br>
                                    </div>



                                    <div class="col-md-2 col-sm-2 col-xs-12 form-group-sm res_no_padding">

                                        <button type="button" class="name_from_to_product_list1 btn btn-success btn-sm">Go!</button>

                                        <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                        


                                    </div>



                                    <div class="table-responsive" style="width:100%;">


                                        <table class="table table-striped table-bordered">

                                            <thead>
                                                <tr>

                                                    <th class="text-center">Brand Name</th>

                                                    <th class="text-center">Generices</th>

                                                    <th class="text-center">Type</th>
                                                    <th class="text-center">stock</th>
                                                    <th class="text-center hide_print_sec">Entry Date</th>
                                                    <th class="text-center hide_print_sec">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="search_results">


                                                @foreach($all_product_info2 as $product)
                                                <tr class="even pointer">

                                                    <td class="text-center">
                                                        {{$product->product_name}}

                                                    </td>



                                                    <td class="text-center">
                                                        {{$product->category_name}}


                                                    </td>
                                                    <td class="text-center">{{$product-> type_name}}</td>

                                                    <td class="text-center">{{$product-> stock_quantity}}</td>
                                                    <td class="text-center">

                                                        {{$product->product_created_date}}

                                                    </td>
                                                    <td class="last text-center hide_print_sec">
                                                        <!-- <button class="btn btn-dark btn-xs edit_product" "><i class=" far fa-edit"></i> Edit
                                                        </button> -->

                                                        <button class="btn btn-info btn-xs view_product" value="{{$product->product_id}}"><i class="far fa-eye"></i> Report

                                                        </button>

                                                    </td>
                                                </tr>
                                                @endforeach



                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="hide_pagi pull-right">

                                    @if ( $all_product_info != '')

                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="{{URL::to('/product-list?page=1')}}">First</a> </li>
                                    </ul>
                                    {{ $all_product_info->links() }}
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="{{URL::to('/product-list?page='.$all_product_info->lastPage())}}">Last</a> </li>
                                    </ul>

                                    @endif

                                </div>






                                <div class="clearfix"></div>
                            </div>



                        </div>

                                     <!--Add Stock    tab Two-->

                        <div class="res_no_padding right_no_pad col-md-12 col-sm-12 col-xs-12 tab-pane fade" id="menu5">


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



                                        <div class="res_no_padding col-md-3 col-sm-3 col-xs-12 form-group-sm">

                                            <button type="button" class="name_from_to_stock_list btn btn-success btn-sm">Go!</button>

                                            <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                             <button type="button" value="1" class="btn btn-xs btn-primary add_supplier" style="margin-left: 7px;"><i class="fa fa-pencil-square-o"></i>Add Product</button>

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

                                                        <?php $pid = $product->product_id; ?>

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

                                                                if ($single_product == '') {
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
                                                                <?= DB::table('wastage')->where('product_id', $product->product_id)->sum('wastage_quantity'); ?>
                                                            </td>

                                                            <td class="last text-center hide_print_sec">

                                                                <button class="btn btn-primary btn-xs add_stock" value="{{$product->product_id}}" data-productName="{{$product->product_name}}"><i class="glyphicon glyphicon-plus-sign"></i> Add Stock
                                                                </button>

                                                                <button class="btn btn-info btn-xs view_stock" value="{{$product->product_id}}" data-productName="{{$product->product_name}}"><i class="glyphicon glyphicon-eye-open "></i> View Stock
                                                                </button>

                                                                <button class="btn btn-primary btn-xs add_wastage" value="{{$product->product_id}}" data-productName="{{$product->product_name}}"><i class="glyphicon glyphicon-plus-sign"></i> Add Wastage
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
                        
                        
                        
                        <!--out Of Stock tab Three  -->
                        <div  class="res_no_padding right_no_pad col-md-12 col-sm-12 col-xs-12 tab-pane fade" id="outofstock">
                            
                            
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
                {!! Form::close() !!}




            </div>













        </div>
    </div>
</div>

</div>
</div>
</div>












<!-- Generic Modal -->


<div class="container">
    <div class="row text-center">
    </div>
    <hr>
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Basic Modal</h4>
                </div>
                <div class="modal-body">
                    <h3>Modal Body</h3>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Generic modal -->


    <!-- add supplier -->

    <div class="container">
        <div class="row text-center">
        </div>
        <hr>
        <div class="modal fade" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Product</h4>
                    </div>
                    <div class="modal-body">


                        <div class="panel panel-amin">



                            <div class="panel-body">


                                {!! Form::open(['url' => '/save-producto', 'method'=>'post']) !!}

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" placeholder="Name" id="name" name="product_name" class="form-control" required>
                                    <div><br></div>
                                </div>

                                <div class="form-group">

                                    <label for="cat">Category</label>
                                    <?php $published_category = DB::table('category')->where('category_status',1)->get();   ?>

                                    <select id="cat" name="fk_category_id" class="form-control" required onchange="get_sub_cat(this.value)">

                                        @foreach($published_category as $category)
                                        <option value="{{ $category->category_id}}">{{ $category->category_name}}</option>
                                        @endforeach

                                    </select>

                                    <div><br></div>

                                </div>

                                <!--<div class="form-group sub_div">-->

                                <!--    <label for="cat">Sub Category</label>-->

                                <!--    <select id="subcat" name="fk_category_id_sub" class="form-control">-->
                                <!--        <option value="">Select One</option>-->
                                <!--        @if($published_sub_category)-->
                                <!--        @foreach($published_sub_category as $scategory)-->
                                <!--        <option value="{{ $scategory->category_id}}" class="sub {{ $scategory->parent_cat}}">{{ $scategory->category_name}}</option>-->
                                <!--        @endforeach-->
                                <!--        @endif-->

                                <!--    </select>-->

                                <!--    <div><br></div>-->

                                <!--</div>-->

                                <div class="form-group">

                                    <label for="Type">Type</label>

                                    <select id="Type" name="product_type" class="form-control" required>

                                        @foreach($type as $type)
                                        <option value="{{ $type->type_id}}">{{ $type->type_name}}</option>
                                        @endforeach

                                    </select>

                                    <div><br></div>

                                </div>

                                <div class="form-group">

                                    <label for="name">Pack Size</label>

                                    <input type="text" placeholder="Pack Size" id="pack_size" name="pack_size" class="form-control">

                                    <div><br></div>

                                </div>



                                <!-- <div class="form-group">

								<label class="control-label" for="last-name"> Purchase Price </label>
								<input type="number" id="" name="product_purchase_price" min="1"  required="required" class="form-control">

							</div> -->

                                <div class="form-group">

                                    <label for="image">Image </label>

                                    <input type="file" id="image" name="product_image" class="form-control">

                                </div>

                                <div class="form-group">

                                    <label for="price">Sell Price </label>

                                    <input type="number" placeholder="Price" id="price" name="product_sell_price" min="0.01" step="0.01" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <label for="outRange">Out of Stock Range</label>

                                    <input type="number" min="0" placeholder="Out of Stock Range" id="outRange" name="out_of_stock_range" class="form-control" value="10" required>


                                </div>

                                <div class="form-group">

                                    <label>Publication Status</label> <br>

                                    <div class="btn-group" data-toggle="buttons">

                                        <label class="btn btn-default active">

                                            <input type="radio" name="product_status" value="1" checked> &nbsp; Published &nbsp;

                                        </label>

                                        <label class="btn btn-default">

                                            <input type="radio" name="product_status" value="0"> Unpublished

                                        </label>



                                    </div>

                                </div>

                            </div>
                        </div>


                        <div style="margin-left: 10px;">

                            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Save</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>





</div>

</div>
</div>
</div>
<!-- end add supplier model -->



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

                    <label>Product ID</label>

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
                    <!--    <option value='0'>0</option>-->
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








<!-- Modal view Pament-->
<div style="z-index:9999999999" class="modal fade view_purchase_payment_modal" id="" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">View Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>

            <div class="modal-body">
            
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Date / Time</th>
                                <th class="text-center">Create By</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Check No:</th>
                                <th class="text-center">Receipt / Transaction No.</th>
                                <th class="text-center">Payment Note</th>
                            </tr>
                        </thead>
                        <tbody class="return_purchase_due">
						
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


<!-- Modal view Purchase-->
<div style="z-index:9999999999" class="modal fade view_purchase_all_modal" id="" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">View Purchase <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>

            <div class="modal-body">

            
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 15px;">
                    <div class="invoice" id="print_purchase">
                        
                        <!-- title row 
                        <div class="row-cus">
                            <div class=" col-md-12 col-sm-12 col-xs-12">
                                <?php 
                                    $company = DB::table('settings')->first();
                                ?>
                                <h4>
                                    <i class="fas fa-file-medical"></i> <?= $company->company_name; ?>
                                </h4>
                                
                            </div>
                            <div class="clearfix"></div>
                        </div>-->
                        
                        <!-- /.col -->

                        <!-- info row -->
                        <div class="row-cus m-t">

                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                    <br>
                                </div>

                                <div style="padding:0;" class="col-md-4 col-sm-4 col-xs-5 invoice-col">
                                    <span> From </span> 

                                    <table>
                                        <tr>
                                            <td><strong>{{$company->company_name}}.</strong><br></td>
                                        </tr>
                                        <tr>
                                            <td>{{$company->company_address}}.<br></td>
                                        </tr>
                                        <tr>
                                            <td>{{$company->company_mobile}}.<br></td>
                                        </tr>
                                        <tr>
                                            <td>{{$company->company_email}}.<br></td>
                                        </tr>
                                    </table>
                                
                                </div>

                                <div class="res_no_padding col-md-4 col-sm-4  col-xs-4 invoice-col">

                                    To (Supplier)
                                    <table class="pur_invoic_buyer"></table>
                                </div>

                                <div class="res_no_padding col-md-4 col-sm-4 col-xs-3 invoice-col">

                                    <table class="pur_invoic_pur_order text-right"></table>
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                                    <br>
                                </div>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="row-cus">
                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial #</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody class="pur_invoic_pur_order_list"></tbody>
                                </table>
                            </div>
                        </div>

                        

                        <div class="row-cus">

                            <div class="col-md-12 col-sm-12 col-xs-12 no_padding">

                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0;"></div>

                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
                                    <div class="table-responsive">

                                        <table class="table">
                                            <tbody class="pur_invoic_pur_order_ammount"></tbody>
                                        </table>

                                        <h4 style="padding: 10px 5px;">Payment</h4>

                                        <table class="no_margin table">
                                            <tbody class="pur_invoic_pur_order_payment"></tbody>
                                        </table>

                                        <table class="table">
                                            <tbody class="pur_invoic_pur_order_due"></tbody>
                                        </table>
                                        
                                        <h4 style="padding: 10px 5px;">Last Payment</h4>
                                        <div class="table-responsive">
                                             <table class="table">
                                                <tbody class="pur_invoic_last_pur_pay"></tbody>
                                            </table>
                                        </div>
                    
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-12">
                                    <br>
                                    <p class="text-center">Powered by Muktodhara Technology Limited</p>
                                </div>
                            </div>
                            
                        </div>

                        <!-- this row will not appear when printing -->
                        <br>

                        
                    </div>
                        
                    <div class="row-cus no-print">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button target="_blank" class="btn btn-info print_purchase_details"><i class="fa fa-print"></i> Print</button>
                            <span class="throw_extra_data"></span>
                        </div>
                    </div>
                </div>
            </div>  

            <div style="border:0;" class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>	  
    </div>
</div> 

{{-- Extra Payment Supplier --}}
<div style="z-index:9999999999" class="modal fade extra_payment_modal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Payment <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>
            <div class="modal-body">
            
                {!!Form::open(['url' => '/add-extra-payment-supplier', 'method'=>'post']) !!}
                    
                    <div class="form-group form-group-sm">
                        <input type="hidden" class="buyer" name="buyer_id">
                        <input type="hidden" class="purchase" name="purchase_id">
                        <input type="hidden"name="go_to" value="1">
                    </div>

                    <div class="form-group form-group-sm">

                        <label class="control-label" for="account-name">Account Name </label>

                        <select id="account-name" name="account_id" class="form-control active" required>
                            
                            <?php $accounts = DB::table('accounts')->get();?>
                                
                            @foreach($accounts as $accounts ) 
                                
                                <option value="<?= $accounts->account_id;?>" ><?= $accounts->account_name;?></option>
                            
                            @endforeach
                                
                        </select>
                    
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="payment">Add Payment:</label>
                        <input id="payment" class="due_payment form-control" name="amount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" type="number"  placeholder="Payment" required>
						
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="check-No">Check No:</label>
                        <input type="text" id="check-No" class="form-control" name="check_no"  placeholder="Check No">
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="receipt-no">Receipt / Transaction No.</label>
                        <input type="text" id="receipt-no" class="form-control"  name="transaction"  placeholder="Receipt / Transaction No">
						
                    </div>

                    <div class="form-group form-group-sm">
                    
                        <label for="payment-note">Payment Note</label>
                        <input type="text" id="payment-note" class="form-control"  name="note" placeholder="Payment Note">
						
                    </div>                          
                    
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                {!!Form::close() !!}
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>	  
    </div>
</div> 

@endsection


@push('script')

<script>
    $(document).ready(function() {

        $('.table').on('click', '.del', function() {

            var this_data = $(this);
            var id = $(this).val();
                    
            $.confirm({
                icon: 'fa fa-smile-o',
                theme: 'modern',
                closeIcon: true,
                animation: 'scale',
                type: 'red',
                autoClose: 'cancel|10000',
                escapeKey: 'cancel',
                    
                buttons: {
                    
                    Delete: {
                        
                        btnClass: 'btn-red',
                    
                        action: function() {
                    
                            $.ajax({
                        
                                url:"{{URL('/del-purchase')}}",
                        
                                method:"GET",
                                
                                data:{id:id},
                                
                                success: function(data) {
                        
                                    if(data == "1"){
                                        // console.log(data);
                                        this_data.parent().parent().fadeOut();
                                    
                                    } else {
                                        // console.log(data);
                                    }
                                }
                            });
                        
                            this.setCloseAnimation('zoom');
                        }
                    
                    },
                    
                    cancel: function() {
                    
                        $.alert('Canceled!');
                    
                        this.setCloseAnimation('zoom');
                    }
                }
            });
        });

        // Purchasre Payment Modal
        $(document).on('click', '.previous_payment', function() {

            var buyer = $(this).attr('buyer');

            var purchase = $(this).attr('purchase');

            $('.buyer').val(buyer);
            $('.purchase').val(purchase);

            // $('.ammount_purchase_due').val(amountDuePurchase);

            // $('.due_payment').attr('max', amountDuePurchase);

            $('.extra_payment_modal').modal();

        });
    });
</script>

@endpush