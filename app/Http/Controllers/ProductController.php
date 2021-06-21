<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;
 
class ProductController extends Controller {
	
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

    
    public function search_generics (Request $request) {
        
        $search_generics = $request->search_generics;

		$generics = DB::table('category')
					->where('category_name', 'like', '%'.$search_generics.'%')
					->orderBy('category_name', 'ASC')
					->get();
					
					
        $ren_data = '';

        // $or_total = 0;

        foreach($generics as $category) {

            if ($category->special_menu == 1 ) {

                $special_menu = '<span class="label label-success">Yes</a>';

            } else {

                $special_menu = '<span class="label label-warning">No</span>';

            }
			
			if ($category->category_status == 1 ) {

                $category_status = '<span class="label label-success">Active</a>';

            } else {

                $category_status = '<span class="label label-warning">Inactive</span>';

            }

            $ren_data .= '<tr class="even pointer">

							<!--<td class="text-center">'.$category->category_id.'</td>-->
							
							<td class="text-center">'.$category->category_name.'</td>
							
							<td class="text-center">'.$category->category_order.'</td>
							
							<td class="text-center">'.$special_menu.'</td>

							<td class="text-center">'.$category_status .'</td>
							
							<td class="last text-center">

								<button class="btn btn-dark btn-xs edit_category" 
								
								value="'.$category->category_id.'" 
								
								data-catName="'.$category->category_name.'" 
								
								data-catOrder="'.$category->category_order.'"
								
								data-specialMenu="'.$category->special_menu.'" 
								
								data-status="'.$category->category_status.'">                                                     
									<i class="far fa-edit"></i> Edit
									
								</button>

								<!--<a href="URL::to(\'/delete-category/\'.$category->category_id)" class="btn btn-danger btn-xs" onclick="return checkDelete()"> <i class="glyphicon glyphicon-remove"></i> Delete</a>-->
								
							</td>';
        }
        
        if ($ren_data == "") {

            echo "<td colspan='5'><br><h5 class='text-center'> Nothing Found.</h5><br></td>";

        } else {

            echo $ren_data;

        }
        
    }

    public function get_categories()
    {
      $categories = DB::table('category')->get();
      //return $categories;
      foreach ($categories as $row) {
        echo "<option value='".$row->category_id."'>".$row->category_name."</option>";
    }
    }
	
	public function saveCategory(Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['category_name'] = $c_name = $request->category_name;
        $data['category_order'] = $request->category_order;
        $data['parent_cat'] = $request->select_cat;
        $data['special_menu'] = $request->special_menu;
        $data['category_status'] = $request->category_status;
        
        $data['category_created_date'] = date('Y-m-d');
        $data['category_created_time'] = date('H:i:s');
        $data['category_created_by'] = Auth::user()->id;
		
		$exist_pro = DB::table('category')->where('category_name',$c_name)->get();
        
        if(count($exist_pro) > 0){
        
            Session::put('message','Category already exists!');
    		
    		return Redirect::to('/category-list');
		
        }else{
        
			DB::table('category')->insert($data);

			Session::put('message','Category information saved succesfully!');
			
			return Redirect::to('/category-list');
		}
    } 

    public function categoryList() {

        $all_category = DB::table('category as c')
                        ->select('c.category_id','c.category_name','c.parent_cat','c.category_order','c.special_menu','c.category_status','pc.category_name as pname')
                        ->leftJoin('category as pc','c.parent_cat','=','pc.category_id')
                        ->orderBy('category_name','ASC')->paginate(10);

        $category_list = view('admin.pages.category_list')->with('all_category_info',$all_category);
        
        return view('admin_master')->with('admin_main_content',$category_list);
    }

    /*public function deleteCategory($category_id) {

        $this->authCheck();

        DB::table('category')->where('category_id',$category_id)->delete();

        return Redirect::to('/category-list');
    }*/
    
