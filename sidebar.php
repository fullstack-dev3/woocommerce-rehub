<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<aside class="sidebar">            
    <!-- SIDEBAR WIDGET AREA -->
	<?php if ( is_active_sidebar( 'rhsidebar' ) ) : ?>
		<?php dynamic_sidebar( 'rhsidebar' ); ?>
	<?php else : ?>
		<p><?php esc_html_e('No widgets added', 'rehub-theme'); ?></p>
	<?php endif; ?>        
</aside>