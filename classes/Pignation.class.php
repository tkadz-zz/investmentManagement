<?php

class Pignation extends Users
{


    public function investmentLoop($query)
    {
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if(count($rows) > 0) {
            $s = 0;
            foreach ($rows as $row){
                $investedRows = $this->GetInvestedByiuID($row['iuID']);
                $checkIn = $this->GetInvestedByiuIDandUserID($row['iuID'], $_SESSION['id']);

                if(count($checkIn) > 0){
                    $border = 'success';
                    $btn = 'success';
                    $text = 'Check';
                }
                else{
                    $border = 'dark';
                    $btn = 'primary';
                    $text = 'invest';
                }
            ?>
            <div class="col-md-6 pb-4">
                <div class="card rounded border border-<?php echo $border ?> border-3">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                            <span style="font-size: 13px"><strong>Investment ID: </strong><?php echo $row['iuID'] ?></span><br>
                            <span style="font-size: 13px"><strong>Investment Name: </strong><?php echo $row['name'] ?></span><br>
                            <span style="font-size: 13px"><strong>Investment Type: </strong><?php echo $row['type'] ?> Term Investment</span><br>
                        </div>
                        <div class="col-md-6">
                            <span style="font-size: 13px"><strong>Current Investors: </strong><?php echo count($investedRows) ?> Investors</span><br>
                            <span style="font-size: 13px"><strong>Current Total Investment: </strong>
                                $<?php
                                $use = new Userview();
                                echo $use->countTotalnv($row['iuID']);
                                ?></span><br>
                        </div>
                        </div>
                        <hr>
                        <div>
                            <a class="btn btn-<?php echo $btn ?> btn-sm rounded" href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $text ?> <span class="mdi mdi-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            }
        }
        else
        {
            ?>
            <hr>
            <div class="container px-0">
                <div class="pp-gallery">
                    <div class="-card-columns">
                        <div class="alert alert-info text-dark" role="alert">
                            <span class="mdi mdi-information-outline"></span> No Investments found. Check again in a while
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

    }

    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }



    public function paginglink($query,$records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $total_no_of_records = count($rows);
        if($total_no_of_records > 0)
        {
            ?>
                <hr>
            <div class="col-md-12">
                <tr>
                    <td colspan="12">
                        <?php
                        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                        $current_page=1;
                        if(isset($_GET["page_no"]))
                        {
                            $current_page=$_GET["page_no"];
                        }
                        if($current_page!=1)
                        {
                            $previous =$current_page-1;
                            ?>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=1"><span class="fa fa-chevron-circle-left"></span> First Page</a>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $previous ?>"><span class="fa fa-reply"></span> Previous Page</a>
                            <?php
                        }
                        for($i=1;$i<=$total_no_of_pages;$i++)
                        {
                            if($i==$current_page)
                            {
                                ?>
                                <a class="btn btn-primary" href="<?php echo $self ?>?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a class="btn btn-secondary" href="<?php echo $self ?>?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                <?php
                            }
                        }
                        if($current_page!=$total_no_of_pages)
                        {
                            $next=$current_page+1;
                            ?>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $next ?>">Next Page <span class="fa fa-chevron-circle-right"></span></a>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $total_no_of_pages ?>">Last Page <span class="fa fa-angle-double-right"></span></a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            </div>
            <?php
        }
    }


}