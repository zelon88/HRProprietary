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
// / This file is a PLACEHOLDER APPLICATION. It is the smallest thing that satisfies the
// / Engine contract & starts. Replace it with your application.
// /
// / It sits where the application goes. HRConvert2 puts convertCore.php here.
// / Everything below is either something the Engine requires, or a comment explaining what
// / you have to decide before you delete it.
// /
// / Run it to check an installation:
// /   php app.php
// / It loads the Engine, reports what it found & exits. It converts nothing, because there
// / is nothing here to convert.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / The Engine refuses to load unless an application says it is loading it.
// / Every component checks this. It is what stops a file being requested directly over
// / HTTP & executing on its own.
$CoreLoaded = TRUE;
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / Where this installation lives. Everything else is found relative to it.
$InstLoc = __DIR__;
$DirSep = DIRECTORY_SEPARATOR;
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / WHAT THE ENGINE ASKS OF AN APPLICATION.
// / The Engine now DEFINES sanitize, locateDependency, getExtension & describeEnvironment
// / itself, in Cores/environmentCore.php, guarded so an application keeping its own is
// / unharmed. Delete them here & you get the Engine's.
// / What is left below is what the Engine cannot supply, because it depends on what your
// / application considers a file, a log or a repair.
// / The counts are how often the Engine calls each one, which is a fair guide to how much
// / care each deserves.
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to record normal operational activity. 52 calls.
// / Accepts the message. Returns whether it was written.
// / Suppressed when the application is not verbose. See Documentation/ABOUT_LOGGING.txt.
function logEntry($logMessage) {
  global $Verbose;
  $EntryWasWritten = FALSE;
  if ($Verbose) {
    print('Op-Act: '.$logMessage.PHP_EOL);
    $EntryWasWritten = TRUE; }
  return $EntryWasWritten; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to record something an administrator should know. 65 calls.
// / Accepts the message. Returns whether it was written.
// / A warning is ALWAYS written & carries no number. Anything an attacker caused that the
// / application handled correctly is a warning rather than an error.
function warningEntry($warningMessage) {
  print('WARNING!!! '.$warningMessage.PHP_EOL);
  return TRUE; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to record a failure that changes behaviour. 14 calls.
// / Accepts the message, a documented number & whether it is fatal. Returns nothing useful
// / when it is fatal, because it does not come back.
// / Every number must be documented. HRConvert2 keeps ERROR_DESCRIPTIONS.txt for this.
function errorEntry($errorMessage, $errorNumber, $errorIsFatal) {
  print('ERROR!!! '.$errorNumber.', '.$errorMessage.PHP_EOL);
  if ($errorIsFatal) exit(1);
  return TRUE; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to destroy a value once the code that needed it has finished. 81 calls.
// / Accepts a fatality flag & any number of variables BY REFERENCE. Returns whether every
// / one was destroyed.
// / This is the most called function in the contract & the one worth writing properly.
// / The placeholder nulls each target, which is the minimum. A real implementation
// / overwrites the bytes of a string before releasing it, so a value is gone rather than
// / merely unreachable.
// / DO NOT PASS A VALUE THE FUNCTION IS ABOUT TO RETURN. It takes by reference, so purging
// / a return value returns NULL, & that failure is silent.
function purgeSensitiveMemory($failureIsFatal, &...$variables) {
  $EverythingWasDestroyed = TRUE;
  foreach ($variables as $index => $variable) {
    if (is_string($variables[$index])) {
      $length = strlen($variables[$index]);
      for ($position = 0; $position < $length; $position++) $variables[$index][$position] = "\0"; }
    $variables[$index] = NULL; }
  return $EverythingWasDestroyed; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to remove everything a value must never contain. 14 calls.
// / THE ENGINE HAS ONE. Delete this & Cores/environmentCore.php supplies it.
// / Accepts any value & whether to be strict. Returns the cleaned value & whether it was
// / already clean, in that order.
// / THE PLACEHOLDER IS NOT A SANITIZER. It proves the shape of the return & nothing else.
// / HRConvert2 removes every character a filename has no business holding, which happens to
// / include everything that makes a shell injection interesting. That approach assumes a
// / dependency will one day be compromised & starves it rather than trusting it.
// / Whatever you write, remember it cannot be used on a URL. The characters it must remove
// / from a filename are the characters a URL is built from.
function sanitize($suppliedValue, $strictMode) {
  $CleanValue = is_string($suppliedValue) ? preg_replace('/[^A-Za-z0-9._-]/', '', $suppliedValue) : $suppliedValue;
  $ValueWasClean = ($CleanValue === $suppliedValue);
  return array($CleanValue, $ValueWasClean); }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to find an executable on this host. 12 calls.
// / THE ENGINE HAS ONE. Delete this & Cores/environmentCore.php supplies it, unless your
// / boot sequence needs it before the Engine loads, which is why HRConvert2 keeps its own.
// / Accepts the name. Returns the full path, or an empty string.
// / This is KERNEL rather than Engine. Boot code reaches it before the Engine has loaded,
// / so it cannot live in the Engine & has to be here.
function locateDependency($dependencyName) {
  $DependencyPath = '';
  $commandOutput = array();
  $commandExitCode = 1;
  exec('command -v '.escapeshellarg($dependencyName).' 2>/dev/null', $commandOutput, $commandExitCode);
  if ($commandExitCode === 0 && isset($commandOutput[0])) $DependencyPath = trim($commandOutput[0]);
  return $DependencyPath; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to read a component's version WITHOUT executing it. 1 call.
// / Accepts a path relative to Resources & the variable name. Returns the version.
// / Reading rather than running matters. A component that is broken enough to need its
// / version checked is a component you do not want to execute to find out.
function readComponentVersion($componentRelativePath, $versionVariableName) {
  global $InstLoc, $DirSep;
  $ComponentVersion = '';
  $componentPath = $InstLoc.$DirSep.'Resources'.$DirSep.$componentRelativePath;
  $componentContents = @file_get_contents($componentPath);
  if (is_string($componentContents) && preg_match('/\$'.$versionVariableName.'\s*=\s*\'([^\']+)\'/', $componentContents, $versionMatches)) $ComponentVersion = $versionMatches[1];
  return $ComponentVersion; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / Four smaller helpers the Engine reaches for once each.
// / getRealPath resolves a path & is where an application decides what .. means.
// / isDir answers whether a path is a directory this application accepts.
// / verifyFile answers whether a file is one this application will touch.
// / virusScan is called before a fetched file is trusted. Returning TRUE here means every
// / file passes, which is a decision rather than an omission. Wire in a scanner or say
// / plainly in your documentation that you did not.
function getRealPath($suppliedPath) { return (string)@realpath($suppliedPath); }
function isDir($suppliedPath) { return is_dir($suppliedPath); }
function verifyFile($suppliedPath) { return is_file($suppliedPath) && is_readable($suppliedPath); }
function virusScan($suppliedPath) { return array(TRUE, 'No scanner is wired into this application.'); }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to repair this host. Called ONLY by the Environment Manager, & only when an
// / administrator has turned repair on.
// / Accepts nothing. Returns whether it succeeded & how many things it corrected.
// / Leave it doing nothing until you have something worth repairing. A root process that
// / repairs on a timer is a liability if it is wrong.
function fixManagedPermissions() {
  warningEntry('This application has no repair of its own. Nothing was changed.');
  return array(TRUE, 0); }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to report on the parts of the environment that belong to THIS application.
// / Accepts nothing. Returns readiness & a list of findings, in that order.
// / The Engine calls this because engineConfig.php names it in $EngineEnvironmentProvider,
// / & not because the Engine knows anything about it.
// / The Engine checks what the Engine provides, which is Bubblewrap. Everything else an
// / installation wants checked belongs to whoever wants it. An application with no AppArmor
// / policy should not be asked about one.
function applicationEnvironmentFindings() {
  $ApplicationIsReady = TRUE;
  $ApplicationFindings = array();
  $ApplicationFindings[] = array('Check' => 'Application', 'Status' => 'ok', 'Detail' => 'This placeholder has nothing of its own to check.');
  return array($ApplicationIsReady, $ApplicationFindings); }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A function to report the sandbox profiles this application uses.
// / Accepts nothing. Returns the profiles as data.
// / PROFILES ARE DATA & THE ENGINE HOLDS NO KNOWLEDGE OF ANY OF THEM. It reads
// / $EngineSandboxProfiles & builds whatever it is given.
// / Do not guess at a profile. Documentation/ABOUT_NETWORK_ISOLATION.txt describes how
// / HRConvert2 arrives at one, which is by removing permissions until the tool stops
// / working & keeping what is left.
// / Every entry needs a Reason. A permission nobody can justify is a permission nobody will
// / dare remove later.
function getSandboxProfiles() {
  $SandboxProfiles = array(
    'generic' => array(
      'Reason' => 'The base profile. No network, no devices beyond the minimum, a tmpfs for anything writable.',
      'MapToRoot' => FALSE,
      'ShareNetwork' => FALSE));
  return $SandboxProfiles; }
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / Logic goes after functions. Convention seven.
// / -----------------------------------------------------------------------------------

// / The configuration. Every setting the Engine reads comes from here.
$configPath = $InstLoc.$DirSep.'Resources'.$DirSep.'config.php';
if (!file_exists($configPath)) { print('No configuration at '.$configPath.PHP_EOL); exit(1); }
require_once($configPath);

// / The Engine configuration, read BEFORE the Engine, so its settings exist when it starts.
// / engineConfig.php loads Contract/app-engine-config.php last, so your settings win.
$engineConfigPath = $InstLoc.$DirSep.'Resources'.$DirSep.'Engine'.$DirSep.'engineConfig.php';
if (file_exists($engineConfigPath)) require_once($engineConfigPath);

// / The profiles are handed over as data before anything can want one.
$EngineSandboxProfiles = getSandboxProfiles();

// / The Engine itself.
$enginePath = $InstLoc.$DirSep.'Resources'.$DirSep.'Engine'.$DirSep.'engine.php';
if (!file_exists($enginePath)) { print('No Engine at '.$enginePath.PHP_EOL); exit(1); }
require_once($enginePath);

print(PHP_EOL.'Engine '.(isset($EngineVersion) ? $EngineVersion : 'unknown').' loaded.'.PHP_EOL);
print('Application '.$ApplicationName.'.'.PHP_EOL.PHP_EOL);

// / What the Engine can tell you about this host.
if (function_exists('validateOperatingEnvironment')) {
  list ($environmentIsReady, $environmentFindings) = validateOperatingEnvironment();
  print('Operating environment.'.PHP_EOL);
  foreach ($environmentFindings as $environmentFinding) printf('  %-22s %-14s %s'.PHP_EOL, $environmentFinding['Check'], $environmentFinding['Status'], $environmentFinding['Detail']);
  print(PHP_EOL.($environmentIsReady ? 'Ready.' : 'NOT ready. Read the findings above.').PHP_EOL.PHP_EOL); }

// / Manually clean up sensitive memory. Helps to keep track of variable assignments.
purgeSensitiveMemory($EnableMemoryProtection, $configPath, $engineConfigPath, $enginePath);
?>
