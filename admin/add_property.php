<?php
session_start();
require_once '../config.php';
$page_title = 'Realo - إضافة عقار';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
    $price = (int)($_POST['price'] ?? 0);
    $location = mysqli_real_escape_string($conn, trim($_POST['location'] ?? ''));
    $type = mysqli_real_escape_string($conn, trim($_POST['type'] ?? ''));
    $description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));
    $image = mysqli_real_escape_string($conn, trim($_POST['image'] ?? ''));

    if ($title && $price > 0 && $location && $type) {
        mysqli_query($conn, "INSERT INTO properties (title, price, location, type, description, image) VALUES ('$title', $price, '$location', '$type', '$description', '$image')");
        header('Location: dashboard.php');
        exit;
    }
}
?>
<?php include '../includes/header.php'; ?>

<div class="container dashboard">
    <h1>إضافة عقار جديد</h1>

    <form method="post" style="max-width: 500px;">
        <div class="form-group">
            <label>العنوان</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>السعر (ر.س)</label>
            <input type="number" name="price" required min="1">
        </div>
        <div class="form-group">
            <label>الموقع</label>
            <input type="text" name="location" required>
        </div>
        <div class="form-group">
            <label>نوع العقار</label>
            <select name="type" required>
                <option value="">اختر النوع</option>
                <option value="شقة">شقة</option>
                <option value="فيلا">فيلا</option>
                <option value="أرض">أرض</option>
                <option value="عمارة">عمارة</option>
            </select>
        </div>
        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description"></textarea>
        </div>
        <div class="form-group">
            <label>اسم ملف الصورة (مثل: property7.jpg)</label>
            <input type="text" name="image">
        </div>
        <button type="submit">إضافة</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
