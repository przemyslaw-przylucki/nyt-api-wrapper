<?php

namespace Tests\Feature;

use Http;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class NewYorkTimeBestSellerControllerTest extends TestCase
{
    /**
     * @test
     */
    public function ibn_must_be_either_10_or_13_characters_in_length_for_every_occurrence()
    {
        Http::fake();

        $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=123456789');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('isbn.0');

        $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=1234567890');

        $response->assertStatus(200)
            ->assertJsonMissingValidationErrors('isbn.0');

        $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=1234567890123');

        $response->assertStatus(200)
            ->assertJsonMissingValidationErrors('isbn.0');

        $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=12345678901234');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('isbn.0');

        $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=1234567890123&isbn[]=12345678901234');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('isbn.1');
    }

    /**
     * @test
     */
    public function offset_must_be_an_integer()
    {
        Http::fake();

        $response = $this->getJson('/api/1/nyt/best-sellers?offset=abc');

        $response->assertStatus(422)
            ->assertJsonPath('errors.offset.0', 'The offset must be an integer.')
            ->assertJsonValidationErrors('offset');
    }

    /**
     * @test
     */
    public function offset_must_be_at_least_0_and_multitude_of_20()
    {
        Http::fake();

        $response = $this->getJson('/api/1/nyt/best-sellers?offset=-1');

        $response->assertStatus(422)
            ->assertJsonPath('errors.offset.0', 'The offset must be a multiple of 20.')
            ->assertJsonPath('errors.offset.1', 'The offset must be at least 0.')
            ->assertJsonValidationErrors('offset');
    }

    /**
     * @test
     */
    public function isbn_must_be_an_array()
    {
        Http::fake();

        $response = $this->getJson('/api/1/nyt/best-sellers?isbn=abc');

        $response->assertStatus(422)
            ->assertJsonPath('errors.isbn.0', 'The isbn must be an array.')
            ->assertJsonValidationErrors('isbn');
    }

    /**
     * @test
     */
    public function user_can_filter_by_isbn()
    {
        Http::fake([
            'api.nytimes.com/*' => Http::response((array) json_decode(
                    '{
                        "num_results": 1,
                        "results": [
                            {
                                "title": "THE LUCKY ONE",
                                "description": "A Marine returning home sets out to track down the woman whose photo he found in Iraq.",
                                "contributor": "by Nicholas Sparks",
                                "author": "Nicholas Sparks",
                                "contributor_note": "",
                                "price": "0.00",
                                "age_group": "",
                                "publisher": "Grand Central",
                                "isbns": [
                                    {
                                        "isbn10": "0446618322",
                                        "isbn13": "9780446618328"
                                    }
                                ]
                            }
                        ]
                    }'
                )
            )
        ]);

        $this->getJson('/api/1/nyt/best-sellers?isbn[]=0446618322')
            ->assertJsonPath('results.0.isbns.0.isbn10', '0446618322');
    }
}
