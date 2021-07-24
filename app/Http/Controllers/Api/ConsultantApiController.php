<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\profile;
use App\Models\speciality;
use App\Models\patient;
use App\Models\booking;
use Illuminate\Support\Facades\Auth;
use Validator;

class ConsultantApiController extends Controller
{
    public $successStatus = 200;

    public function register(Request $r)
    {

        try{
/*abdul new code for token*/
   $validator = Validator::make($r->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);
if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
  /* end abdul new code*/


            if(!empty($r->name) && !empty($r->email) && !empty($r->password) && !empty($r->confirmPassword) ){

            //below is the if condition for zero values for parameter


            if($r->password!==$r->confirmPassword){
                $res=0;
                $data=0;
                $msg='Confirm password not matched!';
                $statusCode=401;
            }else{

            $consultant=User::where('email',$r->email)->get();
            if(!$consultant->isEmpty()){
                $res=0;
                $data=0;
                $msg="Email already taken.";
                $statusCode=405;
            }else{
                $res=1;
                $data['email']=$r->email;
                $msg="Successfully Registered!";
                $statusCode=200;

                //send mail
                $otp = substr(mt_rand( 1000000000, 9999999999),0,4 );
                $details = [
                    'body' => 'Your Otp is: '.$otp.''
                ];
                sendMail($r->email,$details);
                //end send mail

                //adding a user profile
                $profile= new profile();
                $profile->speciality_id=1;
                $profile->save();

                $con= new User();
                  $con->name=$r->name;
                  $con->email=$r->email;
                  $con->password=Hash::make($r->password);
                  $con->otp=$otp;

                  /* abdul token*/
                  $data['token'] =  $con->createToken('MyApp')->accessToken;
                  /*end abdul token*/
                  if(!empty($r->mobile)) {
                    $con->mobile=$r->mobile;
                    }
                    $con->role_id=2;
                    $con->profile_id=  $profile->id;

                  $con->save();
                  $data['user_id']= $con->id;
            }
        }
            }
            else{
                $res=0;
                $data=0;
                $msg="Parameter missing!";
                $statusCode=405;
            }

            if($r->name==="0" || $r->email==="0" || $r->password==="0" || $r->confirmPassword==="0" ){
             $res=0;
             $data=0;
            $msg="Zero as parameter value is not allowed.";
            $statusCode=405;
            }

            return  response()->json([
                'success' => $res,
                'message' => $msg,
                'data'=>$data
            ],$statusCode);
            /*return $client;*/
            }catch(Exception $e){

              echo $e->getMessage();
            return response()->json(['error' => trans('api.something_went_wrong')], 500);

            }
    }

    public function verifyOtp(Request $r){
        try{

            if(!empty($r->email) && !empty($r->otp) ){

                $consultant=User::where('email',$r->email)->get();
                if($consultant->isEmpty()){
                    $res=0;
                    $msg="Email does not exist.";
                    $data=0;
                    $statusCode=404;
                }else{
                   if($consultant[0]['otp']!==$r->otp){
                    $res=0;
                    $msg="Otp does not match.";
                    $data=0;
                    $statusCode=401;
                   }else{
                      User::where('email',$r->email)->update(['status'=>1]);
                       $user=User::where('email',$r->email)->first();
                    $res=1;
                    $msg="Otp matched, Account successfully verified!";
                    $data['user_id']= $user->id;
                    $statusCode=200;
                    
                   }

                }

            } else{
                $res=0;
                $msg="Parameter missing!";
                $data=0;
                $statusCode=405;
            }

            if($r->name==="0" || $r->email==="0" || $r->password==="0" || $r->confirmPassword==="0" ){
                $res=0;
               $msg="Zero as parameter value is not allowed.";
               $data=0;
               $statusCode=405;
               }

               return  response()->json([
                   'success' => $res,
                   'message' => $msg,
                    'data'=>$data
               ],$statusCode);
        }catch(Exception $e){

            echo $e->getMessage();
          return response()->json(['error' => trans('api.something_went_wrong')], 500);

          }
    }

