<?php 
$repertoire = repertoire_outil_en_operation($debut,$nombre_par_page);
if($repertoire->rowCount() <= 0) 
                        {
                            echo "Aucun resultat !!!";
                        } else 
                        {
                ?>
                <div class="table-inbox-wrap ">
                  <table class="table table-inbox table-hover">
                  <thead>
                        <tr>
                            <th></th>
                            <th>Réference</th>
                            <th>Désignation</th>
                            <th>Etat</th>
                            <th>Date retoure</th>
                            <th>Technicien</th>
                            <th>Mission</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($donnees = $repertoire->fetch()){ ?>
                      <tr class="unread">
                        <td class="inbox-small-cells"><i class="fa fa-star inbox-started">
                        <td class="view-message  dont-show"><a href="detail?param=<?=$donnees['id_desig']?>"><?= $donnees['ref_outil']?></a></td>
                        <td class="view-message  dont-show"><a href="detail?param=<?=$donnees['id_desig']?>"><?= $donnees['lib_desig']?></a></td>
                        <td class="view-message  inbox-small-cells"><span class="badge bg-theme"><?= $donnees['lib_etat']?></span></td>
                        <td class="view-message "><a href="detail?param=<?=$donnees['id_desig']?>"><?= $donnees['date_retour_outil']?></a></td>
                        <td class="view-message "><?=$donnees['nom_agent'].' '.$donnees['prenom_agent']?></td>
                        <td class="view-message "><?=$donnees['mission']?></td>
                        <td class="view-message"></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <?php
                        }
                ?>