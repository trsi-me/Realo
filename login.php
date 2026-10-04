<?php
session_start();
require_once 'config.php';
$page_title = 'Realo - تسجيل الدخول';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'يرجى إدخال اسم المستخدم وكلمة المرور';
    } else {
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        } else {
            $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="container">
    <section class="login-section">
        <img src="assets/images/logo.png" alt="Realo" class="logo">
        <h2>تسجيل الدخول</h2>

        <?php if ($error): ?>
        <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post">
            <label>اسم المستخدم</label>
            <input type="text" name="username" required>

            <label>كلمة المرور</label>
            <input type="password" name="password" required>

            <button type="submit">دخول</button>
        </form>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
