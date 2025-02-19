<?php
$conn = new mysqli("localhost", "root", "", "phpdasar");
if($conn->connect_error){
    die("Koneksi Gagal : ".$conn->connect_error);
}

function query($query, $params = [])
{
    global $conn;
    $stmt = $conn->prepare($query);
    if(!empty($params)) {
        $stmt->bind_param(...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function tambah($data)
{
    global $conn;
    
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = upload();
    if (!$gambar) return false;
    
    $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nrp, email, jurusan, gambar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $nrp, $email, $jurusan, $gambar);
    $stmt->execute();
    return $stmt->affected_rows;
}

function upload()
{
    $file = $_FILES['gambar'];
    $allowedTypes = ['image/jpeg', 'image/png'];
    
    if ($file['error'] === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu');</script>";
        return false;
    }
    
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($fileInfo, $file['tmp_name']);
    finfo_close($fileInfo);
    
    if (!in_array($mime, $allowedTypes)) {
        echo "<script>alert('File bukan gambar yang valid');</script>";
        return false;
    }
    
    if ($file['size'] > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar');</script>";
        return false;
    }
    
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $ext;
    move_uploaded_file($file['tmp_name'], 'img/' . $newFileName);
    return $newFileName;
}

function hapus($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

function ubah($data)
{
    global $conn;
    
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    
    $gambar = ($_FILES["gambar"]["error"] === 4) ? $gambarLama : upload();
    if (!$gambar) return false;
    
    $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, nrp=?, email=?, jurusan=?, gambar=? WHERE id=?");
    $stmt->bind_param("sssssi", $nama, $nrp, $email, $jurusan, $gambar, $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE
        nama LIKE '%$keyword%' OR
        nrp LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
        ";

    return query($query);
}

function registrasi($data)
{
    global $conn;
    
    $username = strtolower(trim(stripslashes($data["username"])));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
    if (query("SELECT username FROM user WHERE username = ?", ["s", $username])) {
        echo "<script>alert('Username sudah terdaftar');</script>";
        return false;
    }
    
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();
    return $stmt->affected_rows;
}
