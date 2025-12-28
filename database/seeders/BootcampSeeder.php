<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bootcamp;
use App\Models\Mentor;
use App\Models\Category;
use App\Models\ModuleBootcamp;
use Illuminate\Support\Str;

class BootcampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create mentors first
        $mentors = [
            [
                'name' => 'David Anderson',
                'slug' => 'david-anderson',
                'bio' => 'Expert Web Developer with over 15 years of industry experience. Passionate about teaching and mentoring the next generation of developers.',
                'image' => env('APP_URL').'/storage/users/1.jpg',
                'specialization' => 'Full Stack Development',
                'experience' => '15+ years',
                'rating' => 4.9,
                'students_taught' => 1200,
                'email' => 'david.anderson@example.com',
                'phone' => '+1234567890',
                'is_active' => true
            ],
            [
                'name' => 'Sarah Johnson',
                'slug' => 'sarah-johnson',
                'bio' => 'Senior Frontend Developer with expertise in modern JavaScript frameworks and responsive design. Loves helping students master the art of creating beautiful, functional interfaces.',
                'image' => env('APP_URL').'/storage/users/2.jpg',
                'specialization' => 'Frontend Development',
                'experience' => '10+ years',
                'rating' => 4.8,
                'students_taught' => 800,
                'email' => 'sarah.johnson@example.com',
                'phone' => '+1234567891',
                'is_active' => true
            ],
            [
                'name' => 'Dr. Sarah Mitchell',
                'slug' => 'sarah-mitchell',
                'bio' => 'Expert Data Scientist with over 15 years of industry experience. Passionate about teaching and mentoring the next generation of data professionals.',
                'image' => env('APP_URL').'/storage/users/3.jpg',
                'specialization' => 'Machine Learning & AI',
                'experience' => '15+ years',
                'rating' => 4.9,
                'students_taught' => 950,
                'email' => 'sarah.mitchell@example.com',
                'phone' => '+1234567892',
                'is_active' => true
            ],
            [
                'name' => 'Michael Chen',
                'slug' => 'michael-chen',
                'bio' => 'Data Analytics expert with strong background in statistical modeling and business intelligence. Specializes in turning complex data into actionable insights.',
                'image' => env('APP_URL').'/storage/users/4.jpg',
                'specialization' => 'Data Analytics',
                'experience' => '12+ years',
                'rating' => 4.7,
                'students_taught' => 650,
                'email' => 'michael.chen@example.com',
                'phone' => '+1234567893',
                'is_active' => true
            ],
            [
                'name' => 'Alex Rodriguez',
                'slug' => 'alex-rodriguez',
                'bio' => 'Expert UX/UI Designer with over 15 years of industry experience. Passionate about teaching and mentoring the next generation of design professionals.',
                'image' => env('APP_URL').'/storage/users/5.jpg',
                'specialization' => 'User Experience Design',
                'experience' => '15+ years',
                'rating' => 4.8,
                'students_taught' => 750,
                'email' => 'alex.rodriguez@example.com',
                'phone' => '+1234567894',
                'is_active' => true
            ],
            [
                'name' => 'Emily Watson',
                'slug' => 'emily-watson',
                'bio' => 'Creative UI Designer with expertise in design systems and visual hierarchy. Passionate about creating intuitive and beautiful user interfaces.',
                'image' => env('APP_URL').'/storage/users/6.jpg',
                'specialization' => 'Interface Design',
                'experience' => '8+ years',
                'rating' => 4.7,
                'students_taught' => 500,
                'email' => 'emily.watson@example.com',
                'phone' => '+1234567895',
                'is_active' => true
            ],
            [
                'name' => 'Emma Thompson',
                'slug' => 'emma-thompson',
                'bio' => 'Expert Digital Marketer with over 15 years of industry experience. Passionate about teaching and mentoring the next generation of marketing professionals.',
                'image' => env('APP_URL').'/storage/users/7.jpg',
                'specialization' => 'Digital Strategy',
                'experience' => '15+ years',
                'rating' => 4.7,
                'students_taught' => 1100,
                'email' => 'emma.thompson@example.com',
                'phone' => '+1234567896',
                'is_active' => true
            ],
            [
                'name' => 'James Rodriguez',
                'slug' => 'james-rodriguez',
                'bio' => 'Social Media Marketing specialist with proven track record in growing brand presence across multiple platforms. Expert in content strategy and community engagement.',
                'image' => env('APP_URL').'/storage/users/8.jpg',
                'specialization' => 'Social Media Marketing',
                'experience' => '10+ years',
                'rating' => 4.6,
                'students_taught' => 700,
                'email' => 'james.rodriguez@example.com',
                'phone' => '+1234567897',
                'is_active' => true
            ],
            [
                'name' => 'James Wilson',
                'slug' => 'james-wilson',
                'bio' => 'Expert Mobile Developer with over 15 years of industry experience. Passionate about teaching and mentoring the next generation of mobile developers.',
                'image' => env('APP_URL').'/storage/users/9.jpg',
                'specialization' => 'Cross-Platform Development',
                'experience' => '15+ years',
                'rating' => 4.8,
                'students_taught' => 600,
                'email' => 'james.wilson@example.com',
                'phone' => '+1234567898',
                'is_active' => true
            ],
            [
                'name' => 'Lisa Chang',
                'slug' => 'lisa-chang',
                'bio' => 'iOS Development specialist with deep expertise in Swift and Apple ecosystem. Passionate about creating seamless mobile experiences and teaching best practices.',
                'image' => env('APP_URL').'/storage/users/10.jpg',
                'specialization' => 'iOS Development',
                'experience' => '12+ years',
                'rating' => 4.9,
                'students_taught' => 450,
                'email' => 'lisa.chang@example.com',
                'phone' => '+1234567899',
                'is_active' => true
            ]
        ];

        $createdMentors = [];
        foreach ($mentors as $mentor) {
            $createdMentors[$mentor['slug']] = Mentor::create($mentor);
        }

        // Map category IDs to appropriate mentors based on specialization
        $categoryMentorMapping = [
            1 => ['david-anderson', 'sarah-johnson'], // Web Development
            2 => ['sarah-mitchell', 'michael-chen'], // Data Science
            3 => ['alex-rodriguez', 'emily-watson'], // Design
            4 => ['emma-thompson', 'james-rodriguez'], // Marketing
            5 => ['james-wilson', 'lisa-chang'], // Mobile Development
        ];

        // Function to get mentors for a category
        $getMentorsForCategory = function($categoryId) use ($categoryMentorMapping, $createdMentors) {
            $mentorSlugs = $categoryMentorMapping[$categoryId] ?? [];
            $mentors = [];

            foreach ($mentorSlugs as $slug) {
                if (isset($createdMentors[$slug])) {
                    $mentors[] = $createdMentors[$slug]->id;
                }
            }

            // If no mentors found for category, use first 2 mentors
            if (empty($mentors)) {
                $mentors = [
                    $createdMentors['david-anderson']->id,
                    $createdMentors['sarah-johnson']->id
                ];
            }

            return $mentors;
        };

        // Create bootcamps
        $bootcamps = [
            [
                'title' => 'Full Stack Web Development Bootcamp: 4-Month Career Transformation',
                'slug' => 'full-stack-web-development-bootcamp',
                'category_id' => 1, // Web Development
                'price' => 5999000,
                'original_price' => 8999000,
                'image' => env('APP_URL').'/storage/bootcamps/34.jpg',
                'rating' => 4.9,
                'students' => 450,
                'duration' => '12 weeks',
                'level' => 'Beginner to Advanced',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-02-01',
                'description' => 'Intensive 12-week bootcamp covering front-end and back-end development, databases, and deployment. This program is designed to transform your career from beginner to professional full stack web developer with a portfolio of real-world projects.',
                'features' => [
                    '480 hours of intensive training with expert instructors',
                    '20+ real-world projects for your portfolio',
                    'Weekly 1-on-1 mentoring sessions with senior developers',
                    'Comprehensive career services and job placement guarantee',
                    'Industry-recognized certificate of completion',
                    'Lifetime access to our 5000+ alumni network',
                    'Additional technology workshops (React Native, GraphQL, etc.)',
                    'Interview simulations and resume training'
                ],
                'curriculum' => [
                    'Module 1: Web Fundamentals (HTML5, CSS3, JavaScript ES6+)',
                    'Module 2: Frontend Development with React.js',
                    'Module 3: State Management (Redux, Context API)',
                    'Module 4: Backend with Node.js and Express.js',
                    'Module 5: Databases (SQL, NoSQL with MongoDB)',
                    'Module 6: RESTful APIs and GraphQL',
                    'Module 7: DevOps and Deployment (Docker, CI/CD)',
                    'Module 8: Final Project and Portfolio'
                ],
                'learning_outcomes' => [
                    'Build responsive web applications with HTML, CSS, and JavaScript',
                    'Develop single-page applications with React.js',
                    'Create and manage RESTful APIs with Node.js',
                    'Design and implement efficient databases',
                    'Implement web security best practices',
                    'Use Git for version control and collaboration',
                    'Deploy applications to cloud platforms',
                    'Complete full stack projects from start to finish'
                ],
                'career_support' => [
                    'Technical and soft skills assessment',
                    'Resume writing and LinkedIn profile workshops',
                    'Technical and behavioral interview practice',
                    'Direct connections with partner companies (Tech, E-commerce, Startups)',
                    'Exclusive access to internal job postings',
                    '6 months of career guidance after completion',
                    'Demo day with leading technology companies'
                ],
                'requirements' => [
                    'No prior coding experience required',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 12 weeks',
                    'High motivation to learn and build a career in technology'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Data Science & Machine Learning Bootcamp: Analysis & Prediction',
                'slug' => 'data-science-machine-learning-bootcamp',
                'category_id' => 2, // Data Science
                'price' => 6999000,
                'original_price' => 9999000,
                'image' => env('APP_URL').'/storage/bootcamps/35.jpg',
                'rating' => 4.8,
                'students' => 320,
                'duration' => '14 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-02-15',
                'description' => 'Comprehensive data science bootcamp covering statistics, machine learning, and data visualization. This intensive 14-week program is designed to equip you with practical skills in collecting, analyzing, and visualizing data to make data-driven business decisions.',
                'features' => [
                    '560 hours of intensive training with industry data experts',
                    '25+ real-world projects with actual datasets',
                    'Weekly 1-on-1 mentoring with senior data scientists',
                    'Specialized career services for data analyst and scientist roles',
                    'Industry-recognized certificate of completion',
                    'Networking events with technology companies and startups',
                    'Access to cloud platform for projects (AWS, GCP)',
                    'Additional workshops (Deep Learning, NLP, Computer Vision)'
                ],
                'curriculum' => [
                    'Module 1: Python for Data Science (NumPy, Pandas, Matplotlib)',
                    'Module 2: Statistics and Probability for Data Analysis',
                    'Module 3: Machine Learning Fundamentals (Scikit-learn)',
                    'Module 4: Supervised Learning (Regression, Classification)',
                    'Module 5: Unsupervised Learning (Clustering, Dimensionality Reduction)',
                    'Module 6: Deep Learning with TensorFlow and Keras',
                    'Module 7: Natural Language Processing (NLP)',
                    'Module 8: Final Project and Business Presentation'
                ],
                'learning_outcomes' => [
                    'Collect, clean, and analyze data with Python',
                    'Apply effective data visualization techniques',
                    'Build machine learning models for prediction',
                    'Evaluate model performance and optimize hyperparameters',
                    'Communicate data findings with non-technical stakeholders',
                    'Use SQL for data extraction and manipulation',
                    'Apply big data techniques with Spark',
                    'Complete end-to-end projects from data collection to deployment'
                ],
                'career_support' => [
                    'Technical and analytical skills assessment',
                    'Data scientist portfolio building workshops',
                    'Technical interviews and case study practice',
                    'Direct connections with partner companies (Tech, Finance, Healthcare)',
                    'Exclusive access to data analyst and scientist job postings',
                    '6 months of career guidance after completion',
                    'Project presentations to leading technology companies'
                ],
                'requirements' => [
                    'Basic programming understanding (Python preferred)',
                    'Fundamental knowledge of mathematics (algebra, statistics)',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 14 weeks',
                    'Interest in data analysis and problem solving'
                ],
                'is_active' => true
            ],
            [
                'title' => 'UX/UI Design Bootcamp: 3-Month Creative Career',
                'slug' => 'ux-ui-design-bootcamp',
                'category_id' => 3, // Design
                'price' => 5499000,
                'original_price' => 7999000,
                'image' => env('APP_URL').'/storage/bootcamps/36.jpg',
                'rating' => 4.7,
                'students' => 280,
                'duration' => '10 weeks',
                'level' => 'Beginner to Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-03-01',
                'description' => 'Intensive design bootcamp covering user research, interface design, and prototyping. This 10-week program is designed to transform your career into a professional UX/UI designer with a portfolio of real-world projects and relevant industry skills.',
                'features' => [
                    '400 hours of intensive training with senior designers',
                    '15+ portfolio projects to showcase to employers',
                    'Weekly 1-on-1 mentoring with lead designers from tech companies',
                    'Specialized career services for UX/UI designer roles',
                    'Industry-recognized certificate of completion',
                    'Lifetime access to design tools (Figma, Adobe Creative Cloud)',
                    'Additional workshops (Motion Design, 3D Design, Design Systems)',
                    'Studio visits to leading design agencies'
                ],
                'curriculum' => [
                    'Module 1: UX/UI Design Fundamentals',
                    'Module 2: Design Thinking and User Research',
                    'Module 3: Information Architecture and Wireframing',
                    'Module 4: Visual Design (Color, Typography, Layout)',
                    'Module 5: Prototyping with Figma and Adobe XD',
                    'Module 6: Usability Testing and Iteration',
                    'Module 7: Design Systems and Component Libraries',
                    'Module 8: Portfolio Development and Presentation'
                ],
                'learning_outcomes' => [
                    'Conduct user research and analyze user needs',
                    'Create user personas, user flows, and journey maps',
                    'Design wireframes and high-fidelity mockups',
                    'Build interactive prototypes for testing',
                    'Conduct usability testing and implement feedback',
                    'Develop consistent design systems',
                    'Apply responsive design principles for web and mobile',
                    'Create and present a professional design portfolio'
                ],
                'career_support' => [
                    'Design skills and creativity assessment',
                    'Portfolio building and personal branding workshops',
                    'Design interviews and portfolio presentation practice',
                    'Direct connections with partner companies (Tech, E-commerce, Startups)',
                    'Exclusive access to UX/UI designer job postings',
                    '6 months of career guidance after completion',
                    'Portfolio reviews with hiring managers from tech companies'
                ],
                'requirements' => [
                    'No prior design experience required',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 10 weeks',
                    'Creativity and attention to detail',
                    'Interest in technology and user behavior'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Digital Marketing Mastery Bootcamp: Strategy & ROI',
                'slug' => 'digital-marketing-mastery-bootcamp',
                'category_id' => 4, // Marketing
                'price' => 4999000,
                'original_price' => 7499000,
                'image' => env('APP_URL').'/storage/bootcamps/37.jpg',
                'rating' => 4.6,
                'students' => 350,
                'duration' => '8 weeks',
                'level' => 'Beginner',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-03-15',
                'description' => 'Comprehensive digital marketing bootcamp covering SEO, social media, content marketing, and analytics. This intensive 8-week program is designed to equip you with practical skills to plan, implement, and optimize effective digital marketing campaigns.',
                'features' => [
                    '320 hours of intensive training with marketing practitioners',
                    '12+ real-world campaigns with actual brands',
                    'Weekly 1-on-1 mentoring with senior marketing managers',
                    'Specialized career services for digital marketer roles',
                    'Industry-recognized certificate of completion',
                    'Industry certification preparation (Google Ads, Facebook Blueprint)',
                    'Access to digital marketing tools (SEMrush, Google Analytics, Mailchimp)',
                    'Additional workshops (Marketing Automation, Growth Hacking)'
                ],
                'curriculum' => [
                    'Module 1: Digital Marketing Fundamentals',
                    'Module 2: Search Engine Optimization (SEO)',
                    'Module 3: Search Engine Marketing (SEM) & Google Ads',
                    'Module 4: Social Media Marketing (Instagram, Facebook, TikTok)',
                    'Module 5: Content Marketing & Copywriting',
                    'Module 6: Email Marketing & Marketing Automation',
                    'Module 7: Web Analytics & Data-Driven Marketing',
                    'Module 8: Digital Marketing Strategy & ROI Measurement'
                ],
                'learning_outcomes' => [
                    'Plan and implement effective SEO strategies',
                    'Create and manage paid advertising campaigns (Google Ads, Facebook Ads)',
                    'Develop engaging and conversion-focused content strategies',
                    'Manage social media campaigns for brand awareness and engagement',
                    'Build email marketing automation funnels',
                    'Analyze marketing data with Google Analytics',
                    'Measure ROI of digital marketing campaigns',
                    'Create integrated digital marketing strategies'
                ],
                'career_support' => [
                    'Marketing skills and strategy assessment',
                    'Marketing campaign portfolio building workshops',
                    'Marketing interviews and case study practice',
                    'Direct connections with partner companies (E-commerce, Tech, Agencies)',
                    'Exclusive access to digital marketer job postings',
                    '6 months of career guidance after completion',
                    'Campaign presentations to leading technology companies'
                ],
                'requirements' => [
                    'No prior marketing experience required',
                    'Laptop computer with minimum specifications (4GB RAM, i3/AMD Ryzen 3)',
                    'Ability to communicate in English',
                    'Full-time commitment for 8 weeks',
                    'Creativity and interest in business strategy',
                    'Basic familiarity with social media'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Mobile App Development Bootcamp: iOS & Android',
                'slug' => 'mobile-app-development-bootcamp',
                'category_id' => 5, // Mobile Development
                'price' => 6499000,
                'original_price' => 9499000,
                'image' => env('APP_URL').'/storage/bootcamps/38.jpg',
                'rating' => 4.8,
                'students' => 220,
                'duration' => '12 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-04-01',
                'description' => 'Intensive mobile development bootcamp covering iOS, Android, and cross-platform development. This 12-week program is designed to equip you with skills to build high-performance native and cross-platform mobile applications for iOS and Android.',
                'features' => [
                    '480 hours of intensive training with senior mobile developers',
                    '18+ complete mobile applications for your portfolio',
                    'Weekly 1-on-1 mentoring with lead mobile developers from tech companies',
                    'Specialized career services for mobile developer roles',
                    'Industry-recognized certificate of completion',
                    'App store deployment guidance (App Store, Google Play)',
                    'Access to device lab for testing (iPhone, Android, Tablet)',
                    'Additional workshops (React Native, Flutter, IoT Integration)'
                ],
                'curriculum' => [
                    'Module 1: Mobile Development Fundamentals',
                    'Module 2: Swift and iOS Development (UIKit, SwiftUI)',
                    'Module 3: Kotlin and Android Development',
                    'Module 4: Cross-Platform Development with Flutter',
                    'Module 5: State Management (Provider, BLoC, Riverpod)',
                    'Module 6: Networking & API Integration',
                    'Module 7: Local Data Persistence (SQLite, Hive)',
                    'Module 8: App Deployment & Maintenance'
                ],
                'learning_outcomes' => [
                    'Build native iOS applications with Swift and SwiftUI',
                    'Build native Android applications with Kotlin',
                    'Develop cross-platform applications with Flutter',
                    'Implement effective state management',
                    'Integrate RESTful APIs and GraphQL',
                    'Store data locally with SQLite and Hive',
                    'Implement push notifications and background tasks',
                    'Deploy applications to App Store and Google Play Store'
                ],
                'career_support' => [
                    'Mobile development technical skills assessment',
                    'Mobile app portfolio building workshops',
                    'Technical interviews and coding challenges practice',
                    'Direct connections with partner companies (Tech, E-commerce, Startups)',
                    'Exclusive access to mobile developer job postings',
                    '6 months of career guidance after completion',
                    'App demos to leading technology companies'
                ],
                'requirements' => [
                    'Basic understanding of OOP programming (Java, C#, Python preferred)',
                    'Familiarity with basic mobile app concepts',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 12 weeks',
                    'Interest in mobile technology and user experience'
                ],
                'is_active' => true
            ]
        ];

        // Add 20 more bootcamps to reach 25 total
        $additionalBootcamps = [
            [
                'title' => 'Cybersecurity Fundamentals Bootcamp: Protect Digital Assets',
                'slug' => 'cybersecurity-fundamentals-bootcamp',
                'category_id' => 1, // Using existing category - Web Development
                'price' => 7499000,
                'original_price' => 9999000,
                'image' => env('APP_URL').'/storage/bootcamps/39.jpg',
                'rating' => 4.7,
                'students' => 180,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-04-15',
                'description' => 'Comprehensive cybersecurity bootcamp covering network security, ethical hacking, and digital forensics. Learn to protect systems from cyber threats and respond to security incidents.',
                'features' => [
                    '400 hours of intensive training with security experts',
                    '15+ hands-on security labs and simulations',
                    'Weekly 1-on-1 mentoring with cybersecurity professionals',
                    'Industry-recognized certificate of completion',
                    'Access to security tools and platforms',
                    'Additional workshops (Cloud Security, IoT Security)',
                    'Career services for cybersecurity roles'
                ],
                'curriculum' => [
                    'Module 1: Network Security Fundamentals',
                    'Module 2: Ethical Hacking and Penetration Testing',
                    'Module 3: Digital Forensics and Incident Response',
                    'Module 4: Security Operations and Monitoring',
                    'Module 5: Cryptography and Secure Communications',
                    'Module 6: Web Application Security',
                    'Module 7: Cloud Security and DevSecOps',
                    'Module 8: Security Project and Certification Prep'
                ],
                'learning_outcomes' => [
                    'Identify and mitigate network vulnerabilities',
                    'Perform ethical hacking assessments',
                    'Respond to security incidents effectively',
                    'Implement security best practices',
                    'Use security tools for monitoring and defense',
                    'Understand legal and ethical aspects of cybersecurity',
                    'Prepare for industry certifications (CompTIA Security+, CEH)',
                    'Complete a comprehensive security project'
                ],
                'career_support' => [
                    'Security skills assessment and career planning',
                    'Resume building for cybersecurity roles',
                    'Interview preparation for security positions',
                    'Connections with cybersecurity companies',
                    'Access to exclusive security job postings',
                    '6 months of career guidance after completion',
                    'Security project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of computer networks',
                    'Familiarity with operating systems (Windows, Linux)',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 10 weeks',
                    'Interest in cybersecurity and problem solving'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Cloud Computing with AWS Bootcamp: Architecture & Deployment',
                'slug' => 'cloud-computing-aws-bootcamp',
                'category_id' => 2, // Using existing category - Data Science
                'price' => 6999000,
                'original_price' => 9499000,
                'image' => env('APP_URL').'/storage/bootcamps/40.jpg',
                'rating' => 4.8,
                'students' => 250,
                'duration' => '12 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-05-01',
                'description' => 'Intensive cloud computing bootcamp focusing on AWS services, architecture, and deployment. Learn to design, deploy, and manage scalable cloud solutions.',
                'features' => [
                    '480 hours of intensive training with cloud architects',
                    '20+ real-world cloud projects',
                    'Weekly 1-on-1 mentoring with AWS certified professionals',
                    'Industry-recognized certificate of completion',
                    'AWS certification preparation (Solutions Architect, Developer)',
                    'Access to AWS free tier for projects',
                    'Additional workshops (Azure, GCP, Multi-cloud strategies)',
                    'Career services for cloud computing roles'
                ],
                'curriculum' => [
                    'Module 1: Cloud Computing Fundamentals',
                    'Module 2: AWS Core Services (EC2, S3, RDS)',
                    'Module 3: Networking and Security in AWS',
                    'Module 4: Cloud Architecture and Design Patterns',
                    'Module 5: Serverless Computing with Lambda',
                    'Module 6: DevOps and CI/CD in AWS',
                    'Module 7: Monitoring and Optimization',
                    'Module 8: Cloud Migration and Final Project'
                ],
                'learning_outcomes' => [
                    'Design scalable cloud architectures',
                    'Deploy and manage AWS services',
                    'Implement cloud security best practices',
                    'Optimize cloud costs and performance',
                    'Build serverless applications',
                    'Implement CI/CD pipelines in the cloud',
                    'Monitor and troubleshoot cloud resources',
                    'Prepare for AWS certification exams'
                ],
                'career_support' => [
                    'Cloud skills assessment and career planning',
                    'Resume building for cloud computing roles',
                    'Interview preparation for cloud positions',
                    'Connections with cloud service providers and partners',
                    'Access to exclusive cloud job postings',
                    '6 months of career guidance after completion',
                    'Cloud project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of networking concepts',
                    'Familiarity with operating systems and virtualization',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 12 weeks',
                    'Interest in cloud technology and distributed systems'
                ],
                'is_active' => true
            ],
            [
                'title' => 'DevOps Engineering Bootcamp: Automation & Deployment',
                'slug' => 'devops-engineering-bootcamp',
                'category_id' => 3, // Using existing category - Design
                'price' => 6499000,
                'original_price' => 8999000,
                'image' => env('APP_URL').'/storage/bootcamps/41.jpg',
                'rating' => 4.7,
                'students' => 200,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-05-15',
                'description' => 'Comprehensive DevOps bootcamp covering automation, CI/CD, containerization, and infrastructure as code. Learn to streamline development and deployment processes.',
                'features' => [
                    '400 hours of intensive training with DevOps engineers',
                    '18+ real-world DevOps projects',
                    'Weekly 1-on-1 mentoring with senior DevOps professionals',
                    'Industry-recognized certificate of completion',
                    'Access to DevOps tools and platforms',
                    'Additional workshops (Kubernetes Advanced, GitOps)',
                    'Career services for DevOps roles'
                ],
                'curriculum' => [
                    'Module 1: DevOps Fundamentals and Culture',
                    'Module 2: Version Control with Git',
                    'Module 3: Continuous Integration with Jenkins',
                    'Module 4: Configuration Management with Ansible',
                    'Module 5: Containerization with Docker',
                    'Module 6: Orchestration with Kubernetes',
                    'Module 7: Infrastructure as Code with Terraform',
                    'Module 8: Monitoring and Final Project'
                ],
                'learning_outcomes' => [
                    'Implement CI/CD pipelines',
                    'Manage infrastructure as code',
                    'Containerize applications with Docker',
                    'Orchestrate containers with Kubernetes',
                    'Automate configuration management',
                    'Monitor and optimize system performance',
                    'Apply DevOps best practices',
                    'Complete a comprehensive DevOps project'
                ],
                'career_support' => [
                    'DevOps skills assessment and career planning',
                    'Resume building for DevOps roles',
                    'Interview preparation for DevOps positions',
                    'Connections with tech companies using DevOps',
                    'Access to exclusive DevOps job postings',
                    '6 months of career guidance after completion',
                    'DevOps project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of software development',
                    'Familiarity with Linux command line',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 10 weeks',
                    'Interest in automation and system administration'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Blockchain Development Bootcamp: DApps & Smart Contracts',
                'slug' => 'blockchain-development-bootcamp',
                'category_id' => 4, // Using existing category - Marketing
                'price' => 7999000,
                'original_price' => 10999000,
                'image' => env('APP_URL').'/storage/bootcamps/34.jpg',
                'rating' => 4.6,
                'students' => 150,
                'duration' => '12 weeks',
                'level' => 'Advanced',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-06-01',
                'description' => 'Advanced blockchain development bootcamp covering smart contracts, DApps, and Web3 technologies. Learn to build decentralized applications on various blockchain platforms.',
                'features' => [
                    '480 hours of intensive training with blockchain developers',
                    '15+ blockchain projects and smart contracts',
                    'Weekly 1-on-1 mentoring with blockchain experts',
                    'Industry-recognized certificate of completion',
                    'Access to blockchain development tools',
                    'Additional workshops (DeFi, NFTs, DAOs)',
                    'Career services for blockchain developer roles'
                ],
                'curriculum' => [
                    'Module 1: Blockchain Fundamentals',
                    'Module 2: Cryptography and Consensus Mechanisms',
                    'Module 3: Smart Contract Development with Solidity',
                    'Module 4: Ethereum and EVM-compatible Chains',
                    'Module 5: Web3.js and Frontend Integration',
                    'Module 6: DApp Development',
                    'Module 7: DeFi Protocols and NFTs',
                    'Module 8: Blockchain Project and Deployment'
                ],
                'learning_outcomes' => [
                    'Understand blockchain technology and principles',
                    'Develop smart contracts with Solidity',
                    'Build decentralized applications',
                    'Integrate Web3 with frontend applications',
                    'Work with various blockchain platforms',
                    'Implement DeFi protocols and NFTs',
                    'Deploy DApps to blockchain networks',
                    'Complete a comprehensive blockchain project'
                ],
                'career_support' => [
                    'Blockchain skills assessment and career planning',
                    'Resume building for blockchain developer roles',
                    'Interview preparation for blockchain positions',
                    'Connections with blockchain companies and startups',
                    'Access to exclusive blockchain job postings',
                    '6 months of career guidance after completion',
                    'Blockchain project presentations to employers'
                ],
                'requirements' => [
                    'Strong programming background (JavaScript, Python preferred)',
                    'Understanding of web development concepts',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 12 weeks',
                    'Interest in decentralized technology and cryptography'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Game Development Bootcamp: Unity & Unreal Engine',
                'slug' => 'game-development-bootcamp',
                'category_id' => 5, // Using existing category - Mobile Development
                'price' => 7499000,
                'original_price' => 9999000,
                'image' => env('APP_URL').'/storage/bootcamps/35.jpg',
                'rating' => 4.8,
                'students' => 220,
                'duration' => '14 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-06-15',
                'description' => 'Comprehensive game development bootcamp covering Unity and Unreal Engine. Learn to create 2D and 3D games for multiple platforms.',
                'features' => [
                    '560 hours of intensive training with game developers',
                    '20+ game projects across different genres',
                    'Weekly 1-on-1 mentoring with senior game developers',
                    'Industry-recognized certificate of completion',
                    'Access to game development tools and assets',
                    'Additional workshops (Mobile Gaming, VR/AR Development)',
                    'Career services for game developer roles'
                ],
                'curriculum' => [
                    'Module 1: Game Development Fundamentals',
                    'Module 2: 2D Game Development with Unity',
                    'Module 3: 3D Modeling and Animation',
                    'Module 4: 3D Game Development with Unity',
                    'Module 5: Introduction to Unreal Engine',
                    'Module 6: Game Physics and Mechanics',
                    'Module 7: UI/UX for Games',
                    'Module 8: Game Project and Portfolio'
                ],
                'learning_outcomes' => [
                    'Create 2D and 3D games with Unity',
                    'Develop games with Unreal Engine',
                    'Implement game physics and mechanics',
                    'Design game UI and user experience',
                    'Create game assets and animations',
                    'Optimize games for different platforms',
                    'Publish games to app stores and PC platforms',
                    'Complete a comprehensive game project'
                ],
                'career_support' => [
                    'Game development skills assessment and career planning',
                    'Resume building for game developer roles',
                    'Interview preparation for game industry positions',
                    'Connections with game studios and publishers',
                    'Access to exclusive game developer job postings',
                    '6 months of career guidance after completion',
                    'Game portfolio presentations to employers'
                ],
                'requirements' => [
                    'Basic programming understanding (C#, C++ preferred)',
                    'Interest in gaming and creative design',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5, dedicated GPU)',
                    'Ability to communicate in English',
                    'Full-time commitment for 14 weeks',
                    'Creative thinking and problem-solving skills'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Internet of Things (IoT) Bootcamp: Connected Devices',
                'slug' => 'iot-bootcamp',
                'category_id' => 1, // Using existing category - Web Development
                'price' => 6999000,
                'original_price' => 9499000,
                'image' => env('APP_URL').'/storage/bootcamps/36.jpg',
                'rating' => 4.5,
                'students' => 160,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-07-01',
                'description' => 'Hands-on IoT bootcamp covering device programming, connectivity, and data analytics. Learn to build and deploy IoT solutions for various applications.',
                'features' => [
                    '400 hours of intensive training with IoT specialists',
                    '15+ IoT projects with different sensors and platforms',
                    'Weekly 1-on-1 mentoring with IoT engineers',
                    'Industry-recognized certificate of completion',
                    'Access to IoT development kits and tools',
                    'Additional workshops (Edge Computing, IoT Security)',
                    'Career services for IoT developer roles'
                ],
                'curriculum' => [
                    'Module 1: IoT Fundamentals and Architecture',
                    'Module 2: Microcontroller Programming (Arduino, ESP32)',
                    'Module 3: Sensors and Actuators',
                    'Module 4: Connectivity Protocols (WiFi, Bluetooth, LoRaWAN)',
                    'Module 5: Cloud Platforms for IoT',
                    'Module 6: Data Analytics for IoT',
                    'Module 7: IoT Security and Privacy',
                    'Module 8: IoT Project and Deployment'
                ],
                'learning_outcomes' => [
                    'Program microcontrollers for IoT applications',
                    'Interface sensors and actuators',
                    'Implement connectivity solutions',
                    'Connect devices to cloud platforms',
                    'Analyze IoT data for insights',
                    'Implement IoT security measures',
                    'Design end-to-end IoT solutions',
                    'Complete a comprehensive IoT project'
                ],
                'career_support' => [
                    'IoT skills assessment and career planning',
                    'Resume building for IoT developer roles',
                    'Interview preparation for IoT positions',
                    'Connections with IoT companies and startups',
                    'Access to exclusive IoT job postings',
                    '6 months of career guidance after completion',
                    'IoT project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of electronics and programming',
                    'Familiarity with C/C++ or Python',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 10 weeks',
                    'Interest in hardware and connected devices'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Artificial Intelligence & Deep Learning Bootcamp: Neural Networks',
                'slug' => 'ai-deep-learning-bootcamp',
                'category_id' => 2, // Using existing category - Data Science
                'price' => 8999000,
                'original_price' => 11999000,
                'image' => env('APP_URL').'/storage/bootcamps/40.jpg',
                'rating' => 4.9,
                'students' => 190,
                'duration' => '16 weeks',
                'level' => 'Advanced',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-07-15',
                'description' => 'Advanced AI and deep learning bootcamp covering neural networks, computer vision, and NLP. Learn to build cutting-edge AI applications.',
                'features' => [
                    '640 hours of intensive training with AI researchers',
                    '20+ AI projects with real-world applications',
                    'Weekly 1-on-1 mentoring with AI specialists',
                    'Industry-recognized certificate of completion',
                    'Access to GPU resources for deep learning',
                    'Additional workshops (Reinforcement Learning, GANs)',
                    'Career services for AI engineer roles'
                ],
                'curriculum' => [
                    'Module 1: Advanced Mathematics for AI',
                    'Module 2: Deep Learning Fundamentals',
                    'Module 3: Convolutional Neural Networks (CNNs)',
                    'Module 4: Recurrent Neural Networks (RNNs, LSTMs)',
                    'Module 5: Transformer Architecture and Attention',
                    'Module 6: Computer Vision with Deep Learning',
                    'Module 7: Advanced NLP and Large Language Models',
                    'Module 8: AI Project and Research Paper'
                ],
                'learning_outcomes' => [
                    'Understand advanced mathematical concepts for AI',
                    'Design and implement neural networks',
                    'Build computer vision applications',
                    'Develop NLP models and applications',
                    'Work with transformer architectures',
                    'Implement state-of-the-art AI techniques',
                    'Optimize AI models for production',
                    'Complete a comprehensive AI research project'
                ],
                'career_support' => [
                    'AI skills assessment and career planning',
                    'Resume building for AI engineer roles',
                    'Interview preparation for AI positions',
                    'Connections with AI companies and research labs',
                    'Access to exclusive AI job postings',
                    '6 months of career guidance after completion',
                    'AI project presentations to employers'
                ],
                'requirements' => [
                    'Strong programming background (Python required)',
                    'Understanding of linear algebra and calculus',
                    'Familiarity with basic machine learning concepts',
                    'Laptop computer with minimum specifications (16GB RAM, i7/AMD Ryzen 7)',
                    'Ability to communicate in English',
                    'Full-time commitment for 16 weeks',
                    'Interest in cutting-edge AI research and applications'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Product Management Bootcamp: Strategy & Leadership',
                'slug' => 'product-management-bootcamp',
                'category_id' => 3, // Using existing category - Design
                'price' => 5999000,
                'original_price' => 8499000,
                'image' => env('APP_URL').'/storage/bootcamps/38.jpg',
                'rating' => 4.6,
                'students' => 280,
                'duration' => '8 weeks',
                'level' => 'Beginner to Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-08-01',
                'description' => 'Comprehensive product management bootcamp covering strategy, development lifecycle, and leadership. Learn to guide products from concept to launch.',
                'features' => [
                    '320 hours of intensive training with product managers',
                    '12+ product strategy projects',
                    'Weekly 1-on-1 mentoring with senior product managers',
                    'Industry-recognized certificate of completion',
                    'Product management tools and frameworks',
                    'Additional workshops (Growth Hacking, Product Analytics)',
                    'Career services for product manager roles'
                ],
                'curriculum' => [
                    'Module 1: Product Management Fundamentals',
                    'Module 2: Market Research and User Analysis',
                    'Module 3: Product Strategy and Roadmapping',
                    'Module 4: Agile Development and Scrum',
                    'Module 5: Product Design and Prototyping',
                    'Module 6: Go-to-Market Strategy',
                    'Module 7: Product Analytics and Metrics',
                    'Module 8: Product Leadership and Final Project'
                ],
                'learning_outcomes' => [
                    'Conduct market research and user analysis',
                    'Develop product strategies and roadmaps',
                    'Manage product development lifecycle',
                    'Apply agile methodologies',
                    'Design and prototype products',
                    'Execute go-to-market strategies',
                    'Analyze product metrics and KPIs',
                    'Lead cross-functional product teams'
                ],
                'career_support' => [
                    'Product management skills assessment and career planning',
                    'Resume building for product manager roles',
                    'Interview preparation for product positions',
                    'Connections with tech companies and startups',
                    'Access to exclusive product manager job postings',
                    '6 months of career guidance after completion',
                    'Product strategy presentations to employers'
                ],
                'requirements' => [
                    'No prior product management experience required',
                    'Understanding of business and technology concepts',
                    'Laptop computer with minimum specifications (4GB RAM, i3/AMD Ryzen 3)',
                    'Ability to communicate in English',
                    'Full-time commitment for 8 weeks',
                    'Interest in strategy, leadership, and innovation'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Business Intelligence & Analytics Bootcamp: Data-Driven Decisions',
                'slug' => 'business-intelligence-analytics-bootcamp',
                'category_id' => 2, // Using existing category - Data Science
                'price' => 5499000,
                'original_price' => 7999000,
                'image' => env('APP_URL').'/storage/bootcamps/39.jpg',
                'rating' => 4.5,
                'students' => 240,
                'duration' => '8 weeks',
                'level' => 'Beginner to Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-08-15',
                'description' => 'Practical business intelligence bootcamp covering data analysis, visualization, and reporting. Learn to transform data into actionable business insights.',
                'features' => [
                    '320 hours of intensive training with BI analysts',
                    '12+ business intelligence projects',
                    'Weekly 1-on-1 mentoring with senior BI professionals',
                    'Industry-recognized certificate of completion',
                    'Access to BI tools and platforms',
                    'Additional workshops (Advanced Excel, Power BI)',
                    'Career services for BI analyst roles'
                ],
                'curriculum' => [
                    'Module 1: Business Intelligence Fundamentals',
                    'Module 2: Data Warehousing and ETL',
                    'Module 3: SQL for Business Analysis',
                    'Module 4: Data Visualization with Tableau',
                    'Module 5: Business Analytics with Power BI',
                    'Module 6: Reporting and Dashboard Creation',
                    'Module 7: KPIs and Performance Metrics',
                    'Module 8: BI Project and Business Presentation'
                ],
                'learning_outcomes' => [
                    'Design and implement data warehouses',
                    'Perform ETL processes',
                    'Write complex SQL queries for analysis',
                    'Create interactive dashboards and visualizations',
                    'Analyze business data for insights',
                    'Develop KPIs and performance metrics',
                    'Present data-driven recommendations',
                    'Complete a comprehensive BI project'
                ],
                'career_support' => [
                    'BI skills assessment and career planning',
                    'Resume building for BI analyst roles',
                    'Interview preparation for BI positions',
                    'Connections with companies using BI solutions',
                    'Access to exclusive BI job postings',
                    '6 months of career guidance after completion',
                    'BI project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of business operations',
                    'Familiarity with spreadsheets (Excel preferred)',
                    'Laptop computer with minimum specifications (4GB RAM, i3/AMD Ryzen 3)',
                    'Ability to communicate in English',
                    'Full-time commitment for 8 weeks',
                    'Interest in data analysis and business strategy'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Project Management Professional (PMP) Bootcamp: Certification Prep',
                'slug' => 'project-management-pmp-bootcamp',
                'category_id' => 4, // Using existing category - Marketing
                'price' => 4999000,
                'original_price' => 7499000,
                'image' => env('APP_URL').'/storage/bootcamps/40.jpg',
                'rating' => 4.4,
                'students' => 320,
                'duration' => '6 weeks',
                'level' => 'Beginner to Advanced',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-09-01',
                'description' => 'Intensive PMP certification preparation bootcamp covering project management principles, processes, and best practices. Prepare for the PMP exam.',
                'features' => [
                    '240 hours of intensive training with PMP certified instructors',
                    '10+ practice exams and case studies',
                    'Weekly 1-on-1 mentoring with project management professionals',
                    'Industry-recognized certificate of completion',
                    'PMP exam preparation materials',
                    'Additional workshops (Agile, Scrum Master)',
                    'Career services for project manager roles'
                ],
                'curriculum' => [
                    'Module 1: Project Management Framework',
                    'Module 2: Project Integration Management',
                    'Module 3: Project Scope Management',
                    'Module 4: Project Schedule Management',
                    'Module 5: Project Cost Management',
                    'Module 6: Project Quality Management',
                    'Module 7: Project Risk Management',
                    'Module 8: PMP Exam Preparation'
                ],
                'learning_outcomes' => [
                    'Understand project management framework',
                    'Manage project integration and scope',
                    'Develop and control project schedules',
                    'Manage project budgets and costs',
                    'Implement quality management processes',
                    'Identify and mitigate project risks',
                    'Apply project management best practices',
                    'Pass the PMP certification exam'
                ],
                'career_support' => [
                    'Project management skills assessment and career planning',
                    'Resume building for project manager roles',
                    'Interview preparation for project positions',
                    'Connections with companies requiring PMP certification',
                    'Access to exclusive project manager job postings',
                    '6 months of career guidance after completion',
                    'PMP certification application assistance'
                ],
                'requirements' => [
                    'Basic understanding of project management concepts',
                    'Experience working on projects (preferred but not required)',
                    'Laptop computer with minimum specifications (4GB RAM, i3/AMD Ryzen 3)',
                    'Ability to communicate in English',
                    'Full-time commitment for 6 weeks',
                    'Interest in leadership and organization'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Quality Assurance & Testing Bootcamp: Manual & Automation',
                'slug' => 'quality-assurance-testing-bootcamp',
                'category_id' => 1, // Using existing category - Web Development
                'price' => 4499000,
                'original_price' => 6999000,
                'image' => env('APP_URL').'/storage/bootcamps/41.jpg',
                'rating' => 4.3,
                'students' => 200,
                'duration' => '6 weeks',
                'level' => 'Beginner',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-09-15',
                'description' => 'Comprehensive QA bootcamp covering manual testing, test automation, and quality processes. Learn to ensure software quality and reliability.',
                'features' => [
                    '240 hours of intensive training with QA professionals',
                    '10+ testing projects and case studies',
                    'Weekly 1-on-1 mentoring with senior QA engineers',
                    'Industry-recognized certificate of completion',
                    'Access to testing tools and frameworks',
                    'Additional workshops (Performance Testing, Security Testing)',
                    'Career services for QA engineer roles'
                ],
                'curriculum' => [
                    'Module 1: Software Testing Fundamentals',
                    'Module 2: Manual Testing Techniques',
                    'Module 3: Test Planning and Documentation',
                    'Module 4: Test Automation with Selenium',
                    'Module 5: API Testing with Postman',
                    'Module 6: Performance and Load Testing',
                    'Module 7: Quality Processes and Standards',
                    'Module 8: QA Project and Certification Prep'
                ],
                'learning_outcomes' => [
                    'Understand software testing principles',
                    'Perform manual testing effectively',
                    'Write comprehensive test plans and cases',
                    'Automate tests with Selenium',
                    'Test APIs and web services',
                    'Conduct performance and load testing',
                    'Implement quality assurance processes',
                    'Complete a comprehensive QA project'
                ],
                'career_support' => [
                    'QA skills assessment and career planning',
                    'Resume building for QA engineer roles',
                    'Interview preparation for QA positions',
                    'Connections with software companies',
                    'Access to exclusive QA job postings',
                    '6 months of career guidance after completion',
                    'QA project presentations to employers'
                ],
                'requirements' => [
                    'No prior testing experience required',
                    'Basic understanding of software development',
                    'Laptop computer with minimum specifications (4GB RAM, i3/AMD Ryzen 3)',
                    'Ability to communicate in English',
                    'Full-time commitment for 6 weeks',
                    'Attention to detail and analytical thinking'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Technical Writing Bootcamp: Documentation & Communication',
                'slug' => 'technical-writing-bootcamp',
                'category_id' => 3, // Using existing category - Design
                'price' => 3999000,
                'original_price' => 5999000,
                'image' => env('APP_URL').'/storage/bootcamps/34.jpg',
                'rating' => 4.2,
                'students' => 150,
                'duration' => '4 weeks',
                'level' => 'Beginner',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-10-01',
                'description' => 'Practical technical writing bootcamp covering documentation, API guides, and user manuals. Learn to communicate complex technical information clearly.',
                'features' => [
                    '160 hours of intensive training with technical writers',
                    '8+ technical writing projects',
                    'Weekly 1-on-1 mentoring with senior technical writers',
                    'Industry-recognized certificate of completion',
                    'Access to documentation tools and platforms',
                    'Additional workshops (Content Strategy, UX Writing)',
                    'Career services for technical writer roles'
                ],
                'curriculum' => [
                    'Module 1: Technical Writing Fundamentals',
                    'Module 2: Audience Analysis and Planning',
                    'Module 3: Writing Clear and Concise Documentation',
                    'Module 4: API Documentation and Guides',
                    'Module 5: User Manuals and Tutorials',
                    'Module 6: Visual Communication in Technical Writing',
                    'Module 7: Documentation Tools and Platforms',
                    'Module 8: Technical Writing Portfolio'
                ],
                'learning_outcomes' => [
                    'Analyze audience needs and requirements',
                    'Plan and structure technical documents',
                    'Write clear and concise documentation',
                    'Create API documentation and guides',
                    'Develop user manuals and tutorials',
                    'Use visuals effectively in technical writing',
                    'Work with documentation tools',
                    'Build a technical writing portfolio'
                ],
                'career_support' => [
                    'Technical writing skills assessment and career planning',
                    'Resume building for technical writer roles',
                    'Interview preparation for technical writing positions',
                    'Connections with tech companies and startups',
                    'Access to exclusive technical writer job postings',
                    '6 months of career guidance after completion',
                    'Technical writing portfolio reviews'
                ],
                'requirements' => [
                    'No prior technical writing experience required',
                    'Good command of English language',
                    'Laptop computer with minimum specifications (4GB RAM, i3/AMD Ryzen 3)',
                    'Ability to communicate in English',
                    'Full-time commitment for 4 weeks',
                    'Interest in technology and communication'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Salesforce Development Bootcamp: CRM & Cloud Solutions',
                'slug' => 'salesforce-development-bootcamp',
                'category_id' => 5, // Using existing category - Mobile Development
                'price' => 6499000,
                'original_price' => 8999000,
                'image' => env('APP_URL').'/storage/bootcamps/35.jpg',
                'rating' => 4.5,
                'students' => 180,
                'duration' => '8 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-10-15',
                'description' => 'Specialized Salesforce development bootcamp covering CRM customization, Apex programming, and Lightning components. Learn to build Salesforce solutions.',
                'features' => [
                    '320 hours of intensive training with Salesforce developers',
                    '12+ Salesforce development projects',
                    'Weekly 1-on-1 mentoring with Salesforce certified professionals',
                    'Industry-recognized certificate of completion',
                    'Salesforce certification preparation',
                    'Access to Salesforce development environment',
                    'Additional workshops (Salesforce Marketing Cloud, Integration)',
                    'Career services for Salesforce developer roles'
                ],
                'curriculum' => [
                    'Module 1: Salesforce Fundamentals and Navigation',
                    'Module 2: Data Modeling and Management',
                    'Module 3: Salesforce Automation (Flows, Process Builder)',
                    'Module 4: Apex Programming Fundamentals',
                    'Module 5: Lightning Component Development',
                    'Module 6: Visualforce Pages and Controllers',
                    'Module 7: Integration and APIs',
                    'Module 8: Salesforce Project and Certification Prep'
                ],
                'learning_outcomes' => [
                    'Navigate and customize Salesforce CRM',
                    'Design and implement data models',
                    'Create automated business processes',
                    'Write Apex code for custom functionality',
                    'Develop Lightning components',
                    'Build Visualforce pages',
                    'Integrate Salesforce with external systems',
                    'Prepare for Salesforce certification exams'
                ],
                'career_support' => [
                    'Salesforce skills assessment and career planning',
                    'Resume building for Salesforce developer roles',
                    'Interview preparation for Salesforce positions',
                    'Connections with Salesforce partners and customers',
                    'Access to exclusive Salesforce job postings',
                    '6 months of career guidance after completion',
                    'Salesforce project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of CRM concepts',
                    'Programming background (Java, C#, or similar preferred)',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 8 weeks',
                    'Interest in CRM and enterprise software'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Network Engineering Bootcamp: Infrastructure & Security',
                'slug' => 'network-engineering-bootcamp',
                'category_id' => 1, // Using existing category - Web Development
                'price' => 5999000,
                'original_price' => 8499000,
                'image' => env('APP_URL').'/storage/bootcamps/36.jpg',
                'rating' => 4.4,
                'students' => 210,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-11-01',
                'description' => 'Comprehensive network engineering bootcamp covering network design, implementation, and security. Learn to build and maintain robust network infrastructures.',
                'features' => [
                    '400 hours of intensive training with network engineers',
                    '15+ network design and implementation projects',
                    'Weekly 1-on-1 mentoring with senior network professionals',
                    'Industry-recognized certificate of completion',
                    'Network certification preparation (CompTIA Network+, CCNA)',
                    'Access to network simulation tools',
                    'Additional workshops (Cloud Networking, SD-WAN)',
                    'Career services for network engineer roles'
                ],
                'curriculum' => [
                    'Module 1: Networking Fundamentals',
                    'Module 2: Network Protocols and Standards',
                    'Module 3: Network Design and Architecture',
                    'Module 4: Network Implementation and Configuration',
                    'Module 5: Network Security and Firewalls',
                    'Module 6: Wireless Networking',
                    'Module 7: Network Monitoring and Troubleshooting',
                    'Module 8: Network Project and Certification Prep'
                ],
                'learning_outcomes' => [
                    'Understand networking concepts and protocols',
                    'Design scalable network architectures',
                    'Implement and configure network devices',
                    'Secure networks against threats',
                    'Deploy wireless network solutions',
                    'Monitor and troubleshoot network issues',
                    'Apply network best practices',
                    'Prepare for network certification exams'
                ],
                'career_support' => [
                    'Network skills assessment and career planning',
                    'Resume building for network engineer roles',
                    'Interview preparation for network positions',
                    'Connections with network equipment vendors and service providers',
                    'Access to exclusive network engineer job postings',
                    '6 months of career guidance after completion',
                    'Network project presentations to employers'
                ],
                'requirements' => [
                    'Basic understanding of computer networks',
                    'Familiarity with operating systems (Windows, Linux)',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 10 weeks',
                    'Interest in infrastructure and connectivity'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Robotics Process Automation (RPA) Bootcamp: Business Automation',
                'slug' => 'rpa-bootcamp',
                'category_id' => 2, // Using existing category - Data Science
                'price' => 5499000,
                'original_price' => 7999000,
                'image' => env('APP_URL').'/storage/bootcamps/37.jpg',
                'rating' => 4.3,
                'students' => 170,
                'duration' => '6 weeks',
                'level' => 'Beginner to Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-11-15',
                'description' => 'Practical RPA bootcamp covering automation tools, process design, and implementation. Learn to automate business processes and improve efficiency.',
                'features' => [
                    '240 hours of intensive training with RPA specialists',
                    '10+ automation projects across business processes',
                    'Weekly 1-on-1 mentoring with senior RPA professionals',
                    'Industry-recognized certificate of completion',
                    'Access to RPA tools and platforms',
                    'Additional workshops (Intelligent Automation, Process Mining)',
                    'Career services for RPA developer roles'
                ],
                'curriculum' => [
                    'Module 1: RPA Fundamentals and Concepts',
                    'Module 2: Process Analysis and Design',
                    'Module 3: UiPath Studio and Automation',
                    'Module 4: Automation Anywhere Development',
                    'Module 5: Blue Prism Implementation',
                    'Module 6: RPA in Finance and Accounting',
                    'Module 7: RPA Governance and Best Practices',
                    'Module 8: RPA Project and Certification Prep'
                ],
                'learning_outcomes' => [
                    'Understand RPA concepts and benefits',
                    'Analyze and design business processes for automation',
                    'Develop automation solutions with UiPath',
                    'Implement automation with Automation Anywhere',
                    'Build RPA bots with Blue Prism',
                    'Apply RPA to finance and accounting processes',
                    'Implement RPA governance and best practices',
                    'Complete a comprehensive RPA project'
                ],
                'career_support' => [
                    'RPA skills assessment and career planning',
                    'Resume building for RPA developer roles',
                    'Interview preparation for RPA positions',
                    'Connections with companies implementing RPA',
                    'Access to exclusive RPA job postings',
                    '6 months of career guidance after completion',
                    'RPA project presentations to employers'
                ],
                'requirements' => [
                    'No prior RPA experience required',
                    'Understanding of business processes',
                    'Basic programming knowledge (preferred but not required)',
                    'Laptop computer with minimum specifications (8GB RAM, i5/AMD Ryzen 5)',
                    'Ability to communicate in English',
                    'Full-time commitment for 6 weeks',
                    'Interest in automation and efficiency improvement'
                ],
                'is_active' => true
            ]
        ];

        // Merge original bootcamps with additional ones
        $allBootcamps = array_merge($bootcamps, $additionalBootcamps);

        $createdBootcamps = [];
        foreach ($allBootcamps as $bootcamp) {
            // Create bootcamp
            $createdBootcamp = Bootcamp::create($bootcamp);
            $createdBootcamps[$bootcamp['slug']] = $createdBootcamp;

            // Assign mentors to ALL bootcamps based on their category
            $mentorIds = $getMentorsForCategory($bootcamp['category_id']);
            $createdBootcamp->mentors()->attach($mentorIds);

            // Create modules for ALL bootcamps based on their curriculum
            if (isset($bootcamp['curriculum']) && is_array($bootcamp['curriculum'])) {
                $weekNumber = 1;
                foreach ($bootcamp['curriculum'] as $moduleTitle) {
                    ModuleBootcamp::create([
                        'bootcamp_id' => $createdBootcamp->id,
                        'week_number' => $weekNumber,
                        'module' => $moduleTitle,
                        'objective' => 'Master the concepts and skills covered in ' . $moduleTitle,
                        'description' => 'Comprehensive learning module covering ' . $moduleTitle . ' as part of the ' . $bootcamp['title'],
                        'topics' => ['Topic 1', 'Topic 2', 'Topic 3', 'Topic 4', 'Topic 5'], // Default topics
                        'duration_hours' => 40,
                        'is_active' => true
                    ]);
                    $weekNumber++;
                }
            }
        }
    }
}
