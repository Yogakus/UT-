<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Keseluruhan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tampilan Keseluruhan</h2>
 
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label for="bulan" class="form-label">Bulan</label>
                    <input type="month" class="form-control" id="bulan" name="bulan">
                </div>
                <div class="col-md-4">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <select class="form-select" id="nama_produk" name="nama_produk">
                        <option value="">--Semua Produk--</option>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "db_leads");
                        $query_produk = "SELECT * FROM produk";
                        $result_produk = mysqli_query($conn, $query_produk);
                        while ($row = mysqli_fetch_assoc($result_produk)) {
                            echo "<option value='{$row['nama_produk']}'>{$row['nama_produk']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="nama_sales" class="form-label">Nama Sales</label>
                    <select class="form-select" id="nama_sales" name="nama_sales">
                        <option value="">--Semua Sales--</option>
                        <?php
                        $query_sales = "SELECT * FROM sales";
                        $result_sales = mysqli_query($conn, $query_sales);
                        while ($row = mysqli_fetch_assoc($result_sales)) {
                            echo "<option value='{$row['nama_sales']}'>{$row['nama_sales']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cari</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Input</th>
                    <th>Tanggal</th>
                    <th>Sales</th>
                    <th>Produk</th>
                    <th>Nama Leads</th>
                    <th>No. Wa</th>
                    <th>Kota</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT l.id_leads, l.tanggal, s.nama_sales, p.nama_produk, l.nama_lead, l.no_wa, l.kota 
                          FROM leads l 
                          JOIN sales s ON l.id_sales = s.id_sales 
                          JOIN produk p ON l.id_produk = p.id_produk";
                
                $conditions = [];
                if (!empty($_GET['bulan'])) {
                    $bulan = $_GET['bulan'];
                    $conditions[] = "DATE_FORMAT(l.tanggal, '%Y-%m') = '$bulan'";
                }
                if (!empty($_GET['nama_produk'])) {
                    $nama_produk = $_GET['nama_produk'];
                    $conditions[] = "p.nama_produk = '$nama_produk'";
                }
                if (!empty($_GET['nama_sales'])) {
                    $nama_sales = $_GET['nama_sales'];
                    $conditions[] = "s.nama_sales = '$nama_sales'";
                }

                if (count($conditions) > 0) {
                    $query .= " WHERE " . implode(" AND ", $conditions);
                }

                $result = mysqli_query($conn, $query);
                $no = 1;

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>" . sprintf("%03d", $row['id_leads']) . "</td>
                            <td>{$row['tanggal']}</td>
                            <td>{$row['nama_sales']}</td>
                            <td>{$row['nama_produk']}</td>
                            <td>{$row['nama_lead']}</td>
                            <td>{$row['no_wa']}</td>
                            <td>{$row['kota']}</td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
