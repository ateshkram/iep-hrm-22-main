<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [

            [
                'job_title' => 'Applications Developer',
                'nature_scope' => 'We are looking for a dedicated Application Developer to work with customers to develop new software applications and update and modify existing applications. The Application Developer processes user needs to customize software for computer programs, designs prototype applications, implements and tests source code, and troubleshoots software applications.
                To be successful as an Application Developer, you should have a sound knowledge of software engineering as well as excellent analytical skills. A good Application Developer studies the consumer market and client needs to develop cutting-edge applications.
                ',
                'key_responsibilities' => '
                Developing software solutions to meet customer needs.
                Creating and implementing the source code of new applications.
                Testing source code and debugging code.
                Evaluating existing applications and performing updates and modifications.
                Developing technical handbooks to represent the design and code of new applications.
                ',
                'minimum_qualifications' => '
                A Bachelors degree in Computer Science or related field.
                A working knowledge of programming languages such as Java and ORACLE.
                Experience in application and software development.
                Knowledge of software design and programming principles.
                Good mathematical and problem-solving skills.
                Good communication and team-working skills.
                ',
                'preferred_qualifications' => '-',
                'skills' => [
                    1,2,3,4
                ]

            ],
            [
                'job_title' => 'Finance Assistant',
                'nature_scope' => "The OpportunityThe
                Financial Assistant will carry out all the crucial role of providing the entire finance support services to the Campus under the guidance of the Campus Director. As part of the role, the appointee will assist with the verification, monitoring and reporting of all the financials for the Campus; provide support to ensure that the Campus remains within the approved budgets and relevant savings is derived and assist in the preparation of the budget for the Campus and carry out variance analysis.
                The duties will include but not limited to: receive and check all finance claims for compliance with USP finance regulation and forward to Campus Director for approval; processing and handling procurement requests and facilitate the payment of invoices to vendors; respond and liaise with finance on queries relating to finance claims checked; assist Campus Director in monitoring of expenses against the monthly budgets; thorough knowledge of budget preparations and carrying out variance analysis; receiving of all goods and services and entering into banner system for the Campus Director's office; in charge of petty cash; maintain/filling of records such as fixed assets and attractive items register, invoice requests, LVPO's receiving documents and all other finance documents; and other ad-hoc tasks as directed by the Campus Director",
                'key_responsibilities' => 'Administrative Reporting and Queries.
                Compliance to current USP finance standard and procedures. Minimum of no errors expected in the documents checked for compliance and minimal query on documents checked and sent.
                Timely processing of claims and documents received. All documents should be cleared within 2 days of receiving.
                Receiving and payments to vendors done on a timely basis. Accurate finance reports to be prepared. ',
                'minimum_qualifications' => '
                To be considered for this position, applicants must have:
Bachelor of Commerce Degree majoring in Accounting and/or Financial Management with 4 years of subsequent work experience; or
Extensive experience and management expertise in technical or administrative fields; or
An equivalent combination of relevant experience and/or education/training;
Ability to prepare budgets and carry out variance analysis;
Experience in processing of claims and procurements of goods and services;
Handling of petty cash;
Knowledge of finance policies and procedures;
Very good communication skills (both oral and written);
Self-motivated, team player, honest and change oriented;
Computer literacy/in-depth knowledge of Microsoft Word and Excel;
Ability to work in multi-cultural environment;
Ability to work under pressure; and
Ability to work as part of a team or independently, using own initiatives.
                ',
                'preferred_qualifications' => 'Preference will be given to applicants with:
                Familiar with Banner and MIS systems or MYOB; and
                Very good understanding of USP Organization Structure and Financial Framework. ',
                'skills' => [
                    1,2,3,4
                ]
            ],
        ];

        foreach ($jobs as $job){
            $jobModel = \App\Models\Recruitment\JobDescription::create([
                'job_title' => $job['job_title'],
                'nature_scope' => $job['nature_scope'],
                'key_responsibilities' => $job['key_responsibilities'],
                'minimum_qualifications' => $job['minimum_qualifications'],
                'preferred_qualifications' => $job['preferred_qualifications'],
            ]);
            $jobModel->skills()->sync($job['skills']);
        }
    }
}
