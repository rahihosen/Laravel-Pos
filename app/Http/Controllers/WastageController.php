<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

class WastageController extends Controller
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
		
        $features = 5;
		
		$admin_role =  $admin_data->admin_role;
		
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
    
    public function addWastage() 
    {
        $all_product = DB::table('product')
                        ->orderBy('product_id','DESC')
                        ->paginate(10);

        $product_list = view('admin.pages.add_wastage_product')
                        ->with('all_product_info',$all_product);
        
        return view('admin_master')
              ->with('admin_main_content',$product_list);
    }

    // Store wastage for stock page request
    public function storeWastage(Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['product_id'] = $request->product_id;

        $data['wastage_quantity'] = $request->wastage_quantity;
		
        $data['purchase_price'] = $request->purchase_price;

        $data['wastage_created_date'] = date('Y-m-d');

        $data['wastage_created_time'] = date('H:i:s');

        $data['wastage_created_by'] = Auth::user()->id;
         
        DB::table('wastage')->insert($data);
		
		
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
		
            
        Session::put('message','Product wastage update successfully!');

        return Redirect::to('/stock');
    }

    // Store wastage for wastage page request
    public function storeWastage2(Request $request) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['product_id'] = $request->product_id;

        $data['wastage_quantity'] = $request->wastage_quantity;       
		
        $data['purchase_price'] = $request->purchase_price;
		
        $data['wastage_created_date'] = date('Y-m-d');
        $data['wastage_created_time'] = date('H:i:s');
        $data['wastage_created_by'] = Auth::user()->id;
       
         
        DB::table('wastage')->insert($data);
            
        Session::put('message','Product wastage update successfully!');

        return Redirect::to('/wastage');
    }
    
    
	
	public function viewWastage (Request $request) 
    {

        $rt = $request->product_id;

        $products = DB::table('wastage')
                    ->join('admin','wastage.wastage_created_by','=','admin.id', 'left')
                    ->where('product_id', $rt)
                    ->orderBy('wastage_id', 'DESC')
                    ->get();

        $ren_data = '';

        foreach ($products as $product) {

            $ren_data .= '<tr class="even pointer">

                <td class="text-center">'.$product->wastage_created_date.'/'.$product->wastage_created_time.'</td>
                <td class="text-center">'.$product->name.'</td>
                <td class="text-center">'.$product->purchase_price.'</td>
                <td class="text-center">'.$product->wastage_quantity.'</td>

            </tr>';
            
        }
        echo $ren_data;
    }
    

    public function searchWastageList (Request $request) {

        $search_val = $request->search_wastage;
        $fk_category_id = $request->fk_category_id;

        if ( $fk_category_id == 0 ) {

            $wastages = DB::table('product')
                        ->where('product_name', 'like', '%'.$search_val.'%')
                        ->orderBy('product_id', 'DESC')
                        ->get();
        } else {

            $wastages = DB::table('product')
                        ->where('product_name', 'like', '%'.$search_val.'%')
                        ->where('fk_category_id', $fk_category_id)
                        ->orderBy('product_id', 'DESC')
                        ->get();
        }


        $ren_data = '';

        foreach ($wastages as $wastages) {

            $pid = $wastages->product_id;
            
            $result = DB::table('wastage')->where('product_id', $pid)->sum('wastage_quantity');

            $single_product = DB::table('wastage')->where('product_id', $pid)->orderBy('wastage_id', 'DESC')->value('wastage_quantity');
			
			if($single_product == ''){
				$single_product = 0;
			}

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$wastages->product_id.'</td>
                            <td class="text-center">'.$wastages->product_name.'</td>
                            <td class="text-center">'.$result.'</td>
                            <td class="text-center">'.$single_product.'</td>
                            <td class="text-center hide_print_sec">
                                <button 
                                    class="btn btn-primary btn-xs add_wastage" 
                                    value="'.$wastages->product_id.'" 
                                    data-productName="'.$wastages->product_name.'"
                                    ><i class="glyphicon glyphicon-plus-sign"></i>  Add Wastage
                                </button>

                                <button 
                                    class="btn btn-info btn-xs view_wastage" 
                                    value="'.$wastages->product_id.'" 
                                    data-productName="'.$wastages->product_name.'"
                                    ><i class="far fa-eye"></i> View Wastage
                                </button></td>
                        </tr>';
        }

        if ($ren_data == "") {
            echo 1;
        } else {
            echo $ren_data;
        }


    }
    
    
    
	public function getPurchasePriceList(Request $request) 
    {

        $product_id = $request->product_id;
        
        $products = DB::table('product')
                    ->where('product_id',$product_id)
                    ->first();
			
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
            
        
		echo $pprice_val.'<option value="0">0.00</option>';
        
    }
	
}
