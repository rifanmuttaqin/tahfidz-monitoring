<?php use Yajra\Datatables\Datatables; ?>

<div class="sidebar-wrapper">
<div class="logo">
    <a href="http://www.creative-tim.com" class="simple-text">
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
            <p>Manajemen Pengguna</p>
        </a>
    </li>
    <li>
        <a href="table.html">
            <i class="pe-7s-note2"></i>
            <p>Table List</p>
        </a>
    </li>
    <li>
        <a href="typography.html">
            <i class="pe-7s-news-paper"></i>
            <p>Typography</p>
        </a>
    </li>
    <li>
        <a href="icons.html">
            <i class="pe-7s-science"></i>
            <p>Icons</p>
        </a>
    </li>
    <li>
        <a href="maps.html">
            <i class="pe-7s-map-marker"></i>
            <p>Maps</p>
        </a>
    </li>
    <li>
        <a href="notifications.html">
            <i class="pe-7s-bell"></i>
            <p>Notifications</p>
        </a>
    </li>
</ul>
</div>