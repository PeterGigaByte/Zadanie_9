<?php

function verify_login(){
    global $db;
    $stmt = $db->prepare("SELECT id,name,password FROM admins WHERE name= ? AND password= ?  LIMIT 1");
    $name = $_POST['name'];
    $password = hash("sha512",$_POST['pass']);

    $stmt->bind_param('ss', $name,$password);
    $stmt->execute();

    $data = $stmt->get_result();


    if(!empty($data)){
        while ($row = $data->fetch_row()) {
            $_SESSION['id']  = $row[0];
            $_SESSION['name'] = $row[1];
            $_SESSION['session_id'] = session_id();
        }

        return true;
    }else{
        return false;
    }
}

//echo hash("sha512","student");

if(@$_POST['logIN']){
    if(verify_login()) {
        header('LOCATION: index.php');
    }else{
        $error = "Wrong name or password!! Pls try it again!!";
    }
}
?>
<?php
session_start();
include 'csrf.php';
$csrf = new csrf();
// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$form_names = $csrf->form_names(array('user', 'password'), false);

if(isset($_POST[$form_names['user']], $_POST[$form_names['password']])) {
    // Check if token id and token value are valid.
    if($csrf->check_valid('post')) {
        // Get the Form Variables.
        $user = $_POST[$form_names['user']];
        $password = $_POST[$form_names['password']];

        // Form Function Goes Here
    }
    // Regenerate a new random value for the form.
    $form_names = $csrf->form_names(array('user', 'password'), true);
}

?>
<?if(!isLogin()){?>
<div style="width:20%;">
    <?=@$error?>
    <form method="post" name="login">
        <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
        <label>Meno</label>
        <input name="name" value="" type="text" placeholder="LamaCoder" autofocus />
        <label>Heslo</label>
        <input name="pass" value="" type="password" placeholder="********" />
        <br />
        <button class="button" name="logIN" value="1">Prihlasiť</button>
    </form>
</div>
<?}else{?>
    <div style="width:20%;">
        <?=@$error?>
        <a href="./?page=logout.php"><button class="button">Odhlásiť sa</button></a>
    </div>
<?}?>
