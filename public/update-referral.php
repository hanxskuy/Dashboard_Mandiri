<?php
header('Content-Type: application/json');

// Membaca data JSON dari fetch body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Data input tidak valid.']);
    exit;
}

// Koneksi Database (sesuaikan dengan kredensial kamu)
$conn = new mysqli("localhost", "root", "", "branch_referral_db");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $conn->connect_error]);
    exit;
}

$action = $input['action'] ?? '';

if ($action === 'add_followup') {
    $referral_id    = $input['referral_id'] ?? '';
    $follow_up_date = $input['follow_up_date'] ?? date('Y-m-d');
    $method         = $input['method'] ?? '';
    $result         = $input['result'] ?? '';
    $notes          = !empty($input['notes']) ? $input['notes'] : NULL;
    $next_action    = !empty($input['next_action']) ? $input['next_action'] : NULL;
    $due_date       = !empty($input['due_date']) ? $input['due_date'] : NULL;

    // 1. Simpan ke tabel follow_ups
    $stmt = $conn->prepare("INSERT INTO follow_ups (referral_id, follow_up_date, method, result, notes, next_action, due_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $referral_id, $follow_up_date, $method, $result, $notes, $next_action, $due_date);

    if ($stmt->execute()) {
        // 2. Opsional: Update kolom next_action & due_date di tabel utama (referrals) jika ada
        if ($due_date || $next_action) {
            $stmtUpdate = $conn->prepare("UPDATE referrals SET next_action = COALESCE(?, next_action), due_date = COALESCE(?, due_date) WHERE referral_id = ?");
            $stmtUpdate->bind_param("sss", $next_action, $due_date, $referral_id);
            $stmtUpdate->execute();
        }

        echo json_encode(['success' => true, 'message' => 'Follow-up berhasil disimpan.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal query: ' . $stmt->error]);
    }
    
    $stmt->close();
} else if ($action === 'update_status') {
    $referral_id = $input['referral_id'] ?? '';
    $status      = $input['status'] ?? '';

    $stmt = $conn->prepare("UPDATE referrals SET status = ? WHERE referral_id = ?");
    $stmt->bind_param("ss", $status, $referral_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status: ' . $stmt->error]);
    }
    $stmt->close();
}

$conn->close();
?>