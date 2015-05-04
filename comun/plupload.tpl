
{literal}
<style type="text/css">@import url(/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="/lib/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<script type="text/javascript">
		// Convert divs to queue widgets when the DOM is ready
		$(function() {
			// Setup html5 version
			$("#uploader_promo_item").pluploadQueue({
				// General settings
				runtimes : 'html5,browserplus,silverlight,gears,html4,flash',
				//runtimes: 'html5',
				url : '/lib/plupload/upload.php',
				max_file_size : '10mb',
				chunk_size : '1mb',
				unique_names : true,

				// Resize images on clientside if we can
				resize : {width : 800, height : 600, quality : 90},

				// Resize images on clientside if we can
				// resize : {width : 320, height : 240, quality : 90},
				
				// Rename files by clicking on their titles
				rename: true,
				flash_swf_url : '/lib/plupload/plupload.flash.swf',

				// Silverlight settings
				silverlight_xap_url : '../js/plupload.silverlight.xap',
				
				// Sort files
				sortable: true,
				// Specify what files to browse for
				filters : [
					{title : "Image files", extensions : "jpg,gif,png,jpeg"},
					{title : "Pdf files", extensions : "pdf"}
				],
				init : {
		            StateChanged: function(up) {
		                // Called when the state of the queue is changed
		                // log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
		                if(up.state == plupload.STOPPED){
		                    status = up.state;
		                } else {
		                    status = up.state;
		                }
		            },
		            FileUploaded: function(up, file, info) {
		                // Called when a file has finished uploading
		                // log('[FileUploaded] File:', file, "Info:", info);
		                $('#upload_archivos').val( $('#upload_archivos').val() + file.target_name + ";" );
		                // Debido a un bug, recibimos antes el evento de STOPPED que el del ultimo fichero subido
		                if(status==plupload.STOPPED){
		                    $('#uploder_form').submit();
		                    status = "";
		                }
		            }
	        	}
			});
			
		});
		$('#uploder_form').submit(function(e) {
			var uploader = $('#uploader_promo_item').plupload('getUploader');
			// Validate number of uploaded files
			if (uploader.total.uploaded == 0) {
				// Files in queue upload them first
				if (uploader.files.length > 0) {
					// When all files are uploaded submit form
					uploader.bind('UploadProgress', function() {
						if (uploader.total.uploaded == uploader.files.length)
							$('#uploder_form').submit();
					});
					uploader.start();
				} else
					alert('You must at least upload one file.');

				e.preventDefault();
			}
		});
		$(document).ready(function()
		{
			$(".tab_content_promo").hide();
			$("ul.tabs_promo li:first").addClass("active").show();
			$(".tab_content_promo:first").show();

			$("ul.tabs_promo li").click(function()
		       {
				$("ul.tabs_promo li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content_promo").hide();

				var activeTab = $(this).find("a").attr("href");
				$(activeTab).fadeIn();
				return false;
			});
		});
	</script>
{/literal}



	