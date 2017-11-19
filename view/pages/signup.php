<?php
    //Access Control
    if(isset($_SESSION['username'])){
        header('Location: member');
        exit();
    }
?>
<?php
    //Validate signup
    $username = Param::get('username');
    $fullname = Param::get('fullname');
    $password = Param::get('password');

    if($username != '' & $fullname != '' & $password !=''){
        //Check DB for existing user
        $db = DB::getInstance();
        $db->select('user', array('username','=', $username));
        if($db->count() == 0){
            //Add new account to DB
            $db->insert('user', array(
                'username' => $username,
                'full_name' => $fullname,
                'pw_hash' => hash('sha256', $password)
            ));
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $fullname;
            header('Location: member');
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
                name: {
                    identifier: 'fullname',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your full name'
                        }
                    ]
                },
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
                        },
                        {
                            type: 'minLength[6]',
                            prompt: 'Your password must be at least {ruleValue} characters'
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
                Create New Account
            </div>
        </h2>
        <form class="ui form segment">
            <div class="field">
                <div class="ui left input">
                    <input type="text" name="fullname" placeholder="Full Name" />
                </div>
            </div>
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
            <button type="submit" class="ui fluid large primary submit button">Sign Up</button>
            <div class="ui message error" <?php if($error == true) echo 'style="display:block"'; ?>>
                <?php
                    if($error == true){
                        echo "<li>Sorry, the username has already been taken</li>";
                        $error=false;
                    }
                ?>
            </div>
        </form>
        <div class="ui message">
            Already an existing user? <a href="/login">Log In</a>
        </div>
    </div>
</div>