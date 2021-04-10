# NECROMUNDA

## Introduction

Necromunda is a skirmish tabletop war game produced by Games Workshop. This website will help you to create and manage your gangs.

All texts and illustrations are the property of Games Workshop.


## Technologies

* Front-end: JavaScript ES6, Bootstrap, Twig
* Back-end: PHP7.4.3, SQL
* Framework: Symfony 5


## Production

### To do list

* ~~Home page~~
* Recruit a gang
	* Allow the player to choose an image for his gang (gang's arms, gangers' faces, etc.)
* Manage your gang
	* Make possible to add territories and display them
	* Display gangers' equipment, skills and injuries
* Manager gangers
	* Add equîpment, skills and injuries
	* Modify image
	* set default image
	* add a list of images the player can choose
	* @Route: add a slug with the ganger's name (Grafikart - Découverte de Doctrine 33')
* ~~Houses~~
* ~~Resources~~
* Settings
	* add and modify weapons
* Fixtures
	* Create fixtures (with Faker; Grafikart - Paginer les biens 2'34")
* Finish create database (see details below)
* Allow access to the site to registered users (Grafikart - Le composant Security)

Next steps:
* Start a battle (/battle):
	* add buttons to roll dices to choose the ground, roll dices for attacks, etc.
	* a single page with information about the ground, the gangs, etc.?
	* last page (/result) to upgrade each ganger after the end of the battlefatal
* Objects to roll dices (xD6, xD3, D66 (1st D6 dice as tens, a 2nd D6 dice as units))
* Add automated tests


## Database

* ~~Users~~
* ~~GangType~~
* ~~Gangs~~
* ~GangersTypes~
* ~Gangers (= list of gangers' caracterics depending on the gang)~
* ~MyGangers (= create a new lign for each ganger as soon as a new gang is formed)~
* ~Territories~

* Weapons (= the table lists the weapons' caracteristics)
	* category (basic weapon, close combat weapon, pistol, special weapon, heavy weapon)
	* cost
	* shortRange
	* longRange
	* shortAccuracy
	* longAccuracy
	* strength
	* armourPiercing
	* damage
	* ammo
* Wargears (structure to be confirmed)
	* category (grenades, armour, personal equipment)
	* cost
	* caracteristics?
* Skills (structure to be confirmed)
	* listOfSkillsId
	* gangerId