<?php

// Home
Breadcrumbs::for('home', function ($trail) {
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