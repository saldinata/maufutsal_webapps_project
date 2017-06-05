<style type="text/css">
    h5:hover
    {
        transition: 0.3s ease-in-out;
        color: #FFA000;
    }
    a:hover
    {
        text-decoration: none;
    }
    .featured-box 
    {
        background: #FFF;
    }
    .featured-box-tertiary-second h4
    {
        color:#FFB300;
    }
    .featured-box-tertiary-second .box-content
    {
        border-top-color:#FFB300;	
    }
    .featured-box-tertiary-second .icon-featured
    {
        background-color:#FFB300;
    }

    .featured-box-effect-2.featured-box-tertiary-second .icon-featured:after 
    {
        box-shadow: 0 0 0 3px #FFB300;
    }
    .featured-box-quaternary-second h4
    {
        color:#43A047;
    }					
    .featured-box-quaternary-second .box-content
    {
        border-top-color:#43A047;	
    }
    .featured-box-quaternary-second .icon-featured
    {
        background-color:#43A047;
    }
    .featured-box-effect-2.featured-box-quaternary-second .icon-featured:after {
        box-shadow: 0 0 0 3px #43A047;
    }

</style>

<!DOCTYPE html>
<html>
    <body>
        <section class="section m-none">
            <div class="container">
                <div class="row mt-xl">
                    <div class="counters counters-text-dark">
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <img src="icon/promo_outline.png" width=80 height=80>
                                <!-- <i class="fa fa-user"></i> -->
                                <!-- <strong data-to="0" data-append="">0</strong> -->
                                <br>
                                <h4>Promo-Promo Seru</h4>
                                <a href="promotion">
                                    <button class="btn btn-md btn-primary">Lihat Promo</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <img src="icon/reservation_outline.png" width=80 height=80>
                                <!-- <i class="fa fa-desktop"></i> -->
                                <!-- <strong data-to="0">0</strong> -->
                                <br>
                                <h4>Reservation Lapangan Futsal</h4>
                                <a href="reservation">
                                    <button class="btn btn-md btn-primary">Mulai Reservation</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <img src="icon/slamevent_outline.png" width=80 height=80>
                                <!-- <i class="fa fa-ticket"></i> -->
                                <!-- <strong data-to="0" data-append="">0</strong> -->
                                <br>
                                <h4>Ajang Tanding</h4>
                                <a href="slamevent">
                                    <button class="btn btn-md btn-primary">Ikuti Ajang Tanding</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter">
                                <img src="icon/comp_outline.png" width=80 height=80>
                                <!-- <i class="fa fa-clock-o"></i> -->
                                <!-- <strong data-to="0" data-append="">0</strong> -->
                                <br>
                                <h4>Kompetisi Maufutsal</h4>
                                <a href="competition">
                                    <button class="btn btn-md btn-primary">Ikuti Kompetisi</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="container" style="margin-top:7%;">

            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="mt-xl mb-none">Download versi <strong>Android</strong></h2>
                    <p class="lead mb-xl">Download versi android untuk dapat selalu terhubung bersama Maufutsal.com</p>
                    <hr class="invisible">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="feature-box feature-box-style-6 reverse mb-none mt-xl" style="padding-top:22%;padding-right:8%;">
                        <?php
                        $state       = 'A';
                        $query       = "SELECT * FROM tbl_web_apk WHERE state=?";
                        $result_link = $db->getValue($query,[$state]);
                        
                        $url    = "/mobile/".$result_link['file_name'];
                        ?>
                        
                        <a href="<?php echo $url; ?>">
                            <button class="btn btn-md btn-primary" style="padding: 5%;font-size: 20px;">
                                <i class="fa fa-download"></i> &nbsp;&nbsp;&nbsp;
                                Download versi Android
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img alt="Responsive" class="hidden-xs img-responsive" src="img/responsive-ready.png" style="margin-bottom: -1px;">
                </div>
            </div>
        </div>



        <div class="modal fade" id="smallDialog" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h1 class="modal-title" id="a"><i class="icon-user-follow icons"></i> Daftar Yuk</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span><strong>2000 Point</strong></span> 
                                <span>Maufutsal.com untuk member baru. GRATIS. </span><br>
                                <span>Dengan bergabung di Maufutsal.com, dapatkan potongan harga dan info menarik lainnya. </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- <script type="text/javascript" src="js/maufutsal_script/script_show_adv.js"></script> -->