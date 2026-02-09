<form method="POST" action="/ajouterrecette">
    <div class="form-group">
        <label for="nom">Nom de la recette</label>
        <input type="text" id="nom" name="nom" placeholder="Ex: Soupe de légumes">
    </div>
    
    <div class="form-group">
        <label for="ingredients">Ingrédients</label>
        <textarea id="ingredients" name="ingredients" placeholder="Carottes, pommes de terre, oignons..."></textarea>
    </div>
    
    <div class="form-group">
        <label for="temps">Temps de préparation (minutes)</label>
        <input type="number" id="temps" name="temps" placeholder="45">
    </div>
    
    <div class="form-group">
        <label for="type">Type de plat</label>
        <select id="type" name="type">
            <option value="">Choisir...</option>
            <?php foreach ($typesPlat as $type) : ?>
                <option value="<?= $type->id ?>"><?= $type->nom ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="difficulte">Difficulté</label>
        <select id="difficulte" name="difficulte">
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="image">Photo</label>
        <input type="file" id="image" name="image">
    </div>
    
    <button type="submit">Ajouter la recette</button>
</form>