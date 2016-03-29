<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Modal Test Procedure</title>
        <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">



    </head>

    <body>
    <?php 
        include_once('./adds/queries.php');
    ?>
    <div class="container" style="margin-top: 20px;">

                <?php 
                $procline = procedure(12);
                $countryID=1;
                foreach ($procline as $key => $pline) {
                    $procid = $pline[0];
                    $procTitle = $pline[1];
                    $procSystem = $pline[2];
                    $procCountry = $pline[3];
                    $procFuncArea = $pline[4];
                    $procDescript = $pline[5];
                    $procDependecies = $pline[6];
                    $procAccess = $pline[7];
                    $procDescription = $pline[8];
                    $procTroubleshooting = $pline[9];
                    $procImpact = $pline[10];
                }
            ?>



        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true"> 

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne"> 
                        <h4 class="panel-title"> 
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">  
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
                                    <strong><?php echo $procTitle ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1">
                                    System:
                                </div>
                                <div class="col-xs-2">
                                    SingleView
                                </div>
                                <div class="col-xs-2">
                                    Functional Area:
                                </div>
                                <div class="col-xs-2">
                                    Customer Care
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1">
                                    Country:
                                </div>
                                <div class="col-xs-2">
                                    Germany
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
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true">        

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOneH"> 
                        <h4 class="panel-title"> 
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOneH" aria-expanded="false" aria-controls="collapseOneH"> 
                            Description
                            </a>
                        </h4> 
                    </div>
                    <div id="collapseOneH" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOneH" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $procDescript ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true">        

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingTwo"> 
                        <h4 class="panel-title"> 
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> 
                                Dependecies
                            </a>
                        </h4> 
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $procDependecies ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 
                                Access To Systems
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $procAccess ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true">        
                
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> 
                                Process Description
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $procDescription ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true">        
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingSix">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> 
                                Troubleshooting
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $procTroubleshooting ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bs-example" data-example-id="collapse-accordion"> 
            <div class="panel-group procedure-list-group" id="accordion" role="tablist" aria-multiselectable="true">        
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingSeven">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> 
                                Business Impact
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven" aria-expanded="false">
                        <div class="panel-body">
                            <?php echo $procImpact ?>
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