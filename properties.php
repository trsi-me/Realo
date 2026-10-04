<?php
session_start();
require_once 'config.php';
$page_title = 'Realo - العقارات';

$where = [];
if (!empty($_GET['location'])) {
    $loc = mysqli_real_escape_string($conn, $_GET['location']);
    $where[] = "location LIKE '%$loc%'";
}
if (!empty($_GET['max_price'])) {
    $price = (int)$_GET['max_price'];
    $where[] = "price <= $price";
}
if (!empty($_GET['type'])) {
    $type = mysqli_real_escape_string($conn, $_GET['type']);
    $where[] = "type = '$type'";
}

$sql = "SELECT * FROM properties";
if (count($where) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

$properties = [];
while ($row = mysqli_fetch_assoc($result)) {
    $properties[] = $row;
}
?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1 class="section-title">جميع العقارات</h1>

    <section class="search-section">
        <h2>فلترة العقارات</h2>
        <form class="search-form" method="get">
            <div>
                <label>الموقع</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($_GET['location'] ?? ''); ?>" placeholder="المدينة أو الحي">
            </div>
            <div>
                <label>السعر حتى</label>
                <input type="number" name="max_price" value="<?php echo htmlspecialchars($_GET['max_price'] ?? ''); ?>" placeholder="الحد الأقصى">
            </div>
            <div>
                <label>نوع العقار</label>
                <select name="type">
                    <option value="">الكل</option>
                    <option value="شقة" <?php echo (isset($_GET['type']) && $_GET['type'] == 'شقة') ? 'selected' : ''; ?>>شقة</option>
                    <option value="فيلا" <?php echo (isset($_GET['type']) && $_GET['type'] == 'فيلا') ? 'selected' : ''; ?>>فيلا</option>
                    <option value="أرض" <?php echo (isset($_GET['type']) && $_GET['type'] == 'أرض') ? 'selected' : ''; ?>>أرض</option>
                    <option value="عمارة" <?php echo (isset($_GET['type']) && $_GET['type'] == 'عمارة') ? 'selected' : ''; ?>>عمارة</option>
                </select>
            </div>
            <div>
                <button type="submit">بحث</button>
            </div>
        </form>
    </section>

    <div class="properties-grid">
        <?php foreach ($properties as $prop): ?>
        <div class="property-card">
            <?php 
            $img_path = 'assets/images/properties/' . $prop['image'];
            if (!empty($prop['image']) && file_exists($img_path)): 
            ?>
                <img src="<?php echo $img_path; ?>" alt="<?php echo htmlspecialchars($prop['title']); ?>">
            <?php else: ?>
                <div style="height: 180px; background-color: #2d2a3f; display: flex; align-items: center; justify-content: center; color: #b5b5b5;">لا توجد صورة</div>
            <?php endif; ?>
            <div class="card-content">
                <h3><?php echo htmlspecialchars($prop['title']); ?></h3>
                <div class="price"><?php echo number_format($prop['price']); ?> ر.س</div>
                <div class="location"><?php echo htmlspecialchars($prop['location']); ?></div>
                <a href="property.php?id=<?php echo $prop['id']; ?>" class="btn">عرض التفاصيل</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($properties)): ?>
    <p style="text-align: center; color: #b5b5b5; padding: 2rem;">لا توجد عقارات مطابقة للبحث</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
