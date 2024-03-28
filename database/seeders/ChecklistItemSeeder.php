<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ChecklistItem;

class ChecklistItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checklistItems = [
            'Obtain necessary licenses/permits (Obtain and maintain all required licenses and permits to operate legally.)',
            'Comply with safety regulations (Implement safety measures to prevent accidents and comply with all safety regulations.)',
            'Provide proper training (Train employees on company policies, job duties, and safety protocols.)',
            'Implement security measures (Protect the company\'s assets, information, and employees with security measures.)',
            'Follow environmental regulations (Comply with environmental regulations to prevent pollution and minimize the company\'s impact on the environment.)',
            'Document all procedures (Document all company policies and procedures to ensure consistency and compliance.)',
            'Ensure proper labeling (Properly label all products to ensure accurate information and compliance with labeling regulations.)',
            'Verify quality control (Implement quality control measures to ensure consistent product quality and compliance with industry standards.)',
            'Keep accurate records (Keep accurate and up-to-date records to comply with legal and regulatory requirements and aid in decision-making.)',
            'Maintain confidentiality (Protect sensitive information and maintain confidentiality to comply with legal and ethical obligations.)',
            'Comply with labor laws (Comply with labor laws to ensure fair treatment of employees and prevent legal issues.)',
            'Avoid discrimination/harassment (Prevent discrimination and harassment in the workplace to maintain a safe and inclusive work environment.)',
            'Establish a code of ethics (Establish a code of ethics to guide company behavior and ensure compliance with legal and ethical standards.)',
            'Follow financial regulations (Comply with financial regulations to maintain accurate financial records and prevent legal issues.)',
            'Implement data privacy measures (Protect customer data and comply with data privacy regulations to prevent data breaches and legal issues.)',
            'Protect intellectual property (Protect company intellectual property through patents, trademarks, and copyrights to prevent infringement and maintain exclusivity.)',
            'Comply with import/export laws (Comply with import and export regulations to prevent legal issues and ensure smooth international trade.)',
            'Follow advertising guidelines (Follow advertising guidelines to ensure truthful and non-deceptive advertising and comply with advertising regulations.)',
            'Implement anti-bribery measures (Implement anti-bribery measures to prevent bribery and comply with anti-bribery regulations.)',
            'Comply with tax laws (Comply with tax laws to prevent legal issues and maintain accurate financial records.)',
            // Add more checklist items as needed
        ];
    
        foreach ($checklistItems as $item) {
            ChecklistItem::create(['item' => $item]);
        }
    }
    
}
