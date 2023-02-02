<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\jabatan;
use App\Models\pengunjung;
use App\Models\reservasi;
use App\Models\tbl_kamar;
use App\Models\tipe_kamar;
use App\Models\User;

use Illuminate\Support\Facades;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        jabatan::create([
            'jenis_jabatan' => 'CEO'
        ]);
            
        jabatan::create([
            'jenis_jabatan' => 'Receptionist'
        ]);
            
        User::create([
            'name' => 'ceo',
            'email' => 'ceo@hotel.com',
            'password' => \Hash::make('123'),
            'jabatan_id' => 1
        ]);

        User::create([
            'name' => 'Receptionist',
            'email' => 'Receptionist@hotel.com',
            'password' => \Hash::make('123'),
            'jabatan_id' => 2
        ]);

        tipe_kamar::create([
            'nama_tipe' => 'VIP',
            'harga' => 1200000
        ]);

        tipe_kamar::create([
            'nama_tipe' => 'VVIP',
            'harga' => 2000000
        ]);

        tipe_kamar::create([
            'nama_tipe' => 'REGULER',
            'harga' => 120000
        ]);
            
        for ($i=1; $i <= 10; $i++) { 
            tbl_kamar::create([
                'kode_ruangan' => 'A'.$i,
                'tipe_id' => 1,
                'status' => 0
            ]);
        }
        
        for ($i=1; $i <= 10; $i++) { 
            pengunjung::create([
                'nama' => 'USER'.$i,
                'alamat' => "BULAK BANTENG". $i,
                'no_ktp' => "357".$i,
                'no_telp' => "081".$i
            ]);
        }

        reservasi::create([
            'kamar_id' => 1,
            'pengunjung_id' => 1,
            'status_pay' => 0,
            'lama_sewa' => 1
        ]);

            
    }
}
