<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Medicalstore
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">Medicalstore</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>

 <!-- DataTables -->
   <script src="<?= base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> 
 <!-- <script src="<?= base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>  -->
  <!-- new add -->
  <script src="<?= base_url(); ?>assets/js/datatable/dataTables.buttons.min.js"></script> 
  <script src="<?= base_url(); ?>assets/js/datatable/buttons.flash.min.js"></script> 
  <script src="<?= base_url(); ?>assets/js/datatable/jszip.min.js"></script> 
  <script src="<?= base_url(); ?>assets/js/datatable/pdfmake.min.js"></script> 
  <script src="<?= base_url(); ?>assets/js/datatable/vfs_fonts.js"></script> 
  <script src="<?= base_url(); ?>assets/js/datatable/buttons.html5.min.js"></script> 
  <script src="<?= base_url(); ?>assets/js/datatable/buttons.print.min.js"></script> 

  <script src="<?= base_url(); ?>assets/js/datatable/buttons.colVis.min.js"></script> 
  <!-- cdna -->
  <!-- <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script> 
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script> -->

<!-- Select2 -->
<script src="<?= base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- toster -->
<script src="<?= base_url(); ?>assets/js/toastr.js"></script> 
<script src="<?= base_url(); ?>assets/js/toasterJS.js"></script> 
<script src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script> 
<script src="<?= base_url(); ?>assets/js/custom.js"></script> 

<script type="text/javascript">
  //number validation
     function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57 )) {
            return false;
        }
        return true;
    }


  //message success alert
  $("#messagebox").show().delay(3000).fadeOut();

  //data table
 /* $(function () {
    $('#table_id').DataTable()
  })
*/
$(document).ready(function() {
    $('#table_id').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           // 'excel', 'pdf', 'print',
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible',
                },
                customize: function (win) {
                    $(win.document.body).find('table').addClass('display').css('font-size', '14px');
                    /*$(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                        $(this).css('background-color','#D0D0D0');
                    });*/
                   
                    $(win.document.body).find('th,td').each(function(index) {
                      $(this).css({
                          'text-align': 'center',
                          'padding': '5px 10px',
                          'font-size': '16px',
                          'border': '1px solid #827c7c',
                      });
                    });
                    $(win.document.body).find('h1').css({
                        'text-align': 'center',
                        'font-size': '25px',
                        "float": 'left',
                        'width': '100%'
                    });
                },

            },
            'colvis'
        ],

    } );

  } );


  /*$(function () {
     $('#table_id').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive' :  true
      })
   })*/
  $(function () {
    $('.select2').select2()   
  });

  //image preview see
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>