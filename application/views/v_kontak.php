<?php 
$this->load->view('v_header', array('nav_kontak'=>"active"));
?>

<!--script
src="http://maps.googleapis.com/maps/api/js">
</script-->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpkPhlTVeGOb7lAVUnG2a_K_bQP_Wp3qA&callback=initMap"></script>

<div class="container height-content wrap-content">
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <div id="kontak">
                <span class="text-left"><h4 class="font-bold">KONTAK</h4></span>
                <hr class="line">
                <div class="font-bold">Pendeta Universitas</div>
                <div class="font-bold">Universitas Kristen Duta Wacana</div>
                <br>
                <div class="row">
                    <div class="col-xs-2">
                        <span class="glyphicon glyphicon-home icon-glyphicon"></span>
                    </div>
                    <div class="col-xs-10 font-size-12px">
                        Jl. Dr. Wahidin Sudirohusodo 5-25, Yogyakarta (55224) Indonesia
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-2">
                        <span class="glyphicon glyphicon-phone-alt icon-glyphicon"></span>
                    </div>
                    <div class="col-xs-10 font-size-12px">
                        0274 563929<br>Ext.104
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-2">
                        <span class="glyphicon glyphicon-envelope icon-glyphicon"></span>
                    </div>
                    <div class="col-xs-10 font-size-12px">
                        galih@staff.ukdw.ac.id
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-xs-12 col-sm-6">
            <div id="google-maps">
                <span class="text-left"><h4 class="font-bold">GOOGLE MAPS</h4></span>
                <hr class="line">
                <div id="map" class="img-thumbnail"></div>
                <script>
                    var myCenter=new google.maps.LatLng(-7.786050,-110.378365);
                    var marker;
                    function initMap(){
                        var mapProp = {
                            center:myCenter,
                            zoom:5,
                            mapTypeId:google.maps.MapTypeId.ROADMAP
                        };

                        var map=new google.maps.Map(document.getElementById("map"),mapProp);

                        var marker=new google.maps.Marker({
                            position:myCenter,
                            animation:google.maps.Animation.BOUNCE
                        });

                        marker.setMap(map);
                    }

                    google.maps.event.addDomListener(window, 'load', initMap);
                </script>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 margin-top-2em">
            <div id="jamoperasional">
                <span class="text-left"><h4 class="font-bold">JAM OPERASIONAL</h4></span>
                <hr class="line">
                <div class="row">
                    <div class="col-xs-2">
                        <span class="glyphicon glyphicon-calendar icon-glyphicon"></span>
                    </div>
                    <div class="col-xs-10 font-size-12px">
                        Senin - Jumat
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-2">
                        <span class="glyphicon glyphicon-time icon-glyphicon"></span>
                    </div>
                    <div class="col-xs-10 font-size-12px">
                        08.30 - 15.00
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->load->view('v_footer');
?>