    public function login(Request $r)
    {

        try{

            if(!empty($r->email) && !empty($r->password) ){
                $consultant=User::where('email',$r->email)->get();
                if(!$consultant->isEmpty()){
                    $password=$consultant[0]['password'];
if(Hash::check($r->password, $password)){

    if($consultant[0]['status']==1){
        $res=1;
        $msg="Successfully login!";
        /*abdul token code*/
       $data['token'] =  $consultant[0]->createToken('MyApp')->accessToken;
    /*end abdul token code*/
        $data['details']=$consultant[0];
        $statusCode=$this-> successStatus;
    }else{
        $res=0;
        $msg="You did not verfied OTP yet! Kindly verify your accont first!";
        $data=0;
        $statusCode=401;
    }
}else{
    $res=0;
  $msg="Password is not correct!";
  $data=0;
  $statusCode=401;
    }

                }else{
                    $res=0;
                    $msg="Email does not exist!";
                    $data=0;
                    $statusCode=404;
                }

            } else{
                $res=0;
                $msg="Parameter missing!";
                $data=0;
                $statusCode=405;
            }
        if($r->email==="0" || $r->password==="0"){
                $res=0;
               $msg="Zero as parameter value is not allowed.";
               $data=0;
               $statusCode=405;
               }

               return  response()->json([
                   'success' => $res,
                   'message' => $msg,
                   'data'=>$data
               ], $statusCode);
        }catch(Exception $e){

            echo $e->getMessage();
          return response()->json(['error' => trans('api.something_went_wrong')], 500);

          }
}


public function userList(){
    try{
        $users=User::all();

    if($users){
        $res=1;
         $msg="User list retrieved successfully.";
         $statusCode=200;
         foreach($users as $user){
         $user->profile->speciality;
         $user->profile->services;
         $user->profile->experiences;
         }
        $data=$users;
    }else{
        $res=0;
        $msg="User not found.";
        $data=0;
        $statusCode=404;
    }

        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
}catch(Exception $e){

    echo $e->getMessage();
  return response()->json(['error' => trans('api.something_went_wrong')], 500);

  }
}

public function specialityList(){
    try{
        $users=speciality::all();
    if($users){
        $res=1;
         $msg="Speciality list retrieved successfully.";

        $data=$users;
        $statusCode=200;
    }else{
        $res=0;
        $msg="Speciality not found.";
        $data=0;
        $statusCode=404;
    }
        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
}catch(Exception $e){

    echo $e->getMessage();
  return response()->json(['error' => trans('api.something_went_wrong')], 500);

  }
}

public function userInfo(Request $r){
    try{

  if(!empty($r->user_id) ){

        $user=User::where('id',$r->user_id)->first();

        if($user){
         $res=1;
         $msg="User info fetched.";

         $user->profile->speciality;
         $user->profile->services;
         $user->profile->experiences;
         /*by typing the above 3 lines laravel includes the relation attribute
         automatically and fetch all those related arrays */
         $data= $user;
         $statusCode=200;
        }else{
        $res=0;
        $msg="User Id is not correct.";
        $data=0;
        $statusCode=401;
        }

    } else{
        $res=0;
        $msg="Parameter missing!";
        $data=0;
        $statusCode=405;
    }
        if($r->user_id==="0"){
            $res=0;
           $msg="Zero as parameter value is not allowed.";
           $data=0;
           $statusCode=405;
           }
        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
}catch(Exception $e){

    echo $e->getMessage();
  return response()->json(['error' => trans('api.something_went_wrong')], 500);

  }
}

public function userBySpeciality(Request $r){

    try{

        if(!empty($r->speciality_id) ){

              $speciality=speciality::where('id',$r->speciality_id)->first();
if($speciality){
              $users=array();
              foreach($speciality->profile as $profile){
               $users[]= $profile->user->id;
                }
          $getUsers= User::whereIn('id',$users)->get();
          foreach($getUsers as $user){
          $user->profile->speciality;
          $user->profile->services;
          $user->profile->experiences;
              /*by typing the above 3 lines laravel includes the relation attribute
               automatically and fetch all those related arrays */
          }

              if($getUsers){
            //     $obj=new Request();
            //  $obj->user_id=1;
            //   return $this->userInfo( $obj);
            $res=1;
            $msg="Users for this specific speciality found.";
            $data=$getUsers;
            $statusCode=200;

              }else{
              $res=0;
              $msg="Speciality Id is not correct.";
              $data=0;
              $statusCode=404;
              }

    }else{
        $res=0;
        $msg="Speciality not found.";
        $data=0;
        $statusCode=404;
    }


         } else{
                $res=0;
                $msg="Parameter missing!";
                $data=0;
                $statusCode=405;
            }
    if($r->speciality_id==="0"){
        $res=0;
       $msg="Zero as parameter value is not allowed.";
       $data=0;
       $statusCode=405;
       }
    return  response()->json([
        'success' => $res,
        'message' => $msg,
        'data'=>$data
    ], $statusCode);
}catch(Exception $e){
echo $e->getMessage();
return response()->json(['error' => trans('api.something_went_wrong')], 500);
} }




//user update profiles
public function updateProfile(Request $r)
{

    try{

        if(!empty($r->user_id ) && !empty($r->speciality_id) && !empty($r->date_of_birth) && !empty($r->registrationNo) && !empty($r->whatsapp)  && !empty($r->about) && !empty($r->experience) && !empty($r->fee) && !empty($r->city) && !empty($r->image) )
        {
        $user=User::where('id',$r->user_id)->first();

        if(!$user){
            $res=0;
            $data=0;
            $msg="User does not exist.";
            $statusCode=404;
        }else{
           $data=['speciality_id'=>$r->speciality_id,'date_of_birth'=>$r->date_of_birth,'registrationNo'=>$r->registrationNo,
           'whatsapp'=>$r->whatsapp,'about'=>$r->about,'experience'=>$r->experience,
'fee'=>$r->fee,'city'=>$r->city,'image'=>$r->image];

             profile::where('id',$user->profile_id)->update($data);

            $data= profile::where('id',$user->profile_id)->first();
            $res=1;
            $data=$data;
            $msg="Profile successfully updated!";
            $statusCode=200;

            //send mail


        }

        }else{
         //   return $r;
            $res=0;
            $data=0;
            $msg="Parameter missing!";
            $statusCode=405;
        }

        if($r->user_id==="0" || $r->speciality_id==="0" || $r->date_of_birth==="0" || $r->registrationNo==="0" || $r->whatsapp==="0" || $r->about==="0" || $r->experience==="0" || $r->fee==="0" || $r->city==="0" || $r->image==="0"){
         $res=0;
         $data=0;
        $msg="Zero as parameter value is not allowed.";
        $statusCode=405;
        }

        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
        /*return $client;*/
        }catch(Exception $e){

          echo $e->getMessage();
        return response()->json(['error' => trans('api.something_went_wrong')], 500);

        }
}


//temporary method to delete user so that android user can delete email accounts
public function deleteUser(Request $r){
$del=User::where('email',$r->email)->delete();
if($del){
    return 'user deleted sucessfully';
}else{
    return 'user not found';
}
}


public function booking(Request $r)
{
/*abdul new code for token*/
$validator = Validator::make($r->all(), [
    //patient
        'consultant_id' => 'required',
        'name' => 'required',
        'dob' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'document' => 'required',
    //boooking
        'doctor_id' => 'required',
        'date' => 'required',
        'time' => 'required',
        'medium' => 'required',
    //payment detail
    //    'amount' => 'required',
    //     'nameOnCard' => 'required',
    //      'cardNo' => 'required',
    //     'expiryMonth' => 'required',
    //      'expiryYear' => 'required',
    //      'cvc' => 'required',
    ]);
if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()], 401);
    }

    $p= new patient;
    $p->consultant_id = $r->consultant_id;
    $p->name = $r->name;
    $p->dob = $r->dob;
    $p->age = $r->age;
    $p->gender = $r->gender;
    $p->document = $r->document;
    $p->save();
  //  $input = $r->all();
  //  $input['password'] = bcrypt($input['password']);
  //  $user = User::create($input);
  $b= new booking;
  $b->consultant_id = $r->consultant_id;
  $b->doctor_id = $r->doctor_id;
  $b->patient_id = $p->id;
  $b->date = $r->date;
  $b->time = $r->time;
  $b->medium = $r->medium;
  $b->gender = $r->gender;
  $b->save();

  $res=1;
  $msg='Inserted successfully!';
  $data=$b;
  $statusCode=$this->successStatus;
  return  response()->json([
    'success' => $res,
    'message' => $msg,
    'data'=>$data
],$statusCode);

}




}
