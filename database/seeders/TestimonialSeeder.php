<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'John Doe',
                'profession' => 'Web Developer',
                'message' => 'Working with FASTER has been incredible. They delivered our cargo on time and with excellent service.',
                'is_active' => true,
                'display_order' => 1
            ],
            [
                'name' => 'Jane Smith',
                'profession' => 'Business Owner',
                'message' => 'As a small business owner, reliable shipping is crucial. FASTER has never let me down.',
                'is_active' => true,
                'display_order' => 2
            ],
            [
                'name' => 'Michael Johnson',
                'profession' => 'Operations Manager',
                'message' => 'Our company has worked with many logistics providers, but FASTER stands out for their professionalism and efficiency.',
                'is_active' => true,
                'display_order' => 3
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}