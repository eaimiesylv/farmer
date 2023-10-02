<?php

namespace App\Http\Controllers\API;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use App\Models\Role;
use App\Models\User;
use App\Models\AgricBusiness;
use App\Models\InvestorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'user';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       
        
        //$email='Okomemmanuel.com';
        //Mail::to($email)->send(new WelcomeEmail($email));
        //send email
        $validator = Validator::make($request->all(), [
            'commonComponentData.company_website' => 'nullable|string|max:65',
            'commonComponentData.contact_person' => 'required|string|max:60',
            'commonComponentData.email' => 'required|email|max:50|unique:users,email',
            'commonComponentData.fullname' => 'required|string|max:50',
            'commonComponentData.password' => 'required|string|min:6|max:15',
            'commonComponentData.phone_number' => 'required|string|max:20|unique:users,phone_number',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => false, 'error' => $validator->errors()], 400);
        }
        $commonComponentData = $request->input('commonComponentData');
        $dynamicComponentData = $request->input('dynamicComponentData');
        try {
            DB::beginTransaction(); // Start a database transaction
            $role=4; //if role is investor
            if ($request->userRole == 3) {
            $role=3; //if role is agric business
            }
            $user = User::firstOrCreate([
                'company_website'=>$commonComponentData['company_website'],
                'contact_person'=>$commonComponentData['contact_person'],
                'email'=>$commonComponentData['email'],
                'fullname'=>$commonComponentData['fullname'],
                'password'=>Hash::make($commonComponentData['password']),
                'phone_number'=>$commonComponentData['phone_number'],
                'role'=>$role
            ]);
            $formData = array_merge($dynamicComponentData, ['user_id' => $user->id]);

            if ($request->userRole == 3) {
               
                $AgricBusiness = AgricBusiness::firstOrCreate($formData);
                //$role = Role::findOrFail($request->roleId);
                $role=3;
                $user->roles()->attach($role);
                
            } else {
                $investorDetail = InvestorDetail::firstOrCreate($formData);
                $role=4;
                $user->roles()->attach($role);
            }
            
            try{
                Mail::to($user->email)->send(new WelcomeEmail($user->email));

            }
            catch (\Swift_TransportException $e) {
                DB::rollBack();
                return response()->json(['error' => ['email.delivery' => ['Email. email not delivered']]], 500);

            }
          
            DB::commit(); // Commit the transaction
           
            return response()->json(['success' => true, 'message' =>'Verification Email Has Been Sent To You'], 200);
        } catch (QueryException $e) {
            DB::rollBack(); // Rollback the transaction if an error occurred
            Log::error('Error occurred during transaction: ' . $e->getMessage());
            $errors = [
                'commonComponentData.server' => ['Server eror.'],
                // ... (add other error messages as needed)
            ];
            
            return response()->json(['error' => $errors, 'message' => $e->getMessage()], 500);
        
           
        }
    
        
        
        
        
        
    }

    public function stored(Request $request)
    {
        return response()->json(['status'=>'success', 'message'=>$request->all()], 200);
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function phone_exist($phone){
            $user=User::select('id')->where('phone_number', $phone)->first();
            if($user){
                return response()->json(['status'=>'success', 'message'=>"exist"], 200);
            }else{
                return response()->json(['status'=>'error', 'message'=>"not exist"], 200);
            }
          
    }
    public function email_exist($email){
        $user=User::select('id')->where('email', $email)->first();
        if($user){
            return response()->json(['status'=>'success', 'message'=>"exist"], 200);
        }else{
            return response()->json(['status'=>'error', 'message'=>"not exist"], 200);
        }
      
}
}
