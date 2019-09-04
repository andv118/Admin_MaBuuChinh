<?php

/**
 * Class này có chức năng
 * 1. convert tên có dấu tiếng việt sang ko dấu tiếng anh
 * (chú ý: sử dụng utf8, unicode dựng sẵn)
 * 2. convert unocide tổ hợp sang dựng sẵn
 * 3. convert từ kiểu unicode sang utf8 (đưa vào database)
 */

namespace App\Lib;

class ConvertAndUnicode
{
    /**
     * Convert unicode tổ hợp sang dựng sẵn
     * @param string unicode
     * @return str unicode dựng sẵn
     */
    function toHop2DungSan($unicode_str)
    {
        $unicode_str = json_encode($unicode_str);

        $unicode_str = str_replace("e\u0309", "\u1EBB", $unicode_str);    // ẻ
        $unicode_str = str_replace("e\u0301", "\u00E9", $unicode_str);    // é
        $unicode_str = str_replace("e\u0300", "\u00E8", $unicode_str);    // è
        $unicode_str = str_replace("e\u0323", "\u1EB9", $unicode_str);    // ẹ
        $unicode_str = str_replace("e\u0303", "\u1EBD", $unicode_str);    // ẽ

        $unicode_str = str_replace("\u00ea\u0309", "\u1EC3", $unicode_str);    // ể
        $unicode_str = str_replace("\u00ea\u0301", "\u1EBF", $unicode_str);    // ế
        $unicode_str = str_replace("\u00ea\u0300", "\u1EC1", $unicode_str);    // ề
        $unicode_str = str_replace("\u00ea\u0323", "\u1EC7", $unicode_str);    // ệ
        $unicode_str = str_replace("\u00ea\u0303", "\u1EC5", $unicode_str);    // ễ

        $unicode_str = str_replace("E\u0309", "\u1EBA", $unicode_str);    // Ẻ
        $unicode_str = str_replace("E\u0301", "\u00C9", $unicode_str);    // É
        $unicode_str = str_replace("E\u0300", "\u00C8", $unicode_str);    // È
        $unicode_str = str_replace("E\u0323", "\u1EB8", $unicode_str);    // Ẹ
        $unicode_str = str_replace("E\u0303", "\u1EBC", $unicode_str);    // Ẽ

        $unicode_str = str_replace("\u00ca\u0309", "\u1EC2", $unicode_str);    // Ể
        $unicode_str = str_replace("\u00ca\u0301", "\u1EBE", $unicode_str);    // Ế
        $unicode_str = str_replace("\u00ca\u0300", "\u1EC0", $unicode_str);    // Ề
        $unicode_str = str_replace("\u00ca\u0323", "\u1EC6", $unicode_str);    // Ệ
        $unicode_str = str_replace("\u00ca\u0303", "\u1EC4", $unicode_str);    // Ễ

        $unicode_str = str_replace("u\u0309", "\u1EE7", $unicode_str);    // ủ
        $unicode_str = str_replace("u\u0301", "\u00FA", $unicode_str);    // ú
        $unicode_str = str_replace("u\u0300", "\u00F9", $unicode_str);    // ù
        $unicode_str = str_replace("u\u0323", "\u1EE5", $unicode_str);    // ụ
        $unicode_str = str_replace("u\u0303", "\u0169", $unicode_str);    // ũ

        $unicode_str = str_replace("\u01b0\u0309", "\u1EED", $unicode_str);    // ử
        $unicode_str = str_replace("\u01b0\u0301", "\u1EE9", $unicode_str);    // ứ
        $unicode_str = str_replace("\u01b0\u0300", "\u1EEB", $unicode_str);    // ừ
        $unicode_str = str_replace("\u01b0\u0323", "\u1EF1", $unicode_str);    // ự
        $unicode_str = str_replace("\u01b0\u0303", "\u1EEF", $unicode_str);    // ữ

        $unicode_str = str_replace("U\u0309", "\u1EE6", $unicode_str);    // Ủ
        $unicode_str = str_replace("U\u0301", "\u00DA", $unicode_str);    // Ú
        $unicode_str = str_replace("U\u0300", "\u00D9", $unicode_str);    // Ù
        $unicode_str = str_replace("U\u0323", "\u1EE4", $unicode_str);    // Ụ
        $unicode_str = str_replace("U\u0303", "\u0168", $unicode_str);    // Ũ

        $unicode_str = str_replace("\u01af\u0309", "\u1EEC", $unicode_str);    // Ử
        $unicode_str = str_replace("\u01af\u0301", "\u1EE8", $unicode_str);    // Ứ
        $unicode_str = str_replace("\u01af\u0300", "\u1EEA", $unicode_str);    // Ừ
        $unicode_str = str_replace("\u01af\u0323", "\u1EF0", $unicode_str);    // Ự
        $unicode_str = str_replace("\u01af\u0303", "\u1EEE", $unicode_str);    // Ữ

        $unicode_str = str_replace("o\u0309", "\u1ECF", $unicode_str);    // ỏ
        $unicode_str = str_replace("o\u0301", "\u00F3", $unicode_str);    // ó
        $unicode_str = str_replace("o\u0300", "\u00F2", $unicode_str);    // ò
        $unicode_str = str_replace("o\u0323", "\u1ECD", $unicode_str);    // ọ
        $unicode_str = str_replace("o\u0303", "\u00F5", $unicode_str);    // õ

        $unicode_str = str_replace("\u01a1\u0309", "\u1EDF", $unicode_str);    // ở
        $unicode_str = str_replace("\u01a1\u0301", "\u1EDB", $unicode_str);    // ớ
        $unicode_str = str_replace("\u01a1\u0300", "\u1EDD", $unicode_str);    // ờ
        $unicode_str = str_replace("\u01a1\u0323", "\u1EE3", $unicode_str);    // ợ
        $unicode_str = str_replace("\u01a1\u0303", "\u1EE1", $unicode_str);    // ỡ

        $unicode_str = str_replace("\u00f4\u0309", "\u1ED5", $unicode_str);    // ổ
        $unicode_str = str_replace("\u00f4\u0301", "\u1ED1", $unicode_str);    // ố
        $unicode_str = str_replace("\u00f4\u0300", "\u1ED3", $unicode_str);    // ồ
        $unicode_str = str_replace("\u00f4\u0323", "\u1ED9", $unicode_str);    // ộ
        $unicode_str = str_replace("\u00f4\u0303", "\u1ED7", $unicode_str);    // ỗ

        $unicode_str = str_replace("O\u0309", "\u1ECE", $unicode_str);    // Ỏ
        $unicode_str = str_replace("O\u0301", "\u00D3", $unicode_str);    // Ó
        $unicode_str = str_replace("O\u0300", "\u00D2", $unicode_str);    // Ò
        $unicode_str = str_replace("O\u0323", "\u1ECC", $unicode_str);    // Ọ
        $unicode_str = str_replace("O\u0303", "\u00D5", $unicode_str);    // Õ

        $unicode_str = str_replace("\u01a0\u0309", "\u1EDE", $unicode_str);    // Ở
        $unicode_str = str_replace("\u01a0\u0301", "\u1EDA", $unicode_str);    // Ớ
        $unicode_str = str_replace("\u01a0\u0300", "\u1EDC", $unicode_str);    // Ờ
        $unicode_str = str_replace("\u01a0\u0323", "\u1EE2", $unicode_str);    // Ợ
        $unicode_str = str_replace("\u01a0\u0303", "\u1EE0", $unicode_str);    // Ỡ

        $unicode_str = str_replace("\u00d4\u0309", "\u1ED4", $unicode_str);    // Ổ
        $unicode_str = str_replace("\u00d4\u0301", "\u1ED0", $unicode_str);    // Ố
        $unicode_str = str_replace("\u00d4\u0300", "\u1ED2", $unicode_str);    // Ồ
        $unicode_str = str_replace("\u00d4\u0323", "\u1ED8", $unicode_str);    // Ộ
        $unicode_str = str_replace("\u00d4\u0303", "\u1ED6", $unicode_str);    // Ỗ

        $unicode_str = str_replace("a\u0309", "\u1EA3", $unicode_str);    // ả
        $unicode_str = str_replace("a\u0301", "\u00E1", $unicode_str);    // á
        $unicode_str = str_replace("a\u0300", "\u00E0", $unicode_str);    // à
        $unicode_str = str_replace("a\u0323", "\u1EA1", $unicode_str);    // ạ
        $unicode_str = str_replace("a\u0303", "\u00E3", $unicode_str);    // ã

        $unicode_str = str_replace("\u0103\u0309", "\u1EB3", $unicode_str);    // ẳ
        $unicode_str = str_replace("\u0103\u0301", "\u1EAF", $unicode_str);    // ắ
        $unicode_str = str_replace("\u0103\u0300", "\u1EB1", $unicode_str);    // ằ
        $unicode_str = str_replace("\u0103\u0323", "\u1EB7", $unicode_str);    // ặ
        $unicode_str = str_replace("\u0103\u0303", "\u1EB5", $unicode_str);    // ẵ

        $unicode_str = str_replace("\u00e2\u0309", "\u1EA9", $unicode_str);    // ẩ
        $unicode_str = str_replace("\u00e2\u0301", "\u1EA5", $unicode_str);    // ấ
        $unicode_str = str_replace("\u00e2\u0300", "\u1EA7", $unicode_str);    // ầ
        $unicode_str = str_replace("\u00e2\u0323", "\u1EAD", $unicode_str);    // ậ
        $unicode_str = str_replace("\u00e2\u0303", "\u1EAB", $unicode_str);    // ẫ

        $unicode_str = str_replace("A\u0309", "\u1EA2", $unicode_str);    // Ả
        $unicode_str = str_replace("A\u0301", "\u00C1", $unicode_str);    // Á
        $unicode_str = str_replace("A\u0300", "\u00C0", $unicode_str);    // À
        $unicode_str = str_replace("A\u0323", "\u1EA0", $unicode_str);    // Ạ
        $unicode_str = str_replace("A\u0303", "\u00C3", $unicode_str);    // Ã

        $unicode_str = str_replace("\u0102\u0309", "\u1EB2", $unicode_str);    // Ẳ
        $unicode_str = str_replace("\u0102\u0301", "\u1EAE", $unicode_str);    // Ắ
        $unicode_str = str_replace("\u0102\u0300", "\u1EB0", $unicode_str);    // Ằ
        $unicode_str = str_replace("\u0102\u0323", "\u1EB6", $unicode_str);    // Ặ
        $unicode_str = str_replace("\u0102\u0303", "\u1EB4", $unicode_str);    // Ẵ

        $unicode_str = str_replace("\u00c2\u0309", "\u1EA8", $unicode_str);    // Ẩ
        $unicode_str = str_replace("\u00c2\u0301", "\u1EA4", $unicode_str);    // Ấ
        $unicode_str = str_replace("\u00c2\u0300", "\u1EA6", $unicode_str);    // Ầ
        $unicode_str = str_replace("\u00c2\u0323", "\u1EAC", $unicode_str);    // Ậ
        $unicode_str = str_replace("\u00c2\u0303", "\u1EAA", $unicode_str);    // Ẫ

        $unicode_str = str_replace("y\u0309", "\u1EF7", $unicode_str);    // ỷ
        $unicode_str = str_replace("y\u0301", "\u00FD", $unicode_str);    // ý
        $unicode_str = str_replace("y\u0300", "\u1EF3", $unicode_str);    // ỳ
        $unicode_str = str_replace("y\u0323", "\u1EF5", $unicode_str);    // ỵ
        $unicode_str = str_replace("y\u0303", "\u1EF9", $unicode_str);    // ỹ

        $unicode_str = str_replace("Y\u0309", "\u1EF6", $unicode_str);    // Ỷ
        $unicode_str = str_replace("Y\u0301", "\u00DD", $unicode_str);    // Ý
        $unicode_str = str_replace("Y\u0300", "\u1EF2", $unicode_str);    // Ỳ
        $unicode_str = str_replace("Y\u0323", "\u1EF4", $unicode_str);    // Ỵ
        $unicode_str = str_replace("Y\u0303", "\u1EF8", $unicode_str);    // Ỹ

        $unicode_str = str_replace("i\u0309", "\u1EC9", $unicode_str);    // ỉ
        $unicode_str = str_replace("i\u0301", "\u00ED", $unicode_str);    // í
        $unicode_str = str_replace("i\u0300", "\u00EC", $unicode_str);    // ì
        $unicode_str = str_replace("i\u0323", "\u1ECB", $unicode_str);    // ị
        $unicode_str = str_replace("i\u0303", "\u0129", $unicode_str);    // ĩ

        $unicode_str = str_replace("I\u0309", "\u1EC8", $unicode_str);    // Ỉ
        $unicode_str = str_replace("I\u0301", "\u00CD", $unicode_str);    // Í
        $unicode_str = str_replace("I\u0300", "\u00CC", $unicode_str);    // Ì
        $unicode_str = str_replace("I\u0323", "\u1ECA", $unicode_str);    // Ị
        $unicode_str = str_replace("I\u0303", "\u0128", $unicode_str);    // Ĩ

        $unicode_str = str_replace("'", "-", $unicode_str);    // '

        $unicode_str_decode = json_decode($unicode_str);
        return $this->convertToUtf8($unicode_str_decode);
    }

    /**
     * Convert có dấu sang ko dấu
     * chú ý kiểu db là utf8 và unicode là dựng sẵn
     * @param str
     * @return str ko dấu
     */
    public function convert_vi_to_en($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);

        // $unicode = array(
        //     'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        //     'd' => 'đ',
        //     'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        //     'i' => 'í|ì|ỉ|ĩ|ị',
        //     'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        //     'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        //     'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        //     'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        //     'D' => 'Đ',
        //     'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        //     'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        //     'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        //     'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        //     'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        // );
        // foreach ($unicode as $nonUnicode => $uni) {
        //     $str = preg_replace("/($uni)/", $nonUnicode, $str);
        // }
        return $str;
    }

    /**
     * Convert các định dạng mã về UTF8
     * @param text
     * @return text-utf8
     */
    public function convertToUtf8($text)
    {
        $strUtf8 = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        return $strUtf8;
    }

    /**
     * convert ký tự viết hoa chữ đầu tiên cho string có dấu
     * @param string
     * @return string
     */
    public function mb_ucwords ($string)
    {
        return mb_convert_case ($string, MB_CASE_TITLE, 'UTF-8'); 
    }

}
