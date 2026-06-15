<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function show($slug)
    {
        $industries = [
            'fintech' => [
                'name' => 'Fintech',
                'title' => 'Fintech Software Development | Secure Payment & Banking Solutions',
                'description' => 'Build scalable fintech platforms with secure APIs, KYC/AML compliance, and real-time payments.',
                'headline' => 'Fintech Solutions Built for Trust',
                'tagline' => 'From micro-lending platforms to digital wallets, we build secure, compliant fintech solutions.',
                'challenges' => [
                    'Regulatory compliance (AML, KYC, PCI-DSS)',
                    'Real-time transaction processing',
                    'Secure data encryption and audit trails',
                    'Integration with multiple payment gateways',
                    'High availability and disaster recovery'
                ],
                'solutions' => [
                    'Custom payment gateway integration',
                    'KYC/AML automated workflows',
                    'Blockchain for settlements (optional)',
                    'Mobile wallets and USSD services',
                    'Real-time analytics dashboards'
                ],
                'tech_stack' => ['Node.js', 'PostgreSQL', 'AWS', 'React', 'Mobile Banking APIs'],
                'case_study_title' => 'How we built a micro-loan platform processing 10K+ daily transactions',
                'results' => [
                    'Processed $50M+ in transactions annually',
                    '99.9% uptime maintained',
                    'KYC verification in under 2 minutes',
                    'Reduced fraud by 95% with ML detection'
                ]
            ],
            'healthcare' => [
                'name' => 'Healthcare',
                'title' => 'Healthcare Software Development | HIPAA Compliant Solutions',
                'description' => 'Secure telemedicine platforms, patient management systems, and health data analytics.',
                'headline' => 'Healthcare Technology for Better Care',
                'tagline' => 'Telemedicine, patient records, and appointment systems that comply with HIPAA.',
                'challenges' => [
                    'HIPAA compliance and data privacy',
                    'Patient data security and encryption',
                    'Interoperability with existing EHR systems',
                    'Telemedicine with low latency',
                    'Mobile health record access'
                ],
                'solutions' => [
                    'HIPAA-compliant cloud infrastructure',
                    'End-to-end encrypted messaging',
                    'Video consultation platform',
                    'Prescription management system',
                    'Patient analytics and reporting'
                ],
                'tech_stack' => ['Node.js', 'React', 'PostgreSQL', 'WebRTC', 'AWS HealthLake'],
                'case_study_title' => 'Telemedicine platform serving 100K+ patients across Bangladesh',
                'results' => [
                    '100K+ active users',
                    '50K+ consultations monthly',
                    '4.8/5 patient satisfaction',
                    'Average consultation time: 15 minutes'
                ]
            ],
            'logistics' => [
                'name' => 'Logistics & Supply Chain',
                'title' => 'Logistics Software | Real-time Fleet & Delivery Management',
                'description' => 'GPS tracking, route optimization, and fleet management systems that reduce costs.',
                'headline' => 'Logistics Software That Cuts Costs',
                'tagline' => 'Real-time tracking, route optimization, and delivery management for modern fleets.',
                'challenges' => [
                    'Real-time GPS tracking and geofencing',
                    'Route optimization for fuel efficiency',
                    'Driver behavior monitoring',
                    'Supply chain visibility',
                    'Integration with multiple carrier APIs'
                ],
                'solutions' => [
                    'Real-time fleet tracking dashboard',
                    'AI-powered route optimization',
                    'Delivery proof-of-delivery (POD) system',
                    'Driver mobile app with offline capability',
                    'Analytics for delivery performance'
                ],
                'tech_stack' => ['Node.js', 'React', 'Redis', 'PostgreSQL', 'Google Maps API', 'Flutter'],
                'case_study_title' => 'Fleet management system reducing logistics costs by 25%',
                'results' => [
                    'Cost reduction: 25% fuel savings',
                    'Delivery time optimization: 20% faster',
                    '500+ vehicles tracked in real-time',
                    '99.5% on-time delivery rate'
                ]
            ],
            'ecommerce' => [
                'name' => 'E-Commerce',
                'title' => 'E-Commerce Platform Development | High-Converting Online Stores',
                'description' => 'Custom e-commerce platforms with payment integration, inventory management, and analytics.',
                'headline' => 'E-Commerce Platforms That Convert',
                'tagline' => 'Scalable shopping experiences with secure payments, inventory sync, and customer analytics.',
                'challenges' => [
                    'High traffic handling (peak seasons)',
                    'Payment gateway integration and security',
                    'Inventory synchronization across channels',
                    'Fast checkout process (cart abandonment)',
                    'International shipping and tax calculations'
                ],
                'solutions' => [
                    'Headless e-commerce architecture',
                    'Multi-currency, multi-language support',
                    'Advanced inventory management',
                    'One-page checkout experience',
                    'Product recommendation engine'
                ],
                'tech_stack' => ['Next.js', 'Node.js', 'Stripe/SSLCommerz', 'PostgreSQL', 'Elasticsearch'],
                'case_study_title' => 'Beauty marketplace platform generating $2M annual GMV',
                'results' => [
                    '$2M+ annual GMV',
                    '50K+ products listed',
                    '100K+ monthly active users',
                    '3.2% average conversion rate'
                ]
            ],
            'education' => [
                'name' => 'Education Technology',
                'title' => 'EdTech Software Development | Learning Management Systems',
                'description' => 'Virtual classrooms, course management, and student analytics platforms.',
                'headline' => 'Education Technology for Remote Learning',
                'tagline' => 'Learning management systems, virtual classrooms, and student progress tracking.',
                'challenges' => [
                    'Live class stability (low latency)',
                    'Course content delivery optimization',
                    'Student progress tracking and analytics',
                    'Assessment and grading automation',
                    'Parent-teacher communication'
                ],
                'solutions' => [
                    'Live video conferencing with screen sharing',
                    'Adaptive learning paths',
                    'Automated grading system',
                    'Student performance analytics',
                    'Mobile app for learning on-the-go'
                ],
                'tech_stack' => ['React', 'Node.js', 'WebRTC', 'MongoDB', 'Stripe'],
                'case_study_title' => 'Online learning platform with 50K+ students',
                'results' => [
                    '50K+ enrolled students',
                    '200+ courses offered',
                    '95% course completion rate',
                    '4.7/5 student satisfaction'
                ]
            ]
        ];

        if (!isset($industries[$slug])) {
            abort(404, 'Industry not found');
        }

        $industry = $industries[$slug];

        return view('industry.show', compact('industry'));
    }

    public function index()
    {
        $industries = [
            ['slug' => 'fintech', 'name' => 'Fintech', 'icon' => 'credit-card'],
            ['slug' => 'healthcare', 'name' => 'Healthcare', 'icon' => 'heart'],
            ['slug' => 'logistics', 'name' => 'Logistics', 'icon' => 'truck'],
            ['slug' => 'ecommerce', 'name' => 'E-Commerce', 'icon' => 'shopping-cart'],
            ['slug' => 'education', 'name' => 'Education', 'icon' => 'book-open']
        ];

        return view('industry.index', compact('industries'));
    }
}
