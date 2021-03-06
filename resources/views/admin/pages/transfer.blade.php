@extends('admin_master')  
@section('admin_main_content')

    <!-- page content -->
    <div class="right_col right_col_back" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="box_layout col-md-12 col-sm-12 col-xs-12">			

                        <h3 class="no_padding"><i class="fa fa-money" aria-hidden="true"></i> Balance Transfer</h3>
                        
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
                    

                    <div class="no_padding right_padding res_no_padding col-md-4 col-sm-4 col-xs-12">				
                        
                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">Transfer</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">        
                                
                                
                                {!! Form::open(['url' => '/save-transfer', 'method'=>'post' ]) !!}
                                
                                    <div class="form-group form-group-sm">

                                        <label for="From">Transfer From</label>

                                        <select id="From" name="account_id_1" class="form-control" required>
                                            
                                            <?php $accounts = DB::table('accounts')->get();?>
                                            @foreach($accounts as $accounts )
                                                
                                                <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                            
                                            @endforeach
                                                
                                        </select>
                                    
                                    </div>                                    
                                    
                                    
                                    <div class="form-group form-group-sm">

                                        <label for="ammount">Ammount</label>
										
                                        <input type="number" placeholder="Ammount" id="ammount" name="ammount" class="form-control" required>
                                        
                                    </div>
									
									<div class="form-group form-group-sm">

                                        <label for="Transfer-to">Transfer To</label>

                                        <select id="account-name" name="account_id_2" class="form-control " required>
                                            
                                            <?php $accounts = DB::table('accounts')->get();?>

                                            @foreach($accounts as $accounts )
                                                
                                                <option value="<?= $accounts->account_id;?>"><?= $accounts->account_name;?></option>
                                            
                                            @endforeach
                                                
                                        </select>
                                    
                                    </div>  

                                    <div class="form-group form-group-sm">

                                        <label for="Note">Note </label>
										
                                        <textarea class="form-control" placeholder="Note" aria-label="" id="Note" name="note"></textarea>
                                        
                                    </div>   
                                    

                                    <div class="ln_solid"></div>

                                    <div class="form-group form-group-sm">
									
                                        <button type="submit" class="btn btn-success">Save</button>
                                        
                                    </div>

                                {!! Form::close() !!}
                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="no_padding col-md-8 col-sm-8 col-xs-12">

                        <div class="panel panel-amin">

                            <div class="panel-heading">
                                <h3 class="panel-title">All Transfers</h3>
                                <span class="pull-right clickable"><i class="fa fa-plus"></i></span>
                            </div>

                            <div class="panel-body">

                                @if ( $data = count($transfer) > 0 ) 

                                    <div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
                                        <div class="marginBT10 form-group-sm">
                                            <input type="text" class="date_from datepicker form-control" value="{{date('Y-m-d')}}">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-xs-12 no_padding">					
                                        <div class="marginBT10 form-group-sm">
                                            <input type="text" class="date_to datepicker form-control" value="{{date('Y-m-d')}}">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-xs-12 res_no_padding">					
                                        <div class="marginBT10 form-group-sm">
                                            <button class="search_transfers btn btn-primary btn-sm">Go</button>
                                            
                                            <button class="print_now btn btn-danger btn-sm"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 no_padding" id="print_content">
                                        
                                        <p class="search_term"><b>Balance Transfers </b></p>
                                
                                        <div class="table-responsive">                                    

                                            <table class="table table-striped table-responsive table-bordered">

                                                <thead>
                                                    <tr class="headings">
                                                        <th class="text-center">From</th>
                                                        <th class="text-center">Ammount</th>
                                                        <th class="text-center">To</th>
                                                        <th class="text-center">Note</th>
                                                        <th class="text-center">Created By</th>
                                                        <th class="text-center">Date / Time</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="search_res">
                                                    
                                                    @foreach ($transfer as $transfers)

                                                        <tr class="even pointer">
                                                            <td class="text-center">{{$transfers->tfrom}}</td>
                                                            
                                                            <td class="text-center">{{$transfers->ammount}}</td>
                                                            
                                                            <td class="text-center">{{$transfers->tto}}</td>
                                                            
                                                            <td class="text-center">{{$transfers->note}}</td>
                                                            
                                                            <td class="text-center">{{$transfers->created_admin_name}}</td>
                                                            
                                                            <td class="text-center">{{$transfers->transfer_date}} / {{$transfers->transfer_time}}</td>
                                                            <td class="text-center">
                                                                <button
                                                                    class="btn btn-danger btn-xs del"
                                                                    value="{{$transfers->tid}}"

                                                                    ><i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                            
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="hide_pagi pull-right">

                                        @if ( $transfer != '') 

                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="{{URL::to('/balance-transfer?page=1')}}">First</a> </li>
                                            </ul>

                                            {{ $transfer->links() }}
                                            
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="{{URL::to('/balance-transfer?page='.$transfer->lastPage())}}">Last</a> </li>
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
    </div>

@endsection

@push('script')

<script>
    $(document).ready(function() {
        
        // Edit Client Modal
        $('.table').on('click', '.edit', function() { 
        
            var a_id = $(this).val();
            
            var a_name = $(this).attr('a_name');
            
            var a_email = $(this).attr('a_email');
            
            var photo = $(this).attr('photo');

            var oldImage = $(this).attr('oldImage');

            var a_mobile = $(this).attr('a_mobile');

            var a_address = $(this).attr('a_address');
            
            
            $('.a_id').val(a_id);
            
            $('.a_name').val(a_name);
            
            $('.a_email').val(a_email);

            $('.a_mobile').val(a_mobile);

            $('.a_address').val(a_address);
            
            $('.admin_img').attr('src',photo);
            
            $('.admin_img').show();
            
            $('#thumb-output-modal').html('');
            
            $('.old_image').val(oldImage);
            
            $('.clear_image').val('');
            
            
            $('.edit__modal').modal();
            
        });

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
                        
                                url:"{{URL('/del-transfer')}}",
                        
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
    });
</script>

@endpush