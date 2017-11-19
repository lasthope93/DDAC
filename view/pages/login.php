<?php
    //Access Control
    if(isset($_SESSION['username'])){
        header('Location: member');
        exit();
    }
?>
<?php
    //Validate login
    $username = Param::get('username');
    $password = Param::get('password');

    if($username != '' & $password !=''){
        //Check DB
        $db = DB::getInstance();
        $pwhash=hash('sha256', $password);
        $db->execute('SELECT * FROM user WHERE username="'.$username.'" AND pw_hash="'.$pwhash.'"');
        if($db->count()==1){
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $db->first()->full_name;
            header('Location: member');
            exit();
        }
        else{
            $error = true;
        }
    }
?>

<script>
    window.onload = function () {
        $('.ui.form').form({
            fields: {
                username: {
                    identifier: 'username',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter a username'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter a password'
                        }
                    ]
                }
            }
        });
    }
</script>

<div class="ui middle center aligned stackable grid">
    <div class="column five wide">
        <h2 class="ui primary image header">
            <img src="/img/logo.png" class="image"/>
            <div class="content">
                Log-in to your account
            </div>
        </h2>
        <form class="ui form segment">
            <div class="field">
                <div class="ui left input">
                    <input type="text" name="username" placeholder="Username" />
                </div>
            </div>
            <div class="field">
                <div class="ui left input">
                    <input type="password" name="password" placeholder="Password"/>
                </div>
            </div>
            <button type="submit" class="ui fluid large primary submit button">Log In</button>
            <div class="ui message error" <?php if($error == true) echo 'style="display:block"'; ?>>
                <?php
                    if($error == true){
                        echo "<li>Invalid username or password</li>";
                        $error=false;
                    }
                ?>
            </div>
        </form>
        <div class="ui message">
            New to us? <a href="/signup">Sign Up</a>
        </div>
    </div>
</div>