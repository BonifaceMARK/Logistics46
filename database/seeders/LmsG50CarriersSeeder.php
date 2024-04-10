<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LmsG50Carrier;

class LmsG50CarriersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carriers = [
            [
                'company_name' => 'Carrier 1',
                'company_address' => 'Address 1',
                'contact_name' => 'Contact Person 1',
                'email' => 'carrier1@example.com',
                'phone' => '123456789',
                'certificate_of_business_registration_image' => 'path/to/image1.jpg',
                'certificate_of_dti_image' => 'path/to/image2.jpg',
                'business_license_image' => 'path/to/image3.jpg',
                'certificate_of_bir_image' => 'path/to/image4.jpg',
                'certificate_of_insurance_image' => 'path/to/image5.jpg',
            ],
            [
                'company_name' => 'Carrier 2',
                'company_address' => 'Address 2',
                'contact_name' => 'Contact Person 2',
                'email' => 'carrier2@example.com',
                'phone' => '987654321',
                'certificate_of_business_registration_image' => 'path/to/image6.jpg',
                'certificate_of_dti_image' => 'path/to/image7.jpg',
                'business_license_image' => 'path/to/image8.jpg',
                'certificate_of_bir_image' => 'path/to/image9.jpg',
                'certificate_of_insurance_image' => 'path/to/image10.jpg',
            ],
            // Add more carriers as needed
        ];

        foreach ($carriers as $carrierData) {
            LmsG50Carrier::create($carrierData);
        }
    }
}
