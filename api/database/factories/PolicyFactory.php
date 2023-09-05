<?php

namespace Database\Factories;

use App\Models\Policy;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Policy>
 */
class PolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Policy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $investment_house = ['Old Mutual International', 'New Mutual International'];

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'code' => $this->generateUniqueNumericCode(50),
            'plan_reference' => $this->faker->streetAddress(),
            'investment_house' => $this->faker->randomElement($investment_house),
        ];
    }

    /**
     * Generate a unique numeric code of specified length.
     *
     * @param int $length
     * @return string
     */
    protected function generateUniqueNumericCode($length): string
    {
        $maxAttempts = 100;
        $uniqueCodes = [];

        for ($i = 0; $i < $maxAttempts; $i++) {
            $code = Str::random($length);

            if (!in_array($code, $uniqueCodes)) {
                return $code;
            }
        }

        throw new Exception("OOps");
    }
}
