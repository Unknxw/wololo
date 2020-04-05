<?php

/* 
 * Vue pour l'affichage du suivi de paiement 
 */
// Condition afin de savoir le statut de la fiche : Si "RB" alors le remboursement est effectué
if($Infos[0] === "RB"){
?>
    <h2 style="text-decoration:underline; color:green">Le remboursement à été effectué </h2>
    <input class="form-control" type="text" placeholder="Remboursement : <?php echo($Infos[3]); ?>€" disabled>
<?php
} else {
 ?>
    <h2 style="text-decoration:underline">La fiche est en cours de paiement</h2>
    <input class="form-control" type="text" placeholder="Remboursement : <?php echo($Infos[3]); ?>€" disabled>
<?php
}
?>
<div class="row">
    <div class="col-lg-4 forfaitise">
    <h2>Eléments forfaitisés</h2>
    <h3>Forfait Etape</h3>
    <input class="form-control" name="ETP" value="<?php echo($fiche[0]['quantite']); ?>" disabled><br>
    <h3>Frais kilométrique</h3>
    <input class="form-control" name="KM" value="<?php echo($fiche[1]['quantite']); ?>" disabled><br>
    <h3>Nuitée Hôtel</h3>
    <input class="form-control" name="NUI" value="<?php echo($fiche[2]['quantite']); ?>" disabled><br>
    <h3>Repas Restaurant</h3>
    <input class="form-control" name="REP" value="<?php echo($fiche[3]['quantite']); ?>" disabled><br>
    </div>
<?php 
     //Condition afin de detecter si il y'a du hors forfait à afficher
    if($horsForfait != null){
?>
    <div class="col-lg-12" id="tableau">
        <table class="col-lg-12">
            <tr class="entete">
                <td class="col-lg-3 cellule"><h4>Descriptif des éléments hors forfait</h4></td>
                <td class="col-lg-3 cellule"></td>
                <td class="col-lg-3 cellule"></td>
            </tr>
            <tr>
                <td class="col-lg-3 cellule">Date</td>
                <td class="col-lg-3 cellule">Libellé</td>
                <td class="col-lg-3 cellule">Montant</td>
            </tr>
        <?php 
            foreach ($horsForfait as $unHorsForfait) {
        ?>
            <tr>
                <td class="col-lg-3 cellule"><input name="date" class="form-control" value="<?php echo($unHorsForfait['date']); ?>" disabled></td>
                <td class="col-lg-3 cellule"><input name="libelle" class="form-control" value="<?php echo($unHorsForfait['libelle']); ?>" disabled></td>
                <td class="col-lg-3 cellule"><input name="montant" class="form-control" value="<?php echo($unHorsForfait['montant']); ?>" disabled></td>
            </tr>
            
        <?php } ?>
         </table>
        </div>
    <div class="col-lg-12 justificatif">
        <label>Nombre de justificatifs : </label>
        <input class="form-control" name="justificatif" type="text" value="<?php echo($justificatifs); ?>" disabled> <br><br>
    </div>
        <?php } ?>