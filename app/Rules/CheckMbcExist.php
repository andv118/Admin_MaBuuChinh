<?php

namespace App\Rules;

use App\Models\Tinh;
use DB;
use Illuminate\Contracts\Validation\Rule;
use App\Lib\CheckMbc;

class CheckMbcExist implements Rule
{   
    private $checkMbc;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->checkMbc = new CheckMbc();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        $check = $this->checkMbc->checkMaTonTai($value);
        if($check) {
            return true;
        } 
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mã đã tồn tại';
    }
}
