<?php
// index.php - 放在网站根目录

$request_uri = $_SERVER['REQUEST_URI'];
$base_url = '/abc/';

// 首页路由
if ($request_uri === '/' || $request_uri === '/abc/' || $request_uri === '/abc') {
    showHomePage();
    exit;
}

// 跳转路由 - 匹配 /123/ID 模式
if (preg_match('#^/123/(?<id>.+)$#', $request_uri, $matches)) {
    $id = $matches['id'];
    redirectToB($id);
    exit;
}

// 其他路径也尝试跳转（可选）
if (preg_match('#^/(?<prefix>[^/]+)/(?<id>.+)$#', $request_uri, $matches)) {
    $id = $matches['id'];
    redirectToB($id);
    exit;
}

// 默认显示首页
showHomePage();

function showHomePage() {
    $current_domain = $_SERVER['HTTP_HOST'];
    echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>系统首页</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; text-align: center; }
        .container { max-width: 600px; margin: 0 auto; }
        .info { background: #f0f8ff; padding: 20px; border-radius: 10px; margin: 20px 0; }
        .test-links { margin: 20px 0; }
        .test-links a { display: inline-block; margin: 5px; padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>欢迎使用跳转系统</h1>
        <div class="info">
            <p>这是一个万能跳转系统，任何ID都会自动跳转到目标域名</p>
            <p><strong>当前域名:</strong> {$current_domain}</p>
            <p><strong>目标域名:</strong> B域名.com</p>
        </div>
        
        <div class="test-links">
            <h3>测试链接:</h3>
            <a href="/123/000">测试 ID: 000</a>
            <a href="/123/001">测试 ID: 001</a>
            <a href="/123/abc123">测试 ID: abc123</a>
            <a href="/123/任意内容">测试任意ID</a>
        </div>
        
        <p>你也可以在地址栏直接输入: {$current_domain}/123/你的ID</p>
    </div>
</body>
</html>
HTML;
}

function redirectToB($id) {
    $target_url = "http://B域名.com/{$id}";
    
    // 显示跳转页面
    echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>跳转中...</title>
    <meta http-equiv="refresh" content="2;url={$target_url}">
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; text-align: center; }
        .container { max-width: 500px; margin: 0 auto; }
        .loading { color: #007bff; font-size: 18px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>跳转中...</h1>
        <div class="loading">
            <p>检测到 ID: <strong>{$id}</strong></p>
            <p>正在跳转到: <strong>{$target_url}</strong></p>
            <p>如果页面没有自动跳转，请 <a href="{$target_url}">点击这里</a></p>
        </div>
    </div>
    
    <script>
        setTimeout(() => {
            window.location.href = '{$target_url}';
        }, 2000);
    </script>
</body>
</html>
HTML;
}
?>
