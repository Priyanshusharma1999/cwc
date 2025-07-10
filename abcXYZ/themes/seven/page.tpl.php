
  <div id="branding" class="clearfix">
    <?php print $breadcrumb; ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php print render($primary_local_tasks); ?>
  </div>

  <div id="page">
    <?php if ($secondary_local_tasks): ?>
      <div class="tabs-secondary clearfix"><?php print render($secondary_local_tasks); ?></div>
    <?php endif; ?>

    <div id="content" class="clearfix">
      <div class="element-invisible"><a id="main-content"></a></div>
      <?php if ($messages): ?>
        <div id="console" class="clearfix"><?php print $messages; ?></div>
      <?php endif; ?>
      <?php if ($page['help']): ?>
        <div id="help">
          <?php print render($page['help']); ?>
        </div>
      <?php endif; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php print render($page['content']); ?>
    </div>

    <div id="footer">
      <?php print $feed_icons; ?>
    </div>

  </div>
<?php 

global $user;
$user = user_load($user->uid);
$new_user =render($user);
$user_main = get_object_vars($new_user);
$user_assigned = $user_main['field_department']['und'][0]['value'];
$roles=(explode(",",$user_assigned));
?>

<style>
.none{display:none}
.block{display:inline-block}

</style>

<script>
var arr=<?php echo json_encode($roles);?>;
jQuery(document).ready(function() {
jQuery.each(arr,function(index,value){
jQuery("#edit-field-department-name-2-und option").map(function(i){
if(jQuery(this).text()!= value){
jQuery(this).addClass("none");
}
else{
jQuery(this).addClass("block");
}
});
});});
</script>
