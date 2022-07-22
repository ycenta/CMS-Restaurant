CMS Ecommerce

<h2>Design Pattern</h2>
<h3>Observer</h3>
Ajout des methodes subscribe & notify pour les modérateurs avec les commentaires signalés<br>
<pre>Controller: comment
Action: reportComment:208</pre>
<code>Commit : 0ce1f98b84bc76022095156f3a7ca9df083e3fa9</code>


<h3>QueryBuilder</h3>
Ajout du querybuilder dans la classe Core/Sql <br>
<pre>Fichier: Core/QueryBuilder.class.php
Utilisation: Core/Sql.class.php
  Methodes: 
  -> findByCustom():115
  -> getAll():134
  -> getAllWhere():163
  -> getAllLimit():213</pre>


<h3>Singleton</h3>
Ajout de logs pour les entités User, Checkout et Category, Page et Product <br>
<pre>Fichier: Model/Log.class.php
Utilisations: 
-> Core/ConcreteStrategyCheckout.class.php:11
-> Core/ConcreteStrategyNew.class.php:11
-> Core/ConcreteStrategyUser.class.php:11</pre>
<code>Commit : 7b48d55e1eedcd7822c34a79862e711a9980628f</code>

<h3>Strategy</h3>
Ajout d'une Strategy pour pouvoir adapter et modifier plus facilement le contenu des logs présents et surtout futurs.<br>
Elle permet de définir proprement comment gérer par exemple les logs pour les utilisateurs, sans passer par un gros bloc conditionnel (qui aurait pu être "si 'user' alors écrire comme ceci sinon si 'checkout' alors écrire comme cela..."). Ici, c'est une classe qui implémente la strategy globale qui s'occupe du cas du fichier de log "user", une autre classe qui implémente la même strategy pour les logs de "checkouts" et ainsi à chaque fois.<br>
<pre>Fichier: 
-> Core/Strategy.class.php
-> Core/Context.class.php
-> Core/ConcreteStrategyCheckout.class.php
-> Core/ConcreteStrategyNew.class.php
-> Core/ConcreteStrategyUser.class.php
Utilisations:
-> Controller/CategoryController.php:34-35
-> Controller/CheckoutController.php:49-50
-> Controller/PageController.php:60-61
-> Controller/ProductController.php:34-35
-> Controller/UserController.php:54-55, 101-102
-> Core/Mailsender.class.php:74-75</pre>
<code>Commit : e4dc52fdc7c73d5c5665b86a0ad6c4fdf7ca1d5c</code>
