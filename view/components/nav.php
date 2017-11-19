<div class="ui large top fixed menu">
    <?php if(isset($_SESSION['username'])){
        require_once (__DIR__.'/nav_member.php');
    }
    else{
        require_once (__DIR__.'/nav_public.php');
    }
    ?>
</div>