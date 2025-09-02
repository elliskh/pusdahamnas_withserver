<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	content_css: "https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css",
	height: 300
});
</script>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="display_form_registrasi">
					<form id="form-edit-auditham" class="form form-horizontal" action="#"  method="POST" autocomplete="off">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
						<div class="form-body">
							<div class="row mt-1 mb-1">
								<div class="col-md-6 col-sm-8">
									<h4> Form Audit HAM</h4>
								</div>
								<div class="col-md-6 col-sm-4">
									<div class="text-right">
										<a href="#" onclick="history.go(-1)" class="btn btn-link text-right">
											<i class="bx bx-left-arrow-circle"></i> Kembali</a>
									</div>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-md-2">
									<label>Instansi</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" value="" name="menu_id" hidden>
									<input type="text" class="form-control" value="<?=encode_id($data['detail']['id'])?>" name="id" hidden>
									<input type="text" class="form-control" name="instansi" placeholder="Nama Instansi" value="<?=$data['detail']['instansi']?>" required="">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Nama Dokumen Audit</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" name="nama_audit" placeholder="Nama Dokumen Audit"  value="<?=$data['detail']['nama_audit']?>" required="">
									<span class="validasi"></span>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2">
									<label>Deskripsi Nama Audit</label>
								</div>
                                <div class="col-md-10">
                                        <textarea id="deskripsi" name="deskripsi" class="form-control" style="min-height:40vh" required=""><?=$data['detail']['deskripsi']?></textarea>
                                </div>
							</div>
                            
							<div class="row mb-3">
								<div class="col-md-12 d-flex justify-content-center ">
									<button form="form-edit-auditham" type="submit" class="btn btn-lg btn-primary mr-1 mb-1 mt-5 btn-block w-50"> <i class="bx bx-check-circle"></i> Simpan</button>
								</div>
                                
							</div>
                            
						</div>
					</form>
                        

                    <!--=========  End of Form  =========-->
                <script src="https://www.tinymce-bootstrap-plugin.com/assets/javascripts/loadjs.min.js"></script>
                <script src="https://www.tinymce-bootstrap-plugin.com/assets/javascripts/jquery-3.3.1.min.js"></script>
                <script async defer src="https://www.tinymce-bootstrap-plugin.com/assets/javascripts/project.min.js"></script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>-->


                    <script>
                        loadjs([
                            'https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.1/tinymce.min.js',
                            'https://www.tinymce-bootstrap-plugin.com/bootstrap5/demo/plugin/plugin.min.js'
                        ], 'tinymce', {
                            async: false
                        });
                
                        loadjs.ready('tinymce', function() {
                            loadTinymce();
                        });
                
                        function loadTinymce() {
                            if (typeof(base_url) == "undefined") {
                                var base_url = location.protocol + '//' + location.host + '/';
                
                                const LOCAL_DOMAINS = ["localhost", "127.0.0.1", "tinymce-bootstrap-plugin-website"];
                                if (LOCAL_DOMAINS.includes(window.location.hostname)) {
                                    var tbpKey = '45vLazNrE5TtCiCJRyX1uZH5SVdDj9crgDjsnoXU+5YCssEnFowJEsI+hacfpiFg8fw33P5pJLR7JQdIIn65jdD+XMWxMHXMJ/4vTniS9UjsYnvENPdoDyXcBiiDVWtb';
                                } else {
                                    var tbpKey = 'SSej8kYAwx1k/IWFZACyJtg9o6Gc2eHQqW6nBRF8kV36a1YBREECUSA5LkYJBa1rIUD4CwsX8S83VfoqGIpp7LUjwUOfgLyyIwaaL+g1jiwewhsEaE6ZN87q6XfMcvJm';
                                }
                            }
                            // uncomment the following line to test if your key is properly set
                            // console.log(tbpKey);
                            tinymce.init({
                               selector: '#isi_konten',
                               /// selector: '#tinymce',
                                branding: false, /* remove logo tinymce */
                                // language: 'fr_FR',
                                // language_url :'/bootstrap5/plugin/langs/fr_FR.js',
                                ///selector: 'textarea.tinymce',
                                //selector: 'textarea',
                                ///toolbar_mode: 'wrap',
                                setup: function (editor) {
                                      editor.on('change', function () {
                                          tinymce.triggerSave();
                                      });
                                  },
                                plugins: 'advlist autolink bootstrap link image lists charmap preview help table',
                                toolbar: [
                                    ///'undo redo | bootstrap',
                                    'undo redo cut copy paste | styles | alignleft aligncenter alignright alignjustify | bold italic | link image | preview | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | save print | help'
                                ],
                                contextmenu: "link image imagetools table spellchecker | bootstrap",
                                content_css: "https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css",
                                file_picker_types: 'file image media',
                                bootstrapConfig: {
                                    // language: 'fr_FR',
                                    ///url: base_url + 'bootstrap5/demo/plugin/',
                                    url: '<?php echo base_url('assets/img/');?>',
                                    iconFont: 'font-awesome-solid',
                                    ///imagesPath: base_url + '/bootstrap5/demo/demo-images',
                                    //imagesPath: base_url + 'assets/img/', // replace with your images folder path
                                    key: tbpKey,
                                },
                                ///toolbar: "bootstrap",/* add andiek */
                                formats: {
                                    alignleft: {
                                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                                        classes: 'text-start'
                                    },
                                    aligncenter: {
                                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                                        classes: 'text-center'
                                    },
                                    alignright: {
                                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                                        classes: 'text-end'
                                    },
                                    alignjustify: {
                                        selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                                        classes: 'text-justify'
                                    },
                                    bold: {
                                        inline: 'strong'
                                    },
                                    italic: {
                                        inline: 'em'
                                    },
                                    underline: {
                                        inline: 'u'
                                    },
                                    sup: {
                                        inline: 'sup'
                                    },
                                    sub: {
                                        inline: 'sub'
                                    },
                                    strikethrough: {
                                        inline: 'del'
                                    }
                                },
                                extended_valid_elements: 's',
                                style_formats: [{
                                        title: 'Headings',
                                        items: [{
                                                title: 'Heading 1',
                                                format: 'h1'
                                            },
                                            {
                                                title: 'Heading 2',
                                                format: 'h2'
                                            },
                                            {
                                                title: 'Heading 3',
                                                format: 'h3'
                                            },
                                            {
                                                title: 'Heading 4',
                                                format: 'h4'
                                            },
                                            {
                                                title: 'Heading 5',
                                                format: 'h5'
                                            },
                                            {
                                                title: 'Heading 6',
                                                format: 'h6'
                                            }
                                        ]
                                    },
                                    {
                                        title: 'Blocks',
                                        items: [{
                                                title: 'Paragraph',
                                                format: 'p'
                                            },
                                            {
                                                title: 'Blockquote',
                                                format: 'blockquote'
                                            },
                                            {
                                                title: 'Div',
                                                block: 'div',
                                                wrapper: true
                                            }
                                        ]
                                    },
                                    {
                                        title: 'Containers',
                                        items: [{
                                                title: 'Container fluid',
                                                block: 'div',
                                                classes: 'container-fluid',
                                                wrapper: true
                                            },
                                            {
                                                title: 'Container',
                                                block: 'div',
                                                classes: 'container',
                                                wrapper: true
                                            },
                                            {
                                                title: 'Section',
                                                block: 'section',
                                                wrapper: true
                                            },
                                            {
                                                title: 'Article',
                                                block: 'article',
                                                wrapper: true
                                            }
                                        ]
                                    }
                                ],
                                style_formats_merge: false,
                                style_formats_autohide: true,
                                valid_elements : '*[*]'
                            });
                        }
                    </script>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#form-edit-auditham').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
	//	data.append(CSRF.token_name, CSRF.hash);
    
		$.ajax({
  	        url: "<?php echo base_url('audit_ham/update');?>",//$(this).prop('action'),
	 		type: "POST",
			data: data, 
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {

				if (res.status=='sukses') {
				    toastrSuccess('sukses', 'Update data berhasil');
				    //alert("Update data berhasil");history.go(-1);
                    //location.reload()
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    window.location(history.go(-1));
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
                alert("Terjadi kesalahan di server3!");
              if(JSON.stringify(res.status)==500){
                alert("Terjadi kesalahan di server!");
              } else {
                <?php $this->session->set_flashdata('success_messages', 'Proses Data Berhasil'); ?>                
                alert("Update data berhasil");history.go(-1);
              }
			/*error: (res) => {
                alert("Terjadi kesalahan di server!");
				//toastrError('Gagal', 'Terjadi kesalahan di server');
				//table.ajax.reload();
			}*/
            }
		});
	});
</script>
<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url() ?>assets_front/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets_front/libs/node-waves/waves.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script src="https://ministry.phicos.co.id/front/pusdahamnas/assets/libs/social-sharing/socialSharing.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>

	<!-- JAVASCRIPT -->
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/node-waves/waves.min.js"></script>

	<!-- owl.carousel js -->
	<script src="<?= themeUrl() ?>assets/libs/owl.carousel/owl.carousel.min.js"></script>

	<!-- auth-2-carousel init -->
	<script src="<?= themeUrl() ?>assets/js/pages/auth-2-carousel.init.js"></script>
 
	<!-- App js -->
	<script src="<?= themeUrl() ?>assets/js/app.js"></script>
	<!-- JQuery Validate -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.js"></script>
	<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes-format.js') ?>"></script>
	<script src="<?= base_url('assets/js/script.js?q=' . random_string()) ?>"></script>
	<script src="<?= base_url('assets/js/pages/komunitasham/tambah.js?q=' . random_string()) ?>"></script>