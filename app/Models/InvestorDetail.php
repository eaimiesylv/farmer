<?php

namespace App\Models;

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
}
