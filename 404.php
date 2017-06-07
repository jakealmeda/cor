<?php
 
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'genesis_404');
 
function genesis_404()
{
    echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';
    printf('<h1 class="entry-title">%s</h1>', apply_filters('genesis_404_entry_title', __('Not found, error 404', 'genesis')));
    echo '<div class="entry-content">';
	echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' );

	get_search_form();

?>
 
<h4 class="space-vertical"><?php
    _e('OR - You might like reading these recent posts:', 'genesis'); ?></h4>
<ul>
<?php
    wp_get_archives('type=postbypost&limit=50'); ?>
</ul>
 
</div><!-- end .archive-page-->
<?php
}
 
genesis();