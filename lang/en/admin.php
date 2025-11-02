<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for the admin panel interface.
    | You are free to modify these language lines according to your application's requirements.
    |
    */

    'dashboard' => [
        'title' => 'Dashboard',
        'welcome' => 'Welcome to Admin Panel',
        'subtitle' => 'Manage content and monitor platform activity',
        'stats' => [
            'total_products' => 'Total Products',
            'total_bootcamps' => 'Total Bootcamps',
            'total_mentors' => 'Total Mentors',
            'total_users' => 'Total Users',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'upcoming' => 'Upcoming',
            'enrolled' => 'Enrolled',
            'from_last_month' => 'from last month'
        ]
    ],

    'navigation' => [
        'dashboard' => 'Dashboard',
        'content_management' => 'Content Management',
        'products' => 'Products',
        'bootcamps' => 'Bootcamps',
        'blogs' => 'Blogs',
        'people_management' => 'People Management',
        'users' => 'Users',
        'mentors' => 'Mentors',
        'system' => 'System',
        'settings' => 'Settings',
        'logout' => 'Logout'
    ],

    'products' => [
        'title' => 'Products Management',
        'subtitle' => 'Manage and monitor all educational products',
        'add_new' => 'Add New Product',
        'search_placeholder' => 'Search products...',
        'all_status' => 'All Status',
        'all_categories' => 'All Categories',
        'more_filters' => 'More Filters',
        'table_headers' => [
            'product' => 'Product',
            'instructor' => 'Instructor',
            'category' => 'Category',
            'price' => 'Price',
            'students' => 'Students',
            'rating' => 'Rating',
            'status' => 'Status',
            'actions' => 'Actions'
        ],
        'create' => [
            'title' => 'Create New Product',
            'subtitle' => 'Fill in the information to create a new product',
            'edit_title' => 'Edit Product',
            'edit_subtitle' => 'Update product information and settings'
        ],
        'form' => [
            'basic_info' => 'Basic Information',
            'content_curriculum' => 'Content & Curriculum',
            'media_assets' => 'Media & Assets',
            'pricing_settings' => 'Pricing & Settings',
            'product_title' => 'Product Title',
            'description' => 'Description',
            'category' => 'Category',
            'level' => 'Level',
            'duration' => 'Duration',
            'instructor' => 'Instructor',
            'features' => 'Features (one per line)',
            'curriculum' => 'Curriculum (one per line)',
            'product_image' => 'Product Image',
            'change_image' => 'Change Image',
            'upload_new' => 'Upload New Image',
            'price' => 'Price (Rp)',
            'original_price' => 'Original Price (Rp)',
            'product_status' => 'Product Status',
            'create_product' => 'Create Product',
            'update_product' => 'Update Product',
            'cancel' => 'Cancel'
        ]
    ],

    'bootcamps' => [
        'title' => 'Bootcamps Management',
        'subtitle' => 'Manage and monitor all intensive bootcamp programs',
        'add_new' => 'Add New Bootcamp',
        'search_placeholder' => 'Search bootcamps...',
        'table_headers' => [
            'bootcamp' => 'Bootcamp',
            'mentor' => 'Mentor',
            'category' => 'Category',
            'duration' => 'Duration',
            'start_date' => 'Start Date',
            'price' => 'Price',
            'enrolled' => 'Enrolled',
            'status' => 'Status',
            'actions' => 'Actions'
        ]
    ],

    'mentors' => [
        'title' => 'Mentors Management',
        'subtitle' => 'Manage and monitor all expert mentors and instructors',
        'add_new' => 'Add New Mentor',
        'search_placeholder' => 'Search mentors...',
        'all_specializations' => 'All Specializations',
        'students' => 'Students',
        'courses' => 'Courses',
        'bootcamps' => 'Bootcamps',
        'joined' => 'Joined',
        'rating' => 'rating',
        'edit' => 'Edit',
        'delete' => 'Delete'
    ],

    'blogs' => [
        'title' => 'Blog Management',
        'subtitle' => 'Manage and monitor all blog content',
        'add_new' => 'Create New Blog',
        'search_placeholder' => 'Search blogs...',
        'all_status' => 'All Status',
        'all_categories' => 'All Categories',
        'more_filters' => 'More Filters',
        'table_headers' => [
            'blog' => 'Blog',
            'author' => 'Author',
            'category' => 'Category',
            'status' => 'Status',
            'views' => 'Views',
            'date' => 'Date',
            'actions' => 'Actions'
        ],
        'create' => [
            'title' => 'Create New Blog',
            'subtitle' => 'Fill in the information to create a new blog post',
            'edit_title' => 'Edit Blog',
            'edit_subtitle' => 'Update blog information and content'
        ],
        'form' => [
            'basic_info' => 'Basic Information',
            'content_seo' => 'Content & SEO',
            'media_images' => 'Media & Images',
            'publishing' => 'Publishing',
            'blog_title' => 'Blog Title',
            'excerpt' => 'Excerpt',
            'category' => 'Category',
            'author' => 'Author',
            'content' => 'Blog Content',
            'seo_title' => 'SEO Title',
            'meta_description' => 'Meta Description',
            'tags' => 'Tags',
            'featured_image' => 'Featured Image',
            'change_image' => 'Change Image',
            'upload_new' => 'Upload New Image',
            'status' => 'Status',
            'publish_date' => 'Publish Date',
            'visibility' => 'Visibility',
            'categories' => 'Categories',
            'publish_blog' => 'Publish Blog',
            'update_blog' => 'Update Blog',
            'save_draft' => 'Save as Draft',
            'cancel' => 'Cancel'
        ]
    ],

    'common' => [
        'search' => 'Search...',
        'filter' => 'Filter',
        'previous' => 'Previous',
        'next' => 'Next',
        'showing_results' => 'Showing :start to :end of :total results',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'upcoming' => 'Upcoming',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'create' => 'Create',
        'update' => 'Update',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'close' => 'Close',
        'yes' => 'Yes',
        'no' => 'No',
        'confirm' => 'Confirm',
        'success' => 'Success',
        'error' => 'Error',
        'warning' => 'Warning',
        'info' => 'Information'
    ],

    'notifications' => [
        'title' => 'Notifications',
        'new_user' => 'New user registered: :name',
        'new_order' => 'New order: :order',
        'minutes_ago' => ':minutes minutes ago'
    ],

    'profile' => [
        'profile' => 'Profile',
        'settings' => 'Settings',
        'logout' => 'Logout'
    ]

];
