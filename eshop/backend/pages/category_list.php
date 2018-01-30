<?php 
require('connect.php');

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="text/javascript">


        function confirm_category_delete(catid) {
            //alert(catid);

            $("#hcatid").val(catid);

            $("#myModal_delete").modal('show');

            
        }
        
        function delete_catgory()
        {
            
           var catid = $("#hcatid").val()
            
            $.ajax({
                method: "get",
                url: 'category_delete.php',
                data: {catid: catid}
            })
            .done(function (response)
            {
                // if(response==1){
                // } 
                // else{

                // }

                display_catgory_list();

            }); 
        }


        function display_catgory_list()
        {
            
           var catid = $("#hcatid").val();
            
            $.ajax({
                method: "get",
                url: 'display_category_list.php',
                //data: {catid: catid}
            })
            .done(function (response)
            {
               
              $("#category_all").html(response);
              $("#myModal_delete").modal('hide');
                       
            }); 
        }



       
    </script>

</head>

<body>

    <div id="wrapper">


        <!-- Button trigger modal -->
                          
                           

        <!-- Navigation -->
        <?php include('navbar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Context Classes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" id="category_all">

                                <?php

                                $sql = "SELECT * FROM categories ORDER BY category_name";

                                $res = mysqli_query($con, $sql);

                                $nums = mysqli_num_rows($res);

                                

                                if($nums >0)
                                {
                                    ?>

                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categroy name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $i = 1;

                                        while ($row = mysqli_fetch_assoc($res)) {
                                    
                                           // print_r($row);

                                            //echo "<br/>";

                                            ?>

                                             <tr class="success">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['category_name']; ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="category_edit.php?catid=<?php echo $row['catid']; ?>">Edit</a>
                                                    <a class="btn btn-danger" onclick="confirm_category_delete(<?php echo $row['catid']; ?>)">Delete</a>
                                                </td>
                                            </tr>

                                            <?php

                                            $i++;
                                        }
                                        ?>
                                       
                                       
                                        
                                    </tbody>
                                </table>

                                    <?php

                                }
                                else
                                {
                                    echo "No record found";
                                }
                                ?>
                                
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->





    </div>
<!-- /#wrapper -->



     <!-- Modal -->
    <div class="modal fade" id="myModal_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    Are you sure? you want to delete this category?
                    <input type="hidden" id="hcatid" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="delete_catgory()">Yes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
