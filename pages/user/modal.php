<div id="detailModal" class="modal">
    <div class="modal-content detail-box">

        <div class="modal-header">
            <h3>Detail Task</h3>
            <span class="close" onclick="closeDetailModal()">&times;</span>
        </div>

        <div class="detail-item">
            <span>Judul</span>
            <p id="d_title"></p>
        </div>

        <div class="detail-item">
            <span>Deskripsi</span>
            <p id="d_description"></p>
        </div>

        <div class="detail-item">
            <span>Deadline</span>
            <p id="d_deadline"></p>
        </div>

        <div class="detail-item">
            <span>Status</span>
            <p id="d_status" class="status-badge"></p>
        </div>

        <div class="detail-item">
            <span>Attachment</span>
            <p id="d_attachment"></p>
        </div>

    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content edit-box">

        <div class="modal-header">
            <h3>Edit Task</h3>
            <span class="close" onclick="closeEditModal()">&times;</span>
        </div>

        <form action="update_task.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="e_id">

            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="title" id="e_title" readonly>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" id="e_description" readonly></textarea>
            </div>

            <div class="form-group">
                <label>Deadline</label>
                <input type="date" name="deadline" id="e_deadline" readonly>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" id="e_status">
                    <option value="open">Open</option>
                    <option value="in_progress">Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="form-group">
                <label>Attachment </label>
                <input type="file" name="attachment" required>
            </div>

            <button type="submit" class="btn-save">Update</button>
        </form>
    </div>
</div>