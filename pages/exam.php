<script type="text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
 <?php 
 $exmne_id = $_SESSION['examineeSession']['exmne_id'];
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
    $selExamTimeLimit = $selExam['ex_time_limit'];
    $exDisplayLimit = $selExam['ex_questlimit_display'];
 ?>


<div class="app-main__outer">
<div class="app-main__inner">
    <div class="col-md-12">
         <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>
                            <?php echo $selExam['ex_title']; ?>
                            <div class="page-title-subheading">
                              <?php echo $selExam['ex_description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions mr-5" style="font-size: 20px;">
                        <form name="cd">
                          <input type="hidden" name="" id="timeExamLimit" value="<?php echo $selExamTimeLimit; ?>">
                          <label>Remaining Time : </label>
                          <input style="border:none;background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="txt" value="00:00" size="5" readonly="true" />
                      </form> 
                    </div>   
                 </div>
            </div>  
    </div>

    <div class="col-md-12 p-0 mb-4">
        <form method="post" id="submitAnswerFrm">
            <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
            <input type="hidden" name="exmne_id" id="exmne_id" value="<?php echo $_SESSION['examineeSession']['exmne_id']; ?>">
            <input type="hidden" name="examAction" id="examAction" >
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
        <?php 
            $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ");
            $lablecounter=0;
            if($selQuest->rowCount() > 0)
            {
                $i = 1;
                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $questId = $selQuestRow['eqt_id'];
                    //   $selExmneeData = $conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$examId' AND quest_id='$questId'");
                       ?>
                    <tr>
                        <td>
                            <p><b><?php echo $i++ ; ?> .) <?php echo $selQuestRow['exam_question']; ?></b></p>
                            <div class="col-md-4 float-left">
                              <div class="form-group pl-4 ">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch1']; ?>" class="form-check-input" type="radio" value="" 
                                id="invalidCheck<?php echo $lablecounter; ?>" required 
                                <?php 
                                $answer=$selQuestRow['exam_ch1'];
                                $selectanswer=$conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$examId' AND quest_id='$questId' AND exans_answer='$answer'");
                                if($selectanswer->rowCount() > 0)
                                    echo "checked";
                                 ?>
                                onclick="storeAnswer(<?php echo $questId; ?>,<?php echo $examId; ?>, '<?php echo $selQuestRow['exam_ch1']; ?>')" >
                               
                                <label class="form-check-label" for="invalidCheck<?php echo $lablecounter++; ?>">
                                    <?php echo $selQuestRow['exam_ch1']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch2']; ?>" class="form-check-input" type="radio" value="" 
                                id="invalidCheck<?php echo $lablecounter; ?>" required 
                                <?php 
                                $answer=$selQuestRow['exam_ch2'];
                                $selectanswer=$conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$examId' AND quest_id='$questId' AND exans_answer='$answer'");
                                if($selectanswer->rowCount() > 0)
                                    echo "checked";
                                 ?>
                                onclick="storeAnswer(<?php echo $questId; ?>,<?php echo $examId; ?>, '<?php echo $selQuestRow['exam_ch2']; ?>')" >
                               
                                <label class="form-check-label" for="invalidCheck<?php echo $lablecounter++; ?>">
                                    <?php echo $selQuestRow['exam_ch2']; ?>
                                </label>
                              </div>   
                            </div>
                            <div class="col-md-8 float-left">
                             <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch3']; ?>" class="form-check-input" type="radio" value="" 
                                id="invalidCheck<?php echo $lablecounter; ?>" required 
                                <?php 
                                $answer=$selQuestRow['exam_ch3'];
                                $selectanswer=$conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$examId' AND quest_id='$questId' AND exans_answer='$answer'");
                                if($selectanswer->rowCount() > 0)
                                    echo "checked";
                                 ?>
                                onclick="storeAnswer(<?php echo $questId; ?>,<?php echo $examId; ?>, '<?php echo $selQuestRow['exam_ch3']; ?>')" >
                               
                                <label class="form-check-label" for="invalidCheck<?php echo $lablecounter++; ?>">
                                    <?php echo $selQuestRow['exam_ch3']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch4']; ?>" class="form-check-input" type="radio" value="" 
                                id="invalidCheck<?php echo $lablecounter; ?>" required 
                                <?php 
                                $answer=$selQuestRow['exam_ch4'];
                                $selectanswer=$conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$examId' AND quest_id='$questId' AND exans_answer='$answer'");
                                if($selectanswer->rowCount() > 0)
                                    echo "checked";
                                 ?>
                                onclick="storeAnswer(<?php echo $questId; ?>,<?php echo $examId; ?>, '<?php echo $selQuestRow['exam_ch4']; ?>')" >
                               
                                <label class="form-check-label" for="invalidCheck<?php echo $lablecounter++; ?>">
                                    <?php echo $selQuestRow['exam_ch4']; ?>
                                </label>
                              </div>   
                            </div>
                            </div>
                             

                        </td>
                    </tr>

                <?php }
                ?>
                       <tr>
                             <td style="padding: 20px;">
                                 <button type="button" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetExamFrm">Reset</button>
                                 <input name="submit" type="submit" value="Submit" class="btn btn-xlg btn-primary p-3 pl-4 pr-4 float-right" id="submitAnswerFrmBtn">
                             </td>
                         </tr>

                <?php
            }
            else
            { ?>
                <b>No question at this moment</b>
            <?php }
         ?>   
        </table>

        </form>
    </div>
</div>
 
