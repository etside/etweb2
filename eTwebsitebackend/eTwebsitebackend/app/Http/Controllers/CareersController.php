<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareersController extends Controller
{
    public function index()
    {
        $openings = [
            [
                'id' => 1,
                'title' => 'Senior Full-Stack Developer (React + Node.js)',
                'department' => 'Engineering',
                'location' => 'Dhaka, Bangladesh (Hybrid)',
                'level' => 'Senior',
                'type' => 'Full-time',
                'description' => 'We\'re looking for an experienced full-stack engineer to lead development on our enterprise SaaS projects. You\'ll mentor junior developers, architect scalable solutions, and work directly with clients.',
                'requirements' => [
                    '5+ years of professional development experience',
                    'Strong proficiency in React.js and Node.js',
                    'Experience with PostgreSQL and MongoDB',
                    'AWS/GCP cloud deployment experience',
                    'Excellent communication and leadership skills'
                ],
                'benefits' => [
                    'Competitive salary (500K - 700K+ BDT/month based on experience)',
                    'Performance bonuses (up to 3 months)',
                    'Professional development budget (50K BDT/year)',
                    'Hybrid work arrangement (3 days office, 2 remote)',
                    'Health insurance for you and family',
                    'Annual paid leave (15 days + 2 casual)',
                    'Laptop and development tools provided'
                ]
            ],
            [
                'id' => 2,
                'title' => 'Mobile App Developer (React Native/Flutter)',
                'department' => 'Engineering',
                'location' => 'Dhaka, Bangladesh (Hybrid)',
                'level' => 'Mid-Level',
                'type' => 'Full-time',
                'description' => 'Join our mobile team to build cross-platform applications for fintech, logistics, and e-commerce clients. You\'ll work on greenfield projects and enhance existing apps.',
                'requirements' => [
                    '3+ years mobile app development experience',
                    'Proficiency in React Native or Flutter',
                    'Strong JavaScript/Dart knowledge',
                    'Experience with mobile APIs and third-party integrations',
                    'Version control (Git) experience'
                ],
                'benefits' => [
                    'Competitive salary (350K - 500K BDT/month)',
                    'Performance bonuses',
                    'Learning budget for new frameworks/tools',
                    'Flexible work hours',
                    'Health insurance',
                    'Annual paid leave (15 days)',
                    'Laptop and mobile testing devices'
                ]
            ],
            [
                'id' => 3,
                'title' => 'UI/UX Designer',
                'department' => 'Design',
                'location' => 'Dhaka, Bangladesh (On-site)',
                'level' => 'Mid-Level',
                'type' => 'Full-time',
                'description' => 'Create beautiful, user-centered designs for web and mobile applications. You\'ll collaborate with developers, conduct user research, and iterate on designs based on feedback.',
                'requirements' => [
                    '3+ years in UI/UX design',
                    'Proficiency in Figma (or similar design tools)',
                    'Strong portfolio demonstrating design thinking',
                    'Understanding of responsive design and accessibility',
                    'Experience with user research/testing'
                ],
                'benefits' => [
                    'Competitive salary (300K - 450K BDT/month)',
                    'Performance bonuses',
                    'Design tool licenses provided',
                    'Creative freedom on projects',
                    'Health insurance',
                    'Annual paid leave (15 days)',
                    'Collaborate with international design teams'
                ]
            ]
        ];

        $stats = [
            ['label' => 'Current Team Size', 'value' => '40+'],
            ['label' => 'Years in Industry', 'value' => '5+'],
            ['label' => 'Countries with Team Members', 'value' => '8+'],
            ['label' => 'Average Tenure', 'value' => '3.5 years']
        ];

        return view('careers.index', compact('openings', 'stats'));
    }
}
