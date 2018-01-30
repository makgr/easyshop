<?php 
require('connect.php');

 ?>

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