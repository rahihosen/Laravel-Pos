<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->middleware('auth');

        $this->url = $url;

        $admin_data = Auth::user();

        if(! isset(Auth::user()->id)) {
            header("Location: ".$this->url ->to('/'));
            exit();
        }
    }
    
     
    // Admin list  
    public function adminList() 
    {

        $this->authCheck();

        if ($this->roleCheck(1)) {

            $all_admin = DB::table('admin')
                        ->where('id', '!=', 1)
                        ->orderBy('id','DESC')
                        ->paginate(10);

            $admin_list = view('admin.pages.admin_list')->with('all_admin_info',$all_admin);
            
            return view('admin_master')->with('admin_main_content',$admin_list);

        } else {
           
            return Redirect::to('/home?error=1');
        }
    }

    // Create new admin or user 
	
    public function saveAdmin(Request $request) 
    {
        
        $this->authCheck();

        if($this->roleCheck(1)){

            date_default_timezone_set("Asia/Dhaka");

            $data = array();

            $data['name'] = $request->admin_name;

            $data['email'] = $request->admin_email;

            $data['password'] = Hash::make($request->admin_password);

            $data['admin_role'] = $request->admin_role;

            $data['admin_status'] = $request->admin_status;
        
            /* image upload */

            $this->validate($request, [

                'admin_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $files = $request->file('admin_image');

            $filename = $files->getClientOriginalName();

            $picture = date('His').$filename;

            $image_url = 'public/admin_image/'.$picture;

            $destinationPath = base_path().'/public/admin_image';

            $success = $files->move($destinationPath,$picture);

            if($success) {

                $data['admin_image']=$image_url;

            } else { 

                $error=$files->getErrorMessage();

            }
        
            $data['admin_created_date'] = date('Y-m-d');

            $data['admin_created_time'] = date('H:i:s');

            $data['admin_created_by'] = Auth::user()->id;
            
            $admin_email = $data['email'] = $request->admin_email;

            $existing_admin_check = DB::table('admin')
                                    ->where('email',$admin_email)
                                    ->exists();
                            
            if ($existing_admin_check != 0) {

                Session::put('message','Email already registered!');

                return Redirect::to('/admin-list');

            } else {

                DB::table('admin')->insert($data);

                Session::put('message','User Saved Successfully!');
            
                return Redirect::to('/admin-list');
            }
        } else {
            
            return Redirect::to('/home?error=1');
        }
      
    }

    public function updateAdmin (Request $request) 
    {

        $this->authCheck();

        if ($this->roleCheck(1)) {

            date_default_timezone_set("Asia/Dhaka");

            $pass = $request->admin_password;

            $admin_id = $request->admin_id;

            $old_image = $request->old_image;

            $data = array();

            $data['name'] = $request->admin_name;

            $data['email'] = $request->admin_email;

            if ( $pass !='') {

                $data['password'] = Hash::make($request->admin_password);
            }

            $data['admin_role'] = $request->admin_role;

            $data['admin_status'] = $request->admin_status;

            $data['admin_updated_by'] = Auth::user()->id;
            $data['admin_updated_date'] = date('Y-m-d');
            $data['admin_updated_time'] = date('H:i:s');
            
            /* image upload */
        
            if ($_FILES['admin_image']['name'] !== '') {

                $this->validate($request, [

                    'admin_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $files = $request->file('admin_image');

                $filename = $files->getClientOriginalName();

                $picture = date('His').$filename;

                $image_url = 'public/admin_image/'.$picture;

                $destinationPath = base_path().'/public/admin_image';

                $success = $files->move($destinationPath,$picture);

                if($success) {

                    $data['admin_image'] = $image_url;

                    DB::table('admin')->where('id', $admin_id)->update($data);

                    Session::put('message','User Information Updated Successfully!');
                    
                    return Redirect::to('/admin-list');

                } else {
                
                    $error = $files->getErrorMessage();
                }

            } else {

                DB::table('admin')->where('id',$admin_id)->update($data);

                Session::put('message','User Information Updated Successfully!');
                
                return Redirect::to('/admin-list');
       
            }
        
            
        
        } else{
           
            return Redirect::to('/home?error=1');
        }
        
          
    }
    
    public function authCheck() 
    {

        $admin_id = Auth::user()->id;

        if ($admin_id) {
            return;
        } 
        else {
            return Redirect::to('/')->send();
        }
    }
    
    public function roleCheck($fea) 
    {
        
        $admin_role = Auth::user()->admin_role;
        
        $admin_features = DB::table('admin_role')->first();
        
        $roles[1] = $admin_features->admin_role_features;
        $roles[2] = $admin_features->manager_role_features;
        $roles[3] = $admin_features->salesman_role_features;
        
        $get_features = explode(",",$roles[$admin_role]);
        
        if(in_array($fea,$get_features)) {
            return true;
        } else {
            return false;
        }
    } 
    
}
