# Custom-Theme-Options-WordPress
Custom theme options for WordPress custom themes 

The WordPress Theme Options screen provides appearance settings for a theme right from the dashboard. 
Developers can choose what options they want to add to their theme settings. They can provide the users with the capabilities to change theme features. 
Developers can add a WordPress theme options page to any theme simply by modifying it’s "functions.php" file. Theme options depend on the features and customization the theme supports. However, there are some common options present in every theme settings page. These include layout options, social URLs, header logo etc. 

# How to Use

1) Download this theme options folder and place it in your theme
2) Link this theme option in your function.php file

    /**
    * Theme Options 
    */
    require_once('Custom-Theme-Options-WordPress/theme-options.php');
    
Now you can see the options page in your wp-admin dashboard


# How to Display theme option values into your header, footer or pages

In order to use this theme option on front end use this line on the top of your pages like (header.php, footer.php, page.php, custom-template.php)
```
<?php 
//getting theme options
$theme_option 	= get_option( 'theme_options' ); 
?>

/* Use this for getting Logo  */
<?php if($theme_option['use-text-logo'] == true) { ?>
<h1 class="siteName"><?php echo $theme_option['text-logo']; ?></h1>
<?php } else if(!empty($theme_option['logo'])) { ?>
<a href="<?php echo get_site_url(); ?>"><img src="<?php echo esc_url($theme_option['logo']); ?>" /></a>
<?php } else { ?>
<h1 class="siteName"><a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
<?php } ?>	


/* Use this for Favicon  */

<?php if(!empty($theme_option['favicon'])) { ?>
<link rel="shortcut icon" href="<?php echo esc_url($theme_option['favicon']);?>">
<?php } ?>		


/* Use this for Phone Number and Caption  */

<?php if(!empty($theme_option['phone-number-caption']) &&  !empty($theme_option['phone-number'])) { ?>
<div class="phNumber"><span class="phCaption"><?php echo $theme_option['phone-number-caption']; ?></span> <span><?php echo $theme_option['phone-number']; ?></span></div>
<?php }  ?>   

/* Use this for Email and  Caption */

<?php if(!empty($theme_option['email-caption']) &&  !empty($theme_option['email-address'])) { ?>
<div><span class="emCaption"><?php echo $theme_option['email-caption']; ?></span> <a href="mailto:<?php echo $theme_option['email-address']; ?>"><?php echo $theme_option['email-address']; ?></a></div>
<?php }  ?>   

/* Use this for checking is it sticky or not */

<?php if($theme_option['sticky-header'] == true) { ?>
Do anything you want if the option is Yes
<?php } ?>	

/* Create a Shortcode for Social Icons  */

/* Place this code in your function.php file  */
<?php 

function socialFunction($atts ) {
$theme_option 	= get_option( 'theme_options' );
$output  = '';
$output .= '<ul class="list-inline no-margin clearfix clearfix" >';
    if(!empty($theme_option['facebook'])){ 
	$output .= '<li class=""><a href="'.esc_url($theme_option['facebook']).'" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>';
    } 
    if(!empty($theme_option['twitter'])){
	$output .= '<li class=""><a href="'.esc_url($theme_option['twitter']).'" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>';
    } 
    if(!empty($theme_option['instagram'])){ 
	$output .= '<li class=""><a href="'.esc_url($theme_option['instagram']).'" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a></li>';
    } 
    if(!empty($theme_option['pinterest'])){
	$output .= '<li class=""><a href="'.esc_url($theme_option['pinterest']).'" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>';
    }
    if(!empty($theme_option['youtube'])){ 
	$output .= '<li class=""><a href="'.esc_url($theme_option['youtube']).'" target="_blank" title="youtube"><i class="fa fa-youtube"></i></a></li>';
    } 
    if(!empty($theme_option['rss'])){
	$output .= '<li class=""><a href="'.esc_url($theme_option['rss']).'" target="_blank" title="rss"><i class="fa fa-rss"></i></a></li>';
    }
$output .= '</ul>';
return $output;
}
add_shortcode( 'display-social-links', 'socialFunction' );

?>

/* Use this for getting Social Icons */
<div class="socialArea">
<?php echo do_shortcode('[display-social-links]'); ?>
</div>
```

This is an open source project so you are most welcome to contribute by fixing bug or implementing new features, creating issues for bugs you find, submitting new features request and most importantly providing your feedback.

If you got anything to say, find me on twitter @MustafaFazalHus.
