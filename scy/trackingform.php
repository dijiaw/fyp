<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 23/12/18
 * Time: 10:51
 */
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else {
    $mail_courseids = $_POST['formgeneration'];
    $n = count($mail_courseids);
    for ($i = 0; $i < $n; $i++) {
        if ($i==1)echo"Please check the PDF files in your local disk and close this window.";
        //Fetch data from database
        require_once("config.php");
        $sql = "select * from course where courseid=" . $mail_courseids[$i] . ";";
        $res = mysqli_query($link, $sql);
        $row = $res->fetch_assoc();
        $coursecode = $row['code'];
        $coursename = $row['coursename'];
        $sqlc = "select staff.name from staff,examstaff where examstaff.courseid=" . $mail_courseids[$i] . " and examstaff.role='C' and staff.staffid=examstaff.staffid;";
        $resc = mysqli_query($link, $sqlc);
        $rowc = $resc->fetch_assoc();
        $coordinator = $rowc['name'];
        $sqla = "select staff.name from staff,area,course where course.courseid=" . $mail_courseids[$i] . " and area.area=course.area and area.leadid=staff.staffid;";
        $resa = mysqli_query($link, $sqla);
        $rowa = $resa->fetch_assoc();
        $arealead = $rowa['name'];

        $html = "
        <!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Tracking Form</title>
            <style>
                body{font-family: Verdana,Arial,sans-serif;}
                main{
                    width:96%;
                    margin:auto;
                }
                p{
                    font-size:80%;
                    margin-top:5px;
                    margin-bottom:5px;
                    font-style:italic;
                }
                table {
                    border-collapse: collapse;
                    width:100%;
                    border: 1px solid black;
                    padding:5px;
                }
                th, td {
                    border: 1px solid black;
                    font-size:80%;
                    padding:5px;
                }
                .table1{text-align: left;}
                .table2{margin-top:15px;}
                .table3{margin-top:15px;}
                .table3 th{
                    background-color: lightgrey;
                    text-align:center;
                }
                .table3 td{padding:10px;}
                .page {page-break-before: always;}

        .table4 table{
            border-collapse: collapse;
            width:100%;
            border: 0 !important;
        }
        .table4 td{
            font-size:70%;
            padding:5px;
            border: 0 !important;
        }
        .block{
            border:1px solid black;
            width:80%;
            height:20px;
        }
            </style>
        </head>
        <body>
        <div>
        <img src=\"assets/brand/eeelogo.png\" style=\"height:80px;margin-top:10px;margin-left:10px;margin-top:10px;\">
        <main role=\"main\">
            <h2 style=\"color:darkred;text-align:center; margin-top:7px; margin-bottom:20px;\">Tracking Form – ENIC/ECAL/INON/Others</h2>
            <div class=\"table1\">
                <table>
                    <tr>
                        <th>Course Code/Title: $coursecode / $coursename </th>
                        <th>Sem 2 AY2018/19</th>
                    </tr>
                </table>
                <table style=\"margin-top:-0.5px;\">
                    <tr>
                        <th>Course Coordinator: $coordinator</th>
                        <th>1st Draft Submitted on: &nbsp;&nbsp;/&nbsp;&nbsp;/2019</th>
                    </tr>
                </table>
            </div>
            <div class=\"table2\">
                <table>
                    <tr>
                        <td>
                            To Examiners, Moderators and Area Lead:<br>After checking the exam paper, please indicate date and sign.
                            The exam paper should be passed to the next examiner/moderator or Area Lead for checking within one working day.
                            Examiner must check the question(s) set by him/her. Moderator must check question(s) assigned to him/her for moderation.
                            Area Lead must check ALL the questions.
                            <br>Thank you.
                            <br>Admin Staff (S2-B2a-34) (Tel: xxxx xxxx)
                        </td>
                    </tr>
                </table>
            </div>
            <div class=\"table3\">
                <table>
                    <tr>
                        <th rowspan=\"2\">(Draft -> AC’s Vetting)<br>Examiners, Moderators and Course Coordinator</th>
                        <th>1st Check</th><th>2st Check</th><th>3st Check</th><th>4st Check</th><th>5st Check</th><th>6st Check</th>
                    </tr>
                    <tr><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th></tr>";

        $sqlstaff = "select distinct staff.name from staff,examstaff where examstaff.courseid=" . $mail_courseids[$i] . " and staff.staffid=examstaff.staffid;";
        $resstaff = mysqli_query($link, $sqlstaff);
        for ($staff = 0; $staff < $resstaff->num_rows; ++$staff) {
            $rowstaff = $resstaff->fetch_assoc();
            $html .= <<< EOT
            <tr><td>{$rowstaff['name']}</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
EOT;
        }

        $html .= <<< EOT
        <tr style="border-top: 2px solid black;">
                        <th>Area Lead:<br>$arealead</th>
                        <td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td>
                    </tr>
                </table>
            </div>
        
            <div class="table3">
                <table>
                    <tr>
                        <th rowspan="2">(Draft -> AC’s Vetting)<br>Examiners, Moderators and Course Coordinator</th>
                        <th>1st Check</th><th>2st Check</th><th>3st Check</th><th>4st Check</th><th>5st Check</th><th>6st Check</th>
                    </tr>
                    <tr><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th><th>Sign/Date</th></tr>
EOT;
        $resstaff = mysqli_query($link, $sqlstaff);
        for ($staff = 0; $staff < $resstaff->num_rows; ++$staff) {
            $rowstaff = $resstaff->fetch_assoc();
            $html .= <<< EOT
            <tr><td>{$rowstaff['name']}</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
EOT;
        }

        $html .= <<< EOT
        <tr style="border-top: 2px solid black;">
                        <th>Area Lead:<br>{$arealead}</th>
                        <td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td><td><br>Draft no.</td>
                    </tr>
                </table>
            </div>
            <p>Notes: Please make sure that all questions and solutions are in sequential order, and marks are allocated properly.</p>
            <div class="table3">
                <table>
                    <tr>
                        <th>Items to Note</th>
                        <th>By</th>
                        <th>Remarks</th>
                    </tr>
                    <td>&nbsp;</td> <td> </td> <td> </td> </tr>
                </table>
            </div>
        </main></div>
        
        <div class="page">
    <img src="assets/brand/eeelogo.png" style="height:80px;margin-top:10px;margin-left:10px;margin-top:10px;">
    <main role="main">
        <h3 style="color:darkred;text-align:center; margin-top:7px; margin-bottom:20px;">PROCESS FLOW RECORD - EXAMINATION QUESTION PAPER & SOLUTION</h3>
        <div class="table1">
            <table>
                <tr>
                <th>Course Code/Title: $coursecode / $coursename  </th>
                    <th>Sem 2 AY2018/19</th>
                </tr>
            </table>
            <table style="margin-top:-0.5px;">
                <tr>
                    <th>Course Coordinator: $coordinator</th>
                    <th>Admin Staff: Ng Shiu Fern</th>
                    <th>Area: INON</th>
                </tr>
            </table>
        </div>
        <div class="table2" style="text-align:center;">
            <table>
                <tr>
                    <th colspan="6">Submission of Examination Question Paper & Solution to Associate Chair (Academic) for Review</th>
                </tr>
                <tr>
                    <td rowspan="2">Date</td>
                    <td colspan="2">Send to</td>
                    <td colspan="2">Status (AC to indicate)</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>AC (Acad)</td>
                    <td>Examiner(s)</td>
                    <td>Amendment</td>
                    <td>Final</td>
                </tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>

            </table>
        </div>

        <div class="table2" style="text-align:center;">
            <table>
                <tr>
                    <tH colspan="6">Submission of Final Examination Question Paper & Solution to Undergraduate Programme Office, <br>c/o Ms Sandy Choo</tH>
                </tr>
            </table>
            <table>
                <tr>
                    <tH colspan="6" style="font-style: italic;">This is to confirm that the <u>FINALISED PAPER</u> has been checked by all examiners and is in order.</tH>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Name of Examiner</th>
                    <th>Signature</th>
                    <th>Date</th>
                    <th>Remarks</th>
                </tr>
EOT;
        $sqlstaff = "select distinct staff.name from staff,examstaff where examstaff.courseid=" . $mail_courseids[$i] . " and examstaff.role='E' and staff.staffid=examstaff.staffid;";
        $resstaff = mysqli_query($link, $sqlstaff);
        for ($staff = 0; $staff < $resstaff->num_rows; ++$staff) {
            $rowstaff = $resstaff->fetch_assoc();
            $html .= <<< EOT
            <tr><td>{$rowstaff['name']}</td><td></td><td></td><td></td></tr>
EOT;
        }
        $html .=<<<EOT
            </table>
            <table>
                <tr>
                    <td>Last modified date/time of the finalised exam paper (softcopy): (To be filled in by Admin Staff)<br><br>
                        Date: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time:<u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                </tr>
                <tr>
                    <th style="text-align: left; padding-left:15px;">Reminder:  Please make sure ALL the amendment / checking / moderation / approval processes are accurately recorded in chronological order. Reason must be provided under the remark column should unexpected changes take place.</th>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="text-align=left;">
                        Endorsed by Area Lead / Associate Chair (Academic) <br><br><br><br>
                        Signature: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Date:<u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>&nbsp;
                    </td>
                </tr>
            </table>
        </div>


    </main>
</div>
EOT;
        $html .=<<<EOT
                <!--page3-->
                <div class="page">
                    <main role="main">
                        <h3 style="color:darkred;text-align:center; margin-top:30px; margin-bottom:10px;">CHECKLIST FOR SETTING / REVIEW OF EXAMINATION QUESTIONS AND ANSWERS</h3>
                        <p style="text-align: center;">Course Code & Title: <u>$coursecode / $coursename</u></p>
                
                        <div style="margin-top:20px;">
                            <p style="background-color: lightgrey; font-weight:bold;">Section A:- To be completed and signed by Examiner(s)</p>
                            <p style="font-size:90%;margin-top:7px;">I am aware of and understand the University’s requirement in minimising similarity of questions and hence I should:</p>
                            <div class="table4">
                                <table>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="width:6%">Yes</td><td style="width:6%">No</td><td style="width:6%">NA</td>
                                    </tr>
                                    <tr>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Refrain from setting exam questions too closely resembling tutorial, CA and past
                                            exam questions with same/different data.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Refrain from directly copying from textbook questions.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr><td colspan="5"><u>REASON(S) FOR ANSWERING ‘NO’ OR ‘NA’ FOR ANY OF THE ABOVE:</u></td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="5">&nbsp;</td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="5">&nbsp;</td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="5">&nbsp;</td></tr></table>
                                <table>
                                    <tr>
                                        <td style="width:20%">Signature of Examiner(s)</td>
                                        <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                        <td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School</td>
                                        <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                    </tr>
                                    <tr>
                                        <br>
                                        <td style="width:20%">Name</td>
                                        <td style="border-bottom: 1px solid black !important; width:30%;"> SHI CHENYU</td>
                                        <td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</td>
                                        <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                    </tr>
                                </table>
                            </div><br>
                            <hr style="border:1px dotted #000">
                            <br>
EOT;
        $html .=<<<EOT
                            <p style="background-color: lightgrey; font-weight:bold;">Section B:- To be completed and signed by Moderator(s), Area Lead and Assoc Chair (Academic)</p>
                            <div class="table4">
                                <table>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td style="width:6%">Yes</td><td style="width:6%">No</td><td style="width:6%">NA</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">1. CONTENTS</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Appropriate coverage and adequate distribution of
                                            topics covered by syllabus.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Sufficient time for reading of questions and attempting
                                            solutions, e.g.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> </td>
                                        <td>
                                            -	less than 10 pages of question papers.<br><br>
                                            -	approximately 25 to 30 minutes for solution of one question for a typical case of answering 4 out of 6 questions.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Minimum overlap between or among questions set in
                                            the paper.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Answers/solutions to the questions are correct.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr><td></td></tr><tr><td></td></tr>
                                    <tr>
                                        <td colspan="3">2. COMPLEXITY</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Balanced spread of questions or sub-questions with
                                            progressive level of difficulties and challenges.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Appropriate emphasis on questions to test candidate's
                                            ability to think rather than to regurgitate information, and to exercise judgement/decision rather than perform routine calculation.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                
                                    <tr><td></td></tr><tr><td></td></tr>
                                    <tr>
                                        <td colspan="3">3. MARKS</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Equitable allocation of marks according to the level of
                                            difficulty or duration of working.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Equitable distribution of marks with respect to the
                                            topics covered in the course.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
EOT;
        $html .=<<<EOT
                                    <tr><td></td></tr><tr><td></td></tr>
                                    <tr>
                                        <td colspan="3">4. PRESENTATION</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Clarity: Instructions and questions are self-
                                            contained and unambiguous.  All symbols or terminologies are clearly defined/explained.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Correctness: Free from misprints, errors of
                                            punctuations, omissions of data, symbols and numbers and other inaccuracies.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Consistency: All symbols or terms used in the
                                            same question paper are consistent/uniform.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Standardisation: All units, symbols, terms and
                                            abbreviations follow the SI system, except where international practice proves otherwise.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Drawings: All figures are drawn properly
                                            with dimensions/units correctly shown.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                
                                    <tr><td></td></tr><tr><td></td></tr>
                                    <tr>
                                        <td colspan="3">5. ORIGINALITY</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Avoid questions too closely resembling the tutorial problems.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Refrain from directly copying from textbook questions.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%"><li>&nbsp;</li></td>
                                        <td>Minimise repetition of questions set in previous years.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                                    <tr><td></td></tr><tr><td></td></tr>
                                    <tr>
                                        <td colspan="3">6. QUESTION(S) MODERATED (please indicate question number)</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="6">&nbsp;</td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="6">&nbsp;</td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="6">&nbsp;</td></tr>
                
                                    <tr><td></td></tr><tr><td></td></tr>
EOT;
        $html .=<<<EOT
                                    <tr>
                                        <td colspan="3">7. OTHER REMARKS (if any)</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="6">&nbsp;</td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="6">&nbsp;</td></tr>
                                    <tr style="border-bottom: 1px solid black !important;"><td colspan="6">&nbsp;</td></tr></table>
                
                                    <table>
                                        <tr>
                                            <td style="width:20%">Signature of Moderator(s)</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                            <td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                        </tr>
                                        <tr>
                                            <br>
                                            <td style="width:20%">Name</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                            <td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                        </tr>
                                    </table>
                
                                <table>
                                    <tr><td></td></tr><tr><td></td></tr>
                                    <tr>
                                        <td colspan="3">8. <u>COMPATIBILITY</u> [TO BE COMPLETED BY AREA LEAD AND ASSOC CHAIR (ACADEMIC)]</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td style="width:6%">Yes</td><td style="width:6%">No</td><td style="width:6%">NA</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td style="width:6%">&nbsp;</td>
                                        <td>The examination paper is compatible with that of other courses in terms of contents, complexity and originality.</td>
                                        <td><div class="block"></div></td><td><div class="block"></div></td><td><div class="block"></div></td>
                                    </tr>
                
                                    <table>
                                        <tr>
                                            <td style="width:20%">Area Lead</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                            <!--<td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School</td>-->
                                            <!--<td style="border-bottom: 1px solid black !important; width:30%;"></td>-->
                                        </tr>
                                        <tr>
                                            <br>
                                            <td style="width:20%">Date</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                            <td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td style="width:20%">Assoc Chair (Academic)</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                        </tr>
                                        <tr>
                                            <br>
                                            <td style="width:20%">Date</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                            <td style="width:10%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</td>
                                            <td style="border-bottom: 1px solid black !important; width:30%;"></td>
                                        </tr>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </main>              
                    </div>
                        
                        </body>
                        </html>
EOT;
        $filename=preg_replace('/\s+\/+\s+/','', $coursecode);
        file_put_contents("{$filename}.html", $html);
        $html_src= "/Applications/XAMPP/xamppfiles/htdocs/fyp_website_codes/{$filename}.html";
        $pdf_dst ="{$filename}.pdf";
        shell_exec("./pdf.sh $html_src $pdf_dst");
    }
    echo "<script> location.href='form_generation.php'; </script>";
    exit;
}

?>


