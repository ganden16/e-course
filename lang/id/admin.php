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
        'welcome' => 'Selamat datang di Panel Admin',
        'subtitle' => 'Kelola konten dan pantau aktivitas platform',
        'stats' => [
            'total_products' => 'Total Produk',
            'total_bootcamps' => 'Total Bootcamp',
            'total_mentors' => 'Total Mentor',
            'total_users' => 'Total Pengguna',
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            'upcoming' => 'Akan Datang',
            'enrolled' => 'Terdaftar',
            'from_last_month' => 'dari bulan lalu'
        ]
    ],

    'navigation' => [
        'dashboard' => 'Dashboard',
        'content_management' => 'Manajemen Konten',
        'products' => 'Produk',
        'bootcamps' => 'Bootcamp',
        'blogs' => 'Blog',
        'people_management' => 'Manajemen Orang',
        'users' => 'Pengguna',
        'mentors' => 'Mentor',
        'system' => 'Sistem',
        'settings' => 'Pengaturan',
        'logout' => 'Keluar'
    ],

    'products' => [
        'title' => 'Manajemen Produk',
        'subtitle' => 'Kelola dan pantau semua produk edukasi',
        'add_new' => 'Tambah Produk Baru',
        'search_placeholder' => 'Cari produk...',
        'all_status' => 'Semua Status',
        'all_categories' => 'Semua Kategori',
        'more_filters' => 'Filter Lebih Lanjut',
        'table_headers' => [
            'product' => 'Produk',
            'instructor' => 'Instruktur',
            'category' => 'Kategori',
            'price' => 'Harga',
            'students' => 'Siswa',
            'rating' => 'Rating',
            'status' => 'Status',
            'actions' => 'Aksi'
        ],
        'create' => [
            'title' => 'Buat Produk Baru',
            'subtitle' => 'Isi informasi untuk membuat produk baru',
            'edit_title' => 'Edit Produk',
            'edit_subtitle' => 'Perbarui informasi dan pengaturan produk'
        ],
        'form' => [
            'basic_info' => 'Informasi Dasar',
            'content_curriculum' => 'Konten & Kurikulum',
            'media_assets' => 'Media & Aset',
            'pricing_settings' => 'Harga & Pengaturan',
            'product_title' => 'Judul Produk',
            'description' => 'Deskripsi',
            'category' => 'Kategori',
            'level' => 'Level',
            'duration' => 'Durasi',
            'instructor' => 'Instruktur',
            'features' => 'Fitur (satu per baris)',
            'curriculum' => 'Kurikulum (satu per baris)',
            'product_image' => 'Gambar Produk',
            'change_image' => 'Ubah Gambar',
            'upload_new' => 'Unggah Gambar Baru',
            'price' => 'Harga (Rp)',
            'original_price' => 'Harga Asli (Rp)',
            'product_status' => 'Status Produk',
            'create_product' => 'Buat Produk',
            'update_product' => 'Perbarui Produk',
            'cancel' => 'Batal'
        ]
    ],

    'bootcamps' => [
        'title' => 'Manajemen Bootcamp',
        'subtitle' => 'Kelola dan pantau semua program bootcamp intensif',
        'add_new' => 'Tambah Bootcamp Baru',
        'search_placeholder' => 'Cari bootcamp...',
        'table_headers' => [
            'bootcamp' => 'Bootcamp',
            'mentor' => 'Mentor',
            'category' => 'Kategori',
            'duration' => 'Durasi',
            'start_date' => 'Tanggal Mulai',
            'price' => 'Harga',
            'enrolled' => 'Terdaftar',
            'status' => 'Status',
            'actions' => 'Aksi'
        ]
    ],

    'mentors' => [
        'title' => 'Manajemen Mentor',
        'subtitle' => 'Kelola dan pantau semua mentor dan instruktur ahli',
        'add_new' => 'Tambah Mentor Baru',
        'search_placeholder' => 'Cari mentor...',
        'all_specializations' => 'Semua Spesialisasi',
        'students' => 'Siswa',
        'courses' => 'Kursus',
        'bootcamps' => 'Bootcamp',
        'joined' => 'Bergabung',
        'rating' => 'rating',
        'edit' => 'Edit',
        'delete' => 'Hapus'
    ],

    'blogs' => [
        'title' => 'Manajemen Blog',
        'subtitle' => 'Kelola dan pantau semua konten blog',
        'add_new' => 'Buat Blog Baru',
        'search_placeholder' => 'Cari blog...',
        'all_status' => 'Semua Status',
        'all_categories' => 'Semua Kategori',
        'more_filters' => 'Filter Lebih Lanjut',
        'table_headers' => [
            'blog' => 'Blog',
            'author' => 'Penulis',
            'category' => 'Kategori',
            'status' => 'Status',
            'views' => 'Dilihat',
            'date' => 'Tanggal',
            'actions' => 'Aksi'
        ],
        'create' => [
            'title' => 'Buat Blog Baru',
            'subtitle' => 'Isi informasi untuk membuat postingan blog baru',
            'edit_title' => 'Edit Blog',
            'edit_subtitle' => 'Perbarui informasi dan konten blog'
        ],
        'form' => [
            'basic_info' => 'Informasi Dasar',
            'content_seo' => 'Konten & SEO',
            'media_images' => 'Media & Gambar',
            'publishing' => 'Penerbitan',
            'blog_title' => 'Judul Blog',
            'excerpt' => 'Ringkasan',
            'category' => 'Kategori',
            'author' => 'Penulis',
            'content' => 'Konten Blog',
            'seo_title' => 'Judul SEO',
            'meta_description' => 'Meta Deskripsi',
            'tags' => 'Tag',
            'featured_image' => 'Gambar Utama',
            'change_image' => 'Ubah Gambar',
            'upload_new' => 'Unggah Gambar Baru',
            'status' => 'Status',
            'publish_date' => 'Tanggal Terbit',
            'visibility' => 'Visibilitas',
            'categories' => 'Kategori',
            'publish_blog' => 'Terbitkan Blog',
            'update_blog' => 'Perbarui Blog',
            'save_draft' => 'Simpan sebagai Draft',
            'cancel' => 'Batal'
        ]
    ],

    'common' => [
        'search' => 'Cari...',
        'filter' => 'Filter',
        'previous' => 'Sebelumnya',
        'next' => 'Selanjutnya',
        'showing_results' => 'Menampilkan :start hingga :end dari :total hasil',
        'active' => 'Aktif',
        'inactive' => 'Tidak Aktif',
        'upcoming' => 'Akan Datang',
        'edit' => 'Edit',
        'delete' => 'Hapus',
        'create' => 'Buat',
        'update' => 'Perbarui',
        'cancel' => 'Batal',
        'save' => 'Simpan',
        'close' => 'Tutup',
        'yes' => 'Ya',
        'no' => 'Tidak',
        'confirm' => 'Konfirmasi',
        'success' => 'Berhasil',
        'error' => 'Error',
        'warning' => 'Peringatan',
        'info' => 'Informasi'
    ],

    'notifications' => [
        'title' => 'Notifikasi',
        'new_user' => 'User baru mendaftar: :name',
        'new_order' => 'Pesanan baru: :order',
        'minutes_ago' => ':minutes menit yang lalu'
    ],

    'profile' => [
        'profile' => 'Profil',
        'settings' => 'Pengaturan',
        'logout' => 'Keluar'
    ]

];
