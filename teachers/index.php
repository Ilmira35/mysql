<?php
  // Bazaga ulanish (config faylingiz yo'li to'g'riligini tekshiring)
  include "../config/db.php"; 

  // O'qituvchilarni bazadan olish
  $sql = "SELECT * FROM teachers ORDER BY id DESC";
  $data = $conn->prepare($sql);
  $data->execute();
  $teachers = $data->fetchAll();
  $cnt = 1;
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'qituvchilar Paneli</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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

        body { background-color: var(--bg); padding: 40px 20px; color: var(--text-dark); }

        .container { max-width: 1200px; margin: auto; }

        /* Header section */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 { font-size: 26px; font-weight: 700; color: var(--text-dark); letter-spacing: -0.5px; }

        /* Tugmalar */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-add { background-color: var(--primary); color: white; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2); }
        .btn-add:hover { background-color: #4338ca; transform: translateY(-2px); }

        /* Harakat tugmalari (Action buttons) */
        .actions { display: flex; gap: 8px; }
        .action-link {
            padding: 8px;
            border-radius: 8px;
            font-size: 14px;
            text-decoration: none;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .view { background: #e0e7ff; color: var(--primary); }
        .view:hover { background: var(--primary); color: white; }

        .edit { background: #fef3c7; color: #d97706; }
        .edit:hover { background: #d97706; color: white; }

        .delete { background: #fee2e2; color: var(--danger); }
        .delete:hover { background: var(--danger); color: white; }

        /* Jadval kartasi */
        .table-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        table { width: 100%; border-collapse: collapse; }

        table th {
            background-color: #f1f5f9;
            padding: 18px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table td { padding: 16px 18px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        table tr:last-child td { border-bottom: none; }
        table tr:hover { background-color: #f8fafc; }

        /* Badge uslubi */
        .badge-subject {
            background: #eff6ff;
            color: #2563eb;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .experience-tag {
            color: var(--success);
            font-weight: 600;
            background: #ecfdf5;
            padding: 2px 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <div>
            <h2>O'qituvchilar Paneli</h2>
            <p style="color: var(--text-light); font-size: 14px; margin-top: 4px;">Akademiya o'qituvchilari boshqaruv tizimi</p>
        </div>
        <a href="create.php" class="btn btn-add">
            <i class="fa-solid fa-plus"></i> O'qituvchi qo'shish
        </a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>F.I.SH</th>
                    <th>Mutaxassislik</th>
                    <th>Tajriba</th>
                    <th>Telefon</th>
                    <th>Manzil</th>
                    <th style="text-align: center;">Amallar</th>
                </tr>
            </thead>
            <tbody>
                <?php if($teachers): ?>
                    <?php foreach($teachers as $teacher): ?>
                    <tr>
                        <td><span style="color: var(--text-light); font-weight: 600;"><?= $cnt++ ?></span></td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-dark);">
                                <?= htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) ?>
                            </div>
                        </td>
                        <td><span class="badge-subject"><?= htmlspecialchars($teacher['subject']) ?></span></td>
                        <td><span class="experience-tag"><?= htmlspecialchars($teacher['experience']) ?> yil</span></td>
                        <td style="color: var(--text-light); font-family: monospace;"><?= htmlspecialchars($teacher['phone']) ?></td>
                        <td style="color: var(--text-light); font-size: 13px;"><?= htmlspecialchars($teacher['address']) ?></td>
                        <td>
                            <div class="actions">
                                <a href="show.php?id=<?= $teacher['id'] ?>" class="action-link view" title="Ko'rish">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="edit.php?id=<?= $teacher['id'] ?>" class="action-link edit" title="Tahrirlash">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="delete.php?id=<?= $teacher['id'] ?>" 
                                   class="action-link delete" 
                                   title="O'chirish" 
                                   onclick="return confirm('Haqiqatdan ham ushbu o\'qituvchini ro\'yxatdan o\'chirmoqchimisiz?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 50px; color: var(--text-light);">
                            Ma'lumotlar mavjud emas.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>