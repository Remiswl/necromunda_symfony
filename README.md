# NECROMUNDA

## Introduction

Necromunda is a skirmish tabletop war game produced by Games Workshop. This website will help you to create and manage your gangs.

All texts and illustrations are the property of Games Workshop. The use of this website will exclusively be private.


## Technologies

* Front-end: JavaScript ES6, Bootstrap, Twig
* Back-end: PHP7.4.3, SQL
* Framework: Symfony 5


## Production

### To do list

* ~~Home page~~
* Recruit a gang
	* Make sure that each gang name is unique
	* Allow the player to choose an image for his gang (gang's arms, gangers' faces, etc.)
* Manage your gang
	* Make automatic the calculation of the gang stach, the gang rating, the total rating and the total Exp
	* Make possible to add territories
	* Display gangers' equipment, skills and injuries
* Manager gangers
	* Add equîpment, skills and injuries
	* Modify image
	* set default image
	* add a list of images the player can choose
* ~~Houses~~
* ~~Resources~~
* Settings
	* add and modify weapons and their properties
	* add and modify territories and their properties
	* etc.
* Finish create database (see details below)

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
* GangersWeapons (= the table lists the weapons of each ganger)
	* weaponId
	* gangerId
* WeaponsTraits (structure to be confirmed)
	* weaponId
	* which traits?
* Wargears (structure to be confirmed)
	* category (grenades, armour, personal equipment)
	* cost
	* caracteristics?
* GangersWargears
	* wargearId
	* gangerId
* Skills (structure to be confirmed)
	* listOfSkillsId
	* gangerId
* ListOfSkills (structure to be confirmed)
	* caracteristics
* Territories (structure to be confirmed)
	* gangId
* GangStash
	* gangId
