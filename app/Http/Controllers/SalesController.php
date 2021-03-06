<?php

namespace App\Http\Controllers;


use DB;
use Cart;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

class SalesController extends Controller {   

	protected $url;

    public function __construct(UrlGenerator $url) 
    {
        $this->url = $url;

        $admin_data = Auth::user();

        if(! isset(Auth::user()->id)) {
            header("Location: ".$this->url->to('/'));
			exit();
        }
		
        $features = 4;
		
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

    //======== Order Management ========//

    // for new Order....
	
    public function createSales() 
    {

        $all_product = DB::table('product')
                    ->join('product_type','product.product_type','=','product_type.type_id','left')
                    ->join('stock','product.product_id','=','stock.product_id','left')
                    ->where('product_status', 1)
                    ->orderBy('product.product_name', 'ASC')
					->limit(50)
                    ->get();
		
        $all_cat = DB::table('category')->where('category_status', 1)->where('special_menu', 1)->orderBy('category_name', 'ASC')->get();

        $all_table = DB::table('tables')->orderBy('table_id')->get();
		
        $sales_create_page_show = view('admin.pages.sales_product_show_list')
                                ->with('all_product_info',$all_product)
                                ->with('all_cat_info',$all_cat)
                                ->with('all_table', $all_table);
                                
        return view('admin_master')->with('admin_main_content',$sales_create_page_show);
        
    }
	
	// Click show category product list Function
	
    public function searchByProCat(Request $request)
    {

        $cat_id = $request->by_cat_id;
        
        if($cat_id == "all"){
            $products = DB::table('product')
					->join('product_type','product.product_type','=','product_type.type_id','left')
                    ->where('product_status', 1)
                    ->where('stock.stock_quantity'> 0)
                    ->orderBy('product.product_name','ASC')
					->limit(50)
                    ->get();
        }else{
             $products = DB::table('product')
					->join('product_type','product.product_type','=','product_type.type_id','left')
                    ->where('fk_category_id', $cat_id)
                    ->where('product_status', 1)
                    ->orderBy('product.product_name','ASC')
                    ->get();
        }
       
   
       
        $ren_data = "";
    
        $or_total = 0;
        
        foreach($products as $products){
            
           $pprice_val = "";
			
			$pages_printed = array();
			
			$purchase_prc = DB::table('purchase_details')->where('product_id',$products->product_id)->get(); 
			
			foreach($purchase_prc as $purchase_prc){
				
				$pprice = $purchase_prc->product_purchase_price.'';
				
				if (!isset($pages_printed[$pprice])) {
					
					$pages_printed[$pprice] = true;	
			
					$pprice_val .= '<option value="'.$pprice.'">'.$pprice.'</option>';
				
				}
				
			} 
			
			$total = DB::table('stock')->where('product_id', $products->product_id)->sum('stock_quantity');
			
			$total2 = DB::table('wastage')->where('product_id', $products->product_id)->sum('wastage_quantity');

			$total3 = DB::table('order_details')->where('product_id', $products->product_id)->where('order_details_status', 1)->sum('product_qty');
			
            $result = ($total - $total2 - $total3);
            

            $p_name = strlen($products->product_name) > 60 ? substr($products->product_name,0,60)."..." : $products->product_name;
			

            $ren_data .= '<div class="col-md-4 col-sm-12 col-xs-6 product_block" align="center">
                            <a style="cursor:pointer;position:relative;" class="add_cart" data-productid="'.$products->product_id.'">
                                <img src="'.$products->product_image.'" class="img-thumbnail" style="height:70px; width:100px;"/>
                                <span class="type_name_show">'.$products->type_name.'</span>
                            </a>
                            
                            <br>
                            
                            <h6 style="padding:5px 0 0 0;margin:0;">
                                <a style="cursor:pointer;" class="add_cart" data-productid="'.$products->product_id.'">'.$p_name.'</a>
                            </h6>
                            
                            <div class="purchase_prc_div">
                                <label>P. Prc:</label>
                                <select class="pro_prc_select pur_pro_id_'.$products->product_id.'">'.$pprice_val.'
                                    <option value="0">0.00</option>
                                </select>
                            </div>
                            <p><b>In Stock: </b>'.$result.'</p>
                        </div>';
        }
        
        if($ren_data == ""){
            echo '<br><h4 class="text-center">Nothing Found.<h4>';
        }else{
            echo $ren_data;
        }
        
    }
	
    public function searchByProName(Request $request) 
    {
        $search_val = $request->search_val;
        
        $products = DB::table('product')
					->join('product_type','product.product_type','=','product_type.type_id','left')
                    ->where('product_status', 1)
                    ->where('product_name','like','%'.$search_val.'%')
                    ->orderBy('product.product_name','ASC')
					->limit(50)
                    ->get();
		
        $ren_data = "";
        
        foreach($products as $products){
			
			$pprice_val = "";
			
			$pages_printed = array();
			
			$purchase_prc = DB::table('purchase_details')->where('product_id',$products->product_id)->get(); 
			
			foreach($purchase_prc as $purchase_prc){
				
				$pprice = $purchase_prc->product_purchase_price.'';
				
				if (!isset($pages_printed[$pprice])) {
					
					$pages_printed[$pprice] = true;	
			
					$pprice_val .= '<option value="'.$pprice.'">'.$pprice.'</option>';
				
				}
				
			} 
			
			$total = DB::table('stock')->where('product_id', $products->product_id)->sum('stock_quantity');
			
			$total2 = DB::table('wastage')->where('product_id', $products->product_id)->sum('wastage_quantity');

			$total3 = DB::table('order_details')->where('product_id', $products->product_id)->where('order_details_status', 1)->sum('product_qty');
			
            $result = ($total - $total2 - $total3);
            
            $p_name = strlen($products->product_name) > 60 ? substr($products->product_name,0,60)."..." : $products->product_name;
            
            $ren_data .= '<div class="col-md-4 col-sm-12 col-xs-6 product_block" align="center">
                            <a style="cursor:pointer;position:relative;" class="add_cart" data-productid="'.$products->product_id.'">
                               
                                
                            </a>
                            
                            <br>
                            
                            <h6 style="padding:5px 0 0 0;margin:0;" class="hover_css">
                                <a style="cursor:pointer;" class="add_cart" data-productid="'.$products->product_id.'">'.$p_name.'</a>
                            </h6>
                            <h6 style="padding:5px 0 0 0;margin:0;">
                                '.$products->pack_size.'
                            </h6>
                            
                            <div class="purchase_prc_div">
                                <label>P. Prc:</label>
                                <select class="pro_prc_select pur_pro_id_'.$products->product_id.'">'.$pprice_val.'
                                    <option value="0">0.00</option>
                                </select>
                            </div>
                            <p><b>In Stock: </b>'.$result.'</p>
                        </div>';
            
        }
        
        if($ren_data == ""){
            echo '<br><h4 class="text-center">Nothing Found.<h4>';
        }else{
       
            $total = DB::table('stock')->where('product_id', $products->product_id)->sum('stock_quantity');
			$total2 = DB::table('wastage')->where('product_id', $products->product_id)->sum('wastage_quantity');
            $result = ($total - $total2);
    
			if($result > 0){
				
		
                    echo $ren_data;
            

            
        }
        
        
        
    }
    }
    
    // for search Order list
	
    public function searchOrderDate(Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        
        $orders = DB::table('order')
                    ->join('customer','order.customer_id','=','customer.customer_id')
                    ->orderBy('order_id', 'DESC')
                    ->where('order_status', 1)
                    ->whereBetween('order_created_date', [$start_date, $end_date])
                    ->get();
   
       
        $ren_data = $total_all = "";
    
        // $or_total = 0;
		
		$total_orders = count($orders);
		$payable = 0;
		$paidd = 0;
		$due = 0;
        
        foreach($orders as $orders){
			
            $paid = DB::table('pament_details')->where('order_id', $orders->order_id)->sum('amount');
			
			$payable += $orders->total_amount_payable;			
			
			$paidd += $paid;			

            $result = ($orders->total_amount_payable) - $paid;

            $pt = url('/').'/view-order/'.$orders->order_id;
            $rt = url('/').'/print-order-page/'.$orders->order_id;
            $ren_data .= '<tr class="even pointer"><td class="text-center">'.$orders->order_created_date.' / '. $orders->order_created_time.'</td>
                                <td class="text-center">'.$orders->order_id.'</td>
                                <td class="text-center">'.$orders->customer_name.'</td>
                                <td class="text-center">'.$orders->order_total.'</td>
                                <td class="text-center">'.$orders->order_discount.'</td>
                                <td class="text-center">'.$orders->after_discount.'</td>
                                <td class="text-center">'.$orders->order_vat.'%'.'</td>
                                <td class="text-center">'.$orders->total_amount_payable.'</td>
                                <td class="text-center hidden">'.$paid.'</td>
                                <td class="text-center hidden">'.$result.'</td>
                                <td class="text-center hide_print_sec hidden">
                                    <button 
                                        class="btn btn-primary btn-xs add_payment" 
                                        data-amountDue="'. $result =  ($orders->total_amount_payable) - $paid .'" 
                                        value="'.$orders->order_id.'" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_payment"  
                                        data-amountDue="'. $result =  ($orders->total_amount_payable) - $paid .'" 
                                        value="'.$orders->order_id.'" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <!--<a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>-->
                                    <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <button 
                                        class="btn btn-danger btn-xs cancel_order"
                                        value="'.$orders->order_id.'" 
                                        ><i class="glyphicon glyphicon-trash"></i> Cancel Order
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
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }
        
    }
    
    
    
    
    //scarch company statement
    
    
    public function searchOrderDateCompany(Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        
        $orders = DB::table('order')
                    ->join('customer','order.customer_id','=','customer.customer_id')
                     ->join('admin','order.order_created_by','=','admin.id', 'left')
                    ->orderBy('order_id', 'DESC')
                    ->where('order_status', 1)
                    ->whereBetween('order_created_date', [$start_date, $end_date])
                    ->get();
   
       
        $ren_data = $total_all = "";
    
        // $or_total = 0;
		
		$total_orders = count($orders);
		$payable = 0;
		$paidd = 0;
		$due = 0;
        
        foreach($orders as $orders){
			
            $paid = DB::table('pament_details')->where('order_id', $orders->order_id)->sum('amount');
			
			$payable += $orders->total_amount_payable;			
			
			$paidd += $paid;			

            $result = ($orders->total_amount_payable) - $paid;

            $pt = url('/').'/view-order/'.$orders->order_id;
            $rt = url('/').'/print-order-page/'.$orders->order_id;
            $ren_data .= '<tr class="even pointer">
                                <td class="text-center">'.$orders->order_id.'</td>
                                <td class="text-center">'.$orders->order_created_date.' / '. $orders->order_created_time.'</td>
                                
                                <td class="text-center">'.$orders->name.'</td>
                                <td class="text-center">'.$orders->customer_name.'</td>
                                <td class="text-center">'.$orders->prev_due.'</td>
                                <td class="text-center">'.$orders->customer_address.'</td>
                                <td class="text-center">'.$orders->order_total.'</td>
                                <td class="text-center">'.$paid.'</td>
                                <td class="text-center">'.$result.'</td>
                                <td class="text-center hidden">'.$paid.'</td>
                                <td class="text-center hidden">'.$result.'</td>
                                
                            </tr>';
            // $or_total += $orders->order_total;
        }
        
		$due = $payable - $paidd;
		
		$total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>'.$total_orders.'</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>'.$paidd.'</b></td>
						<td class="text-center"><b>'.$due.'</b></td>
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    ///scarch order date by admin
    
    
    
    
    public function searchOrderDate2(Request $request) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        $admin = $request->admin;
        
        $orders = DB::table('order')
                    ->join('customer','order.customer_id','=','customer.customer_id')
                    ->orderBy('order_id', 'DESC')
                    ->where('order_created_by', $admin)
                    ->where('order_status', 1)
                    ->whereBetween('order_created_date', [$start_date, $end_date])
                    ->get();
   
       
        $ren_data = $total_all = "";
    
        // $or_total = 0;
		
		$total_orders = count($orders);
		$payable = 0;
		$paidd = 0;
		$due = 0;
        
        foreach($orders as $orders){
			
            $paid = DB::table('pament_details')->where('order_id', $orders->order_id)->sum('amount');
			
			$payable += $orders->total_amount_payable;			
			
			$paidd += $paid;			

            $result = ($orders->total_amount_payable) - $paid;

            $pt = url('/').'/view-order/'.$orders->order_id;
            $rt = url('/').'/print-order-page/'.$orders->order_id;
            $ren_data .= '<tr class="even pointer"><td class="text-center">'.$orders->order_created_date.' / '. $orders->order_created_time.'</td>
                                <td class="text-center">'.$orders->order_id.'</td>
                                <td class="text-center">'.$orders->customer_name.'</td>
                                <td class="text-center">'.$orders->order_total.'</td>
                                <td class="text-center">'.$orders->order_discount.'</td>
                                <td class="text-center">'.$orders->after_discount.'</td>
                                <td class="text-center">'.$orders->order_vat.'%'.'</td>
                                <td class="text-center">'.$orders->total_amount_payable.'</td>
                                <td class="text-center hidden">'.$paid.'</td>
                                <td class="text-center hidden">'.$result.'</td>
                                <td class="text-center hide_print_sec hidden">
                                    <button 
                                        class="btn btn-primary btn-xs add_payment" 
                                        data-amountDue="'. $result =  ($orders->total_amount_payable) - $paid .'" 
                                        value="'.$orders->order_id.'" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_payment"  
                                        data-amountDue="'. $result =  ($orders->total_amount_payable) - $paid .'" 
                                        value="'.$orders->order_id.'" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <!--<a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>-->
                                    <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <button 
                                        class="btn btn-danger btn-xs cancel_order"
                                        value="'.$orders->order_id.'" 
                                        ><i class="glyphicon glyphicon-trash"></i> Cancel Order
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
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }
        
    }
	
	
	
	
	
	
	//// Cart
	
	
	
    public function addToCart (Request $request) 
    {

        $product_info = DB::table('product')->where('product_id',$request->product_id)->first();

        $data = array();
        $data['id'] = $product_info->product_id;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_sell_price;
        $data['qty'] = 1;
        $data['options']['image'] = $product_info->product_image;		
        $data['options']['purchase_prc'] = $request->purchase_prc;
        Cart::add($data);

        $c_total = Cart::total();

        if($c_total == 0) {

            echo 1;

        } else {

            $cont = Cart::content();

            $ret_dat = "";

            foreach ($cont as $products) {

                $ret_dat .= '<tr class="rem_row_'. $products->rowId .'">
                                <!--<td>
                                    <img src="'.$products->options['image'].'" alt="'.$products->name.'" width="50px" height="40 px"/>
                                </td>-->

                                <td>'.$products->name.'</td>
								
                                <td>'.$products->options['purchase_prc']. '</td>

                                <td>
                                    <input style="margin-left: 30px;" type="text" value="'.$products->price.'" data-rID="'.$products->rowId.'" class="sell_input sell_p_'.$products->rowId. '">
                                </td>

                                <td>
                                    <div style="width:95px;" class="q_input_fields">
                                        <input style="margin-left: 30px;" value="'.$products->qty.'" class="product_id_'.$products->rowId. ' q_input" type="text" data-rID="'.$products->rowId.'" data-prc="'.$products->price.'">
                                    </div>
                                        
                                </td>
                                
                                <td class="shwTotal_'.$products->rowId.' text-center">'.$products->price*$products->qty.'</td>
                                <td class="actions" data-th="">
                                
                                    <button type="button" onclick="removeFunction(\''.$products->rowId.'\')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>

                                </td>
                            </tr>';

            }

            $ret_dat .= "__sep__". $c_total;

            echo $ret_dat;
        }

    }
    
   
    public function update (Request $request) {

        $qty = $request->qty;
        $rowid = $request->rowid;
        $price = $request->sell_p;

        // Cart::update($rowid,$qty);
        // Cart::update($rowid,$price);

        Cart::update($rowid, ['qty' => $qty]);
        Cart::update($rowid, ['price' => $price]);
        
        echo Cart::total();

    }

    public function removeItem (Request $request) {

        $id = $request->rem_id;
        Cart::remove($id);
        
        if(Cart::total() > 0) {

            echo Cart::total();

        } else {

            echo 1;

        }
        
    }
    
    public function cartDestory () {

        Cart::destroy();
        return Redirect::to('/create-sales');

    }
	
	
	
	//// Check OUT
	
	
	// order all data save funcitons..
	
    public function saveOrder(Request $request) 
    {
        
        
        date_default_timezone_set("Asia/Dhaka");
       
        $a = \Cart::total();

        if($a > 0) {
            
       
            $checked = $request->default_customer;
            
            if($checked == 1) {

                $customer_id = 1;
            }

            if($checked == 2) {
                
                $data = array();
                $data['customer_name']  = $request->customer_names;
                $data['customer_mobile'] = $request->customer_mobile;
                
                $data['customer_address'] = $request->customer_address;
               
                $data['prev_due'] = $request->prev_due;
               
                $data['customer_created_date'] = date('Y-m-d');
                $data['customer_created_time'] = date('H:i:s');
                $data['customer_created_by'] = Auth::user()->id;
				
                // $customer_mobile = $data['customer_mobile'] = $request->customer_mobile;

                // $customer_nid =  $data['customer_nid'] = $request->customer_nid;

    //             $existing_customer_check = DB::table('customer')->where('customer_mobile',$customer_mobile)->exists();

    //             $existing_customer_nid_check = DB::table('customer')->where('customer_nid', $customer_nid)->exists();

    //             if($existing_customer_check) {

    //                 Session::put('error','Customer Already Exists. Please Try Another Mobile Number.');
				// 	return Redirect::to('/create-sales');

    //             } else if ( $existing_customer_nid_check ) {

    //                 Session::put('error', 'Customer NID Already Exists. Please Try Another NID Number.');
    //                 return Redirect::to('/create-sales');

    //             } else {

                    $customer_id = DB::table('customer')->insertGetId($data);
                // }
            
            } 

            if ( $checked == 3 ) {

                $customer_id = $request->customer_name;

            }
            
            $odata = array();
            $odata['customer_id'] = $customer_id;
            $odata['order_type'] = $request->order_type;
            $odata['order_created_date'] = date('Y-m-d');
            $odata['order_created_time'] = date('H:i:s');
            $odata['order_created_by'] = Auth::user()->id;
            $odata['order_total'] = \Cart::total();
            $odata['order_vat'] = $request->order_vat;
			
            $order_discount = $request->order_discount;
			
            $order_discount_type = $request->order_discount_type;
			
			if($order_discount_type == 1){
				
				$odata['order_discount'] = $request->order_discount."  ???";
				
			}
			
			if($order_discount_type == 2){
				
				$odata['order_discount'] = $request->order_discount." %";
				
			}
			
           
			
            $odata['after_discount'] = $request->after_discount;
            $odata['total_amount_payable'] = $request->total_amount_payable;
            

            
            if ($request->fk_table_id != "") {

                $all_table = $request->fk_table_id;

                if(count($all_table) == 0) {

                    $odata['table_number'] = 0;

                } else {

                    $odata['table_number'] = implode(",",$all_table);

                }

            } else {

                $odata['table_number'] = 0;

            }
               
            
            $order_id = DB::table('order')->insertGetId($odata);


            if ( $request->amount_received >= $request->total_amount_payable ) {

                $odata2['amount'] = $amnt = $request->total_amount_payable;

            } else {

                $odata2['amount'] = $amnt = $request->amount_received;
                
            }

            $odata2['order_id'] = $order_id;
			$odata2['account_id'] = $request->account_id;
			$odata2['transaction_no'] = $request->transaction_no;
            $odata2['created_date'] = date('Y-m-d');
            $odata2['created_time'] = date('H:i:s');
            $odata2['created_by'] = Auth::user()->id;

            DB::table('pament_details')->insert($odata2);
			
			
			// save data for balance table
		
			$data2['balance_type'] = 6;
			
			$data2['order_id'] = $order_id;

			$data2['account_id'] = $request->account_id;
			
			$data2['ammount'] = $amnt;
			
			$data2['note'] = 'Income from orders';

			$data2['balance_created_by'] = Auth::user()->id;
			$data2['balance_created_date'] = date('Y-m-d');
			$data2['balance_created_time'] = date('H:i:s');

			DB::table('balance_table')->insert($data2);


            // start order_details
            $oddata = array();
            $oddata['order_id'] = $order_id;
            $oddata['customer_id'] = $customer_id;
            $contents = \Cart::content();
            
            foreach($contents as $products_data) {

                $oddata['product_id'] = $products_data->id;
                $oddata['product_sale_price'] = $products_data->price;
                $oddata['product_qty'] = $products_data->qty;
                $oddata['purchase_price'] = $products_data->options['purchase_prc'];
                $oddata['order_details_created_date'] = date('Y-m-d');
                $oddata['order_details_created_time'] = date('H:i:s');
                $oddata['order_details_created_by'] = Auth::user()->id;
            
                DB::table('order_details')->insert($oddata);
                    
            }
			
			
			$check = DB::table('sales_report')->where('sales_report_date', date('Y-m-d'))->first();
			
			$data = array();
			
			$data['total_wastage'] = DB::table('wastage')->where('wastage_created_date', date('Y-m-d'))->sum('wastage_quantity');
			
			$data['total_sold'] = DB::table('order_details')->where('order_details_created_date', date('Y-m-d'))->where('order_details_status', 1)->sum('product_qty');
			$data['created_by'] = Auth::user()->id;
			
			if($check != ''){
				
				DB::table('sales_report')->where('sales_report_id',$check->sales_report_id)->update($data);
				
			}else{
				
				$data['sales_report_date'] = date('Y-m-d');
			
				DB::table('sales_report')->insert($data);
				
			}
			
			
            
            \Cart::destroy();
            
        
            if($request->save_or_print == "1") {

                Session::put('message','Order saved succesfully!');
                return Redirect::to('/create-sales');
            }

            if($request->save_or_print == "2") {

                Session::put('message','Order saved succesfully!');

                return Redirect::to('/view-order/'.$order_id);
            }            
        
        } else {

            Session::put('error','Cart is Empty! Add some item to cart.');
            return Redirect::to('/create-sales');
        }
    }
	
	
    public function orderList() 
    {


        $all_order = DB::table('order')
                        ->join('customer','order.customer_id','=','customer.customer_id', 'left')
                        ->join('admin','order.order_created_by','=','admin.id', 'left')
                        ->where('order_status', 1)
                        ->orderBy('order_id','DESC')
                        ->paginate(10);
        
        return view('admin.pages.order_list')->with('all_order_info',$all_order);
                
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
                                ->join('admin','order.order_created_by','=','admin.id', 'left')
                                ->where('order_id',$order_id)
                                ->first();


        //============ Total Due Calculation Start ============//

            $previous_due = DB::table('customer')
                                ->where('customer_id', $single_order_customer->customer_id)
                                ->sum('credit_limit'); // Customer previous due total

            $total_or_amount = DB::table('order')->where('customer_id', $single_order_customer->customer_id)->where('order_status', 1)->sum('total_amount_payable');

            $o_alls = DB::table('order')->where('customer_id',$single_order_customer->customer_id)->where('order_status', 1)->get();

            $tot_paid = 0;

            foreach($o_alls as $o) {

                $paid = DB::table('pament_details')->where('order_id', $o->order_id)->sum('amount');

                $tot_paid +=$paid;
            }

            $customer_e_p = DB::table('customer_extra_payment')->where('customer_id', $single_order_customer->customer_id)->sum('amount');

            $final_total_due = ($total_or_amount - $tot_paid);

            $tot_pre_due = ($previous_due + $final_total_due);

            $tot_previous_due = ($tot_pre_due - $customer_e_p);
            
            //============ Total Due Calculation End ============// 
            
                        $customer_last_payment = DB::table('customer_extra_payment')
                                ->where('customer_id', $single_order_customer->customer_id)
                                ->orderBy('customer_extra_payment.c_p_id', 'DESC') 
                                ->first();
                



        

        $order_view_info = view('admin.pages.single_order_view')
                            ->with('single_order_info',$single_order)
                            ->with('single_order_info_customer',$single_order_customer)
                            ->with('previous_due',$previous_due)
                            ->with('tot_previous_due',$tot_previous_due)
                            ->with('customer_last_payment',$customer_last_payment);
        
        return view('admin_master')->with('admin_main_content',$order_view_info);
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

        //============ Total Due Calculation Start ============//

            $previous_due = DB::table('customer')
                                ->where('customer_id', $single_order_customer->customer_id)
                                ->sum('credit_limit'); // Customer previous due total

            $total_or_amount = DB::table('order')->where('customer_id', $single_order_customer->customer_id)->sum('total_amount_payable');

            $o_alls = DB::table('order')->where('customer_id',$single_order_customer->customer_id)->get();

            $tot_paid = 0;

            foreach($o_alls as $o) {

                $paid = DB::table('pament_details')->where('order_id', $o->order_id)->sum('amount');

                $tot_paid +=$paid;
            }

            $final_total_due = ($total_or_amount - $tot_paid);

            $tot_previous_due = ($previous_due + $final_total_due);

            

        //============ Total Due Calculation End ============// 
        
        return view('admin.pages.print_order_page')
                ->with('single_order_info', $single_order)
                ->with('single_order_info_customer', $single_order_customer)
                ->with('previous_due',$previous_due)
                ->with('tot_previous_due',$tot_previous_due);
    }

    
	
	///// Cancel Orders
	
	
	
    public function cancelOrder( Request $request ) 
    {

        
        $data = array();
        $data2 = array();
        $data3 = array();
        $data4 = array();

        $order_id = $request->order_id;
          
        $data['order_status'] = 0;
        $data2['order_details_status'] = 0;
        $data3['status'] = 0;
        $data4['status'] = 0;
        
        DB::table('order')->where('order_id', $order_id)->update($data);

        DB::table('order_details')->where('order_id', $order_id)->update($data2);
		
        DB::table('pament_details')->where('order_id', $order_id)->update($data3);
		
        DB::table('balance_table')->where('order_id', $order_id)->update($data4);
        
        echo '1';
        
    }

    public function ReturnCancelOrder( Request $request ) 
    {

        
        $data = array();
        $data2 = array();
        $data3 = array();
        $data4 = array();
		

        $order_id = $request->order_id;
          
        $data['order_status'] = 1;
        $data2['order_details_status'] = 1;
        $data3['status'] = 1;
        $data4['status'] = 1;
        
        DB::table('order')->where('order_id', $order_id)->update($data);

        DB::table('order_details')->where('order_id', $order_id)->update($data2);
		
        DB::table('pament_details')->where('order_id', $order_id)->update($data3);
		
        DB::table('balance_table')->where('order_id', $order_id)->update($data4);
        
        echo '1';
		
    }
    
	public function cancelOrderList() {

        $all_cancel_order = DB::table('order')
                            ->join('customer','order.customer_id','=','customer.customer_id')
                            ->orderBy('order_id','DESC')
                            ->where('order_status', 0)
                            ->paginate(10);


        $cancel_order_list = view('admin.pages.cancel_order_list')
                            ->with('all_cancel_order_info',$all_cancel_order);
        
        return view('admin_master')->with('admin_main_content',$cancel_order_list);
    }    
    
    public function searchOrderList(Request $request) {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $orders = DB::table('order')
                    ->join('customer','order.customer_id','=','customer.customer_id')
                    ->orderBy('order_id', 'DESC')
                    ->where('order_status', 0)
                    ->whereBetween('order_created_date', [$start_date, $end_date])
                    ->get();

        $ren_data = $total_all = "";
    
        // $or_total = 0;
		
		$total_orders = count($orders);
		$payable = 0;
		$paidd = 0;
		$due = 0;
        
        foreach($orders as $orders){
			
            $paid = DB::table('pament_details')->where('order_id', $orders->order_id)->sum('amount');
			
			$payable += $orders->total_amount_payable;			
			
			$paidd += $paid;			

            $result = ($orders->total_amount_payable) - $paid;

            $pt = url('/') . '/view-order/' . $orders->order_id;
            $rt = url('/') . '/print-order-page/' . $orders->order_id;
            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$orders->order_created_date.' / '. $orders->order_created_time.'</td>
                            <td class="text-center">'.$orders->order_id.'</td>
                            <td class="text-center">'.$orders->customer_name.'</td>
                            <td class="text-center">'.$orders->order_total.'</td>
                            <td class="text-center">'.$orders->order_discount.'</td>
                            <td class="text-center">'.$orders->after_discount.'</td>
                            <td class="text-center">'.$orders->order_vat.'%'.'</td>
                            <td class="text-center">'.$orders->total_amount_payable.'</td>
                            <td class="text-center hidden">'.$paid.'</td>
                            <td class="text-center hidden">'.$result.'</td>

								<td class="text-center hide_print_sec hidden">

                                    <button 
                                        class="btn btn-info btn-xs view_payment"  
                                        data-amountDue="'. $result =  ($orders->total_amount_payable) - $paid .'" 
                                        value="'.$orders->order_id.'" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <!--<a href="'.$rt.'" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>-->
                                    <a href="'.$pt.'" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <button 
                                        class="btn btn-success btn-xs return_cancel_order"
                                        value="'.$orders->order_id.'" 
                                        ><i class="glyphicon glyphicon-backward"></i> Return Order
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
						<td class="text-center hidden"><b>'.$paidd.'</b></td>
						<td class="text-center hidden"><b>'.$due.'</b></td>
						<td class="hide_print_sec"></td>
					</tr>';

        if ($ren_data == "") {

            echo 1;

        } else {

            echo $ren_data.$total_all;
        }



    }
	
	
	
	
	//// DUE 
	
	
	public function addDuePayment(Request $request) {

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

        Session::put('message','Order Payment Information Updated Successfully!');

        return redirect('/order-list');

    }


    public function viewPayment (Request $request) {

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




    public function searchOrderId(Request $request)
    {

        $order_id = $request->order_id;
       

        $orders = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
            ->where('order_id', $order_id)
            ->get();


        $ren_data = $total_all = "";

        // $or_total = 0;

        $total_orders = count($orders);
        $payable = 0;
        $paidd = 0;
        $due = 0;

        foreach ($orders as $orders) {

            $paid = DB::table('pament_details')->where('order_id', $orders->order_id)->sum('amount');

            $payable += $orders->total_amount_payable;

            $paidd += $paid;

            $result = ($orders->total_amount_payable) - $paid;

            $pt = url('/') . '/view-order/' . $orders->order_id;
            $rt = url('/') . '/print-order-page/' . $orders->order_id;
            $ren_data .= '<tr class="even pointer"><td class="text-center">' . $orders->order_created_date . ' / ' . $orders->order_created_time . '</td>
                                <td class="text-center">' . $orders->order_id . '</td>
                                <td class="text-center">' . $orders->customer_name . '</td>
                                <td class="text-center">' . $orders->order_total . '</td>
                                <td class="text-center">' . $orders->order_discount . '</td>
                                <td class="text-center">' . $orders->after_discount . '</td>
                                <td class="text-center">' . $orders->order_vat . '%' . '</td>
                                <td class="text-center">' . $orders->total_amount_payable . '</td>
                                <td class="text-center hidden">' . $paid . '</td>
                                <td class="text-center hidden">' . $result . '</td>
                                <td class="text-center hide_print_sec hidden">
                                    <button 
                                        class="btn btn-primary btn-xs add_payment" 
                                        data-amountDue="' . $result =  ($orders->total_amount_payable) - $paid . '" 
                                        value="' . $orders->order_id . '" 
                                        ><i class="fa fa-edit"></i> Add 
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_payment"  
                                        data-amountDue="' . $result =  ($orders->total_amount_payable) - $paid . '" 
                                        value="' . $orders->order_id . '" 
                                        ><i class="glyphicon glyphicon-eye-open"></i> View
                                    </button>
                                </td>
                                <td class="last text-center hide_print_sec">
                                    <!--<a href="' . $rt . '" target="_blank" class="btn btn-warning btn-xs"> <i class="glyphicon glyphicon-print"></i> Print</a>-->
                                    <a href="' . $pt . '" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <button 
                                        class="btn btn-danger btn-xs cancel_order"
                                        value="' . $orders->order_id . '" 
                                        ><i class="glyphicon glyphicon-trash"></i> Cancel Order
                                    </button>
                                </td>
                            </tr>';
            // $or_total += $orders->order_total;
        }

        $due = $payable - $paidd;

        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total</b></td>
						<td class="text-center"><b>' . $total_orders . '</b></td>
						<td colspan="5"></td>
						<td class="text-center"><b>' . $payable . '</b></td>
						<td class="text-center hidden"><b>' . $paidd . '</b></td>
						<td class="text-center hidden"><b>' . $due . '</b></td>
						<td class="hide_print_sec"></td>
					</tr>';

        if ($ren_data == "") {
            echo 1;
        } else {
            echo $ren_data . $total_all;
        }
    }



    public function SalesByPerson()
    {

        $id = Auth::user()->id;


        $all_order = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.customer_id', 'left')
            ->where('order_status', 1)
            ->where('order_created_by',$id)
            ->orderBy('order_id', 'DESC')
            ->paginate(10);

        return view('admin.pages.orderList_salesPerson')->with('all_order_info', $all_order);
    }
    
    
    
    
     public function compnayStatement() 
    {


        $all_order = DB::table('order')
                        ->join('customer','order.customer_id','=','customer.customer_id', 'left')
                        ->join('admin','order.order_created_by','=','admin.id', 'left')
                        ->where('order_status', 1)
                        ->orderBy('order_id','DESC')
                        ->paginate(10);
        
        return view('admin.pages.company_statement')->with('all_order_info',$all_order);
                
    }




 public function OrderViewCalan($order_id) 
    {
        
        $single_order = DB::table('order_details')
                        ->join('product', 'order_details.product_id', '=', 'product.product_id', 'left')
                        ->where('order_id',$order_id)
                        ->get();
        
        $single_order_customer = DB::table('order')
                                ->join('customer','order.customer_id','=','customer.customer_id', 'left')
                                ->join('admin','order.order_created_by','=','admin.id', 'left')
                                ->where('order_id',$order_id)
                                ->first();


        //============ Total Due Calculation Start ============//

            $previous_due = DB::table('customer')
                                ->where('customer_id', $single_order_customer->customer_id)
                                ->sum('credit_limit'); // Customer previous due total

            $total_or_amount = DB::table('order')->where('customer_id', $single_order_customer->customer_id)->where('order_status', 1)->sum('total_amount_payable');

            $o_alls = DB::table('order')->where('customer_id',$single_order_customer->customer_id)->where('order_status', 1)->get();

            $tot_paid = 0;

            foreach($o_alls as $o) {

                $paid = DB::table('pament_details')->where('order_id', $o->order_id)->sum('amount');

                $tot_paid +=$paid;
            }

            $customer_e_p = DB::table('customer_extra_payment')->where('customer_id', $single_order_customer->customer_id)->sum('amount');

            $final_total_due = ($total_or_amount - $tot_paid);

            $tot_pre_due = ($previous_due + $final_total_due);

            $tot_previous_due = ($tot_pre_due - $customer_e_p);
            
            //============ Total Due Calculation End ============// 
            
                        $customer_last_payment = DB::table('customer_extra_payment')
                                ->where('customer_id', $single_order_customer->customer_id)
                                ->orderBy('customer_extra_payment.c_p_id', 'DESC') 
                                ->first();
                



        

        $order_view_info = view('admin.pages.order_view_calan')
                            ->with('single_order_info',$single_order)
                            ->with('single_order_info_customer',$single_order_customer)
                            ->with('previous_due',$previous_due)
                            ->with('tot_previous_due',$tot_previous_due)
                            ->with('customer_last_payment',$customer_last_payment);
        
        return view('admin_master')->with('admin_main_content',$order_view_info);
    }


















}
