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
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1559028006-44a26f024d6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
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

        // Create bootcamps
        $bootcamps = [
            [
                'title' => 'Full Stack Web Development Bootcamp: 4-Month Career Transformation',
                'slug' => 'full-stack-web-development-bootcamp',
                'category_id' => 1, // Web Development
                'price' => 5999000,
                'original_price' => 8999000,
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1559028006-44a26f024d6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80',
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
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
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

        $createdBootcamps = [];
        foreach ($bootcamps as $bootcamp) {
            $createdBootcamps[$bootcamp['slug']] = Bootcamp::create($bootcamp);
        }

        // Assign mentors to bootcamps
        $createdBootcamps['full-stack-web-development-bootcamp']->mentors()->attach([
            $createdMentors['david-anderson']->id,
            $createdMentors['sarah-johnson']->id
        ]);

        $createdBootcamps['data-science-machine-learning-bootcamp']->mentors()->attach([
            $createdMentors['sarah-mitchell']->id,
            $createdMentors['michael-chen']->id
        ]);

        $createdBootcamps['ux-ui-design-bootcamp']->mentors()->attach([
            $createdMentors['alex-rodriguez']->id,
            $createdMentors['emily-watson']->id
        ]);

        $createdBootcamps['digital-marketing-mastery-bootcamp']->mentors()->attach([
            $createdMentors['emma-thompson']->id,
            $createdMentors['james-rodriguez']->id
        ]);

        $createdBootcamps['mobile-app-development-bootcamp']->mentors()->attach([
            $createdMentors['james-wilson']->id,
            $createdMentors['lisa-chang']->id
        ]);

        // Create modules for each bootcamp
        $modules = [
            // Full Stack Web Development Modules
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 1,
                'module' => 'Web Fundamentals (HTML5, CSS3, JavaScript ES6+)',
                'objective' => 'Master the fundamentals of web development including HTML5, CSS3, and modern JavaScript.',
                'description' => 'Learn the building blocks of modern web development.',
                'topics' => ['HTML5 Semantic Elements', 'CSS3 Flexbox & Grid', 'JavaScript ES6+ Features', 'DOM Manipulation', 'Event Handling'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 2,
                'module' => 'Frontend Development with React.js',
                'objective' => 'Build dynamic user interfaces with React.js and understand component-based architecture.',
                'description' => 'Master the most popular frontend framework for building interactive UIs.',
                'topics' => ['React Components', 'State & Props', 'Hooks', 'React Router', 'Context API'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 3,
                'module' => 'State Management (Redux, Context API)',
                'objective' => 'Implement advanced state management patterns for complex applications.',
                'description' => 'Learn to manage application state effectively in large-scale applications.',
                'topics' => ['Redux Fundamentals', 'Actions & Reducers', 'Middleware', 'React Redux', 'Context API vs Redux'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 4,
                'module' => 'Backend with Node.js and Express.js',
                'objective' => 'Build RESTful APIs and server-side applications with Node.js.',
                'description' => 'Learn server-side JavaScript development with Express.js framework.',
                'topics' => ['Node.js Fundamentals', 'Express.js Setup', 'RESTful API Design', 'Middleware', 'Authentication'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 5,
                'module' => 'Databases (SQL, NoSQL with MongoDB)',
                'objective' => 'Design and implement efficient database solutions.',
                'description' => 'Master both relational and non-relational database systems.',
                'topics' => ['SQL Fundamentals', 'MySQL', 'MongoDB', 'Database Design', 'ORM with Mongoose'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 6,
                'module' => 'RESTful APIs and GraphQL',
                'objective' => 'Build and consume modern APIs for data communication.',
                'description' => 'Learn to create robust APIs for frontend-backend communication.',
                'topics' => ['REST Principles', 'API Testing', 'GraphQL Basics', 'Apollo Server', 'API Documentation'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 7,
                'module' => 'DevOps and Deployment (Docker, CI/CD)',
                'objective' => 'Deploy applications to production using modern DevOps practices.',
                'description' => 'Learn containerization and continuous integration/deployment.',
                'topics' => ['Docker Containers', 'CI/CD Pipelines', 'Cloud Deployment', 'Environment Management', 'Monitoring'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['full-stack-web-development-bootcamp']->id,
                'week_number' => 8,
                'module' => 'Final Project and Portfolio',
                'objective' => 'Build a complete full-stack application for your portfolio.',
                'description' => 'Apply all learned skills in a comprehensive final project.',
                'topics' => ['Project Planning', 'Development Sprints', 'Code Review', 'Testing', 'Deployment'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            // Data Science Modules
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 1,
                'module' => 'Python for Data Science (NumPy, Pandas, Matplotlib)',
                'objective' => 'Master Python libraries essential for data analysis and visualization.',
                'description' => 'Learn fundamental tools for data manipulation and visualization.',
                'topics' => ['NumPy Arrays', 'Pandas DataFrames', 'Data Cleaning', 'Matplotlib Visualization', 'Jupyter Notebooks'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 2,
                'module' => 'Statistics and Probability for Data Analysis',
                'objective' => 'Apply statistical concepts to real-world data problems.',
                'description' => 'Understand the mathematical foundations of data science.',
                'topics' => ['Descriptive Statistics', 'Probability Theory', 'Hypothesis Testing', 'Correlation', 'Regression Analysis'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 3,
                'module' => 'Machine Learning Fundamentals (Scikit-learn)',
                'objective' => 'Understand core concepts and algorithms in machine learning.',
                'description' => 'Learn the fundamentals of ML and implement basic algorithms.',
                'topics' => ['ML Types', 'Feature Engineering', 'Model Evaluation', 'Cross-Validation', 'Scikit-learn Basics'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 4,
                'module' => 'Supervised Learning (Regression, Classification)',
                'objective' => 'Build predictive models using supervised learning techniques.',
                'description' => 'Master regression and classification algorithms.',
                'topics' => ['Linear Regression', 'Logistic Regression', 'Decision Trees', 'Random Forest', 'SVM'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 5,
                'module' => 'Unsupervised Learning (Clustering, Dimensionality Reduction)',
                'objective' => 'Discover patterns in data using unsupervised learning.',
                'description' => 'Learn clustering and dimensionality reduction techniques.',
                'topics' => ['K-Means Clustering', 'Hierarchical Clustering', 'PCA', 't-SNE', 'Anomaly Detection'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 6,
                'module' => 'Deep Learning with TensorFlow and Keras',
                'objective' => 'Build neural networks for complex pattern recognition.',
                'description' => 'Introduction to deep learning and neural networks.',
                'topics' => ['Neural Networks', 'TensorFlow Basics', 'Keras API', 'CNNs', 'RNNs'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 7,
                'module' => 'Natural Language Processing (NLP)',
                'objective' => 'Process and analyze text data using NLP techniques.',
                'description' => 'Learn to work with unstructured text data.',
                'topics' => ['Text Preprocessing', 'Sentiment Analysis', 'Text Classification', 'Word Embeddings', 'Transformers'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['data-science-machine-learning-bootcamp']->id,
                'week_number' => 8,
                'module' => 'Final Project and Business Presentation',
                'objective' => 'Complete an end-to-end data science project.',
                'description' => 'Apply all techniques to solve a real business problem.',
                'topics' => ['Problem Definition', 'Data Collection', 'Model Building', 'Results Interpretation', 'Business Impact'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            // UX/UI Design Modules
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 1,
                'module' => 'UX/UI Design Fundamentals',
                'objective' => 'Understand the principles of user experience and interface design.',
                'description' => 'Learn the foundational concepts of design thinking.',
                'topics' => ['Design Principles', 'User Psychology', 'Visual Hierarchy', 'Color Theory', 'Typography'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 2,
                'module' => 'Design Thinking and User Research',
                'objective' => 'Conduct effective user research and apply design thinking.',
                'description' => 'Learn to understand user needs through research.',
                'topics' => ['Design Thinking Process', 'User Interviews', 'Surveys', 'Personas', 'User Journey Mapping'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 3,
                'module' => 'Information Architecture and Wireframing',
                'objective' => 'Structure information and create wireframes.',
                'description' => 'Learn to organize content and create basic layouts.',
                'topics' => ['Information Architecture', 'Sitemaps', 'User Flows', 'Wireframing Tools', 'Low-Fidelity Prototypes'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 4,
                'module' => 'Visual Design (Color, Typography, Layout)',
                'objective' => 'Create visually appealing interfaces.',
                'description' => 'Master visual design principles and tools.',
                'topics' => ['Color Systems', 'Typography', 'Layout Grids', 'Visual Consistency', 'Design Systems'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 5,
                'module' => 'Prototyping with Figma and Adobe XD',
                'objective' => 'Build interactive prototypes for testing.',
                'description' => 'Learn industry-standard prototyping tools.',
                'topics' => ['Figma Fundamentals', 'Components', 'Prototyping', 'Adobe XD', 'Handoff to Developers'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 6,
                'module' => 'Usability Testing and Iteration',
                'objective' => 'Test designs with real users and iterate.',
                'description' => 'Learn to validate design decisions through testing.',
                'topics' => ['Usability Testing', 'A/B Testing', 'User Feedback', 'Design Iteration', 'Metrics'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 7,
                'module' => 'Design Systems and Component Libraries',
                'objective' => 'Create scalable design systems.',
                'description' => 'Learn to build consistent design systems.',
                'topics' => ['Design Systems', 'Component Libraries', 'Style Guides', 'Documentation', 'Version Control'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['ux-ui-design-bootcamp']->id,
                'week_number' => 8,
                'module' => 'Portfolio Development and Presentation',
                'objective' => 'Build a professional design portfolio.',
                'description' => 'Showcase your best work effectively.',
                'topics' => ['Portfolio Curation', 'Case Studies', 'Presentation Skills', 'Personal Branding', 'Networking'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            // Digital Marketing Modules
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 1,
                'module' => 'Digital Marketing Fundamentals',
                'objective' => 'Understand the digital marketing landscape and core concepts.',
                'description' => 'Learn the foundations of digital marketing.',
                'topics' => ['Marketing Funnel', 'Customer Journey', 'Digital Channels', 'Marketing Metrics', 'Strategy Planning'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 2,
                'module' => 'Search Engine Optimization (SEO)',
                'objective' => 'Improve website visibility in search engines.',
                'description' => 'Master on-page and off-page SEO techniques.',
                'topics' => ['Keyword Research', 'On-Page SEO', 'Technical SEO', 'Link Building', 'SEO Tools'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 3,
                'module' => 'Search Engine Marketing (SEM) & Google Ads',
                'objective' => 'Create and manage paid search campaigns.',
                'description' => 'Learn to run effective Google Ads campaigns.',
                'topics' => ['Google Ads Interface', 'Campaign Setup', 'Bid Management', 'Quality Score', 'Conversion Tracking'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 4,
                'module' => 'Social Media Marketing (Instagram, Facebook, TikTok)',
                'objective' => 'Build brand presence on social media platforms.',
                'description' => 'Create engaging social media marketing campaigns.',
                'topics' => ['Platform Strategy', 'Content Creation', 'Community Management', 'Social Ads', 'Influencer Marketing'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 5,
                'module' => 'Content Marketing & Copywriting',
                'objective' => 'Create compelling content that converts.',
                'description' => 'Learn content strategy and persuasive writing.',
                'topics' => ['Content Strategy', 'Blog Writing', 'Copywriting', 'Storytelling', 'Content Distribution'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 6,
                'module' => 'Email Marketing & Marketing Automation',
                'objective' => 'Build automated email marketing funnels.',
                'description' => 'Learn to nurture leads through email campaigns.',
                'topics' => ['Email Design', 'List Building', 'Automation Workflows', 'A/B Testing', 'Analytics'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 7,
                'module' => 'Web Analytics & Data-Driven Marketing',
                'objective' => 'Measure and optimize marketing performance.',
                'description' => 'Use data to make informed marketing decisions.',
                'topics' => ['Google Analytics', 'Conversion Tracking', 'Attribution', 'ROI Analysis', 'Reporting'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['digital-marketing-mastery-bootcamp']->id,
                'week_number' => 8,
                'module' => 'Digital Marketing Strategy & ROI Measurement',
                'objective' => 'Develop comprehensive digital marketing strategies.',
                'description' => 'Create integrated marketing plans and measure success.',
                'topics' => ['Strategy Development', 'Budget Allocation', 'Channel Integration', 'ROI Calculation', 'Campaign Optimization'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            // Mobile App Development Modules
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 1,
                'module' => 'Mobile Development Fundamentals',
                'objective' => 'Understand mobile app development concepts and platforms.',
                'description' => 'Learn the fundamentals of mobile development.',
                'topics' => ['Mobile Platforms', 'App Lifecycle', 'UI Guidelines', 'Development Tools', 'App Store Processes'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 2,
                'module' => 'Swift and iOS Development (UIKit, SwiftUI)',
                'objective' => 'Build native iOS applications using Swift.',
                'description' => 'Master iOS development with modern frameworks.',
                'topics' => ['Swift Language', 'UIKit', 'SwiftUI', 'iOS APIs', 'App Architecture'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 3,
                'module' => 'Kotlin and Android Development',
                'objective' => 'Build native Android applications using Kotlin.',
                'description' => 'Learn Android development with modern tools.',
                'topics' => ['Kotlin Language', 'Android Studio', 'Android SDK', 'Material Design', 'App Components'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 4,
                'module' => 'Cross-Platform Development with Flutter',
                'objective' => 'Build apps for both iOS and Android with Flutter.',
                'description' => 'Learn cross-platform development with Flutter.',
                'topics' => ['Flutter Setup', 'Dart Language', 'Widgets', 'Navigation', 'Platform Integration'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 5,
                'module' => 'State Management (Provider, BLoC, Riverpod)',
                'objective' => 'Implement effective state management in Flutter apps.',
                'description' => 'Learn to manage application state effectively.',
                'topics' => ['State Management Concepts', 'Provider Pattern', 'BLoC Pattern', 'Riverpod', 'Best Practices'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 6,
                'module' => 'Networking & API Integration',
                'objective' => 'Connect apps to backend services and APIs.',
                'description' => 'Learn to implement networking in mobile apps.',
                'topics' => ['HTTP Requests', 'REST APIs', 'GraphQL', 'Authentication', 'Offline Support'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 7,
                'module' => 'Local Data Persistence (SQLite, Hive)',
                'objective' => 'Store and manage data locally on devices.',
                'description' => 'Learn local storage solutions for mobile apps.',
                'topics' => ['SQLite Database', 'Hive Storage', 'Data Models', 'Caching', 'Data Synchronization'],
                'duration_hours' => 40,
                'is_active' => true
            ],
            [
                'bootcamp_id' => $createdBootcamps['mobile-app-development-bootcamp']->id,
                'week_number' => 8,
                'module' => 'App Deployment & Maintenance',
                'objective' => 'Deploy apps to app stores and maintain them.',
                'description' => 'Learn the complete deployment process.',
                'topics' => ['App Store Submission', 'Google Play Console', 'Version Management', 'Updates', 'Analytics'],
                'duration_hours' => 40,
                'is_active' => true
            ]
        ];

        foreach ($modules as $module) {
            ModuleBootcamp::create($module);
        }
    }
}
