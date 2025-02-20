function hanyaAngka(evt) {
  let charCode = evt.which ? evt.which : event.keyCode;
  if (charCode < 48 || charCode > 57) {
    return false; // Hanya angka (0-9) yang diperbolehkan
  }
  return true;
}

function validateNIK(inputId, errorId) {
  let nikInput = document.getElementById(inputId);
  let nikError = document.getElementById(errorId);
  let nikValue = nikInput.value;

  // Cek apakah input kosong
  if (nikValue.length === 0) {
    nikError.textContent = "";
    nikInput.classList.remove("is-invalid");
    return;
  }

  // Cek apakah input hanya berisi angka
  if (!/^\d*$/.test(nikValue)) {
    nikError.textContent = "NIK hanya boleh berisi angka!";
    nikInput.classList.add("is-invalid");
  }
  // Cek panjang NIK harus 16 digit
  else if (nikValue.length !== 16) {
    nikError.textContent = "NIK harus terdiri dari 16 digit angka.";
    nikInput.classList.add("is-invalid");
  }
  // Jika valid
  else {
    nikError.textContent = "";
    nikInput.classList.remove("is-invalid");
  }
}

function validatenikayah() {
  validateNIK("nik_ayah", "nikAyahError");
}

function validatenikibu() {
  validateNIK("nik_ibu", "nikIbuError");
}

function validatenik() {
  validateNIK("nik", "nikError");
}

function validateSaksi() {
  validateNIK("nik_saksi_1", "nikErorSaksi");
}

function validatenikalm() {
  validateNIK("nik_alm", "nikAlmEror");
}

function validatepemohon() {
  validateNIK("nik_pemohon", "nikPemohonEror");
}

function validateNDP() {
  let ndpInput = document.getElementById("ndp");
  let ndpError = document.getElementById("ndpError");

  if (ndpInput.value.length > 0 && !/^\d{16}$/.test(ndpInput.value)) {
    ndpError.textContent = "Nomor Dokumen Perjalanan.";
    ndpInput.classList.add("is-invalid");
  } else {
    ndpError.textContent = "";
    ndpInput.classList.remove("is-invalid");
  }
}

function validatePhone(inputId, errorId) {
  let phoneInput = document.getElementById(inputId);
  let phoneError = document.getElementById(errorId);
  let phoneValue = phoneInput.value;

  // Cek apakah input kosong
  if (phoneValue.length === 0) {
    phoneError.textContent = "";
    phoneInput.classList.remove("is-invalid");
    return;
  }

  // Cek apakah input hanya berisi angka
  if (!/^\d*$/.test(phoneValue)) {
    phoneError.textContent = "Nomor telepon hanya boleh berisi angka!";
    phoneInput.classList.add("is-invalid");
  }
  // Cek panjang nomor telepon (misalnya minimal 10 dan maksimal 13 digit)
  else if (phoneValue.length < 10 || phoneValue.length > 13) {
    phoneError.textContent =
      "Nomor telepon harus terdiri dari 10 hingga 13 digit angka.";
    phoneInput.classList.add("is-invalid");
  }
  // Jika valid
  else {
    phoneError.textContent = "";
    phoneInput.classList.remove("is-invalid");
  }
}

function validateNoHP() {
  validatePhone("telpon", "NoHpError");
}

function validateNohpSuratPindah() {
  validatePhone("telpon", "NoHpErrorpindah");
}
