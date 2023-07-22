<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<header>
        <button class="home-btn">Home</button>
        <button class="account-btn">Your Account</button>
    </header>
    <h1>Register</h1>
<div class="container">
   
    <div class="register_process">

        <form action="register_process.php" method="post">
            <?php if (isset($_GET['error']) && $_GET['error'] == 'email_already_registered'): ?>
                <p class="error-message">This email is already registered.</p>
            <?php endif; ?>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                   <h5>Name</h5>
                   <input type="text" name="name" class="input" id="name" required>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i"> 
                    <i class="fas fa-at"></i>
                </div>
                <div class="div">
                    <h5>Email</h5>
                    <input type="email" name="email" class="input" id="email" required>
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
            <input type="submit" class="btn" value="Register">
        </form>
    </div>
    <a href="login.php">I already have an account</a>
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
    window.location.href = 'index.php'; // Replace with the actual path of your home page
});

document.querySelector('.account-btn').addEventListener('click', () => {
    window.location.href = 'register.php'; // Replace with the actual path of your registration page
});
//Source :- https://github.com/sefyudem/Responsive-Login-Form/blob/master/img/avatar.svg
</script>


</body>
</html>