<?php

namespace Tests\Feature;

use App\Models\Postcard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_search_with_full_title(): void
    {
        $postcard = Postcard::where('is_draft', 0)
            ->where(function ($query) {
                $query->where('offline_at', '>', now())
                    ->orWhereNull('offline_at');
            })->first();
        $postcard_title = $postcard->title;
        $response = $this->get('/search?keywords=' . $postcard_title);

        $response->assertStatus(200)->assertSee($postcard_title);
    }
}
