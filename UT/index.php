<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Selamat Datang di Tambah Leads</h2>
        <form method="POST" action="simpan.php">
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="sales" class="form-label">Sales</label>
                <select class="form-select" id="sales" name="id_sales" required>
                    <option value="">--Pilih Sales--</option>
                    <?php
                    // Connect to the database
                    $conn = mysqli_connect("localhost", "root", "", "db_leads");
                    $query_sales = "SELECT * FROM sales";
                    $result_sales = mysqli_query($conn, $query_sales);
                    while ($row = mysqli_fetch_assoc($result_sales)) {
                        echo "<option value='{$row['id_sales']}'>{$row['nama_sales']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <select class="form-select" id="produk" name="id_produk" required>
                    <option value="">--Pilih Produk--</option>
                    <?php
                    $query_produk = "SELECT * FROM produk";
                    $result_produk = mysqli_query($conn, $query_produk);
                    while ($row = mysqli_fetch_assoc($result_produk)) {
                        echo "<option value='{$row['id_produk']}'>{$row['nama_produk']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_wa" class="form-label">No. WhatsApp</label>
                <input type="text" class="form-control" id="no_wa" name="no_wa" required>
            </div>
            <div class="mb-3">
                <label for="nama_lead" class="form-label">Nama Lead</label>
                <input type="text" class="form-control" id="nama_lead" name="nama_lead" required>
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>