<?php
$orderSuccess = false;
$name = "";
$book = "";
$phone = "";
$address = "";
$email = "";

if (isset($_GET['book'])) {
    $book = htmlspecialchars($_GET['book']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $book = htmlspecialchars($_POST['book']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $email = htmlspecialchars($_POST['email']);
    $data = "Nama: $name, Buku: $book, Nomor Telepon: $phone, Alamat: $address, Email: $email\n";
    file_put_contents('orders.txt', $data, FILE_APPEND);
    $orderSuccess = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Buku</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url('baxk.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        h1 {
            color: black;
        }
    </style>
</head>
<body>
    <h1>Pesan Buku: <?php echo isset($book) ? $book : 'Tidak ada buku yang dipilih'; ?></h1>
    
    <?php if ($orderSuccess): ?>
        <p>Terima kasih, <?php echo $name; ?>! Pesanan Anda untuk buku '<?php echo $book; ?>' telah berhasil diproses.</p>
        <p>Detail Pesanan:</p>
        <ul>
            <li>Nama: <?php echo $name; ?></li>
            <li>Buku: <?php echo $book; ?></li>
            <li>Nomor Telepon: <?php echo $phone; ?></li>
            <li>Alamat: <?php echo $address; ?></li>
            <li>Email: <?php echo $email; ?></li>
        </ul>
    <?php else: ?>
        <form action="" method="post">
            <input type="hidden" name="book" value="<?php echo isset($book) ? $book : ''; ?>">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="phone">Nomor Telepon:</label>
            <input type="text" id="phone" name="phone" required>
            <br>
            <label for="address">Alamat:</label>
            <textarea id="address" name="address" required></textarea>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <button type="submit">Pesan</button>
        </form>
    <?php endif; ?>
</body>
</html>
