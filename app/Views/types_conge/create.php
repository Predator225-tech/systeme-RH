<h1>Ajouter un type de congé</h1>
<form method="post" action="/types_conge/store">
    <label>Libellé<br><input name="libelle" required></label><br>
    <label>Jours annuels<br><input type="number" name="jours_annuels" value="0"></label><br>
    <label>Déductible<br>
        <select name="deductible">
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
    </label><br>
    <button type="submit">Enregistrer</button>
</form>
