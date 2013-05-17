
  <!-- Footer -->
  
  <footer class="row">
    <div class="large-12 columns">
      <hr />
      <div class="row">
        <div class="large-6 columns">
          <p>&copy; Copyright no one at all. Go to town.</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
            <li><a href="#">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div> 
  </footer>

  <script>
  
  document.write('<script src=<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/' +
  ('__proto__' in {} ? 'zepto' : 'jquery') +
  '.js><\/script>')
  
  </script>

  
  <script src="<?php echo get_stylesheet_directory_uri() ?>/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
  <?php wp_footer(); ?>
  <!-- End Footer -->
</body>
</html>
