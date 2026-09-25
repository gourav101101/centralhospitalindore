<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brochure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBrochureController extends Controller
{
    public function index()
    {
        return view('admin.brochures.index', [
            'brochure' => Brochure::latest()->first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brochure' => 'required|file|mimes:pdf|max:15360',
        ]);

        $file = $request->file('brochure');
        $filename = $file->hashName();
        $uploadDirectory = $this->webUploadPath('uploads/brochures');
        File::ensureDirectoryExists($uploadDirectory);
        $file->move($uploadDirectory, $filename);

        $previousBrochure = Brochure::latest()->first();
        $brochure = Brochure::create([
            'file_path' => 'uploads/brochures/' . $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

        if ($previousBrochure) {
            $this->removeUploadedFile($previousBrochure);
            $previousBrochure->delete();
        }

        return redirect()->route('admin.brochures.index')
            ->with('success', 'Brochure uploaded successfully.');
    }

    public function destroy(Brochure $brochure)
    {
        $this->removeUploadedFile($brochure);
        $brochure->delete();

        return redirect()->route('admin.brochures.index')
            ->with('success', 'Brochure deleted successfully.');
    }

    private function removeUploadedFile(Brochure $brochure): void
    {
        if (str_starts_with($brochure->file_path, 'uploads/brochures/')) {
            File::delete($this->webUploadPath($brochure->file_path));
        }
    }

    private function webUploadPath(string $relativePath): string
    {
        return rtrim(config('filesystems.web_root'), DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR . ltrim($relativePath, DIRECTORY_SEPARATOR);
    }
}
