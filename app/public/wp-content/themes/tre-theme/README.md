# TRE Radio — Thème WordPress

## Installation

1. **Compresser** le dossier `tre-theme/` en fichier `.zip`
2. Dans WordPress : **Apparence → Thèmes → Ajouter → Téléverser un thème**
3. Sélectionner le `.zip` → **Installer** → **Activer**

---

## Configuration après activation

### 1. Menus (Apparence → Menus)

Créer **3 menus** et les assigner aux emplacements :

| Emplacement | Contenu |
|---|---|
| **Menu Principal (Onglets)** | Vos catégories TRE avec sous-catégories. Pour l'icône : renseigner l'emoji dans le champ **Description** de chaque item de menu principal (ex: `💼`). |
| **Barre Supérieure** | Liens Espace Membres / Partenaires / Investisseurs |
| **Menu Footer** | Liens légaux / contact |

> **Astuce dropdowns** : dans le menu principal, créez un item parent (ex: "Travail & Carrière") puis glissez ses sous-éléments en retrait pour créer la hiérarchie.

---

### 2. Widgets (Apparence → Widgets)

| Zone | Usage |
|---|---|
| **Bannière Pub (728×90)** | Glisser un widget Image ou HTML avec votre pub 728×90 |
| **Sidebar Pub (300×250)** | Pub rectangle sidebar |
| **Footer Col 1/2/3** | Menus de navigation ou texte libre |
| **Sidebar Principale** | Widgets supplémentaires en sidebar |

---

### 3. Article à la une

Pour choisir l'article affiché en grande UNE sur la homepage :
→ Éditez l'article → cochez **"Mettre en avant"** (épingler)

---

### 4. Images recommandées

| Taille générée | Usage |
|---|---|
| `tre-hero` 900×480 | Grande UNE homepage |
| `tre-card` 600×360 | Cartes grille 3 colonnes |
| `tre-horiz` 260×200 | Articles horizontaux |
| `tre-sidebar` 150×120 | Articles sidebar |

Régénérer les miniatures avec le plugin **Regenerate Thumbnails** si nécessaire.

---

### 5. Newsletter

Le widget newsletter fonctionne nativement. Pour l'intégrer à Mailchimp :
- Installer le plugin **MC4WP: Mailchimp for WordPress**
- Le shortcode `[mailchimp]` sera automatiquement détecté

---

### 6. Publicités

Pour gérer les emplacements pub de façon avancée :
- Installer le plugin **Advanced Ads** ou **Ad Inserter**
- Placer les annonces dans les zones sidebar **Bannière Pub** et **Sidebar Pub**

---

## Structure des fichiers

```
tre-theme/
├── style.css          ← En-tête thème + styles complets
├── functions.php      ← Fonctions, menus, widgets, helpers
├── index.php          ← Homepage magazine
├── single.php         ← Article individuel
├── archive.php        ← Pages catégorie / tag
├── page.php           ← Pages statiques
├── search.php         ← Résultats recherche
├── 404.php            ← Page d'erreur
├── header.php         ← En-tête HTML (top bar, logo, nav, pub)
├── footer.php         ← Pied de page
├── sidebar.php        ← Sidebar droite
├── assets/
│   └── js/
│       └── main.js    ← JS : dropdowns mobile, scroll animations
└── languages/         ← Dossier traductions .po/.mo
```

---

## Plugins recommandés

| Plugin | Utilité |
|---|---|
| Yoast SEO | Référencement |
| MC4WP Mailchimp | Newsletter |
| Advanced Ads | Gestion publicités |
| WP Super Cache | Performance |
| Smush | Optimisation images |
| Contact Form 7 | Formulaires |

---

**Version** : 1.0.0 · **Auteur** : TRE Radio · **Licence** : GPL v2
