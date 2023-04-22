<?php

class Userview extends Users
{

    public function viewMsgNavCountLoop($adminID){
        $rows = $this->GetActiveAdminMail($adminID);
        foreach ($rows as $row) {
            $isUser = $this->isUser($row['userID'], 'investor');
            ?>
            <a href="messages.php?userID=<?= $row['userID'] ?>" class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                    <i class="mdi mdi-star m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1"><?= $isUser[0]['name'] .' '. $isUser[0]['surname'] ?></h6>
                    <p class="fw-light small-text mb-0"> Received <?= $this->timeAgo($row['dateAdded']) ?> @ <?= $this->dateToTime($row['dateAdded']) ?> </p>
                </div>
            </a>
            <?php
        }
    }

    public function viewAllAdminMessages($role){
        $rows = $this->GetAllUserBYRole($role);
        $s = 0;
        foreach ($rows as $row){
            $isUser = $this->isUser($row['id'], $row['role']);
            $msg = $this->GetActiveAdminMsgsByAdminID($row['id'], $_SESSION['id']);
            ?>
            <td><?= $s+=1 ?></td>
            <td><?= $isUser[0]['name'] ?></td>
            <td><?= $isUser[0]['surname'] ?></td>
            <td><?= count($msg) ?></td>
            <td><a href="messages.php?adminID=<?= $row['id'] ?>"><span class="fa fa-arrow-circle-right"></span></a></td>
            <?php
        }
    }



