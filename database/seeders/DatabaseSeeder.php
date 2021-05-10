<?php

namespace Database\Seeders;

use App\Models\Stage;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            array(
                'stage' => 'Awaiting Review',
                'order' => 1,
            ),
            array(
                'stage' => 'Awaiting Document Submission',
                'order' => 2,
            ),
            array(
                'stage' => 'Awaiting Document Review',
                'order' => 3,
            ),
            array(
                'stage' => 'Awaiting Disbursement',
                'order' => 4,
            ),
            array(
                'stage' => 'Disbursed & Completed',
                'order' => 5,
            ),
        ];

        foreach($stages as $id => $stage) {
            Stage::firstOrCreate($stage);
        }

        User::firstOrCreate([
            'name'=>'Super Administrator',
            'email' => 'super@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'administrator'
        ]);

        $defaultSubscriptions = [
            [
                'title'=>'7 Days Subscription',
                'amount' => 70.00,
                'timeframe' => 7,
                'status' => 'enabled'
            ] ,
            [
                'title'=>'14 Days Subscription',
                'amount' => 130.00,
                'timeframe' => 14,
                'status' => 'enabled'
            ] ,
        ];

        foreach($defaultSubscriptions as $id => $subs) {
            Subscription::firstOrCreate($subs);
        }
        // \App\Models\User::factory(10)->create();
    }
}
