    <nav class="navbar navbar-static-bottom footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-3">
                    <h4><a href="http://localhost/pendeta_universitass/index.php/c_kontak" class="footer-title">KONTAK</a></h4>
                    <div class="footer-isi">
                        <p>Pendeta Universitas <br> Universitas Kristen Duta Wacana <br> Jl. Dr. Wahidin Sudirohusodo 5-25 <br> Yogyakarta (55224) Indonesia. <br> Telepon: 0274 563929, Ext.104</p>
                    </div>
                </div>
                <!--
                <div class="col-xs-6 col-sm-4">
                    <h4><a href="http://localhost/pendeta_universitass/index.php/c_kontak"  class="footer-title">GOOGLE MAPS</a></h4>
                    <div id="map" class="img-thumbnail"></div>
                    <script>
                        var map;

                        function initialize(){
                            var mapOptions = {
                                zoom: 16,
                                center: {lat: -7.786050, lng: 110.378365},
                                mapTypeId: google.maps.MapTypeId.TERRAIN
                            };
                            map = new google.maps.Map(document.getElementById('map'),
                            mapOptions);

                            // Create a <script> tag and set the USGS URL as the source.
                            var script = document.createElement('script');

                            // (In this example we use a locally stored copy instead.)
                            // script.src = 'http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp';
                            script.src = 'earthquake_GeoJSONP.js';
                            document.getElementsByTagName('head')[0].appendChild(script);
                        }

                        function eqfeed_callback(results) {
                            map.data.addGeoJson(results);
                        }

                        // Call the initialize function after the page has finished loading
                        google.maps.event.addDomListener(window, 'load', initialize);
                    </script>
                </div>
                -->
            </div>
            <p class="text-right footer-cipta white">Hak Cipta © 2016 Pendeta Universitas Kristen Duta Wacana</p>
        </div>
    </nav>
</body>
</html>

<script>
$(document).ready(function () {
    $('.modal').on('show.bs.modal', function () {
        if ($(document).height() > $(window).height()) {
            // no-scroll
            $('body').addClass("modal-open-noscroll");
        }
        else {
            $('body').removeClass("modal-open-noscroll");
        }
    })
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    })
})
</script>