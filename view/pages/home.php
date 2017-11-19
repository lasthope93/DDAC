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
        <h3 class="ui header">Cutting Edge Aircraft</h3>
        <p>
            Our airline boasts a fleet of the most modern aircraft with the latest in aerospace advancements.
            Soaring to ever further distances, we commit to operating on the greatest fuel efficiency available.
        </p>
        <h3 class="ui header">In-flight Services</h3>
        <p>
            We pride ourselves in providing the services <i>you</i> need during the flight. 
            Offering you essential and up to date technologies such as USB charging ports and in-flight WiFi.
            Our flight attendants are among the best in the world and will help with anything you need during your flight.
        </p>
        </div>
        <div class="six wide right floated column">
        <img src="/img/plane.jpg" class="ui large bordered rounded image"/>
        </div>
    </div>
    </div>
</div>


<div class="ui vertical stripe quote segment">
    <div class="ui equal width stackable internally celled grid">
    <div class="center aligned row">
        <div class="column">
        <h3>"Best in-flight service I've had"</h3>
        <p>
            <b>Elon Musk</b> - SpaceX
        </p>
        </div>
        <div class="column">
        <h3>"Top notch customer support!"</h3>
        <p>
            <b>Lunafreya Nox </b> - Tenebrae Inc.
        </p>
        </div>
    </div>
    </div>
</div>