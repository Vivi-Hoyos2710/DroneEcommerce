<?php

declare(strict_types=1);

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CreateProductRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreateProductRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_passes_validation_with_valid_data(): void
    {
        $data = [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->sentence,
            'category' => $this->faker->word,
            'size' => $this->faker->word,
            'brand' => $this->faker->word,
            'image' => UploadedFile::fake()->image('test.jpg'),
        ];

        $request = new CreateProductRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_validation_with_invalid_data(): void
    {
        $data = [
            'name' => '',
            'price' => 'not a number',
            'description' => '',
            'category' => '',
            'size' =>  '',
            'brand' => '',
            'image' => UploadedFile::fake()->create('test.txt'),
        ];

        $request = new CreateProductRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());   
        $this->assertCount(8, $validator->errors());
    }
}