<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'id' => 1,
                'category' => 'Pricing & Engagement',
                'question' => 'What is your pricing model?',
                'answer' => 'We offer flexible engagement models: hourly rates for consulting, fixed-price projects for well-defined scopes, and dedicated team augmentation on monthly retainers. We provide custom quotes based on your project requirements and timeline.'
            ],
            [
                'id' => 2,
                'category' => 'Pricing & Engagement',
                'question' => 'Do you offer staff augmentation services?',
                'answer' => 'Yes! Our staff augmentation service lets you scale your development team quickly with vetted engineers. We can have dedicated developers integrated with your team within 2 weeks. Available for short-term projects or long-term engagements.'
            ],
            [
                'id' => 3,
                'category' => 'Pricing & Engagement',
                'question' => 'What is your minimum project duration?',
                'answer' => 'We work on projects of any size. Consulting engagements can start from a single week, while development projects typically have a 4-week minimum to ensure proper planning and delivery quality.'
            ],
            [
                'id' => 4,
                'category' => 'Pricing & Engagement',
                'question' => 'Do you offer payment flexibility?',
                'answer' => 'Yes. We accept milestone-based payments, monthly invoicing for retainers, and can discuss custom payment schedules for long-term engagements. We typically require a 30% upfront deposit to kickstart projects.'
            ],
            [
                'id' => 5,
                'category' => 'Project Management',
                'question' => 'What is your typical project timeline?',
                'answer' => 'MVP development typically takes 8-12 weeks depending on complexity. Enterprise solutions: 3-6 months. Mobile apps: 6-8 weeks. Custom integrations: 2-4 weeks. We provide detailed timelines during the discovery phase.'
            ],
            [
                'id' => 6,
                'category' => 'Project Management',
                'question' => 'Do you work with existing code or legacy systems?',
                'answer' => 'Absolutely. We specialize in upgrading legacy systems, API integrations, and code refactoring. We\'ll assess your current setup during discovery and provide a modernization roadmap tailored to your business needs.'
            ],
            [
                'id' => 7,
                'category' => 'Project Management',
                'question' => 'What is your development process?',
                'answer' => 'We follow an Agile/Scrum methodology with bi-weekly sprints. Each sprint includes planning, development, testing, and stakeholder reviews. You get full transparency through weekly updates and can request changes anytime.'
            ],
            [
                'id' => 8,
                'category' => 'Project Management',
                'question' => 'How do you handle scope changes?',
                'answer' => 'We welcome scope adjustments. Changes are tracked in our sprint planning, and we\'ll communicate any impact on timeline and budget. If significant, we\'ll provide an updated estimate and revised timeline.'
            ],
            [
                'id' => 9,
                'category' => 'Technology & Architecture',
                'question' => 'What technologies do you specialize in?',
                'answer' => 'Frontend: React, Vue.js, Next.js, Flutter. Backend: Node.js, Laravel, Django, Python. Databases: PostgreSQL, MongoDB, MySQL. Cloud: AWS, Google Cloud, Azure. We choose the best tech stack for your specific use case.'
            ],
            [
                'id' => 10,
                'category' => 'Technology & Architecture',
                'question' => 'Do you provide technology consulting?',
                'answer' => 'Yes. Our consultants help you evaluate technology options, design scalable architectures, and plan technical migrations. We can conduct 1-2 week discovery audits to identify optimization opportunities and provide a roadmap.'
            ],
            [
                'id' => 11,
                'category' => 'Security & Compliance',
                'question' => 'How do you ensure data security?',
                'answer' => 'We follow industry best practices: end-to-end encryption, secure authentication protocols, regular security audits, and compliance with data protection regulations. For fintech/healthcare projects, we implement industry-specific compliance (PCI-DSS, HIPAA, etc.).'
            ],
            [
                'id' => 12,
                'category' => 'Security & Compliance',
                'question' => 'Do you sign NDAs?',
                'answer' => 'Of course. We sign mutual NDAs for all projects as standard practice. Your intellectual property and business information remain completely confidential and secure.'
            ],
            [
                'id' => 13,
                'category' => 'Maintenance & Support',
                'question' => 'Do you provide post-launch support?',
                'answer' => 'Yes. We offer 30 days of free support post-launch. After that, we provide tiered support packages: 4-hour response SLA, 24-hour response SLA, or dedicated support teams on retainer. You can choose what fits your needs.'
            ],
            [
                'id' => 14,
                'category' => 'Maintenance & Support',
                'question' => 'What is your SLA for production issues?',
                'answer' => 'Critical issues (app down): 4-hour response. High (major feature broken): 8-hour response. Medium: 24-hour response. On premium support plans, we guarantee these SLAs; standard plans are best-effort.'
            ]
        ];

        $categories = collect($faqs)->pluck('category')->unique()->sort();

        return view('faq.index', compact('faqs', 'categories'));
    }
}
