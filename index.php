<?php
// 终极简单版本
$path = trim($_SERVER['REQUEST_URI'], '/');
$parts = explode('/', $path);

if (count($parts) > 1 && $parts[0] === 'abc') {
    $id = $parts[1] ?? '';
    if ($id) {
        header("Location: https://lidc033.cn/$id");
    } else {
        header("Location: https://lidc033.cn");
    }
} else {
    header("Location: https://lidc033.cn");
}
exit;
?>
