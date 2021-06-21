<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserSettingsController extends Controller
{
	
	protected $url;

    public function __construct(UrlGenerator $url) {

        $this->middleware('auth');
		
        $this->url = $url;

        $admin_data = Auth::user();

        if(! isset(Auth::user()->id)) {
            header("Location: ".$this->url->to('/'));
			exit();
        }
		
    }
	
	public static function featuresCheck($features){
		
		$admin_role = Auth::user()->admin_role;

		$all_roles = DB::table('admin_role')->where('role_id', 1)->first();
		
		$roles[1] = $all_roles->admin_role_features;
		$roles[2] = $all_roles->manager_role_features;
		$roles[3] = $all_roles->salesman_role_features;
		
		$get_features = explode(",",$roles[$admin_role]);
		
		if(in_array($features,$get_features)){
			
			return true;
			
		}else {
			
			return false;
			
		}
		
	}
	
	
    public function userSettings() {
        
        $settings_id = 1;

        $settings_by_id = DB::table('settings')->where('settings_id',$settings_id)->first();
        
        $edit_settings_page = view('admin.pages.user_settings')->with('settings_by_id',$settings_by_id);
        
        return view('admin_master')->with('admin_main_content',$edit_settings_page);

        
    }


    public function updateUserSettings (Request $request) {

        date_default_timezone_set("Asia/Dhaka");

        $admin_id = $request->admin_id;

        $old_image = $request->old_image;

        $email = $request->admin_email;

        $old_email = $request->old_email;
        
        $password = $request->admin_password;
		
        $old_password = $request->old_password;
		
        $retype_password = $request->retype_password;
		
		$con = 0;

        $data = array();

        $data['name'] = $request->admin_name;

        if($old_email != '' && $email != ''){
			
			
            $query_result = DB::table('admin')->where('email',$old_email)->get();
            
            $result_info = $query_result->first();
			
			
			if($result_info != ''){
				
				$data['email'] = $request->admin_email;
				
				$con = 1;
				
			}else {
				
				$con = 2;
				
			}
			
		}		
		
		
		if($old_password != '' && $password != '' && $retype_password != ''){
			
			if($password === $retype_password) {
				
				$query_result =  DB::table('admin')->where('id',$admin_id)->where('password', Hash::check('',$old_password))->get();
				
				$result_info = $query_result->first();
				
				if($result_info != ''){
					
					$data['password'] = Hash::make($request->admin_password);
					
					$con = 1;
					
				}else {
					
					$con = 2;
					
				}
				
			}else {
				
				$con = 2;
				
			}
			
			
		}
		
		
		if($con == 0 || $con == 1){

            if($_FILES['admin_image']['name'] != '') {

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
    
                    DB::table('admin')->where('id',$admin_id)->update($data);
    
                    Session::put('message','Admin Information Updated Successfully! Please Re-login to See The Changes');
                    
                    return Redirect::to('/user-settings');
    
                } else {
                
                    $error = $files->getErrorMessage();
                }
    
            } else {
    
                DB::table('admin')->where('id', $admin_id)->update($data);
    
                Session::put('message','Admin Information Updated Successfully! Please Re-login to See The Changes');
                
                return Redirect::to('/user-settings');
    
            }
			// return '1';

        } else {

            $data['admin_updated_by'] = Auth::user()->id;
            $data['admin_updated_date'] = date('Y-m-d');
            $data['admin_updated_time'] = date('H:i:s');
            

            DB::table('admin')->where('id',$admin_id)->update($data);

            Session::put('message','Admin Information Updated Successfully! Please Re-login to See The Changes');
            
            return Redirect::to('/user-settings');

        }
        
    }


    
    
}
