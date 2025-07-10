jQuery(window).load(function() {

  jQuery('#slidebox').flexslider({
    animation: "fade",
    directionNav:true,
    controlNav:false
  });

});

jQuery(document).ready(function(){
    jQuery("#flip").click(function(){
        jQuery("#panel").slideDown("slow");
    });
	jQuery("#flip2").click(function(){
        jQuery("#panel2").slideDown("slow");
    });
});
