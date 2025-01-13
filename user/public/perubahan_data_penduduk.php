<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Kantor Kecamatan Tanralili</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        function generateFields() {
            const num = document.getElementById('rincian_count').value;
            const dynamicContainer = document.getElementById('dynamic-form-container');
            dynamicContainer.innerHTML = ''; // Clear previous fields

            for (let i = 0; i < num; i++) {
                const newFieldSet = document.createElement('div');
                newFieldSet.classList.add('form-group');

                newFieldSet.innerHTML = `
                    <div>
                        <h5>Data Anggota Keluarga ${i + 1}</h5>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama[]" required>
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik[]" required>
                        </div>
                        <div class="form-group">
                            <label>SHDK</label>
                            <input type="text" class="form-control" name="shdk[]" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan[]" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Permohonan</label>
                            <select class="form-control" name="jenis_permohonan[]" required>
                                <option value="">-- Pilih --</option>
                                <option value="pendidikan">Pendidikan</option>
                                <option value="pekerjaan">Pekerjaan</option>
                                <option value="agama">Agama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semula</label>
                            <input type="text" class="form-control" name="semula[]" required>
                        </div>
                        <div class="form-group">
                            <label>Menjadi</label>
                            <input type="text" class="form-control" name="menjadi[]" required>
                        </div>
                        <div class="form-group">
                            <label>Dasar Perubahan</label>
                            <textarea class="form-control" name="dasar_perubahan[]" required></textarea>
                        </div>
                        <hr>
                    </div>`;
                dynamicContainer.appendChild(newFieldSet);
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h3>Form Surat Perubahan Elemen Data Kependudukan</h3>
        <form action="process.php" method="post">
            <div class="form-group">
                <label for="rincian_count">Jumlah Anggota Keluarga</label>
                <input type="number" id="rincian_count" class="form-control" value="1" min="1" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="generateFields()">Generate</button>

            <div id="dynamic-form-container"></div>

            <div class="form-group">
                <label for="pdfFile">Unggah TTD Digital</label>
                <input type="file" class="form-control" id="pdfFile" name="pdfFile" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>

</html>