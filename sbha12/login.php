<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <title>Login</title>
    <link rel="stylesheet" href="logsimk12.css">

</head>
<body>
 <header>
        <button class="home-btn">Home</button>
        <button class="account-btn">Your Account</button>
    </header>
    <div class="container">
   
    
		<div class="login-content">

        <form action="login_process.php" method="post">
        <h1>Login</h1>
            <?php if (isset($_GET['error'])): ?>
                <p class="error-message">These credentials do not match our registered data.</p>
            <?php endif; ?>

             	<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
               <h5>Email</h5>
            <input type="email" name="email"  class="input" id="email" required>
              </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
                  	<h5>Password</h5>
            <input type="password" name="password"  class="input" id="password" required>
              </div>
            	</div>
            <div class="remember-me">
    <input type="checkbox" name="remember" id="remember">
    <label for="remember" class="custom-checkbox"></label>
    <label for="remember">Remember me</label>
       </div>
            <input type="submit" class="btn" value="Login">
        </form>
        </div>
        <a href="register.php">I don't have an account</a>
    </div>


    
<script>
const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

document.querySelector('.home-btn').addEventListener('click', () => {
    window.location.href = 'home.php'; // Replace with the actual path of your home page
});

document.querySelector('.account-btn').addEventListener('click', () => {
    window.location.href = 'register.php'; // Replace with the actual path of your registration page
});
//Source :- https://github.com/sefyudem/Responsive-Login-Form/blob/master/img/avatar.svg
</script>

</body>
</html>








