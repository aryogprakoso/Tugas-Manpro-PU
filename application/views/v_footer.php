    <nav class="navbar navbar-static-bottom footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-3">
                    <div class="footer-title">
                        Pendeta Universitas <br>Universitas Kristen Duta Wacana 
                    </div>
                    <div class="footer-isi">
                        <p><br>Jl. Dr. Wahidin Sudirohusodo 5-25 <br> Yogyakarta (55224) Indonesia. <br> Telepon: 0274 563929, Ext.104</p>
                    </div>
                </div>
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