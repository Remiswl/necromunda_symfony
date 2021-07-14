# NECROMUNDA

## Introduction

Necromunda is a skirmish tabletop war game produced by Games Workshop. This website will help you to create and manage your gangs.

All texts and images are the property of Games Workshop.

http://necromunda.remischwall.fr/

## Technologies

* Front-end: JavaScript ES6, Bootstrap 4, Twig
* Back-end: PHP7.4.3, SQL
* Framework: Symfony 5.2


## Production

### Work in progress
* Start a battle (/battle):
	* ~~a first page to choose the gangs that will fight (/battle1)~~
	* a second page with information about the gangers (/battle2)
	* a third page at the end of the fight (/result) -> roll dices to :
		* upgrade gangers ?
		* ?
	* ~~create buttons to roll dices to choose the ground, roll dices for attacks, etc.~~

* cannot edit gang's stash
* Install EasyAdmin

### TODO list
* My gang -> add a button to generate Territories' revenus
* Manage gangers
	* @Route: add a slug with the ganger's name (Grafikart - Découverte de Doctrine 33')
	* Manage Experience Advances (p.111)
	* ManageAdvance rolls (p.112)
	* when change profile picture, redirect to ganger's page

### Next steps:

* Add Roles
* Add equipment to gangers?
* Recruit a gang
	* Allow the player to choose an image for his gang (gang's arms, gangers' faces, etc.)
* Start a battle (/battle):
	* manage the sell of equipment and weapons
* Objects to roll dices (xD6, xD3, D66 (1st D6 dice as tens, a 2nd D6 dice as units)) for Serious Injuries, etc.
* Add automated tests