<?php
require_once __DIR__ . '/../../../../Controller/Edit_Ras_Hewan_process.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Nama Ras Hewan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <nav class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center shadow">
        <h1 class="text-xl font-bold">✏️ Edit Nama Ras Hewan</h1>
    </nav>

    <main class="container mx-auto p-6 flex-grow">
        <div class="bg-white rounded-lg shadow p-6">
            <?php if (!empty($notif)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                    <?= htmlspecialchars($notif) ?>
                </div>
            <?php endif; ?>

            <!-- 🔹 Dropdown ras -->
            <?php if ($jenis): ?>
                <form method="POST" action="../../../../Controller/edit_ras_Hewan_process.php" class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Pilih Ras Hewan (<?= htmlspecialchars($jenis['nama_jenis_hewan']) ?>)
                    </label>
                    <select name="idras_hewan" onchange="this.form.submit()"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Ras --</option>
                        <?php foreach ($rasList as $r): ?>
                            <option value="<?= $r['idras_hewan']; ?>" <?= ($id == $r['idras_hewan']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($r['nama_ras']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            <?php endif; ?>

            <!-- 🔹 Form edit -->
            <?php if ($ras): ?>
                <form method="POST">
                    <input type="hidden" name="idras_hewan" value="<?= htmlspecialchars($id) ?>">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nama Ras</label>
                        <input type="text" name="nama_ras" value="<?= htmlspecialchars($ras['nama_ras']) ?>"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="../Ras_Hewan.php"
                            class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Kembali</a>
                        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                            💾 Simpan
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>