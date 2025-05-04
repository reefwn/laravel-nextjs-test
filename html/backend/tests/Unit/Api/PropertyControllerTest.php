<?php

namespace Tests\Unit\Api;

use App\Models\Property;
use App\Models\GeoLocation;
use App\Models\PhotoSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the properties endpoint without parameters.
     *
     * @return void
     */
    public function test_get_properties_default()
    {
        // Create some test data
        Property::factory()->count(30)->create();

        // Send GET request to the properties endpoint
        $response = $this->json('GET', '/api/properties');

        // Assert that the response status is OK
        $this->assertEquals(200, $response->status());

        // Assert that the response has the correct structure
        $response->assertJsonStructure([
            'data',
            'current_page',
            'last_page',
            'per_page',
            'total'
        ]);

        // Assert that the number of properties per page is 25 (default)
        $response->assertJsonFragment(['per_page' => 25]);
    }

    /**
     * Test the properties endpoint with pagination.
     *
     * @return void
     */
    public function test_get_properties_with_pagination()
    {
        // Create some test data
        Property::factory()->count(30)->create();

        // Send GET request with page and per_page parameters
        $response = $this->json('GET', '/api/properties', [
            'page' => 2,
            'per_page' => 10
        ]);

        // Assert that the response status is OK
        $this->assertEquals(200, $response->status());

        // Assert that the response has correct pagination
        $response->assertJsonFragment(['current_page' => 2]);
        $response->assertJsonFragment(['per_page' => 10]);
    }

    /**
     * Test the properties endpoint with search by title.
     *
     * @return void
     */
    public function test_search_properties_by_title()
    {
        // Create a test property
        Property::factory()->create([
            'title' => '2 bedroom Condo for sale in Samut Prakan'
        ]);

        // Send GET request with title search
        $response = $this->json('GET', '/api/properties', [
            'title' => '2 bedroom Condo'
        ]);

        // Assert that the response contains the correct property
        $this->assertEquals(200, $response->status());
        $response->assertJsonFragment([
            'title' => '2 bedroom Condo for sale in Samut Prakan'
        ]);
    }

    /**
     * Test the properties endpoint with search by location.
     *
     * @return void
     */
    public function test_search_properties_by_location()
    {
        $geoLocation = GeoLocation::factory()->create([
            'country' => 'Thailand',
            'province' => 'Samut Prakan',
            'street' => '132 Vidal Greens, Clarkside, ND 13872',
        ]);

        $photoSet = PhotoSet::factory()->create([
            'thumb' => 'https://via.placeholder.com/150x100.png',
            'search' => 'https://via.placeholder.com/300x150.png',
            'full' => 'https://via.placeholder.com/600x300.png',
        ]);

        // Create a test property
        Property::factory()->create([
            'geo_location_id' => $geoLocation->id,
            'photo_set_id' => $photoSet->id,
        ]);

        // Send GET request with location search
        $response = $this->json('GET', '/api/properties', [
            'location' => 'Samut'
        ]);

        // Assert that the response contains the correct property
        $this->assertEquals(200, $response->status());
        $response->assertJsonFragment([
            'geo_location' => [
                'id' => $geoLocation->id,
                'country' => 'Thailand',
                'province' => 'Samut Prakan',
                'street' => '132 Vidal Greens, Clarkside, ND 13872',
                'created_at' => $geoLocation->created_at->toJson(),
                'updated_at' => $geoLocation->updated_at->toJson(),
            ]
        ]);
    }

    /**
     * Test the properties endpoint with sorting by price.
     *
     * @return void
     */
    public function test_sort_properties_by_price()
    {
        // Create some test properties
        Property::factory()->create(['price' => 500000]);
        Property::factory()->create(['price' => 1000000]);

        // Send GET request with sort_by=price and sort_order=asc
        $response = $this->json('GET', '/api/properties', [
            'sort_by' => 'price',
            'sort_order' => 'asc'
        ]);

        // Assert that the properties are sorted by price in ascending order
        $this->assertEquals(200, $response->status());
        $properties = $response->json('data');
        $this->assertTrue($properties[0]['price'] <= $properties[1]['price']);
    }

    /**
     * Test the properties endpoint with sorting by created_at.
     *
     * @return void
     */
    public function test_sort_properties_by_created_at()
    {
        // Create some test properties
        Property::factory()->create(['created_at' => now()->subDays(2)]);
        Property::factory()->create(['created_at' => now()]);

        // Send GET request with sort_by=created_at and sort_order=desc
        $response = $this->json('GET', '/api/properties', [
            'sort_by' => 'created_at',
            'sort_order' => 'desc'
        ]);

        // Assert that the properties are sorted by created_at in descending order
        $this->assertEquals(200, $response->status());
        $properties = $response->json('data');
        $this->assertTrue($properties[0]['created_at'] >= $properties[1]['created_at']);
    }

    /**
     * Test the properties endpoint with no results.
     *
     * @return void
     */
    public function test_no_properties_found()
    {
        // Send GET request with a non-existing title
        $response = $this->json('GET', '/api/properties', [
            'title' => 'Non-existing title'
        ]);

        // Assert that the response status is 404
        $this->assertEquals(404, $response->status());

        // Assert that the response contains the correct message
        $response->assertJsonFragment(['message' => 'No properties found']);
    }
}
