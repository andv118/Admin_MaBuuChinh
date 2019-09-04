<?php

/**
 * Class kiểm tra mã bưu chính có chuẩn cú pháp
 */

namespace App\Lib;

use App\Models\Dtgm;
use App\Models\Huyen;
use App\Models\Tinh;

class CheckMbc
{
    /**
     * Tách mã thành array
     * @param string mbc
     * @return array mbc
     */
    public function tachMa($mbc)
    {
        $pos = strpos($mbc, '-');
        $arrMbc = array();
        if ($pos !== false) {
            $arrStr = explode('-', $mbc);
            // chuyen sang interger
            $v1 = (int) $arrStr[0];
            $v2 = (int) $arrStr[1];

            for ($i = $v1; $i <= $v2; $i++) {
                $arrMbc[] = $i;
            }
        } else {
            $arrMbc[] = (int) $mbc;
        }
        return $arrMbc;
    }

    /**
     * Kiểm tra mã có đúng với mã cha ko
     * @param string mbcChild
     * @param string mbcFather
     * @return true, false
     */
    public function checkMaChaCon($mbcChild, $mbcFather)
    {
        $arrMbcFather = $this->tachMa($mbcFather);
        if ($arrMbcFather[0] < 100) {
            // 2 chu so -> father la tinh
            $mbcChild = (string) $mbcChild;
            $mbcChild = (int) substr($mbcChild, 0, 2);
            $key = array_search($mbcChild, $arrMbcFather);
            if ($key !== false) {
                // tim thay mbcChild trong father
                return true;
            }
        } else {
            // father la huyen
            // 3 chu so
            if ($arrMbcFather[0] < 1000) {
                $mbcChild = (string) $mbcChild;
                $mbcChild = (int) substr($mbcChild, 0, 3);
                $key = array_search($mbcChild, $arrMbcFather);
                if ($key !== false) {
                    // tim thay mbcChild trong father
                    return true;
                }
            }
            // 4 chu so
            else {
                $mbcChild = (string) $mbcChild;
                $mbcChild = (int) substr($mbcChild, 0, 4);
                $key = array_search($mbcChild, $arrMbcFather);
                if ($key !== false) {
                    // tim thay mbcChild trong father
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Kiểm tra mã có đúng với mã cha ko
     * @param string mbcChild
     * @param string mbcFather
     * @return true, false
     */
    public function checkMaTonTai($mbc)
    {
        $arrMbc = $this->tachMa($mbc);
        // tinh
        if ($arrMbc[0] < 100) {
            $arrMbcTinh = Tinh::select('mbc')
                ->get()
                ->toArray();
            foreach ($arrMbcTinh as $mbcTinh) {
                foreach ($this->tachMa($mbcTinh['mbc']) as $v) {
                    foreach ($arrMbc as $vMaCheck) {
                        if ($vMaCheck == $v) {
                            return false;
                        }
                    }
                }
            }
        }
        // huyen
        elseif ($arrMbc[0] >= 100 && $arrMbc[0] < 10000) {
            $arrMbcHuyen = Huyen::select('mbc')
                ->get()
                ->toArray();
            foreach ($arrMbcHuyen as $mbcHuyen) {
                foreach ($this->tachMa($mbcHuyen['mbc']) as $v) {
                    foreach ($arrMbc as $vMaCheck) {
                        if ($vMaCheck == $v) {
                            return false;
                        }
                    }
                }
            }
        }
        // dtgm
        elseif ($arrMbc[0] >= 10000 && $arrMbc[0] < 100000) {
            $mbc = (string) $arrMbc[0];
            $count = Dtgm::select(DB::raw('count(*) as count'))
                ->where('mbc', $mbc)
                ->get()
                ->toArray();
            if ($count[0]['count'] > 0) { // ko có mã bưu chính bị trùng
                return false;
            }
        }
        return true;
    }
}
