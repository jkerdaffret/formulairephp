<?php

    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo = "jkerdaffret@gmail.com";

    if ($_SERVER["REQUEST_Method"] == "POST") {
        $firstname = veriryInput($_POST["firstname"]);
        $name = veriryInput($_POST["name"]);
        $email = veriryInput($_POST["email"]);
        $phone = veriryInput($_POST["phone"]);
        $message = veriryInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";

        if(empty($firstname)){
            $firstnameError = "Je veux connaitre ton prénom !";
            $isSuccess = false;
        }
        else {
            $emailText .= "Firstname: $firstname\n";
        }
        if(empty($name)){
            $nameError = "Et oui je veux tout savoir, même ton nom !";
            $isSuccess = false;
        }
        else {
            $emailText .= "Firstname: $name\n";
        }
        if(empty($message)){
            $messageError = "Qu'est ce que tu veux me dire ?";
            $isSuccess = false;
        }
        else {
            $emailText .= "Firstname: $message\n";
        }
        if(!isEmail($email)){
            $emailError = "T'essaies de me rouler ? C'est pas un email ça !";
            $isSuccess = false;
        }
        else {
            $emailText .= "Firstname: $email\n";
        }
        if(!isPhone($phone)){
            $phoneError = "Que des chiffres et des espaces, stp...";
            $isSuccess = false;
        }
        else {
            $emailText .= "Firstname: $phone\n";
        }
        if($isSuccess){
            $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
            $firstname = $name = $email = $phone = $message = "";
        }
    }


    function isPhone($var){
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function veriryInput($var) {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-moi !</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2>Contactez-moi</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="contact-form" method="POST" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">Prénom<span class="blue"> *</span></label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                            <p class="comments"><?php echo $firstnameError; ?></p>
                        </div>
                        <div class="col-md-6">
                            <label for="name">Nom<span class="blue"> *</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>">
                            <p class="comments"><?php echo $nameError; ?></p>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email<span class="blue"> *</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>">
                            <p class="comments"><?php echo $emailError; ?></p>
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre téléphone" value="<?php echo $phone; ?>">
                            <p class="comments"><?php echo $phoneError; ?></p>
                        </div>
                        <div class="col-md-12">
                            <label for="message">Message<span class="blue">*</span></label>
                            <textarea name="message" id="message" cols="30" rows="4" ><?php echo $message; ?></textarea>
                            <p class="comments"><?php echo $messageError; ?></p>
                        </div>
                        <div class="col-md-12">
                            <p class="blue"><strong>* Ces informations sont requises</strong></p>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer">
                        </div>
                    </div>

                    <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé. Merci de m'avoir contacté.</p>
                </form>
            </div>
        </div>
    </div>



    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>