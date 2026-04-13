<?php
$breadcrumb = [
    'dashboard' => 'Dashboard',
    'tasks' => 'Tasks',
    'users' => 'Users'
];

$nama = $_SESSION['user'] ?? 'User';
?>

<div class="navbar-admin">

    <!-- KIRI -->
    <div class="nav-left">
    <button class="close-sidebar" onclick="toggleSidebar()">✕</button>
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>

        <i class="fas fa-home text-gray-400 text-sm"></i>
        <span><?= $breadcrumb[$page] ?? 'Page' ?></span>
    </div>

    <!-- KANAN -->
    <div class="nav-right">

        <?php if ($page == 'tasks') { ?>
            <button onclick="openAddTask()" class="btn-add">
                + Tambah Task
            </button>

        <?php } elseif ($page == 'users') { ?>
            <button onclick="openAddUser()" class="btn-add">
                + Tambah User
            </button>
        <?php } ?>

        <!-- USER -->
        <span class="user-name">
            <i class="fa-regular fa-user"></i>
            <?= $nama ?>
        </span>

        <button onclick="confirmLogout()" class="btn-logout">
            Logout
        </button>

    </div>

</div>