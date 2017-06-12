<!--<footer class="short" id="footer">-->

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-3">
                    <h5>Maufutsal</h5>
                    <ul class="list list-icons list-icons-sm">
                        <li><i class="fa fa-caret-right"></i> <a href="./">Home</a></li>
                        <li><i class="fa fa-caret-right"></i> <a href="./about">Tentang Kami</a></li>
                        <li><i class="fa fa-caret-right"></i> <a href="./faq">FAQ's</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>Bantuan</h5>
                    <ul class="list list-icons list-icons-sm">
                            <!--<li><i class="fa fa-caret-right"></i> <a href="./terms">Syarat & Ketentuan</a></li>-->
                        <li><i class="fa fa-caret-right"></i> <a href="./privacy">Kebijakan Privasi</a></li>
                        <!--<li><i class="fa fa-caret-right"></i> <a href="#">Hubungin Kami</a></li>-->
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <ul class="social-icons">
                        <li class="social-icons-facebook"><a href="https://www.facebook.com/maufutsal" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li class="social-icons-twitter"><a href="https://www.twitter.com/maufutsalku" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li class="social-icons-instagram"><a href="https://www.instagram.com/maufutsal" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-sm">Contact Us</h5>
                    <ul class="contact">
                        <?php
                        $query       = "SELECT *FROM tbl_web_contact";
                        $result_data = $db->getAllValue($query);

                        foreach ($result_data as $data)
                        {
                            echo "<li><p><i class=\"fa fa-building-o\"></i>".$data['perusahaan']."</p></li>";
                            echo "<li><p><i class=\"fa fa-map-marker\"></i>".$data['alamat']."</p></li>";
                            echo "<li><p><i class=\"fa fa-phone\"></i>".$data['no_telp']."</p></li>";
                            echo "<li><p><i class=\"fa fa-envelope\"></i> <a href=\"#\">".$data['email']."</a></p></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="footer-copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <a href="#" class="logo">
                        <!-- <img alt="Porto Website Template" class="img-responsive" src="img/logo-footer.png"> -->
                    Maufutsal
                </a>
            </div>
            <div class="col-md-11">
                <p>© Copyright 2016. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>

<!--</footer>-->

