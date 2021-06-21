@extends('admin_master')
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">

	<div class="clearfix"></div>

	<div class="row">
 
		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="box_layout col-md-12 col-sm-12 col-xs-12">

				<h3><i class="fa fa-archive"></i> Category</h3>

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


			<div class="no_padding right_padding res_no_padding col-md-4 col-sm-4 col-xs-12">

				<div class="panel panel-amin">

					<div class="panel-heading">

						<h3 class="panel-title">Add Category</h3>
						<span class="pull-right clickable"><i class="fa fa-plus"></i></span>

					</div>

					<div class="panel-body">

						{!! Form::open(['url' => '/save-category','method'=>'post']) !!}

						<div class="form-group form-group-sm">

							<label for="category-name">Name</label>

							<input type="text" placeholder="Name" id="category-name" name="category_name" class="form-control" required>

						</div>

						<!--<div class="form-group form-group-sm">-->

						<!--		<label for="category-name">Parent Category</label>-->

						<!--		<select class="form-control" name="select_cat" id="select_cat">-->
						<!--			<option value="0">Choose Category</option>-->
						<!--		</select>-->
							
						<!--	</div>-->

						<!--<div class="form-group form-group-sm">-->

						<!--	<br>-->

						<!--	<label for="cat-order">Serial</label>-->

						<!--	<input type="number" placeholder="Serial" id="cat-order" name="category_order" required="required" min="1" class="form-control" required>-->

						<!--</div>-->

						<div class="form-group form-group-sm">

							<br>

							<label>Menu ?</label>

							<br>

							<div class="btn-group" data-toggle="buttons">

								<label class="btn btn-default active">
									<input type="radio" name="special_menu" value="1" checked> &nbsp; Yes &nbsp;
								</label>

								<label class="btn btn-default">
									<input type="radio" name="special_menu" value="0"> No
								</label>

							</div>

						</div>

						<div class="form-group form-group-sm">

							<br>

							<label>Status:</label>

							<br>

							<div class="btn-group" data-toggle="buttons">

								<label class="btn btn-default active">

									<input type="radio" name="category_status" value="1" checked> &nbsp; Published &nbsp;

								</label>

								<label class="btn btn-default">

									<input type="radio" name="category_status" value="0"> Unpublished

								</label>

							</div>

						</div>

						<br>
						<div class="ln_solid"></div>

						<button type="submit" class="marginTP12 btn btn-success"><i class="fa fa-archive"></i> Save</button>

						<br><br><br><br><br><br><br><br><br>

						{!! Form::close() !!}

					</div>
				</div>
			</div>

			<div class="no_padding col-md-8 col-sm-8 col-xs-12">
				<div class="panel panel-amin">

					<div class="panel-heading">
						<h3 class="panel-title">Category List</h3>
						<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
					</div>

					<div class="panel-body">

						@if ( $data = count($all_category_info) > 0)

						<div class="form-group form-group-sm">
							<input type="text" class="search_generics form-control" placeholder="Search...">
						</div>

						<div class="table-responsive">

							<table class="table table-striped table-bordered">

								<thead>
									<tr class="headings">
										<th class="text-center"> Name </th>
										<th class="text-center">Parent Name </th>
										<th class="text-center"> Serial </th>
										<th class="text-center"> Menu? </th>
										<th class="text-center"> Status </th>
										<th class="text-center"> Action </th>
									</tr>
								</thead>

								<tbody class="search_results">

									@foreach($all_category_info as $category)

									<tr class="even pointer">

										<td class="text-center">{{$category->category_name}}</td>

										<td class="text-center">{{$category->pname}}</td>

										<td class="text-center">{{$category->category_order}}</td>

										<td class="text-center">

											@if($category->special_menu == 1 )

											<span class="label label-success">Yes</a>

												@else

												<span class="label label-warning">No</span>

												@endif

										</td>

										<td class="text-center">

											@if($category->category_status==1)

											<span class="label label-success">Active</a>

												@else

												<span class="label label-warning">Inactive</a>

													@endif

										</td>

										<td class="last text-center">

											<button class="btn btn-dark btn-xs edit_category" value="{{$category->category_id}}" data-catName="{{$category->category_name}}" data-catOrder="{{$category->category_order}}" data-specialMenu="{{$category->special_menu}}" data-status="{{$category->category_status}}"><i class="far fa-edit"></i> Edit

											</button>

											<!--<a href="URL::to('/delete-category/'.$category->category_id)" class="btn btn-danger btn-xs" onclick="return checkDelete()"> <i class="glyphicon glyphicon-remove"></i> Delete</a>-->

										</td>

									</tr>

									@endforeach

								</tbody>
							</table>
						</div>

						<div class="pull-right hide_pagi">

							@if ( $all_category_info != '')
							<ul class="pagination">
								<li class="page-item"><a class="page-link" href="{{URL::to('/category-list?page=1')}}">First</a> </li>
							</ul>
							{{ $all_category_info->links() }}
							<ul class="pagination">
								<li class="page-item"><a class="page-link" href="{{URL::to('/category-list?page='.$all_category_info->lastPage())}}">Last</a> </li>
							</ul>
							@endif

						</div>

						@else

						<h5 class="text-center">Nothing Found..</h5>

						@endif

						<div class="clearfix"></div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<!-- Modal Edit Category -->

<div style="z-index:9999999999" class="modal fade edit_category_modal" id="edit" role="dialog">
	<div class="modal-dialog modal-md">

		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title"> Edit <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
			</div>

			<div class="modal-body">

				{!!Form::open(['url'=>'/update-category','method'=>'post'])!!}

				<div class="form-group form-group-sm">

					<input type="hidden" class="category_id" name="category_id" value="">

					<label>ID </label>

					<input type="text" class="form-control category_id" value="" disabled>

				</div>

				<div class="form-group form-group-sm">

					<label class="control-label" for="name">Name </label>

					<input type="text" id="name" name="category_name" class="form-control category_name" value="" required>

				</div>

				<div class="form-group form-group-sm">

					<label for="order">Order </label>

					<input type="number" class="form-control category_order" id="order" name="category_order" value="" required>

				</div>

				<div><br> </div>

				<div class="form-group form-group-sm">

					<label>Menu?</label>

					<br>

					<div class="btn-group" data-toggle="buttons">

						<label class="edit_cat_special_type_active btn btn-default">
							<input type="radio" name="special_menu" value="1" autocomplete="off"> &nbsp; Yes &nbsp;
						</label>

						<label class="edit_cat_special_type_inactive btn btn-default">
							<input type="radio" name="special_menu" value="0" autocomplete="off"> No
						</label>

					</div>

				</div>

				<div><br></div>

				<div class="form-group form-group-sm">

					<label class="control-label">Status: </label>
					<br>

					<div class="btn-group" data-toggle="buttons">

						<label class="edit_cat_type_active btn btn-default">
							<input type="radio" name="category_status" value="1" autocomplete="off"> &nbsp; Published &nbsp;
						</label>

						<label class="edit_cat_type_inactive btn btn-default">
							<input type="radio" name="category_status" value="0" autocomplete="off"> Unpublished
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