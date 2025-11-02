<?php
return [
    // Site Information
    'site' => [
        'name' => 'Healthcare Remote Circle',
        'tagline' => 'Unlock Your Potential with Digital Learning',
        'description' => 'Leading e-learning platform providing quality digital courses and bootcamps to advance your career.',
        'logo' => 'assets/images/logo1.png',
        'email' => 'info@HealthCarea.com',
        'phone' => '+62 812-3456-7890',
        'address' => 'Surabaya, Indonesia'
    ],

    // Navigation
    'navigation' => [
        'home' => 'Home',
        'about' => 'About Us',
        'product' => 'Products',
        'blog' => 'Blog',
        'contact' => 'Contact',
        'bootcamp' => 'Bootcamp',
        'community' => 'Our Community',
        'browse_courses' => 'Browse Courses'
    ],

    // Hero Section
    'hero' => [
        'title' => 'Transform Your Career with Digital Learning',
        'subtitle' => 'Join thousands of students who have developed their careers through our comprehensive courses and bootcamps',
        'description' => 'Access high-quality digital courses and intensive bootcamps taught by industry experts. Learn at your own pace, anytime, anywhere.',
        'cta_text' => 'Explore Courses',
        'cta_secondary' => 'Join Community',
        'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80'
    ],

    // Stats Section
    'stats' => [
        'active_students' => 'Active Students',
        'expert_instructors' => 'Expert Instructors',
        'courses_available' => 'Courses Available',
        'satisfaction_rate' => 'Satisfaction Rate',
        'data' => [
            ['number' => '15,000+', 'label' => 'Active Students'],
            ['number' => '50+', 'label' => 'Expert Instructors'],
            ['number' => '100+', 'label' => 'Courses Available'],
            ['number' => '95%', 'label' => 'Satisfaction Rate']
        ]
    ],

    // Features Section
    'features' => [
        'title' => 'Why Choose Healthcare Remote Circle?',
        'subtitle' => 'We provide the best learning experience with comprehensive features designed to help you succeed.',
        'data' => [
            [
                'emoji' => '🌍',
                'title' => 'Learn From Anywhere',
                'description' => 'Access online training anytime, anywhere. Study flexibly and prepare for a successful career in remote healthcare.'
            ],
            [
                'emoji' => '🎓',
                'title' => 'Professionally Graded & Recognized Certificates',
                'description' => 'Earn a Graded Certificate of Completion, HIPAA Certificate, and Internship Certificate. Your final grade reflects your learning progress, practical performance, and internship outcomes.'
            ],
            [
                'emoji' => '👩‍⚕️',
                'title' => 'Expert & International Mentors',
                'description' => 'Learn from international mentors and healthcare professionals with real-world experience in digital healthcare and remote practice.'
            ],
            [
                'emoji' => '💬',
                'title' => 'Supportive Global Community',
                'description' => 'Join a worldwide network of healthcare professionals. At HRC, we Share, Learn, and Grow together.'
            ],
            [
                'emoji' => '💼',
                'title' => 'Unlimited Professional Career Coaching',
                'description' => 'Receive unlimited personalized 1-on-1 mentoring to help you build confidence, improve skills, and prepare for global remote healthcare opportunities.'
            ],
            [
                'emoji' => '📈',
                'title' => 'Practice-Based & Internship Programs',
                'description' => 'Gain real-world experience through internships with partner clinics, hands-on projects, and guided mentorship.'
            ],
            [
                'emoji' => '💡',
                'title' => 'Affordable Investment, Maximum Value',
                'description' => 'Enjoy high-quality training, mentorship, and career development — all at an accessible price for healthcare professionals worldwide.'
            ]
        ]
    ],

    // Featured Courses Section
    'featured_courses' => [
        'title' => 'Featured Courses',
        'subtitle' => 'Explore our most popular courses and start learning today.',
        'view_details' => 'View Details',
        'view_all_courses' => 'View All Courses',
        'data' => [
            [
                'id' => 1,
                'title' => 'Full Stack Web Development Bootcamp',
                'category' => 'Web Development',
                'price' => 899000,
                'original_price' => 1499000,
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
                'instructor' => 'David Anderson',
                'rating' => 4.8,
                'students' => 3420,
                'duration' => '42 hours',
                'level' => 'Beginner to Advanced',
                'description' => 'Learn web development from scratch with HTML, CSS, JavaScript, React, Node.js, and more.'
            ],
            [
                'id' => 2,
                'title' => 'Python for Data Science',
                'category' => 'Data Science',
                'price' => 799000,
                'original_price' => 1299000,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'instructor' => 'Dr. Sarah Mitchell',
                'rating' => 4.9,
                'students' => 2850,
                'duration' => '36 hours',
                'level' => 'Intermediate',
                'description' => 'Master Python programming for data science, machine learning, and data analysis.'
            ],
            [
                'id' => 3,
                'title' => 'Digital Marketing Mastery',
                'category' => 'Marketing',
                'price' => 699000,
                'original_price' => 1199000,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80',
                'instructor' => 'Emma Thompson',
                'rating' => 4.7,
                'students' => 1980,
                'duration' => '28 hours',
                'level' => 'Beginner',
                'description' => 'Learn digital marketing strategies including SEO, social media, content marketing, and more.'
            ]
        ]
    ],

    // Upcoming Bootcamps Section
    'upcoming_bootcamps' => [
        'title' => 'Upcoming Bootcamps',
        'subtitle' => 'Join our intensive bootcamps and accelerate your career.',
        'learn_more' => 'Learn More',
        'view_all_bootcamps' => 'View All Bootcamps',
        'data' => [
            [
                'id' => 1,
                'title' => 'Full Stack Web Development Bootcamp',
                'category' => 'Web Development',
                'price' => 5999000,
                'original_price' => 8999000,
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
                'instructor' => 'David Anderson',
                'rating' => 4.9,
                'students' => 450,
                'duration' => '12 weeks',
                'level' => 'Beginner to Advanced',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-02-01',
                'description' => 'Intensive 12-week bootcamp covering front-end and back-end development, databases, and deployment.'
            ],
            [
                'id' => 2,
                'title' => 'Data Science & Machine Learning Bootcamp',
                'category' => 'Data Science',
                'price' => 6999000,
                'original_price' => 9999000,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'instructor' => 'Dr. Sarah Mitchell',
                'rating' => 4.8,
                'students' => 320,
                'duration' => '14 weeks',
                'level' => 'Intermediate',
                'schedule' => 'Monday - Friday, 09:00 - 17:00',
                'start_date' => '2024-02-15',
                'description' => 'Comprehensive data science bootcamp covering statistics, machine learning, and data visualization.'
            ]
        ]
    ],

    // Latest Blog Section
    'latest_blog' => [
        'title' => 'Latest from Our Blog',
        'subtitle' => 'Stay updated with the latest trends and insights in tech and education.',
        'read_more' => 'Read More',
        'view_all_articles' => 'View All Articles',
        'data' => [
            [
                'id' => 1,
                'title' => 'The Future of Web Development: Trends to Watch in 2024',
                'excerpt' => 'Explore the latest trends shaping the future of web development, from AI-powered tools to advanced frameworks.',
                'author' => 'David Anderson',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
                'date' => '2024-01-15',
                'read_time' => '8 min read',
                'category' => 'Web Development',
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80'
            ],
            [
                'id' => 2,
                'title' => 'Getting Started with Machine Learning: A Beginner\'s Guide',
                'excerpt' => 'Learn the fundamentals of machine learning and how to start your journey to becoming an ML engineer.',
                'author' => 'Dr. Sarah Mitchell',
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
                'date' => '2024-01-12',
                'read_time' => '12 min read',
                'category' => 'Data Science',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
            ],
            [
                'id' => 3,
                'title' => 'Effective Digital Marketing Strategies for Small Businesses',
                'excerpt' => 'Discover cost-effective digital marketing strategies that can help small businesses compete with larger competitors.',
                'author' => 'Emma Thompson',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
                'date' => '2024-01-10',
                'read_time' => '10 min read',
                'category' => 'Marketing',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80'
            ]
        ]
    ],

    // Testimonials Section
    'testimonials' => [
        'title' => 'What Our Students Say',
        'subtitle' => 'Real stories from real students who have transformed their careers.',
        'data' => [
            [
                'name' => 'Sarah Johnson',
                'role' => 'Web Developer',
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
                'content' => 'Healthcare Remote Circle has truly transformed my career. The courses are comprehensive and the instructors are amazing!'
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Data Scientist',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
                'content' => 'The bootcamp I attended was intensive and practical. I got a job within a month after completing it.'
            ],
            [
                'name' => 'Amanda Rodriguez',
                'role' => 'UX Designer',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80',
                'content' => 'The flexibility to learn at my own pace while working full-time was invaluable. Highly recommended!'
            ]
        ]
    ],

    // CTA Section
    'cta' => [
        'title' => 'Ready to Start Your Learning Journey?',
        'subtitle' => 'Join thousands of students who are already transforming their careers with our courses.',
        'browse_courses' => 'Browse Courses',
        'contact_us' => 'Contact Us'
    ],

    // Footer
    'footer' => [
        'quick_links' => 'Quick Links',
        'support' => 'Support',
        'contact_info' => 'Contact Info',
        'newsletter' => 'Subscribe to Our Newsletter',
        'copyright' => 'Copyright',
        'all_rights_reserved' => 'All rights reserved',
        'subscribe' => 'Subscribe',
        'your_email' => 'Your email'
    ]
];
