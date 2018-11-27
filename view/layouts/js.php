<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/select2/js/select2.full.min.js"></script>
<script src="assets/template/js/adminlte.min.js"></script>
<script src="assets/validator/validator.min.js"></script>
<script src="assets/sweetalert/sweetalert.min.js"></script>
<script src="assets/iCheck/icheck.min.js"></script>
<script src="assets/js.cookie.js"></script>

<script type="text/javascript">
  var url = window.location;
  $('uL.sidebar-menu a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
       return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>
