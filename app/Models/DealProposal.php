<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealProposal extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function boot(){

        parent::boot();
        static::creating(function($model){
       
           
            $authenticatedUser = auth()->user();

            if ($authenticatedUser) {
                $modelDetail=[
                    'user_id' => $authenticatedUser->id,
                    
                ];
                $model->fill($modelDetail);
            }
        });
        
    }
    public function deals(){
        return $this->belongsTo(ManageDeal::class,'deal_id','id')->select('id','user_id','title','description');
    }
}
