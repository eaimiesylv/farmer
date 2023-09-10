<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log; 
use App\FileUpload\Imageupload;
use Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type=Auth::user()->role;
        if($user_type == 1){
            //admin
            $matchingRecords= Document::all();
            
        }else{
            $matchingRecords= Document::where('user_id', Auth::user()->id)->get();
        }
      
        //$matchingRecords=[];
        return view('crm.document.index')->with('matchingRecords', $matchingRecords);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // Validate the uploaded file
            $request->validate([
                //'pitchfile' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:1024', // Adjust the allowed file types as needed
                'pitchfile' => 'required|file|mimes:pdf|max:2060', // Adjust the allowed file types as needed
            ]);

            // Store the uploaded file in a specific directory (e.g., 'uploads/pitches')
           // $uploadedFile = $request->file('pitchfile');
           // $path = $uploadedFile->store('public/pitches');
           
            $path= new Imageupload($request->file('pitchfile'),'doc','none');
           
            $formdata=array_merge($request->all(),['pitchfile'=>$path->storage_path,'user_id'=>Auth::user()->id]);
            Document::FirstOrCreate($formdata);
            return redirect()->route('view_pitch.index')->with('success', 'Pitch file uploaded successfully.');
        }catch(QueryException $e){
            Log::error('Error storing document: ' . $e->getMessage());
            return redirect()->route('view_pitch.index')->with('errors', 'Pitch file upload failed. Try again');
        } 
           //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
