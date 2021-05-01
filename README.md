# NECROMUNDA

## Introduction

Necromunda is a skirmish tabletop war game produced by Games Workshop. This website will help you to create and manage your gangs.

All texts and images are the property of Games Workshop.


## Technologies

* Front-end: JavaScript ES6, Bootstrap, Twig
* Back-end: PHP7.4.3, SQL
* Framework: Symfony 5


## Production

### To do list

* Gangers:
	* ~~Create add_weapon_page -> display a list + 'add' button~~
	* ~~Create add_skill_page -> display a list + 'add' button~~
	* ~~Create add_injury_page -> display a list + 'add' button~~
	* ~~Ganger page:~~
		* ~~Create fields to display the ganger's weapons, skills and injuries~~
		* ~~Add buttons to add weapons, skills + injuries~~
		* ~~Add buttons to delete weapons, skills + injuries~~
	* ~~Database:~~
		* ~~Skills: add a ManyToMany relations with gangers~~
		* ~~Weapons: add a ManyToMany relations with gangers~~
		* ~~Injuries: add a ManyToMany relations with gangers~~
	* GangsController:
		* ~~modify method editGangers -> display list of weapons, skills and injuries~~
		* as for the territories, add the following routes:
			* ~~new_ganger_weapon (on the page of all weapons, so that the player can choose one weapon for his ganger)~~
			* ~~new_ganger_skill~~
			* ~~new_ganger_injuries~~
			* ~~insert_new_weapon_in_db~~
			* ~~insert_new_skills_in_db~~
			* ~~insert_new_injuries_in_db~~
		* as for the settings, add the following routes:
			* ~~new_ganger_injury (on ganger's page, to access to the list of all injuries than can be added)~~
			* ~~new_ganger_skill~~
			* ~~new_ganger_weapon~~
			* ~~delete_ganger_injury~~
			* ~~delete_ganger_skill~~
			* ~~delete_ganger_weapon~~
	* ~~Gang page: display ganger's weapons, skills and injuries~~
	* Weapons:
		* reduce gang's stash when choose
	* Skills:
		*
	* Injuries:
		*



* ~~Home page~~
* ~~Recruit a gang~~
* Manage your gang
	* Display gangers' skills and injuries
	* Make possible to have several times the same territory
	* Reduce gang's stash when hire a new ganger + error message if gang's stash < 0
	* Make possible the update of the gang's stash
	* Make possible to delete gang's territories
* Manager gangers
	* Add weapons, skills and injuries
	* Modify image
	* when recruit, add a list of images the player can choose
	* @Route: add a slug with the ganger's name (Grafikart - Découverte de Doctrine 33')
* ~~Houses~~
* ~~Resources~~
* Settings
	* Injuries: make impossible to have a maxD66 < minD66
* Finish create database (see details below)

Next steps:
* add equipment to gangers?
* Recruit a gang
	* Allow the player to choose an image for his gang (gang's arms, gangers' faces, etc.)
* Start a battle (/battle):
	* add buttons to roll dices to choose the ground, roll dices for attacks, etc.
	* a single page with information about the ground, the gangs, etc.?
	* last page (/result) to upgrade each ganger after the end of the battlefatal
	* manage the sell of equipment and weapons
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
* ~~Injuries~~
* ~~Skills~~

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
