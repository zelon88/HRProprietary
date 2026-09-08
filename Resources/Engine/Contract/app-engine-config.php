<?php
// / -----------------------------------------------------------------------------------
// / Copyright Information ...
// / HRProprietary Engine, Copyright on 9/8/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License Information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / File Information ...
// / v3.9.3.
// / YOUR APPLICATION'S ENGINE SETTINGS. Loaded after engineConfig.php, & anything set here
// / wins.
// /
// / This is the arrangement Apache & php use. The Engine ships a configuration that works,
// / & you drop this beside it to change what you need.
// /
// / engineConfig.php belongs to the Engine & is replaced wholesale when you take a newer
// / one. This file is yours & survives that. Upgrading is a directory copy.
// /
// / SET ONLY WHAT DIFFERS. A setting repeated here at the value the Engine already uses
// / will silently stop tracking that default when it changes for a good reason.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A component may only be loaded by an application.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! Engine-35000, An engine configuration cannot be loaded directly!');
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / What your application is called.
// / The name appears in log entries & error numbers. The slug is used wherever a name has
// / to survive a filesystem or a socket path, so keep it lower case & free of spaces.
$EngineApplicationName = 'ExampleApp';
$EngineApplicationSlug = 'exampleapp';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / THE PROVIDERS. Each names a function YOUR application defines. The Engine calls what it
// / is given & knows nothing else about it.
// / This is the whole of how the Engine learns about an application. Six names.
// /
// / Every one is optional. An Engine given none of them runs & does less, which is the
// / intended floor rather than a failure. Add them as you need them.
// / See Documentation/ABOUT_ENGINE_CONTRACT.txt for what each one owes the Engine.

// /   Reports on the parts of the environment that belong to your application.
// /   The Engine checks the sandbox itself & asks you about everything else.
$EngineEnvironmentProvider = 'applicationEnvironmentFindings';

// /   Asks a human a question & returns their answer.
// /   AN EMPTY ANSWER IS A REFUSAL. A web request has no operator, so it refuses rather
// /   than blocking for one that will never arrive.
$EngineOperatorPrompt = 'askOperator';

// /   Reports whether your data is exposed by a web server. Leave empty if you have none.
$EngineDataPolicyProvider = '';

// /   Returns your configuration model. What a config file cannot say about itself, which
// /   is types, dependencies between settings & which sections a tool may write.
$EngineConfigModelProvider = 'applicationConfigModel';

// /   Repairs whatever your application manages. Called by --fix-permissions & by the
// /   Environment Manager. Leave empty until you have something worth repairing.
$EngineRepairProvider = '';

// /   A real config.php at default values. What your configuration looks like.
$EngineConfigTemplate = 'Engine/Contract/config-template.php';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / Anything else your application needs to differ from an Engine default goes below.
// / -----------------------------------------------------------------------------------
?>
