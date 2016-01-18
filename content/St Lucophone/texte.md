##### Le "St Lucophone" à été réalisé à ma sortie de StLuc. Initialement, c'est un instrument de musique qui utilise une tablette graph graphqiue pour moduler une onde (voir skecth Processing). Ensuite, j'ai décidé d'y ajouter des ventilateurs de manière à optimiser le contrôle du pendule.

* [Version initiale](#version%200.0.1)
* [Version actuelle en preparation](#version%200.1.1)
* [Code source](#StLucophone0_2_0)
* [Presentation de la version actuelle](#Accrochage-1)
* [Presentation de la version actuelle](#Accrochage-2)
* [Presentation de la version actuelle](#Accrochage-3)


## Version 1
Une simple tablette graphique WACOM reliée sans fil à un ordinateur sur lequel tourne un sketch processing. Le sketch utilise les valeurs mouseX et mouseY pour moduler une onde sonore. L'instrument se tient par une poignée en haut et se joue en effectuant des mouvement qui vont faire bouger le stylet pendu.

## Version 2
Dans la seconde version, les mouvements du stylet sont modifiés par trois ventilateurs d'ordinateur. Ces ventilateurs disposent d'un petit circuit imprimé avec un MOFSET qui permet de controler leur vitesse. Les ventilateurs sont alimentés en 12V par une alimentation de PC, chacun des trois ventilateurs sont reliés à des potentiomètres qui controlent leur vitesse.

### Améliorations
* Ajouter un quatrième ventilateur
* Comment presenter ce travail ?
    * Performance live ?
    * Sequence transmise aux ventilos par un micro controleur ?
* Support plus pratique à transporter, pliable ?