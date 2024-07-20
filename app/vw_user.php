<?php
include 'header.php';

$query = "SELECT username, nama, role, email, nohp FROM user";
$result = mysqli_query($db->mysqli, $query);
?>

<div class="container">
    <h2>Manajemen Pengguna</h2>
    <a href="vw_register.php" class="submit-button" style="align-self: flex-end; text-decoration: none; margin-right: 100px;">Register</a>
    <table class="product-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['username']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['role']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['nohp']}</td>
                            <td>
                                <a href='#' class='action-link action-link-edit' onclick='openEditUserModal(\"{$row['username']}\", \"{$row['nama']}\", \"{$row['role']}\", \"{$row['email']}\", \"{$row['nohp']}\")'>Edit</a>
                                <a href='#' class='action-link action-link-delete' onclick='openDeleteUserModal(\"{$row['username']}\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada pengguna ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit User -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editUserModal')">&times;</span>
        <h2>Edit User</h2>
        <form action="user.php" method="post">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="edit_user_id" name="id">
            <div class="form-group">
                <label for="edit_username">Username:</label>
                <input type="text" id="edit_username" name="username" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="edit_nama">Nama:</label>
                <input type="text" id="edit_nama" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_role">Role:</label>
                <input type="text" id="edit_role" name="role" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="edit_email">Email:</label>
                <input type="email" id="edit_email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_nohp">No HP:</label>
                <input type="text" id="edit_nohp" name="nohp" class="form-control" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus User -->
<div id="deleteUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('deleteUserModal')">&times;</span>
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this user?</p>
        <form action="user.php" method="post">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" id="delete_user_id" name="id">
            <div class="form-actions">
                <button type="submit" class="submit-button">Delete</button>
                <button type="button" class="submit-button" onclick="closeModal('deleteUserModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');

    window.openEditUserModal = function(username, nama, role, email, nohp) {
        console.log('openEditUserModal called with:', username, nama, role, email, nohp);
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_nohp').value = nohp;
        document.getElementById('editUserModal').style.display = 'block';
    }

    window.openDeleteUserModal = function(username) {
        console.log('openDeleteUserModal called with:', username);
        document.getElementById('delete_user_id').value = username;
        document.getElementById('deleteUserModal').style.display = 'block';
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('editUserModal')) {
            closeModal('editUserModal');
        }
        if (event.target == document.getElementById('deleteUserModal')) {
            closeModal('deleteUserModal');
        }
    }
});
</script>

<?php
include 'footer.php';
?>
