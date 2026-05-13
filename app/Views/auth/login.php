<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title><?= esc($title ?? 'Connexion') ?> — Portail Conges</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
<style>
:root{
  --ink:#1d2b22;
  --forest:#2d5a3d;
  --forest2:#3d7a52;
  --leaf:#5fa876;
  --mint:#d4ede0;
  --cream:#f6f4ee;
  --white:#ffffff;
  --border:#dfe7e0;
  --muted:#7a8f80;
}
*{box-sizing:border-box}
body{margin:0;font-family:'DM Sans',sans-serif;background:linear-gradient(130deg,#f6f4ee 0%,#edf5ee 55%,#e6efe7 100%);color:var(--ink)}
.hero{min-height:100vh;display:grid;grid-template-columns:1.1fr .9fr;align-items:center;gap:2rem;padding:3rem}
.card{background:var(--white);border:1px solid var(--border);border-radius:18px;padding:2rem 2.2rem;box-shadow:0 10px 30px rgba(20,30,20,.08)}
.brand{display:flex;align-items:center;gap:.75rem;margin-bottom:1.2rem}
.brand-mark{width:44px;height:44px;border-radius:12px;background:var(--forest);display:flex;align-items:center;justify-content:center;color:var(--white);font-family:'DM Mono',monospace;font-weight:600}
.brand-name{font-family:'Playfair Display',serif;font-size:1.35rem}
.brand-sub{font-size:.8rem;color:var(--muted)}
.h-title{font-family:'Playfair Display',serif;font-size:2.2rem;margin:0 0 .4rem}
.h-copy{color:var(--muted);max-width:34ch;margin:0 0 1.5rem}
.f-group{margin-bottom:1rem}
.f-label{display:block;font-size:.8rem;font-weight:500;margin-bottom:6px}
.f-input{width:100%;padding:12px 14px;border-radius:10px;border:1.5px solid var(--border);font-size:.95rem;font-family:'DM Sans',sans-serif}
.f-input:focus{outline:none;border-color:var(--forest);box-shadow:0 0 0 3px rgba(45,90,61,.12)}
.btn{width:100%;padding:12px 14px;border-radius:10px;border:none;background:var(--forest);color:var(--white);font-weight:600;font-size:.95rem;cursor:pointer;transition:background .15s}
.btn:hover{background:var(--forest2)}
.flash{padding:10px 12px;border-radius:10px;font-size:.85rem;margin-bottom:1rem}
.flash-error{background:#fdeeee;color:#c03a2b;border:1px solid #f3b9b2}
.flash-success{background:#edf7f2;color:#1e6b3f;border:1px solid #8fd4aa}
.side{padding:1.5rem 2rem}
.stat{border-left:2px solid var(--forest);padding-left:1rem;margin-bottom:1rem}
.stat h3{font-family:'Playfair Display',serif;margin:.2rem 0;font-size:1.1rem}
@media(max-width:980px){.hero{grid-template-columns:1fr;padding:2rem}.side{order:-1}}
</style>
</head>
<body>
<div class="hero">
  <div class="card">
    <div class="brand">
      <div class="brand-mark">RH</div>
      <div>
        <div class="brand-name">Portail Conges</div>
        <div class="brand-sub">Connexion securisee</div>
      </div>
    </div>

    <h1 class="h-title">Bienvenue</h1>
    <p class="h-copy">Connectez-vous pour acceder a votre espace employe, RH ou admin.</p>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="flash flash-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="flash flash-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <form method="post" action="/login">
      <?= csrf_field() ?>
      <div class="f-group">
        <label class="f-label" for="email">Email</label>
        <input class="f-input" id="email" name="email" type="email" value="<?= esc(old('email') ?? '') ?>" required />
      </div>
      <div class="f-group">
        <label class="f-label" for="password">Mot de passe</label>
        <input class="f-input" id="password" name="password" type="password" value="password" required />
      </div>
      <button class="btn" type="submit">Se connecter</button>
    </form>
  </div>

  <div class="side">
    <div class="stat">
      <h3>3 espaces, un seul compte</h3>
      <p style="color:var(--muted);margin:0">Admin, RH et employe ont chacun un tableau de bord adapte.</p>
    </div>
    <div class="stat">
      <h3>Acces rapide aux conges</h3>
      <p style="color:var(--muted);margin:0">Demandez, suivez et gerez les conges sans friction.</p>
    </div>
  </div>
</div>
</body>
</html>
