<?php
	session_start();
?>

<html lang="en">
<head>
	<?php
		$procidd = $_GET['procID'];
		$procname = $_GET['procName'];
		echo '<title>Procedure: '.$procname.'</title>';
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
                $selectProcedure = procedurez($procidd);
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
                }
            ?>



        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion0" role="tablist" aria-multiselectable="true"> 

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne"> 
                        <h4 class="panel-title"> 
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion0" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">  
                            Classification
                            </a>
                        </h4> 
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-1">
                                    Title:
                                </div>
                                <div class="col-xs-9 padding-bot-15">
                                    <strong><?php echo $pprocTitle ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1">
                                    System:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocSystem ?>
                                </div>
                                <div class="col-xs-2">
                                    Functional Area:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocFuncArea ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1">
                                    Country:
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $pprocCountry ?>
                                </div>
                                <div class="col-xs-2">
                                    Version:
                                </div>
                                <div class="col-xs-2">
                                    6.00
                                </div>
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
        ?>
</body>
</html>