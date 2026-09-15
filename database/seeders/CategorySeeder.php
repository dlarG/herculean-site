<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // ─────────────────────────────────────────────────────
        // STEP 1 — Parents with variants (the "cards" that open
        // a dropdown when registering)
        // ─────────────────────────────────────────────────────
        $parentsWithVariants = [
            // name,           group,       sort
            ['Basketball',     'Sports',    10],
            ['Volleyball',     'Sports',    20],
            ['Sprint',         'Athletics', 10],
            ['Runs',           'Athletics', 30],
            ['Relay',          'Athletics', 20],
            ['Dance Sports',   'Dance',     10],
            ['Mass Dance',      'Dance',    20],
        ];

        $parentIds = [];
        foreach ($parentsWithVariants as [$name, $group, $sort]) {
            $parent = Category::create([
                'name'                => $name,
                'group'               => $group,
                'gender_division'     => 'Open',
                'min_members'         => 1,
                'max_members'         => 1,
                'is_open'             => true,
                'parent_id'           => null,
                'has_variants'        => true,
                'sort_order'          => $sort,
                'is_team_event'       => false, // parents are navigational only, never registered directly
            ]);
            $parentIds[$name] = $parent->id;
        }

        // ─────────────────────────────────────────────────────
        // STEP 2 — Children (the variants that show in the
        // second dropdown on the register page)
        // ─────────────────────────────────────────────────────
        $children = [
            // [parent,        name,                             group,       min, max, sort]
            ['Basketball',     'Basketball 5x5',                'Sports',     1, 12,  1],
            ['Basketball',     'Basketball 3x3',                'Sports',     1, 6,   2],
            ['Volleyball',     'Volleyball',                    'Sports',     1, 12,  1],
            ['Volleyball',     'Beach Volleyball',              'Sports',     1, 4,   2],
            ['Sprint',         '100m Sprint',                   'Athletics',  1, 1,   1],
            ['Sprint',         '200m Sprint',                   'Athletics',  1, 1,   2],
            ['Sprint',         '400m Sprint',                   'Athletics',  1, 1,   3],
            ['Relay',          '4x100m Relay',                  'Athletics',  1, 4,   1],
            ['Relay',          '4x400m Relay',                  'Athletics',  1, 4,   2],
            ['Runs',           '5K Run',                        'Athletics',  1, 1,   1],
            ['Runs',           '10K Run',                       'Athletics',  1, 1,   2],
            ['Runs',           '21K Half Marathon',             'Athletics',  1, 1,   3],
            ['Runs',           '42K Full Marathon',             'Athletics',  1, 1,   4],
            ['Dance Sports',   'Dance Sports - Latin/American', 'Dance',      1, 2,   1],
            ['Dance Sports',   'Dance Sports - Standard',       'Dance',      1, 2,   2],
            ['Dance Sports',   'Dance Sports - Third Kind',     'Dance',      1, 2,   3],
            ['Mass Dance',     'Dancer',                        'Dance',      1, 40,  1],
            ['Mass Dance',     'Propsmen',                      'Dance',      1, 10,   2],
        ];

        foreach ($children as [$parentName, $name, $group, $min, $max, $sort]) {
            Category::create([
                'name'            => $name,
                'group'           => $group,
                'gender_division' => 'Open',
                'min_members'     => $min,
                'max_members'     => $max,
                'is_open'         => true,
                'parent_id'       => $parentIds[$parentName],
                'has_variants'    => false,
                'sort_order'      => $sort,
                'is_team_event'   => $max > 1,
            ]);
        }

        // ─────────────────────────────────────────────────────
        // STEP 3 — Standalone categories (no variants, just a
        // card that goes straight to the member form)
        // ─────────────────────────────────────────────────────
        $standalone = [
            // Sports
            ['Badminton',              'Sports',           1, 1,   30],
            ['Chess',                  'Sports',           1, 1,   40],
            ['Futsal',                 'Sports',           1, 10,  50],
            ['Lawn Tennis',            'Sports',           1, 1,   60],
            ['Swimming',               'Sports',           1, 1,   70],
            ['Table Tennis',           'Sports',           1, 1,   80],
            ['Baseball',               'Sports',           1, 15,  90],
            ['Football',               'Sports',           1, 18, 100],
            ['Softball',               'Sports',           1, 15, 110],

            // Athletics — those without variants
            ['Long Jump',              'Athletics',        1, 1,   30],
            ['Triple Jump',            'Athletics',        1, 1,   40],
            ['Shot Put',               'Athletics',        1, 1,   50],
            ['Discus',                 'Athletics',        1, 1,   60],
            ['Javelin',                'Athletics',        1, 1,   70],

            // Visual Arts
            ['On the Spot Poster Making', 'Visual Arts',   1, 1,   10],
            ['Pencil Drawing',            'Visual Arts',   1, 1,   20],
            ['Charcoal Rendering',        'Visual Arts',   1, 1,   30],
            ['Painting',                  'Visual Arts',   1, 1,   40],

            // Music
            ['Pop Solo',               'Music',            1, 1,   10],
            ['Vocal Duet',             'Music',            1, 2,   20],
            ['Vocal Solo Kundiman',    'Music',            1, 1,   30],
            ['Song Writing',           'Music',            1, 3,   40],
            ['Piano',                  'Music',            1, 1,   50],

            // Literary-Musical
            ['Declamation',                 'Literary-Musical', 1, 1, 10],
            ['Extemporaneous Speaking',     'Literary-Musical', 1, 1, 20],
            ['Essay Writing',               'Literary-Musical', 1, 1, 30],
            ['Short and Sweet Play Dialog', 'Literary-Musical', 1, 6, 40],
            ['Pangdalawahang Pag-arte',     'Literary-Musical', 1, 2, 50],

            // Dance — those without variants
            ['Folk Dance',             'Dance',            1, 20,  30],
            ['Pop Dance',              'Dance',            1, 20,  40],
        ];

        foreach ($standalone as [$name, $group, $min, $max, $sort]) {
            Category::create([
                'name'            => $name,
                'group'           => $group,
                'gender_division' => 'Open',
                'min_members'     => $min,
                'max_members'     => $max,
                'is_open'         => true,
                'parent_id'       => null,
                'has_variants'    => false,
                'sort_order'      => $sort,
                'is_team_event'   => $max > 1,
            ]);
        }
    }
}