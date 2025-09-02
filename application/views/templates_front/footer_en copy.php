
                </div>
            </div>
            <!-- End Page-content -->

            <?php
            $show=0;
            if ($show==1)
            {
                ?>
            <!-- Footer Start -->
            <footer class="landing-footer py-4">
                <div class="container-fluid">
                    <div class="text-center">
                        <h5 class="mb-3 footer-list-title">Pusdahamnas Contact</h5>
                        <p><i class="bx bx-map mr-1"></i> Hayam Wuruk Tower 17th floor.
Jl. Hayam Wuruk No.108, RT.4/RW.9, Maphar, Taman Sari District, City of West Jakarta, Special Capital Region of Jakarta 11160</p>
                        <p><i class="bx bx-envelope mr-1"></i> pusdahamnas@komnasham.go.id</p>

                        <div class="d-flex mt-4 team-social-links justify-content-center">
                                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Facebook">
                                    <i class="bx bxl-facebook-circle font-size-14"></i>
                                </a>
                                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Instagram">
                                    <i class="bx bxl-instagram font-size-14"></i>
                                </a>
                                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Twitter">
                                    <i class="bx bxl-twitter font-size-14"></i>
                                </a>
                                <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Youtube">
                                    <i class="bx bxl-youtube font-size-14"></i>
                                </a>
                        </div>
                    </div>

                    <hr class="footer-border my-4">

                    <p class="text-center mb-0">Copyrights Komnasham Republik Indonesia © <script>document.write(new Date().getFullYear())</script></p>
                </div>
            </footer>
            <!-- Footer End -->
            <?php
            }
            ?>
            <footer class="landing-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-sm-6">
                            <div class="mb-4 mb-lg-0">
                                <div class="text-left">
                                                    <h5 class="mb-3 footer-list-title">Pusdahamnas Contact</h5>
                                                    <p><i class="bx bx-map mr-1"></i> Hayam Wuruk Tower 17th floor.
                            Jl. Hayam Wuruk No.108, RT.4/RW.9, Maphar, Taman Sari District, City of West Jakarta, Special Capital Region of Jakarta 11160</p>
                                                    <p><i class="bx bx-envelope mr-1"></i> pusdahamnas@komnasham.go.id</p>

                                                    <div class="d-flex mt-4 team-social-links justify-content-left">
                                                            <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Facebook">
                                                                <i class="bx bxl-facebook-circle font-size-14"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Instagram">
                                                                <i class="bx bxl-instagram font-size-14"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Twitter">
                                                                <i class="bx bxl-twitter font-size-14"></i>
                                                            </a>
                                                            <a class="btn btn-sm btn-light" href="#" data-toggle="tooltip" data-original-title="Youtube">
                                                                <i class="bx bxl-youtube font-size-14"></i>
                                                            </a>
                                                    </div>
                                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 ml-auto">
                            <div class="mb-4 mb-lg-0">
                                <h5 class="mb-3 footer-list-title">Related Page</h5>
                                <ul class="list-unstyled footer-list-menu">
                                    <li><a href="https://www.komnasham.go.id/" target="_blank">Komnas HAM</a></li>
                                    <?php
                                    foreach ($this->db->where('is_active','1')->get('link_terkait')->result_array() as $lk)
                                    {
                                        echo'<li><a href="'.$lk['link'].'" target="_blank">'.$lk['judul'].'</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <hr class="footer-border my-5">

                    <p class="text-center mb-0">Copyright © <script>document.write(new Date().getFullYear())</script> - National Commission on Human Rights of the Republic of Indonesia</p>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/node-waves/waves.min.js"></script>

    <script src="https://ministry.phicos.co.id/front/pusdahamnas/assets/libs/social-sharing/socialSharing.js"></script>
    <script src="<?= base_url() ?>assets_front/js/app.js"></script>


    <?= isset($_js) ? $_js : ''; ?>

    <script>
        'use strict';

        $.fn.socialSharingPlugin = function(options){
            let settings = $.extend({
                urlShare: '',
                btnTarget: '_blank',
                btnTitle: 'Bagikan ke',
                title: '',
                description: '',
                via:'',
                hashtags: '',
                img: '',
                isVideo: 'false',
                buttonClass: 'btn btn-sm btn-primary',
                applyDefaultButtonStyle: true
            }, options);

            let urls = {
                Whatsapp:{
                    icon: 'bx bxl-whatsapp font-size-14',
                    url: 'https://wa.me/?text=[post-title]+[post-url]',
                },
                Facebook: {
                    icon: 'bx bxl-facebook-circle font-size-14',
                    url: 'https://www.facebook.com/sharer.php?u=[post-url]',
                },
                Twitter: {
                    icon: 'bx bxl-twitter font-size-14',
                    url: 'https://twitter.com/share?url=[post-url]&text=[post-title]&via=[via]&hashtags=[hashtags]',
                },
                Gmail:{
                    icon: 'bx bxl-google font-size-14',
                    url: 'mailto:?subject=[post-title]&body=Check out this site: [post-url]',
                },
            };

            let build = function (e) {
                console.log(settings);
                $.each(urls, function (k, v) {
                    let link = v.url
                        .replace('[post-title]', encodeURIComponent(settings.title))
                        .replace('[post-url]', encodeURIComponent(settings.urlShare))
                        .replace('[post-desc]', encodeURIComponent(settings.description))
                        .replace('[post-img]', encodeURIComponent(settings.img))
                        .replace('[is_video]', encodeURIComponent(settings.isVideo))
                        .replace('[hashtags]', encodeURIComponent(settings.hashtags))
                        .replace('[via]', encodeURIComponent(settings.via));

                    let btn = $('<a></a>');
                    btn.attr('class', settings.buttonClass);
                    btn.attr('href', link);
                    btn.attr('data-toggle', 'tooltip');
                    btn.attr('data-placement', 'bottom');
                    btn.attr('data-original-title', settings.btnTitle + '' + k);
                    btn.attr('target', settings.btnTarget);
                    btn.attr('title', settings.btnTitle + ' ' + k);

                    // Icons
                    let icon = $('<i></i>');
                    icon.attr('class', v.icon);
                    if(settings.applyDefaultButtonStyle)
                        icon.css({color: v.color});
                    btn.append(icon);

                    // Button Text
                    // let text = $('<p class="mb-0"></p>');
                    // text.append(v.text);
                    // btn.append(text);
                    e.append(btn);
                });
            };

            return this.each(function() {
                return new build($(this));
            });
        };

        $('#Demo').socialSharingPlugin({
            urlShare: window.location.href,
            description: $('meta[name=description]').attr('content')
        })
    </script>

    <script>
        function myFunction() {
            var copyText = document.getElementById("inputGroupCopylink");

            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);

            alert("Laman telah disalin : " + copyText.value);
        }
    </script>
</body>
</html>