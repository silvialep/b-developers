<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $advertisements = [
            [
                'name' => 'Standard',
                'description' => 'La sponsorizzazione standard, per avere il tuo profilo in evidenza per 24 ore',
                'price' => 2.99,
            ],
            [
                'name' => 'Gold',
                'description' => 'La sponsorizzazione per chi vuole emergere e avere per 72 ore il profilo in evidenza',
                'price' => 5.99,
            ],
            [
                'name' => 'Premium',
                'description' => 'La sponsorizzazione premium, per ottenere il massimo della visibilità e avere il tuo profilo in evidenza per 144 ore',
                'price' => 9.99,
            ]
              
        ];

        foreach ($advertisements as $advertisement) {

            $newAdvertisement = new Advertisement();

            $newAdvertisement->name = $advertisement['name'];
            $newAdvertisement->slug = Str::slug($newAdvertisement->name, '-');
            $newAdvertisement->description = $advertisement['description'];
            $newAdvertisement->price = $advertisement['price'];
            

            $newAdvertisement->save();
        }
    }
}
