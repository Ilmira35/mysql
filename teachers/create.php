<?php
// 1. Ma'lumotlar bazasiga ulanish
include "../config/db.php";

$message = "";
$message_type = "";

// 2. Forma yuborilganda ma'lumotlarni qabul qilish
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $subject    = $_POST['subject'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $experience = $_POST['experience'];

    try {
        $sql = "INSERT INTO teachers (first_name, last_name, subject, phone, address, experience) 
                VALUES (:first_name, :last_name, :subject, :phone, :address, :experience)";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':experience', $experience);

        if ($stmt->execute()) {
            $message = "O'qituvchi muvaffaqiyatli qo'shildi!";
            $message_type = "success";
            // 2 sekunddan keyin ro'yxat sahifasiga qaytish
            header("refresh:2; url=index.php");
        }
    } catch (PDOException $e) {
        $message = "Xatolik yuz berdi: " . $e->getMessage();
        $message_type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yangi o'qituvchi qo'shish</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --card: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body { background-color: var(--bg); color: var(--text-dark); padding: 40px 20px; }

        .container { max-width: 700px; margin: auto; }

        .back-link {
            text-decoration: none;
            color: var(--text-light);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: 0.2s;
        }
        .back-link:hover { color: var(--primary); }

        .card {
            background: var(--card);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
        }

        h2 { font-size: 24px; font-weight: 700; margin-bottom: 8px; color: var(--text-dark); }
        p.subtitle { color: var(--text-light); font-size: 14px; margin-bottom: 30px; }

        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #475569; }

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s;
            background: #fcfcfd;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            background: white;
        }

        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-submit:hover { background: var(--primary-hover); transform: translateY(-2px); }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        @media (max-width: 600px) { .row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="container">
    <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Orqaga qaytish</a>

    <div class="card">
        <h2>Yangi o'qituvchi</h2>
        <p class="subtitle">Tizimga yangi mutaxassis ma'lumotlarini kiriting.</p>

        <?php if($message): ?>
            <div class="alert alert-<?= $message_type ?>">
                <i class="fa-solid <?= $message_type == 'success' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="row">
                <div class="form-group">
                    <label>Ism</label>
                    <input type="text" name="first_name" placeholder="Masalan: Ali" required>
                </div>
                <div class="form-group">
                    <label>Familiya</label>
                    <input type="text" name="last_name" placeholder="Masalan: Valiyev" required>
                </div>
            </div>

            <div class="form-group">
                <label>Mutaxassislik (Fan)</label>
                <input type="text" name="subject" placeholder="Masalan: Matematika" required>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Telefon raqami</label>
                    <input type="text" name="phone" placeholder="+998 90 123 45 67" required>
                </div>
                <div class="form-group">
                    <label>Ish tajribasi (yil)</label>
                    <input type="number" name="experience" placeholder="Masalan: 5" required>
                </div>
            </div>

            <div class="form-group">
                <label>Yashash manzili</label>
                <textarea name="address" rows="3" placeholder="To'liq manzilni kiriting..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Ma'lumotlarni saqlash
            </button>
        </form>
    </div>
</div>

</body>
</html>