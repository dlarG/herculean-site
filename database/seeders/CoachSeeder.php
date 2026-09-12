<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coach;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoachSeeder extends Seeder
{
    /**
     * Coach name → list of categories they handle.
     * Excludes: Muse & Escort, Faculty GAM, Student GAM, Banner Raising,
     * GAM, Printing of Banner, Google Site, Official Herculean Dragon Site,
     * Food - Meals & Snacks, Miscellaneous Expenses.
     */
    public function run(): void
    {
        $assignments = [
            'Gerald Catina'            => ['100m Sprint', '200m Sprint', '400m Sprint', '4x100m Relay', '4x400m Relay', 'Long Jump', 'Triple Jump', 'Shot Put', 'Discus', 'Javelin'],
            'John Ryan Mangmang'       => ['100m Sprint', '200m Sprint', '400m Sprint', '4x100m Relay', '4x400m Relay', 'Long Jump', 'Triple Jump', 'Shot Put', 'Discus', 'Javelin', 'Table Tennis'],
            'Mark Clarence Intal'      => ['Badminton'],
            'Edevan Jay Magdula'       => ['Badminton', 'Pop Dance'],
            'Joedee Mark Rodriguez'    => ['Baseball', 'Football'],
            'Geraldine Mangmang'       => ['Baseball'],
            'Jorton Tagud'             => ['Basketball 5x5', 'Basketball 3x3'],
            'Renee Clint Gortifacion'  => ['Basketball 5x5', 'Basketball 3x3'],
            'Alex Bacalla'             => ['Chess', 'Swimming'],
            'Jerson Maasin'            => ['Chess'],
            'Loravel Amizona'          => ['Football'],
            'Keano Nikko Sy'           => ['Futsal'],
            'Christian Jay Vaarquez'   => ['Futsal'],
            'Shella Mae Sagaldia'      => ['Lawn Tennis'],
            'Evelyn Oro'               => ['Lawn Tennis'],
            'Maricel Costillas'        => ['Softball'],
            'Warren Joseph Campijiyos' => ['Softball'],
            'Jimson A. Olaybar'        => ['Swimming'],
            'Jannie Fleur Oranio'      => ['Table Tennis'],
            'Steven Epis'              => ['Volleyball', 'Beach Volleyball'],
            'Florentino Gozo'          => ['Volleyball', 'Beach Volleyball'],
            'Kristin Espita'           => ['On the Spot Poster Making', 'Pencil Drawing', 'Charcoal Rendering', 'Painting', 'Pop Solo', 'Vocal Duet', 'Vocal Solo Kundiman', 'Song Writing', 'Piano'],
            'Jordan Arca'              => ['On the Spot Poster Making', 'Pencil Drawing', 'Charcoal Rendering', 'Painting'],
            'Elmandy Olantigue'        => ['Pop Solo', 'Vocal Duet', 'Vocal Solo Kundiman', 'Song Writing', 'Piano'],
            'Zenny Abella'             => ['Pop Solo', 'Vocal Duet', 'Vocal Solo Kundiman', 'Song Writing', 'Piano'],
            'Lucila Bacalla'           => ['Pop Solo', 'Vocal Duet', 'Vocal Solo Kundiman', 'Song Writing', 'Piano'],
            'Jasmin Dayunan'           => ['Pop Solo', 'Vocal Duet', 'Vocal Solo Kundiman', 'Song Writing', 'Piano'],
            'Gia Caro'                 => ['Declamation'],
            'Jomarie Salar'            => ['Extemporaneous Speaking', 'Essay Writing', 'Short and Sweet Play Dialog', 'Pangdalawahang Pag-arte'],
            'Dinah Catamco'            => ['Extemporaneous Speaking', 'Essay Writing', 'Short and Sweet Play Dialog', 'Pangdalawahang Pag-arte'],
            'Alma Arnijo'              => ['Extemporaneous Speaking', 'Essay Writing', 'Short and Sweet Play Dialog', 'Pangdalawahang Pag-arte'],
            'Kent Torion'              => ['Extemporaneous Speaking', 'Essay Writing', 'Short and Sweet Play Dialog', 'Pangdalawahang Pag-arte'],
            'Gilbert Siega'            => ['Mass Dance'],
            'Christian Erol Bandalan'  => ['Folk Dance', 'Dance Sports - Latin/American', 'Dance Sports - Standard', 'Dance Sports - Third Kind'],
            'Rose Mae Ugat'            => ['Folk Dance'],
            'Jerald Tomboc'            => ['Pop Dance'],
            'Joedezza Mae Pilapil'     => ['Pop Dance'],
            'Rhoderick Malangsa'       => ['Dance Sports - Latin/American', 'Dance Sports - Standard', 'Dance Sports - Third Kind'],
            'Joshua Obtiar'            => ['Dance Sports - Latin/American', 'Dance Sports - Standard', 'Dance Sports - Third Kind'],
            'Darwin Dangcalan'            => ['Dance Sports - Latin/American', 'Dance Sports - Standard', 'Dance Sports - Third Kind'],
        ];

        foreach ($assignments as $name => $categoryNames) {
            $username = $this->makeUsername($name);

            $coach = Coach::updateOrCreate(
                ['username' => $username],
                [
                    'name'                 => $name,
                    'password'             => Hash::make('12345'),
                    'must_change_password' => true,
                ]
            );

            $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id')->toArray();
            $coach->categories()->sync($categoryIds);
        }
    }

    /**
     * Build a username from a name.
     * "Gerald Catina" → "gcatina"
     * "John Ryan Mangmang" → "jmangmang"
     * "Kristin Espita" → "kespita"
     */
    private function makeUsername(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name));

        // First initial of first name + last word (surname)
        $firstInitial = strtolower(substr($parts[0], 0, 1));
        $surname = strtolower(preg_replace('/[^a-z]/i', '', end($parts)));

        // Handle duplicates in your seed if needed (append number)
        return $firstInitial . $surname;
    }
}