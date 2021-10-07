<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://adminlte.io">Synapse</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     Designed By <strong><a href="http://bizbrainz.in/">Bizbrainz.in</a>.</strong>
    </div>
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/<?php echo base_url();?>assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/<?php echo base_url();?>assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/<?php echo base_url();?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="/<?php echo base_url();?>assets/backend/plugins/moment/moment.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/<?php echo base_url();?>assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/jszip/jszip.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/<?php echo base_url();?>assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- AdminLTE App -->
<script src="/<?php echo base_url();?>assets/backend/dist/js/adminlte.js"></script>
<script src="/<?php echo base_url();?>assets/backend/js/jquery.validate.min.js"></script>

<script type="text/javascript">
      var base_url={baseurl:"/<?php echo base_url();?>"};
        $(function(){
          // this will get the full URL at the address bar
          var url = window.location.href; 
          
          // passes on every "a" tag 
          $(".nav > li a").each(function() {
                  // checks if its the same on the address bar
              if(url == (this.href)) { 
                  $(this).closest("a").addClass("active");
              }
          });
      });
 </script>
<script src="/<?php echo base_url();?>assets/backend/js/gobalSettings.js"></script>
<script src="/<?php echo base_url();?>assets/backend/js/LoginController.js"></script>


</body>
</html>