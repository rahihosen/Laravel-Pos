<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

        <?php 
            $company = DB::table('settings')->first();
        ?>
        <title><?= $company->company_name;?> </title>

        <!-- Bootstrap -->
        <link href="{{asset('public/admin_asset/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
		
        <!-- Font Awesome -->
        <link href="{{asset('public/admin_asset/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        
        <style>
            body{
                margin:0;
                padding:0;
                height:auto;
            }
            .print_page {
                margin:3px;
                padding:7px;
                border:1px solid lightgray;
                height:auto;
            }
            .print_page img{
                margin:0 auto;
                padding:0;
            }
            .print_page h4{
                margin:0;
                padding:5px 0 0 0;
                text-align:center;
            }
            .print_page p{
                margin:0;
                padding:3px 0;
                text-align:center;
                font-size:11px;
            }
            table {
                width:100%;
                text-align:left;
                margin:0;
                padding:3px 0;
            }
            table td{
                text-align:left;
                font-size:12px;
                padding:5px 0;
            }
            table.table_prc td{
                text-align:right;
            }
        </style>
        
    </head>
  
  
  
    <body class="print_page">
        <?php 
            $company = DB::table('settings')->first();
        ?>
        <p><img src="{{asset($company->company_logo)}}" width="100px" height="auto"></p>
		
        <h4><?= $company->company_name; ?></h4>
		
        <p><?= $company->company_address; ?><br/>Email: <?= $company->company_email;?>, Mob: <?= $company->company_mobile;?><br/></p>
		
        <table>
            <tbody>

                <tr>
                    <td width="65%">Order: #{{ $single_order_info_customer->order_id}}</td>
					
                    <td width="35%">Date: {{ $single_order_info_customer->order_created_date}}</td>
					
                    <!--<td style="text-align: center;">Table: 
                        <?php
                            
                            $all_tables = DB::table('tables')->get();

                            $result = explode(',',$single_order_info_customer->table_number);

                            foreach ($all_tables as $all_tables) {

                                if(in_array($all_tables->table_id,$result)){
                                ?>
                            
                                    <?= $all_tables->table_name; ?>

                                <?php    
                                }        
                            } 
                        ?>   
                    </td>-->
                    
                </tr>

            </tbody>
        </table>

        

        <table>
            <tbody>
                <tr>
                    <td width="65%">Customer: {{$single_order_info_customer->customer_name}}</td>
                    <td width="35%">Mob: {{$single_order_info_customer->customer_mobile}}</td>
                    <!--<td>Emali: {{ $single_order_info_customer->customer_email}}</td>-->
                </tr>
            </tbody>
        </table>
       
        
        <table class="table_prc" style="border-top:1px solid lightgray;">

            <tr>
                <td><b>Item</b></td>
                <td><b>Qty</b></td>
                <td><b>Price</b></td>
                <td><b>S.Total</b></td>
            </tr>

                
            @foreach($single_order_info as $order)

                <tr>
                    <td>{{$order->product_name}}</td>
                    <td>{{$order->product_qty}}</td>
                    <td>{{$order->product_sale_price}}</td>
                    <td>{{$order->product_qty*$order->product_sale_price}}</td>
                </tr>

            @endforeach

            <tr style="border-top:1px solid lightgray;">
                <?php $order_id=$order->order_id;?>
                
                <td colspan="2"><b>Total:</b></td>
                <td colspan="2"><b>TK. {{$order = DB::table('order')
                    ->where('order_id',$order_id)
                    ->sum('order_total')
                    }} </b>
                </td>

            </tr>
                    
            <tr>
                
                <td colspan="2"><b>Discount:</b></td>
                <td colspan="2"><b><?= $single_order_info_customer->order_discount; ?></b></td>
            
            </tr>

            <tr>
                
                <td colspan="2"><b>After Discount:</b></td>
                <td colspan="2"><b>TK. <?= $single_order_info_customer->after_discount; ?></b></td>
            
            </tr>

            <!--<tr>-->
                
            <!--    <td colspan="2"><b>Vat:</b></td>-->
            <!--    <td colspan="2"><b><?= $single_order_info_customer->order_vat; ?>%</b></td>-->
            
            <!--</tr>-->

            <tr>
                
                <td colspan="2"><b>Amount Payable:</b></td>
                <td colspan="2"><b>TK. <?= $single_order_info_customer->total_amount_payable; ?> </b></td>
            
            </tr>

            <tr style="border-top:1px dotted gray;">
			
				<td colspan="2"><b>Ammount Paid:</b></td>
				<td colspan="2"></td>
				
			</tr>
			
			<?php
				$order_id = $single_order_info_customer->order_id;

				$data = DB::table('pament_details')->where('order_id', $order_id)->get();
				$tot_paid = 0;
				foreach($data as $data){
					
					$tot_paid += $data->amount;
			?> 

			<tr>
				<td colspan="2">
					<b><?=$data->created_date.' '.$data->created_time;?></b>
				</td>
				
				<td>
					<b><?=$data->transaction_no;?></b>
				</td>
				
				<td>
					<b><?=$data->amount;?></b>
				</td>
			
			</tr>
			
			<?php }?>

			<tr style="border-top:1px dotted gray;">
				
				<td colspan="2"><b>Total Paid:</b></td>
				<td colspan="2"><b>TK. <?=$tot_paid;?></b></td>
			
			</tr>

			<tr style="border-top:1px dotted gray;">
				
				<td colspan="2"><b>Due:</b></td>
				<td colspan="2"><b>TK. 
					<?php
						$result =  ($single_order_info_customer->total_amount_payable) - $tot_paid;
						echo $result;  
					?></b>
				</td>
			
            </tr>

            <tr>
                <td colspan="4"><br></td>
            </tr>


            
            <!--<tr>-->
            <!--    <td colspan="4" style="text-align: left;width: 70%;"><i class="fas fa-dot-circle"></i> ????????????????????? ???????????? ???????????????????????????, ????????? ???????????? ???????????? ?????? ??????????????? ??????????????? ??????????????????????????? ?????? ????????????????????? ???????????????</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td colspan="4" style="text-align: left;width: 70%;"><i class="fas fa-dot-circle"></i> ????????? ?????????????????????????????????????????? ????????????????????? ??????????????? ????????? ????????????????????? ????????? ??????????????? ????????????????????????????????? ?????????????????????????????????</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td colspan="4" style="text-align: left;width: 70%;"><i class="fas fa-dot-circle"></i> ????????????????????? ??????????????? ???????????????????????? ???????????? ???????????? ???????????? ????????? ?????????????????? ???????????????????????? ?????????????????? ??????????????? ??????????????? ???????????? ????????????????????????</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td colspan="4" style="text-align: left;width: 70%;"><i class="fas fa-dot-circle"></i> ??????????????????????????? ??????????????? ??????????????? ????????????: www.shibaligroup.com ????????? ????????????: 01814 39 40 82 </td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td colspan="4" style="text-align: center;">Powered by Muktodhara Technology Limited </td>-->
                
            <!--</tr>-->

        </table>
                
    </body>
   
   <script src="{{asset('public/admin_asset/vendors/jquery/dist/jquery.min.js')}}"></script>
   
   <!-- Bootstrap -->
    <script src="{{asset('public/admin_asset/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
    
    <script>
       // window.print();
       // window.close();
    </script>
  
</html>