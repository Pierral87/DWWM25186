/*
Modéliser la BDD d’une boutique en ligne.
-----------------------------------------
  - vente de produit
  - gestion des commandes
  - gestion des paiements
  - gestion des livraisons
  - gestion des avis clients.

Tables minimales à prévoir
--------------------------
  - customer (client)
  - address (adresse)
  - product (produit)
  - category (catégorie)
  - brand (marque)
  - order (commande)
  - order_item (ligne de commande)
  - payment (paiement)
  - shipment (livraison/expédition)
  - review (avis)
  - coupon (code promo)

Relations attendues
-------------------
1) One-to-many / Many-to-one
  - customer (1)  -> (N) order
  - order (1)     -> (N) order_item
  - product (1)   -> (N) order_item
  - brand (1)     -> (N) product
  - category (1)  -> (N) product (une seule catégorie par produit)
  - customer (1)  -> (N) address
  - order (1)     -> (0..1) shipment
  - customer (1)  -> (N) review
  - product (1)   -> (N) review

2) Many-to-many
---------------
  - order (N) <-> (N) coupon via order_coupon
    - une commande peut avoir 0..N coupons
    - un coupon peut être utilisé sur N commandes

3) One-to-one
----------------------------
  - order (1)     -> (1) payment


Conseils :
----------
  - Un order_item contient au minimum : quantity, unit_price_at_purchase (prix figé au moment de l’achat), product_id, order_id.
  - Un coupon peut avoir :
    - type (percentage / fixed)
    - value
    - start_at, end_at
    - min_order_total
  - Une adresse peut avoir un champ type (billing / shipping).
  - Les prix doivent être en entier 
    - par exemple price_cents : un produit ayant un prix de 11.20 sera enregistré en 1120 (facilite les calculs)


*/