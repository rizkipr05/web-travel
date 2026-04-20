<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        Offer::insert([
            [
                'title' => 'Umroh Hemat Ramadhan',
                'description' => 'Paket Umroh 9 Hari dengan fasilitas hotel bintang 3 dan penerbangan langsung.',
                'price' => 28500000,
                'image_url' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?auto=format&fit=crop&w=800&q=80',
                'expiry_date' => now()->addMonths(2),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Wisata Turki & Cappadocia',
                'description' => 'Jelajahi keindahan sejarah Istanbul dan keajaiban alam Cappadocia selama 10 hari.',
                'price' => 18900000,
                'image_url' => 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?auto=format&fit=crop&w=800&q=80',
                'expiry_date' => now()->addMonths(1),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Eksplorasi Maladewa',
                'description' => 'Liburan mewah di resort terapung Maladewa dengan aktivitas snorkeling dan diving.',
                'price' => 15500000,
                'image_url' => 'https://images.unsplash.com/photo-1544550581-5f7ceaf7f992?auto=format&fit=crop&w=800&q=80',
                'expiry_date' => now()->addMonths(3),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
