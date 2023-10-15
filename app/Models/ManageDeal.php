<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageDeal extends Model
{
    use HasFactory;
    protected $guarded =[];

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
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'Open';
            case 1:
                return 'Close';
            case 2:
                return 'Won';
            default:
                return 'pending';
        }
    }
    public function investor(){
        return $this->belongsTo(User::class,'investor_id','id')->select("id","fullname","created_at");
    }
    public function agricbusiness(){
        return $this->belongsTo(User::class,'user_id','id')->select("id","fullname","created_at");
    }
    
}
