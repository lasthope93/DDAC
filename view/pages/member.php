<?php
    //Access Control
    if(!isset($_SESSION['username'])){
        header('Location: error403');
        exit();
    }
?>
<?php
    //Get Bookings
    $db = DB::getInstance();
    $db->execute('SELECT seat, flight_id, departure_time, origin, destination FROM booking
        INNER JOIN flight
        ON booking.flight_id = flight.id
        WHERE passenger_id="'.$_SESSION['username'].'"');
?>
<script>
$( document ).ready(function() {
    $('.ui.dropdown').dropdown({
        'forceSelection':false
    });
    $('.ui.form').form();
});
</script>

<div class="ui vertical stripe segment">
    <div class="ui top aligned stackable grid container">
        <div class="row">
            <div class="ten wide column">
                <h1 class="ui header">Bookings</h1>
            </div>
        </div>
        <div class="row">
            <div class="eleven wide column">
                <h3>Upcoming flights</h3>
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>Flight ID</th>
                            <th>Seat Number</th>
                            <th>Departure Time</th>
                            <th>Origin</th>
                            <th>Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($db->count() == 0){
                                echo '<tr><td>You do not currently have any bookings</td></tr>';
                            }
                            else{
                                foreach($db->result() as $result){
                                    echo(
                                        '<tr><td>'.
                                        $result->flight_id.'</td><td>'.
                                        $result->seat.'</td><td>'.
                                        date("H:i, D, d M",strtotime($result->departure_time)).'</td><td>'.
                                        $result->origin.'</td><td>'.
                                        $result->destination.'</td></tr>'
                                    );
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="five wide column">
                <h3>Find flights</h3>
                <form class="ui form segment" action="/search">
                    <div class="field">
                        <select name="origin" class="ui search dropdown fluid">
                            <option value="">Origin</option>
                            <option value="AKL">Auckland (AKL)</option>
                            <option value="PEK">Beijing (PEK)</option>
                            <option value="KUL">Kuala Lumpur (KUL)</option>
                            <option value="HND">Tokyo - Haneda (HND)</option>
                            <option value="SIN">Singapore (SIN)</option>
                            <option value="SYD">Sydney (SYD)</option>
                        </select>
                    </div>
                    <div class="field">
                        <select name="destination" class="ui search dropdown fluid">
                            <option value="">Destination</option>
                            <option value="AKL">Auckland (AKL)</option>
                            <option value="PEK">Beijing (PEK)</option>
                            <option value="KUL">Kuala Lumpur (KUL)</option>
                            <option value="HND">Tokyo - Haneda (HND)</option>
                            <option value="SIN">Singapore (SIN)</option>
                            <option value="SYD">Sydney (SYD)</option>
                        </select>
                    </div>
                    <button type="submit" class="ui button fluid primary large">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>