    public function updateCategory(Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $category_id = $request->category_id;

        $data['category_name'] = $c_name = $request->category_name;
        $data['category_order'] = $request->category_order;
        $data['special_menu'] = $request->special_menu;
        $data['category_status'] = $request->category_status;
        $data['category_updated_date'] = date('Y-m-d');
        $data['category_updated_time'] = date('H:i:s');
        $data['category_updated_by'] = Auth::user()->id;
		
		$exist_pro = DB::table('category')->where('category_id','!=',$category_id)->where('category_name',$c_name)->get();
		
		if(count($exist_pro) > 0){
        
            Session::put('message','Category already exists!');
    		
    		return Redirect::to('/category-list');
		
        }else{
        
			DB::table('category')->where('category_id',$category_id)->update($data);

			Session::put('message','Category information updated succesfully!');

			return Redirect::to('/category-list');
		}
    }
	
	
	
// Type

    public function saveType(Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['type_name'] = $request->type_name;
        
        $data['type_created_date'] = date('Y-m-d');
        $data['type_created_time'] = date('H:i:s');
        $data['type_created_by'] = Auth::user()->id;
        
        DB::table('product_type')->insert($data);

        Session::put('message','Saved Succesfully !');
        
        return Redirect::to('/type-list');
    }

    public function typeList() {

        $product_type = DB::table('product_type')
						->join('admin','product_type.type_created_by','=','admin.id', 'left')
						->orderBy('type_name','ASC')
						->get();

        $type_list = view('admin.pages.type_list')->with('product_type',$product_type);
        
        return view('admin_master')->with('admin_main_content',$type_list);
    }

    
    public function updateType(Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $type_id = $request->type_id;

        $data['type_name'] = $request->type_name;
        
        DB::table('product_type')->where('type_id',$type_id)->update($data);

        Session::put('message','Updated Succesfully !');

        return Redirect::to('/type-list');
    }
	
	
	public function addProduct() {
        $published_category = DB::table('category')->where('parent_cat','0')->orderBy('category_name', 'ASC')->get();
        $published_sub_category = DB::table('category')->where('parent_cat','>','0')->orderBy('category_name', 'ASC')->get();
        $type = DB::table('product_type')->orderBy('type_name','ASC')->get();
        $add_product = view('admin.pages.add_product')->with('published_category',$published_category)->with('type',$type)->with('published_sub_category',$published_sub_category);
        return view('admin_master')->with('admin_main_content',$add_product);
    }
    
