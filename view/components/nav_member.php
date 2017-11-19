<div class="ui container">
    <a href="/member" class="item">Home</a>
    <a href="/search" class="item">Search</a>
    <div class="right menu">
        <div class="item">
            <h4><?php echo $_SESSION['fullname']?></h4>
        </div>
        <div class="item">
            <a href="/logout" class="ui button">Log Out</a>
        </div>
    </div>
</div>