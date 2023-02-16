<div class="footer">
    <div class="container">
        <div class="w3_footer_grids">
            <div class="col-md-2 w3_footer_grid">
                <h3>FOLLOW US</h3>
                <ul class="info">
                    <li>
                        @if ($_settings->facebook)
                        <a href="{{ $_settings->facebook }}" target="_blank" class="social-icon fb">
                            <i class="fa fa-facebook"></i> Facebook
                        </a>
                        @endif
                    </li>
                    <li>
                        @if ($_settings->twitter)
                        <a href="{{ $_settings->twitter }}" target="_blank" class="social-icon twitter">
                            <i class="fa fa-twitter"></i> Twitter
                        </a>
                        @endif
                    </li>
                    <li>
                        @if ($_settings->youtube)
                        <a href="{{ $_settings->youtube }}" target="_blank" class="social-icon youtube">
                            <i class="fa fa-youtube-play"></i> Youtube
                        </a>
                        @endif
                    </li>
                    <li>
                        @if ($_settings->vimeo)
                        <a href="{{ $_settings->vimeo }}" target="_blank" class="social-icon vimeo">
                            <i class="fa fa-vimeo"></i> Vimeo
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-md-3 w3_footer_grid">
                <h3>Contact</h3>

                <ul class="address">
                    <li class="d-flex">
                        <p><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i></p> 
                        <span class="ml-0">{{ optional($_settings)->address }}</span>
                    </li>
                    <li class="d-flex">
                        <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
                        <a href="mailto:{{ optional($_settings)->email_1 }}">{{ optional($_settings)->email_1 }}</a>
                    </li>
                    <li class="d-flex">
                        <p><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i></p> 
                        <div>
                            <div>
                                <a href="tel:{{ optional($_settings)->phone_1 }}">
                                    {{ optional($_settings)->phone_1 }}
                                </a>
                            </div>
                            <div>
                                <a href="tel:{{ optional($_settings)->phone_2 }}">
                                    {{ optional($_settings)->phone_2 }}
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 w3_footer_grid">
                <h3>Information</h3>
                <ul class="info">
                    <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="{{ route('about.us') }}">About Us</a></li>
                    <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="{{ route('contact.us') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.347557401516!2d90.36727251445694!3d23.80623699255902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c12c75554429%3A0x673e570e4bfdb4a0!2zRmFudGFzeSBHYW1laG91c2UgJiBGaXRuZXNzIOCmq-CnjeCmr-CmvuCmqOCnjeCmn-CmvuCmuOCmvyDgppbgp4fgprLgpr7gppjgprAg4KaP4Kao4KeN4KahIOCmq-Cmv-Cmn-CmqOCnh-CmuA!5e0!3m2!1sbn!2sbd!4v1581313239942!5m2!1sbn!2sbd" style="width:100%;min-height:225px"></iframe>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="footer-botm">
    <div class="footer-copy">
        <div class="container">
            <p>© {{ date('Y') }} {{ optional($_settings)->shop_name }}. All rights reserved | Developed by <a href="http://w3layouts.com/">Link-Up Technology</a></p>
        </div>
    </div>
</div>
