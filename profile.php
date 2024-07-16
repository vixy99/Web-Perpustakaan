<?php
include "header.php";
$query = mysqli_query($koneksi,"select * from penerbit");
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'perpustakaan';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, nama_lengkap FROM admin WHERE id_admin = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $nama_lengkap);
$stmt->fetch();
$stmt->close();
?>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card shadow-sm">
				<div class="card-header bg-primary text-white">
					<h3 class="mb-0">Profile Admin</h3>
				</div>
				<div class="card-body">
					<h2 class="text-center mb-4">Profile Page</h2>
					<p class="text-center">Your account details are below:</p>
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<tbody>
								<tr>
									<th>Username</th>
									<td><?=$_SESSION['name']?></td>
								</tr>
								<tr>
									<th>Password</th>
									<td><?=$password?></td>
								</tr>
								<tr>
									<th>Nama Lengkap</th>
									<td><?=$nama_lengkap?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="text-center mt-4">
						<a href="edit_profile.php" class="btn btn-outline-primary">
							<i class="fas fa-edit"></i> Edit Profile
						</a>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include "footer.html";
?>

<style>
.container {
    margin-top: 50px;
}

.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    font-size: 1.25rem;
    font-weight: bold;
}

.card-body {
    padding: 30px;
    background-color: #f9f9f9;
}

.table {
    margin: 0 auto;
    width: 100%;
    max-width: 600px;
    border-collapse: separate;
    border-spacing: 0;
    background-color: #fff;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
    border: none;
}

.table th {
    background-color: #007bff;
    color: white;
}

.table td {
    background-color: #f1f1f1;
}

.table-hover tbody tr:hover {
    background-color: #e9ecef;
}

.text-center {
    text-align: center;
}

.mt-4 {
    margin-top: 1.5rem;
}

.btn-outline-primary, .btn-outline-warning {
    margin: 5px;
}
</style>
