<?php

include "../config/db.php";

$sql = "SELECT classes.*, teachers.first_name, teachers.last_name 
        FROM classes 
        LEFT JOIN teachers ON classes.teachers_id = teachers.id";
$data = $conn->prepare($sql);
$data->execute();
$classes = $data->fetchAll();
  $cnt = 1;
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinflar Ro'yxati</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg);
            padding: 40px 20px;
            color: var(--text-dark);
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        /* Header qismi */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 { font-size: 24px; font-weight: 700; }

        .btn-add {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }

        .btn-add:hover { opacity: 0.9; transform: translateY(-2px); }

        /* Jadval dizayni */
        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
            color: var(--text-light);
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 15px;
        }

        tr:last-child td { border-bottom: none; }

        tr:hover { background: #f8fafc; }

        .class-badge {
            background: #eef2ff;
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
        }

        /* Amallar tugmalari */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.2s;
            font-size: 14px;
        }

        .view { color: var(--primary); background: #eef2ff; }
        .edit { color: var(--warning); background: #fffbeb; }
        .delete { color: var(--danger); background: #fef2f2; }

        .btn-action:hover { transform: scale(1.1); }

        .back-nav {
            margin-bottom: 20px;
            display: inline-block;
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
        }
        .back-nav:hover { color: var(--primary); }
    </style>
</head>
<body>

<div class="container">
    <a href="../index.php" class="back-nav"><i class="fa-solid fa-arrow-left-long"></i> Dashboard</a>
    
    <div class="header">
        <h1><i class="fa-solid fa-layer-group" style="color: var(--primary)"></i> Sinflar Boshqaruvi</h1>
        <a href="create.php" class="btn-add"><i class="fa-solid fa-plus"></i> Yangi sinf qo'shish</a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sinf Nomi</th>
                    <th>Biriktirilgan O'qituvchi</th>
                    <th style="text-align: right;">Amallar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($classes as $class): ?>
                <tr>
                    <td style="color: var(--text-light);">#<?=$cnt++ ?></td>
                    <td><span class="class-badge"><?= htmlspecialchars($class['class_name']) ?></span></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-circle-user" style="color: #cbd5e1; font-size: 20px;"></i>
                            <span><?= $class['first_name'] ? htmlspecialchars($class['first_name'] . " " . $class['last_name']) : "<i style='color:red'>Tayinlanmagan</i>" ?></span>
                        </div>
                    </td>
                    <td align="right">
                        <div class="actions" style="justify-content: flex-end;">
                            <a href="show.php?id=<?= $class['id'] ?>" class="btn-action view" title="Ko'rish"><i class="fa-solid fa-eye"></i></a>
                            <a href="edit.php?id=<?= $class['id'] ?>" class="btn-action edit" title="Tahrirlash"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete.php?id=<?= $class['id'] ?>" class="btn-action delete" title="O'chirish" onclick="return confirm('Sinfni o\'chirmoqchimisiz?')"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>