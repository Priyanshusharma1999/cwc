<!DOCTYPE html>
<html lang="<?php print $language->language; ?>">
<head>
<?php print $head; ?>

<title><?php print $head_title; ?></title>
<?php print $styles; ?>

<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_3.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_2.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_12.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_14.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_15.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_16.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_19.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_20.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_22.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_23.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_24.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_28.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_31.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_32.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_36.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_38.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_42.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_45.css" media="all" />
<link type="text/css" rel="stylesheet" href="http://cwc.gov.in/sites/default/files/css_injector/css_injector_47.css" media="all" />
<?php print $scripts; ?>

<?php
global $language;
$lang = $language->language;

if ($lang == "hi") {
    $default = "डिफ़ॉल्ट थीम";
    $theme1 = "ग्रे थीम";
    $theme2 = "ब्लैक थीम";
} else {
    $default = "Default Theme";
    $theme1 = "Grey Theme";
    $theme2 = "Black Theme";
}
?>

<!--[if lt IE 9]>
<script src="<?php print base_path() . drupal_get_path('theme', 'nexus') . '/js/html5.js'; ?>"></script>
<![endif]-->

<?php
global $user;
$mystring = end($user->roles);
$findme = 'user';
$pos = strpos($mystring, $findme);

if ($pos === false) {
?>
<script>
(function ($) {
$(document).ready(function () {
    $('.menu-18 a').attr("href", "<?php echo $GLOBALS['base_url']; ?>/admin/people");
});
})(jQuery);
</script>
<?php } else { ?>
<script>
(function ($) {
$(document).ready(function () {
    $('.menu-18 a').attr("href", "<?php echo $GLOBALS['base_url']; ?>/admin/peoples");
    $('#edit-roles .form-type-checkbox').css("display", "none");
    $('#edit-roles .form-item-roles-20').css("display", "block");
    $('#edit-roles .form-item-roles-21').css("display", "block");
    $('.menu-4300').css("display", "none");
    $('#user-profile-form--2 .form-type-checkbox').css("display", "none");
    $('#user-profile-form--2 .form-item-roles-20').css("display", "block");
    $('#user-profile-form--2 .form-item-roles-21').css("display", "block");
    $('#edit-sections-workbench-access').css("display", "none");
    $(".toolbar-shortcuts ul li").eq(5).css("display", "none");
    $(".toolbar-shortcuts ul li").eq(2).css("display", "none");
    var url = window.location.href;
    if (url == "<?php echo $GLOBALS['base_url']; ?>/admin/people") {
        window.location.replace("<?php echo $GLOBALS['base_url']; ?>/admin/peoples");
    }
});
})(jQuery);
</script>
<?php } ?>

<!-- Additional inline JS and functions here... (left as is) -->

<script>
//<!--//--><![CDATA[//><!--
var pfHeaderImgUrl = '';
var pfHeaderTagline = '';
var pfdisableClickToDel = '0';
var pfHideImages = 0;
var pfImageDisplayStyle = 'right';
var pfDisablePDF = 0;
var pfDisableEmail = 0;
var pfDisablePrint = 0;
var pfCustomCSS = '';
var pfPlatform = 'Drupal 7';
//--><!]]>
</script>

<script>
jQuery(document).ready(function() {
    var title = "All";
    jQuery("#edit-field-date-taxanomy-tid option[value='" + title + "']").hide();
});
</script>
<script>
jQuery(document).ready(function() {
    var title = "161";
    jQuery("#edit-field-type-of-documents-tid-1 option[value='" + title + "']").hide();
});
</script>
<script>
jQuery(document).ready(function() {
    jQuery('#edit-field-date-taxanomy-tid').find("option:contains('- Any -')").hide();
});
</script>
<script src="//cdn.printfriendly.com/printfriendly.js"></script>

</head>
<body class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
