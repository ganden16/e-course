<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create product categories first
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Courses covering web development technologies and frameworks',
                'is_active' => true
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Courses covering data analysis, machine learning, and AI',
                'is_active' => true
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Courses covering UI/UX design, graphic design, and visual arts',
                'is_active' => true
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Courses covering digital marketing, social media, and content strategy',
                'is_active' => true
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Courses covering iOS, Android, and cross-platform mobile development',
                'is_active' => true
            ]
        ];

        $createdCategories = [];
        foreach ($categories as $category) {
            $createdCategories[$category['slug']] = ProductCategory::create($category);
        }

        // Create products
        $products = [
            // Web Development Products
            [
                'title' => 'Complete JavaScript Course: From Beginner to Advanced',
                'slug' => 'complete-javascript-course',
                'product_category_id' => $createdCategories['web-development']->id,
                'instructor' => 'David Anderson',
                'price' => 2999000,
                'original_price' => 3999000,
                'image' => env('APP_URL').'/storage/products/16.jpg',
                'rating' => 4.8,
                'students' => 1250,
                'duration' => '8 weeks',
                'level' => 'Beginner to Advanced',
                'description' => 'Master JavaScript from basics to advanced concepts including ES6+, async programming, and modern frameworks.',
                'features' => [
                    '40 hours of video content',
                    'Downloadable code examples',
                    'Interactive exercises',
                    'Certificate of completion',
                    'Lifetime access to course updates'
                ],
                'curriculum' => [
                    'JavaScript Fundamentals',
                    'DOM Manipulation',
                    'ES6+ Features',
                    'Async Programming',
                    'Fetch API',
                    'Modern JavaScript Frameworks'
                ],
                'requirements' => [
                    'Basic HTML and CSS knowledge',
                    'Computer with internet access',
                    'Text editor (VS Code recommended)'
                ],
                'what_you_will_build' => [
                    'Interactive web applications',
                    'JavaScript-based games',
                    'Dynamic user interfaces',
                    'RESTful API clients'
                ],
                'is_active' => true
            ],
            [
                'title' => 'React.js Complete Guide',
                'slug' => 'react-js-complete-guide',
                'product_category_id' => $createdCategories['web-development']->id,
                'instructor' => 'Sarah Johnson',
                'price' => 3499000,
                'original_price' => 4999000,
                'image' => env('APP_URL').'/storage/products/17.jpg',
                'rating' => 4.9,
                'students' => 980,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'description' => 'Comprehensive React.js course covering components, state management, hooks, and best practices.',
                'features' => [
                    '35 hours of video content',
                    'Build 5 real-world projects',
                    'Downloadable source code',
                    'Certificate of completion',
                    'Community support'
                ],
                'curriculum' => [
                    'React Fundamentals',
                    'Components and Props',
                    'State Management',
                    'Hooks',
                    'React Router',
                    'Context API'
                ],
                'requirements' => [
                    'JavaScript knowledge',
                    'HTML and CSS skills',
                    'Node.js and npm installed'
                ],
                'what_you_will_build' => [
                    'Single-page applications',
                    'React component libraries',
                    'Progressive web apps',
                    'React Native mobile apps'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Node.js Backend Development',
                'slug' => 'nodejs-backend-development',
                'product_category_id' => $createdCategories['web-development']->id,
                'instructor' => 'David Anderson',
                'price' => 3999000,
                'original_price' => 5499000,
                'image' => env('APP_URL').'/storage/products/18.jpg',
                'rating' => 4.7,
                'students' => 750,
                'duration' => '12 weeks',
                'level' => 'Intermediate',
                'description' => 'Learn to build scalable backend applications with Node.js, Express, and MongoDB.',
                'features' => [
                    '45 hours of video content',
                    'Build 3 complete backend projects',
                    'RESTful API development',
                    'Authentication and authorization',
                    'Database integration'
                ],
                'curriculum' => [
                    'Node.js Fundamentals',
                    'Express.js Framework',
                    'MongoDB Database',
                    'RESTful APIs',
                    'Authentication & Security',
                    'Deployment with Docker'
                ],
                'requirements' => [
                    'JavaScript knowledge',
                    'Basic command line skills',
                    'Computer with internet access'
                ],
                'what_you_will_build' => [
                    'RESTful APIs',
                    'Real-time applications',
                    'Authentication systems',
                    'Scalable backend services'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Vue.js: The Complete Guide',
                'slug' => 'vuejs-complete-guide',
                'product_category_id' => $createdCategories['web-development']->id,
                'instructor' => 'Sarah Johnson',
                'price' => 3299000,
                'original_price' => 4299000,
                'image' => env('APP_URL').'/storage/products/19.jpg',
                'rating' => 4.6,
                'students' => 620,
                'duration' => '8 weeks',
                'level' => 'Beginner to Intermediate',
                'description' => 'Master Vue.js from basics to advanced concepts including components, routing, and state management.',
                'features' => [
                    '30 hours of video content',
                    'Build 4 interactive projects',
                    'Vue 3 composition API',
                    'Vuex state management',
                    'Vue Router'
                ],
                'curriculum' => [
                    'Vue.js Fundamentals',
                    'Components and Templates',
                    'Vue Router',
                    'State Management with Vuex',
                    'Composition API',
                    'Vue 3 Features'
                ],
                'requirements' => [
                    'HTML, CSS, and JavaScript knowledge',
                    'Basic understanding of frontend frameworks'
                ],
                'what_you_will_build' => [
                    'Interactive single-page applications',
                    'Progressive web apps',
                    'Component-based UIs',
                    'Vue 3 applications'
                ],
                'is_active' => true
            ],
            [
                'title' => 'HTML & CSS: Modern Web Design',
                'slug' => 'html-css-modern-web-design',
                'product_category_id' => $createdCategories['web-development']->id,
                'instructor' => 'Emily Watson',
                'price' => 1999000,
                'original_price' => 2999000,
                'image' => env('APP_URL').'/storage/products/20.jpg',
                'rating' => 4.5,
                'students' => 890,
                'duration' => '6 weeks',
                'level' => 'Beginner',
                'description' => 'Learn modern HTML5 and CSS3 including Flexbox, Grid, and responsive design.',
                'features' => [
                    '24 hours of video content',
                    'Build 10 responsive web pages',
                    'CSS animations and transitions',
                    'Modern layout techniques',
                    'Mobile-first design'
                ],
                'curriculum' => [
                    'HTML5 Semantic Elements',
                    'CSS3 Selectors and Properties',
                    'Flexbox Layout',
                    'CSS Grid Layout',
                    'Responsive Design',
                    'CSS Animations',
                    'Modern CSS Techniques'
                ],
                'requirements' => [
                    'No prior experience needed',
                    'Computer with internet access',
                    'Text editor (any)'
                ],
                'what_you_will_build' => [
                    'Responsive web pages',
                    'Modern web layouts',
                    'Interactive UI components',
                    'Mobile-friendly websites'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Python for Data Science',
                'slug' => 'python-data-science',
                'product_category_id' => $createdCategories['data-science']->id,
                'instructor' => 'Dr. Sarah Mitchell',
                'price' => 4499000,
                'original_price' => 5999000,
                'image' => env('APP_URL').'/storage/products/21.jpg',
                'rating' => 4.9,
                'students' => 1100,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'description' => 'Learn Python for data analysis, visualization, and machine learning.',
                'features' => [
                    '40 hours of video content',
                    'Jupyter notebooks with examples',
                    'Real-world datasets',
                    'Python libraries (NumPy, Pandas, Matplotlib)',
                    'Machine learning projects'
                ],
                'curriculum' => [
                    'Python Fundamentals',
                    'NumPy for Data Analysis',
                    'Pandas for Data Manipulation',
                    'Matplotlib for Visualization',
                    'Data Cleaning and Preparation',
                    'Machine Learning with Scikit-learn',
                    'Final Data Science Project'
                ],
                'requirements' => [
                    'Basic programming knowledge',
                    'Understanding of mathematics (statistics preferred)',
                    'Computer with internet access'
                ],
                'what_you_will_build' => [
                    'Data analysis scripts',
                    'Data visualizations',
                    'Machine learning models',
                    'Jupyter notebooks',
                    'Data science portfolio'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Machine Learning with TensorFlow',
                'slug' => 'machine-learning-tensorflow',
                'product_category_id' => $createdCategories['data-science']->id,
                'instructor' => 'Dr. Sarah Mitchell',
                'price' => 5999000,
                'original_price' => 7999000,
                'image' => env('APP_URL').'/storage/products/22.jpg',
                'rating' => 4.8,
                'students' => 850,
                'duration' => '12 weeks',
                'level' => 'Advanced',
                'description' => 'Deep dive into neural networks, deep learning, and TensorFlow.',
                'features' => [
                    '50 hours of video content',
                    'Build 5 neural network projects',
                    'TensorFlow and Keras tutorials',
                    'GPU access for training',
                    'Advanced ML techniques'
                ],
                'curriculum' => [
                    'Neural Network Fundamentals',
                    'TensorFlow and Keras',
                    'Convolutional Neural Networks',
                    'Recurrent Neural Networks',
                    'Natural Language Processing',
                    'Deep Learning Project'
                ],
                'requirements' => [
                    'Python programming required',
                    'Mathematics (linear algebra, calculus)',
                    'Basic ML concepts',
                    'Computer with GPU (recommended)'
                ],
                'what_you_will_build' => [
                    'Neural network models',
                    'Computer vision applications',
                    'NLP models',
                    'Deep learning systems',
                    'ML portfolio'
                ],
                'is_active' => true
            ],
            // Data Science Products
            [
                'title' => 'Data Visualization with D3.js',
                'slug' => 'data-visualization-d3js',
                'product_category_id' => $createdCategories['data-science']->id,
                'instructor' => 'Michael Chen',
                'price' => 3799000,
                'original_price' => 4999000,
                'image' => env('APP_URL').'/storage/products/23.jpg',
                'rating' => 4.7,
                'students' => 650,
                'duration' => '8 weeks',
                'level' => 'Intermediate',
                'description' => 'Create interactive data visualizations with D3.js.',
                'features' => [
                    '30 hours of video content',
                    'Build 10 data visualization projects',
                    'D3.js library tutorials',
                    'Interactive dashboard creation',
                    'Real-world datasets'
                ],
                'curriculum' => [
                    'D3.js Fundamentals',
                    'Data Binding and Selection',
                    'Scales and Axes',
                    'Shapes and Paths',
                    'Animations and Transitions',
                    'Interactive Dashboards',
                    'Advanced D3.js Techniques'
                ],
                'requirements' => [
                    'JavaScript knowledge',
                    'HTML, CSS, and SVG basics',
                    'Understanding of data concepts'
                ],
                'what_you_will_build' => [
                    'Interactive data visualizations',
                    'Dynamic dashboards',
                    'Data-driven web applications',
                    'D3.js portfolio'
                ],
                'is_active' => true
            ],
            [
                'title' => 'SQL for Data Analysis',
                'slug' => 'sql-data-analysis',
                'product_category_id' => $createdCategories['data-science']->id,
                'instructor' => 'Michael Chen',
                'price' => 3299000,
                'original_price' => 4299000,
                'image' => env('APP_URL').'/storage/products/24.jpg',
                'rating' => 4.6,
                'students' => 720,
                'duration' => '6 weeks',
                'level' => 'Beginner to Intermediate',
                'description' => 'Master SQL for data extraction, manipulation, and analysis.',
                'features' => [
                    '25 hours of video content',
                    'SQL query examples',
                    'Database design principles',
                    'Data analysis techniques',
                    'Real-world case studies'
                ],
                'curriculum' => [
                    'SQL Fundamentals',
                    'Data Definition Language (DDL)',
                    'Data Manipulation Language (DML)',
                    'Data Query Language (DQL)',
                    'Joins and Subqueries',
                    'Database Design',
                    'SQL for Analytics'
                ],
                'requirements' => [
                    'Basic computer skills',
                    'Understanding of data concepts',
                    'No prior SQL experience needed'
                ],
                'what_you_will_build' => [
                    'Complex SQL queries',
                    'Database designs',
                    'Data analysis reports',
                    'SQL portfolio'
                ],
                'is_active' => true
            ],
            // Design Products
            [
                'title' => 'UI/UX Design Fundamentals',
                'slug' => 'ui-ux-design-fundamentals',
                'product_category_id' => $createdCategories['design']->id,
                'instructor' => 'Alex Rodriguez',
                'price' => 3999000,
                'original_price' => 5499000,
                'image' => env('APP_URL').'/storage/products/27.jpg',
                'rating' => 4.8,
                'students' => 920,
                'duration' => '8 weeks',
                'level' => 'Beginner',
                'description' => 'Learn the fundamentals of user interface and user experience design.',
                'features' => [
                    '32 hours of video content',
                    'Design thinking exercises',
                    'Wireframing and prototyping',
                    'Usability testing',
                    'Design tools training'
                ],
                'curriculum' => [
                    'Design Principles',
                    'User Research',
                    'Information Architecture',
                    'Wireframing',
                    'Prototyping',
                    'Visual Design',
                    'Usability Testing',
                    'Design Portfolio'
                ],
                'requirements' => [
                    'No prior design experience needed',
                    'Computer with internet access',
                    'Interest in user psychology'
                ],
                'what_you_will_build' => [
                    'User personas and journeys',
                    'Wireframes and prototypes',
                    'User interfaces',
                    'Design portfolio',
                    'Usability test reports'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Figma: Advanced UI Design',
                'slug' => 'figma-advanced-ui-design',
                'product_category_id' => $createdCategories['design']->id,
                'instructor' => 'Emily Watson',
                'price' => 4299000,
                'original_price' => 5999000,
                'image' => env('APP_URL').'/storage/products/26.jpg',
                'rating' => 4.7,
                'students' => 780,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'description' => 'Master Figma for advanced UI design, prototyping, and collaboration.',
                'features' => [
                    '40 hours of video content',
                    'Advanced Figma techniques',
                    'Component design systems',
                    'Collaboration workflows',
                    'Design system creation',
                    'Figma plugins'
                ],
                'curriculum' => [
                    'Advanced Figma Techniques',
                    'Component Libraries',
                    'Design Systems',
                    'Prototyping with Figma',
                    'Collaboration Features',
                    'Figma API',
                    'Advanced UI Design'
                ],
                'requirements' => [
                    'Basic design knowledge',
                    'Figma experience (recommended)',
                    'Computer with internet access'
                ],
                'what_you_will_build' => [
                    'Advanced UI designs',
                    'Design systems',
                    'Interactive prototypes',
                    'Collaborative workflows',
                    'Figma portfolio'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Adobe Creative Cloud',
                'slug' => 'adobe-creative-cloud',
                'product_category_id' => $createdCategories['design']->id,
                'instructor' => 'Emily Watson',
                'price' => 5499000,
                'original_price' => 7499000,
                'image' => env('APP_URL').'/storage/products/27.jpg',
                'rating' => 4.6,
                'students' => 650,
                'duration' => '12 weeks',
                'level' => 'Intermediate',
                'description' => 'Master Adobe Creative Cloud including Photoshop, Illustrator, XD, and more.',
                'features' => [
                    '48 hours of video content',
                    'All Adobe CC applications',
                    'Creative project files',
                    'Industry-standard techniques',
                    'Certificate of completion'
                ],
                'curriculum' => [
                    'Photoshop Fundamentals',
                    'Illustrator for Design',
                    'Adobe XD for Prototyping',
                    'After Effects for Motion',
                    'Creative Cloud Workflow',
                    'Integration Techniques',
                    'Portfolio Development'
                ],
                'requirements' => [
                    'Computer with decent specifications',
                    'Creative mindset',
                    'Interest in digital arts'
                ],
                'what_you_will_build' => [
                    'Professional designs',
                    'Digital art portfolios',
                    'Creative projects',
                    'Adobe skills certification'
                ],
                'is_active' => true
            ],
            // Marketing Products
            [
                'title' => 'Digital Marketing Fundamentals',
                'slug' => 'digital-marketing-fundamentals',
                'product_category_id' => $createdCategories['marketing']->id,
                'instructor' => 'Emma Thompson',
                'price' => 3499000,
                'original_price' => 4999000,
                'image' => env('APP_URL').'/storage/products/19.jpg',
                'students' => 890,
                'duration' => '8 weeks',
                'level' => 'Beginner',
                'description' => 'Learn the fundamentals of digital marketing including SEO, social media, and content strategy.',
                'features' => [
                    '32 hours of video content',
                    'Marketing strategy templates',
                    'SEO tools training',
                    'Social media management',
                    'Content calendar creation'
                ],
                'curriculum' => [
                    'Marketing Fundamentals',
                    'Search Engine Optimization',
                    'Social Media Marketing',
                    'Content Marketing',
                    'Email Marketing',
                    'Web Analytics',
                    'Digital Marketing Strategy'
                ],
                'requirements' => [
                    'No prior marketing experience needed',
                    'Computer with internet access',
                    'Interest in business growth'
                ],
                'what_you_will_build' => [
                    'Marketing plans',
                    'SEO strategies',
                    'Social media campaigns',
                    'Content calendars',
                    'Analytics reports'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Social Media Marketing Mastery',
                'slug' => 'social-media-marketing-mastery',
                'product_category_id' => $createdCategories['marketing']->id,
                'instructor' => 'James Rodriguez',
                'price' => 3999000,
                'original_price' => 5499000,
                'image' => env('APP_URL').'/storage/products/29.jpg',
                'rating' => 4.6,
                'students' => 750,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'description' => 'Master social media marketing across multiple platforms.',
                'features' => [
                    '40 hours of video content',
                    'Platform-specific strategies',
                    'Content creation tools',
                    'Analytics and reporting',
                    'Community management'
                ],
                'curriculum' => [
                    'Social Media Strategy',
                    'Content Creation',
                    'Platform Management',
                    'Community Engagement',
                    'Social Media Analytics',
                    'Paid Advertising',
                    'Influencer Marketing'
                ],
                'requirements' => [
                    'Basic marketing knowledge',
                    'Social media experience',
                    'Content creation skills'
                ],
                'what_you_will_build' => [
                    'Multi-platform campaigns',
                    'Engaging content',
                    'Social media strategies',
                    'Analytics reports',
                    'Community management'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Google Ads Certification',
                'slug' => 'google-ads-certification',
                'product_category_id' => $createdCategories['marketing']->id,
                'instructor' => 'James Rodriguez',
                'price' => 4299000,
                'original_price' => 5999000,
                'image' => env('APP_URL').'/storage/products/30.jpg',
                'rating' => 4.5,
                'students' => 620,
                'duration' => '6 weeks',
                'level' => 'Intermediate',
                'description' => 'Prepare for Google Ads certification with comprehensive training.',
                'features' => [
                    '30 hours of video content',
                    'Practice exams',
                    'Google Ads interface training',
                    'Campaign optimization techniques',
                    'Certification preparation'
                ],
                'curriculum' => [
                    'Google Ads Fundamentals',
                    'Search Campaign Management',
                    'Display Campaign Management',
                    'Video Campaign Management',
                    'Shopping Campaign Management',
                    'Performance Optimization',
                    'Certification Preparation'
                ],
                'requirements' => [
                    'Basic marketing knowledge',
                    'Google account (required)',
                    'Analytical skills'
                ],
                'what_you_will_build' => [
                    'Google Ads campaigns',
                    'Performance reports',
                    'Certification readiness',
                    'Google Ads portfolio'
                ],
                'is_active' => true
            ],
            // Mobile Development Products
            [
                'title' => 'iOS Development with Swift',
                'slug' => 'ios-development-swift',
                'product_category_id' => $createdCategories['mobile-development']->id,
                'instructor' => 'James Wilson',
                'price' => 5999000,
                'original_price' => 7999000,
                'image' => env('APP_URL').'/storage/products/31.jpg',
                'rating' => 4.8,
                'students' => 580,
                'duration' => '12 weeks',
                'level' => 'Intermediate',
                'description' => 'Learn to build native iOS applications with Swift and SwiftUI.',
                'features' => [
                    '48 hours of video content',
                    'Swift programming tutorials',
                    'iOS development guides',
                    'App Store deployment',
                    'SwiftUI interface design'
                ],
                'curriculum' => [
                    'Swift Language Fundamentals',
                    'iOS App Architecture',
                    'UIKit and SwiftUI',
                    'Core iOS Frameworks',
                    'App Store Submission',
                    'iOS Design Patterns'
                ],
                'requirements' => [
                    'Mac computer (recommended)',
                    'Xcode installed',
                    'Basic programming knowledge',
                    'iOS device (for testing)'
                ],
                'what_you_will_build' => [
                    'Native iOS applications',
                    'SwiftUI interfaces',
                    'App Store ready apps',
                    'iOS development portfolio'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Android Development with Kotlin',
                'slug' => 'android-development-kotlin',
                'product_category_id' => $createdCategories['mobile-development']->id,
                'instructor' => 'Lisa Chang',
                'price' => 5499000,
                'original_price' => 7499000,
                'image' => env('APP_URL').'/storage/products/30.jpg',
                'rating' => 4.9,
                'students' => 520,
                'duration' => '12 weeks',
                'level' => 'Intermediate',
                'description' => 'Learn to build native Android applications with Kotlin and modern Android tools.',
                'features' => [
                    '48 hours of video content',
                    'Kotlin programming tutorials',
                    'Android Studio guides',
                    'Google Play deployment',
                    'Material Design implementation'
                ],
                'curriculum' => [
                    'Kotlin Language Fundamentals',
                    'Android SDK and Tools',
                    'Activity and Fragment Management',
                    'Material Design',
                    'Networking and APIs',
                    'Google Play Submission'
                ],
                'requirements' => [
                    'Computer with Android Studio',
                    'Basic Java knowledge',
                    'Android device (for testing)'
                ],
                'what_you_will_build' => [
                    'Native Android applications',
                    'Material Design interfaces',
                    'Google Play ready apps',
                    'Android development portfolio'
                ],
                'is_active' => true
            ],
            [
                'title' => 'React Native Cross-Platform Development',
                'slug' => 'react-native-cross-platform',
                'product_category_id' => $createdCategories['mobile-development']->id,
                'instructor' => 'James Wilson',
                'price' => 6499000,
                'original_price' => 8999000,
                'image' => env('APP_URL').'/storage/products/33.jpg',
                'rating' => 4.7,
                'students' => 420,
                'duration' => '14 weeks',
                'level' => 'Advanced',
                'description' => 'Build cross-platform mobile apps with React Native.',
                'features' => [
                    '56 hours of video content',
                    'React Native tutorials',
                    'iOS and Android deployment',
                    'Native module integration',
                    'Performance optimization'
                ],
                'curriculum' => [
                    'React Native Fundamentals',
                    'Components and Navigation',
                    'State Management',
                    'Native Modules',
                    'Platform-Specific Code',
                    'Deployment and Publishing'
                ],
                'requirements' => [
                    'React knowledge',
                    'JavaScript proficiency',
                    'Mobile development concepts',
                    'Computer with decent specifications'
                ],
                'what_you_will_build' => [
                    'Cross-platform mobile apps',
                    'React Native components',
                    'Native module integrations',
                    'App Store and Play Store apps',
                    'Mobile development portfolio'
                ],
                'is_active' => true
            ],
            [
                'title' => 'Flutter Development',
                'slug' => 'flutter-development',
                'product_category_id' => $createdCategories['mobile-development']->id,
                'instructor' => 'Lisa Chang',
                'price' => 5999000,
                'original_price' => 7999000,
                'image' => env('APP_URL').'/storage/products/16.jpg',
                'rating' => 4.6,
                'students' => 380,
                'duration' => '10 weeks',
                'level' => 'Intermediate',
                'description' => 'Learn to build beautiful cross-platform apps with Flutter.',
                'features' => [
                    '40 hours of video content',
                    'Flutter tutorials',
                    'Dart language guide',
                    'Widget libraries',
                    'Multi-platform deployment'
                ],
                'curriculum' => [
                    'Flutter Fundamentals',
                    'Dart Programming',
                    'Widget Development',
                    'State Management',
                    'Navigation and Routing',
                    'Platform Integration',
                    'Advanced Flutter Techniques'
                ],
                'requirements' => [
                    'Basic programming knowledge',
                    'Computer with decent specifications',
                    'Interest in mobile development'
                ],
                'what_you_will_build' => [
                    'Cross-platform mobile apps',
                    'Flutter UI components',
                    'Multi-platform deployments',
                    'Flutter development portfolio'
                ],
                'is_active' => true
            ]
        ];

        $createdProducts = [];
        foreach ($products as $product) {
            // Generate slug if empty
            if (empty($product['slug'])) {
                $product['slug'] = Str::slug($product['title']);
            }

            $createdProducts[$product['slug']] = Product::create($product);
        }
    }
}
