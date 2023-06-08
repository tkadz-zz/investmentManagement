<?php


class Users extends Dbh{


    protected function topUpBalance($balance, $userID){
        $sql = "UPDATE bank SET balance=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$balance, $userID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] =' Bank Balance Updated.';
            echo "<script type='text/javascript'>;
                      window.location='../bank.php';
                    </script>";
        }else{
            $this->opps();
        }
    }

    protected function activateBank($userID){
        $initialBalance = 0;
        $sql = "INSERT INTO bank (userID, balance) VALUES (?,?)";
        $stmt = $this->con()->prepare($sql);
        if(!$stmt->execute([$userID, $initialBalance])){
            $this->opps();
        }else{
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Bank Account is now active,Please top up your balance';
            echo "<script type='text/javascript'>;
                      window.location='../bank.php';
                    </script>";
        }
    }

    protected function upateRates($type, $percentage, $period){
        $sql = "UPDATE interest SET percentage=?, period=? WHERE type=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$percentage, $period, $type])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = $type .' term investment updated';
            echo "<script type='text/javascript'>;
                      window.location='../interests.php';
                    </script>";
        }else{
            $this->opps();
        }
    }

    protected function delMsg($msgID){
        $sql = "DELETE FROM messages WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$msgID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Message Deleted';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }else{
            $this->opps();
        }
    }

    protected function GetActiveAdminMail($adminID){
        $active = 1;
        $toFrom = 1;
        $sql = "SELECT * FROM messages WHERE adminID=? AND ToFrom=? AND status=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$adminID, $toFrom, $active]);
        return $stmt->fetchAll();
    }

    protected function GetActiveUserMail($userID){
        $active = 1;
        $toFrom = 0;
        $sql = "SELECT * FROM messages WHERE userID=? AND ToFrom=? AND status=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID, $toFrom, $active]);
        return $stmt->fetchAll();
    }


    protected function updateUserReadStatus($userID, $adminID){
        $rows = $this->GetUserMessages($userID, $adminID);
        foreach ($rows as $row){
            if($row['ToFrom'] == 0){
                $tofrom=0;
                $newStatus=0;
                $sql = "UPDATE messages SET status=? WHERE userID=? AND adminID=? and ToFrom=?";
                $stmt = $this->con()->prepare($sql);
                $stmt->execute([$newStatus, $userID, $adminID,$tofrom]);
            }
        }
    }


    protected function updateAdminReadStatus($userID, $adminID){
        $rows = $this->GetUserMessages($userID, $adminID);
        foreach ($rows as $row){
            if($row['ToFrom'] == 1){
                $tofrom=1;
                $newStatus=0;
                $sql = "UPDATE messages SET status=? WHERE userID=? AND adminID=? and ToFrom=?";
                $stmt = $this->con()->prepare($sql);
                $stmt->execute([$newStatus, $userID, $adminID,$tofrom]);
            }
        }
    }


    protected function GetActiveAdminMsgsByAdminID($adminID, $userID){
        $active = 1;
        $sql = "SELECT * FROM messages WHERE adminID=? AND userID=? AND status=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$adminID, $userID, $active]);
        return $stmt->fetchAll();
    }

    protected function GetAllUserBYRole($role){
        $sql = "SELECT * FROM users WHERE role=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$role]);
        return $stmt->fetchAll();
    }


    protected function sendMsg($adminID, $userID, $msg, $tofrom){
        $status = 1;
        $today = date('Y-m-d H:i:s');
        $sql = "INSERT INTO messages(adminID, userID, ToFrom, status, message, dateAdded) VALUES (?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$adminID, $userID, $tofrom, $status, $msg, $today])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Sent';

            if($tofrom == 0){
                //toadmin || fromUser
                $hre = "userID=" . $userID;
            }else{
                //toUser || fromAdmin
                $hre = "adminID=" . $adminID;
            }

            echo "<script type='text/javascript'>;
                      window.location='../messages.php?$hre';
                    </script>";
        }else{
            $this->opps();
        }
    }

    protected function GetUserMessages($userID, $adminID){
        $sql = "SELECT * FROM messages WHERE userID=? AND adminID=? ORDER BY id ASC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID, $adminID]);
        return $stmt->fetchAll();
    }

    protected function GetMessagesByInvestorID($userID){
        $sql = "SELECT * FROM messages WHERE investorID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }

    protected function delInv($iuID){
        $sql1 = "DELETE FROM investments WHERE iuID=?";
        $sql2 = "DELETE FROM invested WHERE iuID=?";
        $sql3 = "DELETE FROM request WHERE iuID=?";
        $sql4 = "DELETE FROM docs WHERE iuID=?";
        $sql5 = "DELETE FROM withdraw WHERE iuID=?";

        $stmt1 = $this->con()->prepare($sql1);
        $stmt2 = $this->con()->prepare($sql2);
        $stmt3 = $this->con()->prepare($sql3);
        $stmt4 = $this->con()->prepare($sql4);
        $stmt5 = $this->con()->prepare($sql5);

        if($stmt1->execute([$iuID]) AND $stmt2->execute([$iuID]) AND $stmt3->execute([$iuID]) AND $stmt4->execute([$iuID]) AND $stmt5->execute([$iuID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Investment Deleted';
            echo "<script type='text/javascript'>;
                      window.location='../invetsments.php';
                    </script>";
        }
        else{
            $this->opps();
        }

    }

    protected function terminateInv($iuID, $userID){
        $sql = "DELETE FROM invested WHERE iuID=? AND userID=?";
        $sql1 = "DELETE FROM withdraw WHERE iuID=? AND userID=?";
        $sql2 = "DELETE FROM request WHERE iuID=? AND userID=?";
        $sql3 = "DELETE FROM docs WHERE iuID=? AND userID=?";

        $stmt = $this->con()->prepare($sql);
        $stmt1 = $this->con()->prepare($sql1);
        $stmt2 = $this->con()->prepare($sql2);
        $stmt3 = $this->con()->prepare($sql3);

        if($stmt->execute([$iuID, $userID]) AND $stmt1->execute([$iuID, $userID]) AND $stmt2->execute([$iuID, $userID]) AND $stmt3->execute([$iuID, $userID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Investment Termination Successful';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            $this->opps();
        }

    }


    protected function updateInvestment($iuID, $name, $type, $description, $category, $returns){
        $sql = "UPDATE investments SET name=?, type=?, description=?, category=?, returns=? WHERE iuID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $type, $description, $category, $returns, $iuID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Investment Details Updated Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../invetsmentDetails.php?iuID=$iuID';
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function withdraw($amount, $iuID, $userID){
        $today = date('Y-m-d H:i:s');
        $sql = "INSERT INTO withdraw(userID, iuID, amount, dateAdded) VALUES(?,?,?,?)";
        $stmt = $this->con()->prepare($sql);

        $sql1 = "UPDATE invested SET withdrawInit=? WHERE userID=? AND iuID=?";
        $stmt1 = $this->con()->prepare($sql1);

        $sql2  = "DELETE FROM invested WHERE userID=? AND iuID=?";
        $stmt2 = $this->con()->prepare($sql2);

        if($stmt->execute([$userID, $iuID, $amount, $today]) AND $stmt1->execute([$today, $userID, $iuID]) AND $stmt2->execute([$userID, $iuID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Withdrawal of $'.$amount.' on Investment ID '.$iuID.' was Successful';
            echo "<script type='text/javascript'>;
                      window.location='../invetsmentDetails.php?iuID=$iuID';
                    </script>";
        }


    }

    protected function invest($amount, $iuID, $userID){

        $bankRows = $this->GetBankByUserID($userID);
        if(count($bankRows) < 1){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Please Activate Your Bank Account';
            echo "<script type='text/javascript'>;
                      window.location='../invetsmentDetails.php?iuID=$iuID';
                    </script>";
        }else {

            if($bankRows[0]['balance'] < $amount){
                $balance = $bankRows[0]['balance'];
                $_SESSION['type'] = 'i';
                $_SESSION['err'] = 'You have insufficient funds in your bank account to invest.Your current balance is $'.$balance.' .Please adjust your investment amount or top up you bank account';
                echo "<script type='text/javascript'>;
                      window.location='../invetsmentDetails.php?iuID=$iuID';
                    </script>";
            }else {
                $today = date('Y-m-d H:i:s');
                $status = 1;
                $sql = "INSERT INTO invested(userID, iuID, amount, withdrawInit, dateAdded, status) VALUES (?,?,?,?,?,?)";
                $stmt = $this->con()->prepare($sql);

                $sql1 = "DELETE FROM request WHERE userID=? AND iuID=?";
                $stmt1 = $this->con()->prepare($sql1);

                $balance = $bankRows[0]['balance'];
                $newBalance = $balance - $amount ;

                $sql2 = "UPDATE bank SET balance=? WHERE userID=?";
                $stmt2 = $this->con()->prepare($sql2);
                $stmt2->execute([$newBalance, $userID]);

                if ($stmt->execute([$userID, $iuID, $amount, $today, $today, $status]) and $stmt1->execute([$userID, $iuID])) {
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Investment of $' . $amount . ' to Investment ID ' . $iuID . ' was Successful. New Bank Balance is $' . $newBalance .'.' ;
                    echo "<script type='text/javascript'>;
                      window.location='../invetsmentDetails.php?iuID=$iuID';
                    </script>";
                } else {
                    $this->opps();
                }
            }
        }
    }

    protected function requestApproval($response, $rID, $iuID, $userID){
        $today = date('Y-m-d H:i:s');
        $sql = "UPDATE request SET response=?, dateResponded=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$response, $today, $rID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Investment Request Response Successful';
            echo "<script type='text/javascript'>;
                      window.location='../requestDetails.php?rID=$rID';
                    </script>";
        }
        else{
            $this->opps();
        }
    }


    protected function finilizeRequest($iuID, $userID){
        $today = date('Y-m-d H:i:s');
        $response = 0;
        $blank = '';
        $sql = "INSERT INTO request(iuID, userID, response, dateAdded, dateResponded) VALUES (?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$iuID, $userID, $response, $today, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Investment Request Sent Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../invetsmentDetails.php?iuID=$iuID';
                    </script>";
        }
        else{
            $this->opps();
        }
    }


    protected function updateProfile($name, $surname, $email, $phone, $address, $loginID, $id){
        $role = $_SESSION['role'];
        $isYou = $this->isUser($id, $_SESSION['role']);
        $sql = "UPDATE $role SET name=?, surname=?, email=?, phone=?, address=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $email, $phone, $address, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $this->opps();
        }
    }


    protected function addInvestment($uiID, $name, $type, $description, $category){
        $today = date('Y-m-d H:i:s');
        $sql = "INSERT INTO investments(iuID, name, type, description, category, returns, dateAdded, status) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $zero = 0;
        $one = 1;
        if($stmt->execute([$uiID, $name, $type, $description, $category, $zero, $today, $one])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Investment Added Successfully';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function resetUserPassword($id){
        $pass = '';
        $sql = "UPDATE users SET password=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$pass, $id])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Password Reset Successfully';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Opps! Something went wrong';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
    }


    protected function GetAppByAppID($patientID, $appDate, $doctorID){
        $sql = "SELECT * FROM appointments WHERE appDateWork=? AND doctorID=? ORDER BY id ASC ";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$appDate, $doctorID]);
        return $stmt->fetchAll();
    }



    protected function GetRequestByUserID($userID){
        $sql = "SELECT * FROM request WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }

    protected function GetRequestsByID($rID){
        $sql = "SELECT * FROM request WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$rID]);
        return $stmt->fetchAll();
    }

    protected function GetAllRequests(){
        $sql = "SELECT * FROM request ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    protected function checkAppointment($patientID, $appDate,$appFrom, $appTo, $doctorID){
        $sql = "SELECT * FROM appointments WHERE appDateWork=? AND doctorID=? ORDER BY id ASC ";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$appDate, $doctorID]);
        $rows = $stmt->fetchAll();
        $c = 0;

        if(count($rows) > 0){
            $c++;
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Showing Appointments on '.$this->dateToDay($appDate) ;
            $_SESSION['tempAppDate'] = $appDate;
            $_SESSION['tempAppFrom'] = $appFrom;
            $_SESSION['tempAppTo'] = $appTo;

            echo "<script type='text/javascript'>;
                      window.location='../setAppointment.php?doctorID=$doctorID&userID=$patientID&num=$c';
                    </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'No Appointments on '.$this->dateToDay($appDate) ;
            $_SESSION['tempAppDate'] = $appDate;
            $_SESSION['tempAppFrom'] = $appFrom;
            $_SESSION['tempAppTo'] = $appTo;

            echo "<script type='text/javascript'>;
                      window.location='../setAppointment.php?doctorID=$doctorID&userID=$patientID';
                    </script>";
        }

    }


    protected function setAppointment($patientID, $doctorID, $appDate, $appFrom, $appTo, $appID){

        $dateAdded = date("Y-m-d h:m:i");
        $att = 0;
        $sql = "INSERT INTO appointments(appointmentUID, patientID, doctorID, appDateWork, AppFrom, appTo, attendance, dateAdded) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$appID, $patientID, $doctorID, $appDate,$appFrom, $appTo, $att, $dateAdded])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Appointment Set Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../appointmentDetails.php?appID=$appID';
                    </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Contact Admin';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
    }

    protected function updateReceptionistProfile($name, $surname, $hospital, $loginID, $id){
        $sql = "UPDATE receptionist SET name=?, surname=?, hospital=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $hospital, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }

    protected function updatePatientProfile($loginID, $name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname,$nokPhone, $id){
        $sql = "UPDATE patient SET name=?, surname=?, nationalID=?, dob=?, sex=?, phone=?, address=?, medicalAid=?, medicalAidPlan=?, nextOfKinName=?, nextOfKinSurname=?, nextOfKinPhone=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname,$nokPhone, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }

    protected function updateDoctorProfile($name, $surname, $email, $phone, $hospital, $category, $loginID, $id){
        $sql = "UPDATE doctor SET name=?, surname=?, email=?, phone=?, hospital=?, category=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $email, $phone, $hospital, $category, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
    }

    protected function updatePharmacistProfile($name, $surname, $email, $phone, $address, $joint, $loginID, $id){
        $sql = "UPDATE pharmacist SET name=?, surname=?, email=?, phone=?, address=?, joint=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $email, $phone, $address, $joint, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
    }

    protected function updateAdminProfile($name, $surname, $loginID, $id){
        $sql = "UPDATE admin SET name=?, surname=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }

    protected function updateLoginID($newID, $name, $surname, $id){
        $sql = "SELECT * FROM users WHERE loginID=? AND id != ?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$newID, $id]);
        $rows = $stmt->fetchAll();
        //Check to see if there is any loginID in database matching the provided one
        if (count($rows) > 0) {
            //if loginID already exist in database, do not create account, redirect user to previous page
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'LoginID <span class="text-decoration-underline text-dark">'.$newID.'</span> already taken. Please Choose another';
            echo "<script type='text/javascript'>
                window.location='../profile.php';
              </script>";
        } else {
            $sql = "UPDATE users SET loginID=? WHERE id=?";
            $stmt = $this->con()->prepare($sql);
            if($stmt->execute([$newID, $id])){
                $_SESSION['loginID'] = $newID;
                $_SESSION['name'] = $name;
                $_SESSION['surname'] = $surname;

                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Profile updated successfully';
                echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
            }
            else{
                $this->opps();
            }
        }

    }

    public function updatePassword($op, $cp, $id){
        $rows = $this->GetUserByID($id);
        if(password_verify($op, $rows[0]['password'])){
            //Match
            $sql2 = "UPDATE users SET password=? WHERE id=?";
            $stmt2 = $this->con()->prepare($sql2);
            $pass_safe = password_hash($cp, PASSWORD_DEFAULT);

            if($stmt2->execute([$pass_safe, $id])){

                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Password Updated Successfully';
                echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
            }
            else{

                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Password Update Failed';
                echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
            }
        }
        else{
            //Not Matched

            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Old password did not match';

            echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
        }


    }

    protected function collectPrescription($duID, $prescriptionID, $userID, $pharmacistID){
        $this->GetPrescriptionByID($prescriptionID);
        $dateAdded = date("Y-m-d h:m:i");
        $isofferTrue = 1;
        $sql = "UPDATE prescription SET isOffered=?, pharmacistID=?, dateCollected=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$isofferTrue, $pharmacistID, $dateAdded, $prescriptionID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Prescription Collection Done';
            echo "<script type='text/javascript'>
                    window.location='../medicalHistoryDetails.php?duID=$duID&userID=$userID';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Contact admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function searchPatientQuery($search)
    {
        $sql = "SELECT * FROM patient WHERE name LIKE :search OR surname LIKE :search OR nationalID LIKE :search;";
        $stmt = $this->con()->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function searchPatient($search){
        $rows = $this->searchPatientQuery($search);

       if(count($rows) > 0){
           //results found
           $_SESSION['type'] = 's';
           $_SESSION['err'] = 'We Found '.count($rows).' Results. Here is what we found';
           echo "<script type='text/javascript'>
                   window.location='../dashboard.php?search=$search';
               </script>";
           return $rows;
       }
       else{
           //no results found
           $_SESSION['type'] = 'w';
           $_SESSION['err'] = 'No Data Found';
           echo "<script type='text/javascript'>
                   window.location='../dashboard.php';
               </script>";
       }

    }

    protected function addDPrescription($prescription, $duID){
        $dateAdded = date("Y-m-d h:m:i");
        $sql = "INSERT INTO prescription(duID, pharmacistID, prescription, isOffered, dateAdded, dateCollected)
                VALUES(?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $zeroID = 0;
        $blank = '';
        if($stmt->execute([$duID, $zeroID, $prescription, $zeroID, $dateAdded, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Prescription has been added to the database';
            echo "<script type='text/javascript'>
                    window.location='../addPrescription.php?duID=$duID';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! SOmething went wrong. Contact admin';
            echo "<script type='text/javascript'>
                    history.back(-1);
                </script>";
        }
    }

    protected function deletePrescription($pID, $duID){
        $sql = "DELETE FROM prescription WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$pID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Document has been Deleted from the database';
            echo "<script type='text/javascript'>
                    window.location='../addPrescription.php?duID=$duID';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    window.location='../addPrescription.php?duID=$duID';
                </script>";
        }
    }

    protected function deleteDoc($docID, $iuID, $userID){
        $rows = $this->GetDocs($iuID, $userID);
        $source_raw = $rows[0]['source'];
        $source = "../".$source_raw;
        if(unlink($source)){
            $sql = "DELETE FROM docs WHERE id=? AND userID=? AND iuID=?";
            $stmt = $this->con()->prepare($sql);

            if($stmt->execute([$docID, $userID, $iuID])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Document has been Deleted';
                echo "<script type='text/javascript'>
                    window.location='../requestInvestment.php?iuID=$iuID';
                </script>";
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>
                    window.location='../requestInvestment.php?iuID=$iuID';
                </script>";
            }
        }else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to unlink Document File from Source';
            echo "<script type='text/javascript'>
                    window.location='../requestInvestment.php?iuID=$iuID';
                </script>";
        }
    }

    protected function addDoc($title, $description, $iuID, $userUD, $file_tmp, $file_destination, $file_name_new, $file_ext){
        $bankRows = $this->GetBankByUserID($userUD);

        if(count($bankRows) < 1){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Please Activate your bank account first';
            echo "<script>
                window.location='../requestInvestment.php?iuID=$iuID';
            </script>";
        }else {
            if (move_uploaded_file($file_tmp, $file_destination)) {
                $filed = '../documents/' . $file_name_new . '';
                $sql = "INSERT INTO docs(title, description, iuID, userID, source, ext)
                VALUES(?,?,?,?,?,?)";
                $stmt = $this->con()->prepare($sql);
                $stmt->execute([$title, $description, $iuID, $userUD, $filed, $file_ext]);
                if ($stmt) {
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Request Added Successfully';
                    echo "<script>
                window.location='../includes/finilize.inc.php?iuID=$iuID';
            </script>";
                } else {
                    $_SESSION['type'] = 'w';
                    $_SESSION['err'] = 'Opps! Something went wrong while uploading the Document- level2';
                    echo "<script>
                window.location='../requestInvestment.php?iuID=$iuID';
            </script>";
                }
            } else {
                //Failed to move. Probably file destination permissions
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Opps! Something went wrong while uploading the Document- level1';
                echo "<script>
                window.location='../requestInvestment.php?iuID=$iuID';
            </script>";
            }
        }

    }





    protected function isUser($id, $role){
        if($role == 'admin'){
            return $this->GetAdminByID($id);
        }
        elseif ($role == 'investor'){
            return $this->GetInvestorByID($id);
        }
        else{
            $this->opps();
        }
    }

    protected function opps(){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Something went wrong.Please try again';
        echo "<script type='text/javascript'>
                history.back(-1);
              </script>";
    }

    protected function autoLoginUsers($loginID, $par)
    {
        //LOGIN FROM NORMAL LOGIN PAGE
        //THis functino is used to login from 2 endpoint(signin and set password)
        //for setpassword.php, login should be done without need to veryfy login password
        //for normal signin, password has already been verified on User.class::signInUser

        //get user using provided loginID
        $rowsUser = $this->GetUserByLoginID($loginID);
        $id = $rowsUser[0]['id'];

        //since we do not know whre the user has come from(setpassword or normal signin), we check if the password has been set
        //if not set, then the user is coming from setpassword.php hence update password with provided on by variable par
        //else, then its definetly a normal login soo pproceed without updating password
        if($rowsUser[0]['password'] == ''){
            $sql = "UPDATE users SET password=? WHERE loginID=?";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$par,  $loginID]);
        }


        $role = $rowsUser[0]['role'];
        //the following code is to automate the get user type with referance to class throiugh the use of session-role[]
        //it should return an array containing data from the right user table in our database and store is in variable $s
        $s = $this->isUser($id, $role);

        //set user sessions using the $s returned array variable object
        $_SESSION['name'] = $s[0]['name'];
        $_SESSION['surname'] = $s[0]['surname'];
        $_SESSION['role'] = $rowsUser[0]['role'];
        $_SESSION['id'] = $rowsUser[0]['id'];

        //check if user status is active, else, account is deactivated and cannot login
        if ($rowsUser[0]['status'] != 1) {
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Your account (' . $s[0]['name'] . ' ' . $s[0]['surname'] . ') is temporarily deactivated. Contact the administrator to get this issue fixed';
            //if acc is deactive, destroy sessions
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['surname']);

            echo "<script type='text/javascript'>
                    window.location='../signin.php?loginID=$loginID';
                  </script>";
        } else {
            //everything is okay, the user can log-in
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Welcome '.$loginID.'!';

            //redirect user to teh correct directory
            //Note: all directory names are based on available user roles hence automating the process of redirecting
            echo "<script type='text/javascript'>
                    window.location='../$role/';
                  </script>";

        }


    }

    protected function SigninUser($loginID, $password)
    {
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $res = $stmt->execute([$loginID]);

        if ($res) {
            $record = $stmt->fetchAll();
            /* Check the number of rows that match the SELECT statement */
            if (count($record) > 0) {

                //checkif passwrod is empty else proceed to login
                if($record[0]['password'] == ''){
                    //password not set
                    //set temporary session variables and redirect to set password
                    $_SESSION['loginIDTemp'] = $record[0]['loginID'];
                    $_SESSION['idTemp'] = $record[0]['id'];
                    $_SESSION['ids'] = $record[0]['id'];
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Looks like this is your first time login-in! Please Choose a password of your choice to proceed';

                    echo "<script type='text/javascript'>;
                          window.location='../setPassword.php';
                        </script>";                }
                else {
                    //password is already set hence proceed logging in
                    foreach ($record as $row) {
                        $passwords = $row["password"];
                        $userID = $row["id"];
                        //verify password encryption
                        if (password_verify($password, $passwords)) {
                            $_SESSION['id'] = $userID;
                            $blank = '';
                            //redirect to main login class whre sessions will be set and redirection
                            //since password is already verified, pass only loginID and a blank variable as a replacement of password
                            Usercontr::autologinUsers($loginID, $blank);
                        } else {
                            //Password Did Not match
                            $_SESSION['type'] = 'w';
                            $_SESSION['err'] = 'Wrong LoginID or Password';

                            echo "<script type='text/javascript'>;
                          window.location='../signin.php?loginID=" . $loginID . "';
                        </script>";
                        }
                    }
                }
            }
            /* No rows matched -- do something else */
            else {
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Wrong LoginID or Password';

                echo "<script type='text/javascript'>;
                          window.location='../signin.php?loginID=".$loginID."';
                        </script>";
            }
        }
    }

    function generateRandomString($length)
    {
        $include_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        /* Uncomment below to include symbols */
        /* $include_chars .= "[{(!@#$%^/&*_+;?\:)}]"; */
        $charLength = strlen($include_chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $include_chars [rand(0, $charLength - 1)];
        }
        return $randomString;
    }

    protected function timeTogo($mydate){
        $time_ago = strtotime($mydate);
        $cur_time   = time();
        $time_elapsed   = $time_ago - $cur_time;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "Now";
        }
        //Minutes
        else if($minutes <=60){
            return "$minutes minute/s left";

        }
        //Hours
        else if($hours <=24){
            return "$hours hr/s left";
        }
        //Days
        else if($days <= 7){
            return "$days day/s left";
        }
        //Weeks
        else if($weeks <= 4.3){
            return "$weeks Week/s OR $days days left";
        }
        //Months
        else if($months <=12){
            return "$months month/s OR $days days left";
        }
        //Years
        else{
            return "$years Year/s OR $months month/s OR $days days left";
        }
    }

    protected function timeAgo($mydate){
        $time_ago = strtotime($mydate);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "One Minute Ago";
            }
            else{
                return "$minutes Minutes Ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an Hour Ago";
            }else{
                return "$hours Hrs Ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "Yesterday";
            }else{
                return "$days Days Ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a Week Ago";
            }else{
                return "$weeks Weeks Ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a Month Ago";
            }else{
                return "$months Months Ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "One Year Ago";
            }else{
                return "$years Years Ago";
            }
        }
    }

    protected function dateToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y',$history_bus_date_tostring);
    }

    protected function dateToTime($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('H:m A',$history_bus_date_tostring);
    }

    protected function dateToDayMDY($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('F j Y',$history_bus_date_tostring);
    }

    protected function dateTimeToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y H:m:s A',$history_bus_date_tostring);
    }

    protected function GetInterestRates(){
        $sql = "SELECT * FROM interest";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetBankByUserID($userID){
        $sql = "SELECT * FROM bank WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }



    protected function GetInterestRatesByType($InvType){
        $sql = "SELECT * FROM interest WHERE type=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$InvType]);
        return $stmt->fetchAll();
    }

    protected function GetCountView($query){
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetDocs($iuID, $userID){
        $sql = "SELECT * FROM docs WHERE iuID=? AND userID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$iuID,$userID]);
        return $stmt->fetchAll();
    }

    protected function GetAllInvestments(){
        $sql = "SELECT * FROM investments ORDER BY id DESC ";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    protected function GetRequestByUserIDandiuID($userID, $iuID){
        $sql = "SELECT * FROM request WHERE userID=? AND iuID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID, $iuID]);
        return $stmt->fetchAll();
    }

    protected function GetAllInvestmentsByuiID($uiID){
        $sql = "SELECT * FROM investments WHERE iuID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$uiID]);
        return $stmt->fetchAll();
    }


    protected function GetInvestedByUserID($id){
        $sql = "SELECT * FROM invested WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAllInvestedByIUID($iuid){
        $sql = "SELECT * FROM invested WHERE iuID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$iuid]);
        return $stmt->fetchAll();
    }

    protected function GetInvestedByiuIDandUserID($id, $userID){
        $sql = "SELECT * FROM invested WHERE iuID=? AND userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id,$userID]);
        return $stmt->fetchAll();
    }


    protected function GetAllWithdrawalHistory(){
        $sql = "SELECT * FROM withdraw ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    protected function GetWithdrawalByUserID($userID){
        $sql = "SELECT * FROM withdraw WHERE userID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }

    protected function GetInvestedByiuID($id){
        $sql = "SELECT * FROM invested WHERE iuID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetDocByID($id){
        $sql = "SELECT * FROM docs WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetDiagnosisByUID($id){
        $sql = "SELECT * FROM diagnosis WHERE duID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetDiagnosisByUserID($id){
        $sql = "SELECT * FROM diagnosis WHERE userID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetPrescriptionByID($id){
        $sql = "SELECT * FROM prescription WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Prescription Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetPrescriptionByduID($id){
        $sql = "SELECT * FROM prescription WHERE duID=? ORDER BY ID DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAdminByID($id){
        $sql = "SELECT * FROM admin WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetDoctorByID($id){
        $sql = "SELECT * FROM doctor WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAllDoctors(){
        $sql = "SELECT * FROM doctor";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetPatientByID($id){
        $sql = "SELECT * FROM patient WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetPharmacistByID($id){
        $sql = "SELECT * FROM pharmacist WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetReceptionistByID($id){
        $sql = "SELECT * FROM receptionist WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAppontmentByAppID($id){
        $sql = "SELECT * FROM appointments WHERE appointmentUID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAppontmentByPatientID($id){
        $sql = "SELECT * FROM appointments WHERE patientID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAppontmentByDoctorID($id){
        $sql = "SELECT * FROM appointments WHERE doctorID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetAllUser(){
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetUserByID($id){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetUserByLoginID($loginID){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        return $stmt->fetchAll();

    }


    protected function GetInvestorByID($id){
        $sql = "SELECT * FROM investor WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function addAdmin($name, $surname, $id){
        $blank = '';
        $today = date('Y-m-d H:i:s');
        $sql = "INSERT INTO admin(userID, name, surname, address, phone, email, dateAdded) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $today])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Admin Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addDoctor($name, $surname, $id){
        $sql = "INSERT INTO doctor(UserID, name, surname, hospital, email, phone, category) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $blank = '';
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Doctor Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addPatient($name, $surname, $id){
        $sql = "INSERT INTO patient(userID, name, surname, nationalID, sex, dob, address, phone, nextOfKinName, nextOfKinSurname, nextOfKinPhone, medicalAid, medicalAidPlan) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $blank = '';
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank])){

            if($_SESSION['role'] == 'receptionist' OR $_SESSION['role'] == 'doctor'){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Created Patient Successfully. Finishing up patient account below';
                echo "<script type='text/javascript'>
                        window.location='../patientSetup.php?userid=$id';
                      </script>";
            }
            else {
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Created Patient Successfully';
                echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
            }

        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addPharmacist($name, $surname, $id){
        $sql = 'INSERT INTO pharmacist(userID, name, surname, joint, address, phone, email) VALUES(?,?,?,?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        $blank = '';
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Pharmacist Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addInvestor($name, $surname, $id){
        $today = date('Y-m-d H:i:s');
        $sql = 'INSERt INTO investor(userID, name, surname, address, phone, email, dateAdded)  VALUES(?,?,?,?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        $blank='';
        if($stmt->execute([$id, $name,$surname, $blank, $blank, $blank, $today])){

            $_SESSION['id'] = $id;
            $_SESSION['role'] = 'investor';
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = '';

            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Account Created Successfully';
            echo "<script type='text/javascript'>
                    window.location='../investor/';
                  </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addUser($name, $surname, $loginID, $userRole, $activeStatus, $password){
        $joined = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        $rows = $stmt->fetchAll();
        if($stmt){
            //Check to see if there is any loginID in database matching the provided one
            if(count($rows) > 0){
                //if loginID already exist in database, do not create account, redirect user to previous page
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'LoginID is not available. Please Choose another';
                echo "<script type='text/javascript'>
                    history.back(-1);
                  </script>";
            }
            else{
                //ACCOUNT NOT FOUND HENCE WITH SAME LOGINID HENCE PROCEED
                //insert data into users table
                $setSql = "INSERT INTO users(loginID, password, role, joined, status)
                        VALUES (?,?,?,?,?)";
                $setStmt = $this->con()->prepare($setSql);
                if($userRole != 'admin'){
                    $password = password_hash($password, PASSWORD_BCRYPT);
                }

                if($setStmt->execute([$loginID, $password, $userRole, $joined, $activeStatus])){
                    //Get user id of created user accounts from users table
                    //this will help creating cascading table rows depending on the user role
                    $userFetchRows = $this->GetUserByLoginID($loginID);
                    $id = $userFetchRows[0]['id'];

                    if($userRole == 'admin'){
                        //create admin acc
                        $this->addAdmin($name, $surname, $id);
                    }
                    elseif ($userRole == 'investor'){
                        //create receptionist acc
                        $this->addInvestor($name, $surname, $id);
                    }
                    else{
                        //failed to execute
                        $_SESSION['type'] = 'w';
                        $_SESSION['err'] = 'Opps! SOmething went wrong';
                        echo "<script type='text/javascript'>
                            history.back(-1);
                          </script>";
                    }

                }
                else{
                    //FAILED TO CREATE USER
                    //echo 'Failed to create user';
                    $_SESSION['type'] = 'w';
                    $_SESSION['err'] = 'Failed to create user';
                    echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";
                }
            }
        }
        else{
            //FAILED EXECUTING THE QUERY;
            //echo 'Failed executing query';
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Failed executing query';
            echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";
        }
    }


}