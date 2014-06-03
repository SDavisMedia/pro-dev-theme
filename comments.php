<?php
/**
 * the template for displaying comments and pingbacks
 */



/** ===============
 * template for comments and pingbacks
 */ 
if ( ! function_exists( 'pdt_comment' ) ) :
	function pdt_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
	
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	
			<div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="comment-body">
					<?php _e( 'Pingback:', 'pdt' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'pdt' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</div>
	
		<?php else : ?>
	
			<div id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
				<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard clear-pdt">
							<span class="comment-avatar">
								<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, 45 ); ?>					
							</span>
							<span class="comment-info">
								<?php printf( __( 'Comment by %s on', 'pdt' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php printf( _x( '%1$s', '1: date', 'pdt' ), get_comment_date(), get_comment_time() ); ?>
									</time>
								</a>
								<?php edit_comment_link( __( 'Edit', 'pdt' ), '<span class="edit-link">', '</span>' ); ?>
							</span>
						</div>
					</footer>
		
					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pdt' ); ?></p>
					<?php endif; ?>
		
					<div class="comment-content">
						<?php comment_text(); ?>
					</div>
		
					<div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div>
			</div>
	
		<?php endif; // ends check for comment type (comment or ping)
	}
endif; // ends check for pdt_comment()



/** ===============
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return; ?>

	<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<span class="comments-title">
		
			<?php
				printf( _nx( 'One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'pdt' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
			
		</span>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="navigation-comment" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( '&larr; ' . __( 'Older Comments', 'pdt' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'pdt' ) . ' &rarr;' ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

		<div class="comment-list">
		
			<?php
				/** 
				 * Loop through and list the comments. Tell wp_list_comments()
				 * to use pdt_comment() to format the comments.
				 * 
				 * If you want to override this in a child theme you can
				 * define pdt_comment() and that will be used instead.
				 */
				wp_list_comments( array( 'callback' => 'pdt_comment' ) );
			?>
			
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation-comment" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( '&larr; ' . __( 'Older Comments', 'pdt' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'pdt' ) . ' &rarr;' ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'pdt' ); ?></p>
	<?php endif; ?>

	<?php 
		/** 
		 * Comment Form
		 */
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		
		comment_form( 
			array( 
				'comment_field'			=> '<p class="comment-form-comment"><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea></p>',
				'comment_notes_after'	=> '',
				'title_reply'			=> __( 'Leave a Reply', 'pdt' ),
				'cancel_reply_link'		=> '<span class="cancel-reply">' . __( 'Cancel Reply', 'pdt' ) . '</span>',
				'label_submit'			=> __( 'Submit Comment', 'pdt' ),
				'fields'				=> apply_filters( 'comment_form_default_fields', 
				
					array(
						'author'	=> '<p class="comment-form-author">' . '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'pdt' ) . '" size="30" class="comment-form-field required" ' . $aria_req . ' /></p>',
						
						'email'		=> '<p class="comment-form-email">' . '<input id="email" name="email" type="text" placeholder="' . __( 'Email', 'pdt' ) . '" size="30" class="comment-form-field required"' . $aria_req . ' /></p>',
						
						'url'		=> '<p class="comment-form-url"><input id="url" name="url" type="text" placeholder="' . __( 'Website', 'pdt' ) . '" size="30" class="comment-form-field" /></p>'
					)
				)
			) 
		);
	?>

</div>