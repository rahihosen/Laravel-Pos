<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller {
	
	protected $url;

    public function __construct(UrlGenerator $url) 
    {

        $this->middleware('auth');

        $admin_data = Auth::user();
		
        $this->url = $url;

        if(! isset(Auth::user()->id)) {
            header("Location: ".$this->url->to('/'));
			exit();
        }
		
        $features = 6;
		
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
    
    public function customerList() 
    {

        $all_customer = DB::table('customer')
                        ->join('customer_group', 'customer.customer_group_id', '=', 'customer_group.group_id', 'left')
                        ->orderBy('customer_id', 'DESC')
                        ->paginate(10);

        $customer_list = view('admin.pages.customer_list')->with('all_customer_info',$all_customer);
        
        return view('admin_master')->with('admin_main_content',$customer_list);
    }

    public function customerGroupList() 
    {
        $customer_group = DB::table('customer_group')->join('admin', 'customer_group.created_by', '=', 'admin.id', 'left')->get();

        return  view('admin.pages.customer_group_list')->with('customer_group', $customer_group);
    }
    
    public function saveCustomer(Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_group_id'] = $request->customer_group_id;
        $data['customer_address'] = $request->customer_address;
        $data['customer_nid'] = $request->customer_nid;
        $data['credit_limit'] = $request->credit_limit;
        $data['prev_due'] = $prvedue = $request->prev_due;
        
        $data['customer_created_date'] = date('Y-m-d');
        $data['customer_created_time'] = date('H:i:s');
        $data['customer_created_by'] = Auth::user()->id;
		
		
		
        $customer_mobile = $data['customer_mobile'] = $request->customer_mobile;
        
        $customer_nid = $data['customer_nid'] = $request->customer_nid;
        
        
        DB::table('customer')->insert($data);

		Session::put('message','Customer information saved succesfully!');

		return Redirect::to('/customer-list');
        

//         $existing_customer_check = DB::table('customer')->where('customer_mobile', $customer_mobile)->exists();
        
//         $existing_customer_nid = DB::table('customer')->where('customer_nid', $customer_nid)->exists();

// 		if($existing_customer_check) {

// 			Session::put('error','Customer Already Exists. Please Try Another Mobile Number.');
// 			return Redirect::to('/customer-list');

//         } else if ( $existing_customer_nid) {

//             Session::put('error', 'Customer NID Already Exists.. Please Try Another NID number...');
//             return Redirect::to('/customer-list');

//         } else {

// 			DB::table('customer')->insert($data);

// 			Session::put('message','Customer information saved succesfully!');

// 			return Redirect::to('/customer-list');
// 		}
		
        
        
    }

    public function saveCustomerGroup(Request $request) 
    {


        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['group_name'] = $request->group_name;

        $data['created_by'] = Auth::user()->id;
        $data['created_date']  = date('Y-m-d');
        $data['created_time']  = date('H:i:s');

        DB::table('customer_group')->insert($data);

        Session::put('message','Customer group saved succesfully!');

        return Redirect::to('/customer-group-list');

    }

    public function viewCustomer(Request $request) 
    {

        $rd = $request->customer_id;
        //$customer_due = $request->customerPriviousDue;

        $orders = DB::table('order')
                ->join('admin','order.order_created_by','=','admin.id', 'left')
                ->where('customer_id', $rd)
                ->orderBy('order_id', 'DESC')
                ->get();

        $ren_data = '';
        $res = '';
		
		$total_am_payable = $tot_paid = 0;

        foreach ($orders as $order) {
			
			$total_am_payable += $order->total_amount_payable;

            $result = explode(',',$order->table_number);

            $tables = DB::table('tables')->get();

            foreach ($tables as $tables) {

                if(in_array($tables->table_id,$result)) {
                    
                    $res .= $tables->table_name.", ";
                }
            }
            
            $paid = DB::table('pament_details')->where('order_id', $order->order_id)->sum('amount');
            $customer_due = DB::table('customer')->where('customer_id', $order->customer_id)->sum('prev_due');
			
			$tot_paid +=$paid;
			
            $result = ($order->total_amount_payable) - $paid;

            $pt = url('/') . '/view-order/' . $order->order_id;
            $rt = url('/') . '/print-or/' . $order->order_id;
            $ren_data .= '<tr class="even pointer">
                <td class="text-center">'.$order->order_created_date.'/'.$order->order_created_time.'</td>
                <td class="text-center">'.$order->name.'</td>
                <!--<td class="text-center">'.$res.'</td>-->
                <td class="text-center">'.$order->order_id.'</td>
                <td class="text-center">'.$order->order_total.'</td>
                <td class="text-center">'.$order->order_discount.'</td>
                <td class="text-center">'.$order->after_discount.'</td>
                <td class="text-center">'.$order->order_vat.'%'. '</td>
                <td class="text-center">' .$customer_due. '</td>
                <td class="text-center">'.$order->total_amount_payable.'</td>
                <td class="text-center hidden">'.$paid.'</td>
                <td class="text-center hidden">'.$result.'</td>
                <td class="hide_print_sec text-center hidden">
                    <button 
                        class="btn btn-primary btn-xs add_payment" 
                        data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
                        value="'.$order->order_id.'" 
                        ><i class="fa fa-edit"></i> Add 
                    </button>

                    <button 
                        class="btn btn-info btn-xs view_payment_customer"  
                        data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
                        value="'.$order->order_id.'" 
                        ><i class="glyphicon glyphicon-eye-open"></i> View
                    </button>
                </td>
                <td class="hide_print_sec text-center">
                    <!--<a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>-->
                    <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                    
                </td>
                
            </tr>';
            
        }
		
		
		
		$duee = $total_am_payable-$tot_paid;
		
		if($total_am_payable > 0){
			
			$all_total = '<tr style="background:#555;color:#fff;">
							<th class="text-center" colspan="2"><b>Total</b></th>
							<th class="text-center"><b>'.count($orders).'</b></th>
							<th class="text-center" colspan="5"></th>
							<th class="text-center"><b></b>'.$total_am_payable.'</th>
							<th class="text-center hidden"><b>'.$tot_paid.'</b></th>
							<th class="text-center hidden"><b>'.$duee.'</b></th>
							<th class="text-center hide_print_sec"></th>
						</tr>';
						
			
			echo $ren_data.$all_total;
			
		}else{
		
			echo $ren_data;
		}
    }
	
	
    public function viewCustomerDueOrders(Request $request) 
    {

        $rd = $request->customer_id;

        $orders = DB::table('order')
                ->join('admin','order.order_created_by','=','admin.id', 'left')
                ->where('customer_id', $rd)
                ->orderBy('order_id', 'DESC')
                ->get();

        $ren_data = '';
        $res = '';
		
		$total_am_payable = $tot_paid = $tot_due = 0;
		$tot_orders = 0;
        foreach ($orders as $order) {
			
			
            $paid = DB::table('pament_details')->where('order_id', $order->order_id)->sum('amount');
			
            $result = ($order->total_amount_payable) - $paid;
			
			if($result > 0){
				
				$tot_due +=$result;
				
				$tot_orders++;
				
				$tot_paid +=$paid;
			
				$total_am_payable += $order->total_amount_payable;

				$resulttt = explode(',',$order->table_number);

				$tables = DB::table('tables')->get();

				foreach ($tables as $tables) {

					if(in_array($tables->table_id,$resulttt)) {
						
						$res .= $tables->table_name.", ";
					}
				}
				

				$pt = url('/') . '/view-order/' . $order->order_id;
				$rt = url('/') . '/print-or/' . $order->order_id;
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
					<td class="text-center">'.$paid.'</td>
					<td class="text-center">'.$result.'</td>
					<td class="hide_print_sec text-center">
						<button 
							class="btn btn-primary btn-xs add_payment" 
							data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
							value="'.$order->order_id.'" 
							><i class="fa fa-edit"></i> Add 
						</button>

						<button 
							class="btn btn-info btn-xs view_payment_customer"  
							data-amountDue="'. $result =  ($order->total_amount_payable) - $paid .'" 
							value="'.$order->order_id.'" 
							><i class="glyphicon glyphicon-eye-open"></i> View
						</button>
					</td>
					<td class="hide_print_sec text-center">
						<!--<a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>-->
						<a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
						
					</td>
					
				</tr>';
			}
        }
		
		
		
		if($total_am_payable > 0){
			
			$all_total = '<tr style="background:#555;color:#fff;">
							<th class="text-center" colspan="2"><b>Total</b></th>
							<th class="text-center"><b>'.$tot_orders.'</b></th>
							<th class="text-center" colspan="4"></th>
							<th class="text-center"><b></b>'.$total_am_payable.'</th>
							<th class="text-center"><b>'.$tot_paid.'</b></th>
							<th class="text-center"><b>'.$tot_due.'</b></th>
							<th class="text-center hide_print_sec" colspan="2"></th>
						</tr>';
						
			
			echo $ren_data.$all_total;
			
		}else{
		
			echo $ren_data;
		}
    }

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

        return redirect('/customer-list');
    }

    public function searchCustomerList( Request $request ) 
    {

        $search_val = $request->search_val;

        $customers = DB::table('customer')
                    ->join('customer_group', 'customer.customer_group_id', '=', 'customer_group.group_id', 'left')
                    ->where('customer_name', 'like', '%'.$search_val.'%')
                    ->orWhere('customer_mobile', 'like', '%'.$search_val.'%')
                    ->orderBy('customer_id', 'DESC')
                    ->get();

        $ren_data = '';

        foreach ($customers as $customers) {

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$customers->customer_id.'</td>
                            <td class="text-center">'.$customers->customer_name.'</td>
                            <td class="text-center">'.$customers->customer_mobile.'</td>
                            <td class="text-center">'.$customers->group_name.'</td>
                            <td class="text-center">'.$customers->credit_limit.'</td>
                            <!--<td class="text-center">
								<button class="btn btn-primary btn-xs new_prescription" value="'.$customers->customer_id.'" >
									<i class="fa fa-plus"></i> New
								</button>
								
								<button class="btn btn-info btn-xs all_prescription" value="'.$customers->customer_id.'" >
									<i class="glyphicon glyphicon-eye-open"></i> View
								</button>
							</td>-->
                            <td class="text-center">
                                <button 
                                    class="btn btn-dark btn-xs edit_customer"

                                    value="'.$customers->customer_id.'"
                                    customerName="'.$customers->customer_name.'"
                                    customerMobile="'.$customers->customer_mobile.'"
                                    customerEmail="'.$customers->customer_email.'"
                                    customerGroupId="'.$customers->customer_group_id.'"
                                    customerGroupName="'.$customers->group_name.'"
                                    credit_limit="'.$customers->credit_limit.'"
                                    ><i class="fas fa-pencil-alt"></i> Edit
                                </button>

                                <button 
                                    class="btn btn-info btn-xs view_customer" 
                                    customerNid="'.$customers->customer_nid.'" 
                                    customerName="'.$customers->customer_name.'" 
                                    customerMobile="'.$customers->customer_mobile.'" 
                                    customerGroupName="'.$customers->group_name.'" 
                                    value="'.$customers->customer_id.'"

                                    ><i class="fa fa-eye"></i> Orders
                                </button>
								
								<!--<button 
                                    class="btn btn-danger btn-xs view_customer_dues" 
                                    customerNid="'.$customers->customer_nid.'" 
                                    customerName="'.$customers->customer_name.'" 
                                    customerMobile="'.$customers->customer_mobile.'" 
                                    customerGroupName="'.$customers->group_name.'" 
                                    value="'.$customers->customer_id.'"

                                    ><i class="fa fa-eye"></i> Dues
                                </button>-->
                                <button 
                                    class="btn btn-warning btn-xs cust_payment" 
                                    value="'.$customers->customer_id.'"
                                    
                                    ><i class="fa fa-money"></i> Payment
                                </button>
                                <button 
                                    class="btn btn-warning btn-xs extra_payment" customer_id="'.$customers->customer_id.'" order_id="0"
                                    
                                    
                                    ><i class="fa fa-plus"></i> Add Payment
                                </button>
                            </td>
                        </tr>';
        }

        if ($ren_data == "") {
            echo 1;
        } else {
            echo $ren_data;
        }
    }


    public function viewExtraPaymentCustomer (Request $request)
    {
        $e = $request->customer_id;

        $c = DB::table('customer')->where('customer_id', $e)->first();

        $extra_payment = DB::table('customer_extra_payment')
                        ->join('admin','customer_extra_payment.created_by','=','admin.id')
                        ->join('accounts','customer_extra_payment.account_id','=','accounts.account_id')
                        ->where('customer_extra_payment.customer_id', $e)
                        ->get();

        $ren_d = '';

        if (count($extra_payment) > 0 ) {

            $ren_d ='
                    <h4>Name: '.$c->customer_name.'</h4>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Date / Time</th>
                                <th class="text-center">Create By</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Check No:</th>
                                <th class="text-center">Receipt / Transaction No.</th>
                                <th class="text-center">Payment Note</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    <tbody>';

                foreach ($extra_payment as $ep) {
                    $ren_d.='<tr class="even pointer">
                                <td class="text-center">'.$ep->created_date.' / '.$ep->created_time.'</td>
                                <td class="text-center">'.$ep->name.'</td>
                                <td class="text-center">'.$ep->account_name.'</td>
                                <td class="text-center">'.$ep->amount.'</td>
                                <td class="text-center">'.$ep->check_no.'</td>
                                <td class="text-center">'.$ep->transaction.'</td>
                                <td class="text-center">'.$ep->note.'</td>
                                <td class="text-center">
                                    <button 
                                        class="btn btn-danger btn-xs del" 
                                        value="'.$ep->c_p_id.'" 
                                        
                                        ><i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>';
                }

            $ren_d .='</tbody></table>';

        } else {
            $ren_d ='<p class="text-center text-danger"> Nothing Found.</p>';
        }

        echo $ren_d;
    }

    public function delExtPaymentCus (Request $request)
    {
        $e = $request->id;

        DB::table('customer_extra_payment')->where('c_p_id', $e)->delete();

        echo '1';
    }
	
	
    
    public function updateCustomer(Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();
        
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_group_id'] = $request->customer_group_id;
        $data['customer_nid'] = $request->customer_nid;
        $data['credit_limit'] = $request->credit_limit;
       
        $data['customer_updated_date'] = date('Y-m-d');
        $data['customer_updated_time'] = date('H:i:s');
        $data['customer_updated_by'] = Auth::user()->id;
        
        $customer_id = $request->customer_id;
		
		
		$customer_mobile = $data['customer_mobile'] = $request->customer_mobile;
		
		DB::table('customer')->where('customer_id',$customer_id)->update($data);

		Session::put('message','Customer information update succesfully!');

		return Redirect::to('/customer-list');
		

// 		$existing_customer_check = DB::table('customer')->where('customer_mobile',$customer_mobile)->where('customer_id','!=',$customer_id)->get();

// 		if(count($existing_customer_check) > 0) {

// 			Session::put('error','Mobile Number Already Exists. Please Try Another Mobile Number.');
// 			return Redirect::to('/customer-list');

// 		} else {

// 			DB::table('customer')->where('customer_id',$customer_id)->update($data);

// 			Session::put('message','Customer information update succesfully!');

// 			return Redirect::to('/customer-list');

// 		}
        
    }

    public function updateCustomerGroup (Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $group_id = $request->group_id;

        $data['group_name'] = $request->group_name;
        $data['updated_by'] = Auth::user()->id;
        $data['updated_date']  = date('Y-m-d');
        $data['updated_time']  = date('H:i:s');

        DB::table('customer_group')->where('group_id',$group_id)->update($data);

        Session::put('message','Customer group Updated succesfully!');

        return Redirect::to('/customer-group-list');

    }
	
	
    public function add_prescription(Request $request) 
    {

		date_default_timezone_set("Asia/Dhaka");

		$data = array();

		$data['customer_id'] = $request->customer_id;

        /* image upload */
        $this->validate($request, [

            'prescription_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

		$files = $request->file('prescription_image');

		$filename = $files->getClientOriginalName();

		$picture = date('His').$filename;

		$image_url = 'public/prescription_image/'.$picture;

		$destinationPath = base_path().'/public/prescription_image';

		$success = $files->move($destinationPath,$picture);

		if($success) {

			$data['prescription_image']=$image_url;

		} else { 

			$error=$files->getErrorMessage();

		}
	
		$data['created_date'] = date('Y-m-d');

		$data['created_time'] = date('H:i:s');

		$data['created_by'] = Auth::user()->id;
		
		DB::table('prescription')->insert($data);

		Session::put('message','Saved Successfully !');
	
        return Redirect::to('/customer-list');
        
    }
	
    public function all_prescription( Request $request ) 
    {

        $customer_id = $request->customer_id;

        $prescription = DB::table('prescription')
                        ->join('admin', 'prescription.created_by', '=', 'admin.id', 'left')
                        ->where('customer_id', $customer_id)
                        ->orderBy('prescription_id', 'DESC')
                        ->get();

        $ren_data = '';

        foreach ($prescription as $prescription) {

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$prescription->created_date.'</td>
                            <td class="text-center">'.$prescription->created_time.'</td>
                            <td class="text-center"><a href="'.asset($prescription->prescription_image).'" target="_blank"><img src="'.asset($prescription->prescription_image).'" alt="" width="auto" height="40px"></a></td>
                            <td class="text-center">'.$prescription->name.'</td>
                        </tr>';
        }

        
		echo $ren_data;
		
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
	
	// View Order function	
    public function viewOrder($order_id) 
    {
        
        
        $single_order = DB::table('order_details')
                        ->join('product', 'order_details.product_id', '=', 'product.product_id', 'left')
                        ->where('order_id',$order_id)
                        ->get();
        
        $single_order_customer = DB::table('order')
                                ->join('customer','order.customer_id','=','customer.customer_id', 'left')
                                ->where('order_id',$order_id)
                                ->first();

        $order_view_info = view('admin.pages.single_order_view')
                            ->with('single_order_info',$single_order)
                            ->with('single_order_info_customer',$single_order_customer);
        
        return view('admin_master')
                ->with('admin_main_content',$order_view_info);


    }
    
    // Print Order page functions	
    public function printOrderPage($order_id) 
    {
        $single_order = DB::table('order_details')
                            ->join('product', 'order_details.product_id', '=', 'product.product_id', 'left')
                            ->where('order_id', $order_id)
                            ->get();

        
        $single_order_customer = DB::table('order')
                                ->join('customer','order.customer_id','=','customer.customer_id', 'left')
                                ->where('order_id', $order_id)
                                ->first();
        
        return view('admin.pages.print_order_page')
                ->with('single_order_info', $single_order)
                ->with('single_order_info_customer', $single_order_customer);

    }


    Public function addExtraPayment (Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['order_id'] = $request->order_id;
        $data['account_id'] = $request->account_id;
        $data['amount'] = $request->amount;
        $data['note'] = $request->note;
        $data['check_no'] = $request->check_no;
        $data['transaction'] = $request->transaction;

        $data['created_by'] = Auth::user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');
        
        DB::table('customer_extra_payment')->insert($data);
        
         $data1['amount'] = $request->amount;
         DB::table('pament_details')->where('order_id', $request->order_id)->increment('amount', $request->amount);
         

        Session::put('message', 'Information Saved Successfully !!!');

        return Redirect::to('/order-list');
    }

    Public function addExtraPayment2 (Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['order_id'] = $request->order_id;
        $data['account_id'] = $request->account_id;
        $data['amount'] = $request->amount;
        $data['note'] = $request->note;
        $data['check_no'] = $request->check_no;
        $data['transaction'] = $request->transaction;

        $data['created_by'] = Auth::user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');
        
        DB::table('customer_extra_payment')->insert($data);

        Session::put('message', 'Information Saved Successfully !!!');

        return Redirect::to('/customer-list');
    }

    public function viewExtraPayment (Request $request)
    {
        $e = $request->buyer_id;

        $b = DB::table('buyers')->where('buyer_id', $e)->first();

        $extra_payment = DB::table('supplier_extra_payment')
                        ->join('admin','supplier_extra_payment.created_by','=','admin.id')
                        ->join('accounts','supplier_extra_payment.account_id','=','accounts.account_id')
                        ->where('supplier_extra_payment.buyer_id', $e)
                        ->get();

        $ren_d = '';

        if (count($extra_payment) > 0 ) {

            $ren_d ='
                    <h4>Name: '.$b->buyer_name.'</h4>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Date / Time</th>
                                <th class="text-center">Create By</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Check No:</th>
                                <th class="text-center">Receipt / Transaction No.</th>
                                <th class="text-center">Payment Note</th>
                            </tr>
                        </thead>
                    <tbody>';

                foreach ($extra_payment as $ep) {
                    $ren_d.='<tr class="even pointer">
                                <td class="text-center">'.$ep->created_date.' / '.$ep->created_time.'</td>
                                <td class="text-center">'.$ep->name.'</td>
                                <td class="text-center">'.$ep->account_name.'</td>
                                <td class="text-center">'.$ep->amount.'</td>
                                <td class="text-center">'.$ep->check_no.'</td>
                                <td class="text-center">'.$ep->transaction.'</td>
                                <td class="text-center">'.$ep->note.'</td>
                            </tr>';
                }

            $ren_d .='</tbody></table>';

        } else {
            $ren_d ='<p class="text-center text-danger"> Nothing Found.</p>';
        }

        echo $ren_d;
    }
    
    
    
      public function previousDuePayment(Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");
        
         $customer_id = $request->customer_id;

        $data = array();
        
        $data['prev_due'] = $request->prev_due;
      
        
       
		
		
	
		
		DB::table('customer')->where('customer_id',$customer_id)->decrement('prev_due', $request->prev_due);

		Session::put('message','Customer Payment  update succesfully!');

		return Redirect::to('/customer-list');
		

// 		$existing_customer_check = DB::table('customer')->where('customer_mobile',$customer_mobile)->where('customer_id','!=',$customer_id)->get();

// 		if(count($existing_customer_check) > 0) {

// 			Session::put('error','Mobile Number Already Exists. Please Try Another Mobile Number.');
// 			return Redirect::to('/customer-list');

// 		} else {

// 			DB::table('customer')->where('customer_id',$customer_id)->update($data);

// 			Session::put('message','Customer information update succesfully!');

// 			return Redirect::to('/customer-list');

// 		}


        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
 
}
