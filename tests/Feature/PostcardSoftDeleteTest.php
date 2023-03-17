<?php

namespace Tests\Feature;

use App\Models\Postcard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostcardSoftDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_soft_deleted_postcard_redirects_to_301_status_page(): void
    {
        $softDeletedPostcard = Postcard::withTrashed()->onlyTrashed()->inRandomOrder()->first();
        $response = $this->get(route('postcards.show',$softDeletedPostcard->id));
        $response->assertStatus(301);
    }
}
