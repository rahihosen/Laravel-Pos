<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
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
		
        $features = 2;
		
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
	
    public function editSettings() 
    {

		$settings_id = 1;

		$settings_by_id = DB::table('settings')->where('settings_id',$settings_id)->first();
		
		$edit_settings_page=view('admin.pages.edit_settings')->with('settings_by_id',$settings_by_id);
		
		return view('admin_master')->with('admin_main_content',$edit_settings_page);

    }
    
    
    
    public function updateSettings (Request $request) 
    {

		$data = array();
		
		$data['company_name']    = $request->company_name;
		$data['company_mobile']  = $request->company_mobile;
		$data['company_email']   = $request->company_email;
		$data['company_address'] = $request->company_address;
	
		//$data['product_updated_date']=\Carbon\Carbon::now()->toDateTimeString();
		//$data['product_updated_time']=date('H:i:s');
		//$data['product_updated_by']=Session::get('admin_name');
		
        $settings_id = $request->settings_id;
        
        
	
		/* image upload */
		if($_FILES['company_logo']['name']=='') {

			$data['company_logo']=$request->old_logo; 
			
			DB::table('settings')->where('settings_id',$settings_id)->update($data);
			
			Session::put('message','Update settings successfully!');

			return Redirect::to('/edit-settings');
			
		} else {

            $this->validate($request, [

                'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $files = $request->file('company_logo');
            
            $filename = $files->getClientOriginalName();
            
            $picture = date('His').$filename;
            
            $image_url = 'public/settings_image/'.$picture;
            
            $destinationPath = base_path().'/public/settings_image';
            
			$success = $files->move($destinationPath,$picture);

			if ($success) {

				$data['company_logo'] = $image_url;

				DB::table('settings')->where('settings_id',$settings_id)->update($data);

                Session::put('message','Update settings successfully!');
                
				return Redirect::to('/edit-settings');

			} else {

				$error = $files->getErrorMessage();
			}
	
        }
		
    }
    
    
    public function editRole() 
    {
        
		$settings_by_id = DB::table('settings')->first();
		
		$edit_settings_page = view('admin.pages.edit_role')->with('settings_by_id',$settings_by_id);
		
		return view('admin_master')->with('admin_main_content',$edit_settings_page);

	
    }

    
    public function updateRole(Request $request) 
    {

		$data = array();
	
		//  $aa=$request->admin_role_features;
		
		$bb = $request->manager_role_features;
		$cc = $request->salesman_role_features;
		
		if($bb != ''){
			$data['manager_role_features']=implode(",",$bb);
		}else{
			$data['manager_role_features']='';
		}
		
		if($cc != ''){
			$data['salesman_role_features']=implode(",",$cc);
		}else{
			$data['salesman_role_features']='';
        }
        
	   
		DB::table('admin_role')->where('role_id',1)->update($data);

		Session::put('message','Updated successfully!');

		return Redirect::to('/edit-role');
        
    }
	
	
	public function index() {

        $tables = Table::all();

        return view('admin.pages.table' , compact('tables'));
    }

    public function store (Request $request) 
    {
    
        $request->validate([
            'table_name' => 'required'
        ]);

        // Save data into database,
        Table::create([
            'table_name' => $request->table_name
        ]);

        // Session Message
        Session::put('message','Your Table has been added succesfully!');

        return redirect('/table');      
    }

    public function tableEdit(Request $request) {

        
        $id = $request->table_id;

        $data['table_name'] = $request->table_name;
       
        DB::table('tables')->where('table_id',$id)->update($data);
        
        Session::put('message','Table Update succesfully!');

        return redirect('/table');

    }   

    public function tableDelete( $table_id ) {
        
        DB::table('tables')->where('table_id',$table_id )->delete();

        return redirect('/table');
    }
	
	public function vatList () {

        $all_vat = DB::table('vat')
                    ->join('admin', 'vat.vat_created_by', '=', 'admin.id', 'left')
                    ->orderBy('vat_id', 'DESC')
                    ->paginate(10);

        $vat_list = view('admin.pages.vat_list')->with('vat_info',$all_vat);
        
        return view('admin_master')->with('all_vat',$vat_list);
    }

    public function vatCreate ( Request $request ) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['vat_name'] = $request->vat_name;
        $data['vat_amount'] = $request->vat_amount;
        $data['vat_status'] = $request->vat_status;
        
        $data['vat_created_date'] = date('Y-m-d');
        $data['vat_created_time'] = date('H:i:s');
        $data['vat_created_by'] = Auth::user()->id;
        
        DB::table('vat')->insert($data);

        Session::put('message','Vat Information saved succesfully!');
        
        return Redirect::to('/vat-list');
    }

    public function vatUpdate ( Request $request ) 
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $vat_id = $request->vat_id;

        $data['vat_name'] = $request->vat_name;
        $data['vat_amount'] = $request->vat_amount;
        $data['vat_status'] = $request->vat_status;
        $data['vat_updated_date'] = date('Y-m-d');
        $data['vat_updated_time'] = date('H:i:s');
        $data['vat_updated_by'] = Auth::user()->id;
        
        DB::table('vat')->where('vat_id',$vat_id)->update($data);

        Session::put('message','Vat Information updated Succesfully!');

        return Redirect::to('/vat-list');
    }
    
    
    
     public function adminDelete( $id ) {
        
        DB::table('admin')->where('id',$id )->delete();

        return redirect('/admin-list');
    }
    
    
    
    
    
    
    
	
	
	
	
    
}
