<?php

/* 
 * Vue pour la selection de la fiche de frais avec la recherche par nom
 */

?>
<div class="row">
    <div class="col-md-5">
        <h4>Entrer un nom : </h4>
        <form name="form" method="post" action="<?php echo 'index.php?uc=validFrais&action=choisirFrais&search' ?>">
            <div class="form-group">
                <input name="name" id="chercherNom"
                       class="form-control"
                       type="text"
                       value="<?php
                       // si search et le nom du visiteur sont passés en parametre : j'affiche la liste filtrée par nom
                       if (isset($_GET['search']) && isset($leNom)) {
                           echo $leNom;
                       }
                       ?>">
            </div>
        </form>
        <?php
        // si search et le nom du visiteur sont passés en parametre : j'affiche le nombre d'utilisateurs trouvés et un bouton pour retirer le filtre
        if (isset($_GET['search']) && isset($leNom)) {
            $nbr = count($visitorsFilter);
            echo '<h4 style="color:green"> La liste a été filtrée : ' . $nbr . ' visiteurs correspondent à votre recherche.</h4>';
            echo '<button style="background-color:red; color:white" id="myBtn" class="btn btn-danger"> Supprimer le filtre </button><br><br>';
        }
        ?>
    </div>
    <div class="col-md-5 form-group">
        <h4>Choisir un visiteur : </h4>
        <select id="lstVisiteur" name="lstVisiteur" onChange="change_function(this);"
                class="browser-default custom-select form-control">
            <option selected="selected">Choisir un visiteur</option>

            <?php
            // Si search n'est pas en parametre : j'affiche la liste complète des visiteurs
            if (!isset($_GET['search'])) {
                $visiteurs = $visitors;
            } else {
                $visiteurs = $visitorsFilter;
            }
            foreach ($visiteurs

            as $unVisiteur) {
            if (isset($_GET['Vid'])) {
            if ($_GET['Vid'] === $unVisiteur['Vid']){
            ?>
            <option selected="selected"
                    value="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $unVisiteur['Vid'] ?>">
                <?php
                } else {
                ?>
            <option value="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $unVisiteur['Vid'] ?>">
                <?php
                }

                } else {
                ?>
            <option value="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $unVisiteur['Vid'] ?>">
                <?php
                }
                echo $unVisiteur['Vnom'] . ' ' . $unVisiteur['Vprenom'];
                };

                ?>
            </option>
        </select>
        <h4>Mois : </h4>
        <select id="lstMois" name="lstMois" class="browser-default custom-select form-control"
                onChange="change_mois_function(this);">
            <option selected="selected" style="color:grey;">Choisir un mois</option>
            <?php
            foreach ($lesFiches as $month) {
                $month = $month['mois'];
                $numAnnee = $month['numAnnee'];
                $numMois = $month['numMois'];
                if ($month === $_GET['mois']) {
                    ?>
                    <option selected="selected"
                            value="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $month ?>">
                        <?php echo $numMois . '/' . $numAnnee ?>
                    </option>
                    <?php
                } else { ?>
                    <option value="<?php echo 'index.php?uc=validFrais&action=choisirFrais&Vid=' . $_GET['Vid'] . '&mois=' . $month ?>">
                        <?php echo $numMois . '/' . $numAnnee ?> </option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
</div>
<script>
    // function javascript : permet d'attribuer un href pour la redirection
    function change_function(element) {
        document.location.href = element.value;
    }

    // function javascript : permet d'attribuer un href pour la redirection
    function change_mois_function(element) {
        document.location.href = element.value;
    }

    // function javascript : permet d'attribuer un href pour la redirection
    function search_function(element) {
        document.location.href = element.value;
    }

    // function javascript : permet d'attribuer un href pour la redirection
    var btn = document.getElementById('myBtn');
    btn.addEventListener('click', function () {
        document.location.href = '<?php echo "index.php?uc=validFrais&action=choisirFrais"; ?>';
    });
</script>