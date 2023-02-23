<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remember>
 */
class RememberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Montaña',
            'description' => 'Lo importante de tener un recuerdo es volver a vivirlo y disfrutar las emociones otra vez.',
            'image'=> 'efbgfgrfbref',
            
            
            
        ];
    }
}
