<?php
require_once("../private/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db->beginTransaction();

        // Data Pemohon
        $nama_pemohon = $_POST['nama_lengkap'];
        $nik_pemohon = $_POST['nik_pemohon'];
        $no_kk_pemohon = $_POST['no_kk_pemohon'];
        $alamat_rumah = $_POST['alamat_rumah'];

        // Simpan Data Pemohon
        $sql_pemohon = "INSERT INTO pemohon (nama_lengkap, nik, no_kk, alamat_rumah) 
                        VALUES (:nama_lengkap, :nik, :no_kk, :alamat_rumah)";
        $stmt_pemohon = $db->prepare($sql_pemohon);
        $stmt_pemohon->execute([
            ':nama_lengkap' => $nama_pemohon,
            ':nik' => $nik_pemohon,
            ':no_kk' => $no_kk_pemohon,
            ':alamat_rumah' => $alamat_rumah
        ]);

        // Ambil ID Pemohon yang baru disimpan
        $pemohon_id = $db->lastInsertId();

        // Simpan Data Anggota Keluarga yang ingin diubah
        $totalAnggota = count($_POST['nama']);
        for ($i = 0; $i < $totalAnggota; $i++) {
            $nama = $_POST['nama'][$i];
            $no_kk = $_POST['no_kk'][$i];
            $nik = $_POST['nik'][$i];
            $shdk = $_POST['shdk'][$i];
            $keterangan = $_POST['keterangan'][$i];

            // Simpan ke tabel penduduk
            $sql_penduduk = "INSERT INTO penduduk (nama, no_kk, nik, shdk, keterangan, input_id) 
                             VALUES (:nama, :no_kk, :nik, :shdk, :keterangan, :input_id)";
            $stmt_penduduk = $db->prepare($sql_penduduk);
            $stmt_penduduk->execute([
                ':nama' => $nama,
                ':no_kk' => $no_kk,
                ':nik' => $nik,
                ':shdk' => $shdk,
                ':keterangan' => $keterangan,
                ':input_id' => $pemohon_id
            ]);

            // Simpan perubahan data untuk setiap anggota
            if (!empty($_POST['jenis_permohonan'][$i])) {
                $jumlahPermohonan = count($_POST['jenis_permohonan'][$i]);
                for ($j = 0; $j < $jumlahPermohonan; $j++) {
                    $jenis_permohonan = $_POST['jenis_permohonan'][$i][$j];
                    $jenis_lainnya = $_POST['jenis_permohonan_lainnya'][$i][$j];
                    $semula = $_POST['semula'][$i][$j];
                    $menjadi = $_POST['menjadi'][$i][$j];
                    $dasar_perubahan = $_POST['dasar_perubahan'][$i][$j];

                    $sql_permohonan = "INSERT INTO permohonan_perubahan (nik, jenis_permohonan, jenis_lainnya, semula, menjadi, dasar_perubahan, input_id)
                                       VALUES (:nik, :jenis_permohonan, :jenis_lainnya, :semula, :menjadi, :dasar_perubahan, :input_id)";
                    $stmt_permohonan = $db->prepare($sql_permohonan);
                    $stmt_permohonan->execute([
                        ':nik' => $nik,
                        ':jenis_permohonan' => $jenis_permohonan,
                        ':jenis_lainnya' => $jenis_lainnya,
                        ':semula' => $semula,
                        ':menjadi' => $menjadi,
                        ':dasar_perubahan' => $dasar_perubahan,
                        ':input_id' => $pemohon_id
                    ]);
                }
            }
        }

        $db->commit();
        header("Location: status.php?status=sukses");
        exit();
    } catch (Exception $e) {
        $db->rollBack();
        die("Terjadi kesalahan: " . $e->getMessage());
    }
}
