<?php
// / -----------------------------------------------------------------------------------
// / THIS IS THE CONFIGURATION TEMPLATE, & everything below the marker is a real config.php
// / at default values. Not a description of one.
// / The Engine reads it to learn what settings should exist & what they default to.
// / A missing config.php is written FROM it. A repair adds whatever it holds that a live
// / configuration lacks. AN OPERATOR VALUE IS NEVER REPLACED by a default here.
// / Adding a setting to your application means adding it HERE.
// / This note is not copied, because a generated configuration is not a template.
// / -----------------------------------------------------------------------------------

// / Copy from here down.
// / -----------------------------------------------------------------------------------
// / Copyright Information ...
// / ExampleApp, Copyright on 9/8/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License Information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / File Information ...
// / v3.9.3.
// / The configuration for this installation. Every value here is yours to change.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A component may only be loaded by the core.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! ExampleApp-28001, A configuration cannot be loaded directly!');
// / -----------------------------------------------------------------------------------


// / ---General Information---
// /  --Config Version--
// /   The version this configuration was written for.
// /   The application refuses to start against a configuration older than it requires.
$ConfigVersion = 'v3.9.3';

// /  --Application Name--
// /   Appears in log entries & in error messages.
$ApplicationName = 'ExampleApp';

// /  --Verbose--
// /   Whether normal operational activity is logged.
// /   Warnings & errors are always written whatever this says.
$Verbose = TRUE;

// /  --Enable Memory Protection--
// /   Whether purgeSensitiveMemory actually overwrites values.
// /   Turning it off is faster & leaves values in memory after the code that used them has
// /   finished. Leave it on unless you are measuring something.
$EnableMemoryProtection = TRUE;
// / -----------------------------------------------------------------------------------


// / ---Directory Information---
// /  --Installation Location--
// /   Where this installation lives. Everything else is found relative to it.
$InstLoc = __DIR__.DIRECTORY_SEPARATOR.'..';

// /  --Log Directory--
// /   Where logs are written. Kept as an expression so it moves when InstLoc moves.
$LogDir = $InstLoc.DIRECTORY_SEPARATOR.'Logs';
// / -----------------------------------------------------------------------------------
?>
