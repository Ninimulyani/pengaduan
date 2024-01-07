<!-- <?php 
$conn = mysqli_connect("localhost", "root", "", "kp");




function tambah($data){
	global $conn;

	$komentar = htmlspecialchars($data["komentar"]);
	

	$query = "INSERT INTO tb_komentar VALUES
				('', '$komentar');
				";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
?> -->