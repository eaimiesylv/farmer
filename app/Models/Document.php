<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPitchtypeAttribute($value)
    {
        // Define the mapping of pitchtype values to their corresponding names
        $pitchtypeNames = [
            1 => 'Business Plan',
            2 => 'Proposal',
        ];

        // Return the pitchtype name based on the stored value
        return $pitchtypeNames[$value] ?? null;
    }
    
    
}
