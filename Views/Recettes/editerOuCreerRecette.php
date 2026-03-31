<div class="flex space-evenly wrap">
    <form method="post" action="">
        <fieldset>
            <legend><?= isset($recette) ? "Modifier la recette" : "Créer une recette" ?></legend>

            <!-- Titre -->
            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control"
                <?php if(isset($recette)) : ?> value="<?= $recette->rec_titre ?>" <?php endif ?>>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"><?php if(isset($recette)) echo $recette->rec_description; ?></textarea>
            </div>

            <!-- Ingrédients -->
            <div class="mb-3">
                <label class="form-label">Ingrédients</label>
                <textarea name="ingredients" class="form-control"><?php if(isset($recette)) echo $recette->rec_ingredients; ?></textarea>
            </div>

            <!-- Etapes -->
            <div class="mb-3">
                <label class="form-label">Etapes</label>
                <textarea name="etapes" class="form-control"><?php if(isset($recette)) echo $recette->rec_etapes; ?></textarea>
            </div>

            <!-- Temps préparation -->
            <div class="mb-3">
                <label class="form-label">Temps préparation (min)</label>
                <input type="number" name="temps_preparation" class="form-control"
                <?php if(isset($recette)) : ?> value="<?= $recette->rec_temps_preparation ?>" <?php endif ?>>
            </div>

            <!-- Difficulté -->
            <div class="mb-3">
                <label class="form-label">Difficulté</label>
                <select name="difficulte" class="form-control">
                    <option value="facile" <?= isset($recette) && $recette->rec_difficulte == "facile" ? "selected" : "" ?>>Facile</option>
                    <option value="moyen" <?= isset($recette) && $recette->rec_difficulte == "moyen" ? "selected" : "" ?>>Moyen</option>
                    <option value="difficile" <?= isset($recette) && $recette->rec_difficulte == "difficile" ? "selected" : "" ?>>Difficile</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label class="form-label">Image (url)</label>
                <input type="text" name="image" class="form-control"
                <?php if(isset($recette)) : ?> value="<?= $recette->rec_image ?>" <?php endif ?>>
            </div>

            <!-- Catégorie -->
            <div class="mb-3">
                <label class="form-label">Catégorie</label>
                <select name="rec_cat_id" class="form-control">
                    <?php foreach($categories as $categorie) : ?>
                        <option value="<?= $categorie->rec_cat_id ?>"
                        <?= isset($recette) && $recette->rec_cat_id == $categorie->rec_cat_id ? "selected" : "" ?>>
                            <?= $categorie->cat_nom ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Tags -->
            <div class="mb-3">
                <label class="form-label">Tags</label>
                <?php foreach($tags as $tag) : ?>
                    <div>
                        <input type="checkbox" name="tags[]" value="<?= $tag->tre_tag_id ?>"
                        <?php
                        if(isset($tagsActiveRecette)) {
                            foreach($tagsActiveRecette as $tagActive) {
                                if($tagActive->tre_tag_id == $tag->tre_tag_id) echo "checked";
                            }
                        }
                        ?>>
                        <?= $tag->cat_nom ?>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- Bouton -->
            <div class="flex space-between mt-3">
                <button class="btn btn-primary" name="btnEnvoi">
                    <?= isset($recette) ? "Modifier" : "Créer" ?>
                </button>
            </div>

        </fieldset>
    </form>
</div>