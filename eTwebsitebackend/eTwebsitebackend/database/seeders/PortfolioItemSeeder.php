<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolioItems = [
            [
                'title' => 'Symlex VPN',
                'slug' => 'symlex-vpn',
                'category' => 'VPN App Development',
                'description' => 'A comprehensive VPN application providing secure internet connectivity with high-speed servers across multiple countries. Features include multi-protocol support, kill switch, and advanced privacy controls.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Symlex+VPN',
                'logo_url' => 'https://via.placeholder.com/100x100?text=Symlex',
                'client_name' => 'Symlex',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'BPC Fleet Management System',
                'slug' => 'bpc-fleet-management',
                'category' => 'Fleet Management',
                'description' => 'Enterprise-grade fleet management platform enabling real-time GPS tracking, vehicle diagnostics, maintenance scheduling, and driver performance analytics. Designed for logistics companies managing 100+ vehicles.',
                'image_url' => 'https://via.placeholder.com/800x600?text=BPC+Fleet',
                'logo_url' => 'https://via.placeholder.com/100x100?text=BPC',
                'client_name' => 'Business Process Consulting',
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'RexVPN',
                'slug' => 'rexvpn',
                'category' => 'VPN App Development',
                'description' => 'Next-generation VPN application combining VPN services with eSIM functionality for seamless global connectivity. Features include one-click activation and integrated mobile carrier switching.',
                'image_url' => 'https://via.placeholder.com/800x600?text=RexVPN',
                'logo_url' => 'https://via.placeholder.com/100x100?text=RexVPN',
                'client_name' => 'RexVPN Inc',
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'VPN One Click',
                'slug' => 'vpn-one-click',
                'category' => 'VPN App Development',
                'description' => 'User-friendly VPN client with one-tap connection feature. Designed for maximum simplicity without compromising security. Includes automatic server selection and bandwidth optimization.',
                'image_url' => 'https://via.placeholder.com/800x600?text=VPN+One+Click',
                'logo_url' => 'https://via.placeholder.com/100x100?text=VPN',
                'client_name' => 'VPN One Click',
                'featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'NTrack Fleet Management',
                'slug' => 'ntrack-fleet-management',
                'category' => 'Fleet Management',
                'description' => 'Advanced fleet management solution featuring custom telematics platform. Provides route optimization, fuel consumption tracking, predictive maintenance, and real-time alerts for fleet operators.',
                'image_url' => 'https://via.placeholder.com/800x600?text=NTrack+Fleet',
                'logo_url' => 'https://via.placeholder.com/100x100?text=NTrack',
                'client_name' => 'NTrack Systems',
                'featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'SecPath VPN',
                'slug' => 'secpath-vpn',
                'category' => 'VPN App Development',
                'description' => 'Enterprise VPN solution combined with integrated password vault. Provides secure remote access for businesses with centralized credential management and audit logging.',
                'image_url' => 'https://via.placeholder.com/800x600?text=SecPath+VPN',
                'logo_url' => 'https://via.placeholder.com/100x100?text=SecPath',
                'client_name' => 'SecPath',
                'featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'ecommerce-platform',
                'category' => 'Web Development',
                'description' => 'Full-featured e-commerce platform with inventory management, payment gateway integration, and mobile responsiveness. Built with scalability and performance optimization in mind.',
                'image_url' => 'https://via.placeholder.com/800x600?text=E-Commerce',
                'logo_url' => 'https://via.placeholder.com/100x100?text=E-Com',
                'client_name' => 'Online Retail Co',
                'featured' => false,
                'sort_order' => 7,
            ],
            [
                'title' => 'Mobile App for Fitness Tracking',
                'slug' => 'fitness-tracking-app',
                'category' => 'Mobile App Development',
                'description' => 'iOS and Android fitness tracking application with wearable device integration, real-time analytics, and personalized workout recommendations powered by AI.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Fitness+App',
                'logo_url' => 'https://via.placeholder.com/100x100?text=Fitness',
                'client_name' => 'FitLife',
                'featured' => false,
                'sort_order' => 8,
            ],
            [
                'title' => 'Education Management System',
                'slug' => 'education-cms',
                'category' => 'Educational CMS',
                'description' => 'Comprehensive learning management system for educational institutions. Includes student management, course creation, assignment submission, and real-time collaboration tools.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Education+CMS',
                'logo_url' => 'https://via.placeholder.com/100x100?text=Education',
                'client_name' => 'EduTech Solutions',
                'featured' => false,
                'sort_order' => 9,
            ],
            [
                'title' => 'UI/UX Design System',
                'slug' => 'ui-ux-design-system',
                'category' => 'UI/UX Design',
                'description' => 'Complete design system and component library for SaaS platforms. Includes responsive components, design tokens, and comprehensive documentation for developers and designers.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Design+System',
                'logo_url' => 'https://via.placeholder.com/100x100?text=Design',
                'client_name' => 'DesignCorp',
                'featured' => false,
                'sort_order' => 10,
            ],
            [
                'title' => 'Business VPN Solution',
                'slug' => 'business-vpn',
                'category' => 'Business VPN',
                'description' => 'Enterprise VPN solution designed for businesses with multi-office environments. Provides secure site-to-site connectivity and centralized management console.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Business+VPN',
                'logo_url' => 'https://via.placeholder.com/100x100?text=BizVPN',
                'client_name' => 'Corporate Networks Inc',
                'featured' => false,
                'sort_order' => 11,
            ],
            [
                'title' => 'Gaming VPN Protocol',
                'slug' => 'gaming-vpn',
                'category' => 'Gaming VPN',
                'description' => 'Optimized VPN protocol specifically for online gaming. Features low latency, reduced packet loss, and DDoS protection for competitive gaming environments.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Gaming+VPN',
                'logo_url' => 'https://via.placeholder.com/100x100?text=GamerVPN',
                'client_name' => 'GameShield',
                'featured' => false,
                'sort_order' => 12,
            ],
            [
                'title' => 'MVP Development for Startups',
                'slug' => 'startup-mvp',
                'category' => 'MVP Development',
                'description' => 'Rapid MVP development for early-stage startups. Built with agile methodology focusing on quick time-to-market and essential features validation.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Startup+MVP',
                'logo_url' => 'https://via.placeholder.com/100x100?text=StartupMVP',
                'client_name' => 'StartupHub',
                'featured' => false,
                'sort_order' => 13,
            ],
            [
                'title' => 'Enterprise ERP System',
                'slug' => 'enterprise-erp',
                'category' => 'ERP Solutions',
                'description' => 'Large-scale ERP implementation integrating accounting, inventory, HR, and supply chain management. Customized for manufacturing and distribution enterprises.',
                'image_url' => 'https://via.placeholder.com/800x600?text=Enterprise+ERP',
                'logo_url' => 'https://via.placeholder.com/100x100?text=ERP',
                'client_name' => 'Manufacturing Co',
                'featured' => false,
                'sort_order' => 14,
            ],
            [
                'title' => 'White Label VPN Solution',
                'slug' => 'white-label-vpn',
                'category' => 'White Label VPN',
                'description' => 'Customizable white-label VPN platform for resellers and ISPs. Includes branded mobile apps, web portal, and billing integration.',
                'image_url' => 'https://via.placeholder.com/800x600?text=White+Label+VPN',
                'logo_url' => 'https://via.placeholder.com/100x100?text=WhiteLabel',
                'client_name' => 'VPN Resellers Network',
                'featured' => false,
                'sort_order' => 15,
            ],
        ];

        foreach ($portfolioItems as $item) {
            PortfolioItem::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
