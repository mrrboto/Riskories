<?php
	$message = '';
	include('../db/config.php');
	include('../db/db.php');
	session_start();	
	
	
?>
<!DOCTYPE html>
<html>
<!-- This document is for the user after completing a story, to redirect them to register -->
<head>
</head>
<body>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
                  integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
            </script>

            <div class="navbar">
            <nav class="container navbar-inverse">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../index.html">
                            <img alt="Brand" src="../img/s_logo_3.png" height="45px" width="40px" style="padding-bottom: 20px">
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="../consent/consentform.php">View Consent Form</a></li>
                            <!--<li><a data-toggle="modal" data-target="#myModal">View Consent Form</a></li>-->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="container">
            <!--<div class="jumbotron">
                <h2>Project "Riskories"</h2>
                <p>Hey! We hope you liked the story. If you want to do more please register!</p>
            </div>-->
            <div class="row">
                <div class="panel panel-default">
                  <div class="panel-heading"><h4>Hey! We hope you liked the story. If you want to do more we would request that you register. Would you like to register?</h4></div>
                  <div class="panel-body">
                    <!--<div class="btn-group">-->
						<!-- THIS NEEDS TO BE HERE VVVVVVVVVVVVVVVVVVVVVVVVVV IT INCLUDES REGISTER IN THE PAGE -->
						<button class="btn btn-danger" onclick="window.location.href='guestReg.php?gpage=2'">Yes Please</button>
						<button class="btn btn-danger" onclick="window.location.href='guestReg.php?gpage=3'">No thanks</a>
                    <!--</div>-->
                  


                <?php
                    /*if (isset($_POST['no'])){
                        header("Location: ../login/login.php");
                    }*/
                    if(isset($_GET['gpage']))
                    {
                        if ($_GET['gpage'] == 2)
                        {
							include('../login/reg.php');
                            echo "<p>$message</p>";
                        }
						if ($_GET['gpage'] == 3){
							//if the user clicked no
							include("demoUpdate.php");
						}
                    }
				?>
            </div>
        </div>

        <!-- Modal -->
        <div id="contentModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Consent Form</h2>
              </div>
              <div class="modal-body">
                 <h4>Title of research study:</h4> Riskories – how does being embedded in a story affect risk perceptions?
			     <h4>Investigator:</h4> Prof. Andrew Maynard
			     <h4>Why am I being invited to take part in a research study?</h4>
			We invite you to take part in a research study because you have an interest in stories and risk and represent our study population.
			<h4>Why is this research being done?</h4>
			ASU, SFIS, and FSE are studying narrative as stories relate to risk perceptions.  We are enrolling persons at ASU and elsewhere as our part and to be able to cross compare our results.
			<h4>How long will the research last?</h4>
			We expect that individuals will spend on average about 5-15 minutes per story (“riskory”).  The data collection will continue indefinitely as readers continue to engage with the Riskories on the app.
			<h4>How many people will be studied?</h4>
			This is unknown.  We hope that at least about 100 or so people will participate in this research study.  You must be 18 years old or older to participate in the study.
			<h4>What happens if I say, “yes, I want to be in this research”?</h4>
			You will be allowed to continue on to the app and to engage with the Riskories.  You will enter a few demographics to your profile.  Your demographics will not be known to anyone but you.  The researchers won’t be able to “see” any individual’s information.  You will then be able to engage with one or more Riskories that have your or another’s demographics.
			<h4>What happens if I say yes, but I change my mind later?</h4>
			You can leave the research at any time it will not be held against you.
			<h4>Is there any way being in this study could be bad for me?</h4>
			There really aren’t any significant risks.  You may feel some uncomfortable thoughts depending on your story choices within the Riskories and how you feel about reading about yourself.
			<h4>Will being in this study help me in any way?</h4>
			We cannot promise any benefits to you or others from your taking part in this research. However, possible benefits include increased awareness of risk and how you perceive it.  This could also result in benefits to you depending on the risks you might face in your life.   Also, it could help ASU determine how best to improve its overall risk communications.
			<h4>What happens to the information collected for the research?</h4>
			Efforts will be made to limit the use and disclosure of your personal information, including research study records, to people who have a need to review this information. We cannot promise complete secrecy. Organizations that may inspect and copy your information include the University board that reviews research and agencies who want to make sure the study researchers (us, not you) are doing their jobs correctly and protecting your information and rights.
			<br><br>Information will be anonymized and none of the researchers will know actual identities of study participants nor the demographic information of individual participants. The demographics will be used as an aggregate as will your story plot choices and your pre and post riskory questions.  Records will be safely stored in the administrative side of the app on ASU servers.
			<h4>What else do I need to know?</h4>
			This research is not being funded by any outside entities.  There are no financial conflicts of interest.
			<h4>Who can I talk to?</h4>
			If you have questions, concerns, or complaints, talk to the research team at:
			<br>•	Jonathan Klane at (480) 965-8498 or jonathan.klane@asu.edu
			<br>•	Andrew Maynard at (480) 727-8831 or amaynar2@asu.edu
			<br>This research has been reviewed and approved by the Social Behavioral IRB. You may talk to them at (480) 965-6788 or by email at research.integrity@asu.edu if:
			<br>•	Your questions, concerns, or complaints are not being answered by the research team.
			<br>•	You cannot reach the research team.
			<br>•	You want to talk to someone besides the research team.
			<br>•	You have questions about your rights as a research participant.
			<br>•	You want to get information or provide input about this research.
			<br><br>
			By clicking “Agree To Terms” you are granting your consent.  Thank you and enjoy your Riskories!
              </div>
              <div class="modal-footer">
                <!--<button type="button" class="btn btn-success" data-dismiss="modal">Agree To Terms</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Reject Terms</button>-->
              </div>
            </div>

          </div>
        </div>
</body>
