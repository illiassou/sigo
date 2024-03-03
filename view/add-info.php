<?php
if(isset($_GET['btn_add_desig']))
{
    $lib_desig = $_GET['lib_desig'];
    $ref_desig = $_GET['ref_desig'];
    $add_design = add_designation($ref_desig,$lib_desig);
    if($add_design == true)
    {
        $msg = 1;
    ?>
    <script type="text/javascript">
        $("#lib_desig").val('');
        $("#ref_desig").val('');
    </script>
    <?php
    }else
    {
        $msg = 2;
    }
}
?>
    <select class="form-control selectpicker" name="id_desig" id="id_desig" data-live-search="true" onchange="charge_ref()" required>
        <option value="" selected="selected">--Choisir la désignation--</option>
            <?php   $liste_designation = liste_designation();
                    while($donnne = $liste_designation->fetch())
                    {
                    ?>
                        <option value="<?=$donnne['id_desig']?>"><?=$donnne['ref_desig']?> / <?=$donnne['lib_desig']?></option>
                    <?php
                    }
                    ?>
    </select>

<!-- code js qui permet d'avoir un filtre sur chaque zone de liste deroulant -->
<script type="text/javascript">
    $('.selectpicker').selectpicker();    
</script>