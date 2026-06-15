<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CornerstoneBlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::first() ?? User::create([
            'name' => 'engineersTech',
            'email' => 'info@engineerstechbd.com',
            'password' => bcrypt('password'),
        ]);

        $posts = [
            [
                'slug' => 'top-10-software-development-companies-bangladesh-2025',
                'title' => 'Top 10 Software Development Companies in Bangladesh 2025',
                'excerpt' => 'A comprehensive guide to the leading software development companies in Bangladesh. Compare services, expertise, and find the perfect partner for your project.',
                'category' => 'Industry',
                'content' => 'The software development industry in Bangladesh has grown exponentially over the past decade...',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
            [
                'slug' => 'cost-building-fintech-app-bangladesh',
                'title' => 'How Much Does It Cost to Build a Fintech App in Bangladesh?',
                'excerpt' => 'Detailed breakdown of fintech app development costs in Bangladesh. From MVP to full-scale platform, understand pricing models and what to expect.',
                'category' => 'Business',
                'content' => 'Fintech is one of the fastest-growing sectors in Bangladesh, with digital payment solutions...',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'slug' => 'staff-augmentation-vs-project-outsourcing',
                'title' => 'Staff Augmentation vs. Project Outsourcing: Which is Right for You?',
                'excerpt' => 'Compare staff augmentation and project outsourcing models. Understand when to use each approach and what works best for your business needs.',
                'category' => 'Business',
                'content' => 'Companies face a critical decision when scaling their development capacity...',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'slug' => 'case-study-logistics-cost-reduction',
                'title' => 'Case Study: Reducing Logistics Costs by 25% with Real-Time Tracking',
                'excerpt' => 'How a Bangladeshi logistics company reduced operational costs by 25% using our custom GPS tracking and route optimization system.',
                'category' => 'Case Study',
                'content' => 'NexLog (anonymized name) is a logistics company operating 200+ vehicles across Bangladesh...',
                'author_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
