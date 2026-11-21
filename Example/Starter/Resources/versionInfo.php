<?php
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
// / This file contains the current Starter version for update verification purposes.
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

// / -----------------------------------------------------------------------------------
// / The version of this Starter installation. app.php defines the same version & the kernel refuses an installation where the two differ.
$Version = 'v4.3.2';
$Version = ltrim($Version, 'vV');
// / -----------------------------------------------------------------------------------
