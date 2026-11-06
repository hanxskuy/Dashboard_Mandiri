<?php
// Matikan tampilan error HTML agar tidak merusak format JSON
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json');

// Setting koneksi database
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "branch_referral_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $conn->connect_error]);
    exit;
}

// Tangkap data JSON dari JavaScript
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Data input tidak valid']);
    exit;
}

// Hitung ID selanjutnya secara aman
$result = $conn->query("SELECT MAX(id) AS max_id FROM referrals");
$next_number = 1;

if ($result) {
    $row = $result->fetch_assoc();
    $next_number = ($row['max_id'] ?? 0) + 1;
}

$referral_id = 'REF-GM-' . str_pad($next_number, 3, '0', STR_PAD_LEFT);

// Nilai default jika data dari form kosong
$customer_name   = $input['customer_name'] ?? '';
$phone_number    = $input['phone_number'] ?? '';
$product_type    = $input['product_type'] ?? '';
$referral_source = $input['referral_source'] ?? '';
$referrer_name   = !empty($input['referrer_name']) ? $input['referrer_name'] : null;
$notes           = !empty($input['notes']) ? $input['notes'] : null;

// Query Insert
$sql = "INSERT INTO referrals (referral_id, customer_name, phone_number, product_type, referral_source, referrer_name, notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false, 
        'message' => 'Gagal prepare query database: ' . $conn->error
    ]);
    $conn->close();
    exit;
}

$stmt->bind_param("sssssss", $referral_id, $customer_name, $phone_number, $product_type, $referral_source, $referrer_name, $notes);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'referral_id' => $referral_id,
        'message' => 'Referral berhasil disimpan'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal menyimpan ke database: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>