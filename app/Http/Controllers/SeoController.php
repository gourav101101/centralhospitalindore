<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Doctor;

class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = collect(['home', 'about', 'doctors', 'services', 'contact', 'appointment',
            'gallery', 'downloads', 'health-library', 'patient-stories', 'patient-guide', 'privacy', 'terms'])
            ->map(fn ($name) => route($name));
        foreach (Doctor::active()->get() as $doctor) {
            $urls->push(route('doctor.profile', $doctor));
        }
        foreach (Blog::published()->get() as $blog) {
            $urls->push(route('health-article', $blog));
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls->unique() as $url) {
            $xml .= '<url><loc>'.htmlspecialchars($url, ENT_XML1, 'UTF-8').'</loc></url>';
        }

        return response($xml.'</urlset>', 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots()
    {
        return response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".route('sitemap')."\n", 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
