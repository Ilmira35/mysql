<?php
  include "../config/db.php";
  $sql = "SELECT * FROM students";
  $data = $conn->prepare($sql);
  $data->execute();
  $students = $data->fetchAll();
  $cnt = 1;
 ?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentlar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg:  #fdfffe;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

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
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        /* Tugmalar */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:active { transform: scale(0.98); }

        .btn-add {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-add:hover { background-color: #4338ca; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); }

        .action-btn {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
        }

        .btn-view { background-color: #e0e7ff; color: var(--primary); }
        .btn-view:hover { background-color: var(--primary); color: white; }

        .btn-edit { background-color: #fef3c7; color: #d97706; }
        .btn-edit:hover { background-color: #d97706; color: white; }

        .btn-delete { background-color: #fee2e2; color: var(--danger); }
        .btn-delete:hover { background-color: var(--danger); color: white; }

        /* Jadval kartasi */
        .table-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #f1f5f9;
            padding: 16px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: var(--text-dark);
        }

        table tr:last-child td { border-bottom: none; }

        table tr:hover { background-color: #fafafa; }

        /* Status yoki Sinfi uchun kichik badge */
        .badge {
            background: #f1f5f9;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .phone-text { color: var(--text-light); font-family: monospace; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <div>
            <h2>Studentlar Paneli</h2>
            <p style="color: var(--text-light); font-size: 14px;">Barcha ro'yxatga olingan o'quvchilar</p>
        </div>
        <a href="../students/create.php" class="btn btn-add">
            <span style="font-size: 18px;">+</span> Student qo'shish
</a>
    </div>

    <div class="table-card">
        <table>
                <thead>
    <tr>
        <th>#</th> <th>Ism</th>
        <th>Familiya</th>
        <th>Yosh</th>
        <th>Sinf</th>
        <th>Telefon</th>
        <th>Manzil</th>
        <th>Amallar</th>
    </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student): ?>
                <tr>
                    <td><?=$cnt++ ?></td>
                    <td><?=$student['first_name'] ?></td>
                    <td><?=$student['last_name'] ?></td>
                    <td><?=$student['age'] ?></td>
                    <td><?=$student['class_name'] ?></td>
                    <td><?=$student['phone'] ?></td>
                    <td><?=$student['address'] ?></td>
                    <td class="actions">
                        <a href="show.php?id=<?= $student['id'] ?>" class="btn-view">Ko'rish</a>
                        <a href="edit.php?id=<?= $student['id'] ?>" class="btn-edit">Tahrirlash</a>
                        <a href="delete.php?id=<?= $student['id'] ?>" class="btn-delete"  onclick="return confirm('O\'chirasizmi?')">O'chirish</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>