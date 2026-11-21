<?php
// / -----------------------------------------------------------------------------------
// / This is the Starter's half of the configuration template, & everything below the marker is a
// / real config.php at default values. Not a description of one.
// / It holds the header & the guard a config.php opens with, $ConfigVersion & every setting only
// / the Starter reads. Every setting the kernel or the Engine reads is the Engine's, in its half,
// / Resources/Engine/config-template.php, & config.php is written from both halves.
// / The kernel reads the names in both to know which settings config.php must hold & which become
// / globals, so no list of them is kept anywhere else. See configurationTemplatePaths() in
// / Resources/Kernel/kernel.php.
// / A missing config.php is written from them, with the Engine's settings first in each section the
// / two share. A repair adds whatever either holds that a live configuration lacks.
// / An operator's value is never replaced by a default here.
// / Adding a setting to this application means adding it here & to applicationConfigModel() in
// / app.php, & raising $ConfigVersion below & $RequiredConfigVersion in app.php.
// / Resources/config.php is what --config --repair writes from both halves.
// / Everything below the marker is copied verbatim, including the header & the guard, because a
// / generated configuration needs both. This note is not copied, because a generated
// / configuration is not a template & should not claim to be.
// / -----------------------------------------------------------------------------------

// / Copy from here down.
// / This file is generated from Resources/Contract/config-template.php & Resources/Engine/config-template.php. Edit the values below, never the structure.
// / A repair adds whatever either template holds & keeps every value set here. A structural edit is lost when the file is generated again.
// / -----------------------------------------------------------------------------------
// / Copyright Information ...
// / HRProprietary Engine, Copyright on 11/20/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License Information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / Application Information ...
// / The Starter is the smallest application the HRProprietary Engine runs. It answers the
// / Engine's commands & one of its own, & offers no web interface.
// /
// / File Information ...
// / v4.3.2.
// / This file contains the configuration information for the Starter.
// / Fill out this file completely & accurately before running the application.
// / Serious filesystem damage could occur from incorrect directory settings.
// / Be careful to preserve all syntax & formatting.
// /
// / Hardware Requirements ...
// / This application requires at least a Raspberry Pi Model B+ or greater.
// / This application will run on just about any x86 or x64 computer.
// /
// / Dependency Requirements ...
// / The authoritative list of dependencies is Resources/Engine/depends.php & Resources/Contract/depends.php, the Engine's half & the application's, & nothing else.
// / Run  php app.php -v  to see what this installation has.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------

// / -----------------------------------------------------------------------------------
// / Refuse direct execution. This file is a component & has no standalone context.
// / This halt cannot use quickDie. Reaching this line means app.php was never
// / loaded, so quickDie is not defined & calling it would replace a clear refusal with an
// / undefined function error.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! Starter-2: This file cannot process your request! Please submit your request to app.php instead!'.PHP_EOL);
// / -----------------------------------------------------------------------------------

// / ------------------------------
// /  --Config Version--
// /   The version of the Starter in which this config file last gained or lost a setting.
// /   The core refuses to run against a config file that is missing settings it requires.
// /   Do not change this value by hand. An update & --config --repair keep it current.
$ConfigVersion = 'v4.3.2';
// / ------------------------------

// / ------------------------------
// / ---General Information---
// /
// /  --Greeting--
// /   What  php app.php --app-hello  prints. It is the one setting the Starter keeps of its own.
// /   It is printed as a terminal shows text, so a control character in it is shown as a question mark.
// /   Default is 'Hello from the Starter.'
$Greeting = 'Hello from the Starter.';
// / ------------------------------
