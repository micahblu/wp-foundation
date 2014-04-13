<?php get_header(); ?>
  <div class="row">
    <div class="<?php echo $content_columns; ?> columns">

		<h1>Page Not Found</h1>
		<p>
		  <strong>Did you type the URL?</strong><br />
		  You may have typed the address (URL) incorrectly. Check it to make sure you've got the exact right spelling, capitalization, etc.
		</p>
		<p>
		  <strong>Did you follow a link from somewhere else at this site?</strong><br />
		  If you reached this page from another part of this site.
		</p>
		<p>
		  <strong>Did you follow a link from another site?</strong><br />
		  Links from other sites can sometimes be outdated or misspelled.
		</p>
		</div><!-- .<?php echo $content_columns; ?> columns -->

    <div class="<?php echo $sidebar_columns; ?> columns">
      <?php get_sidebar(); ?>
    </div><!-- .<?php echo $sidebar_columns; ?> columns -->
  </div><!-- .row -->
<?php get_footer(); ?>