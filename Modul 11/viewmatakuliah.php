<?php
  include("koneksi.php");

  // Fitur pencarian
  $search = "";
  $whereClause = "";
  if (isset($_GET['search']) && !empty($_GET['search'])) {
      $search = mysqli_real_escape_string($link, $_GET['search']);
      $whereClause = " WHERE namaMK LIKE '%$search%'";
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah — SIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="brand">SIA <span>| Sistem Informasi Akademik</span></div>
        <ul class="nav-links">
            <li><a href="index.php">🏠 Dashboard</a></li>
            <li><a href="viewdosen.php">👨‍🏫 Dosen</a></li>
            <li><a href="viewmahasiswa.php">🎓 Mahasiswa</a></li>
            <li><a href="viewmatakuliah.php" class="active">📚 Mata Kuliah</a></li>
        </ul>
    </nav>

    <!-- Page Header -->
    <div class="page-header fade-in">
        <h1>Data Mata Kuliah</h1>
        <p>Kelola data mata kuliah di sistem informasi akademik</p>
    </div>

    <div class="card fade-in">
        <!-- Actions Bar -->
        <div class="actions-bar">
            <form class="search-bar" method="GET" action="viewmatakuliah.php">
                <input type="text" name="search" placeholder="🔍 Cari berdasarkan nama mata kuliah..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Cari</button>
            </form>
            <a href="inputmatakuliah.php" class="btn btn-primary">+ Tambah Mata Kuliah</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <!-- Tabel Mata Kuliah -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $query = "SELECT * FROM t_matakuliah" . $whereClause . " ORDER BY kodeMK ASC";
                  $result = mysqli_query($link, $query);

                  if(!$result) {
                      die ("Query Error: ".mysqli_errno($link).
                      " - ".mysqli_error($link));
                  }

                  if (mysqli_num_rows($result) > 0) {
                      while ($data = mysqli_fetch_assoc($result))
                      {
                          echo "<tr>";
                          echo "<td>$data[kodeMK]</td>";
                          echo "<td>$data[namaMK]</td>";
                          echo "<td>$data[sks]</td>";
                          echo "<td>$data[jam]</td>";
                          echo '<td class="action-links">
                              <a href="editmatakuliah.php?kodeMK='.$data['kodeMK'].'" class="btn btn-warning btn-sm">✏️ Edit</a>
                              <a href="hapusmatakuliah.php?kodeMK='.$data['kodeMK'].'" class="btn btn-danger btn-sm"
                                  onclick="return confirm(\'Anda yakin akan menghapus data?\')">🗑️ Hapus</a>
                          </td>';
                          echo "</tr>";
                      }
                  } else {
                      echo '<tr><td colspan="5"><div class="empty-state"><div class="icon">📭</div><p>Belum ada data mata kuliah' . ($search ? ' untuk pencarian "' . htmlspecialchars($search) . '"' : '') . '</p></div></td></tr>';
                  }
                ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> Sistem Informasi Akademik
    </div>
</body>
</html>
