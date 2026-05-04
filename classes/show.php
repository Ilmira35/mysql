<?php
// 1. BAZAGA ULANISH
include "../config/db.php";

// 2. ID ORQALI MA'LUMOTNI OLISH
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Sinf ma'lumotlarini o'qituvchi ismi bilan birga olish (JOIN orqali)
    $sql = "SELECT classes.*, teachers.first_name, teachers.last_name 
            FROM classes 
            LEFT JOIN teachers ON classes.teachers_id = teachers.id 
            WHERE classes.id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $class = $stmt->fetch();

    // Agar bunday ID li sinf bo'lmasa, orqaga qaytarish
    if (!$class) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($class['class_name']) ?> - Tafsilotlar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --bg: #f8fafc;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .show-card {
            background: var(--white);
            width: 100%;
            max-width: 500px;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header {
            background: var(--primary);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .card-header i {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .card-header h2 {
            font-size: 24px;
            font-weight: 700;
        }

        .card-body {
            padding: 30px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
        }

        .info-row:last-child { border-bottom: none; }

        .label {
            color: var(--text-light);
            font-weight: 500;
            font-size: 14px;
        }

        .value {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 15px;
        }

        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            padding: 0 30px 30px 30px;
        }

        .btn {
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-edit { background: #eef2ff; color: var(--primary); }
        .btn-back { background: #f1f5f9; color: var(--text-light); }
        .btn:hover { transform: translateY(-2px); opacity: 0.9; }

        .badge {
            background: #f0fdf4;
            color: #22c55e;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="show-card">
        <div class="card-header">
            <i class="fa-solid fa-layer-group"></i>
            <h2>Sinf Tafsilotlari</h2>
        </div>

        <div class="card-body">
            <div class="info-row">
                <span class="label">ID raqami:</span>
                <span class="value">#<?= $class['id'] ?></span>
            </div>
            
            <div class="info-row">
                <span class="label">Sinf nomi:</span>
                <span class="value"><?= htmlspecialchars($class['class_name']) ?></span>
            </div>

            <div class="info-row">
                <span class="label">Mas'ul o'qituvchi:</span>
                <span class="value">
                    <?= $class['first_name'] ? htmlspecialchars($class['first_name'] . " " . $class['last_name']) : "<i style='color:red'>Biriktirilmagan</i>" ?>
                </span>
            </div>

            <div class="info-row">
                <span class="label">Holati:</span>
                <span class="value"><span class="badge">Faol</span></span>
            </div>
        </div>

        <div class="btn-group">
            <a href="index.php" class="btn btn-back">
                <i class="fa-solid fa-chevron-left"></i> Orqaga
            </a>
            <a href="edit.php?id=<?= $class['id'] ?>" class="btn btn-edit">
                <i class="fa-solid fa-pen"></i> Tahrirlash
            </a>
        </div>
    </div>

</body>
</html>