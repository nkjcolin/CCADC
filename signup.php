<html>
<body>

	<h1>Your registration is successful.</h1>
	<h2>Your Information:</h2>
	<h3>
		Your Name: <?php echo $_POST["username"]; ?><br>
		Email: <?php echo $_POST["email"]; ?><br>
	</h3>
	<input type="button" onclick="window.location.href = 'index.html ';" value="Homepage" />

</body>
</html>