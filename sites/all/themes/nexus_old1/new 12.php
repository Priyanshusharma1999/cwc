<? if($_GET['pageview'] != "androidview"){?>

	<div class="footer">

		<div class="inner-wrap-90">

			<div class="section-01">

				<? if(isset($_SESSION['loginuserid'])){

					include('footer_afterlogin.php');

				}else{

					include('footer_beforelogin.php');

				}?>

			</div>

		</div>

	</div>





	<div class="footer-botom">

		<div class="section-01">

		Copyrights &copy; 2016  myjournals.co.uk  All rights reserved

		</div>

	</div>

<? } ?>

<!--bg-weaper-end-->

</div>



<!-----------------------------------------js-script------------------>



<!--<script type="text/javascript" src="<?=TEMP_URL?>/js/script.js"></script>-->



<script src="<?=SITE_URL?>/admin/calender/jquery.datetimepicker.js"></script>

<style type="text/css">

#ui-datepicker-div{

	width:25%;

}

</style>



<script>

$('#datetimepicker').datetimepicker({format:'d/m/Y',timepicker: false,step:10});

$('#datetimepicker1').datetimepicker({format:'d/m/Y',timepicker: false,step:10});

$('#datetimepicker2').datetimepicker({format:'d/m/Y',timepicker: false,step:10,maxDate: '0'});

$('#datefromid').datetimepicker({format:'d/m/Y',timepicker: false,step:10});
$('#datetoid').datetimepicker({format:'d/m/Y',timepicker: false,step:10});

$('#time_only').datetimepicker({

	datepicker:false,
    format:'g:i A',
    formatTime: 'g:i A',
    step:5,
    ampm: true
}); 

  

  

</script>

<!-- image cropping -->

<script type="text/javascript">
 window.onload = function() {
        var options =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
			imgSrc: 'avatar.png'
        }
        var cropper;
        document.querySelector('#file').addEventListener('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
			
        })
		var i=1;
		
           document.querySelector('#btnCrop').addEventListener('click', function(){
            var img = cropper.getDataURL();
            document.querySelector('.cropped').innerHTML += '<img id="id'+i+'"  src="'+img+'">';
			document.querySelector('#hidimg').innerHTML += '<input type="text"  name="imgData" value="'+img+'">';
			
			imghide(i);
			
			i++;
        })
		
        document.querySelector('#btnZoomIn').addEventListener('click', function(){
            cropper.zoomIn();
        })
        document.querySelector('#btnZoomOut').addEventListener('click', function(){
            cropper.zoomOut();
        })
		
		
		 var cropper2;
        document.querySelector('#file2').addEventListener('change', function(){
            var reader2 = new FileReader();
            reader2.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper2 = new cropbox(options);
            }
            reader2.readAsDataURL(this.files[0]);
            this.files = [];
			
        })
		var i=1;
		
           document.querySelector('#btnCrop2').addEventListener('click', function(){
            var img2 = cropper2.getDataURL();
            document.querySelector('.cropped2').innerHTML += '<img id="id'+i+'"  src="'+img2+'">';
			document.querySelector('#hidimg2').innerHTML += '<input type="text"  name="imgData" value="'+img2+'">';
			
			imghide(i);
			
			i++;
        })
		
        document.querySelector('#btnZoomIn2').addEventListener('click', function(){
            cropper2.zoomIn();
        })
        document.querySelector('#btnZoomOut2').addEventListener('click', function(){
            cropper2.zoomOut();
        
		
		})
    };
	
	
	
function imghide(id)
{
var a=id-1;

if (id>1)
{
document.getElementById("id"+a).style.display = "none";
}

}
</script>

<!-- image cropping ends -->

<script type="text/javascript">



	CloudZoom.quickStart(); // cz

	JetZoom.quickStart();

	StarZoom.quickStart();

               

	// The following piece of code can be ignored.

	if (window.location.hostname.indexOf("starplugins.") != -1) {

		var _gaq = _gaq || [];

		_gaq.push(['_setAccount', 'UA-254857-7']);

		_gaq.push(['_trackPageview']);

		(function() {

			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

		})();

	}

</script>




<script src="<?=TEMP_URL?>/js/easy-responsive-tabs.js"></script>

<script>

	$(document).ready(function () {

		$('#horizontalTab').easyResponsiveTabs({

			type: 'default', //Types: default, vertical, accordion           

			width: 'auto', //auto or any width like 600px

			fit: true,   // 100% fit in a container

			closed: 'accordion', // Start closed if in accordion view

			activate: function(event) { // Callback function if tab is switched

				var $tab = $(this);

				var $info = $('#tabInfo');

				var $name = $('span', $info);

				$name.text($tab.text());

				$info.show();

			}

		});

		$('#verticalTab').easyResponsiveTabs({

			type: 'vertical',

			width: 'auto',

			fit: true

		});

	});

	

	$(document).ready(function() {

		$("#datepicker").datepicker();

	});
	
	
	
	

</script>

<!-----------------------------------------js-script-end----------------->

</body>

</html>