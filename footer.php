<!-- Footer -->
<footer>
  <div class="container-fluid">
    <p class="pull-right"><a href="#">Back to top</a></p>
    <p>&copy; 2017 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </div>
</footer>
<!-- /.Footer -->

<!-- scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</script>
<script>

  $(document).ready(function() {

   var docHeight = $(window).height();
   var footerHeight = $('footer').outerHeight();
   var footerTop = $('footer').position().top;
   if (footerTop < docHeight) {
    $('footer').css('margin-top', (docHeight - footerTop) + 'px');
   }
  });
 </script>
<!-- /.scripts -->
