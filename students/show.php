<?php
include "../config/db.php";
$id = $_GET['id'];
$sql = "SELECT * FROM students where id = ?";
$data = $conn->prepare($sql);
$data->execute([$id]);
$student = $data->fetch ();
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talaba Profili - <?php echo $student['first_name']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#f8fafc] flex items-center justify-center min-h-screen p-6">

    <div class="max-w-md w-full bg-white rounded-[2rem] shadow-xl overflow-hidden border border-gray-100">
        <div class="relative h-32 bg-gradient-to-r from-indigo-600 to-purple-600">
            <div class="absolute -bottom-12 left-1/2 -translate-x-1/2">
                <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center shadow-lg border-4 border-white">
                    <span class="text-3xl font-bold text-indigo-600">
                        <?php echo substr($student['first_name'], 0, 1) . substr($student['last_name'], 0, 1); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="pt-16 pb-8 px-8 text-center">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php echo $student['first_name'] . ' ' . $student['last_name']; ?>
            </h1>
            <p class="text-indigo-500 font-medium bg-indigo-50 inline-block px-4 py-1 rounded-full mt-2">
                <?php echo $student['class_id']; ?> o'quvchisi
            </p>

            <div class="mt-8 space-y-4 text-left">
                <div class="flex items-center p-3 bg-gray-50 rounded-2xl border border-transparent hover:border-indigo-200 transition-all">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4 text-indigo-500">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Yosh</p>
                        <p class="text-gray-700 font-semibold"><?php echo $student['age']; ?> yoshda</p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-2xl border border-transparent hover:border-indigo-200 transition-all">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4 text-green-500">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Telefon</p>
                        <p class="text-gray-700 font-semibold"><?php echo $student['phone']; ?></p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-2xl border border-transparent hover:border-indigo-200 transition-all">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4 text-red-500">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Manzil</p>
                        <p class="text-gray-700 font-semibold"><?php echo $student['address']; ?></p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <a href="index.php" class="flex-1 py-3 px-4 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all text-center">
                    Orqaga
                </a>
                <button onclick="window.print()" class="w-12 h-12 flex items-center justify-center bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                    <i class="fas fa-print"></i>
                </button>
            </div>
        </div>
    </div>

</body>
</html>