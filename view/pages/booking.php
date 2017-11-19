<?php
    //Access Control
    if(!isset($_SESSION['username'])){
        header('Location: error403');
        exit();
    }
?>
<?php
    $flight = Param::get('flight');
    $seat = Param::get('seat');
    $db = DB::getInstance();

    //Check flight exists
    $db->select('flight',array(
        'id',
        '=',
        $flight
    ));
    if($db->count() == 0){
        header('Location: member');
        exit();
    }
    elseif($seat == ''){
        //Get flight info
        $result = $db->first();
        $departure = date("H:i, D, d M",strtotime($result->departure_time));
        $origin = $result->origin;
        $destination = $result->destination;
        $price = $result->price;

        //Get occupied seats
        $db->execute('SELECT seat FROM booking 
        WHERE flight_id="'.$flight.'"');
        $occ_seats = $db->result();
        echo '<script>var booked = '.json_encode($occ_seats).'</script>';
    }
    else{
        $result = $db->first();
        $departure = date("H:i, D, d M",strtotime($result->departure_time));
        $origin = $result->origin;
        $destination = $result->destination;
        $price = $result->price;
		
        //Add booking
        $db->insert('booking', array(
            'flight_id' => $flight,
            'passenger_id' => $_SESSION['username'],
            'seat' => $seat,
			'departure_time' => $departure,
			'origin' => $origin,
			'destination' => $destination,
			'price' => $price
        ));
        header('Location: member');
        exit();
    }
?>
<script>
$( document ).ready(function() {
    $('.ui.sticky')
      .sticky({
        context: '#seats',
        offset: 70
      })
    ;
    $('.ui.form').form({
        fields:{
            seat:'empty'
        }
    });
});
</script>
<script src="/js/anychart.min.js"></script>
<script src="/js/seat-data.js"></script>
<script src="/js/seat-picker.js"></script>

<style>
    #container {
        width: 100%;
        display: inline-block;
        position: relative;
    }
    #container:after {
        /* Maintaining aspect ratio */
        padding-top: 206.26%;
        display: block;
        content: '';
    }
    #container > div {
        position:absolute !important;
    }
</style>

<div class="ui vertical stripe segment">
    <div class="ui top aligned stackable grid container">
        <div class="row">
            <div class="ten wide column">
                <h1 class="ui header">New Booking - Flight <?php echo $flight ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="eleven wide column" id="seats">
                <h3>Choose a seat</h3>
                <div id="container"></div>
            </div>
            <div class="five wide column">
                <div class="ui sticky">
                    <h3>Confirm booking</h3>
                    <form class="ui form segment">
                        <div class="field">
                            <label>Flight No</label>
                            <input type="text" readonly name="flight" class="ui input fluid" value="<?php echo $flight; ?>"/>
                        </div>
                        <div class="field">
                            <label>Origin</label>
                            <input type="text" readonly class="ui input fluid" value="<?php echo $origin; ?>"/>
                        </div>
                        <div class="field">
                            <label>Destination</label>
                            <input type="text" readonly class="ui input fluid" value="<?php echo $destination; ?>"/>
                        </div>
                        <div class="field">
                            <label>Departure Time</label>
                            <input type="text" readonly class="ui input fluid" value="<?php echo $departure; ?>"/>
                        </div>
                        <div class="field">
                            <label>Price</label>
                            <input type="text" readonly class="ui input fluid" value="RM <?php echo $price; ?>"/>
                        </div>
                        <div class="field">
                            <label>Seat</label>
                            <input type="text" readonly id="seat" name="seat" class="ui input fluid" value=""/>
                        </div>
                        <button type="submit" class="ui button fluid primary large">Place Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
