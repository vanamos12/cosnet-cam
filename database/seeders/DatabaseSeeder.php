<?php

namespace Database\Seeders;

use App\Models\ChangeName;
use App\Models\Member;
use App\Models\Payment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Hermann',
            'last_name' => 'POKA TCHONENG',
            'membershipid' => 'COSNETDGRYS123458',
            //'state' => Arr::random(["Alabama", "Alaska", "Arkansas", "Georgia", "Idaho", "Kentucky", "Missouri"]),
            //'town' => Arr::random(["Alexander City", "Decatur", "Coronado", "Fullerton", "San Simeon", "Manhattan"]),
            'phone' => '0015186569874',
            'email' => 'pokatchoneng@gmail.com',
            //'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            //'remember_token' => Str::random(10),
        ]);

        $users = User::factory(20)->create([
            'password' => "12345678",
        ]);

        $members = collect();
        for($j=0; $j<100; $j++){
            $member = Member::factory()->create([
                'user_id' => $users->random(),
            ]);
            $members->add( $member);

            Payment::factory()->create([
                'member_id' => $member->id
            ]);
        }
        

        for($i=0; $i<100; $i++){
            if (mt_rand(0, 1) == 0){
                ChangeName::factory()->create([
                    'change_name_able_id' => $users->random()->id,
                    'change_name_able_type' => User::class
                ]);
            }else{
                ChangeName::factory()->create([
                    'change_name_able_id' => $members->random()->id,
                    'change_name_able_type' => Member::class
                ]);
            }
        }
    }
}
