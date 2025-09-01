<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RumahSakit::factory(5)->create()->each(function ($rs) {
            Pasien::factory(10)->create([
                'rumah_sakit_id' => $rs->id
            ]);
        });
    }
}
