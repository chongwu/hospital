<?php

namespace App\Validators;


class SNILSValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $clearedSNILS = self::clearSNILS($value);
        $number = substr($clearedSNILS, 0, 9);
        $checkSum = substr($clearedSNILS, -2);
        $i = 9;
        $sum = null;
        foreach (str_split($number) as $num){
            $sum += (integer)$num*$i;
            $i--;
        }
        return self::checkSumCompare($sum, $checkSum);
    }

    public static function clearSNILS($snils)
    {
        return preg_replace('/(\s+)|(-)/','', $snils);
    }

    protected static function checkSumCompare($sum, $checkSum)
    {
        if($sum < 100){
            if((integer)$checkSum === $sum){
                return true;
            }
        }
        elseif($sum===100 || $sum===101){
            if($checkSum==='00'){
                return true;
            }
        }
        else{
            $ost=$sum % 101;
            return self::checkSumCompare($ost, $checkSum);
        }
        return false;
    }
}