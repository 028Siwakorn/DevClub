<?php
session_start();
include 'db.php';

// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && $password === $admin['password']) {
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['admin_name'] = $admin['fullname'];
        header("Location: index.php");
        exit;
    } else {
        $login_error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    }
}

// Register
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $register_error = "รหัสผ่านไม่ตรงกัน";
    } else {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $register_error = "อีเมลนี้ถูกใช้แล้ว";
        } else {
            $stmt = $conn->prepare("INSERT INTO admins (fullname, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fullname, $email, $password);
            if ($stmt->execute()) {
                $register_success = "สมัครสมาชิกสำเร็จ! สามารถเข้าสู่ระบบได้ทันที";
            } else {
                $register_error = "เกิดข้อผิดพลาด: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Admin Login/Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
        }

        .card {
            border-radius: 1rem;
        }

        .nav-tabs .nav-link.active {
            background-color: #2575fc;
            color: #fff;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #2575fc;
            font-weight: 500;
        }

        .btn-primary,
        .btn-success {
            border-radius: 50px;
            font-weight: 600;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-10">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-3 text-primary"><i class="bi bi-shield-lock-fill"></i> DevClub Admin</h3>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3" id="tabAuth" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">
                                <i class="bi bi-pencil-square"></i> Register
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Login Tab -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger"><?= $login_error ?></div>
                            <?php endif; ?>

                            <form method="post">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="admin@devclub.com" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="******" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">
                                    เข้าสู่ระบบ
                                </button>
                            </form>
                        </div>

                        <!-- Register Tab -->
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <?php if (isset($register_error)): ?>
                                <div class="alert alert-danger"><?= $register_error ?></div>
                            <?php elseif (isset($register_success)): ?>
                                <div class="alert alert-success"><?= $register_success ?></div>
                            <?php endif; ?>

                            <form method="post">
                                <div class="mb-3">
                                    <label>ชื่อ-นามสกุล</label>
                                    <input type="text" name="fullname" class="form-control" placeholder="ชื่อ-นามสกุล" required>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="admin@devclub.com" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="******" required>
                                </div>
                                <div class="mb-3">
                                    <label>ยืนยัน Password</label>
                                    <input type="password" name="confirm" class="form-control" placeholder="******" required>
                                </div>
                                <button type="submit" name="register" class="btn btn-success w-100">
                                    สมัครผู้ดูแล
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>