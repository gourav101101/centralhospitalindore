<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Video extends Model
{
    protected $fillable = ['title', 'youtube_id', 'description', 'is_active', 'sort_order'];
    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];
    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('sort_order')->orderByDesc('id'); }
    public function getYoutubeUrlAttribute(): string { return 'https://www.youtube.com/watch?v='.$this->youtube_id; }
    public function getEmbedUrlAttribute(): string { return 'https://www.youtube-nocookie.com/embed/'.$this->youtube_id; }

    public static function idFromUrl(string $url): ?string
    {
        $parts = parse_url(trim($url));
        if (!$parts || !in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https'], true) || isset($parts['user']) || isset($parts['pass']) || isset($parts['port'])) {
            return null;
        }
        $host = strtolower($parts['host'] ?? '');
        $path = trim($parts['path'] ?? '', '/');
        $id = null;
        if (in_array($host, ['youtu.be', 'www.youtu.be'], true)) {
            $id = $path;
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com'], true)) {
            if ($path === 'watch') {
                parse_str($parts['query'] ?? '', $query);
                $id = $query['v'] ?? null;
            } elseif (preg_match('~^(?:shorts|embed|live)/([A-Za-z0-9_-]{11})$~', $path, $match)) {
                $id = $match[1];
            }
        }
        return is_string($id) && preg_match('/^[A-Za-z0-9_-]{11}$/', $id) ? $id : null;
    }
}