    public function userMessages($adminID, $userID){
        $rows = $this->GetUserMessages($userID, $adminID);
        $adminRole = $this->isUser($adminID, 'admin');
        $userRole = $this->isUser($userID, 'investor');
        $this->updateUserReadStatus($userID, $adminID);
        ?>
        <section --style="background-color: #eee;">
            <div --class="container py-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3"
                                 --style="border-top: 4px solid #0067ff;">
                                <h5 class="mb-0">Chat with <?= $adminRole[0]['name'] .' '. $adminRole[0]['surname'] ?></h5>
                                <div class="d-flex flex-row align-items-center">
                                    <!--<span class="badge bg-warning me-3">20</span>-->
                                    <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                                    <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                                    <i class="fas fa-times text-muted fa-xs"></i>
                                </div>
                            </div>
                            <div class="card-body" data-mdb-perfect-scrollbar="true" --style="position: relative; height: 400px">
                                <?php
                                if(count($rows) < 1){
                                    ?>
                                    <span class="alert alert-danger">No messages yet</span>
                                    <?php
                                }
                                foreach ($rows as $row){
                                    if($row['ToFrom'] == 0){
                                        //left
                                        ?>
                                        <div class="d-flex justify-content-start">
                                            <p class="small mb-1"><?= $adminRole[0]['name'] .' '. $adminRole[0]['surname'] ?> : <?= $this->timeAgo($row['dateAdded']) ?></p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start"><!--
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                         alt="avatar 1" style="width: 45px; height: 100%;">-->
                                            <div>
                                                <p class="small p-2 ms-3 mb-3 -text-white rounded-3 bg-secondary" style="background-color: #f5f6f7;"> <span style="font-size: 10px"><?= $this->dateToTime($row['dateAdded']) ?></span> : <?= $row['message'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        //right
                                        if($row['status'] == 1){
                                            $bg = 'danger';
                                            $fa = 'circle';
                                        }else{
                                            $bg = 'success';
                                            $fa = 'check';
                                        }
                                        ?>
                                        <div class="d-flex justify-content-end">
                                            <p class="small mb-1"><?= $userRole[0]['name'] .' '. $userRole[0]['surname'] ?> : <?= $this->timeAgo($row['dateAdded']) ?></p>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                            <div>
                                                <p class="small p-2 me-3 mb-3 justify-content-end text-right text-white rounded-3 bg-primary"> <span style="font-size: 10px"><?= $this->dateToTime($row['dateAdded']) ?></span> : <?= $row['message'] ?>
                                                    <span style="font-size: 10px" class="badge bg-<?= $bg ?>"><span class="fa fa-<?= $fa ?>"></span></span>
                                                    <br>
                                                    <a onclick="return confirm('This message will be deleted and it will no longer be available to the recipient. Proceed?')" style="text-decoration: none" class="text-danger" href="includes/delMsg.php?msgID=<?= $row['id'] ?>">delete</a>
                                                </p>
                                            </div><!--
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                         alt="avatar 1" style="width: 45px; height: 100%;">-->
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="card-footer text-muted d-flex justify-content-center align-items-center p-3">
                                <div -class="input-group mb-0">
                                    <form method="POST" action="includes/sendmsg.inc.php">
                                        <input name="adminID" value="<?= $adminID ?>" hidden>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <textarea style="height: 100px;" class="form-control" type="text" name="msg" placeholder="Type Message here..." required></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <button name="send" type="submit" class="btn btn-warning btn-sm">Send <span class="fa fa-send"></span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <?php

    }


    public function adminMessage($adminID, $userID){
        $rows = $this->GetUserMessages($userID, $adminID);
        $adminRole = $this->isUser($adminID, 'admin');
        $userRole = $this->isUser($userID, 'investor');
        $this->updateAdminReadStatus($userID, $adminID);
        ?>
        <section style="background-color: #eee;">
            <div --class="container py-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-md-10 col-lg-12 col-xl-12">

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3"
                                 --style="border-top: 4px solid #0067ff;">
                                <h5 class="mb-0">Chat with <?= $userRole[0]['name'] .' '. $userRole[0]['surname'] ?></h5>
                                <div class="d-flex flex-row align-items-center">
                                    <!--<span class="badge bg-warning me-3">20</span>-->
                                    <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                                    <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                                    <i class="fas fa-times text-muted fa-xs"></i>
                                </div>
                            </div>
                            <div class="card-body" data-mdb-perfect-scrollbar="true" --style="position: relative; height: 400px;">
                                <?php
                                if(count($rows) < 1){
                                    ?>
                                    <span class="alert alert-danger">No messages yet</span>
                                    <?php
                                }
                                foreach ($rows as $row){
                                    if($row['ToFrom'] == 1){
                                        //left
                                        ?>
                                        <div class="d-flex justify-content-start">
                                            <p class="small mb-1"><a href="userProfile.php?userID=<?= $userID ?>"><?= $userRole[0]['name'] .' '. $userRole[0]['surname'] ?></a> : <?= $this->timeAgo($row['dateAdded']) ?></p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start"><!--
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                         alt="avatar 1" style="width: 45px; height: 100%;">-->
                                            <div>
                                                <p class="small p-2 ms-3 mb-3 -text-white rounded-3 bg-secondary" style="background-color: #f5f6f7;"> <span style="font-size: 10px"><?= $this->dateToTime($row['dateAdded']) ?></span> : <?= $row['message'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        //right
                                        if($row['status'] == 1){
                                            $bg = 'danger';
                                            $fa = 'circle';
                                        }else{
                                            $bg = 'success';
                                            $fa = 'check';
                                        }
                                        ?>
                                        <div class="d-flex justify-content-end">
                                            <p class="small mb-1"><?= $adminRole[0]['name'] .' '. $adminRole[0]['surname'] ?> : <?= $this->timeAgo($row['dateAdded']) ?></p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                            <div>
                                                <p class="small p-2 me-3 mb-3 justify-content-end text-right text-white rounded-3 bg-primary"> <span style="font-size: 10px"><?= $this->dateToTime($row['dateAdded']) ?></span> : <?= $row['message'] ?>
                                                    <span style="font-size: 10px" class="badge bg-<?= $bg ?>"><span class="fa fa-<?= $fa ?>"></span></span>
                                                    <br>
                                                    <a onclick="return confirm('This message will be deleted and it will no longer be available to the recipient. Proceed?')" style="text-decoration: none" class="text-danger" href="includes/delMsg.php?msgID=<?= $row['id'] ?>">delete</a>
                                                </p>

                                            </div><!--
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                         alt="avatar 1" style="width: 45px; height: 100%;">-->
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="card-footer text-muted d-flex justify-content-center align-items-center p-3">
                                <div --class="input-group mb-0">
                                    <form method="POST" action="includes/sendmsg.inc.php">
                                        <input name="userID" value="<?= $userID ?>" hidden>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <textarea style="height: 100px;" class="form-control" type="text" name="msg" placeholder="Type Message here..." required></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <button name="send" type="submit" class="btn btn-warning btn-sm">Send <span class="fa fa-send"></span></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <?php

    }



    public function viewMyMassages($userID, $adminID, $activeID, $to){
        $rows = $this->GetUserMessages($userID, $adminID);
        $s=0;

        ?>
        <section style="background-color: #eee;">
            <div class="container py-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-md-10 col-lg-12 col-xl-12">

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3"
                                 style="border-top: 4px solid #0067ff;">
                                <h5 class="mb-0">Chat messages</h5>
                                <div class="d-flex flex-row align-items-center">
                                    <span class="badge bg-warning me-3">20</span>
                                    <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                                    <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                                    <i class="fas fa-times text-muted fa-xs"></i>
                                </div>
                            </div>
                            <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">


                                <?php
                                foreach ($rows as $row){
                                    $isUser = $this->GetUserByID($activeID);
                                    if($activeID == $adminID){
                                        $active = $this->isUser($isUser[0]['id'], $isUser[0]['role']);
                                        $nonactive = $this->isUser($userID, 'investor');
                                    }if ($activeID == $userID){
                                        $active = $this->isUser($isUser[0]['id'], $isUser[0]['role']);
                                        $nonactive = $this->isUser($adminID, 'admin');
                                    }

                                    if($row['adminID'] == $_SESSION['id'] AND $row['ToFrom'] == 0 || $row['userID'] == $_SESSION['id'] AND $row['ToFrom'] == 1){
                                        ?>
                                        <div class="d-flex justify-content-start">
                                            <p class="small mb-1"><?= $active[0]['name'] .' '. $active[0]['surname'] ?> : <?= $this->timeAgo($row['dateAdded']) ?></p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-start"><!--
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                         alt="avatar 1" style="width: 45px; height: 100%;">-->
                                            <div>
                                                <p class="small p-2 ms-3 mb-3 text-white rounded-3 bg-primary" style="background-color: #f5f6f7;"><?= $row['message'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="d-flex justify-content-end">
                                            <p class="small mb-1"><?= $nonactive[0]['name'] .' '. $nonactive[0]['surname'] ?> : <?= $this->timeAgo($row['dateAdded']) ?></p>
                                        </div>
                                        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                            <div>
                                                <p class="small p-2 me-3 mb-3 justify-content-end text-right -text-white rounded-3 bg-secondary"><?= $row['message'] ?></p>
                                            </div><!--
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                         alt="avatar 1" style="width: 45px; height: 100%;">-->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <hr class="text-muted">



                                    <?php
                                }
                                ?>
                            </div>

                            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                                <div class="input-group mb-0">
                                    <input name="to" value="<?= $to ?>" hidden>
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" name="msg" placeholder="Type Message..." required>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Type message"
                                               aria-label="Recipient's username" aria-describedby="button-addon2" />
                                        <button class="btn btn-warning" type="button" id="button-addon2" style="padding-top: .55rem;">
                                            Send
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <?php
    }

    public function viewUpdateInvestment($iuID){
        $rows = $this->GetAllInvestmentsByuiID($iuID);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h5>Investment Details
                        </h5>
                        <hr>
                        <div class="pb-2" style="font-size: 13px"><strong>Investment ID: </strong><span><?php echo $iuID ?></span></div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h5>Investment Update Form
                        </h5>
                        <hr>
                        <form method="POST" action="includes/updateInvestment.inc.php">
                            <div class="form-group">
                                <input name="iuID" value="<?php echo $iuID ?>" hidden>

                                <div class="form-row row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" -class="col-form-label">Investment Name</label>
                                        <input name="name" type="text" class="form-control" value="<?php echo $rows[0]['name'] ?>" placeholder="Name of company or Investment Title" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" -class="col-form-label">Investment Returns(Profit or Loss)</label>
                                        <input name="returns" type="number" class="form-control" value="<?php echo $rows[0]['returns'] ?>" placeholder="Investment Returns Profit Or Loss" required>
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4" -class="col-form-label">Investment Category</label>
                                        <input name="category" type="text" class="form-control" value="<?php echo $rows[0]['category'] ?>" placeholder="e.g Fashion, Retails, IT, Trading, Transport, Wholesale..." required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4" -class="col-form-label">Investment Type</label>
                                            <select class="form-control" name="type" required>
                                                <option value="<?php echo $rows[0]['type'] ?>"><?php echo strtoupper($rows[0]['type']) ?> TERM INVESTMENT</option>
                                                <option value="short">SHORT TERM INVESTMENT</option>
                                                <option value="medium">MEDIUM TERM INVESTMENT</option>
                                                <option value="long">LONG TERM INVESTMENT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label  -class="col-form-label">Investment Description</label>
                                    <textarea name="description" type="text" class="form-control" placeholder="Investment description that will be shown to the investors"style="height: 200px" required><?php echo $rows[0]['description'] ?></textarea>
                                </div>

                                <br>
                                <div -class="modal-footer">
                                    <button name="btn_updateInvestment" type="submit"  class="btn btn-primary">Save changes</button>
                                </div>

                                <hr>

                                <div class="form-group col-md-5">
                                    <label  -class="col-form-label">Investments Limits</label>
                                    <table -id="datatable" class="table -table-bordered -dt-responsive -nowrap">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Short Term</th>
                                            <th>Medium Term</th>
                                            <th>Long Term</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!--<tr>
                                            <td></td>
                                            <td>$1000-$5000</td>
                                            <td>$6000-$12000</td>
                                            <td>$13000-$25000</td>
                                        </tr>-->
                                        <tr>
                                            <td><strong>Profit R</strong></td>
                                            <td>15% / 3 months <span class="mdi mdi-arrow-up"></span></td>
                                            <td>30% / 6 months <span class="mdi mdi-arrow-up"></span></td>
                                            <td>50% / 1 year <span class="mdi mdi-arrow-up"></span></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>



                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <?php
    }

    public function viewAllHistory(){
        $rows = $this->GetAllWithdrawalHistory();
        $s=0;
        foreach ($rows as $row){
            $investorRows = $this->GetInvestorByID($row['userID'])
            ?>
            <tr>
                <td><?php echo $s+=1  ?></td>
                <td><a href="userProfile.php?userID=<?php echo $row['userID'] ?>"><?php echo $investorRows[0]['name'] .' '. $investorRows[0]['surname'] ?></a></td>
                <td><a href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $row['iuID'] ?></a></td>
                <td>$<?php echo $row['amount']  ?></td>
                <td><?php echo $this->dateToDay($row['dateAdded']) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
            </tr>
            <?php
        }
    }


    public function viewHistory($userID){
        $rows = $this->GetWithdrawalByUserID($userID);
        $s=0;
        foreach ($rows as $row){
            ?>
            <tr>
                <td><?php echo $s+=1  ?></td>
                <td><a href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $row['iuID'] ?></a></td>
                <td>$<?php echo $row['amount']  ?></td>
                <td><?php echo $this->dateToDay($row['dateAdded']) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
            </tr>
            <?php
        }
    }


    public function viewWithdrawal($iuID){
        $rows = $this->GetAllInvestmentsByuiID($iuID);
        $investedRows = $this->GetInvestedByiuID($iuID);
        if(count($investedRows) > 0){
            $investorRows = $this->GetInvestorByID($investedRows[0]['userID']);
        }
        $totalInvested = $this->countTotalnv($iuID);

        $returns = $rows[0]['returns'];
        $invested = $investedRows[0]['amount'];

        $returns = $rows[0]['returns'];
        $invested = $investedRows[0]['amount'];
        $InvType = $rows[0]['type'];

        $withdrawalAmount = $this->CalcInvestProfitReturns($returns, $totalInvested, $invested, $InvType);
        ?>
        <form method="post" action="includes/withdraw.inc.php">
            <div class="modal-body">
                <div class="row">
                    <div>
                        <span style="font-size: 13px">Withdrawal Amount: $<?php echo $withdrawalAmount ?></span>
                        <hr>
                        <form>
                            <?php
                            if($withdrawalAmount <= 0){
                                ?>
                                <span class="btn btn-sm btn-danger disabled" style="font-size: 13px"><span class="mdi mdi-triangle"></span> Return is too low to withdraw</span>
                                <?php
                            }
                            else{
                                ?>
                                <span style="font-size: 13px">Withdrawal
                                        <form method="POST" action="includes/withdraw.inc.php">
                                            <input name="amount" value="<?php echo $withdrawalAmount ?>" hidden>
                                            <input name="iuID" value="<?php echo $iuID ?>" hidden>
                                            <button name="btn_withdraw" class="btn btn-sm btn-success" type="submit">$<?php echo $withdrawalAmount ?> <span class="mdi mdi-download"></span></button>
                                        </form>
                                      </span>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }

    public function viewInvestmentForm($iuID){
        $rows = $this->GetAllInvestmentsByuiID($iuID);
        if($rows[0]['type'] == 'short'){
            $min = '1';
            $max = '5000';
        }
        if($rows[0]['type'] == 'medium'){
            $min = '1';
            $max = '12000';
        }
        if($rows[0]['type'] == 'long'){
            $min = '1';
            $max = '25000';
        }
        ?>
        <form method="post" action="includes/invest.inc.php">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $this->investmentTypeDetails($iuID);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="inputEmail4" class="col-form-label">Investment Amount</label>
                        <input name="iuID" value="<?php echo $iuID ?>" hidden>
                        <input name="amount" type="number" min="<?php echo $min ?>" -max="<?php echo $max ?>" class="form-control" placeholder="Amount you wish to invest" required">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button name="btn_addUser" type="submit"  class="btn btn-primary">Save changes</button>
            </div>
        </form>
        <?php
    }


    public function ViewRequestDetails($rID){
        $rows = $this->GetRequestsByID($rID);
        $investorRows = $this->GetInvestorByID($rows[0]['userID']);
        $investmentRows = $this->GetAllInvestmentsByuiID($rows[0]['iuID']);

        if($rows[0]['response'] == 0){
            $re = 'Pending';
            $badge = 'primary';
        }
        elseif ($rows[0]['response'] == 1){
            $re = 'Approved';
            $badge = 'success';
        }
        else{
            $re = 'Declined';
            $badge = 'danger';
        }

        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h5>Request Details</h5>
                        <hr>
                        <div class="pb-3" style="font-size: 13px"><strong>Investment ID: </strong><span><a href="invetsmentDetails.php?iuID=<?php echo $rows[0]['iuID'] ?>"><?php echo $rows[0]['iuID'] ?></a></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Request From: </strong><span><a href="userProfile.php?userID=<?php echo $rows[0]['userID'] ?>"><?php echo $investorRows[0]['name'] .' '. $investorRows[0]['surname'] ?></a></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Requested On: </strong><span><?php echo $this->dateToDay($rows[0]['dateAdded'] ) ?> (<?php echo $this->timeAgo($rows[0]['dateAdded']) ?>)</span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Request Status: </strong><span class="badge badge-<?php echo $badge ?>"><?php echo $re ?></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Date Responded: </strong>
                            <span>
                                <?php
                                if($rows[0]['response'] == 0){
                                    ?>
                                    pending
                                    <?php
                                }
                                else{
                                    echo $this->dateToDay($rows[0]['dateResponded'] ) ?> (<?php echo $this->timeAgo($rows[0]['dateResponded']) ?>)
                                    <?php
                                }
                                ?>
                            </span>
                        </div>
                        <hr>
                        <div class="card rounded">
                            <div class="card-body">
                                <h5>Request Approval Form</h5>
                                <form method="POST" action="includes/approval.inc.php">
                                    <div class="form-row">
                                        <div class="pt-3">
                                            <label style="font-size: 13px">Current Status: <span class="badge badge-<?php echo $badge ?>"><?php echo $re ?></span></label>
                                            <div class="p-2">
                                                <input name="rID" value="<?php echo $rID ?>" hidden>
                                                <input name="iuID" value="<?php echo $rows[0]['iuID'] ?>" hidden>
                                                <select class="form-control form-select" name="response" required>
                                                    <option value="">-- SELECT APPROVAL RESPONSE --</option>
                                                    <option value="1">Approve</option>
                                                    <option value="2">Decline</option>
                                                </select>
                                            </div>

                                            <button type="submit" name="btn_approval" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h5>Request Documents</h5>
                        <?php
                        $this->viewDocLoop($rows[0]['iuID'], $rows[0]['userID'])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }



    public function viewMyRequests($userID){
        $rows = $this->GetRequestByUserID($userID);
        $s=0;
        foreach ($rows as $row) {
            $investorRows = $this->GetInvestorByID($row['userID']);
            $investmentRows = $this->GetAllInvestmentsByuiID($row['iuID']);

            if($row['response'] == 0){
                $re = 'Pending';
                $badge = 'primary';
            }
            elseif ($row['response'] == 1){
                $re = 'Approved';
                $badge = 'success';
            }
            else{
                $re = 'Declined';
                $badge = 'danger';
            }


            ?>
            <tr>
                <td><?php echo $s+=1 ?></td>
                <td><a href="userProfile.php?userID=<?php echo $row['userID'] ?>"><?php echo $investorRows[0]['name'] .' '. $investorRows[0]['surname'] ?></a></td>
                <td><a href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $row['iuID'] ?></a></td>
                <td><?php echo $this->dateToDay($row['dateAdded'] ) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
                <td><?php
                    if($row['response'] == 0){
                        ?>
                        pending
                        <?php
                    }
                    else{
                        echo $this->dateToDay($row['dateResponded'] ) ?> (<?php echo $this->timeAgo($row['dateResponded']) ?>)
                        <?php
                    }
                    ?>
                </td>
                <td><span class="badge badge-<?php echo $badge ?>"><?php echo $re ?></span></td>
                <td><a href="requestDetails.php?rID=<?php echo $row['id'] ?>">More <span class="mdi mdi-arrow-right"></span></a></td>
            </tr>
            <?php
        }
    }


    public function viewAllRequests(){
        $rows = $this->GetAllRequests();
        $s=0;
        foreach ($rows as $row) {
            $investorRows = $this->GetInvestorByID($row['userID']);
            $investmentRows = $this->GetAllInvestmentsByuiID($row['iuID']);

            if($row['response'] == 0){
                $re = 'Pending';
                $badge = 'primary';
            }
            elseif ($row['response'] == 1){
                $re = 'Approved';
                $badge = 'success';
            }
            else{
                $re = 'Declined';
                $badge = 'danger';
            }


            ?>
            <a>
            <td><?php echo $s+=1 ?></td>
            <td><a href="userProfile.php?userID=<?php echo $row['userID'] ?>"><?php echo $investorRows[0]['name'] .' '. $investorRows[0]['surname'] ?></a></td>
            <td><a href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $row['iuID'] ?></a></td>
            <td><?php echo $this->dateToDay($row['dateAdded'] ) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
            <td><?php
                if($row['response'] == 0){
                    ?>
                    pending
                    <?php
                }
                else{
                    echo $this->dateToDay($row['dateResponded'] ) ?> (<?php echo $this->timeAgo($row['dateResponded']) ?>)
                    <?php
                }
                ?>
            </td>
            <td><span class="badge badge-<?php echo $badge ?>"><?php echo $re ?></span></td>
            <td><a href="requestDetails.php?rID=<?php echo $row['id'] ?>">More <span class="mdi mdi-arrow-right"></span></a></td>
            </tr>
            <?php
        }
    }




    public function viewWithdraw($userID,$iuID){
        $rows = $this->GetInvestedByiuIDandUserID($iuID, $userID);
        $investmentRows = $this->GetAllInvestmentsByuiID($iuID);
        $InvType = $investmentRows[0]['type'];

        if($InvType == 'short'){
            //90 days OR 3 months
            $period = 90;
        }
        elseif($InvType == 'medium'){
            //180 days OR 6 months
            $period = 180;
        }
        elseif($InvType == 'long'){
            //365 days OR 12 months OR 1 year
            $period = 365;
        }

        $withdrwalDate =  date('Y-m-d', strtotime($rows[0]['withdrawInit']. ' + '.$period.' days'));



        ?>
        <span style="font-size: 13px" class="card-description">Next Withdrawal On: <?php echo $this->dateToDay($withdrwalDate) ?></span><br>
        <span style="font-size: 13px" class="card-description">Time Left : <?php echo $this->timeTogo($withdrwalDate) ?></span><br>

        <?php
        if($withdrwalDate <= date('Y-m-d')){
            ?>
            <hr>
            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawModal">Withdraw <span class="mdi mdi-cash"></span></a>
            <?php
        }
        ?>
        <hr>
        <span style="font-size: 13px" class="card-description"><a class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#terminateInvst" href="#!">Terminate My Investment</a></span><br>
        <?php
    }

    public function CalcInvestProfitReturns($returns, $totalInvested, $invested, $InvType){
        if($InvType == 'short'){
            $percentage = 15;
        }
        elseif($InvType == 'medium'){
            $percentage = 30;
        }
        elseif($InvType == 'long'){
            $percentage = 50;
        }

        //Calculate investment Percentage for each user
        $one = ($invested / $totalInvested) * 100;

        //calculate amount of each investment Percentage Found
        $two = ($one/100) * $returns;

        //Calculate Percent respective to invType
        $three = ($percentage/100) * $two;

        return round($three, 2);
    }


    public function viewInvestmentInvestors($iuID){
        $rows = $this->GetInvestedByiuID($iuID);
        $s=0;
        foreach ($rows as $row){
            $investorRows  = $this->GetInvestorByID($row['userID']);
            ?>
            <tr>
                <td><?php echo $s+=1 ?></td>
                <?php
                if($_SESSION['role'] == 'admin'){
                    ?>
                    <td><a href="userProfile.php?userID=<?php echo $row['userID'] ?>"><?php echo $investorRows[0]['name'] .' '. $investorRows[0]['surname'] ?></a></td>
                    <?php
                }
                else{
                    ?>
                    <td><?php echo $investorRows[0]['name'] .' '. $investorRows[0]['surname'] ?></td>
                    <?php
                }
                ?>
                <td><?php echo $this->dateToDay($row['dateAdded']) ?></td>
                <td>$<?php echo $row['amount'] ?></td>
            </tr>
            <?php
        }
    }


    public function viewInvestmentDetails($iuID, $userID){
        $rows = $this->GetAllInvestmentsByuiID($iuID);
        if(count($rows) > 0){
            $investedRows = $this->GetInvestedByiuIDandUserID($iuID, $userID);
            if(count($investedRows) > 0){
                $investorRows = $this->GetInvestorByID($investedRows[0]['userID']);
            }
            $totalInvested = $this->countTotalnv($iuID);

            if($rows[0]['returns'] > $totalInvested){
                $ret = 'success';
                $arrow = 'up';
            }
            elseif($rows[0]['returns'] < $totalInvested){
                $ret = 'danger';
                $arrow = 'down';
            }
            else{
                $ret = 'warning';
                $arrow = '';
            }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5>Investment Details
                                <?php
                                if($_SESSION['role'] == 'admin'){
                                    ?>
                                    | <span><a href="updateInvestment.php?iuID=<?php echo $iuID ?>"><span class="mdi mdi-circle-edit-outline">update</span></a></span>
                                    | <span><a onclick="return confirm('This investment investors will be erased too. Proceed?')" href="includes/deleteInv.inc.php?iuID=<?php echo $iuID ?>"><span class="mdi mdi-trash-can text-danger">delete</span></a></span>
                                    <?php
                                }
                                ?>
                            </h5>
                            <hr>
                            <div class="pb-2" style="font-size: 13px"><strong>Investment ID: </strong><span><?php echo $iuID ?></span></div>
                            <div class="pb-2" style="font-size: 13px"><strong>Investment Name: </strong><span><?php echo $rows[0]['name'] ?></span></div>
                            <div class="pb-2" style="font-size: 13px"><strong>Investment Type: </strong><span><?php echo $rows[0]['type'] ?> Term Invetsment</span></div>
                            <div class="pb-2" style="font-size: 13px"><strong>Investment Category: </strong><span><?php echo $rows[0]['category'] ?></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Date Added: </strong><span><?php echo $this->dateToDay($rows[0]['dateAdded']) ?> (<?php echo $this->timeAgo($rows[0]['dateAdded']) ?>)</span></div>
                            <div class="pb-2" style="font-size: 13px"><strong>Investment Description: </strong><br><span><?php echo $rows[0]['description'] ?> </span></div>

                        </div>
                    </div>
                </div>

                <?php
                $InvType = $rows[0]['type'];
                ?>

                <div class="col-md-6">
                    <div class="card rounded">
                        <div class="card-body">
                            <h5>Investment Financials</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="pb-2" style="font-size: 13px"><strong>Current Investors: </strong><span><?php echo count($investedRows) ?></span></div>
                                    <div class="pb-2" style="font-size: 13px"><strong>Total Invested: </strong><span>$<?php echo $totalInvested ?></span></div>
                                    <div class="pb-2" style="font-size: 13px"><strong>Total Returns: </strong><strong class="text-<?php echo $ret ?>">$<?php echo $rows[0]['returns'] ?><span class="mdi mdi-arrow-<?php echo $arrow ?>"></span> </strong></div>

                                    <?php
                                    if($_SESSION['role'] == 'investor'){
                                        $checkIn = $this->GetInvestedByiuIDandUserID($iuID, $_SESSION['id']);
                                        if(count($checkIn) > 0){
                                            ?>
                                            <hr>
                                            <div class="pb-2" style="font-size: 13px"><strong>Invested On: </strong><span><?php echo $this->dateToDay($investedRows[0]['dateAdded']) ?></span><br><span><?php echo $this->timeAgo($investedRows[0]['dateAdded']) ?></span></div>
                                            <div class="pb-2" style="font-size: 13px"><strong>My Invested Amount: </strong><span>$<?php echo $investedRows[0]['amount'] ?></span></div>
                                            <div class="pb-2" style="font-size: 13px"><strong>Current Withdrawal Amount: </strong><span>$<?php
                                                    $returns = $rows[0]['returns'];
                                                    $invested = $investedRows[0]['amount'];
                                                    echo $this->CalcInvestProfitReturns($returns, $totalInvested, $invested, $InvType);
                                                    ?>
                                            </span></div>
                                            <div>
                                                <hr>
                                                <div>
                                                    <?php $this->viewWithdraw($investedRows[0]['userID'], $iuID) ?>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        else{
                                            $requestRows = $this->GetRequestByUserIDandiuID($_SESSION['id'], $iuID);
                                            if(count($requestRows) > 0){
                                                if($requestRows[0]['response'] == 0){
                                                    ?>
                                                    <hr>
                                                    <br>
                                                    <span style="font-size: 13px"><strong>Requested: </strong> <span><?php echo $this->dateToDay($requestRows[0]['dateAdded']) ?> (<?php echo $this->timeAgo($requestRows[0]['dateAdded']) ?>)</span></span>
                                                    <div class="pt-3">
                                                        <span href="#!" class="alert alert-primary">Request Pending <span class="mdi mdi-rotate-orbit mdi-spin"></span></span>
                                                    </div>
                                                    <?php
                                                }
                                                elseif($requestRows[0]['response'] == 1){
                                                    ?>
                                                    <hr>
                                                    <br>
                                                    <div class="pt-3">
                                                        <span class="alert alert-success">Request Approved <a href="#!"  data-bs-toggle="modal" data-bs-target="#investModal" class="btn btn-success btn-sm rounded">Invest Now</a> </span>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <hr>
                                                    <br>
                                                    <div class="pt-3">
                                                        <span href="#!" class="alert alert-danger">Request Declined</span>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            else{
                                                ?>
                                                <hr>
                                                <a href="requestInvestment.php?iuID=<?php echo $iuID ?>" class="btn btn-outline-primary btn-sm rounded">Request Investment</a>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                </div>


                                <div class="col-md-6">
                                    <?php
                                    $this->investmentTypeDetails($iuID);
                                    ?>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <br>
            <hr>
            <br>

            <div class="col-md-12">
                <div id="--printableArea" class="card-box">
                    <h4 class="mt-0 header-title"></h4>
                    <p class="text-muted font-14 mb-3">
                        All investors on this Investment
                    </p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Surname</th>
                            <th>Invested On</th>
                            <th>Amount Invested</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $n = new Userview();
                        $n->viewInvestmentInvestors($iuID);
                        ?>
                        </tbody>


                    </table>
                </div>
            </div>


            <?php
        }
        else{
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="rounded">
                        <div class="card-body">
                            <span class="col-md-12 alert alert-danger">No Investment found with this ID</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }


    public function investmentTypeDetails($iuID){
        $rows = $this->GetAllInvestmentsByuiID($iuID);
        $InvType = $rows[0]['type'];
        ?>
        <div class="form-group">
            <div class="pb-2" style="font-size: 13px"><strong><?php echo $InvType ?> Term Investment Constraints: </strong></div>
            <table -id="datatable" class="table table-bordered -dt-responsive -nowrap">
                <thead>
                <tr>
                    <?php
                    if($InvType == 'short'){
                        ?>
                        <th>Short Term</th>
                        <?php
                    }
                    elseif($InvType == 'medium'){
                        ?>
                        <th>Medium Term</th>
                        <?php
                    }
                    elseif($InvType == 'long'){
                        ?>
                        <th>Long Term</th>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td><strong>Profit Returns</strong></td>
                    <?php
                    if($InvType == 'short'){
                        ?>
                        <td>15% / 3 months <span class="mdi mdi-arrow-up"></span></td>
                        <?php
                    }

                    if($InvType == 'medium'){
                        ?>
                        <td>30% / 6 months <span class="mdi mdi-arrow-up"></span></td>
                        <?php
                    }

                    if($InvType == 'long'){
                        ?>
                        <td>50% / 1 year <span class="mdi mdi-arrow-up"></span></td>
                        <?php
                    }
                    ?>


                </tr>
                </tbody>
            </table>

        </div>
        <?php
    }


    public function viewRandomString($legnth){
        $string = $this->generateRandomString($legnth);
        return $string;
    }

    public function countTotalnv($iuID){
        $rows = $this->GetInvestedByiuID($iuID);
        $totalInv = 0;
        foreach ($rows as $row){
            $totalInv +=  $row['amount'];
        }
        return $totalInv;
    }



    public function ViewInvestmentsBYUserID($id){
        $rows = $this->GetInvestedByUserID($id);
        $s=0;
        foreach ($rows as $row){
            $investedRows = $this->GetInvestedByiuID($row['iuID']);
            $investmentRows = $this->GetAllInvestmentsByuiID($row['iuID']);

            $totalInvested = $this->countTotalnv($row['iuID']);

            if($investmentRows[0]['returns'] > $totalInvested){
                $ret = 'success';
                $arrow = 'up';
            }
            elseif($investmentRows[0]['returns'] < $totalInvested){
                $ret = 'danger';
                $arrow = 'down';
            }
            else{
                $ret = 'warning';
                $arrow = '';
            }

            switch ($investmentRows[0]['type']){
                case 'short':
                    $color = 'primary';
                    break;
                case 'medium':
                    $color = 'success';
                    break;
                case 'long':
                    $color = 'warning';
                    break;
                default:
                    break;
            }




            ?>
            <tr>
                <td><?php echo $s+=1 ?></td>
                <td><a href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $row['iuID'] ?></a></td>
                <td><?php echo $investmentRows[0]['name'] ?></td>
                <td><span class="badge badge-<?php echo $color ?>"><?php echo $investmentRows[0]['type'] ?> Term Inv</span></td>
                <td><?php echo $this->dateToDay($row['dateAdded']) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
                <td><?php echo count($investedRows) ?></td>
                <td>$<?php echo $row['amount'] ?></td>
                <td><span class="badge badge-<?php echo $ret ?>">$<?php echo $investmentRows[0]['returns'] ?><span class="mdi mdi-arrow-<?php echo $arrow ?>"></span></span> </td>
            </tr>
            <?php
        }
    }


    public function ViewAllInvestments(){
        $rows = $this->GetAllInvestments();
        $s=0;
        foreach ($rows as $row){
            $investedRows = $this->GetInvestedByiuID($row['iuID']);

            $totalInvested = $this->countTotalnv($row['iuID']);

            if($row['returns'] > $totalInvested){
                $ret = 'success';
                $arrow = 'up';
            }
            elseif($row['returns'] < $totalInvested){
                $ret = 'danger';
                $arrow = 'down';
            }
            else{
                $ret = 'warning';
                $arrow = '';
            }

            switch ($row['type']){
                case 'short':
                    $color = 'primary';
                    break;
                case 'medium':
                    $color = 'success';
                    break;
                case 'long':
                    $color = 'warning';
                    break;
                default:
                    break;
            }




            ?>
            <tr>
                <td><?php echo $s+=1 ?></td>
                <td><a href="invetsmentDetails.php?iuID=<?php echo $row['iuID'] ?>"><?php echo $row['iuID'] ?></a></td>
                <td><?php echo $row['name'] ?></td>
                <td><span class="badge badge-<?php echo $color ?>"><?php echo $row['type'] ?> Term Inv</span></td>
                <td><?php echo $this->dateToDay($row['dateAdded']) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
                <td><?php echo count($investedRows) ?></td>
                <td>$<?php echo $totalInvested ?></td>
                <td><span class="badge badge-<?php echo $ret ?>">$<?php echo $row['returns'] ?><span class="mdi mdi-arrow-<?php echo $arrow ?>"></span></span> </td>
            </tr>
            <?php
        }
    }






    public function viewPatientAppointmentsLoopByAppID($patientID, $appDate, $doctorID){
        $appRows = $this->GetAppByAppID($patientID, $appDate, $doctorID);
        if(count($appRows) > 0){
            $s = 0;
            foreach ($appRows as $appRow){
                $patientRows = $this->GetPatientByID($appRow['patientID']);
                $doctorRows = $this->GetDoctorByID($appRow['doctorID']);
                $s++;
                ?>
                <tr>
                    <td><?php echo $s ?> </td>
                    <td><?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?></td>
                    <td><?php echo $doctorRows[0]['name'] .' '. $doctorRows[0]['surname'] ?></td>
                    <td><a href="appointmentDetails.php?appID=<?php echo $appRow['appointmentUID'] ?>"><?php echo $appRow['appointmentUID'] ?></a> </td>
                    <td><?php echo $this->dateToDay($appRow['appDateWork'])?> FROM <?php echo $appRow['appFrom'] ?> TO <?php echo $appRow['appTo'] ?> </td>
                </tr>
                <?php
            }
        }
    }


    public function viewPatientAppointmentsLoop($id){
        $appRows = $this->GetAppontmentByPatientID($id);
        if(count($appRows) > 0){
            $s = 0;
            foreach ($appRows as $appRow){
                $patientRows = $this->GetPatientByID($appRow['patientID']);
                $doctorRows = $this->GetDoctorByID($appRow['doctorID']);
                $s++;
                if($appRow['appDateWork'] > date('Y-m-d')){
                    $cl = 'success';
                }
                else{
                    $cl = 'danger';
                }

                ?>
                <tr>
                    <td class="rounded badge-<?php echo $cl ?>"><?php echo $s ?> </td>
                    <td><?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?></td>
                    <td><?php echo $doctorRows[0]['name'] .' '. $doctorRows[0]['surname'] ?></td>
                    <td><a href="appointmentDetails.php?appID=<?php echo $appRow['appointmentUID'] ?>"><?php echo $appRow['appointmentUID'] ?></a> </td>
                    <td class="badge-<?php echo $cl ?>" ><?php echo $this->dateToDay($appRow['appDateWork'])?> FROM <?php echo $appRow['appFrom'] ?> TO <?php echo $appRow['appTo'] ?> </td>
                </tr>
                <?php
            }
        }
    }

    public function viewDoctorAppointmentsLoop($id){
        $appRows = $this->GetAppontmentByDoctorID($id);
        if(count($appRows) > 0){
            $s = 0;
            foreach ($appRows as $appRow){
                $patientRows = $this->GetPatientByID($appRow['patientID']);
                $doctorRows = $this->GetDoctorByID($appRow['doctorID']);
                $s++;
                if($appRow['appDateWork'] > date('Y-m-d')){
                    $cl = 'success';
                }
                else{
                    $cl = 'danger';
                }
                ?>
                <tr>
                    <td class="rounded badge-<?php echo $cl ?>"><?php echo $s ?> </td>
                    <td><?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?></td>
                    <td><?php echo $doctorRows[0]['name'] .' '. $doctorRows[0]['surname'] ?></td>
                    <td><a href="appointmentDetails.php?appID=<?php echo $appRow['appointmentUID'] ?>"><?php echo $appRow['appointmentUID'] ?></a> </td>
                    <td class="badge-<?php echo $cl ?>" ><?php echo $this->dateToDay($appRow['appDateWork'])?> FROM <?php echo $appRow['appFrom'] ?> TO <?php echo $appRow['appTo'] ?> </td>
                </tr>
                <?php
            }
        }
    }


    public function viewAppointmentDetails($appID){
        $appRows = $this->GetAppontmentByAppID($appID);
        $doctorRows = $this->GetDoctorByID($appRows[0]['doctorID']);
        $patientRows = $this->GetPatientByID($appRows[0]['patientID'])
        ?>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span style="font-size: 13px" -class="fa">Appointment-ID: <?php echo $appRows[0]['appointmentUID'] ?></span>
                    <hr>
                    <div class="row">

                        <div class="col-md-6">
                            <h6>Doctor Details</h6>
                            <ul>
                                <li>Doctor name : <span class="text-decoration-underline"><a href="doctorDetails.php?userID=<?php echo $doctorRows[0]['userID'] ?>"><span class="fa fa-user"></span></span> Dr <?php echo $doctorRows[0]['name'] ?>  <?php echo $doctorRows[0]['surname'] ?> <span class="fa fa-chevron-right"></span> </a> </li>
        </ul>
        </div>

        <div class="col-md-6">
            <h6>Patient Details</h6>
            <ul>
                <li>Patient name :<a><span class="text-decoration-underline"><a href="patientSetup.php?userid=<?php echo $patientRows[0]['userID'] ?>"><span class="fa fa-user"></span> </span> <?php echo $patientRows[0]['name'] ?>  <?php echo $patientRows[0]['surname'] ?> <span class="fa fa-chevron-right"></span> </a></li>
            </ul>
        </div>
        <hr>
        <div class="row mt-2 text-center">
            <h6 class="card-header">Appointment</h6>
            <span class="p-1">Appointment Date: <?php echo $this->dateToDay($appRows[0]['appDateWork']) ?></span>
            <br>
            <span class="p-1">From: <?php echo $appRows[0]['appFrom'] ?></span>
            <br>
            <span class="p-1">To: <?php echo $appRows[0]['appTo'] ?></span>
            </span>
        </div>

        </div>

        </div>
        </div>
        </div>
        <?php
    }

    public function doctorOptionLoop(){
        $userRows = $this->GetAllDoctors();
        foreach ($userRows as $userRow){
            ?>
            <option value="<?php echo $userRow['userID'] ?>"> DR. <?php echo $userRow['name'] .' '. $userRow['surname'] ?> (<?php echo $userRow['category'] ?>)</option>
            <?php
        }
    }


    public function viewSetApointmentCheck($id){
        $userRows = $this->GetPatientByID($id);
        ?>

        <div class="row">
            <div class="col-md-12 border-right card rounded -card-body">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Set Appointment For <?php echo $userRows[0]['name'] .' '. $userRows[0]['surname'] ?></h4>
                    </div>
                    <hr>
                    <form class="form" method="post" action="includes/checkAppointment.inc.php?userID=<?php echo $id ?>" >
                        <span class="card-description">Input details to check if there are any appointments for the date you provide</span>
                        <br>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Appointment Date</label>
                                <input id="text" min="<?php echo date('Y-m-d', strtotime("+1 day")) ?>" name="AppDate" type="date" class="form-control" minlength="8" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Select Doctor</label>
                                <select class="form-control" name="doctorID">
                                    <?php
                                    echo $this->doctorOptionLoop();
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-2 pt-3">
                                <div class="col-md-3">
                                    <label class="labels">From</label>
                                    <input id="text" name="appFrom" type="time" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="labels">To</label>
                                    <input id="text" name="appTo" type="time" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        <div class="mt-5 text-center">
                            <button id="save-btn" name="btn_setApp" class="btn btn-primary" type="submit">Check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    public function viewSetApointment($patientID){
        $userRows = $this->GetPatientByID($patientID);
        $str=rand();
        $result = md5($str);
        ?>

        <div class="row">
            <div class="col-md-12 border-right card rounded -card-body">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Approve This Appointment For <?php echo $userRows[0]['name'] .' '. $userRows[0]['surname'] ?></h4>
                        <span class="fa" style="font-size: 13px">Appointment ID: <?php echo $result ?></span>
                    </div>
                    <hr>
                    <form class="form" method="post" action="includes/setAppointment.inc.php?appID=<?php echo $result ?>&userID=<?php echo $patientID ?>&doctorID=<?php echo $_GET['doctorID'] ?>" >
                        <div class="row mt-2 text-center">
                            <span style="font-size: 14px">
                                <?php
                                $doctorRows = $this->GetDoctorByID($_GET['doctorID']);
                                ?>
                                Doctor: <a href="doctorDetails.php?userID=<?php echo $doctorRows[0]['userID'] ?>"> DR <?php echo $doctorRows[0]['name'] ?> <?php echo $doctorRows[0]['surname'] ?></a>
                                <br>
                                Date: <?php echo $this->dateToDay($_SESSION['tempAppDate']) ?>
                                <br>
                                From: <?php echo $_SESSION['tempAppFrom'] ?>
                                <br>
                                To: <?php echo $_SESSION['tempAppTo'] ?>
                            </span>
                        </div>
                        <div class="mt-5 text-center">
                            <button id="save-btn" name="btn_setApp" class="btn btn-primary" type="submit">YES <span class="fa fa-check-circle"></span></button>
                            <a href="checkAppointment.php?userID=<?php echo $patientID ?>" id="save-btn" name="btn_cancelApp" class="btn btn-danger" type="">NO <span class="fa fa-times-circle"></span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }


    public function viewAppointmentsLoopByAppDate($patientID, $appDate, $doctorID){
        ?>
        <div id="--printableArea" class="card-box">
            <h4 class="mt-0 header-title"></h4>
            <p class="text-muted font-14 mb-3">
                All Patient's Appointments
            </p>
            <table id="datatable" class="table table-bordered dt-responsive nowrap">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Appointment ID</th>
                    <th>Appointment Date</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $n = new Userview();
                $n->viewPatientAppointmentsLoopByAppID($patientID, $appDate, $doctorID);
                ?>
                </tbody>


            </table>
        </div>
        <?php
    }






    public function receptionistProfile(){
        $userRows = $this->GetReceptionistByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <div class="row mt-3">
                                <div class="col-md-12 pt-3">
                                    <label class="labels">Hospital/Clinic Name</label>
                                    <input name="hospital" type="text" class="form-control" placeholder="Your Work Place Name..." value="<?php echo $userRows[0]['hospital'] ?>">
                                </div>
                            </div>

                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <?php
    }

    public function patientProfile(){
        $userRows = $this->GetPatientByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <label class="labels">National ID (<span class="card-description">xx-xxxxxxXxx</span>)</label>
                                    <input name="nationalID" type="text" class="form-control" placeholder="Legal National Identification Number" minlength="12" maxlength="12" value="<?php echo $userRows[0]['nationalID'] ?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">DOB (<span class="card-description"><?php echo $this->dateToDay($userRows[0]['dob']) ?></span>) </label>
                                    <input name="dob" type="date" class="form-control" placeholder="Date of birth" value="<?php echo $userRows[0]['dob'] ?>" max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="labels">Gender</label>
                                <select name="sex" type="text" class="form-control" required>
                                    <?php
                                    $n = new Userview();
                                    $n->validateUserGender($_SESSION['id'], 'patient');
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="number" class="form-control" placeholder="Please enter phone number" value="<?php echo $userRows[0]['phone'] ?>" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $userRows[0]['address'] ?>" required>
                                </div>


                            </div>


                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Medical Aid</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Provider</label>
                                    <input name="medicalName" type="text" class="form-control" placeholder="Medical Aid" value="<?php echo $userRows[0]['medicalAid'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Plan</label>
                                    <input name="medicalPlan" type="text" class="form-control" value="<?php echo $userRows[0]['medicalAidPlan'] ?>" placeholder="Medical Aid Plan" required>
                                </div>
                            </div>



                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Next Of Kin</h4>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Name</label>
                                    <input name="nokname" type="text" class="form-control" placeholder="Next Of Kin Name" value="<?php echo $userRows[0]['nextOfKinName'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Surname</label>
                                    <input name="noksurname" type="text" class="form-control" value="<?php echo $userRows[0]['nextOfKinSurname'] ?>" placeholder="Next Of Kin Suname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Next of kin's Phone</label>
                                    <input name="nokPhone" type="number" class="form-control" placeholder="Next Of Kin Phone" value="<?php echo $userRows[0]['nextOfKinPhone'] ?>" required>
                                </div>
                            </div>


                            <div class="mt-5 text-center">
                                <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function doctorProfile(){
        $userRows = $this->GetDoctorByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <br>
                            <div class="row mt-3">

                                <div class="col-md-12 pb-3">
                                    <label class="labels">Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter your/company email..." value="<?php echo $userRows[0]['email'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter phone number..." value="<?php echo $userRows[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Specialisatoin</label>
                                    <input name="category" type="text" class="form-control" placeholder="enter your specialisatoin e.g Dematologist..." value="<?php echo $userRows[0]['category'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Hospital/Clinic Name</label>
                                    <input name="hospital" type="text" class="form-control" placeholder="Your Work Place Name..." value="<?php echo $userRows[0]['hospital'] ?>">
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function pharmacistProfile($id){
        $userRows = $this->isUser($id, $_SESSION['role']);
        $rows = $this->GetUserByID($id);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-7 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <br>
                            <div class="row mt-3">

                                <div class="col-md-12 pb-3">
                                    <label class="labels">Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter your/company email..." value="<?php echo $userRows[0]['email'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter phone number..." value="<?php echo $userRows[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter your/company address..." value="<?php echo $userRows[0]['address'] ?>">
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div -class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Additional Settings</span>
                    </div>
                    <hr>
                    <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                    <br>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function adminProfile(){
        $userRows = $this->GetAdminByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function viewChangeUserPassword($id){
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updatePassword.inc.php" >

                            <div class="mt-5 text-center">
                                <button id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="profile.php" class="btn btn-dark align-items-center"> <span class="fa fa-user-edit"></span> Update Profile <span class="fa fa-arrow-right"></span></a>

                    </div>
                </div>

            </div>
        </div>
        <?php
    }


    public function userProfile($id){
        $rows = $this->GetUserByID($id);
        $userRows = $this->isUser($id, $rows[0]['role']);
        ?>


        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">

                <div class="col-md-12 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <div class="pb-3" style="font-size: 13px"><strong>Full Name: </strong><span><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname'] ?></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Account Type: </strong><span><?php echo $rows[0]['role'] ?> Account</span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Email Address: </strong><span><a href="mailto: <?php echo $userRows[0]['email'] ?>"><?php echo $userRows[0]['email'] ?></a></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Phone Number: </strong><span><?php echo $userRows[0]['phone'] ?></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Address: </strong><span><?php echo $userRows[0]['address'] ?></span></div>
                        <div class="pb-3" style="font-size: 13px"><strong>Date Joined: </strong><span>Joined: <?php echo $this->dateTimeToDay($rows[0]['joined']) ?> (<?php echo $this->timeAgo($rows[0]['joined']) ?>)</span></div>
                        <div>
                            <a href="messages.php?userID=<?= $id ?>&activeID=<?= $_SESSION['id'] ?>"><span class="fa fa-comment"> MESSAGE</span></a>
                        </div>
                    </div>


                    <a onclick="return confirm('Are you sure you want to reset user password?')" href="includes/resetUserPassword.inc.php?userID=<?php echo $id ?>" class="btn btn-outline-primary"> Reset User Password</a>

                </div>
            </div>
        </div>
        <?php
    }



    public function viewChangePassword(){
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updatePassword.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Current Password</label>
                                    <input name="op" type="password" class="form-control" placeholder="Current Password" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">New Password</label>
                                    <input id="password" name="np" type="password" class="form-control" placeholder="New Password" onkeyup='check();' minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Confirm New Password</label>
                                    <input id="confirmPassword" name="cp" type="password" class="form-control" placeholder="Confirm New Password" onkeyup='check();' minlength="8" required>
                                </div>
                            </div>

                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value ==
                                        document.getElementById('confirmPassword').value) {
                                        document.getElementById('message').style.color = 'green';
                                        document.getElementById("save-btn").disabled = false;
                                        document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span>Password matched</div>';
                                    }
                                    else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById("save-btn").disabled = true;
                                        document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span>New Password not matching Confirm Password</div>';
                                    }


                                }
                            </script>

                            <div>

                                <span id='message'></span>

                            </div>


                            <div class="mt-5 text-center">
                                <button id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="profile.php" class="btn btn-dark align-items-center"> <span class="fa fa-user-edit"></span> Update Profile <span class="fa fa-arrow-right"></span></a>

                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public function viewSearchResults($serach){
        $userRows = $this->searchPatientQuery($serach);
        $s = 0;
        ?>
        <div id="--printableArea" class="card-box">
            <h4 class="mt-0 header-title"></h4>
            <p class="text-muted font-14 mb-3">
                All Patient Accounts
            </p>
            <table id="datatable" class="table table-bordered dt-responsive nowrap">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>National-ID</th>
                    <th>Prescriptions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($userRows as $row){
                    $s++;
                    ?>
                    <tr>
                        <td><?php echo $s ?> </td>
                        <td><?php echo $userRows[0]['name'] ?></td>
                        <td><?php echo $userRows[0]['surname'] ?> </td>
                        <td><?php echo $userRows[0]['nationalID'] ?> </td>
                        <td><a href="medicalHistory.php?userid=<?php echo $row['userID'] ?>"> More <span class="fa fa-arrow-right"></span> </a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>


            </table>
        </div>
        <?php
    }

    public function viewPharmacistDetails($id){
        $pharmacistRows = $this->GetPharmacistByID($id);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Pharmacist Details</h4>
                    <hr>
                    <div class="row">

                        <div class="col-md-12">
                            <ul>
                                <li><span class="text-decoration-underline">Pharmacist name : </span> <?php echo $pharmacistRows[0]['name'] ?>  <?php echo $pharmacistRows[0]['surname'] ?> </li>
                                <li><span class="text-decoration-underline">Hospital/Clinic : </span> <?php echo $pharmacistRows[0]['joint'] ?> </li>
                                <li><span class="text-decoration-underline">Work Address : </span> <?php echo $pharmacistRows[0]['address'] ?> </li>
                                <li><span class="text-decoration-underline">Phone : </span> <a href="tell:<?php echo $pharmacistRows[0]['phone'] ?>"><?php echo $pharmacistRows[0]['phone'] ?></a></li>
                                <li><span class="text-decoration-underline">Email : </span> <a href="mailto:<?php echo $pharmacistRows[0]['email'] ?>"><?php echo $pharmacistRows[0]['email'] ?></a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewDoctorDetails($id){
        $doctorRows = $this->GetDoctorByID($id);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Doctor Details</h4>
                    <hr>
                    <div class="row">

                        <div class="col-md-12">
                            <ul>
                                <li><span class="text-decoration-underline">Doctor name : </span> Dr <?php echo $doctorRows[0]['name'] ?>  <?php echo $doctorRows[0]['surname'] ?> </li>
                                <li><span class="text-decoration-underline">Hospital/Clinic : </span> <?php echo $doctorRows[0]['hospital'] ?> </li>
                                <li><span class="text-decoration-underline">Specialisation : </span> <?php echo $doctorRows[0]['category'] ?> </li>
                                <li><span class="text-decoration-underline">Phone : </span> <a href="tell:<?php echo $doctorRows[0]['phone'] ?>"><?php echo $doctorRows[0]['phone'] ?></a></li>
                                <li><span class="text-decoration-underline">Email : </span> <a href="mailto:<?php echo $doctorRows[0]['email'] ?>"><?php echo $doctorRows[0]['email'] ?></a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserDiagnosisSummeryToPharmacist($id, $duID){
        $diagonisRow = $this->GetDiagnosisByUID($duID);
        $patientRows = $this->GetPatientByID($id);
        $doctorRows = $this->GetDoctorByID($diagonisRow[0]['doctorID']);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size: 15px" class="card-title card-header">Diagnosis FOR <?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?> ON  <?php echo $this->dateToDay($diagonisRow[0]['dateAdded']) ?></h6>
                    <p class="card-description">
                        The following are the all the diagnosis details recorded by <a style="font-size: 15px" href="doctorDetails.php?userID=<?php echo $diagonisRow[0]['doctorID'] ?>" class="fa fa-user" > DR <?php echo $doctorRows[0]['name']  ?></a>
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="medicalHistory.php?userID=<?php echo $id ?>" data-layout="button" data-size="large"><a href="medicalHistory.php?userid=<?php echo $id ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
                    </p>
                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Blood Pressure :</span> <?php echo $diagonisRow[0]['bloodPressure'] ?> mmHG </li>
                                <li><span class="text-decoration-underline">Pulse :</span> <?php echo $diagonisRow[0]['pulse']  ?> Bpm </li>
                                <li><span class="text-decoration-underline">Glucose :</span> <?php echo $diagonisRow[0]['glucose']  ?> Mmol </li>
                                <li><span class="text-decoration-underline">GCS :</span> <?php echo $diagonisRow[0]['gcs']  ?> </li>
                            </ul>
                        </div>


                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Temperature :</span> <?php echo $diagonisRow[0]['temp'] ?> &#176C </li>
                                <li><span class="text-decoration-underline">Weight :</span> <?php echo $diagonisRow[0]['weight']  ?> Kgs </li>
                                <li><span class="text-decoration-underline">Height :</span> <?php echo $diagonisRow[0]['height']  ?> Inchs </li>
                            </ul>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Diagnosis :</span><br><?php echo $diagonisRow[0]['diagnosis'] ?>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Additional Details :</span><br><?php echo $diagonisRow[0]['additional']  ?>
                        </div>

                    </div>

                    <br>
                    <hr>

                    <h5 class="card-header">Prescriptions Prescribed</h5>
                    <br>
                    <?php
                    $this->viewUserAddedPrescription($_GET['duID']);
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserDiagnosisSummery($id, $duID){
        $diagonisRow = $this->GetDiagnosisByUID($duID);
        $patientRows = $this->GetPatientByID($id);
        $doctorRows = $this->GetDoctorByID($diagonisRow[0]['doctorID']);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size: 15px" class="card-title card-header">Diagnosis FOR <?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?> ON  <?php echo $this->dateToDay($diagonisRow[0]['dateAdded']) ?></h6>
                    <p class="card-description">
                        The following are the all the diagnosis details recorded by <a style="font-size: 15px" href="doctorDetails.php?userID=<?php echo $diagonisRow[0]['doctorID'] ?>" class="fa fa-user" > DR <?php echo $doctorRows[0]['name']  ?></a>
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="medicalHistory.php?userID=<?php echo $id ?>" data-layout="button" data-size="large"><a href="medicalHistory.php?userid=<?php echo $id ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
                    </p>
                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Blood Pressure :</span> <?php echo $diagonisRow[0]['bloodPressure'] ?> mmHG </li>
                                <li><span class="text-decoration-underline">Pulse :</span> <?php echo $diagonisRow[0]['pulse']  ?> Bpm </li>
                                <li><span class="text-decoration-underline">Glucose :</span> <?php echo $diagonisRow[0]['glucose']  ?> Mmol </li>
                                <li><span class="text-decoration-underline">GCS :</span> <?php echo $diagonisRow[0]['gcs']  ?> </li>
                            </ul>
                        </div>


                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Temperature :</span> <?php echo $diagonisRow[0]['temp'] ?> &#176C </li>
                                <li><span class="text-decoration-underline">Weight :</span> <?php echo $diagonisRow[0]['weight']  ?> Kgs </li>
                                <li><span class="text-decoration-underline">Height :</span> <?php echo $diagonisRow[0]['height']  ?> Inchs </li>
                            </ul>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Diagnosis :</span><br><?php echo $diagonisRow[0]['diagnosis'] ?>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Additional Details :</span><br><?php echo $diagonisRow[0]['additional']  ?>
                        </div>

                    </div>

                    <hr>
                    <h5 class="card-header">Documents Added</h5>
                    <br>
                    <?php
                    $this->viewUserDocLoop($_GET['duID']);
                    ?>
                    <br>
                    <br>
                    <hr>

                    <h5 class="card-header">Prescriptions Prescribed</h5>
                    <br>
                    <?php
                    $this->viewUserAddedPrescription($_GET['duID']);
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    public function ViewPatientMedicalHistory($id){
        $userRows = $this->GetPatientByID($id);
        $diagnosisRows = $this->GetDiagnosisByUserID($id);
        $s = 0;
        foreach ($diagnosisRows as $diagnosisRow){
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $userRows[0]['name'] ?> <?php echo $userRows[0]['surname'] ?> </td>
                <td><a href="medicalHistoryDetails.php?duID=<?php echo $diagnosisRow["duID"] ?>&userID=<?php echo $id ?>"><?php echo $diagnosisRow["duID"] ?> <span class="fa fa-arrow-right"></span> </a></td>
                <td><?php echo $this->dateToDay($diagnosisRow['dateAdded']) ?> </td>
            </tr>
            <?php
        }
    }

    public function viewDiagnosisSummery($duID){
        $diagonisRow = $this->GetDiagnosisByUID($duID);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Diagnosis Detailed Summery</h4>
                    <p class="card-description">
                        The following are the all the diagnosis details you have provieded
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="addPrescription.php?duID=<?php echo $duID ?>" data-layout="button" data-size="large"><a href="addPrescription.php?duID=<?php echo $duID ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Edit <span class="fa fa-pencil"></span> </a></div>
                    </p>
                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Blood Pressure :</span> <?php echo $diagonisRow[0]['bloodPressure'] ?> mmHG </li>
                                <li><span class="text-decoration-underline">Pulse :</span> <?php echo $diagonisRow[0]['pulse']  ?> Bpm </li>
                                <li><span class="text-decoration-underline">Glucose :</span> <?php echo $diagonisRow[0]['glucose']  ?> Mmol </li>
                                <li><span class="text-decoration-underline">GCS :</span> <?php echo $diagonisRow[0]['gcs']  ?> </li>
                            </ul>
                        </div>


                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Temperature :</span> <?php echo $diagonisRow[0]['temp'] ?> &#176C </li>
                                <li><span class="text-decoration-underline">Weight :</span> <?php echo $diagonisRow[0]['weight']  ?> Kgs </li>
                                <li><span class="text-decoration-underline">Height :</span> <?php echo $diagonisRow[0]['height']  ?> Inchs </li>
                            </ul>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Diagnosis :</span><br><?php echo $diagonisRow[0]['diagnosis'] ?>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Additional Details :</span><br><?php echo $diagonisRow[0]['additional']  ?>
                        </div>

                    </div>

                    <hr>
                    <h5 class="card-header">Documents Added</h5>
                    <br>
                    <?php
                    $this->viewDocLoop($_GET['duID']);
                    ?>
                    <br>
                    <br>
                    <hr>

                    <h5 class="card-header">Prescriptions Prescribed</h5>
                    <br>
                    <?php
                    $this->viewAddedPrescription($_GET['duID']);
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserAddedPrescription($duID){
        $rows = $this->GetPrescriptionByduID($duID);
        if(count($rows) > 0){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>

                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span><b><u>Prescription:</u></b> <?php echo $row['prescription'] ?>
                        <br>
                        <br>
                    <span class="animated--grow-in fadeout text-dark"></span><b><u>Collected: </u></b>
                         <?php
                         if($row['isOffered'] == 1){
                             ?>
                             <span class="badge badge-success rounded fa">Yes <span class="fa fa-check"></span> </span>
                             ON <span style="font-size: 15px" class="fa text-decoration-underline"><?php echo $this->dateTimeToDay($row['dateCollected']) ?></span>

                            <?php
                             if($row['pharmacistID'] != 0){
                                 $pharmacistRows = $this->GetPharmacistByID($row['pharmacistID']);
                                 ?>
                                 By <span style="font-size: 15px" class="fa text-decoration-underline"><a href="pharmacistDetails.php?userID=<?php echo $row['pharmacistID']?>"><span class="fa fa-user"> <?php echo $pharmacistRows[0]['name'] ?> <?php echo $pharmacistRows[0]['surname'] ?></span> </a> </span>
                                 <?php
                             }
                             ?>

                             <?php
                         }
                         else{
                             ?>
                             <span class="badge badge-danger rounded fa">No <span class="fa fa-times"></span></span>
                             <?php
                             if($_SESSION['role'] == 'pharmacist'){
                                 ?>
                                 <div>
                                     <hr>
                                     <label class="fa card-description">Click the button if the patient has collected this prescription</label>
                                     <a class="btn btn-outline-primary" href="includes/collectPrescription.inc.php?duID=<?php echo $duID ?>&userID=<?php echo $_GET['userID'] ?>&pid=<?php echo $row['id'] ?>"onclick="return confirm('By clicking OKAY, you acknowledge that the patient has collected this prescription')">Mark As Offered</a>
                                 </div>
                                 <?php
                             }

                         }
                         ?>
                </span>
                    <br>
                    <br>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>No Prescriptions Where Provided
                    </span>

                </div>
            </div>
            <?php
        }
    }


    public function viewAddedPrescription($duID){
        $rows = $this->GetPrescriptionByduID($duID);
        if(count($rows) > 0){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>

                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span><b><u>Prescription:</u></b> <?php echo $row['prescription'] ?>
                </span>
                    <br>
                    <a style="float: right; color: firebrick; font-size:15px" onclick="return confirm('Are you sure you want to proceed removing this qualification?')" href="includes/deletePrescription.inc.php?pID=<?php echo $row['id'] ?>&duID=<?php echo $_GET['duID'] ?>" class="closebtn" data-bs-dismiss="toast" aria-label="Close">
                        <span class="fa fa-trash"></span>
                    </a>
                    <br>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>Added Prescriptions will appear here
                    </span>

                </div>
            </div>
            <?php
        }
    }

    public function viewDocLoop($iuID, $userID){
        $rows = $this->GetDocs($iuID, $userID);
        if(count($rows) > 0){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <div class="">
                        <a href="<?php echo $row['source'] ?>">
                            <?php
                            if($row['ext'] == 'jpeg' OR $row['ext'] == 'jpg' OR $row['ext'] == 'png'){
                                ?>
                                <img class="img-fluid rounded border border-secondary" style="height: 60px" src="<?php echo $row['source']  ?>" >
                                <br>
                                <label>Image(<?php echo $row['ext'] ?>)</label>
                                <?php
                            }
                            else{
                                ?>
                                <img class="img-fluid rounded border border-secondary" style="height: 60px" src="../img/docR.png" >
                                <br>
                                <label>Document(<?php echo $row['ext'] ?>)</label>
                                <?php
                            }
                            ?>
                        </a>
                        <br>
                        <br>
                    </div>
                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span>Title: <?php echo $row['title'] ?>
                </span>
                    <br>
                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span>Description: <?php echo $row['description'] ?>
                </span>
                    <?php
                    if($_SESSION['role'] != 'admin'){
                        ?>
                        <a style="float: right; color: firebrick; font-size:15px" onclick="return confirm('Are you sure you want to proceed removing this qualification?')" href="includes/deleteDoc.inc.php?docID=<?php echo $row['id'] ?>&iuID=<?php echo $_GET['iuID'] ?>" class="closebtn" data-bs-dismiss="toast" aria-label="Close">
                            <span class="mdi mdi-trash-can"></span>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>Uploaded Documents will appear here
                    </span>

                </div>
            </div>
            <?php
        }

    }

    public function viewAddDiagnosis($id){
        $rows = $this->GetUserByID($id);
        $userRow = $this->GetPatientByID($id);

        $str=rand();
        $result = md5($str);
        ?>
        <h4 class="mt-0 text-muted header-title pt-4">
            Diagnosis for <?php echo $userRow[0]['name'] .' '. $userRow[0]['surname'] ?>
        </h4>
        <hr>
        <br>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 -class="card-title">Diagnosis date: <?php echo $this->dateToDay(date('Y-m-d')) ?></h6>
                    <p class="card-description">
                        <br>
                    </p>
                    <form class="form-inline" method="POST" action="includes/addDiagnosis.inc.php?userid=<?php echo $_GET['userid'] ?>">
                        <div class="col-md-6 row pb-3">
                            <input name="duid" type="text" value="<?php echo $result ?>" hidden>
                            <div class="col-md-6">
                                <label class="font-10" for="inlineFormInputName2">Name</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="" value="<?php echo $userRow[0]['name'] ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="font-10" for="inlineFormInputName2">Surname</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="" value="<?php echo $userRow[0]['surname'] ?>" disabled>
                            </div>
                        </div>

                        <hr>
                        <h4>Vital Signs</h4>
                        <br>

                        <div class="row">
                            <div class="col-md-6 row pb-3">

                                <div class="col-md-6">
                                    <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Blood Pressure </label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">mmHG</div>
                                        </div>
                                        <input name="bloodPressure" type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Blood Pressure" required>
                                    </div>

                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Pulse</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">Bpm</div>
                                        </div>
                                        <input name="pulse" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Heart Pulse" required>
                                    </div>


                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Glucose</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">mmol</div>
                                        </div>
                                        <input name="glucose" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Glucose/ Suger Levels" required>
                                    </div>

                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">GCS</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">#</div>
                                        </div>
                                        <input name="gcs" type="number" class="form-control" -id="inlineFormInputGroupUsername2" placeholder="Enter GCS 1-15" max="15" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Temperature</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">&#176C</div>
                                        </div>
                                        <input name="temp" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Temperature in &#176C" required>
                                    </div>

                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Weight</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">Kg</div>
                                        </div>
                                        <input name="weight" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Weight in Kilograms" required>
                                    </div>


                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Height</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">Inch</div>
                                        </div>
                                        <input name="height" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Height in Inches" required>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Diagnosis in detail</label>
                                <div class="input-group -mb-2 -mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary"><span class="fa fa-pencil"></span></div>
                                    </div>
                                    <textarea name="diagnosis" type="text" class="form-control" style="height: 111px" id="inlineFormInputGroupUsername2" placeholder="Provide Detailed disgnosis" required></textarea>
                                </div>

                                <br>

                                <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Additional Details (optional)</label>
                                <div class="input-group -mb-2 -mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary"><span class="fa fa-pencil"></span></div>
                                    </div>
                                    <textarea name="additional" type="text" class="form-control" style="height: 111px" id="inlineFormInputGroupUsername2" placeholder="Provide Additional Details e.g Alleges"></textarea>
                                </div>


                            </div>

                        </div>
                        <br>
                        <button name="btn_addDiagnosis" type="submit" class="btn btn-primary mb-2">Next <span class="fa fa-chevron-circle-right"></span> </button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    public function validateUserGender($id, $role){
        $rows = $this->isUser($id, $role);
        if($rows[0]['sex'] == 'm'){
            ?>
            <option value="m">Male</option>
            <option value="f">Female</option>
            <?php
        }
        elseif($rows[0]['sex'] == 'f'){
            ?>
            <option value="f">Female</option>
            <option value="m">Male</option>
            <?php
        }
        else{
            ?>
            <option value="">-- Select Gender --</option>
            <option value="m">Male</option>
            <option value="f">Female</option>
            <?php
        }
    }

    public function patientSetup($id){
        $rows = $this->GetUserByID($id);
        $userRow = $this->GetPatientByID($id);
        ?>
        <?php
        if($_SESSION['role'] == 'receptionist'){
            ?>
            <a href="checkAppointment.php?userID=<?php echo $id ?>" class="btn btn-outline-primary"> <span class="fa fa-meetup"></span> Appointment <span class="fa fa-chevron-right"></span> </a>
            <?php
        }
        ?>

        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRow[0]['name'] .' '. $userRow[0]['surname']   ?></span>
                        <span class="text-black-50"><?php echo $userRow[0]['phone'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Patient's Personal Details</h4>

                        </div>
                        <form method="post" action="includes/updatePatientDetails.inc.php?userid=<?php echo $_GET['userid'] ?>" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">LoginID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="first name" value="<?php echo $rows[0]['loginID']  ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <label class="labels">National ID (<span class="card-description">xx-xxxxxxXxx</span>)</label>
                                    <input name="nationalID" type="text" class="form-control" placeholder="Legal National Identification Number" minlength="12" maxlength="12" value="<?php echo $userRow[0]['nationalID'] ?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRow[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRow[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">DOB</label>
                                    <input name="dob" type="date" class="form-control" placeholder="Date of birth" value="<?php echo $userRow[0]['dob'] ?>" max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="labels">Gender</label>
                                <select name="sex" type="text" class="form-control" required>
                                    <?php
                                    $n = new Userview();
                                    $n->validateUserGender($_GET['userid'], 'patient');
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="number" class="form-control" placeholder="Please enter phone number" value="<?php echo $userRow[0]['phone'] ?>" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $userRow[0]['address'] ?>" required>
                                </div>


                            </div>


                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Medical Aid</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Provider</label>
                                    <input name="medicalName" type="text" class="form-control" placeholder="Medical Aid" value="<?php echo $userRow[0]['medicalAid'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Plan</label>
                                    <input name="medicalPlan" type="text" class="form-control" value="<?php echo $userRow[0]['medicalAidPlan'] ?>" placeholder="Medical Aid Plan" required>
                                </div>
                            </div>



                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Next Of Kin</h4>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Name</label>
                                    <input name="nokname" type="text" class="form-control" placeholder="Next Of Kin Name" value="<?php echo $userRow[0]['nextOfKinName'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Surname</label>
                                    <input name="noksurname" type="text" class="form-control" value="<?php echo $userRow[0]['nextOfKinSurname'] ?>" placeholder="Next Of Kin Suname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Next of kin's Phone</label>
                                    <input name="nokPhone" type="number" class="form-control" placeholder="Next Of Kin Phone" value="<?php echo $userRow[0]['nextOfKinPhone'] ?>" required>
                                </div>
                            </div>


                            <div class="mt-5 text-center">
                                <button name="btn_updatePatient" class="btn btn-primary" type="submit">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public function CountView($query){
        $rows = $this->GetCountView($query);
        echo count($rows);
    }

    public function ViewAllPatienceAccounts(){
        $rows = $this->GetAllUser();
        $s = 0;
        foreach ($rows as $row)
        {
            if($row['role'] == 'patient'){
                $newID = $row['id'];
                $rowsUser = $this->GetPatientByID($newID);
                $color = '#d9534f';
                $s++;
                ?>

                <tr>
                    <td><?php echo $s ?> </td>
                    <td><?php echo $rowsUser[0]["name"] ?> </td>
                    <td><?php echo $rowsUser[0]["surname"] ?></td>
                    <td><?php echo $rowsUser[0]['nationalID'] ?></td>
                    <td><span style="color: <?php echo $color ?>" class="badge bg-white rounded"><?php echo $row["role"] ?></span> </td>
                    <td><a href="patientSetup.php?userid=<?php echo $newID ?>"><span class="fa fa-pencil badge badge-primary"> More <span class="fa fa-chevron-circle-right"></span> </span></a></td>
                </tr>

                <?php
            }
        }
    }

    public function ViewAllUsers(){
        $rows = $this->GetAllUser();
        $s = 0;
        foreach ($rows as $row)
        {
            if($row['role'] == 'admin'){
                $rowsUser = $this->isUser($row['id'], $row['role']);
                $color = '#00a65a';
            }
            elseif ($row['role'] == 'investor'){
                $rowsUser = $this->isUser($row['id'], $row['role']);
                $color = '#f39c12';
            }
            else{
                return NULL;
            }


            $s++;
            ?>

            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $rowsUser[0]["name"] ?> </td>
                <td><?php echo $rowsUser[0]["surname"]; ?></td>
                <td><span style="color: <?php echo $color ?>" class="badge bg-white rounded"><?php echo $row["role"] ?></span> </td>
                <td><?php
                    if($row['status'] == 1) {
                        ?>
                        <span class="badge badge-success rounded">active</span>
                        <?php
                    }
                    else{
                        ?>
                        <span class="badge badge-danger rounded">Inactive</span>
                        <?php
                    }
                    ?>

                </td>
                <td>
                    <a href="userProfile.php?userID=<?php echo $row['id'] ?>"><span class="fa fa-pencil badge badge-primary"> More <span class="fa fa-chevron-circle-right"></span> </span></a>
                </td>
            </tr>

            <?php
        }
    }

}
