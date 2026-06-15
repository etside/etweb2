<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceDetailController extends Controller
{
    public function show($slug)
    {
        $services = [
            'enterprise-saas' => [
                'title' => 'Enterprise & SaaS Solutions Development | Custom Software',
                'heading' => 'Enterprise & SaaS Solutions',
                'description' => 'Build scalable, secure enterprise systems tailored to your operations.',
                'icon' => '🏢',
                'overview' => 'From custom CRM systems to full enterprise resource planning (ERP), we build large-scale software solutions that streamline your operations, increase efficiency, and drive profitability.',
                'use_cases' => [
                    'Customer Relationship Management (CRM) systems',
                    'Human Resource Management (HRM) systems',
                    'Enterprise Resource Planning (ERP)',
                    'Business Intelligence & Analytics platforms',
                    'Multi-tenant SaaS applications',
                    'White-label software solutions'
                ],
                'tech_stack' => [
                    'Backend' => ['Node.js', 'Laravel', 'Django'],
                    'Frontend' => ['React', 'Vue.js', 'Angular'],
                    'Databases' => ['PostgreSQL', 'MongoDB', 'MySQL'],
                    'Cloud' => ['AWS', 'Google Cloud', 'Azure'],
                    'DevOps' => ['Docker', 'Kubernetes', 'CI/CD']
                ],
                'timeline' => '3-6 months',
                'pricing_model' => 'Fixed price or T&M',
                'process' => [
                    'Discovery & Requirements (Week 1-2)',
                    'System Design & Architecture (Week 3-4)',
                    'Development in 2-week sprints',
                    'Quality Assurance & Testing',
                    'Deployment & Training',
                    'Post-launch Support (30 days free)'
                ]
            ],
            'web-mobile-apps' => [
                'title' => 'Web & Mobile App Development | Custom Applications',
                'heading' => 'Web & Mobile Apps',
                'description' => 'Responsive, high-performance applications that delight users.',
                'icon' => '📱',
                'overview' => 'From responsive web applications to native mobile apps, we build fast, intuitive digital products that engage users and drive business results.',
                'use_cases' => [
                    'Progressive Web Apps (PWA)',
                    'Cross-platform mobile apps',
                    'Single Page Applications (SPA)',
                    'Social networking platforms',
                    'Marketplace and auction platforms',
                    'Real-time collaboration tools'
                ],
                'tech_stack' => [
                    'Web' => ['React', 'Next.js', 'Vue.js'],
                    'Mobile' => ['React Native', 'Flutter', 'Swift/Kotlin'],
                    'Backend' => ['Node.js', 'Firebase', 'Django'],
                    'Databases' => ['Firebase', 'MongoDB', 'PostgreSQL'],
                    'Tools' => ['Webpack', 'Vite', 'Redux/Context API']
                ],
                'timeline' => '6-12 weeks',
                'pricing_model' => 'Fixed price or T&M',
                'process' => [
                    'App Strategy & Planning',
                    'UI/UX Design & Prototyping',
                    'API Development',
                    'App Development (iOS/Android/Web)',
                    'Testing & QA',
                    'App Store Submission',
                    'Post-launch Support'
                ]
            ],
            'ui-ux-design' => [
                'title' => 'UI/UX Design Services | User-Centered Design',
                'heading' => 'UI/UX, Graphics & Motion',
                'description' => 'Beautiful designs that users love and convert.',
                'icon' => '🎨',
                'overview' => 'Award-winning design work that transforms user experiences. From research to pixel-perfect interfaces, we create digital products people love to use.',
                'use_cases' => [
                    'User Experience (UX) Research & Strategy',
                    'User Interface (UI) Design',
                    'Brand Identity & Guidelines',
                    'Motion Graphics & Animations',
                    'Design System Creation',
                    'Usability Testing & Iteration'
                ],
                'tech_stack' => [
                    'Design Tools' => ['Figma', 'Adobe XD', 'Adobe CC'],
                    'Prototyping' => ['Figma', 'Prototype.app'],
                    'User Research' => ['UserTesting', 'Surveys', 'Analytics'],
                    'Animation' => ['After Effects', 'Lottie'],
                    'Frontend' => ['HTML/CSS', 'React', 'Vue.js']
                ],
                'timeline' => '4-8 weeks',
                'pricing_model' => 'Project-based',
                'process' => [
                    'User Research & Discovery',
                    'Information Architecture',
                    'Wireframing & Prototyping',
                    'High-Fidelity Design',
                    'Design System Documentation',
                    'Usability Testing',
                    'Design Handoff & Support'
                ]
            ],
            'consulting' => [
                'title' => 'Technology Consulting | Digital Strategy',
                'heading' => 'Technology Consulting & Strategy',
                'description' => 'Expert guidance on tech decisions and digital transformation.',
                'icon' => '💼',
                'overview' => 'Navigate complex technology decisions with confidence. Our consultants help you choose the right tech stack, design scalable architectures, and plan successful digital transformations.',
                'use_cases' => [
                    'Technology Stack Selection',
                    'System Architecture Design',
                    'Code Review & Optimization',
                    'Digital Transformation Planning',
                    'Legacy System Modernization',
                    'Performance & Security Audits'
                ],
                'tech_stack' => [
                    'Expertise' => ['Full-stack development', 'Cloud architecture', 'DevOps', 'Security', 'Performance optimization'],
                    'Tools' => ['Analytics', 'Monitoring', 'Testing tools'],
                ],
                'timeline' => '1-4 weeks',
                'pricing_model' => 'Daily rates or retainer',
                'process' => [
                    'Discovery & Assessment',
                    'Analysis & Recommendations',
                    'Roadmap Creation',
                    'Implementation Support',
                    'Training & Handoff'
                ]
            ],
            'staff-augmentation' => [
                'title' => 'Staff Augmentation | Hire Dedicated Developers',
                'heading' => 'Staff Augmentation',
                'description' => 'Scale your team with vetted, experienced engineers.',
                'icon' => '👥',
                'overview' => 'Hire dedicated developers who integrate seamlessly with your team. Faster than recruiting, more flexible than full-time hires. No recruiting overhead.',
                'use_cases' => [
                    'Scale development team on-demand',
                    'Fill specific skill gaps (React, DevOps, etc.)',
                    'Accelerate project timelines',
                    'Access specialized expertise',
                    'Long-term team augmentation',
                    'Short-term project acceleration'
                ],
                'tech_stack' => [
                    'Specialists Available' => ['Frontend engineers', 'Backend engineers', 'Full-stack developers', 'QA engineers', 'DevOps engineers', 'UI/UX designers'],
                    'Technologies' => ['React, Vue, Angular', 'Node.js, Laravel, Django', 'AWS, GCP, Azure', 'MongoDB, PostgreSQL', 'Flutter, React Native']
                ],
                'timeline' => '2 weeks onboarding',
                'pricing_model' => 'Monthly retainer',
                'process' => [
                    'Define Team Requirements',
                    'Candidate Screening & Matching',
                    'Interview & Selection',
                    '1-week Onboarding',
                    'Integrated with Your Team',
                    'Flexible Scaling Up/Down'
                ]
            ],
            'mvp-development' => [
                'title' => 'MVP Development | Launch in 8-12 Weeks',
                'heading' => 'MVP Development',
                'description' => 'Validate your startup idea with a market-ready MVP in 8-12 weeks.',
                'icon' => '🚀',
                'overview' => 'Get your product to market fast. Our accelerated MVP development process combines rapid prototyping, agile development, and continuous user feedback to deliver market-ready products.',
                'use_cases' => [
                    'Startup MVP development',
                    'Product concept validation',
                    'Pilot testing for new features',
                    'Rapid market entry',
                    'Investor pitch product',
                    'Proof of concept development'
                ],
                'tech_stack' => [
                    'Stack' => ['React/Next.js', 'Node.js', 'Firebase/AWS', 'MongoDB', 'Stripe'],
                    'Approach' => ['Rapid prototyping', 'No-code tools where possible', 'Open-source libraries', 'MVP-focused architecture']
                ],
                'timeline' => '8-12 weeks',
                'pricing_model' => 'Fixed price',
                'process' => [
                    'Week 1: Planning & Design Sprint',
                    'Weeks 2-8: Core Feature Development',
                    'Weeks 9-10: Quality Assurance & Refinement',
                    'Weeks 11-12: Launch Preparation & Beta Release',
                    'Post-Launch: User Feedback Collection'
                ]
            ]
        ];

        if (!isset($services[$slug])) {
            abort(404, 'Service not found');
        }

        $service = $services[$slug];

        return view('service.show', compact('service'));
    }
}
