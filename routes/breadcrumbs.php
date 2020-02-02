<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('home-url', function ($trail) {
    $trail->push('Home', route('home'));
});

// Pengguna
Breadcrumbs::for('index-user', function ($trail) {
    $trail->push('Pengguna', route('index-user'));
});

Breadcrumbs::for('create-user', function ($trail) {
    $trail->parent('index-user');
    $trail->push('Tambah Pengguna', route('index-user'));
});

// Orangtua
Breadcrumbs::for('index-parent', function ($trail) {
    $trail->push('Orangtua', route('index-parent'));
});

Breadcrumbs::for('create-parent', function ($trail) {
    $trail->parent('index-parent');
    $trail->push('Tambah Orangtua', route('index-parent'));
});


// Kelas
Breadcrumbs::for('student-class', function ($trail) {
    $trail->push('Kelas', route('student-class'));
});

Breadcrumbs::for('create-student-class', function ($trail) {
    $trail->parent('student-class');
    $trail->push('Tambah Kelas', route('student-class'));
});

// Siswa

Breadcrumbs::for('siswa', function ($trail) {
    $trail->push('Siswa', route('siswa'));
});

Breadcrumbs::for('create-siswa', function ($trail) {
    $trail->parent('siswa');
    $trail->push('Tambah Siswa', route('siswa'));
});

// Role dan Permission
Breadcrumbs::for('role', function ($trail) {
    $trail->push('Role Permission', route('role'));
});

Breadcrumbs::for('create-role', function ($trail) {
    $trail->parent('role');
    $trail->push('Tambah Role', route('role'));
});

Breadcrumbs::for('update-role', function ($trail,$role) {
    $trail->parent('role'); 
    $trail->push('Update ('.Role::findOrFail($role)->name.')', route('role', Role::findOrFail($role)->name));
});

// Iqro
Breadcrumbs::for('iqro', function ($trail) {
    $trail->push('Iqro', route('iqro'));
});

Breadcrumbs::for('create-iqro', function ($trail) {
    $trail->parent('iqro');
    $trail->push('Tambah Iqro', route('iqro'));
});

// Alquran
Breadcrumbs::for('alquran', function ($trail) {
    $trail->push('Alquran', route('alquran'));
});

Breadcrumbs::for('create-alquran', function ($trail) {
    $trail->parent('alquran');
    $trail->push('Tambah alquran', route('alquran'));
});

// Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->push('Profile Pengguna', route('profile'));
});

// Assessment
Breadcrumbs::for('assessment', function ($trail) {
    $trail->push('Penilaian Santri', route('assessment'));
});

Breadcrumbs::for('create-assessment', function ($trail) {
    $trail->parent('assessment');
    $trail->push('Penilaian Hafalan', route('assessment'));
});

// Daily Report
Breadcrumbs::for('daily-report', function ($trail) {
    $trail->push('Laporan harian', route('daily-report'));
});

// Student Report
Breadcrumbs::for('student-report', function ($trail) {
    $trail->push('Laporan Per Siswa / Siswi', route('student-report'));
});

// Student Lack Report
Breadcrumbs::for('student-lack-report', function ($trail) {
    $trail->push('Laporan Tanggungan Siswa / Siswi', route('student-lack-report'));
});

// Action Log
Breadcrumbs::for('action-log', function ($trail) {
    $trail->push('Log Aksi', route('action-log'));
});

// Action Log
Breadcrumbs::for('notification', function ($trail) {
    $trail->push('Notifikasi', route('notification'));
});