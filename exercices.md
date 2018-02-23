## Création de la base de données:
1. créer la table Polls
1. créer la table Options
1. créer la contrainte de clé étrangère entre Polls et Options

## Contenu des requètes:
1. `POST /polls/`
```json
{
  "title": "Titre du sondage",
  "options": [
    {"text": "Première option"},
    {"text": "Seconde option"}
  ]
}
```
2. `GET /polls/1?_embed=options`
```json
{
  "id": 1,
  "title": "Titre du sondage",
  "options": [
    {"id": 1, "text": "Première option", "count": 0},
    {"id": 2, "text": "Seconde option", "count": 0}
  ]
}
```
3. `PATCH /options/1/vote`
```json
{"id": 1, "text": "Première option", "count": 1}
```

## Créer le modèle:
1. écrire l'entité Option:
    1. écrire le constructeur
    1. écrire la méthode `get()` qui retourne un tableau contenant toutes les propriétés

1. écrire l'entité Poll:
    1. écrire le constructeur (l'objet doit être construit avec ses options)
    1. écrire la méthode `get()` qui retourne un tableau contenant toutes les propriétés

1. écrire le DAO Option:
    1. écrire la méthode `vote()`

1. écrire le DAO Poll:
    1. écrire la méthode `getByIdWithOptions()`
    1. écrire la méthode `addWithOptions()`

![Model](https://yuml.me/b5b64d6e.png)
[edit](http://yuml.me/edit/b5b64d6e)