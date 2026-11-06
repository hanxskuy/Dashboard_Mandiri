<?php
header('Content-Type: application/json');

// Koneksi ke database Laragon
$host = "localhost";
$user = "root";
$pass = "";
$db   = "branch_referral_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $conn->connect_error]);
    exit;
}

// Ambil semua data referral, diurutkan dari yang terbaru
$sql = "SELECT * FROM referrals ORDER BY id DESC";
$result = $conn->query($sql);

$referrals = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $referrals[] = $row;
    }
}

// Kirim data dalam format JSON
echo json_encode([
    'success' => true,
    'data' => $referrals
]);

$conn->close();
?>