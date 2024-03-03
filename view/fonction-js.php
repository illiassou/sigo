<!--<script type="text/javascript" >

  var select_box_element = document.querySelector('#id_desig');
  dselect(select_box_element, {

    search: true
  })
</script>-->




<!--********************************************************************************************************-->

<script type="text/javascript">
 

    $(document).ready(function() {
      
      var oTable = $('#hidden-table-info').dataTable({
      });
    
    });
  </script>

<script type="text/javascript">
 

 $(document).ready(function() {
   
   var oTable = $('#hidden-table-info2').dataTable({
   });
 
 });
</script>

  <!-- La fonction qui permet d'exporter un table vers excel -->
<script type="text/javascript">
    
    $('#exporter').click(function(){
        $("#hidden-table-info").table2excel({
        name: "Répertoire des outils",
        filename: "Répertoire des outils.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });
        });
</script>


<script type="text/javascript">
    
    $('#exporter_suivi').click(function(){
        $("#hidden-table-info").table2excel({
        name: "Suivi des outils",
        filename: "Suivi des outils.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });
        });
</script>


<script type="text/javascript">
    
    $('#exporter_sortie').click(function(){
        $("#hidden-table-info").table2excel({
        name: "Entrées sorties des outils",
        filename: "Entrées sorties des outils.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });
        });
</script>

<!-- Fonction js pour gerer l'emregistrement de la nouvelle designation !-->
<script type="text/javascript">
function add_designation()
{


lib_desig = $('#lib_desig').val();
ref_desig = $('#ref_desig').val();
btn_add_design = $('#add-desig').val();



$.ajax({

    type:"GET",
    url:"add-info",
    data:'lib_desig='+lib_desig+'&btn_add_desig='+btn_add_design+'&ref_desig='+ref_desig,
    success:function(server_response){
     
      $('#designation').html(server_response).show();
      
    }
})
}
  
</script>

<script type="text/javascript">
    
function add_designation_2()
{


lib_desig = $('#lib_desig_2').val();
ref_desig = $('#ref_desig_2').val();
btn_add_design = $('#add-desig_2').val();



$.ajax({

    type:"GET",
    url:"add-info-2",
    data:'lib_desig='+lib_desig+'&btn_add_desig='+btn_add_design+'&ref_desig='+ref_desig,
    success:function(server_response){
     
      $('#designation_2').html(server_response).show();
      
    }
})
}
  
</script>

<script type="text/javascript">
function add_composant()
{
    id_desig_2=$('#id_desig_2').val();
    id_etat_2 = $('#id_etat_2').val();
    image_comp = $('#image_comp').val();
$.ajax({

    type:"GET",
    url:"composant-add",
    data:'id_desig_2='+id_desig_2+'&id_etat_2='+id_etat_2+'&image_comp='+image_comp,
    success:function(server_response){
     
      $('#add-composant').html(server_response).show();
    }
})
}
  
</script>

<script type="text/javascript">
function supp_composant(id)
{
  
$.ajax({

    type:"GET",
    url:"composant-add",
    data:'supp='+id,
    success:function(server_response){
     
      $('#add-composant').html(server_response).show();
    }
})
}
  
</script>
<script type="text/javascript">
function supp_outil(id)
{
  
$.ajax({

    type:"GET",
    url:"add-outil-sortie",
    data:'supp='+id,
    success:function(server_response){
     
      $('#liste_outil').html(server_response).show();
    }
})
}
  
</script>

<!-- Fonction js pour gerer l'emregistrement de la nouvelle designation !-->
<script type="text/javascript">
    
function add_emplacement()
{


lib_emplacement=$('#lib_emplacement').val();
btn_add_emplacement = $('#add_emplacement').val();



$.ajax({
    type:"GET",
    url:"add-emplacement",
    data:'lib_emplacement='+lib_emplacement+'&add_emplacement='+btn_add_emplacement,
    success:function(server_response){
     
      $('#emplacement').html(server_response).show();
    }
})
}
  
</script>

<!-- Fonction js pour gerer l'emregistrement de la nouvelle designation!-->
<script type="text/javascript">
    
function add_identification()
{


  lib_identification=$('#lib_identification').val();
  btn_add_identification = $('#add_identification').val();



$.ajax({

    type:"GET",
    url:"add-identification",
    data:'lib_identification='+lib_identification+'&add_identification='+btn_add_identification,
    success:function(server_response){
     
      $('#identification').html(server_response).show();
    }
})
}
  
</script>

<script type="text/javascript">
function add_position()
{


  lib_position=$('#lib_position').val();
  id_identification=$('#id_identification_').val();
  btn_add_position = $('#add_position').val();



$.ajax({

    type:"GET",
    url:"add-position",
    data:'lib_position='+lib_position+'&add_position='+btn_add_position+'&id_identification='+id_identification,
    success:function(server_response){
     
      $('#cible').html(server_response).show();
    }
})
}
  
</script>

<script type="text/javascript">
    
function Open_composant_add()
{
    var checkeBox = document.getElementById('open');

    if(checkeBox.checked == true)
    {
      $("#composant-add").prop('hidden', false);
    }else
    {
      $("#composant-add").prop('hidden', true);
    }
}
  
</script>
<!-- Fonction charger les positions posible en fonction de l'identification -->

<script type="text/javascript">
    
    function charge()
    {

        id_identification=$('#id_identification').val();

        $.ajax({

            type:"GET",
            url:"charger-position",
            data:'id_identification='+id_identification,
            success:function(server_response){
            
              //$('#test').html(server_response).show();
              $('#position').html(server_response).show();
              $('#position_2').html(server_response).show();
            }
        })
      
    }
  
</script>

<script type="text/javascript">
    
    function charge_ref()
    {

        id_desig=$('#id_desig').val();

        $.ajax({

            type:"GET",
            url:"charger-reference",
            data:'id_desig='+id_desig,
            success:function(server_response){
            
              //$('#test').html(server_response).show();
              $('#reference').html(server_response).show();
            }
        })
      
    }
  
</script>


<script type="text/javascript">
    
    function add_outil_sortie(id)
    {

        id_outil    =    $('#id_outil'+id).val();
        id_etat     =    $('#id_etat'+id).val();
        lib_desig   =    $('#lib_desig'+id).val();
        lib_etat    =    $('#lib_etat'+id).val();
        ref_outil   =    $('#ref_outil'+id).val();
        image       =    $('#image'+id).val();

        $.ajax({

            type:"GET",
            url:"add-outil-sortie",
            data:'id_outil='+id_outil+'&id_etat='+id_etat+'&lib_desig='+lib_desig+
            '&lib_etat='+lib_etat+'&ref_outil='+ref_outil+'&image='+image,
            success:function(server_response){
            
              //$('#test').html(server_response).show();
              $('#liste_outil').html(server_response).show();
            }
        })
      
    }
  
</script>

<!-- Fonction recherche pour les listes deroulantes  -->
<script type="text/javascript">
  $('.selectpicker').selectpicker(); 
</script>
<!-- Fonction pour rechercher un outil en fonction de la reference ou de la designation
    la fonction consiste à declancher une requete en detectant la present du curseur dans la zone de text
-->

<script type="text/javascript">
    
$(function()
{

$('#recherche_outil').keyup(function(){

  if(!$("#recherche_outil").val().match(/^[a-zA-Z0-9 -/]+$/i))
  {
    $("#recherche_outil").css("border-color","#FF0000");
  }else
  {

    $("#recherche_outil").css("border-color","");

  recherche_outil=$('#recherche_outil').val();

  if(recherche_outil.length>2){

  $.ajax({

    type:"GET",
    url:"recherche-outil",
    data:'recherche='+ recherche_outil,
    success:function(server_response){
     
      $('#rech_outil').html(server_response).show();
    }
})
}
}

});


        });
  
 
  
</script>


<script type="text/javascript">
    
$(function()
{

$('#matricule').keyup(function(){

  if(!$("#matricule").val().match(/^[a-zA-Z0-9]+$/i))
  {
    $("#matricule").css("border-color","#FF0000");
  }else
  {
    $("#matricule").css("border-color","");

    matricule=$('#matricule').val();

  if(matricule.length>2){

  $.ajax({

    type:"GET",
    url:"recherche-agent",
    data:'matricule='+ matricule,
    success:function(server_response){
     
      $('#agent').html(server_response).show();
    }
})
}
  }
});
}); 
</script>

<script type="text/javascript">
    
$(function()
{

$('#matricule_a').keyup(function(){

  if(!$("#matricule_a").val().match(/^[a-zA-Z0-9]+$/i))
  {
    $("#matricule_a").css("border-color","#FF0000");
  }else
  {
    $("#matricule_a").css("border-color","");

    matricule=$('#matricule_a').val();

  if(matricule.length>2){

  $.ajax({

    type:"GET",
    url:"recherche-outil-retour",
    data:'matricule='+ matricule,
    success:function(server_response){
     
      $('#reponse').html(server_response).show();
    }
})
}
  }
});
}); 
</script>

<script type="text/javascript">
function add_retour_sortie(id)
{

$.ajax({

    type:"GET",
    url:"add-retour",
    data:'id_sortie='+id,
    success:function(server_response){
     
      $('#liste_outil_sortie').html(server_response).show();
      
    }
})
}
  
</script>

<script type="text/javascript">
function fitre($url)
{


id_etat = $('#etat_id').val();
id_statut = $('#statut_id').val();
id_emplacement = $('#empl_id').val();

$.ajax({

    type:"GET",
    url:$url,
    data:'id_etat='+id_etat+'&id_statut='+id_statut+'&id_emplacement='+id_emplacement,
    success:function(server_response){
     
      $('#tableau-suivi').html(server_response).show();
      
    }
})
}
  
</script>





