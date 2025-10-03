<?php
header("Content-Type: application/json");

$baseDir = __DIR__ . '/signals';
if (!is_dir($baseDir)) mkdir($baseDir, 0777, true);

// Ensure .htaccess exists to block direct access
$htaccess = $baseDir.'/.htaccess';
if (!file_exists($htaccess)) {
    $rules = "Order allow,deny\nDeny from all\n";
    // for Apache 2.4 additionally:
    $rules .= "<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n";
    file_put_contents($htaccess, $rules);
}

$role   = $_GET['role']   ?? '';
$action = $_GET['action'] ?? '';
$id = preg_replace('/[^0-9]/','', $_GET['id'] ?? '0');

$files = [
  'offer'             => "$baseDir/{$id}_offer.json",
  'answer'            => "$baseDir/{$id}_answer.json",
  'sender_candidate'  => "$baseDir/{$id}_sender_candidate.json",
  'receiver_candidate'=> "$baseDir/{$id}_receiver_candidate.json",
  'bye'               => "$baseDir/{$id}_bye.json"
];

// === CLEAR ALL (Sender manual end)
if ($action === 'clear') {
    foreach ($files as $f) if (file_exists($f)) unlink($f);
    echo json_encode(['status'=>'cleared_all']);
    exit;
}

// === BYE (Receiver end)
if ($action === 'bye') {
    file_put_contents($files['bye'], json_encode(['bye'=>true,'time'=>time()]));
    echo json_encode(['status'=>'bye_written']);
    exit;
}

// === GET BYE (Sender checks)
if ($action === 'getBye') {
    if (file_exists($files['bye'])) {
        echo file_get_contents($files['bye']);
    } else {
        echo json_encode(null);
    }
    exit;
}

// === STANDARD OFFER/ANSWER/CANDIDATES
if ($role && $action) {
    $file = $files[$role] ?? null;
    if (!$file) { echo json_encode(['error'=>'invalid role']); exit; }

    if ($action === 'set') {
        $data = file_get_contents("php://input");
        file_put_contents($file, $data);
        echo json_encode(['status'=>'ok']);
        exit;
    }

    if ($action === 'get') {
        if (file_exists($file)) {
            echo file_get_contents($file);
        } else {
            echo json_encode(null);
        }
        exit;
    }

    if ($action === 'add') {
        $data = json_decode(file_get_contents("php://input"), true);
        $arr = [];
        if (file_exists($file)) $arr = json_decode(file_get_contents($file), true) ?: [];
        $arr[] = $data;
        file_put_contents($file, json_encode($arr));
        echo json_encode(['status'=>'ok']);
        exit;
    }
}

// === Cleanup old files (>24h)
foreach (glob("$baseDir/*") as $f) {
    if (filemtime($f) < time() - (24 * 3600)) unlink($f);
}

echo json_encode(['error'=>'invalid request']);