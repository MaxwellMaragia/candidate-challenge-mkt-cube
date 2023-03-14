<?php

namespace Tests\Feature;

use App\Models\Postcard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostcardStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_online_postcard_is_displayed(): void
    {
        $postcard = Postcard::where('is_draft', 0)
            ->where(function ($query) {
                $query->where('offline_at', '>', now())
                    ->orWhereNull('offline_at');
            })->first();
        $response = $this->get(route('postcards.show',$postcard->id));
        $response->assertStatus(200);
        $response->assertSee($postcard->title);
    }
}
