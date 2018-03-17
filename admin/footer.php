  </section>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
    <script type="text/javascript">
      function del_confirm(){
        if(!confirm('Are You Sure To Delete It?')){
          return false;
        }
      }
      CKEDITOR.replace( 'content' );
    </script>
  </body>
</html>