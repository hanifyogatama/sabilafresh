<?php

use Symfony\Component\VarDumper\Cloner\Data;
?>
<!-- footer area start -->
<footer class="footer-area">
    <div class="footer-top-area pt-60 pb-35 wrapper-padding-5 border-top">
        <div class="container-fluid">
            <div class="widget-wrapper">

                <div class="footer-widget mb-20">
                    <div class="footer-about-2">
                        <h6 style="font-weight: 600;">Sabilafresh</h6>
                        <div class="sidebar">
                            <ul>
                                <li><a class="list-category" href="https://www.sabilafarm.com/" target="_blank">UD. Sabila Farm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-widget mb-20">
                    <div class="footer-about-2">
                        <h6 style="font-weight: 600;">Layanan</h6>
                        <div class="sidebar">
                            <ul>
                                <li><a class="list-category" href="https://www.sabilafarm.com/produk-kami/produksi-buah" target="_blank">Produksi Buah</a></li>
                                <li><a class="list-category" href="https://www.sabilafarm.com/produk-kami/wisata-kebun" target="_blank">Kebun Edukasi</a></li>
                                <li><a class="list-category" href="https://www.sabilafarm.com/produk-kami/wisata-kebun" target="_blank">Wisata Kebun</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-about-2 mt-4">
                        <h6 style="font-weight: 600;">Kualitas</h6>
                        <div class="row">
                            <img class="ml-3" src="{{ asset('themes/sabilafresh/assets/img/front/organic.svg') }}" alt="" width="60px">
                        </div>
                    </div>
                </div>
                <div class="footer-widget mb-20">
                    <div class="footer-about-2">
                        <h6 style="font-weight: 600;">Bantuan</h6>
                        <div class="sidebar">
                            <ul>
                                <li><a class="list-category" href="{{ url('/') }}">Kontak</a></li>
                                <li><a class="list-category" href="{{ url('/') }}">Syarat dan Ketentuan</a></li>
                                <li><a class="list-category" href="{{ url('/') }}">Kebijakan Privasi</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-about-2 mt-4">
                        <h6 style="font-weight: 600;">Ikuti Kami</h6>
                        <div class="product-share">
                            <ul>
                                <li>
                                    <a href="https://web.facebook.com/SabilaFarm/?_rdc=1&_rdr" target="_blank" class="facebook">
                                        <i class="icofont icofont-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/sabilafarm?lang=id" target="_blank" class="twitter">
                                        <i class="icofont icofont-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/sabilafarm/?hl=id" target="_blank" class="instagram">
                                        <i class="icofont icofont-social-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/watch?v=ARxtOC_3w9A" target="_blank">
                                        <i class="icofont icofont-social-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-widget mb-40">
                    <div class="row ml-5">
                        <img class="mx-auto " src="{{ asset('themes/sabilafresh/assets/img/front/login.svg') }}" alt="" width="310px">
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center mt-3 ml-5 ">
                            <div class="copyright-furniture">
                                <p>© 2021-<?= Date('Y'); ?>, Sabilafresh.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>