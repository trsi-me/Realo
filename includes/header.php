<?php
if (!isset($page_title)) {
    $page_title = 'Realo - نظام إدارة العقارات';
}
$base = (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false || strpos($_SERVER['SCRIPT_NAME'], '\\admin\\') !== false) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>css/style.css">
</head>
<body>
    <header>
        <a href="<?php echo $base; ?>index.php">
            <img src="<?php echo $base; ?>assets/images/logo.png" alt="Realo" class="logo">
        </a>
        <nav>
            <a href="<?php echo $base; ?>index.php">الرئيسية</a>
            <a href="<?php echo $base; ?>properties.php">العقارات</a>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                    <a href="<?php echo $base; ?>admin/dashboard.php">لوحة التحكم</a>
                <?php endif; ?>
                <a href="<?php echo $base; ?>logout.php">خروج</a>
            <?php else: ?>
                <a href="<?php echo $base; ?>login.php">دخول</a>
            <?php endif; ?>
        </nav>
    </header>
