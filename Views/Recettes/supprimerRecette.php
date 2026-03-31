<div class="flex space-evenly wrap">

    <form method="post">

        <fieldset>

            <legend>Supprimer la recette</legend>

            <p>
                Voulez vous vraiment supprimer la recette :
                <strong><?= $recette->rec_titre ?></strong> ?
            </p>

            <button class="btn btn-danger" name="confirmerSuppression">
                Supprimer
            </button>

            <a href="/mesRecettes" class="btn btn-secondary">
                Annuler
            </a>

        </fieldset>

    </form>

</div>
/*
 * Projet : Gestion de Recettes
 * Date : 31/03/2026
 */
