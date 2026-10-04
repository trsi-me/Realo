<?php
session_start();
require_once 'config.php';
$page_title = 'Realo - الرئيسية';

// جلب 6 عقارات للعرض في الصفحة الرئيسية
$result = mysqli_query($conn, "SELECT * FROM properties LIMIT 6");
$properties = [];
while ($row = mysqli_fetch_assoc($result)) {
    $properties[] = $row;
}
?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <h1 class="section-title">مرحباً بك في Realo</h1>
    <p style="color: #b5b5b5; margin-bottom: 2rem;">منصة عرض وإدارة العقارات</p>

    <section class="search-section">
        <h2>ابحث عن عقار</h2>
        <form class="search-form" action="properties.php" method="get">
            <div>
                <label>الموقع</label>
                <input type="text" name="location" placeholder="المدينة أو الحي">
            </div>
            <div>
                <label>السعر حتى</label>
                <input type="number" name="max_price" placeholder="الحد الأقصى">
            </div>
            <div>
                <label>نوع العقار</label>
                <select name="type">
                    <option value="">الكل</option>
                    <option value="شقة">شقة</option>
                    <option value="فيلا">فيلا</option>
                    <option value="أرض">أرض</option>
                    <option value="عمارة">عمارة</option>
                </select>
            </div>
            <div>
                <button type="submit">بحث</button>
            </div>
        </form>
    </section>

    <h2 class="section-title">عقارات مميزة</h2>
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
</div>

<?php include 'includes/footer.php'; ?>
