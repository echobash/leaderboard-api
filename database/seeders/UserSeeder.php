<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $usersData = [
            ['name' => 'Echobash', 'age' => 30, 'points' => 23, 'address' => 'Gurugram'],
            ['name' => 'Ali Anwar', 'age' => 28,'points' => 29, 'address' => 'Gurugram MG Road'],
            ['name' => 'Ali', 'age' => 35,'points' => 13, 'address' => 'Iffco Chowk Gurugram'],
            ['name' => 'Anwar', 'age' => 40,'points' => 24,'address' => 'Sikandarpur'],
        ];

        foreach ($usersData as $userData) {
            $user = User::create($userData);
            $qrPath = 'qrcodes/' . $user->id . '.png';
            
            // Generate QR Code using goqr.me API
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($user->address);
            $qrImage = Http::get($qrUrl)->body();
            
            Storage::put($qrPath, $qrImage);
        }

        // Generate additional random users
        $users = User::factory()->count(2)->create();
        foreach ($users as $user) {
            $qrPath = 'qrcodes/' . $user->id . '.png';
            
            // Generate QR Code using goqr.me API
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($user->address);
            $qrImage = Http::get($qrUrl)->body();
            
            Storage::put($qrPath, $qrImage);
        }
    }
}
