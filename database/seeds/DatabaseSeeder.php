<?php

use App\Site;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    /**
     * @var array
     */
    private $tables = array(
        'categories',
        'sites',
        'users'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('en_US');
        
        Model::unguard();

        $this->cleanDatabase();

        //$this->call('ConstantsTableSeeder');

        $geopattern = new \RedeyeVentures\GeoPattern\GeoPattern();


        Site::truncate();
        unset($sites);
        $sites = [];

        for ( $i=1; $i<=30; $i++ )
        {
            $title = $faker->sentence(2);
            $geopattern->setString($title);
            $dataURL = $geopattern->toDataURL();
            $sites[] = [
                'id' => $i,
                'category_id' => $faker->randomElement(array_merge([factory(App\Category::class)->create()->id], App\Category::lists('id')->all())),
                'title' => $title,
                'url' => $faker->url,
                'icon_path' => '',
                'color' => $faker->colorName,
                'background_image' => $dataURL
            ];
        }

        //$sites = factory(Site::class, 1000)->make();

        Site::insert($sites);

        Model::reguard();

    }

    public function cleanDatabase()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}