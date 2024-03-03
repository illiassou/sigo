<?php
if(isset($_GET['add_identification']))
{
 $lib_identification = $_GET['lib_identification'];
 $add_identification = add_identification($lib_identification);
 if($add_identification == true)
 {
    $msg = 1;
?>
<script type="text/javascript">
    $("#lib_identification").val('');	
</script>
<?php
 }else
 {
    $msg = 2;
 }
}
?>
<select class="form-control selectpicker" name="id_identification" id="id_identification" data-live-search="true" onchange="charge()" required>
        <option value="" selected>--Choisir une identification--</option>
        <?php   $liste_emplacement = liste_identification();
                while($donnne = $liste_emplacement->fetch())
                {
        ?>
                <option value="<?=$donnne['id_identification']?>"><?=$donnne['lib_identification']?></option>
        <?php
                }
        ?>
</select>

<!-- code js qui permet d'avoir un filtre sur chaque zone de liste deroulant-->
<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>