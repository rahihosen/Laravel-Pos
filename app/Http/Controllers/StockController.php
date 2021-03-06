<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

class StockController extends Controller
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
	
    public function addStock () 
    {

        $all_product = DB::table('product')->orderBy('product_id','DESC')->paginate(10);

        $product_list = view('admin.pages.add_stock_product')->with('all_product_info', $all_product);
        
        return view('admin_master')->with('admin_main_content', $product_list);
		
    }
    
    // Add Stock Function
    public function updateStock (Request $request) 
    {
        
        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['product_id'] = $request->product_id;

        $data['stock_quantity'] = $request->stock_quantity;
		
		$data['purchase_price'] = $request->purchase_price;

        $data['stock_created_date'] = date('Y-m-d');

        $data['stock_created_time'] = date('H:i:s');

        $data['stock_created_by'] = Auth::user()->id;
        
        DB::table('stock')->insert($data);

        Session::put('message','Product quantity added successfully!');
           
        return Redirect::to('/stock');
        
    }

    public function viewStock (Request $request) 
    {

        $rt = $request->product_id;

        $stocks = DB::table('stock')
                    ->join('admin','stock.stock_created_by','=','admin.id', 'left')
                    ->where('product_id', $rt)
                    ->orderBy('product_id', 'DESC')
                    ->limit(20)
                    ->get();

        $ren_data = '';

        foreach ($stocks as $stocks) {

            $ren_data .= '<tr class="even pointer">

                <td class="text-center">'.$stocks->stock_created_date.' / '.$stocks->stock_created_time.'</td>
                <td class="text-center">'.$stocks->name.'</td>
                <td class="text-center">'.$stocks->stock_quantity.'</td>
                <td class="text-center">'.$stocks->purchase_price.'</td>

            </tr>';
            
        }
		
        echo $ren_data;
		
    }

    public function searchStockList (Request $request) 
    {

        $search_val = $request->search_stock;
        $fk_category_id = $request->fk_category_id;

        if ( $fk_category_id == 0 ) {

            $stocks = DB::table('product')
                    ->where('product_name', 'like', '%'.$search_val.'%')
                    ->orderBy('product_id', 'DESC')
                    ->get();
        } else {

            $stocks = DB::table('product')
                    ->where('product_name', 'like', '%'.$search_val.'%')
                    ->where('fk_category_id', $fk_category_id)
                    ->orderBy('product_id', 'DESC')
                    ->get();
        }

        

        $ren_data = '';

        foreach ($stocks as $stocks) {

            $pid = $stocks->product_id;

            $total = DB::table('stock')->where('product_id', $pid)->sum('stock_quantity');
			
            $total2 = DB::table('wastage')->where('product_id', $pid)->sum('wastage_quantity');

            $total3 = DB::table('order_details')->where('product_id', $pid)->where('order_details_status', 1)->sum('product_qty');
            
            $result = ($total - $total2 - $total3);

            $single_product = DB::table('stock')->where('product_id', $pid)->orderBy('stock_id', 'DESC')->value('stock_quantity');
			
			if($single_product == ''){
				$single_product = 0;
			}

            $total_sold = DB::table('order_details')->where('product_id', $pid)->where('order_details_status', 1)->sum('product_qty');
			
			$tot_was = DB::table('wastage')->where('product_id', $pid)->sum('wastage_quantity');

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">'.$stocks->product_id.'</td>
                            <td class="text-center">'.$stocks->product_name.'</td>
                            <td class="text-center">'.$result.'</td>
                            <td class="text-center">'.$single_product.'</td>
                            <td class="text-center">'.$total_sold.'</td>
                            <td class="text-center">'.$tot_was.'</td>
                            <td class="text-center hide_print_sec">
                                <button 
                                    class="btn btn-primary btn-xs add_stock" 
                                    value="'.$stocks->product_id.'" 
                                    data-productName="'.$stocks->product_name.'"
                                    ><i class="glyphicon glyphicon-plus-sign"></i> Add Stock
                                </button>

                                <button 
                                    class="btn btn-info btn-xs view_stock" 
                                    value="'.$stocks->product_id.'" 
                                    data-productName="'.$stocks->product_name.'"
                                    ><i class="far fa-eye"></i> View Stock
                                </button>

                                <button 
                                    class="btn btn-primary btn-xs add_wastage" 
                                    value="'.$stocks->product_id.'" 
                                    data-productName="'.$stocks->product_name.'"
                                    ><i class="glyphicon glyphicon-plus-sign"></i> Add Wastage
                                </button>
								
								<button class="btn btn-info btn-xs view_wastage" value="'.$stocks->product_id.'" data-productName="'.$stocks->product_name.'">
									<i class="far fa-eye"></i> View Wastage
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
    
    public function stockList() {

        $all_stock = DB::table('stock')
                        ->join('product', 'stock.product_id', '=', 'product.product_id')
                        ->orderBy('stock_id','DESC')
                        ->paginate(10);

        $stock_list = view('admin.pages.product_stock_list')
                      ->with('all_stock_info',$all_stock);
        
        return view('admin_master')
              ->with('admin_main_content',$stock_list);
    }
	
    public function outOfStock() {

        $all_product = DB::table('product')->orderBy('product_id','DESC')->get();

        $product_list = view('admin.pages.out_of_stock_product')->with('all_product_info', $all_product);
        
        return view('admin_master')->with('admin_main_content', $product_list);
    }
    
    
    
  
}
