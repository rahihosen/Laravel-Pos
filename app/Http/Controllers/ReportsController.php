<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

class ReportsController extends Controller
{   

	protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;

        $admin_data = Auth::user();

        if(! isset(Auth::user()->id)) {
            header("Location: ".$this->url->to('/'));
			exit();
        }

        $features = 3;
		
		$admin_role = $admin_data->admin_role;
		
		$all_roles = DB::table('admin_role')->where('role_id', 1)->first();
		
		$roles[1] = $all_roles->admin_role_features;
		$roles[2] = $all_roles->manager_role_features;
		$roles[3] = $all_roles->salesman_role_features;
		
		$get_features = explode(",",$roles[$admin_role]);
		
		if(!in_array($features,$get_features)){
			
			header("Location: ".$this->url->to('/home?error=1'));
			exit();
			
		}
		
    }

    //======== Reports Managements ========//

    // Sales reports.....	
    public function salesReport() 
    {

		
		date_default_timezone_set("Asia/Dhaka");
		
		$check = DB::table('sales_report')->where('sales_report_date', date('Y-m-d'))->first();
		
		$data = array();
		
		$data['total_wastage'] = DB::table('wastage')->where('wastage_created_date', date('Y-m-d'))->sum('wastage_quantity');
		
		$data['total_sold'] = DB::table('order_details')->where('order_details_created_date', date('Y-m-d'))->where('order_details_status', 1)->sum('product_qty');
		
		if($check != ''){
			
			DB::table('sales_report')->where('sales_report_id',$check->sales_report_id)->update($data);
			
		}else{
			
			$data['sales_report_date'] = date('Y-m-d');
		
			DB::table('sales_report')->insert($data);
			
		}

        $all_sales = DB::table('sales_report')
                        ->leftJoin('admin', 'admin.id', '=', 'sales_report.created_by')
                        ->select('sales_report.*', 'admin.name')
                        ->orderBy('sales_report_id')
                        ->paginate(20);
						
		$sales_list = view('admin.pages.sales_report')->with('sales_info',$all_sales);
	
		return view('admin_master')->with('admin_main_content',$sales_list);
		
    }

    // Search sales reports
    public function searchSalesReport (Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        
        $orders = DB::table('sales_report')
                    ->whereBetween('sales_report_date', [$start_date, $end_date])
                    ->get(); 
                    
        $saless = DB::table('order_details')
                    ->where('order_details_status', 1)
                    ->whereBetween('order_details_created_date', [$start_date, $end_date])
                    ->SUM('product_qty'); 
       
        $ren_data = "";
    
        $solds = $wastages = 0;
        
        foreach ($orders as $orders) {
            
            $saless = DB::table('order_details')
                    ->where('order_details_status', 1)
                    ->where('order_details_created_date', $orders->sales_report_date)
                    ->SUM('product_qty'); 
			
			$solds += $saless;
			$wastages += $orders->total_wastage;

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$orders->sales_report_date.'</td>
                            <td class="text-center">'.$saless.'</td>
                            <td class="text-center">'.$orders->total_wastage.'</td>
                            <td class="text-center hide_print_sec">
                                <button
                                    class="btn btn-info btn-xs view_sold"
                                    value="'.$orders->sales_report_date.'" 
                                    ><i class="glyphicon glyphicon-eye-open"></i> View Sold
                                </button>
                                <button
                                    class="btn btn-info btn-xs view_wastage"
                                    value="'.$orders->sales_report_date.'" 
                                    ><i class="glyphicon glyphicon-eye-open"></i> View Wastage
                                </button>
                            </td>
                        </tr>';
            // $or_total += $orders->sub_total;
        }
        
        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$solds.'</b></td>
						<td class="text-center"><b>'.$wastages.'</b></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        }else{
            echo $ren_data.$total_all;
        }
        
    }    

    // view sold sales reports 
    public function viewSold(Request $request) 
    {

		
        $date = $request->dates;
        
        $orders = DB::table('order_details')
                    ->join('product','order_details.product_id','=','product.product_id')
                    ->join('admin', 'order_details.order_details_created_by', '=', 'admin.id')
                    ->where('order_details_created_date', 'like', '%'.$date.'%')
                    ->where('order_details_status', 1)
                    ->get();



        $sales  = DB::table('order_details')
                ->where('order_details_status', 1)
                ->where('order_details_created_date', $date)
                ->SUM('product_sale_price');

        $quantity  = DB::table('order_details')
                ->where('order_details_status', 1)
                ->where('order_details_created_date', $date)
                ->SUM('product_qty');   
   
       
        $ren_data = "";
    
        // $or_total = 0;
        
        foreach($orders as $orders) {
			
            $ren_data .= '<tr>
							<td class="text-center s_date2">'.$orders->order_details_created_date.'</td>
							<td class="text-center">'.$orders->product_name.'</td>
							<td class="text-center">'.$orders->product_qty.'</td>
							<td class="text-center">'.$orders->product_sale_price.'</td>
							<td class="text-center">'.$orders->name.'</td> 
						</tr>';
        }

        $total_all = '<tr style="background-color:#555;color:#fff;">
                        <td class="text-center"><b>Total</b></td>
                         <td class="hide_print_sec"></td>
                        <td class="text-center"><b>' . $quantity . '</b></td>
                        
						<td class="text-center"><b>' . $sales. '</b></td>
                       
                        <td class="hide_print_sec"></td>
                        
					</tr>';
        
        
		echo $ren_data.$total_all;
        
       
        
    }  
    
    
    
    
    
    

    // View Wastage sales reports
    public function viewWastage(Request $request) 
    {

		
        $date = $request->dates;
        
        $ord = DB::table('wastage')
                    ->join('product','wastage.product_id','=','product.product_id')
                    ->where('wastage_created_date', 'like', '%'.$date.'%')
					->get();
   
       
        $ren_data = "";
    
        // $or_total = 0;
        
        foreach($ord as $orders){
			
            $ren_data .= '<tr>
							<td class="text-center">'.$orders->wastage_created_date.' | '.$orders->wastage_created_time.'</td>
							<td class="text-center">'.$orders->product_name.'</td>
							<td class="text-center">'.$orders->wastage_quantity.'</td>                                
						</tr>';
        }
        
        
		echo $ren_data;
        
       
        
    }


    // Order Reports......
    public function orderReport () {
        

        $all_orders = DB::table('order')
                    ->select(DB::raw('count(*) as order_id, order_created_date'))
                    ->groupBy('order_created_date')
                    ->orderBy('order_created_date', 'DESC')
                    ->paginate(10);

        $order_report = view('admin.pages.order_report')->with('orders_info', $all_orders);

        return view('admin_master')->with('admin_main_content', $order_report);
    }

    // Search Order Reports..
    public function searchOrderReport (Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        
        $orders = DB::table('order')
                    ->select(DB::raw('count(*) as order_id, order_created_date'))
                    ->groupBy('order_created_date')
                    ->whereBetween('order_created_date', [$start_date, $end_date])
                    ->orderBy('order_created_date', 'DESC')
                    ->get();  
       
        $ren_data = "";
    
        $tot_odr = $tot_amnt = $tot_rcv = $tot_due = $tot_cancl = $tot_cncl_amnt = 0;
        
        foreach ($orders as $orders) {

            $date = $orders->order_created_date;

            $total_order = DB::table('order')->where('order_created_date', $date)->where('order_status', 1)->count('order_id');

            $payable = DB::table('order')->where('order_created_date', $date)->where('order_status', 1)->sum('total_amount_payable');

            $paid = DB::table('pament_details')->where('status', 1)->where('created_date', $date)->sum('amount');

            $due = $payable - $paid;

            $cancel_total = DB::table('order')->where('order_created_date', $date)->where('order_status', 0)->count('order_id');

            $cancel_payable = DB::table('order')->where('order_created_date', $date)->where('order_status', 0)->sum('total_amount_payable');
			
			$tot_odr += $total_order;
			$tot_amnt += $payable;
			$tot_rcv += $paid;
			$tot_due += $due;
			$tot_cancl += $cancel_total;
			$tot_cncl_amnt += $cancel_payable;

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$orders->order_created_date.'</td>
                            <td class="text-center">'.$total_order.'</td>
                            <td class="text-center">'.$payable.'</td>
                            <td class="text-center hidden">'.$paid.'</td>
                            <td class="text-center hidden">'.$due.'</td>
                            <td class="text-center">'.$cancel_total.'</td>
                            <td class="text-center">'.$cancel_payable.'</td>
                            <td class="text-center hide_print_sec">
                                <button
                                    class="btn btn-info btn-xs view_order_report"
                                    value="'.$date.'" 
                                    ><i class="glyphicon glyphicon-eye-open"></i> View Orders
                                </button>
                                <button
                                    class="btn btn-primary btn-xs view_cancelled_order"
                                    value="'.$date.'" 
                                    ><i class="glyphicon glyphicon-eye-open"></i> View Cancelled Orders
                                </button>
                            </td>
                        </tr>';
        }
        
        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$tot_odr.'</b></td>
						<td class="text-center"><b>'.$tot_amnt.'</b></td>
						<td class="text-center hidden"><b>'.$tot_rcv.'</b></td>
						<td class="text-center hidden"><b>'.$tot_due.'</b></td>
						<td class="text-center"><b>'.$tot_cancl.'</b></td>
						<td class="text-center"><b>'.$tot_cncl_amnt.'</b></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }

    }

    // View Oder Reports
    public function viewOrderReport (Request $request) 
    {

        $rd = $request->dates;

        $orders = DB::table('order')
                        ->join('admin','order.order_created_by','=','admin.id', 'left')
                        ->where('order_created_date', 'like', '%'.$rd.'%')
                        ->where('order_status', 1)
                        ->orderBy('order_id', 'DESC')
                        ->get();

        $ren_data = '';
        $res = '';
		$total_orders = count($orders);
		$payable = 0;
		$paidd = 0;
		$due = 0;

        foreach ($orders as $order) {

            $result = explode(',',$order->table_number);

            $tables = DB::table('tables')->get();

            foreach ($tables as $tables) {

                if(in_array($tables->table_id,$result)) {
                    
                    $res .= $tables->table_name.", ";
                }
            }
            
            $paid = DB::table('pament_details')->where('order_id', $order->order_id)->sum('amount');
			
			$payable += $order->total_amount_payable;			
			
			$paidd += $paid;

            $result = ($order->total_amount_payable) - $paid;

            $pt = url('/') . '/view-order/' . $order->order_id;
            $rt = url('/') . '/print-order-page/' . $order->order_id;

            $ren_data .= '<tr class="even pointer">
                <td class="text-center">'.$order->order_created_date.'/'.$order->order_created_time.'</td>
                <td class="text-center">'.$order->name.'</td>
                <!--<td class="text-center">'.$res.'</td>-->
                <td class="text-center">'.$order->order_id.'</td>
                <td class="text-center">'.$order->order_total.'</td>
                <td class="text-center">'.$order->order_discount.'%'.'</td>
                <td class="text-center">'.$order->after_discount.'</td>
                <td class="text-center">'.$order->order_vat.'%'.'</td>
                <td class="text-center">'.$order->total_amount_payable.'</td>
                <td class="text-center hidden">'.$paid.'</td>
                <td class="text-center hidden">'.$result.'</td>
                <td class="text-center hidden">
                    <button 
                        class="btn btn-primary btn-xs add_payment_report" 
                        data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
                        value="'.$order->order_id.'" 
                        ><i class="fa fa-edit"></i> Add 
                    </button>

                    <button 
                        class="btn btn-info btn-xs view_payment_ord_rep"  
                        data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
                        value="'.$order->order_id.'" 
                        ><i class="glyphicon glyphicon-eye-open"></i> View
                    </button>
                </td>
                <td class="last text-center">
                    <a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>
                    <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                    
                </td>
                
            </tr>';
            
        }
		
        $due = $payable - $paidd;
		
		$total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="4"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td class="hide_print_sec"></td>
					</tr>';

        if ($ren_data == "") {

            echo $ren_data;

        } else {

            echo $ren_data.$total_all;
        }

    }

    // View Cancelled Order Reports
    public function viewCancelledOrderReport (Request $request) 
    {

        $rd = $request->dates;

        $orders = DB::table('order')
                ->join('admin','order.order_created_by','=','admin.id', 'left')
                ->where('order_created_date', 'like', '%'.$rd.'%')
                ->where('order_status', 0)
                ->orderBy('order_id', 'DESC')
                ->limit(20)
                ->get();

        $ren_data = '';
        $res = '';
		$total_orders = count($orders);
		$payable = 0;
		$paidd = 0;
		$due = 0;

        foreach ($orders as $order) {

            $result = explode(',',$order->table_number);

            $tables = DB::table('tables')->get();

            foreach ($tables as $tables) {

                if(in_array($tables->table_id,$result)) {
                    
                    $res .= $tables->table_name.", ";
                }
            }
            
            $paid = DB::table('pament_details')->where('order_id', $order->order_id)->sum('amount');
			
			$payable += $order->total_amount_payable;			
			
			$paidd += $paid;

            $result = ($order->total_amount_payable) - $paid;

            $pt = url('/') . '/view-order/' . $order->order_id;
            $rt = url('/') . '/print-order-page/' . $order->order_id;

            $ren_data .= '<tr class="even pointer">
                <td class="text-center">'.$order->order_created_date.'/'.$order->order_created_time.'</td>
                <td class="text-center">'.$order->name.'</td>
                <!--<td class="text-center">'.$res.'</td>-->
                <td class="text-center">'.$order->order_id.'</td>
                <td class="text-center">'.$order->order_total.'</td>
                <td class="text-center">'.$order->order_discount.'%'.'</td>
                <td class="text-center">'.$order->after_discount.'</td>
                <td class="text-center">'.$order->order_vat.'%'.'</td>
                <td class="text-center">'.$order->total_amount_payable.'</td>
                <td class="text-center hidden">'.$paid.'</td>
                <td class="text-center hidden">'.$result.'</td>
                <td class="text-center hidden">
                    <!--<button 
                        class="btn btn-primary btn-xs add_payment_report" 
                        data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
                        value="'.$order->order_id.'" 
                        ><i class="fa fa-edit"></i> Add 
                    </button>-->

                    <button 
                        class="btn btn-info btn-xs view_payment_ord_rep"  
                        data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
                        value="'.$order->order_id.'" 
                        ><i class="glyphicon glyphicon-eye-open"></i> View
                    </button>
                </td>
                <td class="last text-center">
                    <a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>
                    <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                    
                </td>
                
            </tr>';
            
        }
        
		
		$due = $payable - $paidd;
		
		$total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="4"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td class="hide_print_sec"></td>
					</tr>';

        if ($ren_data == "") {

            echo $ren_data;

        } else {

            echo $ren_data.$total_all;
        }


    }

    // Add payment Order reports
    public function duePaymentOrder (Request $request) 
    {


        date_default_timezone_set("Asia/Dhaka");

        $data2['order_id'] = $order_id = $request->order_id;
        $data2['account_id'] = $request->account_id;
        $data2['amount'] = $order_payment = $request->order_payment;
		$data2['transaction_no'] = $request->transaction_no;
        $data2['created_by'] = Auth::user()->id;
        $data2['created_date']  = date('Y-m-d');
        $data2['created_time']  = date('H:i:s');
        
        DB::table('pament_details')->insert($data2);
		
		
		// save data for balance table
		
        $data['balance_type'] = 6;

        $data['order_id'] = $request->order_id;
        $data['account_id'] = $request->account_id;
        $data['ammount'] = $order_payment;
        $data['note'] = 'Income from orders';

        $data['balance_created_by'] = Auth::user()->id;
        $data['balance_created_date'] = date('Y-m-d');
        $data['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data);
		

        Session::put('message','Order Due update succesfully!');

        return redirect('/order-report');
    }



    // Due Reports.......
    public function dueReport () {
		
        
        $all_orders = DB::table('order')
                    ->join('customer','order.customer_id','=','customer.customer_id','left')
					->where('order_status', 1)
                    ->orderBy('order_id','DESC')
                    ->paginate(30);

        $order_report = view('admin.pages.due_report')->with('all_order_due', $all_orders);

        return view('admin_master')->with('admin_main_content', $order_report);
		
    }

    // Search Due Reports...
    public function searchDueReport ( Request $request ) 
    {
        

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        
        $orders = DB::table('order')
                ->join('customer','order.customer_id','=','customer.customer_id')
                ->whereBetween('order_created_date', [$start_date, $end_date])
				->where('order_status', 1)
                ->orderBy('order_id','DESC')
                ->get();  
       
        $ren_data = "";
		
		$total_orders = 0;
		$payable = 0;
		$paidd = 0;
		$due = 0;
    
        // $or_total = 0;
        
        foreach ($orders as $orders) {

            $data = DB::table('pament_details')->where('order_id', $orders->order_id)->sum('amount');

            $data2 = $orders->total_amount_payable;
            
            $result = ($orders->total_amount_payable) - $data;

            $pt = url('/').'/view-order/'.$orders->order_id;
            $rt = url('/').'/print-order-page/'.$orders->order_id;

            if ( $data2 > $data ) {
				
				$total_orders++;
				
				$payable += $orders->total_amount_payable;			
			
				$paidd += $data;

                $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$orders->order_created_date.' / '.$orders->order_created_time.'</td>
                            <td class="text-center">'.$orders->order_id.'</td>
                            <td class="text-center">'.$orders->customer_name.'</td>
                            <td class="text-center">'.$orders->order_total.'</td>
                            <td class="text-center">'.$orders->order_discount.'%'.'</td>
                            <td class="text-center">'.$orders->after_discount.'</td>
                            <td class="text-center">'.$orders->order_vat.'%'.'</td>
                            <td class="text-center">'.$orders->total_amount_payable.'</td>
                            <td class="text-center">'.$data.'</td>
                            <td class="text-center">'.$result.'</td>
                            <td class="text-center hide_print_sec">
                                <button
                                    class="btn btn-primary btn-xs add_payment"
                                    data-amountDue="'.$result .'" 
                                    value="'.$orders->order_id.'" 
                                    ><i class="glyphicon glyphicon-eye-open"></i> Add
                                </button>
                                <button
                                    class="btn btn-info btn-xs view_payment_due_rep"
                                    data-amountDue="'.$result .'"
                                    value="'.$orders->order_id.'"
                                    ><i class="glyphicon glyphicon-eye-open"></i> View
                                </button>
                            </td>
                            <td class="text-center hide_print_sec">
                                <a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>
                                <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                            </td>
                        </tr>';
                // $or_total += $orders->sub_total;
            }
        }
        
        $due = $payable - $paidd;
		
		$total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center"><b>'.$paidd.'</b></td>
						<td class="text-center"><b>'.$due.'</b></td>
						<td class="hide_print_sec" colspan="2"></td>
					</tr>';

        if ($ren_data == "") {

            echo 1;

        } else {

            echo $ren_data.$total_all;
        }

    }

    // Due Payment add...
    public function duePayment (Request $request) 
    {


        date_default_timezone_set("Asia/Dhaka");

        $data2['order_id'] = $order_id = $request->order_id;
        $data2['account_id'] = $request->account_id;
        $data2['amount'] = $order_payment = $request->order_payment;
		$data2['transaction_no'] = $request->transaction_no;
        $data2['created_by'] = Auth::user()->id;
        $data2['created_date']  = date('Y-m-d');
        $data2['created_time']  = date('H:i:s');
        
        DB::table('pament_details')->insert($data2);
		
		// save data for balance table
		
        $data['balance_type'] = 6;

        $data['order_id'] = $request->order_id;
        $data['account_id'] = $request->account_id;
        $data['ammount'] = $order_payment;
        $data['note'] = 'Income from orders';

        $data['balance_created_by'] = Auth::user()->id;
        $data['balance_created_date'] = date('Y-m-d');
        $data['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data);

        Session::put('message','Customer Due update succesfully!');

        return redirect('/due-report');
    }
	
	
    public function viewPayment (Request $request) 
    {

        $rt = $request->order_id;

        $orders = DB::table('pament_details')
                    ->join('admin','pament_details.created_by','=','admin.id', 'left')
                    ->where('order_id', $rt)
                    ->get();

        $ren_data = '';
        foreach ($orders as $orders) {
            $ren_data .= '<tr class="even pointer">

                <td class="text-center">'.$orders->created_date. ' / ' .$orders->created_time .'</td>
                <td class="text-center">'.$orders->name.'</td>
                <td class="text-center">'.$orders->amount.'</td>
                <td class="text-center">'.$orders->transaction_no.'</td>
                
            </tr>';
            
        }
        echo $ren_data;
    }
    
    
    
    
    // Search viewsold
   
    
    
    
    
    
    
    
    
//      public function searchViewSold55555(Request $request) 
//     {

		
//         $admin_id = $request->admin_id;
        
//         $orders = DB::table('order_details')
//                     ->join('product','order_details.product_id','=','product.product_id')
//                     ->join('admin', 'order_details.order_details_created_by', '=', 'admin.id')
//                     ->where('order_details_created_by', $admin_id)
//                     ->where('order_details_status', 1)
// 					->get();
   
       
//         $ren_data = "";
    
//         // $or_total = 0;
        
//         foreach($orders as $orders) {
			
//             $ren_data .= '<tr>
// 							<td class="text-center">'.$orders->order_details_created_date.' | '.$orders->order_details_created_time.'</td>
// 							<td class="text-center">'.$orders->product_name.'</td>
// 							<td class="text-center">'.$orders->product_qty.'</td>
// 							<td class="text-center">'.$orders->product_sale_price.'</td>
// 							<td class="text-center">'.$orders->name.'</td> 
// 						</tr>';
//         }
        
        
// 		echo $ren_data;
        
       
        
//     }  
    
    
    
    
    
    
    
        public function searchViewSold(Request $request) 
    {

       
        $admin_id= $request->admin_id;
        $date = $request->dates;
        
        $orders = DB::table('order_details')
                    ->join('admin', 'order_details.order_details_created_by', '=', 'admin.id')
                    ->where('order_details.order_details_created_by',$admin_id )
                    ->whereDate('order_details_created_date',$date)
                    ->get();



        $sales  = DB::table('order_details')
                ->where('order_details_status', 1)
                ->where('order_details.order_details_created_by', $admin_id)
                ->where('order_details_created_date', $date)
                ->SUM('product_sale_price');

        $quantity  = DB::table('order_details')
                ->where('order_details_status', 1)
                ->where('order_details.order_details_created_by', $admin_id)
                ->where('order_details_created_date', $date)
                ->SUM('product_qty');   
                    
       
       
        $ren_data = "";
    
        
        
        foreach ($orders as $orders) {
            

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$orders->order_details_created_date.' | '.$orders->order_details_created_time.'</td>
							<td class="text-center">'.$orders->product_id.'</td>
							<td class="text-center">'.$orders->product_qty.'</td>
							<td class="text-center">'.$orders->product_sale_price.'</td>
							<td class="text-center">'.$orders->name.'</td> 
                            
                        </tr>';
            // $or_total += $orders->sub_total;
        }


        $total_all = '<tr style="background-color:#555;color:#fff;">
                        <td class="text-center"><b>Total</b></td>
                         <td class="hide_print_sec"></td>
                        <td class="text-center"><b>' . $quantity . '</b></td>
                        
						<td class="text-center"><b>' . $sales . '</b></td>
                       
                        <td class="hide_print_sec"></td>
                        
					</tr>';
        
        
		
        if($ren_data == ""){
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        }else{
            echo $ren_data.$total_all;
        }
        
    }    
    
    
    
    
    
   
    
    
    
    
    
    
    
    
    
    
    
    

}
