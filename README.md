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
* ~~Recruit a gang~~
* Manage your gang
	* Make possible to have several times the same territory
	* Display gangers' equipment, skills and injuries
	* Reduce gang's stash when hire a new ganger
	* Make possible the update of the gang's stash
* Manager gangers
	* Add equipment/weapons, skills and injuries
	* Modify image
	* when recruit, add a list of images the player can choose
	* @Route: add a slug with the ganger's name (Grafikart - Découverte de Doctrine 33')
* ~~Houses~~
* ~~Resources~~
* Settings
	* Injuries: make impossible to have a maxD66 < minD66
* Finish create database (see details below)

Next steps:
* Recruit a gang
	* Allow the player to choose an image for his gang (gang's arms, gangers' faces, etc.)
* Start a battle (/battle):
	* add buttons to roll dices to choose the ground, roll dices for attacks, etc.
	* a single page with information about the ground, the gangs, etc.?
	* last page (/result) to upgrade each ganger after the end of the battlefatal
* Settings
	* weapons -> add images?
* Objects to roll dices (xD6, xD3, D66 (1st D6 dice as tens, a 2nd D6 dice as units))
* Add automated tests


## Database

* ~~GangType(Houses)~~
* ~~Gangs~~
* ~~GangersTypes~~
* ~~Gangers (= list of gangers' caracterics depending on the gang)~~ -> useful?
* ~~MyGangers~~
* ~~Territories~~
* ~~SeriousInjuriesChart~~
* ~~GangersImg~~
* ~~SkillsCategories~~
* ~~WeaponsCategories~~
* ~~User~~

* Skills
	* ~~name~~
	* ~~description~~
	* ~~category~~
	* -> ManyToMany relations with gangers

* Weapons
	* ~~name~~
	* ~~cost~~
	* ~~category~~

	* availability
	* shortRange
	* longRange
	* shortAccuracy
	* longAccuracy
	* strength
	* armourPiercing
	* damage
	* ammo

	* -> ManyToMany relations with gangers
