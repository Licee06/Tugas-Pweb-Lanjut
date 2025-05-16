<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f9fc;
        }
        h1 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 700px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-btn {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            margin-right: 5px;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .add-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <a href="index.php?action=add" class="add-btn">Tambah Mahasiswa</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($data as $mhs): ?>
        <tr>
            <td><?= htmlspecialchars($mhs['id']); ?></td>
            <td><?= htmlspecialchars($mhs['nama']); ?></td>
            <td><?= htmlspecialchars($mhs['nim']); ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $mhs['id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="index.php?action=delete&id=<?= $mhs['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
