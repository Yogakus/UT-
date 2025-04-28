<?php
$conn = mysqli_connect("localhost", "root", "", "db_leads");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $id_sales = $_POST['id_sales'];
    $id_produk = $_POST['id_produk'];
    $no_wa = $_POST['no_wa'];
    $nama_lead = $_POST['nama_lead'];
    $kota = $_POST['kota'];
    $id_user = 1; 

    $query = "INSERT INTO leads (tanggal, id_sales, id_produk, no_wa, nama_lead, kota, id_user) 
              VALUES ('$tanggal', '$id_sales', '$id_produk', '$no_wa', '$nama_lead', '$kota', '$id_user')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: tampilan.php"); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
