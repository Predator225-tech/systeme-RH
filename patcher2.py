import sys
with open('app/Views/admin/employes/index.php', 'r') as f:
    content = f.read()

target = """<td class="action-btns">
              <a href="/admin/employes/edit/<?= $e['id'] ?>" class="btn-sm btn-edit">Modifier</a>
              <a href="/admin/employes/delete/<?= $e['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Confirmer ?')">Supprimer</a>
            </td>"""

addition = """<td class="action-btns">
              <a href="/admin/employes/<?= $e['id'] ?>/soldes" class="btn-sm btn-forest"><i class="bi bi-wallet2"></i> Soldes</a>
              <a href="/admin/employes/edit/<?= $e['id'] ?>" class="btn-sm btn-edit">Modifier</a>
              <a href="/admin/employes/delete/<?= $e['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Confirmer ?')">Supprimer</a>
            </td>"""

content = content.replace(target, addition)

with open('app/Views/admin/employes/index.php', 'w') as f:
    f.write(content)

print("Done patching index employes.")
