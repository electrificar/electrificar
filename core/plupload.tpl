{literal}
<link type="text/css" href="/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" />

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="/lib/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script type="text/javascript">
		// Convert divs to queue widgets when the DOM is ready
		$(function() {
	        $("#uploader").pluploadQueue({
	            // General settings
	            runtimes : 'gears,flash,silverlight,browserplus,html5',
	            url : '/lib/plupload/upload.php',
	            max_file_size : '2500kb',
	            chunk_size : '1mb',
	            unique_names : true,
	            max_file_count: 100,
	     
	            // Resize images on clientside if we can
	            resize : {width : 800, height : 600, quality : 90},
	     
	            // Specify what files to browse for
	            filters : [
	            	{title : "Documentacion", extensions : "pdf,doc,docx,xls,xlsx,jpg,png,gif,zax,gtb"}
	            ],
	     
	            // Flash settings
	            flash_swf_url : '/lib/plupload/plupload.flash.swf',
	     
	            // Silverlight settings
	            silverlight_xap_url : '/lib/plupload/plupload.silverlight.xap',

	            // Post init events, bound after the internal events
	            init : {
	                StateChanged: function(up) {
	                    // Called when the state of the queue is changed
	                    // log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
	                    if(up.state == plupload.STOPPED){
	                        status = up.state;
	                        $('#uploder_form').submit();
	                    } else {
	                        status = up.state;
	                    }
	                },
	                FileUploaded: function(up, file, info) {
	                    // Called when a file has finished uploading
	                    // log('[FileUploaded] File:', file, "Info:", info);
	                    $('#uploder_form [id=tmp_names]').val( $('#uploder_form [id=tmp_names]').val() + file.target_name + ";" );
	                    $('#uploder_form [id=source_names]').val( $('#uploder_form [id=source_names]').val() + file.name + ";" );
	                }
	            }
	        });
	    });
		
	</script>
{/literal}
	<form id="uploder_form" method="post" action="index.php?controller=file&action=update_file" target="frame_oculto">  
        <input type="hidden" id="tmp_names" name="tmp_names" value="">
        <input type="hidden" name="id" value="{$id}">
        <input type="hidden" id="source_names" name="source_names" value="">
        <div id="uploader" style="clear:both;">
            <p>Tu navegador no tiene flash, Silverlight, Gears, BrowserPlus o HTML5.</p>
        </div>
    </form>
    <iframe name="frame_oculto" id="frame_oculto" frameborder=0 width=0 height="0" src="about:blank"></iframe>
	

	