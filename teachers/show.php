<?php
// 1. DATABASE ULANISH
$host = "localhost";
$db_name = "student_manegement"; 
$db_user = "root";
$db_password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Baza bilan aloqa yo'q!");
}

// 2. ID BO'YICHA O'QITUVCHINI TOPISH
$teacher = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE id = ?");
    $stmt->execute([$id]);
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$teacher) {
    die("O'qituvchi topilmadi yoki ID noto'g'ri!");
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil: <?= htmlspecialchars($teacher['first_name']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --bg: #f8fafc;
            --white: #ffffff;
            --text-dark: #0f172a;
            --text-light: #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body { 
            background-color: var(--bg); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh;
            padding: 20px;
        }

        .profile-card {
            background: var(--white);
            width: 100%;
            max-width: 500px;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        .profile-header {
            background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
            position: relative;
        }

        .avatar-large {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 700;
            margin: 0 auto 15px;
        }

        .profile-header h2 { font-size: 24px; font-weight: 700; }
        .profile-header p { opacity: 0.8; font-size: 14px; margin-top: 5px; }

        .profile-body { padding: 30px; }

        .info-row {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-row:last-child { border-bottom: none; }

        .icon-circle {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .info-content label { display: block; font-size: 11px; text-transform: uppercase; color: var(--text-light); font-weight: 700; letter-spacing: 0.5px; }
        .info-content span { font-size: 15px; color: var(--text-dark); font-weight: 600; }

        .footer-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            padding: 0 30px 30px;
        }

        .btn {
            padding: 12px;
            border-radius: 14px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            transition: 0.3s;
        }
        .btn-back { background: #f1f5f9; color: var(--text-light); }
        .btn-edit { background: var(--primary); color: white; }
        .btn:hover { transform: translateY(-2px); opacity: 0.9; }
    </style>
</head>
<body>

<div class="profile-card">
    <div class="profile-header">
        <div class="avatar-large">
            <?= substr($teacher['first_name'], 0, 1) ?>
        </div>
        <h2><?= htmlspecialchars($teacher['first_name'] . " " . $teacher['last_name']) ?></h2>
        <p><i class="fa-solid fa-graduation-cap"></i> <?= htmlspecialchars($teacher['subject']) ?> o'qituvchisi</p>
    </div>

    <div class="profile-body">
        <div class="info-row">
            <div class="icon-circle"><i class="fa-solid fa-phone"></i></div>
            <div class="info-content">
                <label>Telefon raqami</label>
                <span><?= htmlspecialchars($teacher['phone']) ?></span>
            </div>
        </div>

        <div class="info-row">
            <div class="icon-circle"><i class="fa-solid fa-briefcase"></i></div>
            <div class="info-content">
                <label>Ish tajribasi</label>
                <span><?= htmlspecialchars($teacher['experience']) ?> yil</span>
            </div>
        </div>

        <div class="info-row">
            <div class="icon-circle"><i class="fa-solid fa-location-dot"></i></div>
            <div class="info-content">
                <label>Manzil</label>
                <span><?= htmlspecialchars($teacher['address']) ?></span>
            </div>
        </div>

        <div class="info-row">
            <div class="icon-circle"><i class="fa-solid fa-calendar-check"></i></div>
            <div class="info-content">
                <label>Ro'yxatdan o'tgan sana</label>
                <span><?= date('d-F, Y', strtotime($teacher['created_at'])) ?></span>
            </div>
        </div>
    </div>

    <div class="footer-actions">
        <a href="index.php" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i> Orqaga</a>
        <a href="edit.php?id=<?= $teacher['id'] ?>" class="btn btn-edit"><i class="fa-solid fa-pen"></i> Tahrirlash</a>
    </div>
</div>

</body>
</html>