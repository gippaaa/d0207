<?php
$harga = null;
$diskon = null;
$harga_setelah_diskon = null;
$error_message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $harga = str_replace('.', '', $_POST['harga']);
    $diskon = $_POST['diskon'];

    if ($diskon > 100) {
        $error_message = "Diskon tidak boleh lebih dari 100%";
    } else {
        $total_diskon = ($diskon / 100) * $harga;
        $harga_setelah_diskon = $harga - $total_diskon;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Diskon Dini</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<style>
body {
    background: linear-gradient(to bottom, #FFFFFF, #FF74D9);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.bingkai {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 350px;
}
</style>

<div class="bingkai">
    <h2 class="text-center">Penghitung Diskon</h2>

    <?php if ($error_message): ?>
        <div class="alert alert-danger mt-3 text-center">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Harga Awal</label>
            <input type="text" name="harga" id="harga" class="form-control" required oninput="formatRibuan(this)">
        </div>

        <div class="mb-3">
            <label class="form-label">Persentase Diskon</label>
            <input type="number" name="diskon" id="diskon" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-danger w-100">Hitung</button>
    </form>

    <!-- Hasil Perhitungan -->
    <?php if ($harga_setelah_diskon !== null): ?>
        <div class="alert alert-info mt-3">
            <p><strong>Total Diskon:</strong> Rp <?php echo number_format($total_diskon, 0, ',', '.'); ?></p>
            <p><strong>Harga Setelah Diskon:</strong> Rp <?php echo number_format($harga_setelah_diskon, 0, ',', '.'); ?></p>
        </div>
    <?php endif; ?>
</div>

</body>

<script>
    function formatRibuan(input) {
        let value = input.value.replace(/\D/g, '');
        input.value = new Intl.NumberFormat('id-ID').format(value);
    }
</script>

</html>
