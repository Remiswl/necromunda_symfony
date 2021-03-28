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

* ~~Home page (/)~~
* ~~Resources (/resources)~~
* Recruit a gang (/recruitment)
	* 1st page: ask for user name, gang name, gang type,
	* 2nd page: select the gangers, add weapons & equipment; total credits change when select a ganger (start with 1,000 credits)
	-> modify database : Gangs
* Create database (see details below)
* Admin page (/admin):
	* Allow players and gangs removal
	* Manage gangers' statistics
	* Add resources
	* others?
* Manage your gang (/users - /gangs) - allow modify gang data
* Start a battle (/battle):
	* add buttons to roll dices to choose the ground, roll dices for attacks, etc.
	* a single page with information about the ground, the gangs, etc.?
	* last page (/result) to upgrade each ganger after the end of the battlefatal
* Settings (/settings):
	* modifiy gangers' statistics
	* add and modify weapons
	* etc.
* Add automated tests
* Objects to roll dices (xD6, xD3, D66 (1st D6 dice as tens, a 2nd D6 dice as units))


## Database

* ~~Users~~
	* pseudo
	* gangName
	* gangTypeId
* ~~GangType~~
	* name: Cawdor, Delaque, Van Saar, Goliath, Orlock, Escher
* ~~Gangs~~
	* userId
	* gangTypeId
	* credits
	* gangRating
	* reputation
	* wealth
	* alliance
* ~GangersTypes~
	* name (string/not nullable): leader/balaise/ganger/kid
* ~Gangers (= list of gangers' caracterics depending on the gang)~
	* gangerTypeId (integer/not nullable)
 	* houseId (integer/not nullable)
 	* credits (integer/not nullable)
 	* move (integer/not nullable)
 	* weaponSkill (integer/not nullable)
 	* ballisticSkill (integer/not nullable)
 	* strength (integer/not nullable)
 	* toughness (integer/not nullable)
 	* wounds (integer/not nullable)
 	* initiative (integer/not nullable)
 	* attacks (integer/not nullable)
 	* leadership (integer/not nullable)
 	* cool (integer/not nullable)
 	* willpower (integer/not nullable)
 	* intelligence (integer/not nullable)
 	* cost (integer/not nullable)
 	* adv (integer/nullable)
 	* xp (integer/nullable)

* ~MyGangers (= create a new lign for each ganger as soon as a new gang is formed)~
	* name (string/not nullable)
	* typeId (integer/not nullable)
 	* gangId (integer/not nullable)
 	* credits (integer/not nullable)
 	* move (integer/not nullable)
 	* weaponSkill (integer/not nullable)
 	* ballisticSkill (integer/not nullable)
 	* strength (integer/not nullable)
 	* toughness (integer/not nullable)
 	* wounds (integer/not nullable)
 	* initiative (integer/not nullable)
 	* attacks (integer/not nullable)
 	* leadership (integer/not nullable)
 	* cool (integer/not nullable)
 	* willpower (integer/not nullable)
 	* intelligence (integer/not nullable)
 	* cost (integer/not nullable)
 	* adv (integer/nullable)
 	* xp (integer/nullable)

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

Skills (structure to be confirmed)
	* listOfSkillsId
	* gangerId
* ListOfSkills (structure to be confirmed)
	* caracteristics
* Territories (structure to be confirmed)
	* gangId
* GangStash
	* gangId
