<?php
header("Access-Control-Allow-Origin: *");
include('../koneksi/koneksi.php');

$session_token = $_POST['session_token'];
if (isset($session_token)) {
    $statement = $koneksi->prepare("SELECT name FROM tbl_user WHERE session_token = ?");
    $statement->bind_param("s", $session_token);
    $statement->execute();

    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo json_encode(['status' => 'success', 'hasil' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid session']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>