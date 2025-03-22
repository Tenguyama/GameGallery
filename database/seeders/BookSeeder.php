<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * use RAWG for seeding sample games info for database
         */
        $games = Http::get('https://api.rawg.io/api/games', [
            'key' => env('RAWG_API_KEY'),
            'page_size' => 40,
        ])->json();
//        dd($games);
        foreach ($games['results'] as $game) {
            Book::create([
                'title' => $game['name'],
                'developer' => $game['developers'][0]['name'] ?? ($game['publishers'][0]['name'] ?? 'Unknown'),
                'genre' => implode(', ', array_map(fn($genre) => $genre['name'], $game['genres'])),
                'release_date' => $game['released'],
                'platform' => implode(', ', array_map(fn($platform) => $platform['platform']['name'], $game['platforms'])),
                'price' => rand(10, 100),
                'img_url' => $game['background_image'] ?? null,
            ]);
        }
    }
}
