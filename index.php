<title>Data Mahasiswa</title>

<style>
  body {
    font-family: Arial, sans-serif;
    padding: 20px;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
    color: #333;
  }

  tr:hover {
    background-color: #f5f5f5;
  }

  /* Gaya tombol tambah data mahasiswa */
  .add-button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-bottom: 10px;
    cursor: pointer;
    border-radius: 50px;
  }

  .update-button {
    /* Gaya saat tombol tidak diklik */
    background-color: #f44336;
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-left: 5px;
    cursor: pointer;
    border-radius: 4px;
  }

  .update-button.clicked {
    /* Gaya saat tombol diklik */
    background-color: #ff0000;
  }

  .delete-button {
    /* Gaya saat tombol tidak diklik */
    background-color: #000000;
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-left: 5px;
    cursor: pointer;
    border-radius: 4px;
  }

  .delete-button.clicked {
    /* Gaya saat tombol diklik */
    background-color: #ff0000;
  }

</style>

<a href="./add.php"><button type='submit' class='add-button' onclick="this.classList.add('clicked')">Tambah data mahasiswa</button></a>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siakad";
$conn = mysqli_connect($servername, $username, $password, $dbname);

echo "<table>";
echo "<tr><th>ID</th><th>Nama</th><th>NIM</th><th>Program Studi</th><th>Aksi</th></tr>";

// Cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel mahasiswa
$sql = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Menampilkan data dalam bentuk tabel
  while ($row = mysqli_fetch_assoc($result)) {
    $send = $row['id'];
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["nama"]."</td>";
    echo "<td>".$row["nim"]."</td>";
    echo "<td>".$row["program_studi"]."</td>";
    echo "<td>
                <a href='update.php?id=$send' class='update-button'>UPDATE</a>
                <a href='delete.php?id=$send' class='delete-button'>DELETE</a>
            </td>";

    echo "</tr>";
  }
  echo "</table>";
}

// Menutup koneksi
mysqli_close($conn);
?>