<?php
if(isset($_GET['add_emplacement']))
{
 $lib_emplacement = $_GET['lib_emplacement'];
 $add_emplacement = add_emplacement($lib_emplacement);
 if($add_emplacement == true)
 {
    $msg = 1;
?>
<script type="text/javascript">
    $("#lib_emplacement").val('');	
</script>
<?php
 }else
 {
    $msg = 2;
 }
}
?>
<select class="form-control selectpicker" name="id_emplacement" id="id_emplacement" data-live-search="true" required>
        <option value="" selected>--Choisir un emplacement--</option>
        <?php   $liste_emplacement = liste_emplacement();
                while($donnne = $liste_emplacement->fetch())
                {
        ?>
                <option value="<?=$donnne['id_emplacement']?>"><?=$donnne['lib_emplacement']?></option>
        <?php
                }
        ?>
</select>

<!-- code js qui permet d'avoir un filtre sur chaque zone de liste deroulant -->
<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script> 