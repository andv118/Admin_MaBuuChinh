<?php

use Illuminate\Database\Seeder;
use DB;
class TinhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\tinhs::class, 100)->create();
        DB::table('tinhs')->insert([
            ['vung'=>'tp hcm','ten'=>'hcm','ma_buu_chinh'=>'123'],
            ['vung'=>'ha noi','ten'=>'ha noi','ma_buu_chinh'=>'123'],
            ['vung'=>'ha noi 2','ten'=>'ha noi 2','ma_buu_chinh'=>'123'],
            ['vung'=>'thanh hoa','ten'=>'thanh hoa','ma_buu_chinh'=>'123'],
            ['vung'=>'bac minh','ten'=>'bac minh','ma_buu_chinh'=>'123'],
        ]);
    }
}
