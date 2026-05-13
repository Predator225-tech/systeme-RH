<h1>Modifier le type de congé</h1>
<form method="post" action="/types_conge/update/<?= $type['id'] ?>">
    <label>Libellé<br><input name="libelle" required value="<?= esc($type['libelle']) ?>"></label><br>
    <label>Jours annuels<br><input type="number" name="jours_annuels" value="<?= esc($type['jours_annuels']) ?>"></label><br>
    <label>Déductible<br>
        <select name="deductible">
            <option value="1" <?= $type['deductible'] ? 'selected' : '' ?>>Oui</option>
            <option value="0" <?= !$type['deductible'] ? 'selected' : '' ?>>Non</option>
        </select>
    </label><br>
    <button type="submit">Mettre à jour</button>
</form>
