<?php /* Template Name: contact-usPage */ ?>

<?php
/******************************************/
## Writty theme page.php
## Content page.
/******************************************/

$sidebar_layout = esc_attr(get_theme_mod('wrt_sidebar_position', '2cr'));


get_header();
?>
	<section class="site-main <?php if($sidebar_layout == '2cl') echo 'with-left-sidebar'; elseif($sidebar_layout == '2cr') echo 'with-right-sidebar'; else echo '';?> ">

        <div class="site-container">
            <div class="site-row">
				<div class="site-content <?php if($sidebar_layout == '2cl'  || $sidebar_layout == '2cr') echo ' with-sidebar expand-view '; else echo ' with-no-sidebar compact-view '; ?>" id="site-content" role="main">

					<?php
					if(have_posts()):
						while(have_posts()): the_post();
							get_template_part('inc/theme/views/content-page');
						endwhile;
					else:
						get_template_part('inc/theme/views/content-none');
					endif;
					?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template('', true );
						endif;
					?>
						<div id="my-form"></div>
				</div>

				<?php if($sidebar_layout == '2cl' || $sidebar_layout == '2cr'): ?>
				<div class="site-sidebar" id="sidebar" role="complementary">
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(function() {

	    var form = $('#my-form');
	    var label = $('<label>').text('Name: ');
	    var input = $('<input>', {
	        "type": "text"
	    });
	    var submit = $('<input>', {
	        "type": "submit"
	    });

	    var textarea = $('<textarea>');

	    var name = '';
	    var email = '';

	    function progressForm() {

	        if (label.text() === 'Comments: ') {
	            input.remove();
	            textarea.remove();
	            submit.remove();

	            label.text("Thanks " + name +  " for submitting the form");
	        }

	        if (label.text() === 'Email: ') {
	            email = input.val();

	            //change whats on the page to the input for email address
	            label.text('Comments: ');
	            input.replaceWith(textarea);
	        }

	        if (label.text() === 'Name: ') {
	            name = input.val();
	            console.log(name);

	            //change whats on the page to the input for email address
	            label.text('Email: ');
	            input.val('');
	        }

	    }

	    //whenever enter is pressed when typing inside of input text box
	    input.on('keydown', function(e) {
	        var key = e.which;
	        if (key === 13) {
	            progressForm();
	        }
	    });

	    // whenever the submit button gets clicked
	    submit.click(progressForm);

	    //Name
	    label.appendTo(form);
	    input.appendTo(form);
	    submit.appendTo(form);

	});
	</script>

<?php
get_footer();
?>
