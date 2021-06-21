<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

// session_start();

class PurchaseController extends Controller
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
		
        $features = 8;
		
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

   
    //=== Purchase all Functions ... ===//
	
	
	
    public function searchBuyerDues (Request $request) 
    {

        $buyer_id = $request->customer_id;

        $purchase = DB::table('purchase')
                ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                ->where('purchase_status', 1)
                ->where('purchase.buyer_id', $buyer_id)
                ->orderBy('purchase.purchase_id', 'DESC')
                ->get();


        $ren_data = "";
		
		$total_orders = 0;
		$payable = 0;
		$paidd = 0;
		$due = 0;
    
        // $or_total = 0;

        foreach ($purchase as $purchase) {

            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');
			

            $result = ($purchase->total_ammount_payable) - $data;
			
			if($result > 0){
				
				$total_orders++;
				
				$payable += $purchase->total_ammount_payable;			
			
				$paidd += $data;	

            $pt = url('/') . '/view-order/' . $purchase->purchase_id;
            $rt = url('/') . '/print-order-page/' . $purchase->purchase_id;
            $ren_data .= '<tr class="even pointer">
                                <td class="text-center">' . $purchase->purchase_id . '</td>
                                <td class="text-center">' . $purchase->purchase_created_date . ' / ' . $purchase->purchase_created_time . '</td>
                                <td class="text-center">' . $purchase->buyer_name . '</td>
                                <td class="text-center">' . $purchase->purchase_total . '</td>
                                <td class="text-center">' . $purchase->purchase_discount .'</td>
                                <td class="text-center">' . $purchase->after_discount . '</td>
                                <td class="text-center">' . $purchase->purchase_vat . '%' . '</td>
                                <td class="text-center">' . $purchase->total_ammount_payable . '</td>
                                <td class="text-center">' . $data . '</td>
                                <td class="text-center">' . $result . '</td>
                                <td class="text-center">' . $purchase->purchase_note . '</td>
                                <td class="text-center hide_print_sec">
                                    <button 
                                        class="btn btn-primary btn-xs add_payment_purchase" 
                                        amountDuePurchase="' . $result = ($purchase->total_ammount_payable) - $data . '" 
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_payment_purchase"  
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <button 
                                                   
                                        class="btn btn-info btn-xs pruchase_list_all_view"
                                        dataId="'.$purchase->purchase_id.'"
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>

                                    <!--<button 
                                        class="btn btn-danger btn-xs cancel_purchase"
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-trash"></i> Cancel 
                                    </button>-->
                                </td>
                            </tr>';
							
			}
            // $or_total += $orders->order_total;
        }
		$due = $payable - $paidd;
        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center"><b>'.$paidd.'</b></td>
						<td class="text-center"><b>'.$due.'</b></td>
						<td></td>
						<td class="hide_print_sec" colspan="2"></td>
					</tr>';
		
        if($ren_data == ""){
            echo "<td colspan='13'><br><h5 class='text-center'> Nothing Found.</h5><br></td>";
        }else{
            echo $ren_data.$total_all;
        }
    }


	
    public function searchBuyerOrders (Request $request) 
    {

        $buyer_id = $request->customer_id;

        $purchase = DB::table('purchase')
                ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                ->where('purchase_status', 1)
                ->where('purchase.buyer_id', $buyer_id)
                ->orderBy('purchase.purchase_id', 'DESC')
                ->get();

        $ren_data = "";
		
		$total_orders = count($purchase);
		$payable = 0;
		$paidd = 0;
		$due = 0;
    
        // $or_total = 0;

        foreach ($purchase as $purchase) {

            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');			
			
			$payable += $purchase->total_ammount_payable;
			
			$paidd += $data;

            $result = ($purchase->total_ammount_payable) - $data;

            $pt = url('/') . '/view-order/' . $purchase->purchase_id;
            $rt = url('/') . '/print-order-page/' . $purchase->purchase_id;
            $ren_data .= '<tr class="even pointer">
                                <td class="text-center">' . $purchase->purchase_id . '</td>
                                <td class="text-center">' . $purchase->purchase_created_date . ' / ' . $purchase->purchase_created_time . '</td>
                                <td class="text-center">' . $purchase->buyer_name . '</td>
                                <td class="text-center">' . $purchase->purchase_total . '</td>
                                <td class="text-center">' . $purchase->purchase_discount .'</td>
                                <td class="text-center">' . $purchase->after_discount . '</td>
                                <td class="text-center">' . $purchase->purchase_vat . '%' . '</td>
                                <td class="text-center">' . $purchase->total_ammount_payable . '</td>
                                <td class="text-center  hidden">' . $data . '</td>
                                <td class="text-center hidden">' . $result . '</td>
                                <td class="text-center">' . $purchase->purchase_note . '</td>
                                <td class="text-center hide_print_sec hidden">
                                    <button 
                                        class="btn btn-primary btn-xs add_payment_purchase" 
                                        amountDuePurchase="' . $result = ($purchase->total_ammount_payable) - $data . '" 
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_payment_purchase"  
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <button 
                                                   
                                        class="btn btn-info btn-xs pruchase_list_all_view"
                                        dataId="'.$purchase->purchase_id.'"
                                        buyer_id="'.$buyer_id.'"
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                    <button 
                                                   
                                        class="btn btn-info btn-xs calan_view"
                                        dataId="'.$purchase->purchase_id.'"
                                        buyer_id="'.$buyer_id.'"
                                        ><i class="glyphicon glyphicon-eye-open"></i>Calan
                                    </button>

                                    <!--<button 
                                        class="btn btn-danger btn-xs cancel_purchase"
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-trash"></i> Cancel 
                                    </button>-->
                                </td>
                            </tr>';
            // $or_total += $orders->order_total;
        }
        $due = $payable - $paidd;
        
        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo "<td colspan='13'><br><h4 class='text-center'> Nothing Found.</h4><br></td>";
        }else{
            echo $ren_data.$total_all;
        }
    }


	
    // Buyer list
    public function buyerList () 
    {
        $all_buyers = DB::table('buyers as buy')
            ->leftJoin('admin as admin_created', 'buy.buyer_created_by', '=', 'admin_created.id')
            ->leftJoin('admin as admin_updated', 'buy.buyer_updated_by', '=', 'admin_updated.id')
            ->select(
                'buy.buyer_id as bid',
                'buy.buyer_name as bname',
                'buy.buyer_mobile as bmobile',
                'buy.buyer_email as bemail',
                'buy.previous_due as previous_due',
                'buy.buyer_address as baddress',
                'buy.buyer_created_date as bcreated_date',
                'buy.buyer_created_time as bcreated_time',
                'buy.buyer_updated_date as bupdated_date',
                'buy.buyer_updated_time as bupdated_time',
                'admin_created.name as created_admin_name',
                'admin_updated.name as updated_admin_name'
            )
            ->orderBy('bid', 'DESC')
            ->paginate(10);

        $buyer_list = view('admin.pages.buyer_list')->with('all_buyers', $all_buyers);

        return view('admin_master')->with('', $buyer_list);
    }

    // create a new Buyer
    public function saveBuyer (Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['buyer_name'] = $request->buyer_name;
        $data['buyer_mobile'] = $buyer_mbl = $request->buyer_mobile;
        $data['buyer_email'] = $request->buyer_email;
        $data['previous_due'] = $request->previous_due;
        $data['buyer_address'] = $request->buyer_address;

        $data['buyer_created_by'] = Auth::user()->id;
        $data['buyer_created_date'] = date('Y-m-d');
        $data['buyer_created_time'] = date('H:i:s');
        
    	DB::table('buyers')->insert($data);
		Session::put('message', 'Buyer Information Saved Successfully !!!');
		
		
// 		$check_mbl = DB::table('buyers')->where('buyer_mobile', $buyer_mbl)->get();
		
// 		if(count($check_mbl) > 0){
			
// 			Session::put('error', 'Mobile Number Already Exists. Please Try Another Number. !!!');
			
// 		}else{
// 			DB::table('buyers')->insert($data);
// 			Session::put('message', 'Buyer Information Saved Successfully !!!');			
// 		}

        return Redirect::to('/buyer-list');

    }

    // Update buyer information
    public function updateBuyer (Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $buyer_id = $request->buyer_id;

        $data = array();

        $data['buyer_name'] = $request->buyer_name;
        $data['buyer_mobile'] = $buyer_mbl = $request->buyer_mobile;
        $data['buyer_email'] = $request->buyer_email;
        $data['buyer_address'] = $request->buyer_address;
        $data['previous_due'] = $request->previous_due;

        $data['buyer_updated_by'] = Auth::user()->id;
        $data['buyer_updated_date'] = date('Y-m-d');
        $data['buyer_updated_time'] = date('H:i:s');
        
        DB::table('buyers')->where('buyer_id', $buyer_id)->update($data);

		Session::put('message', 'Buyer Information Updated Successfully !!!');
		
// 		$check_mbl = DB::table('buyers')->where('buyer_id', '!=', $buyer_id)->where('buyer_mobile', $buyer_mbl)->get();
		
// 		if(count($check_mbl) > 0){
			
// 			Session::put('error', 'Mobile Number Already Exists. Please Try Another Number. !!!');
			
// 		}else{

// 			DB::table('buyers')->where('buyer_id', $buyer_id)->update($data);

// 			Session::put('message', 'Buyer Information Updated Successfully !!!');
			
// 		}

        return Redirect::to('/buyer-list');
    }

    // Search buyer List
    public function searchBuyerList (Request $request)
    {

        $search_val = $request->search_val;

        $buyers = DB::table('buyers as buy')
            ->leftJoin('admin as admin_created', 'buy.buyer_created_by', '=', 'admin_created.id')
            ->leftJoin('admin as admin_updated', 'buy.buyer_updated_by', '=', 'admin_updated.id')
            ->select(
                'buy.buyer_id as bid',
                'buy.buyer_name as bname',
                'buy.buyer_mobile as bmobile',
                'buy.buyer_email as bemail',
                'buy.previous_due as previous_due',
                'buy.buyer_address as baddress',
                'buy.buyer_created_date as bcreated_date',
                'buy.buyer_created_time as bcreated_time',
                'buy.buyer_updated_date as bupdated_date',
                'buy.buyer_updated_time as bupdated_time',
                'admin_created.name as created_admin_name',
                'admin_updated.name as updated_admin_name'
            )
            ->where('buyer_name', 'like', '%' . $search_val . '%')
            ->orWhere('buyer_mobile', 'like', '%' . $search_val . '%')
            ->orderBy('bid', 'DESC')
            ->get();

        $ren_data = '';

        foreach ($buyers as $buyers) {

            $updated = ($buyers->bupdated_date) ? $buyers->bupdated_date . ' / ' . $buyers->bupdated_time : '';

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">' . $buyers->bid . '</td>
                            <td class="text-center">' . $buyers->bname . '</td>
                            <td class="text-center">' . $buyers->bmobile . '</td>
                            <td class="text-center">' . $buyers->previous_due . '</td>
                            <!--<td class="text-center">' . $buyers->bemail . '</td>
                            <td class="text-center">' . $buyers->baddress . '</td>-->
                            <td class="text-center">' . $buyers->created_admin_name . '</td>
                            <td class="text-center">' . $buyers->bcreated_date . ' / ' . $buyers->bcreated_time . '</td>
                            <td class="text-center">' . $buyers->updated_admin_name . '</td>
                            <td class="text-center">' . $updated . '</td>
                            <td class="text-center">
                                <button 
                                    class="btn btn-dark btn-xs edit_buyer"

                                    value="' . $buyers->bid . '"
                                    buyerName="' . $buyers->bname . '"
                                    buyerMobile="' . $buyers->bmobile . '"
                                    buyerEmail="' . $buyers->bemail . '"
                                    buyerAddress="' . $buyers->baddress . '"
                                    ><i class="fas fa-pencil-alt"></i> Edit
                                </button>
								
								<button class="btn btn-primary btn-xs buyer_orders" value="'.$buyers->bid.'"><i class="fas fa-eye"></i> Orders</button>
								
                                <!--<button class="btn btn-danger btn-xs buyer_dues" value="'.$buyers->bid.'"><i class="fas fa-eye"></i> Dues</button>-->
                                <button class="btn btn-info btn-xs extra_payment" value="'.$buyers->bid.'"><i class="fa fa-money"></i> Payment</button>
                                <button class="btn btn-info btn-xs previous_payment2" buyer="'.$buyers->bid.'" purchase="0"><i class="fa fa-money"></i> Add Payment</button>  
                            </td>
                        </tr>';
        }

        if ($ren_data == "") {
            echo 1;
        } else {
            echo $ren_data;
        }

    }



    
    //=== All Purchase Functions .. ===//

    // New Purchase
    public function newPurchase () 
    {

        $all_buyers = DB::table('buyers')->get();

        $all_accounts = DB::table('accounts')->get();

        $new_purchase = view('admin.pages.new_purchase')
                        ->with('all_buyers', $all_buyers)
                        ->with('all_accounts', $all_accounts);

        return view('admin_master')->with('', $new_purchase);
    }

    // Search product for new Purchase
    public function searchProPurchase (Request $request)
    {

        $search_val = $request->search_val;

        $products = DB::table('product')
                    ->where('product_name', 'like', '%' . $search_val . '%')
                    ->orderBy('product_id', 'DESC')
                    ->get();

        $ren_data = '';

        foreach ($products as $products) {

            $ren_data .= '<ul class="search_list">
                            <li class="search_list_click" data-pro-id="' . $products->product_id . '" data-pro-name="' . $products->product_name . '">' . $products->product_name . '</li>
                        </ul>';
        }

        if ($ren_data == "") {
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        } else {
            echo $ren_data;
        }
    }

    // Save new Purchase Product 
    public function purchaseProductSave (Request $request) 
    {
        date_default_timezone_set("Asia/Dhaka");
        
        $data = array();

        $data['buyer_id'] = $request->buyer_id;
        $data['purchase_note'] = $request->purchase_note;
        $data['purchase_total'] = $request->purchase_total;
        $data['purchase_discount'] = $request->purchase_discount;
        $data['after_discount'] = $request->after_discount;
        $data['purchase_vat'] = $request->purchase_vat;
        $data['total_ammount_payable'] = $request->total_ammount_payable;
        $data['transport'] = $request->transport;
        $data['expire_date'] = $request->expire_date;

        $data['purchase_created_by'] = Auth::user()->id;
        $data['purchase_created_date'] = date('Y-m-d');
        $data['purchase_created_time'] = date('H:i:s');

        $purchase_id = DB::table('purchase')->insertGetId($data);

        
        // Multi Purchase Product save by array

        $buyer_id = $request->buyer_id;
        $product_data = array();

        $product_data['purchase_id'] = $purchase_id;
        $product_data['buyer_id'] = $buyer_id;

        $product_data['pur_details_created_by'] = Auth::user()->id;
        $product_data['pur_details_created_date'] = date('Y-m-d');
        $product_data['pur_details_created_time'] = date('H:i:s');

        $product_id = $request->product_id;
        $product_quantity = $request->product_quantity;
        $product_purchase_price = $request->product_purchase_price;

        for ($i = 0; $i < count($product_id); $i++) {

            $product_data['product_id'] = $product_id[$i];
            $product_data['product_qty'] = $product_quantity[$i];
            $product_data['product_purchase_price'] = $product_purchase_price[$i];
            
            DB::table('purchase_details')->insert($product_data);
			
			$dataz = array();

			$dataz['purchase_id'] = $purchase_id;
			$dataz['product_id'] = $product_id[$i];

			$dataz['stock_quantity'] = $product_quantity[$i];
			
            $dataz['purchase_price'] = $product_purchase_price[$i];

			$dataz['stock_created_date'] = date('Y-m-d');

			$dataz['stock_created_time'] = date('H:i:s');

			$dataz['stock_created_by'] = Auth::user()->id;
			
			DB::table('stock')->insert($dataz);
			
        }
        
        
        // Payment Purchase Product

        $payment_data = array();

        $payment_data['purchase_id'] = $purchase_id;
        $payment_data['account_id'] = $request->payment_account_id;
        $payment_data['pur_ammount'] = $request->payment_ammount;
        $payment_data['pur_payment_note'] = $request->payment_note;
        $payment_data['payment_check_no'] = $request->payment_check_no;
        $payment_data['payment_transaction_no'] = $request->payment_transaction_no;


        $payment_data['pur_payment_created_by'] = Auth::user()->id;
        $payment_data['pur_payment_created_date'] = date('Y-m-d');
        $payment_data['pur_payment_created_time'] = date('H:i:s');

        DB::table('purchase_payment_details')->insert($payment_data);
		
		
		// save data for balance table
		
		$data2['balance_type'] = 9;
		
		$data2['purchase_id'] = $purchase_id;

		$data2['account_id'] = $request->payment_account_id;
		
		$data2['ammount'] = $request->payment_ammount;
		
		$data2['note'] = 'Supply Expenses (Purchase)';

		$data2['balance_created_by'] = Auth::user()->id;
		$data2['balance_created_date'] = date('Y-m-d');
		$data2['balance_created_time'] = date('H:i:s');

		DB::table('balance_table')->insert($data2);
        
        
        Session::put('message', 'New Purchase Saved Successfully !!!');

        return Redirect::to('/new-purchase');

    }



    // Purchase List
    public function purchaseList ()
    {

        $all_purchase = DB::table('purchase')
                        ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                        ->orderBy('purchase_id', 'DESC')
                        ->where('purchase_status', 1)
                        ->paginate(10);

        $purchase_list = view('admin.pages.purchase_list')->with('all_purchase', $all_purchase);

        return view('admin_master')->with('', $purchase_list);
    }

    public function duePurchasePayment (Request $request) 
    {


        date_default_timezone_set("Asia/Dhaka");
        $data2 = array();

        $data2['purchase_id'] = $purchase_id = $request->purchase_id;
        $data2['account_id'] = $account_id = $request->account_id;
        $data2['pur_ammount'] = $pur_ammount = $request->pur_ammount;
        $data2['payment_check_no'] = $payment_check_no = $request->payment_check_no;
        $data2['payment_transaction_no'] = $payment_transaction_no = $request->payment_transaction_no;
        $data2['pur_payment_note'] = $pur_payment_note = $request->pur_payment_note;
        $data2['pur_payment_created_by'] = Auth::user()->id;
        $data2['pur_payment_created_date']  = date('Y-m-d');
        $data2['pur_payment_created_time']  = date('H:i:s');
        
        DB::table('purchase_payment_details')->insert($data2);
		
		
		
		// save data for balance table
		
		$data3['balance_type'] = 9;
		
		$data3['purchase_id'] = $purchase_id;

		$data3['account_id'] = $account_id;
		
		$data3['ammount'] = $pur_ammount;
		
		$data3['note'] = 'Supply Expenses (Purchase)';

		$data3['balance_created_by'] = Auth::user()->id;
		$data3['balance_created_date'] = date('Y-m-d');
		$data3['balance_created_time'] = date('H:i:s');

		DB::table('balance_table')->insert($data3);
		
		

        Session::put('message','Purchase Payment Information Updated Successfully !');

        return redirect('/purchase-list');

    }

    public function viewPurchaseProduct (Request $request) 
    {

        $rt = $request->purchase_id;

        $purchase = DB::table('purchase_payment_details')
                    ->join('admin','purchase_payment_details.pur_payment_created_by','=','admin.id', 'left')
                    ->join('accounts','purchase_payment_details.account_id','=','accounts.account_id', 'left')
                    ->where('purchase_id', $rt)
                    ->get();

        $ren_data = '';
        foreach ($purchase as $purchase) {
            $ren_data .= '<tr class="even pointer">

                <td class="text-center">'.$purchase->pur_payment_created_date. ' / ' .$purchase->pur_payment_created_time .'</td>
                <td class="text-center">'.$purchase->name.'</td>
                <td class="text-center">'.$purchase->pur_ammount.'</td>
                <td class="text-center">'.$purchase->account_name.'</td>
                <td class="text-center">'.$purchase->payment_check_no .'</td>
                <td class="text-center">'.$purchase->payment_transaction_no .'</td>
                <td class="text-center">'.$purchase->pur_payment_note .'</td>
                
            </tr>';
            
        }
        echo $ren_data;
    }

    public function cancelPurchase (Request $request) 
    {
        
        $data = array();

        date_default_timezone_set("Asia/Dhaka");

        $purchase_id = $request->purchase_id;
        
          
        $data['purchase_status'] = 0;
        $data2['pur_details_status'] = 0;
        $data3['pur_payment_status'] = 0;
		$data4['status'] = 0;
        
        DB::table('purchase')->where('purchase_id', $purchase_id)->update($data);

        DB::table('purchase_details')->where('purchase_id', $purchase_id)->update($data2);

        DB::table('purchase_payment_details')->where('purchase_id', $purchase_id)->update($data3);		
		
        DB::table('balance_table')->where('purchase_id', $purchase_id)->update($data4);
        
        echo '1';
        
    }

    public function delPurchase (Request $request)
    {
        $e = $request->id;

        DB::table('purchase')->where('purchase_id', $e)->delete();
        DB::table('purchase_details')->where('purchase_id', $e)->delete();
        DB::table('purchase_payment_details')->where('purchase_id', $e)->delete();
        DB::table('stock')->where('purchase_id', $e)->delete();

        echo '1';
    }

    public function viewPurchaseInvoice (Request $request) 
    {
        $rdata = $request->purchase_id;

        $purchase_val = DB::table('purchase')
                        ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                        ->where('purchase_id', $rdata)
                        ->first();
        $ren_data = '';

        

        $ren_data .= '  <tr>
                            <td><strong>' . $purchase_val->buyer_name . '</strong><br></td>
                        </tr>
                        <tr>
                            <td>Address: ' . $purchase_val->buyer_address . '<br></td>
                        </tr>
                        <tr>
                            <td>Phone: ' . $purchase_val->buyer_mobile . '<br></td>
                        </tr>
                        <tr>
                            <td>Email: ' . $purchase_val->buyer_email . '<br></td>
                        </tr>
                    ';
        

        if ($ren_data == "") {
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        } else {
            echo $ren_data;
        }
    }


     public function viewPurchaseInvoiceOrder (Request $request) 
    {
        $rdata = $request->purchase_id;

        $purchase_val = DB::table('purchase')
                        ->join('admin','purchase.purchase_created_by','=','admin.id', 'left')
                        ->where('purchase_id', $rdata)
                        ->first();
        $ren_data = '';

        $ren_data .= '  <tr>
                            <td><strong> Order ID # ' . $purchase_val->purchase_id . '</strong><br></td>
                        </tr>
                        <tr>
                            <td><b>Order Date: ' . $purchase_val->purchase_created_date . '</b><br></td>
                        </tr>
                        <tr>
                            <td><b>User Name: ' . $purchase_val->name . '</b><br></td>
                        </tr>
                    ';


        if ($ren_data == "") {
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        } else {
            echo $ren_data;
        }
    }


    public function viewPurchaseInvoiceOrderList (Request $request) 
    {
        $rdata = $request->purchase_id;

        $purchase_data = DB::table('purchase_details')
                        ->join('product', 'purchase_details.product_id', '=', 'product.product_id', 'left')
                        ->where('purchase_id', $rdata)
                        ->get();


        $ren_data = '';
		
		$rr = 1;

        foreach ($purchase_data as $purchase_data) {
     

            $ren_data .= '<tr class="even pointer">
                            <td>' . $rr++ . '</td>
                            <td>' . $purchase_data->product_name . '</td>
                            <td>' . $purchase_data->product_qty . '</td>
                            
                        </tr>';
        }


        if ($ren_data == "") {
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        } else {
            echo $ren_data;
        }
    }


    public function viewPurchaseInvoiceOrderAmmount (Request $request) 
    {
        $rdata = $request->purchase_id;

        $purchase_data = DB::table('purchase')
            ->where('purchase_id', $rdata)
            ->first();


        $ren_data = '';
        
        $discount_amount = $purchase_data->purchase_total - $purchase_data->after_discount;
        


            $ren_data .= '<tr>
                            <th style="width:70%">Subtotal: </th>
                            <td>&#2547; ' . $purchase_data->purchase_total . '</td>
                        </tr>
                        <tr>
                            <th>Discount: </th>
                            <td>&#2547; ' . $purchase_data->purchase_discount . '</td>
                        </tr>
                        <tr>
                            <th>Discount Amount: </th>
                            <td>&#2547; ' . $discount_amount . '</td>
                        </tr>
                        <tr class="hide_print_sec">
                            <th>After Discount: </th>
                            <td>&#2547; ' . $purchase_data->after_discount . '</td>
                        </tr>
                        <tr class="hide_print_sec">
                            <th>Vat(%): </th>
                            <td>' . $purchase_data->purchase_vat . ' %</td>
                        </tr>
                        <tr>
                            <th>Payable: </th>
                            <td>&#2547; ' . $purchase_data->total_ammount_payable . '</td>
                        </tr>
                        <tr>
                            <th>Transportation Cost: </th>
                            <td>&#2547; ' . $purchase_data->transport . '</td>
                        </tr>
                        ';
        


        if ($ren_data == "") {
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        } else {
            echo $ren_data;
        }
    }


    public function viewPurchaseInvoiceOrderPayment (Request $request) 
    {
        $rdata = $request->purchase_id;

        $purchase_payment = DB::table('purchase_payment_details')
            ->where('purchase_id', $rdata)
            ->get();


        $ren_data = '';
        $tot = 0;


        foreach ($purchase_payment as $purchase_payment) {
			
			$tot += $purchase_payment->pur_ammount;
            $ren_data .= '<tr>
                            <th style="width:70%">'.$purchase_payment->pur_payment_created_date .' </th>
                            <td>&#2547; ' . $purchase_payment->pur_ammount . '</td>
                        </tr>
                        ';
        }
		$ren_data .= '<tr style="border-top:1px solid lightgray;">
						<th style="width:68%">Total Paid</th>
						<td>&#2547; ' . $tot . '</td>
					</tr>
					';

        if ($ren_data == "") {
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        } else {
            echo $ren_data;
        }
    }


    public function viewPurchaseInvoiceOrderPaymentDue (Request $request) 
    {
        $rdata = $request->purchase_id;
        

        $data = DB::table('purchase')->where('purchase_id', $rdata)->first();

        $data2 = DB::table('purchase_payment_details')->where('purchase_id', $rdata)->sum('pur_ammount');

        $result = ($data->total_ammount_payable) - $data2;

        //===================  Previous Due Calculation Start  =================//
        
        $buyer_id = $request->buyer_id;

        $buyer = DB::table('buyers')->where('buyer_id', $buyer_id)->first();

        $purchases = DB::table('purchase')
                ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                ->where('purchase_status', 1)
                ->where('purchase.buyer_id', $buyer_id)
                ->orderBy('purchase.purchase_id', 'DESC')
                ->get();

        $payable = 0;
        $paidd = 0;

        foreach ($purchases as $purchase) {

            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');			
            
            $payable += $purchase->total_ammount_payable;
            
            $paidd += $data;
        }

        $old_due = $payable - $paidd;

        $supplier_e_p = DB::table('supplier_extra_payment')->where('buyer_id', $buyer_id)->sum('amount');

        $tot_previous_due = ($buyer->previous_due + $old_due);

        $total_previous_due = ($tot_previous_due - $supplier_e_p);


        //===================  Previous Due Calculation End  =================//

        $ren_data = '';

        $ren_data .= '<tr>
                        <th style="width:70%"><b>Due:</b> </th>
                        <td >&#2547; ' . $result . '</td>
                    </tr>
                    <tr>
                        <th style="width:70%"><b>Previous Due Amount:</b> </th>
                        <td >&#2547; ' . ($total_previous_due - $result) . '</td>
                    </tr>
                    <tr>
                        <th style="width:70%"><b>Total Due Amount:</b> </th>
                        <td >&#2547; ' . $total_previous_due . '</td>
                    </tr>
                    ';

        if ($ren_data == "") {

            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";

        } else {
            echo $ren_data;
        }
         
    }


    public function viewPurchaseInvoiceLastPayment (Request $request) 
    {
        $buyer_id = $request->buyer_id;
        


            $supplier_e_p = DB::table('supplier_extra_payment')
                                ->where('buyer_id', $buyer_id) 
                                ->orderBy('supplier_extra_payment.extra_p_id', 'DESC') 
                                ->first();


        $ren_data = '';
        
        if($supplier_e_p){
            $ren_data .= '<tr>
                        <th style="width:70%"><b>Last  payment:</b> </th>
                        <td >&#2547; '.$supplier_e_p->amount . '</td>
                    </tr>
                    
                    <tr>
                        <th style="width:70%"><b>Last payment Date:</b> </th>
                        <td >'.$supplier_e_p->created_date . '</td>
                    </tr>
                    
                   
                    ';
        }else{
            
            $ren_data = 'No Payments Yet.';
            
        }

        

        
        echo $ren_data;
            
         
    }

    public function purchaseExtraData (Request $request)
    {
        $buyer = $request->buyer_id;
        $purchase = $request->purchase_id;

        echo '<button class="btn btn-warning previous_payment" buyer="'.$buyer.'" purchase="'.$purchase.'"><i class="fa fa-money"></i> Payment</button>';
    }

    // Extra Payment for supplier
    public function addExtraPayment (Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['buyer_id'] = $request->buyer_id;
        $data['purchase_id'] = $request->purchase_id;
        $data['account_id'] = $request->account_id;
        $data['amount'] = $request->amount;
        $data['note'] = $request->note;
        $data['check_no'] = $request->check_no;
        $data['transaction'] = $request->transaction;

        $data['created_by'] = Auth::user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');
        
        DB::table('supplier_extra_payment')->insert($data);

        Session::put('message', 'Information Saved Successfully !!!');
        
        if ($request->go_to == 1) {

            return Redirect::to('/purchase-list');

        } else if ($request->go_to == 2) {

            return Redirect::to('/buyer-list');
        }
    }
    public function addExtraPayment2 (Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['buyer_id'] = $request->buyer_id;
        $data['purchase_id'] = $request->purchase_id;
        $data['account_id'] = $request->account_id;
        $data['amount'] = $request->amount;
        $data['note'] = $request->note;
        $data['check_no'] = $request->check_no;
        $data['transaction'] = $request->transaction;

        $data['created_by'] = Auth::user()->id;
        $data['created_date'] = date('Y-m-d');
        $data['created_time'] = date('H:i:s');
        
        DB::table('supplier_extra_payment')->insert($data);

        Session::put('message', 'Information Saved Successfully !!!');
        
        return Redirect::to('/buyer-list');
        
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
                                        value="'.$ep->extra_p_id.'" 
                                        
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


    public function searchPurchaseList (Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $purchase = DB::table('purchase')
                    ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                    ->orderBy('purchase_id', 'DESC')
                    ->where('purchase_status', 1)
                    ->whereBetween('purchase_created_date', [$start_date, $end_date])
                    ->get();


        $ren_data = "";
		
		$total_orders = count($purchase);
		$payable = 0;
		$paidd = 0;
		$due = 0;
    
        // $or_total = 0;

        foreach ($purchase as $purchase) {
			
			

            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');
			
			
			$payable += $purchase->total_ammount_payable;			
			
			$paidd += $data;	
			

            $result = ($purchase->total_ammount_payable) - $data;

            $pt = url('/') . '/view-order/' . $purchase->purchase_id;
            $rt = url('/') . '/print-order-page/' . $purchase->purchase_id;
            $ren_data .= '<tr class="even pointer">
                                <td class="text-center">' . $purchase->purchase_id . '</td>
                                <td class="text-center">' . $purchase->purchase_created_date . ' / ' . $purchase->purchase_created_time . '</td>
                                <td class="text-center">' . $purchase->buyer_name . '</td>
                                <td class="text-center">' . $purchase->purchase_total . '</td>
                                <td class="text-center">' . $purchase->purchase_discount .'</td>
                                <td class="text-center">' . $purchase->after_discount . '</td>
                                <td class="text-center">' . $purchase->purchase_vat . '%' . '</td>
                                <td class="text-center">' . $purchase->total_ammount_payable . '</td>
                                <td class="text-center hidden">' . $data . '</td>
                                <td class="text-center hidden">' . $result . '</td>
                                <td class="text-center">' . $purchase->purchase_note . '</td>
                                <td class="text-center hide_print_sec hidden">
                                    <button 
                                        class="btn btn-primary btn-xs add_payment_purchase" 
                                        amountDuePurchase="' . $result = ($purchase->total_ammount_payable) - $data . '" 
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_payment_purchase"  
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <button 
                                                   
                                        class="btn btn-info btn-xs pruchase_list_all_view"
                                        dataId="'.$purchase->purchase_id.'"
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>

                                    <!--<button 
                                        class="btn btn-danger btn-xs cancel_purchase"
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-trash"></i> Cancel 
                                    </button>-->
                                    <button 
                                        class="btn btn-danger btn-xs del" 
                                        value="'.$purchase->purchase_id.'"
                                        ><i class="fa fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>';
            // $or_total += $orders->order_total;
        }
		$due = $payable - $paidd;
        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo "<td colspan='13'><br><h4 class='text-center'> Nothing Found.</h4><br></td>";
        }else{
            echo $ren_data.$total_all;
        }
    }


    // Cancel Purchase List
    public function cancelPurchaseList ()
    {

        $all_purchase = DB::table('purchase')
                        ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                        ->orderBy('purchase_id', 'DESC')
                        ->where('purchase_status', 0)
                        ->paginate(10);

        $cancel_purchase_list = view('admin.pages.cancel_purchase_list')->with('all_purchase', $all_purchase);

        return view('admin_master')->with('', $cancel_purchase_list);
    }

    public function returnCancelPurchase (Request $request) 
    {

        $data = array();

        date_default_timezone_set("Asia/Dhaka");

        $purchase_id = $request->purchase_id;
        
          
        $data['purchase_status'] = 1;
        $data2['pur_details_status'] = 1;
        $data3['pur_payment_status'] = 1;
		$data4['status'] = 1;
        
        DB::table('purchase')->where('purchase_id', $purchase_id)->update($data);

        DB::table('purchase_details')->where('purchase_id', $purchase_id)->update($data2);

        DB::table('purchase_payment_details')->where('purchase_id', $purchase_id)->update($data3);	
		
        DB::table('balance_table')->where('purchase_id', $purchase_id)->update($data4);
        
        echo '1';

    }


    public function searchCancelPurchaseList (Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $purchase = DB::table('purchase')
                    ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                    ->orderBy('purchase_id', 'DESC')
                    ->where('purchase_status', 0)
                    ->whereBetween('purchase_created_date', [$start_date, $end_date])
                    ->get();


        $ren_data = "";
		
		$total_orders = count($purchase);
		$payable = 0;
		$paidd = 0;
		$due = 0;
    
        // $or_total = 0;

        foreach ($purchase as $purchase) {

            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');
			
			$payable += $purchase->total_ammount_payable;			
			
			$paidd += $data;	

            $result = ($purchase->total_ammount_payable) - $data;

            $pt = url('/') . '/view-order/' . $purchase->purchase_id;
            $rt = url('/') . '/print-order-page/' . $purchase->purchase_id;
            $ren_data .= '<tr class="even pointer">
                                <td class="text-center">' . $purchase->purchase_created_date . ' / ' . $purchase->purchase_created_time . '</td>
                                <td class="text-center">' . $purchase->purchase_id . '</td>
                                <td class="text-center">' . $purchase->buyer_name . '</td>
                                <td class="text-center">' . $purchase->purchase_total . '</td>
                                <td class="text-center">' . $purchase->purchase_discount .'</td>
                                <td class="text-center">' . $purchase->after_discount . '</td>
                                <td class="text-center">' . $purchase->purchase_vat . '%' . '</td>
                                <td class="text-center">' . $purchase->total_ammount_payable . '</td>
                                <td class="text-center">' . $data . '</td>
                                <td class="text-center">' . $result . '</td>
                                <td class="text-center">' . $purchase->purchase_note . '</td>
                                <td class="text-center hide_print_sec">
                                    <!--<button 
                                        class="btn btn-primary btn-xs add_payment_purchase" 
                                        amountDuePurchase="' . $result = ($purchase->total_ammount_payable) - $data . '" 
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>-->

                                    <button 
                                        class="btn btn-info btn-xs view_payment_purchase"  
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <button 
                                                   
										class="btn btn-info btn-xs pruchase_list_all_view"
										value="'.$purchase->purchase_id.'"
										dataId="'.$purchase->purchase_id.'"
										><i class="glyphicon glyphicon-eye-open"></i> View
									</button>

									<button 
										class="btn btn-success btn-xs return_cancel_purchase" 
										value="'.$purchase->purchase_id.'"
										><i class="glyphicon glyphicon-backward"></i> Return
									</button>
                                </td>
                            </tr>';
            
        }

        $due = $payable - $paidd;
        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>'.$payable.'</b></td>
						<td class="text-center"><b>'.$paidd.'</b></td>
						<td class="text-center"><b>'.$due.'</b></td>
						<td></td>
						<td class="hide_print_sec" colspan="2"></td>
					</tr>';
		
        if($ren_data == ""){
            echo "<br><p>&nbsp;&nbsp;&nbsp;&nbsp; Nothing Found.</p>";
        }else{
            echo $ren_data.$total_all;
        }
    }


    // Due Purchase List
    public function duePurchaseList ()
    {

        $all_purchase = DB::table('purchase')
                        ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                        ->orderBy('purchase_id', 'DESC')
                        ->where('purchase_status', 1)
                        ->paginate(10);

        $due_purchase_list = view('admin.pages.due_purchase_list')->with('all_purchase', $all_purchase);

        return view('admin_master')->with('', $due_purchase_list);

    }
    

    public function duePurchasePaymentList (Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");
        $data2 = array();

        $data2['purchase_id'] = $purchase_id = $request->purchase_id;
        $data2['account_id'] = $account_id = $request->account_id;
        $data2['pur_ammount'] = $pur_ammount = $request->pur_ammount;
        $data2['payment_check_no'] = $payment_check_no = $request->payment_check_no;
        $data2['payment_transaction_no'] = $payment_transaction_no = $request->payment_transaction_no;
        $data2['pur_payment_note'] = $pur_payment_note = $request->pur_payment_note;
        $data2['pur_payment_created_by'] = Auth::user()->id;
        $data2['pur_payment_created_date'] = date('Y-m-d');
        $data2['pur_payment_created_time'] = date('H:i:s');

        DB::table('purchase_payment_details')->insert($data2);
		
		
		// save data for balance table
		
		$data3['balance_type'] = 9;
		
		$data3['purchase_id'] = $purchase_id;

		$data3['account_id'] = $account_id;
		
		$data3['ammount'] = $pur_ammount;
		
		$data3['note'] = 'Supply Expenses (Purchase)';

		$data3['balance_created_by'] = Auth::user()->id;
		$data3['balance_created_date'] = date('Y-m-d');
		$data3['balance_created_time'] = date('H:i:s');

		DB::table('balance_table')->insert($data3);
		

        Session::put('message', 'Due Purchase Payment Information Updated Successfully!');

        return redirect('/due-purchase-list');
    }

    public function searchDuePurchaseList (Request $request)
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $purchase = DB::table('purchase')
                    ->join('buyers', 'purchase.buyer_id', '=', 'buyers.buyer_id', 'left')
                    ->orderBy('purchase_id', 'DESC')
                    ->where('purchase_status', 1)
                    ->whereBetween('purchase_created_date', [$start_date, $end_date])
                    ->get();

        $ren_data = "";
		
		$total_orders = 0;
		$payable = 0;
		$paidd = 0;
		$due = 0;
    
        // $or_total = 0;

        foreach ($purchase as $purchase) {

            $data = DB::table('purchase_payment_details')->where('purchase_id', $purchase->purchase_id)->sum('pur_ammount');
			
				

            $data2 = $purchase->total_ammount_payable;

            $result = ($purchase->total_ammount_payable) - $data;

            $pt = url('/') . '/view-order/' . $purchase->purchase_id;
            $rt = url('/') . '/print-order-page/' . $purchase->purchase_id;

            if ($data2 > $data) {
				
				$total_orders++;
				
				$payable += $purchase->total_ammount_payable;
			
				$paidd += $data;

                $ren_data .= '<tr class="even pointer">
                                <td class="text-center">' . $purchase->purchase_created_date . ' / ' . $purchase->purchase_created_time . '</td>
                                <td class="text-center">' . $purchase->purchase_id . '</td>
                                <td class="text-center">' . $purchase->buyer_name . '</td>
                                <td class="text-center">' . $purchase->purchase_total . '</td>
                                <td class="text-center">' . $purchase->purchase_discount .'</td>
                                <td class="text-center">' . $purchase->after_discount . '</td>
                                <td class="text-center">' . $purchase->purchase_vat . '%' . '</td>
                                <td class="text-center">' . $purchase->total_ammount_payable . '</td>
                                <td class="text-center hidden">' . $data . '</td>
                                <td class="text-center hidden">' . $result . '</td>
                                <td class="text-center">' . $purchase->purchase_note . '</td>
                                <td class="text-center hide_print_sec hidden">
                                    <button
                                        class="btn btn-primary btn-xs add_payment_due_purchase"
                                        amountDuePurchase="' . $result . '" 
                                        value="' . $purchase->purchase_id . '" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> Add
                                    </button>
                                    <button
                                        class="btn btn-info btn-xs view_payment_purchase"
                                        value="' . $purchase->purchase_id . '"
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="text-center hide_print_sec">
                                    <button class="btn btn-info btn-xs pruchase_list_all_view"
										value="'.$purchase->purchase_id.'"
										dataId="'.$purchase->purchase_id.'"
										><i class="glyphicon glyphicon-eye-open"></i> View
									</button>
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
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }
    }


    public function delExtraPayment (Request $request)
    {
        $e = $request->id;

        DB::table('supplier_extra_payment')->where('extra_p_id', $e)->delete();

        echo '1';
    }
}