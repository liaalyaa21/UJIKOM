// TEST
console.log("JS MASUK");

// ===== SHOW / CLOSE =====
function showModal() {
    document.getElementById("mainModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("mainModal").style.display = "none";
}

// ===== ADD TASK =====
function openAddTask() {
    document.getElementById("modalTitle").innerText = "Tambah Task";
    document.getElementById("mainForm").action = "/taskhub/pages/admin/tasks/proses_tambah.php";

    document.getElementById("taskFields").style.display = "block";
    document.getElementById("userFields").style.display = "none";

    // ✅ aktifkan task
    document.querySelectorAll("#taskFields input, #taskFields textarea, #taskFields select")
        .forEach(el => el.required = true);

    // ❌ matikan user
    document.querySelectorAll("#userFields input, #userFields select")
        .forEach(el => el.required = false);

    // ❗ TAPI attachment dibuat opsional
    document.getElementById("attachment").required = false;
    showModal();
}


// ===== EDIT TASK =====
function editTask(id, title, desc, deadline, user_id, status) {

    // 🔥 RESET dulu biar bersih
    const form = document.getElementById("mainForm");
    form.reset();

    document.querySelectorAll("#mainForm input, #mainForm textarea, #mainForm select")
        .forEach(el => el.required = false);

    document.getElementById("modalTitle").innerText = "Edit Task";
    
    document.getElementById("dataId").value = id;
    document.getElementById("title").value = title;
    document.getElementById("description").value = desc;
    document.getElementById("deadline").value = deadline;
    document.getElementById("user_id").value = user_id;
    document.getElementById("status").value = status;
    
    document.getElementById("mainForm").action = "/taskhub/pages/admin/tasks/proses_edit.php";
    
    document.getElementById("taskFields").style.display = "block";
    document.getElementById("userFields").style.display = "none";

    // ✅ hanya field penting yang wajib
    document.getElementById("title").required = true;
    document.getElementById("description").required = true;

    // ❗ attachment tetap opsional
    document.getElementById("attachment").required = false;

    showModal();
}

// ===== DELETE TASK =====
function deleteTask(id) {
    let path = window.location.pathname;

    let from = path.includes("dashboard") ? "dashboard" : "tasks";

    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/taskhub/pages/admin/tasks/proses_hapus.php?id=" + id + "&from=" + from;
        }
    });
}

// ===== VIEW TASK =====
function viewTask(title, desc, deadline, user, status, attachment) {
    
    Swal.fire({
        title: title,
        html: `
        <b>Deskripsi:</b><br>${desc}<br><br>
        <b>User:</b> ${user}<br>
        <b>Deadline:</b> ${deadline}<br>
        <b>Status:</b> ${status}<br><br>
        `,
        icon: 'info'
    });
}

// ===== ADD USER =====
function openAddUser() {
    document.getElementById("modalTitle").innerText = "Tambah User";
    document.getElementById("mainForm").action = "../users/proses_tambah.php";

    document.getElementById("taskFields").style.display = "none";
    document.getElementById("userFields").style.display = "block";

    // ✅ aktifkan user
    document.querySelectorAll("#userFields input, #userFields select")
        .forEach(el => el.required = true);

    // ❌ matikan task
    document.querySelectorAll("#taskFields input, #taskFields textarea, #taskFields select")
        .forEach(el => el.required = false);

    showModal();
}

// ==== Edit User === //
function editUser(id, username, role_id) {
    
    document.getElementById("modalTitle").innerText = "Edit User";
    
    document.getElementById("dataId").value = id;
    document.getElementById("username").value = username;
    document.getElementById("role_id").value = role_id;
    
    document.getElementById("mainForm").action = "/taskhub/pages/admin/users/proses_edit.php";
    
    document.getElementById("taskFields").style.display = "none";
    document.getElementById("userFields").style.display = "block";

    // aktifkan user
    document.querySelectorAll("#userFields input, #userFields select")
        .forEach(el => {
            el.required = true;
            el.disabled = false;
        });

    // matikan task
    document.querySelectorAll("#taskFields input, #taskFields textarea, #taskFields select")
        .forEach(el => {
            el.required = false;
            el.disabled = true;
        });

    showModal();
}

// delete user
function deleteUser(id) {
    Swal.fire({
        title: 'Yakin hapus user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/taskhub/pages/admin/users/proses_hapus.php?id=" + id;
        }
    });
}


// === NOTIFIKASI GLOBAL
window.addEventListener("DOMContentLoaded", () => {

    const params = new URLSearchParams(window.location.search);
    const status = params.get("status");

    const path = window.location.pathname;

    if (!status) return;

    // ================= TASK =================
    if (path.includes("tasks.php")) {

        if (status === "add") {
            Swal.fire("Berhasil", "Task berhasil ditambahkan", "success");
        }

        else if (status === "edit") {
            Swal.fire("Berhasil", "Task berhasil diupdate", "success");
        }

        else if (status === "delete") {
            Swal.fire("Berhasil", "Task berhasil dihapus", "success");
        }

    }

    // ================= USER =================
    else if (path.includes("users.php")) {

        if (status === "add") {
            Swal.fire("Berhasil", "User berhasil ditambahkan", "success");
        }

        else if (status === "edit") {
            Swal.fire("Berhasil", "User berhasil diupdate", "success");
        }

        else if (status === "delete") {
            Swal.fire("Berhasil", "User berhasil dihapus", "success");
        }

    }

    // bersihin URL
    window.history.replaceState({}, document.title, window.location.pathname);
});

// ===== LOGOUT GLOBAL =====
function confirmLogout() {
    Swal.fire({
        title: 'Yakin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/taskhub/pages/auth/logout/logout.php';
        }
    });
}

function openAttachment(file) {
    if (!file) {
        Swal.fire("Tidak ada file attachment");
        return;
    }

    const modal = document.getElementById("attachmentModal");
    const preview = document.getElementById("attachmentPreview");
    const pdfContainer = document.getElementById("pdfContainer");

    const fallback = document.getElementById("fileFallback");
    const downloadBtn = document.getElementById("downloadBtn");
    const fileNameText = document.getElementById("fileName");

    const path = "/taskhub/assets/upload/" + file;
    const ext = file.split('.').pop().toLowerCase();

    const imageExt = ["jpg", "jpeg", "png", "webp"];

    // RESET SEMUA
    preview.src = "";
    preview.style.display = "none";
    pdfContainer.innerHTML = "";
    fallback.style.display = "none";

    // IMAGE
    if (imageExt.includes(ext)) {
        preview.src = path;
        preview.style.display = "block";
    }

    // PDF
    else if (ext === "pdf") {
        const iframe = document.createElement("iframe");
        iframe.src = path;
        pdfContainer.appendChild(iframe);
    }

    // FILE TIDAK BISA PREVIEW
    else {
        fallback.style.display = "block";
        fileNameText.innerText = file;

        downloadBtn.href = path;
        downloadBtn.download = file; // force download
    }

    modal.style.display = "flex";
}

function closeAttachment() {
    const modal = document.getElementById("attachmentModal");
    const preview = document.getElementById("attachmentPreview");
    const pdfContainer = document.getElementById("pdfContainer");

    modal.style.display = "none";

    // bersihin state
    preview.src = "";
    preview.style.display = "none";
    pdfContainer.innerHTML = "";
}

function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    const btn = document.querySelector('.menu-toggle');

    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');

    // toggle icon
    if (sidebar.classList.contains('active')) {
        btn.innerHTML = "✕";
    } else {
        btn.innerHTML = "☰";
    }
}
