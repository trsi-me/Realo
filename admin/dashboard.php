<?php
session_start();
require_once '../config.php';
$page_title = 'Realo - لوحة التحكم';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM properties ORDER BY id DESC");
$properties = [];
while ($row = mysqli_fetch_assoc($result)) {
    $properties[] = $row;
}
?>
<?php include '../includes/header.php'; ?>

<div class="container dashboard">
    <h1>لوحة التحكم</h1>

    <div class="dashboard-actions">
        <a href="add_property.php">إضافة عقار</a>
    </div>

    <h2 class="section-title">قائمة العقارات</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>السعر</th>
                    <th>الموقع</th>
                    <th>النوع</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($properties as $prop): ?>
                <tr>
                    <td><?php echo $prop['id']; ?></td>
                    <td><?php echo htmlspecialchars($prop['title']); ?></td>
                    <td><?php echo number_format($prop['price']); ?> ر.س</td>
                    <td><?php echo htmlspecialchars($prop['location']); ?></td>
                    <td><?php echo htmlspecialchars($prop['type']); ?></td>
                    <td>
                        <a href="edit_property.php?id=<?php echo $prop['id']; ?>" class="btn btn-small btn-edit">تعديل</a>
                        <a href="delete_property.php?id=<?php echo $prop['id']; ?>" class="btn btn-small btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟');">حذف</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (empty($properties)): ?>
    <p style="color: #b5b5b5; margin-top: 1rem;">لا توجد عقارات</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
