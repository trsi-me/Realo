<?php
session_start();
require_once '../config.php';
$page_title = 'Realo - تعديل عقار';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: dashboard.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM properties WHERE id = $id");
$prop = mysqli_fetch_assoc($result);

if (!$prop) {
    header('Location: dashboard.php');
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
        mysqli_query($conn, "UPDATE properties SET title='$title', price=$price, location='$location', type='$type', description='$description', image='$image' WHERE id=$id");
        header('Location: dashboard.php');
        exit;
    }
}
?>
<?php include '../includes/header.php'; ?>

<div class="container dashboard">
    <h1>تعديل عقار</h1>

    <form method="post" style="max-width: 500px;">
        <div class="form-group">
            <label>العنوان</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($prop['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>السعر (ر.س)</label>
            <input type="number" name="price" value="<?php echo $prop['price']; ?>" required min="1">
        </div>
        <div class="form-group">
            <label>الموقع</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($prop['location']); ?>" required>
        </div>
        <div class="form-group">
            <label>نوع العقار</label>
            <select name="type" required>
                <option value="شقة" <?php echo $prop['type'] == 'شقة' ? 'selected' : ''; ?>>شقة</option>
                <option value="فيلا" <?php echo $prop['type'] == 'فيلا' ? 'selected' : ''; ?>>فيلا</option>
                <option value="أرض" <?php echo $prop['type'] == 'أرض' ? 'selected' : ''; ?>>أرض</option>
                <option value="عمارة" <?php echo $prop['type'] == 'عمارة' ? 'selected' : ''; ?>>عمارة</option>
            </select>
        </div>
        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description"><?php echo htmlspecialchars($prop['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>اسم ملف الصورة</label>
            <input type="text" name="image" value="<?php echo htmlspecialchars($prop['image'] ?? ''); ?>">
        </div>
        <button type="submit">حفظ التعديلات</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
