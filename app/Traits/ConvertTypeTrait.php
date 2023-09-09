<?php 
namespace App\Traits;

Trait ConvertTypeTrait{
    // Accessor: Convert numeric value to string representation
    public function getPreferredValueChainAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'Crop';
            case 2:
                return 'Livestock';
            case 3:
                return 'Fishery and Aquaculture';
           case 4:
               return 'Agribusiness';
		   case 5:
               return 'Other';
            default:
                return 'unknown';
        }
    }

    // Mutator: Convert string representation to numeric value
    public function setPreferredValueChainAttribute($value)
    {
        switch ($value) {
            case 'Crop':
                $this->attributes['preferredValueChain'] = 1;
                break;
            case 'Livestock':
                $this->attributes['preferredValueChain'] = 2;
                break;
            case 'Fishery and Aquaculture':
                $this->attributes['preferredValueChain'] = 3;
                break;
            case 'Agribusiness':
               $this->attributes['preferredValueChain'] = 4;
               break;
			case 'Other':
               $this->attributes['preferredValueChain'] = 5;
               break;
            default:
                $this->attributes['preferredValueChain'] = 0; // You can set a default value or handle the case accordingly
        }
    }
}








?>