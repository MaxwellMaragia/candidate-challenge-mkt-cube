<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsTxtController extends Controller
{
    public function index(){
        $robotsTxtContent = "User-agent: *\nDisallow: /admin\nSitemap: " . url('sitemap.xml');
        return new Response($robotsTxtContent, 200, ['Content-Type' => 'text/plain']);
    }
}
