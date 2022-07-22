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
-> Controller/CategoryController.php:28, 34
-> Controller/CheckoutController.php:22, 49
-> Controller/PageController.php:42, 60
-> Controller/ProductController.php:19, 35
-> Controller/UserController.php:24, 53, 76, 97
-> Core/Mailsender.class.php:48, 74</pre>
<code>Commit : 7b48d55e1eedcd7822c34a79862e711a9980628f</code>
