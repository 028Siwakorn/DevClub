<?php
include 'auth.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>DevClub Members</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #d0e7ff;
            /* ฟ้าอ่อนสดใส */
        }

        .navbar {
            background-color: #1e90ff;
            /* น้ำเงินสดใส */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .card-header-devclub {
            background-color: #a0d8ff;
            /* ฟ้าอ่อนกว่า Navbar */
            color: #000;
            font-weight: bold;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            border-radius: 1rem 1rem 0 0;
            padding: 0.75rem 1.25rem;
        }

        .card-header-devclub img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table-primary th {
            background-color: #3399ff;
            color: white;
        }

        .badge-info {
            background-color: #17a2b8;
            font-weight: 500;
        }

        @media (max-width: 575px) {
            .navbar .ms-auto span {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="logo.png" alt="DevClub Logo">
                DevClub
            </a>

            <!-- Admin Info -->
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">
                    <i class="bi bi-person-circle"></i>
                    <?= htmlspecialchars($_SESSION['admin_name']); ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> ออกจากระบบ
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h3 class="mb-3 mb-md-0 text-primary">
                <i class="bi bi-people-fill"></i> ระบบจัดการสมาชิก
            </h3>

            <a href="add.php" class="btn btn-primary shadow-sm">
                <i class="bi bi-person-plus-fill"></i> เพิ่มสมาชิกใหม่
            </a>
        </div>

        <!-- Card -->
        <div class="card">
            <!-- Card Header DevClub -->
            <div class="card-header-devclub">
                <img src="logo.png" alt="DevClub Logo">
                <span>รายชื่อสมาชิก DevClub</span>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>Email</th>
                                <th>สาขา</th>
                                <th>ปีการศึกษา</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT * FROM members");
                            while ($row = $result->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= $row['member_id']; ?></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['fullname']); ?></td>
                                    <td><?= htmlspecialchars($row['email']); ?></td>
                                    <td><?= htmlspecialchars($row['major']); ?></td>
                                    <td>
                                        <span class="badge badge-info"><?= $row['academic_year']; ?></span>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['member_id']; ?>" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="delete.php?id=<?= $row['member_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>