<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    padding: 20px;
  }

  .container {
    max-width: 500px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 4px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  .container h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .home-link {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    text-decoration: none;
    color: #4CAF50;
  }

  .home-link .home-icon {
    margin-right: 5px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-weight: bold;
  }

  .form-group input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .form-group input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
  }

  .form-group input[type="submit"]:hover {
    background-color: #45a049;
  }

  .form-group input[type="submit"]:focus {
    outline: none;
  }

  .form-group .home-link {
    display: block;
    text-align: center;
    margin-top: 20px;
  }

  .success-message {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    margin-top: 20px;
    text-align: center;
    border-radius: 4px;
    margin-bottom: 20px;
  }

  .error-message {
    background-color: #f44336;
    color: white;
    padding: 10px;
    margin-top: 20px;
    text-align: center;
    border-radius: 4px;
  }
</style>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siakad";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Memproses data yang dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $error = false;
  $id = $_POST["id"];
  $nama = $_POST["nama"];
  $nim = $_POST["nim"];
  $program_studi = $_POST["program_studi"];

  // Query untuk mengubah data dalam tabel mahasiswa
  $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim', program_studi='$program_studi' WHERE id=$id";

  $kirim = mysqli_query($conn, $sql);

  if ($kirim) {
    $error = true;
  }
}

// Mengambil data mahasiswa berdasarkan ID yang diberikan
$id = isset($_GET["id"]) ? $_GET["id"] : "";

if (empty($id)) {
  echo "<div class='container'>";
  echo "<h2>Data Mahasiswa Telah di Ubah</h2>";
  echo "<a href='./index.php' class='home-link'>";
  echo "<span class='home-icon'>&#8592;</span> Home";
  echo "</a>";
  echo "</div>";
  exit();
}

$sql = "SELECT * FROM mahasiswa WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (!$result) {
  echo "<div class='container'>";
  echo "<h2>Data Mahasiswa tidak ditemukan</h2>";
  echo "<a href='./index.php' class='home-link'>";
  echo "<span class='home-icon'>&#8592;</span> Home";
  echo "</a>";
  echo "</div>";
  exit();
}

$row = mysqli_fetch_assoc($result);

$nama = $row["nama"];
$nim = $row["nim"];
$program_studi = $row["program_studi"];

// Menampilkan form untuk mengubah data mahasiswa
echo "<div class='container'>";
echo "<h2>Ubah Data Mahasiswa</h2>";
echo "<a href='./index.php' class='home-link'>";
echo "<span class='home-icon'>&#8592;</span> Home";
echo "</a>";

if (isset($error) && $error === true) {
  echo "<div class='success-message'>Data berhasil diubah.</div>";
}

echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>";
echo "<input type='hidden' name='id' value='" . $id . "'>";

echo "<div class='form-group'>";
echo "<label for='nama'>Nama:</label>";
echo "<input type='text' name='nama' id='nama' value='" . $nama . "' required>";
echo "</div>";

echo "<div class='form-group'>";
echo "<label for='nim'>NIM:</label>";
echo "<input type='text' name='nim' id='nim' value='" . $nim . "' required>";
echo "</div>";

echo "<div class='form-group'>";
echo "<label for='program_studi'>Program Studi:</label>";
echo "<input type='text' name='program_studi' id='program_studi' value='" . $program_studi . "' required>";
echo "</div>";

echo "<div class='form-group'>";
echo "<input type='submit' value='Ubah'>";
echo "</div>";

echo "</form>";
echo "</div>";
?>
