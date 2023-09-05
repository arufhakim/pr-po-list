<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PR;
use Faker\Generator as Faker;

$factory->define(PR::class, function (Faker $faker) {
    return [
        'tanggal_sr' => $faker->date(),
        'tanggal_sr_verif' => $faker->date(),
        'tim' => 'Umum',
        'unit_id' => 1,
        'nomor_sr' => '43326/B/SA.04.01/21/ME/2020',
        'gl_account' => '670130001 - Biaya Jasa - Tenaga Kerja Alih Daya',
        'cost_center' => 'B006140000',
        'uraian_pekerjaan' => 'SR Jasa Angkutan Pupuk NS Kantong Jumbo Bag Korindo Probolinggo (Franco)',
        'pipg' => 'PG',
        'prioritas_id' => 1,
        'nomor_pr' => '2200064659',
        'line_pr' => '10',
        'oe_pr' => 2561300999,
        'kontrak_id' => 1,
        'status_id' => 1,
        'tanggal_deliv' => $faker->date(),
    ];
});
