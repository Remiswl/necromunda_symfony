# NECROMUNDA

## Introduction

Necromunda is a skirmish tabletop war game produced by Games Workshop. This website will help you to create and manage your gangs.

All texts and images are the property of Games Workshop.


## Technologies

* Front-end: JavaScript ES6, Bootstrap 4, Twig
* Back-end: PHP7.4.3, SQL
* Framework: Symfony 5


## Production

### To do list

* Manage your gang
	* Make possible the update of the gang's stash ->pop up "Enter the new gang's credits" (collecting income at the end of a battle)
	* Prevent gangers from having more than 1 heavy weapon (per ganger)
		-> récupérer les armes du ganger
		-> s'il a déjà une arme lourde, alors...

* Controllers: test all routes and add createNotfoundExceptions


### Next steps:

* add equipment to gangers?
* Recruit a gang
	* Allow the player to choose an image for his gang (gang's arms, gangers' faces, etc.)
* Start a battle (/battle):
	* add buttons to roll dices to choose the ground, roll dices for attacks, etc.
	* a single page with information about the ground, the gangs, etc.?
	* last page (/result) to upgrade each ganger after the end of the battlefatal
	* manage the sell of equipment and weapons
* Manage your gang
	* territories: add a button to automatically calculate income
* Manage gangers
	* @Route: add a slug with the ganger's name (Grafikart - Découverte de Doctrine 33')
* Settings
	* weapons -> add images?
* Objects to roll dices (xD6, xD3, D66 (1st D6 dice as tens, a 2nd D6 dice as units))
* experience advance table (cf. p.111)
* advance rolls (new skills/characteristics at the end of a battle (cf. p.112)
* Add automated tests
