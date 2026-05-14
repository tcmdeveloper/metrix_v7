<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new State();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'code' => $item->code,      
                'name' => $item->name,      
                'slug' => $item->slug
            ]);
        }
        


        // SEED FROM ARRAY

        // $model = new State();

        // $items = [
        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'AL',
        //         'name' => 'Alabama',
        //         'slug' => Str::slug('Alabama'),
                
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'AK',
        //         'name' => 'Alaska',
        //         'slug' => Str::slug('Alaska'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'AZ',
        //         'name' => 'Arizona',
        //         'slug' => Str::slug('Arizona'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'AR',
        //         'name' => 'Arkansas',
        //         'slug' => Str::slug('Arkansas'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'CA',
        //         'name' => 'California',
        //         'slug' => Str::slug('California'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'CO',
        //         'name' => 'Colorado',
        //         'slug' => Str::slug('Colorado'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'CT',
        //         'name' => 'Connecticut',
        //         'slug' => Str::slug('Connecticut'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'DE',
        //         'name' => 'Delaware',
        //         'slug' => Str::slug('Delaware'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'FL',
        //         'name' => 'Florida',
        //         'slug' => Str::slug('Florida'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'GA',
        //         'name' => 'Florida',
        //         'slug' => Str::slug('Florida'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'HI',
        //         'name' => 'Hawaii',
        //         'slug' => Str::slug('Hawaii'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'ID',
        //         'name' => 'Idaho',
        //         'slug' => Str::slug('Idaho'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'IL',
        //         'name' => 'Illinois',
        //         'slug' => Str::slug('Illinois'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'IN',
        //         'name' => 'Indiana',
        //         'slug' => Str::slug('Indiana'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'IA',
        //         'name' => 'Iowa',
        //         'slug' => Str::slug('Iowa'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'KS',
        //         'name' => 'Kansas',
        //         'slug' => Str::slug('Kansas'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'KY',
        //         'name' => 'Kentucky',
        //         'slug' => Str::slug('Kentucky'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'LA',
        //         'name' => 'Louisiana',
        //         'slug' => Str::slug('Louisiana'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'ME',
        //         'name' => 'Maine',
        //         'slug' => Str::slug('Maine'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MH',
        //         'name' => 'Marshall Islands',
        //         'slug' => Str::slug('Marshall Islands'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MD',
        //         'name' => 'Maryland',
        //         'slug' => Str::slug('Maryland'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MA',
        //         'name' => 'Massachusetts',
        //         'slug' => Str::slug('Massachusetts'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MI',
        //         'name' => 'Michigan',
        //         'slug' => Str::slug('Michigan'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MN',
        //         'name' => 'Minnesota',
        //         'slug' => Str::slug('Minnesota'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MS',
        //         'name' => 'Mississippi',
        //         'slug' => Str::slug('Mississippi'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MO',
        //         'name' => 'Missouri',
        //         'slug' => Str::slug('Missouri'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'MT',
        //         'name' => 'Montana',
        //         'slug' => Str::slug('Montana'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NE',
        //         'name' => 'Nebraska',
        //         'slug' => Str::slug('Nebraska'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NV',
        //         'name' => 'Nevada',
        //         'slug' => Str::slug('Nevada'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NH',
        //         'name' => 'New Hampshire',
        //         'slug' => Str::slug('New Hampshire'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NJ',
        //         'name' => 'New Jersey',
        //         'slug' => Str::slug('New Jersey'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NM',
        //         'name' => 'New Mexico',
        //         'slug' => Str::slug('New Mexico'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NY',
        //         'name' => 'New York',
        //         'slug' => Str::slug('New York'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'NC',
        //         'name' => 'North Carolina',
        //         'slug' => Str::slug('North Carolina'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'ND',
        //         'name' => 'North Dakota',
        //         'slug' => Str::slug('North Dakota'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'OH',
        //         'name' => 'Ohio',
        //         'slug' => Str::slug('Ohio'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'OK',
        //         'name' => 'Oklahoma',
        //         'slug' => Str::slug('Oklahoma'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'OR',
        //         'name' => 'Oregon',
        //         'slug' => Str::slug('Oregon'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'PA',
        //         'name' => 'Pennsylvania',
        //         'slug' => Str::slug('Pennsylvania'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'RI',
        //         'name' => 'Rhode Island',
        //         'slug' => Str::slug('Rhode Island'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'SC',
        //         'name' => 'South Carolina',
        //         'slug' => Str::slug('South Carolina'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'SD',
        //         'name' => 'South Dakota',
        //         'slug' => Str::slug('South Dakota'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'TN',
        //         'name' => 'Tennessee',
        //         'slug' => Str::slug('Tennessee'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'TX',
        //         'name' => 'Texas',
        //         'slug' => Str::slug('Texas'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'UT',
        //         'name' => 'Utah',
        //         'slug' => Str::slug('Utah'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'VT',
        //         'name' => 'Vermont',
        //         'slug' => Str::slug('Vermont'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'VI',
        //         'name' => 'Virgin Islands',
        //         'slug' => Str::slug('Virgin Islands'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'VA',
        //         'name' => 'Virginia',
        //         'slug' => Str::slug('Virginia'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'WA',
        //         'name' => 'Washington',
        //         'slug' => Str::slug('Washington'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'WV',
        //         'name' => 'West Virginia',
        //         'slug' => Str::slug('West Virginia'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'WI',
        //         'name' => 'Wisconsin',
        //         'slug' => Str::slug('Wisconsin'),
        //     ],

        //     [
        //         'hex' => Str::random(11),
        //         'code' => 'WY',
        //         'name' => 'Wyoming',
        //         'slug' => Str::slug('Wyoming'),
        //     ],

        // ];

        // foreach($items as $item){
        //     $model::create($item);
        // }
    }
}
