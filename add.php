<?php
include 'db.php';
include 'auth.php';

// สาขา
$majors = [
    "คณิตศาสตร์",
    "ฟิสิกส์",
    "เคมี",
    "ชีววิทยา",
    "วิทยาการคอมพิวเตอร์",
    "สถิติ",
    "วิศวกรรมซอฟต์แวร์"
];

// ปีการศึกษา
$years = range(2560, 2568);

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
        exit;
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

<body class="bg-light">
    <div class="container py-4">
        <h3 class="mb-4">➕ เพิ่มสมาชิกใหม่</h3>

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
                <select name="major" class="form-select" required>
                    <option value="">-- เลือกสาขา --</option>
                    <?php foreach ($majors as $m): ?>
                        <option value="<?= $m ?>"><?= $m ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12">
                <label>ปีการศึกษา (พ.ศ.)</label>
                <select name="academic_year" class="form-select" required>
                    <option value="">-- เลือกปีการศึกษา --</option>
                    <?php foreach ($years as $y): ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary">บันทึก</button>
                <a href="index.php" class="btn btn-secondary">กลับ</a>
            </div>
        </form>
    </div>
</body>

</html>