<?php
session_start();
require_once 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: properties.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM properties WHERE id = $id");
$prop = mysqli_fetch_assoc($result);

if (!$prop) {
    header('Location: properties.php');
    exit;
}

$page_title = 'Realo - ' . $prop['title'];
?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <div class="property-detail">
        <?php 
        $img_path = 'assets/images/properties/' . $prop['image'];
        if (!empty($prop['image']) && file_exists($img_path)): 
        ?>
            <img src="<?php echo $img_path; ?>" alt="<?php echo htmlspecialchars($prop['title']); ?>">
        <?php else: ?>
            <div style="height: 300px; background-color: #2d2a3f; display: flex; align-items: center; justify-content: center; color: #b5b5b5; border-radius: 4px;">لا توجد صورة</div>
        <?php endif; ?>

        <h1><?php echo htmlspecialchars($prop['title']); ?></h1>
        <div class="price"><?php echo number_format($prop['price']); ?> ر.س</div>
        <div class="info">
            <strong>الموقع:</strong> <?php echo htmlspecialchars($prop['location']); ?> |
            <strong>النوع:</strong> <?php echo htmlspecialchars($prop['type']); ?>
        </div>
        <div class="description">
            <h3 style="color: #e6d28a; margin-bottom: 0.5rem;">الوصف</h3>
            <p><?php echo nl2br(htmlspecialchars($prop['description'] ?? 'لا يوجد وصف')); ?></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
