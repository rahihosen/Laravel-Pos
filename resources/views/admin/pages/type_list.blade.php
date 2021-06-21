@extends('admin_master')
@section('admin_main_content')
<!-- page content -->
<div class="right_col right_col_back" role="main">

	<div class="clearfix"></div>

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="box_layout col-md-12 col-sm-12 col-xs-12">

				<h3 class="no_padding"><i class="fa fa-archive"></i> Medicine Type</h3>

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

						<h3 class="panel-title">Add Type</h3>
						<span class="pull-right clickable"><i class="fa fa-plus"></i></span>

					</div>

					<div class="panel-body">

						{!! Form::open(['url' => '/save-type','method'=>'post']) !!}

						<div class="form-group form-group-sm">

							<label for="type-name">Name</label>

							<input type="text" placeholder="Name" id="type-name" name="type_name" class="form-control" required>

						</div>

						<button type="submit" class="marginTP12 btn btn-success"><i class="fa fa-archive"></i> Save</button>

						<br>

						{!! Form::close() !!}

					</div>
				</div>
			</div>

			<div class="no_padding col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-amin">

					<div class="panel-heading">
						<h3 class="panel-title">Type List</h3>
						<span class="pull-right clickable"><i class="fa fa-plus"></i></span>
					</div>

					<div class="panel-body">

						<div class="table-responsive">


							@if(count($product_type) > 0)

							<table class="table table-striped table-bordered">

								<thead>
									<tr class="headings">
										<th class="text-center">ID</th>
										<th class="text-center">Name</th>
										<th class="text-center">Created By</th>
										<th class="text-center">Date</th>
										<th class="text-center">Time</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>

								<tbody>

									@foreach($product_type as $product_type)

									<tr class="even pointer">

										<td class="text-center">{{$product_type->type_id}}</td>

										<td class="text-center">{{$product_type->type_name}}</td>

										<td class="text-center">{{$product_type->name}}</td>

										<td class="text-center">{{$product_type->type_created_date}}</td>

										<td class="text-center">{{$product_type->type_created_time}}</td>

										<td class="last text-center">

											<button class="btn btn-dark btn-xs edit_type" value="{{$product_type->type_id}}" data-typeName="{{$product_type->type_name}}"><i class="far fa-edit"></i> Edit

											</button>

										</td>

									</tr>

									@endforeach

								</tbody>

							</table>

							@else
							<h4 class="text-center">Nothing Found</h4>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /page content -->



<!-- Modal Edit Category -->

<div style="z-index:9999999999" class="modal fade edit_type_modal" id="edit" role="dialog">
	<div class="modal-dialog modal-md">

		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title"> Edit <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button></h4>
			</div>

			<div class="modal-body">

				{!!Form::open(['url'=>'/update-type','method'=>'post'])!!}

				<div class="form-group form-group-sm">

					<input type="hidden" class="type_id" name="type_id" value="">

					<label>ID </label>

					<input type="text" class="form-control type_id" value="" disabled>

				</div>

				<div class="form-group form-group-sm">

					<label for="name">Name </label>

					<input type="text" id="name" name="type_name" class="form-control type_name" value="" required>

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