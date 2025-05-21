<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Air Freight',
                'icon' => 'plane',
                'short_description' => 'Fast and secure air freight services for time-sensitive shipments worldwide.',
                'description' => "Our Air Freight service provides fast, reliable global transportation for your cargo. With extensive network coverage and strategic partnerships with major airlines, we offer competitive rates and flexible scheduling options for all your air shipment needs.\n\nWe handle urgent deliveries, perishable goods, high-value items, and oversized cargo with the utmost care and efficiency. Our team coordinates all aspects of the air freight process, including customs clearance, to ensure your shipments arrive on time and in perfect condition.",
                'is_featured' => true,
                'display_order' => 1
            ],
            [
                'title' => 'Ocean Freight',
                'icon' => 'ship',
                'short_description' => 'Reliable ocean freight services for cost-effective global shipping solutions.',
                'description' => "Our Ocean Freight service offers comprehensive sea transportation solutions for businesses of all sizes. Whether you need full container load (FCL) or less than container load (LCL) services, we have the expertise to handle your shipments efficiently.\n\nWith access to major shipping lines and ports worldwide, we provide competitive rates, flexible scheduling, and end-to-end visibility for your ocean cargo. Our team manages all documentation, customs clearance, and inland transportation to deliver a seamless shipping experience.",
                'is_featured' => true,
                'display_order' => 2
            ],
            [
                'title' => 'Road Transport',
                'icon' => 'truck',
                'short_description' => 'Efficient road transportation services for local and regional cargo delivery.',
                'description' => "Our Road Transport service provides reliable ground transportation solutions for your domestic and cross-border shipping needs. With a modern fleet of vehicles and experienced drivers, we ensure safe and timely delivery of your cargo.\n\nWe offer various service options, including full truckload (FTL), less than truckload (LTL), and specialized transportation for oversized or hazardous materials. Our extensive network enables us to optimize routes and reduce costs while maintaining high service quality.",
                'is_featured' => true,
                'display_order' => 3
            ],
            [
                'title' => 'Warehousing',
                'icon' => 'warehouse',
                'short_description' => 'Secure warehousing and distribution services for efficient inventory management.',
                'description' => "Our Warehousing service provides secure storage and efficient distribution solutions for businesses looking to optimize their supply chain. With strategically located facilities equipped with modern technology, we offer flexible warehousing options to meet your specific requirements.\n\nOur comprehensive warehousing services include inventory management, order fulfillment, cross-docking, labeling, and kitting. Our experienced team ensures accurate handling of your goods while our advanced tracking system provides real-time visibility of your inventory.",
                'is_featured' => false,
                'display_order' => 4
            ],
            [
                'title' => 'Express Delivery',
                'icon' => 'shipping-fast',
                'short_description' => 'Fast-track delivery services for urgent shipments with guaranteed delivery times.',
                'description' => "Our Express Delivery service is designed for time-critical shipments that require expedited handling and guaranteed delivery times. We offer door-to-door transportation with priority handling at every stage of the journey.\n\nWith our global network and dedicated team, we provide reliable express services for documents, parcels, and freight. Our real-time tracking systems allow you to monitor your shipment's progress, giving you peace of mind and complete visibility throughout the delivery process.",
                'is_featured' => false,
                'display_order' => 5
            ],
            [
                'title' => 'Customs Clearance',
                'icon' => 'file-contract',
                'short_description' => 'Expert customs brokerage services for smooth international shipping.',
                'description' => "Our Customs Clearance service simplifies the complex process of international trade compliance. Our licensed customs brokers have extensive knowledge of global customs regulations and procedures to ensure your shipments clear customs efficiently and legally.\n\nWe handle all documentation preparation, duty and tax calculations, commodity classification, and communication with customs authorities. Our expertise helps you avoid delays, minimize the risk of penalties, and reduce overall compliance costs while maintaining smooth international shipping operations.",
                'is_featured' => false,
                'display_order' => 6
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create([
                'title' => $serviceData['title'],
                'slug' => Str::slug($serviceData['title']),
                'icon' => $serviceData['icon'],
                'short_description' => $serviceData['short_description'],
                'description' => $serviceData['description'],
                'is_featured' => $serviceData['is_featured'],
                'is_active' => true,
                'display_order' => $serviceData['display_order'],
            ]);
        }
    }
}