<?php
if ($_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
    // Move the file and insert into the database
} else {
    echo 'File upload error: ' . $_FILES['pdfFile']['error'];
}
