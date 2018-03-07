## Le formulaire de création de sondage
1. Créer un component nommé `create.vue` et l'ajouter dans `App.vue`.
1. Créer le template du formulaire comprenant un input pour le titre du sondage et deux input pour les réponses possible.
1. Faire en sorte que les inputs pour les réponses soient générés à partir d'un tableau.
1. Faire en sorte que l'on puisse ajouter et enlever à loisir des inputs de réponse au sondage.
1. Faire en sorte que l'on ne puisse pas avoir moins de deux inputs de réponse au sondage.

## Le formulaire de vote
```js
{
  title: "Que boire au petit-déjeuner ?",
  options: [
    {id: 1, text: "Thé"},
    {id: 2, text: "Café"},
    {id: 3, text: "Jus d'orange"},
    {id: 4, text: "Rien, je suis en retard"},
  ]
}
```
1. Créer un component nommé `answer.vue` et remplacer le component `create` par `answer` dans `App.vue`.
1. Générer un formulaire comportant des radios et un bouton submit à partir de l'objet ci-dessus.
1. Au submit du form, récupérer l'index de l'option qui à été cochée.
1. Toujours au moment du submit, mettre à jour l'objet `poll`.

## La visualisation des résultats
```js
{
  id: 1,
  title: "Que boire au petit-déjeuner ?",
  options: [
    {id: 1, text: "Thé", count: 10},
    {id: 2, text: "Café", count: 15},
    {id: 3, text: "Jus d'orange", count: 2},
    {id: 4, text: "Rien, je suis en retard", count: 21}
  ]
}
```

1. Créer un component nommé `result.vue` et remplacer le component `answer` par `result` dans `App.vue`.
1. Calculer le nombre total de votes à partir de l'objet ci-dessus.
1. Calculer le pourcentage de votes pour chaque options.
1. Générer dans la vue une progressbar pour chaque options et leur attribuer le pourcentage calculé précédement.
1. Ajouter également un label affichant la donnée `text` des options.