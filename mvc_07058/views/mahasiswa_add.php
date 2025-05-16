<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f7f8;
        }
        h1 {
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Tambah Mahasiswa</h1>
    <form action="index.php?action=add" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required>

        <button type="submit">Simpan</button>
    </form>
    <a href="index.php">Kembali ke Daftar</a>
</body>
</html>
