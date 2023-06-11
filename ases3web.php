<?php
header('Content-Type: application/json');

$koneksi = mysqli_connect("localhost", "root", "", "fashion");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM topwear"; // Query untuk mengambil data dari tabel topwear
    $query = mysqli_query($koneksi, $sql); // Menjalankan query
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data; // Memasukkan data ke dalam array
    }
    echo json_encode($array_data); // Mengubah array menjadi format JSON dan mengirimkan response
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil nilai dari form
    $nama = $_POST['nama']; 
    $size = $_POST['size']; 
    $harga = $_POST['harga']; 
    $sql = "INSERT INTO topwear (nama, size, harga) VALUES('$nama', '$size', '$harga')"; // Query untuk melakukan INSERT data baru ke dalam tabel topwear
    $cek = mysqli_query($koneksi, $sql); 

    if ($cek) {
        $data = [
            'status' => "berhasil" // Jika query berhasil dijalankan, kembalikan response dengan status berhasil
        ];
        echo json_encode($data); 
    } else {
        $data = [
            'status' => "gagal" // Jika query gagal dijalankan, kembalikan response dengan status gagal
        ];
        echo json_encode($data); 
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteData); // Mendapatkan data dari body request DELETE
    $idtop = $deleteData['idtop']; 
    $sql = "DELETE FROM topwear WHERE idtop='$idtop'"; // Query untuk menghapus data dari tabel topwear berdasarkan idtop
    $cek = mysqli_query($koneksi, $sql); 

    if ($cek) {
        $data = [
            'status' => "berhasil" // Jika query berhasil dijalankan, kembalikan response dengan status berhasil
        ];
        echo json_encode($data); 
    } else {
        $data = [
            'status' => "gagal" // Jika query gagal dijalankan, kembalikan response dengan status gagal
        ];
        echo json_encode($data); 
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data); // Mendapatkan data dari body request PUT
    // Mendapatkan nilai dari data yang diterima
    $idtop = $data['idtop']; 
    $nama = $data['nama']; 
    $size = $data['size']; 
    $harga = $data['harga']; 
    $sql = "UPDATE topwear SET nama='$nama', size='$size', harga='$harga' WHERE idtop='$idtop'"; // Query untuk melakukan UPDATE data pada tabel topwear berdasarkan idtop
    $cek = mysqli_query($koneksi, $sql); 

    if ($cek) {
        $data = [
            'status' => 'berhasil' // Jika query berhasil dijalankan, kembalikan response dengan status berhasil
        ];
        echo json_encode($data); 
    } else {
        $data = [
            'status' => 'gagal' // Jika query gagal dijalankan, kembalikan response dengan status gagal
        ];
        echo json_encode($data); 
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    parse_str(file_get_contents("php://input"), $data); // Mendapatkan data dari body request PATCH
    // Mendapatkan nilai dari data yang diterima
    $idtop = $data['idtop']; 
    $nama = $data['nama']; 
    $size = $data['size']; 
    $harga = $data['harga']; 

    $sql = "UPDATE topwear SET "; // Query untuk melakukan UPDATE data pada tabel topwear
    $fields = array();

    // Jika nilai tidak kosong, tambahkan ke dalam array fields
    if (!empty($nama)) {
        $fields[] = "nama='$nama'"; 
    }

    if (!empty($size)) {
        $fields[] = "size='$size'"; 
    }

    if (!empty($harga)) {
        $fields[] = "harga='$harga'"; 
    }

    $sql .= implode(', ', $fields); // Menggabungkan nilai-nilai dari array fields dengan separator ', ' dan menyimpannya dalam variabel sql
    $sql .= " WHERE idtop='$idtop'"; // Menambahkan kondisi WHERE berdasarkan idtop
    $cek = mysqli_query($koneksi, $sql); 

    if ($cek) {
        $data = [
            'status' => 'berhasil' // Jika query berhasil dijalankan, kembalikan response dengan status berhasil
        ];
        echo json_encode($data); 
    } else {
        $data = [
            'status' => 'gagal' // Jika query gagal dijalankan, kembalikan response dengan status gagal
        ];
        echo json_encode($data); 
    }
}
?>
