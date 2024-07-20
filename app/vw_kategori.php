<?php
include 'header.php';

$query = "SELECT id, kategori, prefix FROM kategori";
$result = mysqli_query($db->mysqli, $query);
?>

<div class="container">
    <h2>Kategori</h2>
    <button class="submit-button" style="align-self: flex-start; margin-left: 100px;" onclick="openAddModal()">Tambah Kategori Baru</button>
    <table border="1" class="product-table">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Prefix</th>
            <th>Action</th>
        </tr>
        <?php
        $no = 1;
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$row['kategori']}</td>";
                echo "<td>{$row['prefix']}</td>";
                echo "<td>
                        <a href='#' class='action-link action-link-edit' onclick='EditKategoriModal({$row['id']}, \"{$row['kategori']}\", \"{$row['prefix']}\")'>Edit</a>
                        <a href='#' class='action-link action-link-delete' onclick='DeleteKategori({$row['id']})'>Delete</a>
                    </td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='4'><center>Tidak ada kategori</center></td></tr>";
        }
        ?>
    </table>
</div>

<!-- Tambah -->
<div id="kategoriModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Tambah Kategori</h2>
        <form id="kategoriForm" action="kategori.php" method="POST">
            <input type="hidden" id="action" name="action" value="add">
            <input type="hidden" id="kategoriId" name="id">
            <div class="form-group">
                <label for="kategoriNama">Nama Kategori:</label>
                <input type="text" id="kategoriNama" name="kategori" class="form-control">
            </div>
            <div class="form-group">
                <label for="kategoriPrefix">Prefix:</label>
                <input type="text" id="kategoriPrefix" name="prefix" class="form-control">
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- hapus -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah kamu yakin mengahpus kategori ini?</p>
        <form id="deleteForm" action="kategori.php" method="POST">
            <input type="hidden" id="deleteId" name="id">
            <input type="hidden" name="action" value="delete">
            <div class="form-actions">
                <button type="submit" class="submit-button">Delete</button>
                <button type="button" class="submit-button" onclick="closeDeleteModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
    

</script>