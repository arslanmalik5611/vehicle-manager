<?php

namespace App\Helpers;

use App\Models\CollectionCenter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SiteHelper
{
    public static function reformatDbDateTime($datetimeStr)
    {

        if (!empty($datetimeStr)) {
            return Carbon::createFromFormat('d/m/Y H:i', $datetimeStr)->format('Y-m-d H:i:s');
        } else {
            return NULL;
        }
    }

    public static function reformatDbDate($dateStr)
    {
        if (!empty($dateStr)) {
            return Carbon::createFromFormat('d/m/Y H:i:s', "{$dateStr} 00:00:00")->format('Y-m-d');
        } else {
            return NULL;
        }
    }

    public static function reformatDate($date)
    {
        if (!empty($date)) {
            return Carbon::createFromFormat('Y-m-d H:i:s', "{$date} 00:00:00");
            } else {
            return NULL;
        }
    }

    public static function reformatReadableDateTime($datetimeStr)
    {

        if (!empty($datetimeStr)) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $datetimeStr)->format('d/m/Y H:i');
        } else {
            return NULL;
        }
    }

    public static function reformatReadableDate($dateStr)
    {
        if (!empty($dateStr)) {
            return Carbon::createFromFormat('Y-m-d H:i:s', "{$dateStr} 00:00:00")->format('d/m/Y');
        } else {
            return NULL;
        }
    }

    public static function checkPermission($menu_key)
    {
        if (Auth::user()->menus->where('menu_key', $menu_key)->isNotEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    public function reformatReadableDateNice($dateStr)
    {
        if (!empty($dateStr)) {
            return Carbon::parse($dateStr)->format('d M, Y');
        } else {
            return false;
        }
    }

    public static function getPreviousMonth($date)
    {
        if (!empty($date)) {
            return Carbon::parse($date)->subMonth()->format('Y-m');
        } else {
            return false;
        }
    }

    public static function reformatReadableMonthNice($date)
    {
        if (!empty($date)) {
            return Carbon::parse($date)->format('M/Y');
        } else {
            return false;
        }
    }


    public static function base64ToImage($image)
    {
        if (!empty($image)) {
            $fileName = Str::random(10);
            $folderPathOrignal = public_path() . '/uploads/students/';
            $ext = explode('/', mime_content_type($image))[1];
            $src = preg_replace('#data:image/[^;]+;base64,#', '', $image);
            file_put_contents($folderPathOrignal . $fileName . '.' . $ext, base64_decode($src));
        }
        return $fileName . '.' . $ext;
    }

    public static function strright($str, $separator)
    {
        if (intval($separator)) {
            return substr($str, -$separator);
        } elseif ($separator === 0) {
            return $str;
        } else {
            $strpos = strpos($str, $separator);

            if ($strpos === false) {
                return $str;
            } else {
                return substr($str, -$strpos);
            }
        }
    }

    public static function strleft($str, $separator)
    {
        if (intval($separator)) {
            return substr($str, 0, $separator);
        } elseif ($separator === 0) {
            return $str;
        } else {
            $strpos = strpos($str, $separator);

            if ($strpos === false) {
                return $str;
            } else {
                return substr($str, 0, $strpos);
            }
        }
    }

   public static function AmountInWords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string [] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . '
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . '
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            } else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . "
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
    }
}
