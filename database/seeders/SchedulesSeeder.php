<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    DB::table('schedules')->insert([
      [ 'caption' => '集合場所８' , 'detail' => '新山口駅19:55' , 'datetime' => '2009-08-24 23:10:15','image1' => '' , 'file1' => '' ,],
      [ 'caption' => '新幹線に乗車８' , 'detail' => '23:15発のぞみ', 'datetime' => '2019-09-24 23:10:15','image1' => '' , 'file1' => '' ,],
    ]);
  }
}
