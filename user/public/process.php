<?php
session_start();
require_once("../private/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db->beginTransaction();

        // Cek apakah user sudah login
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("User belum login.");
        }
        $user_id = $_SESSION['user_id'];

        // Ambil data dari form
        $nama_pemohon = trim($_POST['nama_lengkap']);
        $nik_pemohon = trim($_POST['nik_pemohon']);
        $no_kk_pemohon = trim($_POST['no_kk_pemohon']);
        $alamat_rumah = trim($_POST['alamat_rumah']);

        // Upload file PDF
        $kartu_keluarga_file = uploadFile('kartu_keluarga');
        $dokumen_pendukung_file = uploadFile('dokumen_pendukung');

        // Ambil input_id terakhir dari tabel pemohon
        $sql_cek_input_id = "SELECT MAX(input_id) AS last_input_id FROM pemohon";
        $stmt_cek_input_id = $db->prepare($sql_cek_input_id);
        $stmt_cek_input_id->execute();
        $last_input_id = $stmt_cek_input_id->fetch(PDO::FETCH_ASSOC)['last_input_id'];

        // Tentukan input_id berikutnya
        $input_id = ($last_input_id !== null) ? $last_input_id + 1 : 1;

        // Simpan data ke tabel pemohon
        $sql_pemohon = "INSERT INTO pemohon (nama_lengkap, nik, no_kk, alamat_rumah, user_id, status, input_id, kartu_keluarga, dokumen_pendukung) 
                        VALUES (:nama_lengkap, :nik, :no_kk, :alamat_rumah, :user_id, 'Menunggu', :input_id, :kartu_keluarga, :dokumen_pendukung)";
        $stmt_pemohon = $db->prepare($sql_pemohon);
        $stmt_pemohon->execute([
            ':nama_lengkap' => $nama_pemohon,
            ':nik' => $nik_pemohon,
            ':no_kk' => $no_kk_pemohon,
            ':alamat_rumah' => $alamat_rumah,
            ':user_id' => $user_id,
            ':input_id' => $input_id,
            ':kartu_keluarga' => $kartu_keluarga_file,
            ':dokumen_pendukung' => $dokumen_pendukung_file
        ]);

        // Simpan Data Anggota Keluarga ke tabel penduduk
        if (isset($_POST['nama'])) {
            $totalAnggota = count($_POST['nama']);
            for ($i = 0; $i < $totalAnggota; $i++) {
                $nama = trim($_POST['nama'][$i]);
                $no_kk = trim($_POST['no_kk'][$i]);
                $nik = trim($_POST['nik'][$i]);
                $shdk = trim($_POST['shdk'][$i]);
                $keterangan = trim($_POST['keterangan'][$i]);

                $sql_penduduk = "INSERT INTO penduduk (nama, no_kk, nik, shdk, keterangan, input_id) 
                                 VALUES (:nama, :no_kk, :nik, :shdk, :keterangan, :input_id)";
                $stmt_penduduk = $db->prepare($sql_penduduk);
                $stmt_penduduk->execute([
                    ':nama' => $nama,
                    ':no_kk' => $no_kk,
                    ':nik' => $nik,
                    ':shdk' => $shdk,
                    ':keterangan' => $keterangan,
                    ':input_id' => $input_id
                ]);

                // Simpan Perubahan (jika ada)
                if (!empty($_POST['jenis_permohonan'][$i])) {
                    $jumlahPermohonan = count($_POST['jenis_permohonan'][$i]);
                    for ($j = 0; $j < $jumlahPermohonan; $j++) {
                        $jenis_permohonan = trim($_POST['jenis_permohonan'][$i][$j]);
                        $semula = trim($_POST['semula'][$i][$j]);
                        $menjadi = trim($_POST['menjadi'][$i][$j]);
                        $dasar_perubahan = trim($_POST['dasar_perubahan'][$i][$j]);

                        $sql_permohonan = "INSERT INTO permohonan_perubahan (nik, jenis_permohonan, semula, menjadi, dasar_perubahan) 
                                           VALUES (:nik, :jenis_permohonan, :semula, :menjadi, :dasar_perubahan)";
                        $stmt_permohonan = $db->prepare($sql_permohonan);
                        $stmt_permohonan->execute([
                            ':nik' => $nik,
                            ':jenis_permohonan' => $jenis_permohonan,
                            ':semula' => $semula,
                            ':menjadi' => $menjadi,
                            ':dasar_perubahan' => $dasar_perubahan
                        ]);
                    }
                }
            }
        }

        // Commit transaksi
        $db->commit();

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                window.onload = function() {
                  Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data telah berhasil disimpan.',
                    confirmButtonText: 'Lanjutkan'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = 'status.php?status=sukses';
                    }
                  });
                };
              </script>";
        exit();

    } catch (Exception $e) {
        $db->rollBack();
        $errorMessage = $e->getMessage();
        if (strpos($errorMessage, 'Duplicate entry') !== false) {
            $errorMessage = "NIK yang Anda masukkan sudah terdaftar. Silakan cek kembali.";
        } else {
            $errorMessage = "Terjadi kesalahan saat menyimpan data. Silakan coba lagi.";
        }

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                window.onload = function() {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: " . json_encode($errorMessage) . ",
                    confirmButtonText: 'Kembali'
                  }).then(() => {
                    window.history.back();
                  });
                };
              </script>";
        exit();
    }
}

function uploadFile($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$inputName]['tmp_name'];
        $fileName = $_FILES[$inputName]['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validasi hanya file PDF yang diizinkan
        if ($fileExtension !== 'pdf') {
            throw new Exception("File $inputName harus berformat PDF.");
        }

        if (!is_dir("uploads")) {
            mkdir("uploads", 0755, true);
        }

        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = "uploads/" . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            return $newFileName;
        } else {
            throw new Exception("Gagal mengunggah file $inputName.");
        }
    }
    return null;
}
?>