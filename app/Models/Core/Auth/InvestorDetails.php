<?php

namespace App\Models\Core\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'finance_institution',
        'investment_type',
        'preferred_deal_size',
        'funding_type',
        'organization_description',
    ];

    protected $casts = [
        'investment_type' => 'json',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function investor(){
        return $this->belongsTo(User::class);
    }
}
