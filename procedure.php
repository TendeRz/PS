<?php
	session_start();
?>

<html lang="en">
<head>
	<?php
		$procidd = $_GET['procID'];
		$procname = $_GET['procName'];
        $arch = $_GET['procArch'];
		echo '<title>Proc: '.$procname.'</title>';
	?>
	
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
</head>
<body>
<?php 
		include_once('login_check.php');
        include_once('./adds/queries.php');
    ?>
    <div class="container" >

                <?php
                include_once('navigation.php');
                if ($arch == 1) {
                    $selectProcedure = selectProcedure($procidd, 'proceduresarchive');
                }else{
                    $selectProcedure = selectProcedure($procidd);
                }

				foreach ($selectProcedure as $key => $procedureItem) {
                    $pprocid = $procedureItem[0];
                    $pprocTitle = $procedureItem[1];
                    $pprocSystem = $procedureItem[2];
                    $pprocCountry = $procedureItem[3];
                    $pprocFuncArea = $procedureItem[4];
                    $pprocDescript = $procedureItem[5];
                    $pprocDependecies = $procedureItem[6];
                    $pprocAccess = $procedureItem[7];
                    $pprocDescription = $procedureItem[8];
                    $pprocTroubleshooting = $procedureItem[9];
                    $pprocImpact = $procedureItem[10];
                    $pprocVersion = $procedureItem[11];
                    $pprocState = $procedureItem[12];
                    $pprocAuthor = $procedureItem[13];
                    $pprocVersionActive = $procedureItem[17];
                    $pprocidHistory = $procedureItem[18];

                    if ($pprocVersion < $pprocVersionActive){
                        $procversionStyle = 'color:red; font-weight:bold';
                        $pprocNewVersion = $pprocVersionActive + 0.01;
                    } else {
                        $pprocNewVersion = $pprocVersion;
                        $style = 'hidden';
                        $procversionStyle = ' ';
                    }
                }
            ?>

        <div class="panel panel-primary" <?php if ($pprocState == 4) { echo "hidden"; } ?> >
            <div class="panel-heading">Action</div>
            <div class="panel-body">
                <a class="btn btn-primary" href="edit_procedure.php?procid=<?php echo $pprocid ?>&procname=<?php echo $pprocTitle ?>&procArch=<?php echo $arch ?>">Edit Procedure</a>
                <input class="btn btn-warning" style="float:right" type="button" value="Close" onclick="self.close()">
            </div>
        </div>

        <div class="panel panel-primary" <?php if ($pprocState != 4) { echo "hidden"; } ?>>
            <div class="panel-heading">Action</div>
            <div class="panel-body">
                <form action="./adds/procedure_queries.php" method="post">
                    <div class="alert alert-danger" role="alert" <?php echo $style ?> style="font-size:20px; background-color: red; color: white;">
                        <strong class="pulsate">Warning!</strong>
                        Newer version available in Procedure Storage!
                    </div>
                    <input type="hidden" name="procarchid" value="<?php echo $pprocid ?>">
                    <input type="hidden" name="procidhistory" value="<?php echo $pprocidHistory ?>">
                    <input type="hidden" name="procversion" value="<?php echo $pprocNewVersion ?>">
                    <input  class="btn btn-primary" type="submit" name="procedureApprove" value="Approve">
                    <input  class="btn btn-warning" style="float:right" type="submit" name="procedureReject" value="Reject">
                </form>
            </div>
        </div>

        <div class="panel-group procedure-list-group" role="tablist" aria-multiselectable="true"> 
            <div class="panel panel-primary">
                <div class="panel-heading" style="padding-left: 0"> 
                    <h4 class="panel-title"> 
                        <ul class="procedure-tabs">
                            <li class="active"><a data-toggle="tab" href="#classification">Classification</a></li>
                            <li ><a data-toggle="tab" href="#history">History</a></li>
                            <li ><a data-toggle="tab" href="#security">Security</a></li>
                        </ul>
                    </h4> 
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="classification" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-xs-1">
                                    Title:
                                </div>
                                <div class="col-xs-9 padding-bot-15">
                                    <strong><?php echo $pprocTitle ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    System:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocSystem ?>
                                </div>
                                <div class="col-xs-2">
                                    Author:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocAuthor ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    Country:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocCountry ?>
                                </div>
                                
                                <div class="col-xs-2">
                                    Version:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocVersion ?>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    Functional Area:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocFuncArea ?>
                                </div>                                
                                <?php if ($arch == 1) { ?>
                                <div class="col-xs-2" style=" <?php echo $procversionStyle ?> ">
                                    Active Version:
                                </div>
                                <div class="col-xs-1" style=" <?php echo $procversionStyle ?> ">
                                    <?php echo $pprocVersionActive ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div id="history" class="tab-pane fade">
                            <div class="row">
                                <table class="table table-hover" style="font-size: 14px">
                                    <thead> 
                                        <tr>
                                            <th class="col-xs-2">When</th>
                                            <th >Who</th>
                                            <th >Version</th>
                                            <th class="col-xs-2">What</th>
                                            <th >Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $procHistory = selectProcedureHistory($pprocidHistory, $arch); ?>
                                        <?php foreach ($procHistory as $key => $procHistoryItem){
                                            echo "<tr>";
                                                echo '<td>'.$procHistoryItem[3].'</td>';
                                                echo '<td>'.$procHistoryItem[2].'</td>';
                                                echo '<td>'.$procHistoryItem[5].'</td>';
                                                echo '<td>'.$procHistoryItem[6].'</td>';
                                                echo '<td>'.$procHistoryItem[7].'</td>';
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="security" class="tab-pane fade">
                            <div class="row">
                                <div class="col-xs-2">
                                    Security:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocFuncArea ?>
                                </div>                                
                                <?php if ($arch == 1) { ?>
                                <div class="col-xs-2" style=" <?php echo $procversionStyle ?> ">
                                    Active Version:
                                </div>
                                <div class="col-xs-1" style=" <?php echo $procversionStyle ?> ">
                                    <?php echo $pprocVersionActive ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion1" role="tablist" aria-multiselectable="true">        

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOneH"> 
                        <h4 class="panel-title"> 
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOneH" aria-expanded="false" aria-controls="collapseOneH"> 
                            Description
                            </a>
                        </h4> 
                    </div>
                    <div id="collapseOneH" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOneH" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $pprocDescript ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion2" role="tablist" aria-multiselectable="true">        

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingTwo"> 
                        <h4 class="panel-title"> 
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> 
                                Dependecies
                            </a>
                        </h4> 
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $pprocDependecies ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion3" role="tablist" aria-multiselectable="true">

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 
                                Access To Systems
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $pprocAccess ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion4" role="tablist" aria-multiselectable="true">        
                
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> 
                                Process Description
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $pprocDescription ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion6" role="tablist" aria-multiselectable="true">        
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingSix">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion6" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> 
                                Troubleshooting
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $pprocTroubleshooting ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion7" role="tablist" aria-multiselectable="true">        
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingSeven">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion7" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> 
                                Business Impact
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $pprocImpact ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
    </div>
        <?php
            include_once("/js/js.php");
            include_once('./adds/footer.php');
        ?>
</body>
</html>