<?php
/* 
 * Vue de la fiche avec les informations relatives
 */
?>
<div class="row">
    <div class="col-lg-4 forfaitise">
        <h2>Valider la fiche de frais</h2>
        <h3>Eléments forfaitisés</h3>
        <form name="form"
              action="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $_GET['mois'] . '&maj=fraisForfait' ?>"
              method="post">
            <label>Forfait Etape</label><br>
            <input name="ETP" class="form-control" type="number" value="<?php echo($fiche[0]['quantite']); ?>"><br>
            <label>Frais kilométrique</label><br>
            <input name="KM" class="form-control"  type="number" value="<?php echo($fiche[1]['quantite']); ?>"><br>
            <label>Nuitée Hôtel</label><br>
            <input name="NUI" class="form-control"  type="number" value="<?php echo($fiche[2]['quantite']); ?>"><br>
            <label>Repas Restaurant</label><br>
            <input name="REP" class="form-control" type="number" value="<?php echo($fiche[3]['quantite']); ?>"><br>
            <button type="submit" name="submit" value="Submit" class="btn btn-success">Corriger</button>
            <button type="submit" name="discard" value="discard" class="btn btn-danger">Réinitialiser</button>
        </form>
        <div style="padding-top: 20px;"></div>
    </div>

    <?php
    // Si hors forfait sinon inutile
    if ($horsForfait != null) {
        ?>
        <div style="padding-top: 50px;"></div>
        <div class="col-lg-12" id="tableau">
            <table class="col-lg-12">
                <tr class="entete">
                    <td class="col-lg-3 cellule">Descriptif des éléments hors forfait</td>
                    <td class="col-lg-3 cellule"></td>
                    <td class="col-lg-3 cellule"></td>
                    <td class="col-lg-3 cellule"></td>
                </tr>
                <tr>
                    <td class="col-lg-3 cellule">Date</td>
                    <td class="col-lg-3 cellule">Libellé</td>
                    <td class="col-lg-3 cellule">Montant</td>
                    <td class="col-lg-3 cellule"></td>
                </tr>
                <?php
                foreach ($horsForfait as $unHorsForfait) {
                    ?>
                    <form name="form"
                          action="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $_GET['mois'] . '&maj=fraisHorsForfait&fraisId=' . $unHorsForfait['id'] ?>"
                          method="post">
                        <tr>
                            <td class="col-lg-3 cellule"><input name="date" class="form-control" type="text"
                                                                value="<?php echo($unHorsForfait['date']); ?>"></td>
                            <td class="col-lg-3 cellule"><input name="libelle" class="form-control" type="text"
                                                                value="<?php echo($unHorsForfait['libelle']); ?>"></td>
                            <td class="col-lg-3 cellule"><input name="montant" class="form-control" type="text"
                                                                value="<?php echo($unHorsForfait['montant']); ?>"></td>
                            <td class="col-lg-3 cellule">
                                <button type="submit" class="btn btn-success"> Corriger</button>
                                <button type="submit" name="discard" value="discard" class="btn btn-danger">
                                    Réinitialiser
                                </button>
                            <td>
                        </tr>
                    </form>

                <?php } ?>
            </table>
        </div>
        <div class="col-lg-12">
            <h3>Nombre de justificatifs : </h3>
            <input name="justificatif" class="form-control" type="text" value="<?php echo($justificatifs); ?>" disabled> <br><br>
        </div>
    <?php } ?>
    <div class="col-lg-12 validation">
        <form name="form"
              action="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $_GET['mois'] . '&maj=validationFiche' ?>"
              method="post">
            <button type="submit" class="btn btn-success"> Valider la fiche de frais</button>
        </form>
        <div style="padding-bottom: 20px;"></div>
    </div>
       
       
