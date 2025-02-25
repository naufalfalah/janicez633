<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thank You</title>
	<!-- EXTERNAL CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!---------------------- 1ST CONTAINER ---------------------->
<div class="container-fluid p-0 bg">
    <div class="overlay">
    	<div class="container-fluid">
        	<div class="row">
            	<div class="col-lg-2 col-md-0 col-sm-2">
            		<div class="custom-top-image">
            			<img src="https://janicez557.sg-host.com/wp-content/uploads/2024/12/Vector_2__1_-removebg-preview.png">
            		</div>
            	</div>
            	<div class="col-lg-8 col-md-12 col-sm-8">
            		<div class="light-bg">
						<h1>Thank You</h1>
            			<p>
            				<?= $msg ?? '' ?>
            			</p>
            		</div>
            	</div>
            	<div class="col-lg-2 col-md-0 col-sm-2">
            		<div class="custom-bottom-image">
            			<img src="https://janicez557.sg-host.com/wp-content/uploads/2024/12/Vector_3-removebg-preview.png">
            		</div>
            	</div>
        	</div>
		</div>
    </div>
</div>
<!---------------------- 1ST CONTAINER END ---------------------->

</body>
<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>