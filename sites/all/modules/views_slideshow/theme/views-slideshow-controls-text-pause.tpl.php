<?php

/**
 * @file
 * Views Slideshow: Template for text control - pause/start.
 *
 * - $variables: Contains theme variables.
 * - $classes: Text control classes.
 * - $start_text: Start/Pause control text.
 *
 * @ingroup vss_templates
 */
?>
<span id="views_slideshow_controls_text_pause_<?php print $variables['vss_id']; ?>" tabindex="0" class="<?php print $classes; ?>"><a href="#" title="<?php print $start_text; ?>"><?php print $start_text; ?></a></span>