    public function saveProduct(Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();
        $data['product_type'] = $request->product_type;
        $data['fk_category_id'] = $request->fk_category_id_sub?$request->fk_category_id_sub:$request->fk_category_id;
        $data['product_name'] = $p_name = $request->product_name;
        // $data['product_purchase_price'] = $request->product_purchase_price;
        $data['product_sell_price'] = $request->product_sell_price;
        $data['product_status'] = $request->product_status;
        
        $data['out_of_stock_range'] = $request->out_of_stock_range;
        
        $data['product_created_date'] = date('Y-m-d');
        $data['product_created_time'] = date('H:i:s');
        $data['product_created_by'] = Auth::user()->id;
        
        
        $exist_pro = DB::table('product')->where('product_name',$p_name)->get();
        
        if(count($exist_pro) > 0){
        
            Session::put('message','Product exists!');
    		
    		return Redirect::to('/add-product');
		
        }else{
            
            /* image upload */
            $files = $request->file('product_image');
    		
    		if($files){

                $this->validate($request, [

                    'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
    			
    			$filename = $files->getClientOriginalName();
    			$picture = date('His').$filename;
    			$image_url = 'public/product_image/'.$picture;
    			$destinationPath = base_path().'/public/product_image';
    			$success = $files->move($destinationPath,$picture);
    			if($success) {
    				$data['product_image'] = $image_url;
    			}
    		}
    
    		$product_id = DB::table('product')->insert($data);
     
    		Session::put('message','Save product successfully!');
    		
    		return Redirect::to('/add-product');
    		
        }
		
		
    }

    // Save Productr Modal
    public function saveProduct2(Request $request) {
        
        date_default_timezone_set("Asia/Dhaka");

        $data = array();
        $data['fk_category_id'] = $request->fk_category_id_sub?$request->fk_category_id_sub:$request->fk_category_id;
        $data['product_type'] = $request->product_type;
        $data['product_name'] = $p_name = $request->product_name;
        // $data['product_purchase_price'] = $request->product_purchase_price;
        $data['product_sell_price'] = $request->product_sell_price;
        $data['product_status'] = $request->product_status;
        
        $data['out_of_stock_range'] = $request->out_of_stock_range;
        
        $data['product_created_date'] = date('Y-m-d');
        $data['product_created_time'] = date('H:i:s');
        $data['product_created_by'] = Auth::user()->id;
        
        $exist_pro = DB::table('product')->where('product_name',$p_name)->get();
        
        if(count($exist_pro) > 0){
        
            Session::put('message','Product exists!');
    		
    		return Redirect::to('/product-list');
		
        }else{
        
            /* image upload */
            $files = $request->file('product_image');
    		
    		if($files){

                $this->validate($request, [

                    'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
    			
                $filename = $files->getClientOriginalName();
                
                $picture = date('His').$filename;
                
                $image_url = 'public/product_image/'.$picture;
                
                $destinationPath = base_path().'/public/product_image';
                
    			$success = $files->move($destinationPath,$picture);
    
    			if($success) {
    				
    				$data['product_image'] = $image_url;
    
    			}		
    
    		}
    		
    
    		$product_id = DB::table('product')->insert($data);
     
    		Session::put('message','Save product successfully!'); 
    		
    		return Redirect::to('/product-list');
        }
        
    }

    public function updateProduct(Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $product_id = $request->product_id;

        $old_image = $request->old_image;

        $data = array();
        $data['fk_category_id'] = $request->fk_category_id_sub?$request->fk_category_id_sub:$request->fk_category_id;
        $data['product_type'] = $request->product_type;
        $data['product_name'] = $p_name = $request->product_name;
        // $data['product_purchase_price'] = $request->product_purchase_price;
        $data['product_sell_price'] = $request->product_sell_price;
        $data['product_status'] = $request->product_status;
        
        $data['out_of_stock_range'] = $request->out_of_stock_range;
      
        $data['product_updated_date'] = date('Y-m-d');
        $data['product_updated_time'] = date('H:i:s');
        $data['product_updated_by'] = Auth::user()->id;
        
        $exist_pro = DB::table('product')->where('product_id','!=',$product_id)->where('product_name',$p_name)->get();
        
        if(count($exist_pro) > 0){
        
            Session::put('message','Product exists!');
    		
    		return Redirect::to('/product-list');
		
        }else{
        
            /* image upload */
            
            if($_FILES['product_image']['name'] != '') {

                $this->validate($request, [

                    'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
    
                
                $files = $request->file('product_image');

                $filename = $files->getClientOriginalName();

                $picture = date('His').$filename;

                $image_url = 'public/product_image/'.$picture;

                $destinationPath = base_path().'/public/product_image';

                $success = $files->move($destinationPath,$picture);
    
                if ($success) {
    
                    $data['product_image'] = $image_url;
    
                    DB::table('product')->where('product_id',$product_id)->update($data);
    
                    Session::put('message','Update product successfully!');
    
                    return Redirect::to('/product-list');
                    
                } else {
    
                    $error = $files->getErrorMessage();
                }
            } else {
    
               
                DB::table('product')->where('product_id',$product_id)->update($data);
    
                Session::put('message','Update product successfully!');
    
                // return Redirect::to('/edit-product/'.$product_id);
    
                return Redirect::to('/product-list');
    
            }
        
        }
    }

    public function viewProduct (Request $request) 
    {

        $rt = $request->product_id;
		
		$products = DB::table('product as pro')
                    ->leftJoin('admin as admin_created', 'pro.product_created_by', '=', 'admin_created.id')
                    ->leftJoin('admin as admin_updated', 'pro.product_updated_by', '=', 'admin_updated.id')
                    ->leftJoin('category as cat_id', 'pro.fk_category_id', '=', 'cat_id.category_id')
                    ->leftJoin('product_type as p_type', 'pro.product_type', '=', 'p_type.type_id')
                    ->select(
                        'cat_id.category_name as catname',
                        'p_type.type_name as tname',
                        'pro.product_name as pname',
                        'pro.out_of_stock_range as out_of_stock_range',
                        'pro.product_image as pimage',
                        'pro.product_sell_price as pSellPrice',
                        'pro.product_created_date as pcreated_date',
                        'pro.product_created_time as pcreated_time',
                        'pro.product_updated_date as pupdated_date',
                        'pro.product_updated_time as pupdated_time',
                        'admin_created.name as created_admin_name',
                        'admin_updated.name as updated_admin_name'
                    )
                    ->where('product_id', $rt)
                    ->first();

        $ren_data = '';

        $ren_data .= '

            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Name</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->pname.'</td>
            </tr>
            
            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Image</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;"" ><img src="'.asset($products->pimage).'" width="80" height="50"></td>
            </tr>
			<tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Category</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->catname.'</td>
            </tr>
			<tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Type</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->tname.'</td>
            </tr>
            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Sell Price</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->pSellPrice.'</td>
            </tr>
            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Out of Stock Range</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->out_of_stock_range.'</td>
            </tr>

            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Created By</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->created_admin_name.'</td>
            </tr>
            
            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Created Date</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->pcreated_date.'</td>
            </tr>

            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Created Time</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->pcreated_time.'</td>
            </tr>

            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Update By</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->updated_admin_name.'</td>
            </tr>

            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Update Date</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->pupdated_date.'</td>
            </tr>

            <tr class="even pointer">
                <th style="padding: 10px 0 10px 10px;border-bottom: 1px solid #dddddd;">Update Time</th>
                <td style="padding: 10px 0 10px;border-bottom: 1px solid #dddddd;">'.$products->pupdated_time.'</td>
            </tr>

        ';
        echo $ren_data;
        
    }

    public function productList() 
    {
        $categorys = DB::table('category')->orderBy('category_name', 'ASC')->get();
        $published_category = DB::table('category')->where('parent_cat','0')->orderBy('category_name', 'ASC')->get();
        $published_sub_category = DB::table('category')->where('parent_cat','>','0')->orderBy('category_name', 'ASC')->get();
        
        $all_product = DB::table('product')
                        ->join('category', 'product.fk_category_id', '=', 'category.category_id', 'left')
                        ->join('product_type', 'product.product_type', '=', 'product_type.type_id', 'left')
                        ->orderByRaw('product_id DESC')
                        ->paginate(10);
       
        $product_list = view('admin.pages.product_list')->with('categorys',$categorys)->with('all_product_info',$all_product)->with('published_category',$published_category)->with('published_sub_category',$published_sub_category);
        
        return view('admin_master')->with('admin_main_content',$product_list);
    }
    
    
    public function deleteProduct($product_id) 
    {

        DB::table('product')->where('product_id',$product_id)->delete();
        
       
        DB::table('stock')->where('product_id',$product_id)->delete();
        
        return Redirect::to('/product-list');
    }
    
   
    public function searchProductList (Request $request) 
    {
        
        $search_val = $request->search_product;
        $fk_category_id = $request->fk_category_id;
        $product_type = $request->product_type;

        if ($fk_category_id == 0 && $product_type > 0) {

            $products = DB::table('product')
                        ->join('admin','product.product_created_by','=','admin.id', 'left')
                        ->join('product_type','product.product_type','=','product_type.type_id', 'left')
                        ->join('category', 'product.fk_category_id', '=', 'category.category_id', 'left')                        
                        ->where('product_type', $product_type)
                        ->where('product_name', 'like', '%'.$search_val.'%')
                        ->orWhere('product_id',$search_val)
                        ->orderBy('product_id', 'DESC')
                        ->get();

        } else if ($product_type == 0 && $fk_category_id > 0) {

            $products = DB::table('product')
                        ->join('admin','product.product_created_by','=','admin.id', 'left')
                        ->join('product_type','product.product_type','=','product_type.type_id', 'left')
                        ->join('category', 'product.fk_category_id', '=', 'category.category_id', 'left')
                        ->where('fk_category_id', $fk_category_id)
                        ->where('product_name', 'like', '%'.$search_val.'%')
                        ->orWhere('product_id',$search_val)
                        ->orderBy('product_id', 'DESC')
                        ->get();

        }else if ($product_type == 0 && $fk_category_id == 0){

            $products = DB::table('product')
                        ->join('admin','product.product_created_by','=','admin.id', 'left')
                        ->join('product_type','product.product_type','=','product_type.type_id', 'left')
                        ->join('category', 'product.fk_category_id', '=', 'category.category_id', 'left')
                        ->where('product_name', 'like', '%'.$search_val.'%')
                        ->orWhere('product_id',$search_val)
                        ->orderBy('product_id', 'DESC')
                        ->get();
        }else {

            $products = DB::table('product')
                        ->join('admin','product.product_created_by','=','admin.id', 'left')
                        ->join('product_type','product.product_type','=','product_type.type_id', 'left')
                        ->join('category', 'product.fk_category_id', '=', 'category.category_id', 'left')
                        ->where('fk_category_id', $fk_category_id)                        
                        ->where('product_type', $product_type)
                        ->where('product_name', 'like', '%'.$search_val.'%')
                        ->orWhere('product_id',$search_val)
                        ->orderBy('product_id', 'DESC')
                        ->get();
        }

        

        $ren_data = '';

        // $or_total = 0;

        foreach($products as $products) {

            if ($products->product_status==1) {

                $res = "<span class='label label-success'>Active</span>";

            } else {

                $res = "<span class='label label-warning'>Inactive</span>";

            }

            $ren_data .= '<tr class="even pointer">
                                <td class="text-center">'.$products->product_id.'</td>
                                <td class="text-center">'.$products->product_name.'</td>
                                <td class="text-center"><img src="'.asset($products->product_image).'" width="80" height="50"></td>
                                <td class="text-center">'.$products->category_name.'</td>
                                <td class="text-center">'.$products->type_name.'</td>
                                <td class="text-center">'.$products->product_sell_price.'</td>
                                <td class="text-center hide_print_sec">'.$res.'</td>
                                <td class="text-center hide_print_sec">
                                    <button
                                        class="btn btn-dark btn-xs edit_product"

                                        value="'.$products->product_id.'"
                                        productName="'.$products->product_name.'"
                                        productSellPrice="'.$products->product_sell_price.'"
                                        productCategory="'.$products->fk_category_id.'"
                                        productCategoryName="'.$products->category_name.'"
                                        productImage="'.asset($products->product_image).'"
                                        oldImage="'.$products->product_image.'"
                                        productStatus="'.$products->product_status.'"
                                        out_of_stock_range="'.$products->out_of_stock_range.'"
                                        ><i class="far fa-edit"></i> Edit
                                    </button>

                                    <button 
                                        class="btn btn-info btn-xs view_product"
                                        value="'.$products->product_id.'" >

                                        <i class="far fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>';
            // $or_total += $products->order_total;
        }
        
        if ($ren_data == "") {

            echo "<td colspan='8'><br><h5 class='text-center'> Nothing Found.</h5><br></td>";

        } else {

            echo $ren_data;

        }
        
    }
       
    
}
