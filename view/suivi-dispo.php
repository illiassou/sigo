<?php 
$repertoire = repertoire_outil_disponible($debut,$nombre_par_page);
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
                            <th>Quantité</th>
                            <th>Emplacement</th>
                            <th>Position</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($donnees = $repertoire->fetch()){ ?>
                      <tr class="unread">
                        <td class="inbox-small-cells"><i class="fa fa-star inbox-started">
                        <td class="view-message  dont-show"><a href="detail?param=<?=$donnees['id_desig']?>"><?= $donnees['ref_desig']?></a></td>
                        <td class="view-message  dont-show"><a href="detail?param=<?=$donnees['id_desig']?>"><?= $donnees['lib_desig']?></a></td>
                        <td class="view-message  inbox-small-cells"><span class="badge bg-theme"><?= $donnees['quantite']?></span></td>
                        <td class="view-message "><a href="detail?param=<?=$donnees['id_desig']?>"><?= $donnees['lib_emplacement']?></a></td>
                        <td class="view-message "><?=$donnees['lib_identification'].' / '.$donnees['lib_position']?></td>
                        <td class="view-message"></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <?php
                        }
                ?>