<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Get an existing user as owner
        $owner = User::first(); // Fetch the first user

        if (!$owner) {
            $this->command->info('No users found! Please create a user first.');
            return;
        }

        // Sample properties with local images
        $properties = [
            [
                'owner_id' => $owner->id,
                'title' => 'Luxury Villa in Nairobi',
                'description' => 'A spacious villa with modern amenities.',
                'location' => 'Nairobi, Kenya',
                'property_type' => 'house',
                'price' => 25000000,
                'image' => 'properties/villa_nairobi.jpg', // Local image
                'status' => 'available',
                'is_featured' => true,
            ],
            [
                'owner_id' => $owner->id,
                'title' => 'Beachfront Apartment in Mombasa',
                'description' => 'A stunning apartment with ocean views.',
                'location' => 'Mombasa, Kenya',
                'property_type' => 'apartment',
                'price' => 18000000,
                'image' => 'properties/apartment_mombasa.jpg', // Local image
                'status' => 'available',
                'is_featured' => false,
            ],
            [
                'owner_id' => $owner->id,
                'title' => 'Prime Commercial Space in Kisumu',
                'description' => 'Ideal for businesses and offices.',
                'location' => 'Kisumu, Kenya',
                'property_type' => 'commercial',
                'price' => 35000000,
                'image' => 'properties/commercial_kisumu.jpg', // Local image
                'status' => 'available',
                'is_featured' => true,
            ],
            [
                'owner_id' => $owner->id,
                'title' => 'Affordable Land in Nakuru',
                'description' => 'A perfect plot for farming or development.',
                'location' => 'Nakuru, Kenya',
                'property_type' => 'land',
                'price' => 5000000,
                'image' => 'properties/land_nakuru.jpg', // Local image
                'status' => 'sold',
                'is_featured' => false,
            ],
        ];

        // Insert properties into the database
        Property::insert($properties);
    }
}
