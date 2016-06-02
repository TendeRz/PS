<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Procedure</title>
        <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
        <link rel="stylesheet" href="/root/PS/css/spoiler.css">
        <link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
    </head>
    <body>
    <div class="container">
        <?php
            include_once('login_check.php');
            include_once('navigation.php');
            include_once('./adds/queries.php');
            include_once('./js/js.php');
            include_once('./js/ck_editor_js.php');
            include_once('./adds/modal.php');
        ?>
    
<script> 
    $(document).ready(function() {
        CKEDITOR.timestamp='ABCD'; 
        });
</script>
        
        <div class="panel-group" style="margin-top: 20px">
            <form action="./adds/queries.php" method="post">



                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">

                            <div class="row">
                                <div class="col-xs-2">
                                    Procedure Title
                                </div>
                                <div class="col-xs-9 classification newProcTitle">
                                    <textarea class="procTitle" name="procTitle" rows="1" cols="50"></textarea>
                                </div>
                            </div>
                        </h4>
                    </div>
                </div>

                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <div>
                                <?php
                                echo '<div class="row">';
                                    $dropSyst = selectAll('classsystem');
                                    echo '<div class="col-xs-2">System  </div><div class="col-xs-9 classification">';
                                        echo '<select class="ddropdown" name="System">';
                                            foreach ($dropSyst as $key => $dropSystItem) {
                                            echo '<option value='.$dropSystItem[0].'>'.$dropSystItem[1].'</option>';
                                            }
                                        echo '</select>';
                                        echo '<button type="button" data-toggle="modal" data-target="#newSystemModal" class="btn btn-default btn-xs newProc-Button-Add" disabled="true">Add System</button>';
                                    echo'</div>';
                                echo'</div>';
                                ?>
                            </div>

                            <div>
                                <?php
                                echo '<div class="row">';
                                    $dropCountry = selectAll('classcountry');
                                    echo '<div class="col-xs-2">Country  </div><div class="col-xs-9 classification">';
                                        echo '<select class="ddropdown" name="Country">';
                                            foreach ($dropCountry as $key => $dropCountryItem) {
                                            echo '<option value='.$dropCountryItem[0].'>'.$dropCountryItem[1].'</option>';
                                            }
                                        echo '</select>';
                                        echo '<button type="button" data-toggle="modal" data-target="#newCountryModal" class="btn btn-default btn-xs newProc-Button-Add" disabled="true">Add Country</button>';
                                    echo'</div>';
                                echo'</div>';
                                ?>
                            </div>

                            <div>
                                <?php
                                echo '<div class="row">';
                                    $dropFunc = selectAll('classfuncarea');
                                    echo '<div class="col-xs-2">Functional Area  </div><div class="col-xs-9 classification">';
                                        echo '<select class="ddropdown" name="FuncArea">';
                                            foreach ($dropFunc as $key => $dropFuncItem) {
                                            echo '<option value='.$dropFuncItem[0].'>'.$dropFuncItem[1].'</option>';
                                            }
                                        echo '</select>';
                                        echo '<button type="button" data-toggle="modal" data-target="#newFuncAreaModal" class="btn btn-default btn-xs newProc-Button-Add" disabled="true">Add Functional Area</button>';
                                    echo'</div>';
                                echo'</div>';
                                ?>
                            </div>
                        </h4>
                    </div>
                </div>


                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="newProcDescription" href="#newProcDescription">
                                Description
                            </a>
                        </h4>
                    </div>
                    <div id="newProcDescription" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea class="text-are-line-height" name="procDescript" ></textarea>
                            <script>
                                $(document).ready(function() {
                                    CKEDITOR.replace( 'procDescript', {
                                        "filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
                                        "filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
                                        imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"
                                    });
                                });
                            </script>                          
                        </div>
                    </div>
                </div>





                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="newProcDependencies" href="#newProcDependencies">
                                Dependencies
                            </a>
                        </h4>
                    </div>
                    <div id="newProcDependencies" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea class="text-are-line-height" name="procDependecies" rows="3" cols="155"></textarea>
                            <script>
                                $(document).ready(function() {
                                    CKEDITOR.replace( 'procDependecies', {
                                        "filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
                                        "filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
                                        imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"

                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>





                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="newProcAccess" href="#newProcAccess">
                                Access To System
                            </a>
                        </h4>
                    </div>
                    <div id="newProcAccess" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea class="text-are-line-height" name="procAccess" rows="3" cols="155"></textarea>
                            <script>
                                $(document).ready(function() {
                                    CKEDITOR.replace( 'procAccess', {
                                        "filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
                                        "filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
                                        imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"

                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>




                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="newProcDesc" href="#newProcDesc">
                                Process Description
                            </a>
                        </h4>
                    </div>
                    <div id="newProcDesc" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea class="procDescription" name="procDescription" rows="3" cols="155"></textarea>
                            <script>
                                $(document).ready(function() {
                                    CKEDITOR.replace( 'procDescription', {
                                        "filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
                                        "filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
                                        imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"

                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>




                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="newProcTroubleshooting" href="#newProcTroubleshooting">
                                Troubleshooting
                            </a>
                        </h4>
                    </div>
                    <div id="newProcTroubleshooting" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea class="procDescription" name="procTroubleshooting" rows="3" cols="155"></textarea>
                            <script>
                                $(document).ready(function() {
                                    CKEDITOR.replace( 'procTroubleshooting', {
                                        "filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
                                        "filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
                                        imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"

                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>


                <div class="row panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" aria-expanded="false" aria-controls="newProcBusinessImpact" href="#newProcBusinessImpact">
                                Business Impact
                            </a>
                        </h4>
                    </div>
                    <div id="newProcBusinessImpact" class="panel-collapse collapse">
                        <div class="panel-body">
                            <textarea class="procDescription" name="procImpact" rows="3" cols="155"></textarea>
                            <script>
                                $(document).ready(function() {
                                    CKEDITOR.replace( 'procImpact', {
                                        "filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
                                        "filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
                                        "filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
                                        imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <input  class="btn btn-primary btn-lg" type="submit" name="newProcedure" style="margin-top: 20px" disabled="true">
            </form>
        </div>
    </div>
    </body>
</html>