// ===== DETAIL =====
function openDetailModal(title, desc, deadline, status, attachment) {

    document.getElementById("detailModal").style.display = "flex";

    document.getElementById("d_title").innerText = title || '-';
    document.getElementById("d_description").innerText = desc || '-';
    document.getElementById("d_deadline").innerText = deadline || '-';

    let statusEl = document.getElementById("d_status");
    statusEl.innerText = status || '-';
    statusEl.className = "status-badge " + (status || '');

    let attachEl = document.getElementById("d_attachment");

    if (attachment && attachment !== 'null' && attachment !== '') {
        attachEl.innerHTML = `<a href="../../assets/upload/${encodeURIComponent(attachment)}" target="_blank">Download file</a>`;
    } else {
        attachEl.innerText = "-";
    }
}

function closeDetailModal() {
    document.getElementById("detailModal").style.display = "none";
}


// ===== EDIT =====
function openEditModal(id, title, desc, deadline, status) {

    document.getElementById("editModal").style.display = "flex";

    document.getElementById("e_id").value = id;
    document.getElementById("e_title").value = title || '';
    document.getElementById("e_description").value = desc || '';
    document.getElementById("e_deadline").value = deadline || '';
    document.getElementById("e_status").value = status || 'open';
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

function mulaiTask(id) {
    fetch('mulai.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id + '&status=in_progress'
    })
    .then(res => res.text())
    .then(response => {
        
        // notif sukses
        Swal.fire({
            icon: "success",
            title: "Selamat!",
            text: "Selamat mengerjakan tugas 🎉",
            timer: 1500,
            showConfirmButton: false
        });

        // reload biar card pindah
        setTimeout(() => {
            location.reload();
        }, 1500);

    })
    .catch(() => {
        Swal.fire("Error", "Gagal memulai tugas", "error");
    });
}

// Logout
function confirmLogout() {
    Swal.fire({
    title: 'Yakin keluar?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Logout',
    cancelButtonText: 'Batal'
    }).then((result) => {
    if (result.isConfirmed) {
        window.location.href = '../auth/logout/logout.php';
    }
    });
}

document.addEventListener("DOMContentLoaded", function () {

    if (statusUpdate === 'edit') {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Task berhasil diupdate 🎉',
            showConfirmButton: false,
            timer: 1800
        });
    }

    if (statusUpdate === 'gagal') {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Task gagal diupdate 😢'
        });
    }

    if (statusUpdate === "tidak_boleh_kembali") {
        Swal.fire({
            icon: "warning",
            title: "Tidak bisa!",
            text: "Tugas sudah dikerjakan, tidak bisa berubah"
        });
    }

    if (statusUpdate === "harus_upload") {
        Swal.fire({
            icon: "warning",
            title: "Upload wajib!",
            text: "Harus upload file sebelum mengerjakan tugas ⚠️"
        });
    }
});