<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * NOTE: min_members/max_members below are reasonable defaults for team sports —
     * adjust them to match SLSU Sogod's actual intramurals roster rules before
     * registration opens (e.g. official 5x5 basketball bench size, volleyball
     * roster cap, mass dance minimum, relay team size, etc). Individual events
     * are min=max=1.
     *
     * Gender is no longer split at the category level — it's captured per member
     * on the registration form instead, so each sport/event has just one row.
     */
    public function run(): void
    {
        $categories = [
            // Sports
            ['Badminton', 'Sports', 1, 1],
            ['Basketball 5x5', 'Sports', 1, 12],
            ['Basketball 3x3', 'Sports', 1, 6],
            ['Chess', 'Sports', 1, 1],
            ['Futsal', 'Sports', 1, 10],
            ['Lawn Tennis', 'Sports', 1, 1],
            ['Swimming', 'Sports', 1, 1],
            ['Table Tennis', 'Sports', 1, 1],
            ['Volleyball', 'Sports', 1, 12],
            ['Beach Volleyball', 'Sports', 1, 4],
            ['Baseball', 'Sports', 1, 15],
            ['Football', 'Sports', 1, 18],
            ['Softball', 'Sports', 1, 15],

            // Athletics — track & field
            ['100m Sprint', 'Athletics', 1, 1],
            ['200m Sprint', 'Athletics', 1, 1],
            ['400m Sprint', 'Athletics', 1, 1],
            ['4x100m Relay', 'Athletics', 1, 4],
            ['4x400m Relay', 'Athletics', 1, 4],
            ['Long Jump', 'Athletics', 1, 1],
            ['Triple Jump', 'Athletics', 1, 1],
            ['Shot Put', 'Athletics', 1, 1],
            ['Discus', 'Athletics', 1, 1],
            ['Javelin', 'Athletics', 1, 1],

            // Visual Arts — individual
            ['On the Spot Poster Making', 'Visual Arts', 1, 1],
            ['Pencil Drawing', 'Visual Arts', 1, 1],
            ['Charcoal Rendering', 'Visual Arts', 1, 1],
            ['Painting', 'Visual Arts', 1, 1],

            // Music
            ['Pop Solo', 'Music', 1, 1],
            ['Vocal Duet', 'Music', 1, 2],
            ['Vocal Solo Kundiman', 'Music', 1, 1],
            ['Song Writing', 'Music', 1, 3],
            ['Piano', 'Music', 1, 1],

            // Literary-Musical
            ['Declamation', 'Literary-Musical', 1, 1],
            ['Extemporaneous Speaking', 'Literary-Musical', 1, 1],
            ['Essay Writing', 'Literary-Musical', 1, 1],
            ['Short and Sweet Play Dialog', 'Literary-Musical', 1, 6],
            ['Pangdalawahang Pag-arte', 'Literary-Musical', 1, 2],

            // Dance
            ['Mass Dance', 'Dance', 1, 30],
            ['Folk Dance', 'Dance', 1, 20],
            ['Pop Dance', 'Dance', 1, 20],
            ['Dance Sports - Latin/American', 'Dance', 1, 2],
            ['Dance Sports - Standard', 'Dance', 1, 2],
            ['Dance Sports - Third Kind', 'Dance', 1, 2],
        ];

        foreach ($categories as [$name, $group, $min, $max]) {
            Category::create([
                'name' => $name,
                'group' => $group,
                'gender_division' => 'Open',
                'min_members' => $min,
                'max_members' => $max,
                'is_open' => true,
            ]);
        }
    }
}
