<?php

namespace App\Console\Commands;

use App\Models\Postcard;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create xml sitemap';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $postcard_sitemap = Sitemap::create();
        Postcard::where('is_draft', 0)
            ->where(function ($query) {
                $query->where('offline_at', '>', now())
                    ->orWhereNull('offline_at');
            })->each(function (Postcard $postcard) use ($postcard_sitemap){
                $postcard_sitemap->add(
                    Url::create("/postcards/{$postcard->id}")->setLastModificationDate($postcard->updated_at)
                );
            });
        $postcard_sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
