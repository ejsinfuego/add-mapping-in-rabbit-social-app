<?php
require 'partials/header.php';

?>




    <!DOCTYPE html>
<html lang="en">
    <style type="text/css">
        html, body, div, input, span, a, select, textarea, option, h1, h2, h3, h4, main, aside, article, section, header, p, footer, nav, pre {
    box-sizing: border-box;
    font-family: Tahoma, Geneva, sans-serif;
}
html {
    background-color: #d3b68d;
}
input,textarea,p {
    outline: 0;
}
.gg{
    padding-top: 100px;
}

h1 {
    margin: 0;
    padding: 20px;
    font-size: 22px;
    text-align: center;
    border-bottom: 1px solid #665440;
    color: #000;
    font-weight: 600;
}
.contact {
    background-color: #c0b8ae;
    width: 500px;
    margin: 0 auto;
    box-shadow: 0px 0px 5px 0px rgba(0,0,0,.2);
    margin-bottom: 30px;
    border-radius: 10px 10px 10px 10px;
}
.contact .fields {
    position: relative;
    padding: 15px;
}
.contact input[type="text"], .contact input[type="email"] {
    display: block;
    margin-top: 15px;
    padding: 15px;
    border: 1px solid #665440;
    width: 100%;
    color: #000;
}
.contact input[type="text"]:focus, .contact input[type="email"]:focus {
    border: 1px solid blue;
}
.contact input[type="text"]::placeholder, 
.contact input[type="email"]::placeholder, 
.contact textarea::placeholder {
    color: #444;
}
.contact textarea {
    resize: none;
    margin-top: 15px;
    padding: 15px;
    border: 1px solid #665440;
    width: 100%;
    height: 150px;
    color: #000;
}
.contact textarea:focus {
    border: 1px solid blue;
}
.contact input[type="submit"] {
    display: block;
    margin-top: 15px;
    padding: 15px;
    border: 0;
    background-color: #876a44;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    width: 100%;
}
.contact input[type="submit"]:hover {
    background-color: #3670b3;
}
.contact input[name="email"] {
    position: relative;
    display: block;
}
.contact label {
    position: relative;

}
.contact label i {
    position: absolute;
    color: #dfe2e5;
    top: 31px;
    left: 15px;
    z-index: 10;
}
.contact label i ~ input {
    padding-left: 45px !important;
}
.contact .responses {
    padding: 15px;
    margin: 0;
}
.fas.fa-envelope,
.fas.fa-user{
    color: #000;
}
    </style>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Contact Form</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="style.css">
        
	</head>
	<body class="gg">
<?php
        if(!empty($_POST["send"])) {
        $userName = $_POST["name"];
        $userEmail = $_POST["email"];
        $userSubject = $_POST["subject"];
        $userMessage = $_POST["msg"];
        $toEmail = "rabbitwebook2234@gmail.com";
        
        $mailHeaders = "name: " . $userName .
        "\r\n email: ". $userEmail .
        "\r\n subject: ". $userSubject .
        "\r\n msg: " . $userMessage . "\r\n";
        
        if(mail($toEmail, $userName, $mailHeaders)) {
        $message = "Your contact information is received successfully.";
        }
    }
?>
		<form class="contact" method="post" action="">
			<h1>Contact Form</h1>
			<div class="fields">
				<label for="email">
					<i class="fas fa-envelope"></i>
					<input type="email" name="email" placeholder="Your Email" required id = "userEmail">
				</label>
				<label for="name">
					<i class="fas fa-user"></i>
					<input type="text" name="name" placeholder="Your Name" required id = "userName">
				<label>
				<input type="text" name="subject" placeholder="Subject" required id = "userSubject">
				<textarea name="msg" placeholder="Message" required id = "userMessage"></textarea>
			</div>
			<input type="submit" name="send" value="Submit">
		</form>
	</body>
</html>



    

<?php
require 'partials/footer.php';

?>
