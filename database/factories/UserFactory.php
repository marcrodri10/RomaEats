<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('es_ES')->firstName(),
            'surname' => fake('es_ES')->lastName(),
            'email' => fake('es_ES')->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'address' => fake()->randomElement(array(
                "Carrer de Sant Antoni, 23, 1r 1a",
                "Avinguda Diagonal, 145, 2n 3a",
                "Carrer dels Encants, 76, Principal 2a",
                "Rambla de Catalunya, 89, Entresòl 1r",
                "Travessera de Gràcia, 201, Àtic 2n",
                "Carrer de la Marina, 37, Baixos",
                "Passeig de Sant Joan, 112, 3r 2a",
                "Carrer del Consell de Cent, 59, Local 1r",
                "Gran Via de les Corts Catalanes, 415, 4t 1a",
                "Carrer de Balmes, 199, 1r 2a"
            )),
            'phone' => fake('es_ES')->phoneNumber(),
            'role_id' => 2,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
