<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
          $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // ModuleSeeder::class,
            // EntitySeeder::class,
            // ActionSeeder::class,
            // EntityActionSeeder::class,
            // RolePermissionSeeder::class,

          ]);
    
            // Airlines
        $airlines = [
            [
                'name' => 'Royal Jordanian Airlines',
                'short_name' => 'Royal Jordanian',
                'code' => 'RJ',
                'description' => 'The national carrier of the Hashemite Kingdom of Jordan',
                'founded' => '1963',
                'headquarters' => 'Amman, Jordan',
                'fleet_size' => 26,
                'destinations' => '40+ destinations',
                'website' => 'https://www.rj.com',
                'flag_url' => 'https://flagcdn.com/jo.svg',
                'badge_color' => 'primary',
            ],
            [
                'name' => 'Jordan Aviation',
                'short_name' => 'Jordan Aviation',
                'code' => 'R5',
                'description' => 'A private Jordanian airline specialized in scheduled and charter flights',
                'founded' => '1998',
                'headquarters' => 'Amman, Jordan',
                'fleet_size' => 12,
                'destinations' => '25+ destinations',
                'website' => 'https://www.jordanaviation.jo',
                'flag_url' => 'https://flagcdn.com/jo.svg',
                'badge_color' => 'success',
            ],
            [
                'name' => 'Arab Wings',
                'short_name' => 'Arab Wings',
                'code' => 'AW',
                'description' => 'A Jordanian airline offering domestic and regional services',
                'founded' => '1975',
                'headquarters' => 'Amman, Jordan',
                'fleet_size' => 8,
                'destinations' => '15+ destinations',
                'website' => 'https://www.arabwings.com.jo',
                'flag_url' => 'https://flagcdn.com/jo.svg',
                'badge_color' => 'warning',
            ],
            [
                'name' => 'Jazeera Airways Jordan',
                'short_name' => 'Jazeera Airways Jordan',
                'code' => 'J9',
                'description' => 'Jordanian branch of the Kuwaiti Jazeera Airways',
                'founded' => '2019',
                'headquarters' => 'Amman, Jordan',
                'fleet_size' => 6,
                'destinations' => '12+ destinations',
                'website' => 'https://www.jazeeraairways.com',
                'flag_url' => 'https://flagcdn.com/jo.svg',
                'badge_color' => 'info',
            ],
        ];
        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
