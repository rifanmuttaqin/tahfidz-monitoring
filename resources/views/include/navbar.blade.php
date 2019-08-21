<?php use Yajra\Datatables\Datatables; ?>

<div class="sidebar-wrapper">
<div class="logo">
    <a href="<?= URL::to('/'); ?>" class="simple-text">
        TAHFIDZ APP
    </a>
</div>

<ul class="nav">
    <li class="<?= $active == 'home' ? 'active' : '' ?>">
        <a href="<?= URL::to('/'); ?>">
            <i class="pe-7s-graph"></i>
            <p>Home</p>
        </a>
    </li>
    <li class="<?= $active == 'user' ? 'active' : '' ?>">
        <a href="<?= URL::to('/user'); ?>">
            <i class="pe-7s-user"></i>
            <p>Pengguna</p>
        </a>
    </li>
    <li class="<?= $active == 'parent' ? 'active' : '' ?>">
        <a href="<?= URL::to('/parent'); ?>">
            <i class="pe-7s-id"></i>
            <p>Orang Tua</p>
        </a>
    </li>
    <li class="<?= $active == 'student_class' ? 'active' : '' ?>">
        <a href="<?= URL::to('/student-class'); ?>">
            <i class="pe-7s-note2"></i>
            <p>Kelas</p>
        </a>
    </li>
    <li class="<?= $active == 'siswa' ? 'active' : '' ?>">
        <a href="<?= URL::to('/siswa'); ?>">
            <i class="pe-7s-smile"></i>
            <p>Manajemen Siswa</p>
        </a>
    </li>
    <li class="<?= $active == 'assessment' ? 'active' : '' ?>">
        <a href="<?= URL::to('/assessment'); ?>">
            <i class="pe-7s-note2"></i>
            <p style="color: yellow">Penilaian Siswa</p>
        </a>
    </li>

</ul>
</div>

@push('scripts')

@endpush