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

    .delete-button {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #4285F4;
        color: #fff;
        width: 240px;
        height: 50px;
        border-radius: 5px;
        border: thin solid #888;
        box-shadow: 1px 1px 1px grey;
        white-space: nowrap;
        font-size: 16px;
        font-weight: normal;
        font-family: 'Roboto', sans-serif;
        margin: 2rem auto 0;
    }

    .delete-button:hover {
        background-color: #d32f2f;
    }

    .delete-button:focus {
        outline: none;
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

    .success-message {
        color: #FF0106;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 18px;
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

// Variabel untuk menyimpan pesan sukses
$successMessage = "";

// Memproses data yang dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"])) {
        $id = $_POST["id"];

        // Query untuk menghapus data dari tabel mahasiswa
        $sql = "DELETE FROM mahasiswa WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            $successMessage = "Data berhasil dihapus.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: ID tidak ditemukan.";
    }

    // Menutup koneksi
    mysqli_close($conn);
}
?>

<div class="container">
    <h2>Hapus Data Mahasiswa</h2>

    <a href="./index.php" class="home-link">
        <span class="home-icon">&#8592;</span> Home
    </a>

    <?php if ($successMessage) : ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php else : ?>
        <!-- Form untuk menghapus data mahasiswa -->
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <?php if(isset($_GET["id"])) : ?>
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                <button type="submit" class="delete-button" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
            <?php else: ?>
                <div class="error-message">ID tidak ditemukan.</div>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</div>
