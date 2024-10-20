<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'nip' => $this->faker->numerify('##########'),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'birth_date' => $this->faker->date(),
            'birth_place' => $this->faker->city,
            'no_telp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'position' => $this->faker->randomElement(['Guru Matematika', 'Guru Bahasa Indonesia', 'Guru Bahasa Inggris', 'Guru Biology', 'Guru Fisika', 'Guru Kimia', 'Guru Sejarah', 'Guru Geografi', 'Guru Ekonomi', 'Guru Sosiologi', 'Guru Seni Budaya', 'Guru Olahraga', 'Guru Informatika']),
            'about' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['tenaga pendidik', 'tenaga kependidikan']),
            'facebook' => $this->faker->url,
            'instagram' => $this->faker->url,
            'twitter' => $this->faker->url,
            'linkedin' => $this->faker->url,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'meta_keywords' => $this->faker->sentence,
        ];
    }
}
