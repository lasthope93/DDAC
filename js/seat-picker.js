anychart.onDocumentReady(function() {
stage = acgraph.create('container');
$.ajax({
    type: 'GET',
        url: '/img/boeing_737.svg',
        success: function(svgData) {
            var data = boeingData();

            //Remove existing seats
            booked.forEach(function(item) {
                var index = data.findIndex(p => p.id == item['seat'])
                data.splice(index,1);
            });

            chart = anychart.seatMap(data);
            chart.geoData(svgData);
            chart.padding([105, 0, 20, 0]).unboundRegions('as-is');

            series = chart.getSeries(0);
            series.fill(function() {
                var attrs = this.attributes;
                return attrs ? attrs.fill : this.sourceColor;
            })
            .stroke(function() {
                var attrs = this.attributes;
                return attrs ? attrs.stroke : this.sourceColor;
            });

            series.hoverFill('#64b5f6');
            series.selectFill('#64b5f6');
            series.tooltip().titleFormat('Seat');
            series.tooltip().format('{%Id}');

            // Get seat on click
            chart.listen('click', function() {
            var points = chart.getSelectedPoints();
                if (points.length == 1) {
                    $('#seat').val(data[points[0].getIndex()]['id']);
                }
            });

            // Change Interactivity
            var interactivity = chart.interactivity();
            interactivity.keyboardZoomAndMove(false);
            interactivity.zoomOnDoubleClick(false);
            interactivity.drag(false);
            interactivity.selectionMode("singleSelect");

            //Draw Chart
            chart.container(stage);
            chart.draw();
        }
    });
});