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

					<h3 class="no_padding"><i class="fa fa-plus"></i> Add New  </h3>

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


				<div class="no_padding right_padding res_no_padding col-md-6 col-sm-6 col-xs-12">				
					
					<div class="panel panel-amin">

						<div class="panel-heading">
							<h3 class="panel-title">Description</h3>
							<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
						</div>

						<div class="panel-body">        
							
							{!! Form::open(['url' => '/save-product','method'=>'post','enctype'=>'multipart/form-data']) !!}
						
								<div class="form-group">

									<label for="name">Name</label>
									
									<input type="text" placeholder="Name" id="name" name="product_name" class="form-control" required>
									
									<div><br></div>
									
								</div>
								
								<div class="form-group">

									<label for="cat">Category</label>
									
									<select id="cat" name="fk_category_id" class="form-control" required onchange="get_sub_cat(this.value)">
										
										@foreach($published_category as $category)
											<option value="{{ $category->category_id}}">{{ $category->category_name}}</option>
										@endforeach

									</select>
									
									<div><br></div>
									
								</div>
								
								<div class="form-group sub_div">

									<label for="cat">Sub Category</label>
									
									<select id="subcat" name="fk_category_id_sub" class="form-control">
										<option value="">Select One</option>
										@if($published_sub_category)
										@foreach($published_sub_category as $scategory)
											<option value="{{ $scategory->category_id}}" class="sub {{ $scategory->parent_cat}}">{{ $scategory->category_name}}</option>
										@endforeach
										@endif

									</select>
									
									<div><br></div>
									
								</div>
								
								<div class="form-group">

									<label for="Type">Type</label>
									
									<select id="Type" name="product_type" class="form-control" required>
										
										@foreach($type as $type)
											<option value="{{ $type->type_id}}">{{ $type->type_name}}</option>
										@endforeach

									</select>
									
									<div><br></div>
									
								</div>

						</div>

					</div>
				</div>

				
				<div class="no_padding col-md-6 col-sm-6 col-xs-12">				
					
					<div class="panel panel-amin">

						<div class="panel-heading">
							<h3 class="panel-title">Pricing & Publication</h3>
							<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
						</div>

						<div class="panel-body">

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
								
								<input type="number" placeholder="Price" id="price" name="product_sell_price"  min="0.01" step="0.01" class="form-control" required>

							</div>
							
							<div class="form-group">

								<label for="outRange">Out of Stock Range</label>
								
								<input type="number" min="0" placeholder="Out of Stock Range" id="outRange" name="out_of_stock_range" class="form-control" value="10" required>
								
								
							</div>

							<div class="form-group" >

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
				</div>
			</div>

			<div style="margin-left: 10px;">
			
				<button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Save</button>
				
			</div>

			{!! Form::close() !!}

		</div>
	
    </div>
    <!-- /page content -->
    
    <script>
        $('.sub_div').hide();
        function get_sub_cat(e){
            $('.sub').hide();
            if($('.sub').hasClass(e)){
                $('.sub_div').show();
                $('.sub.'+e).show();
            }
            else{
                $('.sub_div').hide();
            }
        }
    </script>
    
@endsection

