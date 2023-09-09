<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AgricBusiness extends Model
{
    use HasFactory;
    protected $fillable = [
        'organizationName',
        'dealName',
        'dealPromoters',
        'dealDescription',
        'hasBusinessPlan',
        'focalStates',
        'ticketSize',
        'raiseAmount',
        'purpose',
        'preferredValueChain',
        'otherValueChains',
        'pitchFile',
        'user_id',
    ];

    protected $casts = [
        'preferredValueChain' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}





