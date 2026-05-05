<?php

namespace Database\Seeders;

use App\Models\ClientReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientReview::create([
            'client_name' => 'Sarah Jenkins',
            'position_company' => 'CTO, FinTech Global',
            'review_text' => 'The server deployment was seamless. Their technical team understands enterprise requirements perfectly.',
            'rating' => 5.0,
        ]);

        ClientReview::create([
            'client_name' => 'Mark Zhang',
            'position_company' => 'IT Manager, EduStream',
            'review_text' => 'Reliable hardware and excellent post-purchase support. Highly recommended.',
            'rating' => 4.5,
        ]);
    }
}
