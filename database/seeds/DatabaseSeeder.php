<?php

use Illuminate\Database\Seeder;

use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use App\Models\BackpackUser;
use App\Models\Store;

class DatabaseSeeder extends Seeder
{    
    
    
    public const NUM_STORES      = 30;


    private function create_stores(){
        
        $faker = Faker\Factory::create('es_CR');
        
        //$bar = $this->output->createProgressBar();
        $bar    = $this->command->getOutput()->createProgressBar(SELF::NUM_STORES);
        

        for ($i=0; $i<SELF::NUM_STORES; $i++){

            $address_search=$faker->unique()->state . " US";
            
            $endpoint = "https://places-dsn.algolia.net/1/places/query?x-algolia-agent=Algolia%20for%20JavaScript%20(3.35.1)%3B%20Browser%20(lite)%3B%20Algolia%20Places%201.18.1&x-algolia-application-id=&x-algolia-api-key=";
            $client = new \GuzzleHttp\Client();
            

            $response = $client->request('GET', $endpoint, ['query' => [
                'query' => $address_search                
            ]]);
            $location_found=json_decode($response->getBody()->getContents());
            

            $lat=$location_found->hits[0]->_geoloc->lat;
            $lng=$location_found->hits[0]->_geoloc->lng;


            Store::create([
                'name' 		=>	$faker->state,
                'stock_available'	=> $faker->randomDigit,
                'is_eligible'	=>	  $faker->randomElement([false, true]),
                'address_lat'	=>	  $lat,
                'address_lng'	=>	  $lng,
                
                
            ]);

            $bar->advance();
        }
        $bar->clear();

        
        $this->command->info( SELF::NUM_STORES . " Stores created " );

    }
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        Permission::create([
            'name' => 'advanced.access-control-list',
        ]);

        Permission::create([
            'name' => 'advanced.developer-tools.file-manager',
        ]);

        Permission::create([
            'name' => 'advanced.developer-tools.backups',
        ]);

        Permission::create([
            'name' => 'advanced.developer-tools.logs',
        ]);

        Permission::create([
            'name' => 'advanced.developer-tools.settings',
        ]);

        Permission::create([
            'name' => 'platform.mobile-app',
        ]);

        Permission::create([
            'name' => 'platform.web-app',
        ]);

        $role = Role::create(['name' => 'super-admin']);
        
        $role->givePermissionTo(Permission::all());
                
                
        $user = BackpackUser::Create([
            'email' => 'rodogonzalez.cr@gmail.com',
            'name' => 'Admin',            
            'password' => bcrypt('secret')
        ]);

        //$user->assignRole('super-admin');
        SELF::create_stores();

    }
}
