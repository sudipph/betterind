<?php

/**
 * User Favorites
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_user_favorites' ); ?>

<div id="bbp-user-favorites" class="bbp-user-favorites">
    <h3 class="mb-3">

		<?php _e( 'Favorite torum topics', 'evolve' ); ?>

    </h3>
    <div class="bbp-user-section">

		<?php if ( bbp_get_user_favorites() ) : ?>

			<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

			<?php bbp_get_template_part( 'loop', 'topics' ); ?>

			<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

		<?php else : ?>

            <p class="alert alert-warning" role="alert">

				<?php bbp_is_user_home() ? _e( 'You currently have no favorite topics', 'evolve' ) : _e( 'This user has no favorite topics', 'evolve' ); ?>

            </p>

		<?php endif; ?>

    </div>
</div><!-- #bbp-user-favorites -->

<?php do_action( 'bbp_template_after_user_favorites' ); ?>
