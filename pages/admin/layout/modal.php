<div id="mainModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Modal</h3>

        <form id="mainForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="dataId">

            <!-- ================= TASK ================= -->
            <div id="taskFields">

                <input type="text" name="title" id="title" placeholder="Nama Tugas">

                <textarea name="description" id="description" placeholder="Deskripsi"></textarea>

                <label>Tenggat Waktu</label>
                <input type="date" name="deadline" id="deadline">

                <label>Assign User</label>
                <select name="user_id" id="user_id">
                    <option value="">-- Pilih User --</option>

                    <?php if (isset($users)) { ?>
                        <?php while ($u = mysqli_fetch_assoc($users)) { ?>
                            <option value="<?= $u['id'] ?>">
                                <?= htmlspecialchars($u['username']) ?>
                            </option>
                        <?php } ?>
                    <?php } ?>

                </select>

                <label>Lampiran / Dokumentasi</label>
                <input type="file" name="attachment" id="attachment">

                <label>Status</label>
                <select name="status" id="status">
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>

            </div>

            <!-- ================= USER ================= -->
            <div id="userFields">

                <input type="text" name="username" id="username" placeholder="Username">

                <input type="password" name="password" id="password" placeholder="Password">

                <select name="role_id" id="role_id">
                    <option value="">-- Pilih Role --</option>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>

            </div>

            <!-- BUTTON -->
            <div style="margin-top:15px;">
                <button type="submit" class="btn-submit">Simpan</button>
                <button type="button" onclick="closeModal()" class="btn-cancel">Batal</button>
            </div>

        </form>
        
    </div>
</div>

<div id="attachmentModal" class="attachmentModal">
  <div class="attachmentModal-content">

    <span class="attachmentModal-close" onclick="closeAttachment()">&times;</span>

    <!-- IMAGE -->
    <img id="attachmentPreview" class="attachmentModal-img" />

    <!-- PDF CONTAINER -->
    <div id="pdfContainer" class="attachmentModal-pdf"></div>

    <!-- FALLBACK DOWNLOAD -->
    <div id="fileFallback" class="attachment-fallback">
        <div class="attachment-icon">📄</div>
        <p id="fileName">File</p>
        <a id="downloadBtn" class="download-btn">Download File</a>
    </div>
  </div>
</div>

