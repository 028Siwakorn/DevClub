<?php
include 'db.php';
include 'auth.php';

if ($_POST) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $major = $_POST['major'];
    $year = $_POST['academic_year'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "รูปแบบอีเมลไม่ถูกต้อง";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO members (fullname,email,major,academic_year) VALUES (?,?,?,?)"
        );
        $stmt->bind_param("sssi", $fullname, $email, $major, $year);
        $stmt->execute();
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>เพิ่มสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h3>เพิ่มสมาชิกใหม่</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="row g-3">
            <div class="col-12">
                <label>ชื่อ-นามสกุล</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="col-12">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-12">
                <label>สาขาที่ศึกษา</label>
                <input type="text" name="major" class="form-control" required>
            </div>
            <div class="col-12">
                <label>ปีการศึกษา (พ.ศ.)</label>
                <input type="number" name="academic_year" class="form-control" required>
            </div>

            <div class="col-12">
                <button class="btn btn-primary">บันทึก</button>
                <a href="index.php" class="btn btn-secondary">กลับ</a>
            </div>
        </form>
    </div>
</body>

</html>