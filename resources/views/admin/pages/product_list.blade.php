@extends('admin_master')

@section('admin_main_content')

<!-- page content -->
<div class="right_col right_col_back" role="main">
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


                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary add_product no_margin">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </button>
                </div>

                <!-- /form datepicker -->

                <div class="clearfix"></div>

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

            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                <div class="panel panel-amin">

                    <div class="panel-heading">
                        <h3 class="panel-title">Product List</h3>
                        <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                    </div>

                    <div class="panel-body">

                        @if ( $data = count($all_product_info) > 0 )

                        <div class="no_padding col-sm-4 col-xs-12 form-group-sm">

                            <input type="text" class="search_product form-control" placeholder="Search...">
                            <br>

                        </div>

                        <div class="no_padding col-md-2 col-sm-4 col-xs-12 form-group-sm">
                            <select class="form-control fk_category_id_search">
                                <option value="0">Category</option>
                                @foreach ( $categorys as $category )
                                <option value="{{$category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>

                        {{--<div class="no_padding col-md-2 col-sm-4 col-xs-12 form-group-sm sub_div">
                            <select class="form-control fk_category_id_search_sub">
                                <option value="">Sub Category</option>
                                @foreach ( $published_sub_category as $category )
                                <option value="{{$category->category_id }}" class="sub {{$category->parent_cat }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>--}}

                        <div class="no_padding col-md-2 col-sm-4 col-xs-12 form-group-sm">
                            <select class="form-control type_id_search">

                                <option value="0">Type</option>

                                <?php $product_type = DB::table('product_type')->orderBy('type_name', 'ASC')->get(); ?>

                                @foreach ( $product_type as $product_type )

                                <option value="{{$product_type->type_id }}">{{ $product_type->type_name }}</option>

                                @endforeach

                            </select>
                            <br>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12 form-group-sm res_no_padding">

                            <button type="button" class="name_from_to_product_list btn btn-success btn-sm">Go!</button>

                            <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>


                        </div>


                        <div id="print_content" class="col-md-12 col-sm-12 col-xs-12 no_padding">

                            <h4 class="bottom_padding top_padding">Product List</h4>

                            <div class="table-responsive" style="width:100%;">


                                <table class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Parent Category</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Sell Price</th>
                                            <th class="text-center hide_print_sec">Status</th>
                                            <th class="text-center hide_print_sec">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="search_results">

                                        @foreach($all_product_info as $product)

                                        <tr class="even pointer">
                                            <td class="text-center">{{$product->product_id}}</td>
                                            <td class="text-center">{{$product->product_name}}</td>
                                            <td class="text-center"><img src="{{asset($product->product_image)}}" width="80" height="50"></td>
                                            <td class="text-center">{{$product->category_name}}</td>
                                            <td class="text-center">
                                                <?php $parent = DB::table('category')->select('category_name')->where('category_id',$product->parent_cat)->first(); ?>
                                                    @if($parent) {{ $parent->category_name }} @endif
                                            </td>
                                            <td class="text-center">{{$product->type_name}}</td>
                                            <td class="text-center">{{$product->product_sell_price}}</td>
                                            <td class="text-center hide_print_sec">
                                                @if($product->product_status==1)
                                                <span class="label label-success">Active</span>
                                                @else
                                                <span class="label label-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="last text-center hide_print_sec">
                                                <button class="btn btn-dark btn-xs edit_product" parent_cat="{{$product->parent_cat}}" value="{{$product->product_id}}" productName="{{$product->product_name}}" productSellPrice="{{$product->product_sell_price}}" productCategory="{{$product->fk_category_id}}" productCategoryName="{{$product->category_name}}" productType="{{$product->product_type}}" productTypeName="{{$product->type_name}}" productImage="{{asset($product->product_image)}}" oldImage="{{$product->product_image}}" productStatus="{{$product->product_status}}" out_of_stock_range="{{$product->out_of_stock_range}}"><i class="far fa-edit"></i> Edit
                                                </button>

                                                <button class="btn btn-info btn-xs view_product" value="{{$product->product_id}}"><i class="far fa-eye"></i> View

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

                        @else

                        <h4 class="text-center">Nothing Found...</h4>

                        @endif

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

<!-- Modal Add Product -->
<div style="z-index:9999999999" class="modal fade add_product_modal" id="edit" role="dialog">
    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>

            <div class="modal-body">

                {!! Form::open(['url' => '/save-product2','method'=>'post','enctype'=>'multipart/form-data']) !!}

                <div class="form-group form-group-sm">

                    <label for="name"> Name</label>
                    <input type="text" id="name" name="product_name" class="form-control" placeholder="Product Name" required>

                </div>

                <!-- <div class="form-group form-group-sm">

                            <label class="control-label" for="last-name"> Purchase Price </label>
                            <input type="number" id="" name="product_purchase_price" min="1" required="required" class="form-control">
                            
                        </div> -->

                <div class="form-group form-group-sm">

                    <label for="Price">Sell Price</label>

                    <input type="number" id="Price" name="product_sell_price" min="0.01" step="0.01" class="form-control" placeholder="Sell Price" required>

                </div>

                <div class="form-group form-group-sm">
                    <label for="Category">Category</label>
                    <select id="Category" name="fk_category_id" class="form-control" required onchange="get_sub_cat(this)">
                        <?php $category = DB::table('category')->get(); ?>
                        @foreach($category as $pc )
                        <option value="<?= $pc->category_id; ?>"><?= $pc->category_name; ?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-group-sm sub_div">
                    <select class="form-control" name="fk_category_id_sub">
                        <option value="">Sub Category</option>
                        @foreach ( $published_sub_category as $category )
                        <option value="{{$category->category_id }}" class="sub {{$category->parent_cat }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <br>
                </div>


                <div class="form-group">

                    <label for="Type">Type</label>

                    <select id="Type" name="product_type" class="form-control" required>

                        <?php $type = DB::table('product_type')->get(); ?>

                        @foreach($type as $type )

                        <option value="{{ $type->type_id}}">{{ $type->type_name}}</option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group form-group-sm">

                    <label for="image">Image </label>

                    <input type="file" id="image" name="product_image" class="form-control">

                </div>

                <div><br></div>

                <div class="form-group">

                    <label for="outRange">Out of Stock Range</label>

                    <input type="number" min="0" placeholder="Out of Stock Range" id="outRange" name="out_of_stock_range" class="form-control" value="10" required>

                    <div><br></div>

                </div>

                <div><br></div>

                <div class="form-group form-group-sm">

                    <label>Publication Status:</label>

                    <br>

                    <div class="btn-group" data-toggle="buttons" style="margin-top: 5px;">

                        <label class="btn btn-default active">
                            <input type="radio" name="product_status" value="1" checked> &nbsp; Published &nbsp;
                        </label>

                        <label class="btn btn-default">
                            <input type="radio" name="product_status" value="0"> Unpublished
                        </label>

                    </div>

                </div>

                <div class="ln_solid"></div>

                <div class="form-group form-group-sm">

                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Save</button>

                </div>

                {!! Form::close() !!}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<div style="z-index:9999999999" class="modal fade edit_product_modal" id="edit" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit<button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>
            <div class="modal-body">

                {!!Form::open(['url'=>'/update-product','method'=>'post','enctype'=>'multipart/form-data','name'=>'edit_product'])!!}

                <div class="form-group form-group-sm">

                    <label class="control-label" for="pid">ID</label>

                    <input type="text" id="pid" class="form-control product_id" value="" disabled>

                </div>

                <div class="form-group form-group-sm">

                    <label for="Med-name">Product Name </label>

                    <input type="text" id="Med-name" name="product_name" value="" class="form-control product_name" placeholder="Product Name" required>

                    <input type="hidden" class="product_id" name="product_id">

                    <input type="hidden" class="old_image" name="old_image" />

                </div>

                <!-- <div class="form-group form-group-sm">

                            <label for="Purchase-price">Product Purchase Price </label>
                            <input type="number" id="Purchase-price" name="product_purchase_price" min="1" value="" class="form-control product_purchase_price" required>
                            
                        </div> -->

                <div class="form-group form-group-sm">
                    <label for="product-price">Sell Price </label>
                    <input type="number" id="product-price" name="product_sell_price" min='0.01' step="0.01" class="form-control product_sell_price" placeholder="Sell Price" required>
                </div>
                
                <div class="form-group form-group-sm">
                    <label for="product-category">Category</label>
                    <?php $accounts = DB::table('category')->get();?>
                    <select name="fk_category_id" class="form-control" id="product-category" required onchange="get_sub_cat(this)">
                        @foreach($accounts as $pc )
                        <option value="<?= $pc->category_id; ?>"><?= $pc->category_name; ?></option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group form-group-sm sub_div sub_div_edit">
                    <label for="product-category">Sub Category</label>
                    <select class="form-control" name="fk_category_id_sub" id="product-category_sub">
                        <option value="">Sub Category</option>
                        @foreach ( $published_sub_category as $category )
                        <option value="{{$category->category_id }}" class="sub {{$category->parent_cat }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <br>
                </div>

                <div class="form-group">

                    <label for="Type">Type</label>

                    <select id="Type" name="product_type" class="form-control" required>

                        <option class="product_type" value=""></option>

                        <?php $type = DB::table('product_type')->orderBy('type_name', 'ASC')->get(); ?>

                        @foreach($type as $type )

                        <option value="{{ $type->type_id}}">{{ $type->type_name}}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group form-group-sm">

                    <label for="product-image">Product Image </label>

                    <input type="file" id="product-image" name="product_image" class="clear_image form-control">

                    <img src="" alt="image" class="product_img top_margin" width="auto" height="60px">

                </div>

                <div class="form-group">

                    <label for="outRange">Out of Stock Range</label>

                    <input type="number" min="0" placeholder="Out of Stock Range" id="outRange" name="out_of_stock_range" class="out_of_stock_range form-control" value="10" required>

                    <div><br></div>

                </div>

                <div class="form-group form-group-sm" style="margin-top: 30px;">

                    <label>Publication Status</label><br>

                    <div class="btn-group" data-toggle="buttons">

                        <label class="edit_product_type_active btn btn-default">
                            <input type="radio" name="product_status" value="1"> &nbsp; Published &nbsp;
                        </label>

                        <label class="edit_product_type_inactive btn btn-default">
                            <input type="radio" name="product_status" value="0"> Unpublished
                        </label>

                    </div>
                </div>

                <div class="ln_solid"></div>

                <button type="submit" class="btn btn-success">Update</button>


                {!! Form::close()!!}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Product -->
<div style="z-index:9999999999" class="modal fade view_product_modal" id="edit" role="dialog">
    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">View All Details<button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
            </div>

            <div class="modal-body" id="client_details">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped return_product">

                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="print_details btn btn-default" style="float: left;">Print</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


 <script>
 $('.sub_div').hide();
function get_sub_cat(e){
    var parent_id=$(e).val();
    $(e).parents('.modal-body').find('.sub_div select').val('');
    $(e).parents('.modal-body').find('.sub_div .sub').hide();
    if($(e).parents('.modal-body').find('.sub').hasClass(parent_id)){
        $(e).parents('.modal-body').find('.sub_div').show();
        $(e).parents('.modal-body').find('.sub.'+parent_id).show();
    }
    else{
        $('.sub_div').hide();
    }
}
    </script>

@endsection