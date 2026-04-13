<?php
// ambil data user dari session
$nama = $_SESSION['user'] ?? 'User';
$inisial = strtoupper(substr($nama, 0, 1));
?>

<div class="sidebar" id="sidebar">

    <button class="close-sidebar" onclick="toggleSidebar()">✕</button>

    <!-- HEADER -->
    <div class="sidebar-header">
        <h2>TaskHub</h2>
        <img src="/taskhub/assets/img/tasks.png" class="logo-img">
    </div>

    <!-- MENU -->
    <ul class="menu">
        <li class="<?= ($page == 'dashboard') ? 'active' : '' ?>">
            <a href="/taskhub/pages/admin/dashboard.php">
                <span>🏠</span> Dashboard
            </a>
        </li>

        <li class="<?= ($page == 'tasks') ? 'active' : '' ?>">
            <a href="/taskhub/pages/admin/tasks/tasks.php">
                <span>📋</span> Tasks
            </a>
        </li>

        <li class="<?= ($page == 'users') ? 'active' : '' ?>">
            <a href="/taskhub/pages/admin/users/users.php">
                <span>👥</span> Users
            </a>
        </li>
    </ul>

    <!-- PROFILE (BAWAH) -->
    <div class="sidebar-profile">
        <div class="avatar-mini"><?= $inisial ?></div>
        <p><?= $nama ?></p>
    </div>

</div>