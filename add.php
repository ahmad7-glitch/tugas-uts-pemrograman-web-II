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
        margin-bottom: 20px;
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

    .form-container {
        margin-top: 20px;
    }

    .form-container label {
        display: block;
        margin-bottom: 5px;
    }

    .form-container input[type="text"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-container input[type="submit"] {
        display:flex;
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        margin: 2rem auto 0;
    }

    .form-container input[type="submit"]:hover {
        background-color: #45a049;
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
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $program_studi = $_POST["program_studi"];
    
    // Query untuk menambahkan data ke tabel mahasiswa
    $sql = "INSERT INTO mahasiswa (nama, nim, program_studi) VALUES ('$nama', '$nim', '$program_studi')";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Data berhasil ditambahkan.";
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Menutup koneksi
    mysqli_close($conn);
}
?>


<div class="container">
    <h2>Tambah Data Mahasiswa</h2>

    <a href="./index.php" class="home-link">
        <span class="home-icon">&#8592;</span> Home
    </a>

    <?php if (isset($success_message)) : ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <?php if (isset($error_message)) : ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <!-- Form untuk menambahkan data mahasiswa -->
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>
            <br>
            <label for="nim">NIM:</label>
            <input type="text" name="nim" id="nim" required>
            <br>
            <label for="program_studi">Program Studi:</label>
            <input type="text" name="program_studi" id="program_studi" required>
            <br>
            <input type="submit" value="Tambahkan">
        </form>
    </div>
</div>
