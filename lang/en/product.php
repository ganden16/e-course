<?php
return [
    // Hero Section
    'hero' => [
        'title' => 'Our Courses',
        'subtitle' => 'Explore our comprehensive range of courses designed to help you master new skills and advance your career.'
    ],

    // Filter Section
    'filter' => [
        'all_courses' => 'All Courses',
        'courses_available' => 'courses available',
        'all_categories' => 'All Categories',
        'sort_by' => 'Sort by',
        'price_low_high' => 'Price: Low to High',
        'price_high_low' => 'Price: High to Low',
        'highest_rated' => 'Highest Rated',
        'most_popular' => 'Most Popular'
    ],

    // Course Features
    'features' => [
        'title' => 'Why Learn With Us?',
        'subtitle' => 'We provide the best learning experience with comprehensive features.',
        'certificate' => [
            'title' => 'Certificate',
            'description' => 'Receive industry-recognized certificates upon completion'
        ],
        'lifetime_access' => [
            'title' => 'Lifetime Access',
            'description' => 'Get lifetime access to course materials and updates'
        ],
        'mobile_access' => [
            'title' => 'Mobile Access',
            'description' => 'Learn on the go with our mobile app'
        ],
        'support_24_7' => [
            'title' => '24/7 Support',
            'description' => 'Get help whenever you need it'
        ]
    ],

    // Course Details
    'course_details' => [
        'view_details' => 'View Details',
        'instructor' => 'Instructor',
        'duration' => 'Duration',
        'students' => 'students',
        'off' => 'OFF'
    ],

    // Product Details
    'product_details' => [
        'not_found' => 'Course Not Found',
        'not_exist' => 'The course you\'re looking for doesn\'t exist.',
        'browse_all' => 'Browse All Courses',
        'course_includes' => 'Course Includes:',
        'duration' => 'Duration',
        'level' => 'Level',
        'save' => 'Save',
        'enroll_now' => 'Enroll Now',
        'add_to_wishlist' => 'Add to Wishlist',
        'what_youll_learn' => 'What You\'ll Learn',
        'key_skills' => 'Key Skills',
        'career_benefits' => 'Career Benefits'
    ],

    // Instructor Section
    'instructor' => [
        'title' => 'Your Instructor',
        'rating' => 'Rating',
        'students' => 'Students',
        'content' => 'Content'
    ],

    // Related Courses
    'related_courses' => [
        'title' => 'Related Courses',
        'view_details' => 'View Details'
    ],

    // CTA Section
    'cta' => [
        'title' => 'Ready to Start Learning?',
        'subtitle' => 'Join thousands of students who are already advancing their careers with our courses.',
        'request_course' => 'Request a Course',
        'enroll_now' => 'Enroll in This Course'
    ],

    // Load More
    'load_more' => [
        'courses' => 'Load More Courses'
    ],

    // Product Detail Page
    'detail' => [
        'master_fundamentals' => 'Master the fundamentals of',
        'build_projects' => 'Build real-world projects and portfolio pieces',
        'learn_practices' => 'Learn industry best practices and standards',
        'develop_skills' => 'Develop problem-solving and critical thinking skills',
        'enhance_resume' => 'Enhance your resume with in-demand skills',
        'increase_earning' => 'Increase your earning potential',
        'access_opportunities' => 'Access new job opportunities',
        'join_community' => 'Join a community of professionals',
        'instructor_bio' => 'Expert {category} with over 10 years of industry experience. Passionate about teaching and helping students achieve their career goals.'
    ],

    // Products Data
    'products' => [
        [
            "id" => 1,
            "title" => "Complete Web Development Bootcamp: From Zero to Professional",
            "category" => "Web Development",
            "price" => 899000,
            "original_price" => 1499000,
            "image" => "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80",
            "instructor" => "David Anderson",
            "rating" => 4.8,
            "students" => 3420,
            "duration" => "42 hours",
            "level" => "Beginner to Advanced",
            "description" => "Learn web development from scratch with HTML, CSS, JavaScript, React, Node.js, and more. This comprehensive course is designed to take you from absolute beginner to professional web developer with a portfolio of real-world projects.",
            "features" => [
                "42 hours of high-quality video content",
                "100+ coding exercises with solutions",
                "5 real-world projects for your portfolio",
                "Industry-recognized certificate of completion",
                "Lifetime access to all materials and updates",
                "Mobile app access for learning on the go",
                "Exclusive Discord community for 24/7 support",
                "Weekly live Q&A sessions with the instructor"
            ],
            "curriculum" => [
                "HTML5 & CSS3: Basics to Advanced",
                "JavaScript ES6+: Fundamentals to Advanced Concepts",
                "React.js: Components, State, Hooks, and Redux",
                "Node.js & Express.js: Backend Development",
                "MongoDB: NoSQL Database",
                "RESTful API Design & Implementation",
                "Authentication & Authorization",
                "Deployment & DevOps Basics"
            ],
            "requirements" => [
                "No prior coding experience required",
                "Computer with internet access",
                "Motivation to learn and practice"
            ],
            "what_you_will_build" => [
                "Responsive Portfolio Website",
                "Todo List App with React",
                "Blog Platform with Node.js and MongoDB",
                "E-commerce Frontend with React",
                "RESTful API for Mobile Applications"
            ]
        ],
        [
            "id" => 2,
            "title" => "Python for Data Science: Analysis & Visualization",
            "category" => "Data Science",
            "price" => 799000,
            "original_price" => 1299000,
            "image" => "https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
            "instructor" => "Dr. Sarah Mitchell",
            "rating" => 4.9,
            "students" => 2850,
            "duration" => "36 hours",
            "level" => "Intermediate",
            "description" => "Master Python programming for data science, machine learning, and data analysis. This course is designed to give you practical skills in collecting, cleaning, analyzing, and visualizing data using Python.",
            "features" => [
                "36 hours of high-quality video content",
                "80+ coding exercises with real datasets",
                "10 real-world data analysis projects",
                "Industry-recognized certificate of completion",
                "Lifetime access to all materials and updates",
                "Downloadable resources (Jupyter notebooks)",
                "Access to exclusive Discord community",
                "Final project for your portfolio"
            ],
            "curriculum" => [
                "Python Fundamentals: Syntax, Data Structures, Functions",
                "NumPy: Arrays, Vectorized Operations, Linear Algebra",
                "Pandas: DataFrames, Data Cleaning, Manipulation",
                "Matplotlib & Seaborn: Data Visualization Techniques",
                "Web Scraping with BeautifulSoup & Requests",
                "API Integration for Data Collection",
                "Statistical Analysis with Python",
                "Introduction to Machine Learning with Scikit-learn"
            ],
            "requirements" => [
                "Basic programming understanding (Python preferred)",
                "Fundamental knowledge of statistics",
                "Computer with minimum specifications (4GB RAM)",
                "Anaconda installation (guided in the course)"
            ],
            "what_you_will_build" => [
                "Interactive Sales Analysis Dashboard",
                "Movie Recommendation System",
                "Social Media Sentiment Analysis",
                "COVID-19 Data Visualization",
                "Stock Price Prediction with Time Series"
            ]
        ],
        [
            "id" => 3,
            "title" => "Digital Marketing Mastery: Strategy & Implementation",
            "category" => "Marketing",
            "price" => 699000,
            "original_price" => 1199000,
            "image" => "https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80",
            "instructor" => "Emma Thompson",
            "rating" => 4.7,
            "students" => 1980,
            "duration" => "28 hours",
            "level" => "Beginner",
            "description" => "Learn digital marketing strategies including SEO, social media, content marketing, and more. This comprehensive course teaches you how to create, manage, and optimize effective digital marketing campaigns.",
            "features" => [
                "28 hours of high-quality video content",
                "50+ practical assignments with feedback",
                "8 real-world marketing campaign projects",
                "Industry-recognized certificate of completion",
                "Lifetime access to all materials and updates",
                "Downloadable campaign templates",
                "Community support and networking opportunities",
                "Access to free digital marketing tools"
            ],
            "curriculum" => [
                "Digital Marketing Fundamentals",
                "SEO: On-Page, Off-Page, Technical SEO",
                "Content Marketing: Strategy, Creation, Distribution",
                "Social Media Marketing: Platforms, Strategies, Analytics",
                "Email Marketing: Campaigns, Automation, Analytics",
                "PPC Advertising: Google Ads, Facebook Ads",
                "Analytics & Reporting: Google Analytics, KPIs",
                "Marketing Automation: Tools, Workflows, Best Practices"
            ],
            "requirements" => [
                "No prior marketing experience required",
                "Basic understanding of social media",
                "Computer with internet access",
                "Google and social media accounts (for practical exercises)"
            ],
            "what_you_will_build" => [
                "Content Strategy for E-commerce Business",
                "Google Ads Campaign for Startup",
                "3-Month Social Media Content Calendar",
                "Email Marketing Automation Funnel",
                "Marketing Analytics Dashboard"
            ]
        ],
        [
            "id" => 4,
            "title" => "UI/UX Design Fundamentals: Principles & Practice",
            "category" => "Design",
            "price" => 749000,
            "original_price" => 1249000,
            "image" => "https://images.unsplash.com/photo-1559028006-44a26f024d6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
            "instructor" => "Alex Rodriguez",
            "rating" => 4.8,
            "students" => 2150,
            "duration" => "32 hours",
            "level" => "Beginner to Intermediate",
            "description" => "Master the principles of user interface and user experience design. This course teaches you how to create intuitive, attractive, and user-centered designs for web and mobile applications.",
            "features" => [
                "32 hours of high-quality video content",
                "60+ design exercises with feedback",
                "6 portfolio projects to showcase to employers",
                "Industry-recognized certificate of completion",
                "Lifetime access to all materials and updates",
                "Access to design tools (Figma, Adobe XD)",
                "Discord community for feedback and collaboration",
                "Downloadable design templates"
            ],
            "curriculum" => [
                "Introduction to UI/UX Design",
                "Design Thinking Process",
                "User Research & Personas",
                "Information Architecture & Wireframing",
                "Visual Design Principles: Color, Typography, Layout",
                "Prototyping: Low-Fidelity to High-Fidelity",
                "Usability Testing & Iteration",
                "Design Systems & Component Libraries"
            ],
            "requirements" => [
                "No prior design experience required",
                "Computer with minimum specifications (4GB RAM)",
                "Access to Figma (free version available)",
                "Creativity and attention to detail"
            ],
            "what_you_will_build" => [
                "Mobile Banking App Wireframe",
                "E-commerce Website User Flow",
                "Analytics Dashboard High-Fidelity Prototype",
                "Fitness Mobile App Design System",
                "Travel Booking Website Complete UI Design"
            ]
        ],
        [
            "id" => 5,
            "title" => "Mobile App Development with Flutter: From Zero to Expert",
            "category" => "Mobile Development",
            "price" => 849000,
            "original_price" => 1399000,
            "image" => "https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
            "instructor" => "James Wilson",
            "rating" => 4.6,
            "students" => 1680,
            "duration" => "38 hours",
            "level" => "Intermediate",
            "description" => "Build beautiful mobile apps for iOS and Android using Flutter and Dart. This course teaches you how to create high-performance mobile applications with attractive UIs for both platforms using a single codebase.",
            "features" => [
                "38 hours of high-quality video content",
                "70+ coding exercises with solutions",
                "8 complete mobile apps for your portfolio",
                "Industry-recognized certificate of completion",
                "Lifetime access to all materials and updates",
                "Complete source code for all projects",
                "Discord community for 24/7 support",
                "Downloadable app templates"
            ],
            "curriculum" => [
                "Dart Programming Fundamentals",
                "Flutter Widgets & UI Components",
                "State Management: Provider, BLoC, Riverpod",
                "Navigation & Routing",
                "Networking & API Integration",
                "Local Data Persistence (SQLite, Hive)",
                "Push Notifications & Firebase Integration",
                "App Deployment: Google Play Store & Apple App Store"
            ],
            "requirements" => [
                "Basic understanding of OOP programming",
                "Familiarity with basic mobile app concepts",
                "Computer with minimum specifications (8GB RAM)",
                "Android Studio or VS Code with Flutter SDK"
            ],
            "what_you_will_build" => [
                "Weather App with API Integration",
                "Todo List App with Local Storage",
                "E-commerce App with State Management",
                "Social Media App with Firebase",
                "Music Streaming App with Offline Support"
            ]
        ],
        [
            "id" => 6,
            "title" => "Cybersecurity Fundamentals: Defense & Offense",
            "category" => "Security",
            "price" => 899000,
            "original_price" => 1499000,
            "image" => "https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80",
            "instructor" => "Robert Chang",
            "rating" => 4.9,
            "students" => 1230,
            "duration" => "40 hours",
            "level" => "Intermediate",
            "description" => "Learn the fundamentals of cybersecurity, ethical hacking, and network security. This course provides in-depth understanding of cybersecurity threats and how to protect systems from attacks.",
            "features" => [
                "40 hours of high-quality video content",
                "90+ practical exercises in virtual environment",
                "10 real-world security projects",
                "Industry-recognized certificate of completion",
                "Lifetime access to all materials and updates",
                "Access to virtual lab for hands-on practice",
                "Downloadable security tools",
                "Discord community for security discussions"
            ],
            "curriculum" => [
                "Introduction to Cybersecurity",
                "Network Security Fundamentals",
                "Cryptography & Encryption",
                "Ethical Hacking Methodologies",
                "Web Application Security (OWASP Top 10)",
                "System Security & Hardening",
                "Incident Response & Forensics",
                "Compliance & Legal Frameworks"
            ],
            "requirements" => [
                "Basic understanding of computer networks",
                "Familiarity with operating systems (Windows/Linux)",
                "Computer with minimum specifications (8GB RAM)",
                "Internet access for virtual labs"
            ],
            "what_you_will_build" => [
                "Network Security Monitoring System",
                "Vulnerability Assessment Scanner",
                "Secure Web Application",
                "Incident Response Plan",
                "Security Policy Framework"
            ]
        ]
    ]
];
