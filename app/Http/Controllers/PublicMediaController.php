<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PublicMediaController extends Controller
{
    /**
     * Serve uploads created before media was moved to the public uploads directory.
     */
    public function legacy(string $folder, string $filename)
    {
        abort_unless(in_array($folder, ['blogs', 'testimonials'], true), 404);
        abort_unless(basename($filename) === $filename, 404);

        $path = $folder . '/' . $filename;
        abort_unless(Storage::disk('public')->exists($path), 404);

        return response()->file(Storage::disk('public')->path($path));
    }
}
