<?php
/**
* Template Name: The London Rug Company Homepage
* @package The London Rug Company
*/
get_header();
?>
</div><!---col-full--->
<div id="primary" class="content-area homepage-template-content-area">
	<main id="main" class="site-main homepage-template-site-main" role="main">
<?php
if( have_rows('home_page_sections') ):
	$section_count = 0;
    while ( have_rows('home_page_sections') ) : the_row();
        $is_disabled = get_sub_field('disabled');
        $section_count++;
        if(!$is_disabled):
        	$is_fullwidth = get_sub_field('full_width');
        	$background_image = get_sub_field('background_image');
        	$title = get_sub_field('title');
?>
	<section id="section-<?php echo $section_count; ?>" 
		class="homepage-template-section <?php echo get_sub_field('css_class');?>"
		<?php if(!empty($background_image)): ?>
        style="background: url('<?php echo $background_image?>') no-repeat center center/cover"
        <?php endif; ?>
		>
		<?php if(!$is_fullwidth): ?>
        <div class="col-full">
		<?php endif; ?>
		<?php if(!empty($title)): ?>
			<header class="section-header homepage-template-section-header"><h3><?php echo $title; ?></h3></header>
		<?php endif; ?>
		<div class="section-content homepage-template-section-content"><?php echo get_sub_field('content') ?></div>
		<?php if(!$is_fullwidth): ?>
        </div><!---col-full--->
        <?php endif; ?>
	</section>
<?php
        endif;
    endwhile;
endif;
?>
	</main><!-- #main -->
</div><!-- #primary -->
<div class="col-full">
<?php
get_footer();