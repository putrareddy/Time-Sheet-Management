<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Latest compiled CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <title>Scheduled Tasks</title>
    <link rel="icon" href="https://www.freeiconspng.com/uploads/schedule-icon-8.png" type="image/x-icon">
    <link href='login.css' rel='stylesheet' />
	<script>
		$(document).ready(function(){
			$('#login').on('click',function(){
				console.log('text');
				var email = $('#email').val();
				var password = $('#password').val();
				if(!$('#email').val())
				{
					alert('Enter your username!');
				}
				else if(!$('#password').val())
				{
					alert("Enter Password");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax_calls.php",
						data:{
							'action':'login_form','email':email,'password':password
						},
						dataType: "json",
						success: function(response)
						{
							if(response=="admin")
							{
								window.location.href ="adminindex.php";
							}
							else if(response=="student")
							{
								window.location.href ="index.php";
							}
							else
							{
								alert(response);
							}
						}
					});
				}
			});
		});
	</script>
	

</head>

<body>

    <div class="wrapper">
        <div class="logo">
            <img src="https://www.freeiconspng.com/uploads/schedule-icon-8.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Scheduled Events
        </div>
        <form class="p-3 mt-3" action="" method="post">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn mt-3" id="login"> Login </button>
        </form>
    </div>
    
</body>

</html>