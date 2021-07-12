<?php

 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\File;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// private function generateRandomString($length,$id) {
//     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length/2 - 2; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     for ($i = 0; $i < 4; $i++) {
//         $randomString .= $characters[rand(26, $charactersLength - 1)];
//     }
//     $randomString .= $id . 'Z';
//     $lenid = strlen($id);
//     for ($i = 0; $i < $length/2 - 2 - $lenid; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }
//Đăng nhập
Route::post('/Login', function(Request $req) {
	if($req->ApiKey == 'DENTALMEDICAL' && $req->login != '' && $req->password != ''){
 	    $user = DB::table('users')->where('email',$req->login)->first();
	    $check = Hash::check($req->password, $user->password);
	    if($check){	    	
	    	
	    	$toEncode["result"] = "ok";
        	$toEncode["id"] = $user->id;
        	$toEncode["email"] = $user->email;
        	
			return response($toEncode,200);
			
	    }else{
			$toEncode["Error"] = "Username or password is incorrected!";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}		
});

// Route::post('/Getlistimg', function(Request $req) {
// 	if($req->ApiKey == 'DENTALMEDICAL' && $req->login != '' && $req->password != ''){
//  	    $user = DB::table('users')->where('email',$req->login)->first();
// 	    $check = Hash::check($req->password, $user->password);
// 	    if($check){	    
	    	

// 	    	$list = DB::table('rooms')->leftJoin('tours','tours.to_id','=','rooms.ro_to_id')
// 	    				->where('ro_to_id',4)->get();
// 	    	foreach ($list as $key => $value) {
// 	    		$path = $user->idcode . '/' . $value->to_code . '/' . $value->ro_code . '.jpg';
//             	$value->img_path = \Storage::disk('s3')->url($path);
// 	    	}
// 	    	$toEncode["result"] = "ok";
// 	    	$toEncode['list'] = $list;
// 	    	return response($toEncode,200);
// 	    }else{
// 			$toEncode["Error"] = "Username or password is incorrected!";			
// 			$toEncode["result"] = "fail";
// 			return response($toEncode,401);
// 		}
// 	}else{
// 		$toEncode["Error"] = "Wrong credentials!";		
// 		$toEncode["result"] = "fail";
// 		return response($toEncode,400);	
// 	}		
// });
//Đăng kí user

Route::post('/Registration',function(Request $req){
		if($req->ApiKey == 'DENTALMEDICAL' && $req->email !=''  && $req->password != ''){
 	   $check = DB::table('users')->where('email',$req->email)->first();
	    
	    if(empty($check)){
	    	require 'PHPMailer/PHPMailerAutoload.php';	
		 	$mail = new PHPMailer;
		 	$mail->isSMTP();
		 	$mail->SMTPSecure = 'tls';
		 	$mail->SMTPAuth = true;
		 	$mail->SMTPOptions = array(
    			'ssl' => array(
        			'verify_peer' => false,
        			'verify_peer_name' => false,
        			'allow_self_signed' => true
        		)
    		);
    		$mail->CharSet = 'UTF-8';
    		$mail->Host = 'smtp.gmail.com';
    		$mail->Port = 587;
    		$mail->Username = 'shikatora1999@gmail.com';
    		$mail->Password = 'longgmail1999';
    		$mail->isHTML(true);
    		$mail->setFrom('system@gmail.com', 'Thư từ Server');
    		$mail->addAddress($req->email, 'User');
    		$mail->Subject = 'Thông báo kích hoạt thành công tài khoản';

    		$mail->Body = 'Tài khoản của bạn đã được kích hoạt thành công';
    		if(!$mail->send()) {
    			$toEncode["result"] = "Message could not be sent.";
        		$toEncode["error"] = 'Mailer Error: ' . $mail->ErrorInfo;
				return response($toEncode,200);
			}else{
				// save csdl
		    	 $ps=Hash::make($req->input('password'));
		    	 $user= new App\Models\User;
	        	 $user->email=$req->input('email');
	       		 $user->password=$ps;
	       		 $user->permissions=$req->input('permissions');
	       		 $user->country=$req->input('country');
	       		 $user->city=$req->input('city');
	       		 $user->address=$req->input('address');
	       		 $user->first_name=$req->input('first_name');
	       		 $user->last_name=$req->input('last_name');

	       		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$user->code = substr(str_shuffle($permitted_chars), 0, 20);
	       		 $user->save();
	       		 // create foder code
	       		 $user=DB::table('users')->where('email',$req->email)->first();
	       		
	       		 $path = public_path().'/uploads/medical/' . $user->code;
	       		 File::makeDirectory( $path,0777,true);
        	
	        	$toEncode["result"] = "ok";
	        	$toEncode["id"] = $user->id;
	        	$toEncode["email"] = $user->email;
	        	$toEncode["permissions"] = $user->permissions;
		    	$toEncode["first_name"] = $user->first_name;
		    	$toEncode["last_name"] = $user->last_name;
		    	$toEncode["country"] = $user->country;
		    	$toEncode["city"] = $user->city;
		    	$toEncode["address"] = $user->address;
				return response($toEncode,200);
			}
	    	
	    }else{
			$toEncode["Error"] = "Email already exists!";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}
});

//show user
Route::post('/Showuser', function(Request $req) {
	if($req->ApiKey == 'DENTALMEDICAL' && $req->id != '' ){
 	    $user = DB::table('users')->where('id',$req->id)->first();
	    
	    if(!empty($user)){	    	
	    	
	    	$toEncode["result"] = "Login ok";
        	$toEncode["id"] = $user->id;
        	$toEncode["email"] = $user->email;
        	$toEncode["permissions"] = $user->permissions;
	    	$toEncode["first_name"] = $user->first_name;
	    	$toEncode["last_name"] = $user->last_name;
	    	$toEncode["country"] = $user->country;
	    	$toEncode["city"] = $user->city;
	    	$toEncode["address"] = $user->address;
			
			return response($toEncode,200);
			
	    }else{
			$toEncode["Error"] = "Id does not exist";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}		
});
//update user
Route::post('/Update-user', function(Request $req) {
	if($req->ApiKey == 'DENTALMEDICAL' && $req->id != '' ){
 	    $user = DB::table('users')->where('id',$req->id)->first();
	   
	    if(!empty($user)){	 
	    	  $user1=  App\Models\User::find($req->id); 	
	    	if($req->password !='' && $req->newpassword != '')
	    	{
	    		$check = Hash::check($req->password, $user->password);
	    		if($check)
	    		{
	    			$ps=Hash::make($req->newpassword);
	    			$user1->password=$ps;
	    			$user1->save();
	    		}
	    		else
	    		{
	    			 $toEncode["result-password"] = "Wrong password";
	    			 return response($toEncode,200);
	    		}
	    	}
       		 if($req->input('country')!='')
       		 {
       		 	$user1->country=$req->input('country');
       		 	$user1->save();
       		 }
       		if($req->input('city')!='')
       		{
       			$user1->city=$req->input('city');
       			$user1->save();
       		}
       		 if($req->input('address'))
       		 {
       		 	$user1->address=$req->input('address');
       		 	$user1->save();
       		 }
       		 if($req->input('first_name')!='')
       		 {
       		 	 $user1->first_name=$req->input('first_name');
       		 	 $user1->save();
       		 }
       		if($req->input('last_name')!='')
       		{
       			$user1->last_name=$req->input('last_name');
       		 	$user1->save();
       		}

       		 $user = DB::table('users')->where('id',$req->id)->first();
       		 $toEncode["result"] = "update ok";
        	$toEncode["id"] = $user->id;
        	$toEncode["email"] = $user->email;
        	$toEncode["permissions"] = $user->permissions;
	    	$toEncode["first_name"] = $user->first_name;
	    	$toEncode["last_name"] = $user->last_name;
	    	$toEncode["country"] = $user->country;
	    	$toEncode["city"] = $user->city;
	    	$toEncode["address"] = $user->address;

			
			return response($toEncode,200);
			
	    }else{
			$toEncode["Error"] = "Id does not exist";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}		
});
//quên mật khẩu 
Route::post('Forgot-password',function(Request $req){
	if($req->ApiKey == 'DENTALMEDICAL' && $req->email != ''){
		 $user = DB::table('users')->where('email',$req->email)->first();
		 if(!empty($user))
		 {
		 	require 'PHPMailer/PHPMailerAutoload.php';	
		 	$mail = new PHPMailer;
		 	$mail->isSMTP();
		 	$mail->SMTPSecure = 'tls';
		 	//$mail->SMTPSecure = 'ssl';
		 	//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		 	$mail->SMTPAuth = true;
		 	 $mail->SMTPDebug = 1;
		 	$mail->SMTPOptions = array(
    			'ssl' => array(
        			'verify_peer' => false,
        			'verify_peer_name' => false,
        			'allow_self_signed' => true
        		)
    		);
    		$mail->CharSet = 'UTF-8';
    		$mail->Host = 'smtp.gmail.com';
    		$mail->Port = 587;
    		$mail->Username = 'shikatora1999@gmail.com';
    		$mail->Password = 'longgmail1999';
    		$mail->isHTML(true);
    		$mail->setFrom('system@gmail.com', 'Thư từ Server');
    		$mail->addAddress($req->email, 'User');
    		$mail->Subject = 'Thông báo mã số bí mật để kích hoạt lại Email của bạn!';

    		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$user1=  App\Models\User::where('email',$req->email)->first(); 
    		$maso= substr(str_shuffle($permitted_chars), 0, 6);
    		$user1->maso = $maso;
    		$user1->save();
    		$str='
    		<h3>Thông báo mã số kích hoạt của bạn</h3>
			<table cellpadding=5 style="border: 1px solid black;">
			  <tr>
			    <th>Họ và tên</th>
			    <th>Email</th>
			    <th>Mã số</th>
			  </tr>
			  <tr>
			    <td>User</td>
			    <td>'.$user1->email.'</td>
			    <td>'.$user1->maso.'</td>
			  </tr>
			</table>
			';
    		$mail->Body = $str;
    		if(!$mail->send()) {
    			$toEncode["result"] = "Message could not be sent.";
        		$toEncode["error"] = 'Mailer Error: ' . $mail->ErrorInfo;
				return response($toEncode,200);
			} else {	
    			$toEncode["result"] = "Message has been sent";
    			return response($toEncode,200);
			}
		}
		else{
				$toEncode["Error"] = "id is incorrected!";			
				$toEncode["result"] = "fail";
				return response($toEncode,401);
			}
		}else{
			$toEncode["Error"] = "Wrong credentials!";		
			$toEncode["result"] = "fail";
			return response($toEncode,400);	
		}
			
});
//kích hoạt mật khẩu
Route::post('/Repassword', function(Request $req) {
	if($req->ApiKey == 'DENTALMEDICAL' && $req->email != '' && $req->maso!='' && $req->password !=''){
 	    $user = DB::table('users')->where('email',$req->email)->where('maso',$req->maso)->first();
	    
	    if(!empty($user)){
	    	$ps=Hash::make($req->input('password'));	    	
	    	$user=App\Models\User::where('email',$req->email)->first(); 
	    	$user->password=$ps;
	    	$user->maso=null;
	    	$user->save();

	    	$toEncode["result"] = "Update password successful";
			return response($toEncode,200);
			
	    }else{
			$toEncode["Error"] = "Wrong Ma so";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}		
});
//insert khám bệnh
Route::post('/Upload-khambenh',function(Request $req){
		if($req->ApiKey == 'DENTALMEDICAL' && $req->id != ''){
 	    $user = DB::table('users')->where('id',$req->id)->first();
	    
	    if(!empty($user)){	  
	    	$folder=$user->code;  			
	    		    	
	    	$image = $req->file('input_img');
	    	// img here
        	$imageName = time().'.'.$image->getClientOriginalExtension();
	    	$image->move(public_path('uploads/medical/'.$folder), $imageName);
	    	//$khambenh=App\Models\khambenh::where('kb_user',$user->id)->update(['kb_photo'=>$imageName]);
	    	//trả về nguyên ảnh
	    	//return response()->download(public_path('uploads/medical/'.$folder.'/'.$imageName));
	    	
	    	 $khambenh= new App\Models\khambenh;
        	 $khambenh->kb_predict=$req->input('kb_predict');
       		 $khambenh->kb_notes=$req->input('kb_notes');
       		 $khambenh->kb_user=$req->input('id');
       		 $khambenh->kb_datetime=now();
       		 $khambenh->kb_advice=$req->input('kb_advice');
       		 $khambenh->kb_times=(App\Models\khambenh::where('kb_user',$user->id)->count())+1;
       		 $khambenh->kb_photo=$imageName;
       		 $khambenh->save();
	    	//return url
	    	//$imageURL=url('uploads/medical/'.$folder.'/'.$imageName);
	    	//return response()->json(['url' => $imageURL,200]);

	    	$toEncode["result"] = "upload information successful";
        	//$toEncode["photo"] = $khambenh->kb_photo;
        	
			return response($toEncode,200);

	    }else{
			$toEncode["Error"] = "id is incorrected!";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}
});

//chose times khambenh
Route::post('/Choose-times',function(Request $req){
	if($req->ApiKey == 'DENTALMEDICAL' && $req->id != ''){
		$user = DB::table('users')->where('id',$req->id)->first();
		if(!empty($user)){
			$times=App\Models\khambenh::where('kb_user',$user->id)->count();
			$toEncode["result"]="ok";
			$toEncode["times"]=$times;
			return response($toEncode,200);
		}
		else{
			$toEncode["Error"] = "Id is incorrected!";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}
});

//show khám bệnh
Route::post('/Show-khambenh',function(Request $req){
		if($req->ApiKey == 'DENTALMEDICAL' && $req->id != '' && $req->times !=''){
 	    $user = DB::table('users')->where('id',$req->id)->first();
	    
	    if(!empty($user)){
	    	$khambenh=DB::table('khambenh')->where('kb_times',$req->times)->where('kb_user',$req->id)->first();	   	
	    	$toEncode["result"] = "ok";
	    	$toEncode["predict"] = $khambenh->kb_predict;
	    	$toEncode["notes"] = $khambenh->kb_notes;
	    	$toEncode["id_user"] = $khambenh->kb_user;
	    	$toEncode["times"] = $khambenh->kb_times;
	    	$toEncode["advice"] = $khambenh->kb_advice;
	    	$toEncode["photo"] = url('uploads/medical/'.$user->code.'/'.$khambenh->kb_photo);
			return response($toEncode,200);
	    }else{
			$toEncode["Error"] = "Id is incorrected!";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}
});

//update khám bệnh
Route::post('/Update-khambenh',function(Request $req){
		if($req->ApiKey == 'DENTALMEDICAL' && $req->id != '' && $req->times !=''){
 	    $user = DB::table('users')->where('id',$req->id)->first();
	    
	    if(!empty($user)){
	    	$khambenh=App\Models\khambenh::where('kb_times',$req->times)->where('kb_user',$req->id)->first();   	
	    	if($req->input('kb_predict')!='')
	    	{
	    		$khambenh->kb_predict=$req->input('kb_predict');
	    		$khambenh->save();
	    	}
	    	if($req->input('kb_notes')!='')
	    	{
	    		$khambenh->kb_notes=$req->input('kb_notes');
	    		$khambenh->save();
	    	}
	    	if($req->input('kb_advice')!='')
	    	{
	    		$khambenh->kb_advice=$req->input('kb_advice');
	    		$khambenh->save();
	    	}
	    	if(!empty($req->file('input_img')))
	    	{
	    		$folder=$user->code;
	    		//delete old img
	    		File::delete(public_path('uploads/medical/'.$folder.'/'.$khambenh->kb_photo));
	    		//save new img
	    		$image = $req->file('input_img');
	    		$imgName=time().'.'.$image->getClientOriginalExtension();
	    		$image->move(public_path('uploads/medical/'.$folder), $imgName);
	    		$khambenh->kb_photo=$imgName;
	    		$khambenh->save();
	    	}
	    	$toEncode["result"] = "Update ok";
			return response($toEncode,200);
	    }else{
			$toEncode["Error"] = "Id is incorrected!";			
			$toEncode["result"] = "fail";
			return response($toEncode,401);
		}
	}else{
		$toEncode["Error"] = "Wrong credentials!";		
		$toEncode["result"] = "fail";
		return response($toEncode,400);	
	}
});
