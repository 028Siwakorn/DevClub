<?php
include 'db.php';
include 'auth.php';

/* ถ้าไม่มี id กลับหน้าแรก */
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

/* ดึงข้อมูลสมาชิก */
$result = $conn->query("SELECT * FROM members WHERE member_id = $id");
$data = $result->fetch_assoc();

if (!$data) {
    echo "ไม่พบข้อมูลสมาชิก";
    exit;
}

/* เมื่อกดบันทึก */
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $major = $_POST['major'];
    $academic_year = $_POST['academic_year'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "รูปแบบอีเมลไม่ถูกต้อง";
    } else {
        $stmt = $conn->prepare(
            "UPDATE members
             SET fullname=?, email=?, major=?, academic_year=?
             WHERE member_id=?"
        );
        $stmt->bind_param(
            "sssii",
            $fullname,
            $email,
            $major,
            $academic_year,
            $id
        );
        $stmt->execute();

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แก้ไขสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-4">
        <h3>แก้ไขข้อมูลสมาชิก</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="row g-3">
            <div class="col-12">
                <label>ชื่อ-นามสกุล</label>
                <input type="text" name="fullname" class="form-control"
                    value="<?= htmlspecialchars($data['fullname']) ?>" required>
            </div>

            <div class="col-12">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= htmlspecialchars($data['email']) ?>" required>
            </div>

            <div class="col-12">
                <label>สาขาที่ศึกษา</label>
                <input type="text" name="major" class="form-control"
                    value="<?= htmlspecialchars($data['major']) ?>" required>
            </div>

            <div class="col-12">
                <label>ปีการศึกษา (พ.ศ.)</label>
                <input type="number" name="academic_year" class="form-control"
                    value="<?= $data['academic_year'] ?>" required>
            </div>

            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">
                    บันทึก
                </button>
                <a href="index.php" class="btn btn-secondary">กลับ</a>
            </div>
        </form>
    </div>

</body>

</html>