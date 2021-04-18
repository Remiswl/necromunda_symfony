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
	* Reduce gang's stash when hire a new ganger
* Manager gangers
	* Add equipment/weapons, skills and injuries
	* Modify image
	* when recruit, add a list of images the player can choose
	* @Route: add a slug with the ganger's name (Grafikart - Découverte de Doctrine 33')
* ~~Houses~~
* ~~Resources~~
* Settings
	* weapons -> add images?
* Finish create database (see details below)

Next steps:
* Start a battle (/battle):
	* add buttons to roll dices to choose the ground, roll dices for attacks, etc.
	* a single page with information about the ground, the gangs, etc.?
	* last page (/result) to upgrade each ganger after the end of the battlefatal
* Objects to roll dices (xD6, xD3, D66 (1st D6 dice as tens, a 2nd D6 dice as units))
* Add automated tests


## Database

* ~~GangType(Houses)~~
* ~~Gangs~~
* ~~GangersTypes~~
* ~~Gangers (= list of gangers' caracterics depending on the gang)~~ -> useful?
* ~~MyGangers~~
* ~~Territories~~
* ~~Serious_injuries_chart~~
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
