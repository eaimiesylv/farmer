<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    

     public function Store(Request $request)
     {
            $request->validate([
              
                'description' => 'required|string|max:3000',
                'user_id' => 'required|integer',
                'investor_id' => 'required|integer'
            ]);
            return Comment::FirstOrCreate($request->all());

           
    }

   
    public function show($id)
    {
       
        return Comment::all(); 
    }
    public function chat($user_id, $investor_id)
    {
       
            // Retrieve comments based on user_id and investor_id
        return Comment::select('user_id', 'investor_id','description','created_at','created_by')
                        ->where([['user_id', $user_id], ['investor_id', $investor_id]])
                        ->orderby('created_at', 'desc')
                        ->get();

            
    }

    
}
