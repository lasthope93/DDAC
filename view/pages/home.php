<?php
    //Access Control
    if(isset($_SESSION['username'])){
        header('Location: member');
        exit();
    }
?>
<style>
    .ui.header{
        padding-top:1em;
    }
</style>


<div class="ui inverted vertical masthead center aligned segment hero">
    <div class="ui text container">
    <h1 class="ui inverted header">
        UI Airlines
    </h1>
    <h2>Taking you on a journey</h2>
        <a href="/signup" class="ui huge primary button">Start Flying</a>
    </div>
</div>


<div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
    <div class="row">
        <div class="eight wide column">
        <h3 class="ui header">Earn points as you fly!</h3>
        <p>
            For every miles you traveled, you will be credited with UI points! UI points can be traded for many surprising items including free flight tickets!
        </p> 
        </div>
        <div class="six wide right floated column">
        <h3 class="ui header">Exclusive destinations</h3>
        <p>
            Our airline offers unique destinations that cannot be found elsewhere, including some of the most secluded and restricted areas such as Bhutan, North Korea, Tetepare and Aldabra!
        </p>
        </div>
    </div>
    </div>
</div>



