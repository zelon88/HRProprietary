----------------------------------------------------------------------------------------------------------------------------------------------------------------
COPYRIGHT INFORMATION ...
HRProprietary Engine, Copyright on 9/4/2026 by Justin Grimes, www.github.com/zelon88

LICENSE INFORMATION ...
This project is protected by the GNU GPLv3 Open-Source license.
https://www.gnu.org/licenses/gpl-3.0.html

APPLICATION INFORMATION ...
The HRProprietary Engine provides a coherent application environment. It is bundled with an application rather than installed beside one.

FILE INFORMATION ...
v4.2.4.
This plain text file says what the Engine starter kit holds & what a new application supplies to run on it.

HARDWARE REQUIREMENTS ...
This application requires at least a Raspberry Pi Model B+ or greater.
This application will run on just about any x86 or x64 computer.

DEPENDENCY REQUIREMENTS ...
What the Engine itself needs is Resources/Engine/depends.php, & --setup installs it with the application's own half. Run  php <entry point> -v  to see what an installation has.

<3 Open-Source
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What This Kit Holds--

Every file here but this one is from an HRConvert2 release tree, unchanged. Pipelines/, ScanCore/
& hrconvert2-release-fetch.sh are v4.2.6's, & everything else is v4.2.4's.

  Resources/Kernel/              The kernel, v4.2.4. Copied into every application unchanged.
  Resources/Engine/              The Engine, v4.2.4. engine.php, engineConfig.php, the Engine's half
                                 of config.php in config-template.php, the Engine's half of the
                                 dependency manifest in depends.php, every Core & every Manager.
                                 Copied into every application unchanged.
  Pipelines/                     Every pipeline HRConvert2 v4.2.6 ships & the shared modules they
                                 load, each folder as HRConvert2 holds it in Resources/Pipelines.
                                 Copied into Resources/Pipelines a folder at a time. See
                                 --The Pipeline Library--.
  ScanCore/                      The ScanCore program the ScanCore pipeline runs. Copied into
                                 Resources/ScanCore with that pipeline.
  Example/HRConvert2/            HRConvert2's entry point, version file, contract & bootstrap script.
                                 The worked example. Read it, & copy none of it whole.
  Documentation/                 The Engine's documents & the conventions the code is written to.
  Documentation/Build/           The two code checkers, the documentation checker &
                                 hrconvert2-release-fetch.sh, which fetches & checks the release
                                 binary a manifest entry names, as four pipeline tools' entries do.
  LICENSE                        The GNU GPLv3.

Documentation/ABOUT_ENGINE_CONTRACT.txt is the authority on everything below. This file is the
order to do it in.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--The Three Tiers--

  The kernel        Loaded first, by the entry point, & pinned exactly. It logs, halts, shreds memory,
                    sanitizes input, keeps the install secret & a visitor's session, & boots the
                    installation. verifyInstallationState() finds who runs the process, reads
                    versionInfo.php & config.php, derives the data locations & every account's home, &
                    reads the install secret. loadEngine() loads the Engine & has it start,
                    runCommandLine() reads the command line & admitWebRequest() admits a web request.
                    It names no application.
  The Engine        Loaded once the installation is verified, & pinned exactly. The environment every
                    application needs. Its start, a session's folders, its settings, its command line,
                    its repair (-fp & --setup), its report (-v) & its help (-h), the sandbox, the
                    listener & its managers, its own dependencies & the application's, pipelines,
                    workflows, accounts, the configuration utility & updates.
  The application   Its version pins, its own settings & its logic. What the Engine calls in it is named
                    in its contract, Resources/Contract/app-engine-config.php, & nowhere else.

The Engine never calls application code except through a name the contract gives it, & the kernel
never calls the Engine without asking whether it is loaded. Checks eight & nineteen of the Python
checker hold both.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What A New Application Supplies--

1. AN ENTRY POINT at the application root. Its boot is calls, in this order, as convertCore.php's main logic is.
  a. $DefaultApplicationName names the application until config.php does, & $RequiredKernelVersion pins
     the kernel. The kernel's version is read from the file without running it, a missing or mismatched
     kernel is refused with a plain print & exit(1), & the kernel is required.
  b. verifyCodeIsTrustedByRoot(dirname(__FILE__), basename(__FILE__)).
  c. setTimeLimit() & verifyTime().
  d. Its own verifyInstallation(). It sets $CoreLoaded TRUE, declares every pin below & calls
     verifyInstallationState(__FILE__, its version, the oldest config.php it accepts).
  e. Its own input handling, with sanitize() on every input, then verifySession(), verifyTokens() &
     verifySesHash().
  f. Resources/Engine/engineConfig.php, required at global scope. It loads the contract last.
  g. verifyLogs().
  h. loadEngine(). The Engine starts itself & establishes the request's session, its folders & its address.
  i. Its own globals, which are its own & nothing the Engine reads.
  j. runCommandLine(basename(__FILE__)). Where that is not a command line, admitWebRequest(basename(__FILE__)),
     then its own logic, & finishWebRequest() once everything it serves has been printed.

2. RESOURCES/VERSIONINFO.PHP holding $Version, the application's version. The kernel refuses an entry
   point whose version differs, error 28001.

3. RESOURCES/CONTRACT, which the kernel finds through contractPath().
  config-template.php     The application's half of config.php. The header & the guard a config.php
                          opens with, $ConfigVersion & every setting only the application reads, each
                          documented above its line. Copy HRConvert2's opening & replace its settings.
  app-engine-config.php   Its identity, $EngineApplicationName, $EngineEntryPoint & $EngineApplicationSlug.
                          The providers the Engine calls, the pipelines & shared modules it accepts at
                          which versions, its managed locations, its layout, the folders every session
                          holds, the map from the Engine's names for settings to its own in
                          $EngineSettingNames, & in $EngineSettingDefaults the defaults it gives the
                          Engine's settings, its name, its title, its folders & where its updates come from.
  depends.php             The application's half of the dependency manifest, what its own pipelines run.
                          The Engine's half ships with the Engine, & an entry here may name one of its
                          entries in Requires, as HRConvert2's PHP Zip names PHP.

4. A CONFIGURATION MODEL, a function named in $EngineConfigModelProvider that models each setting of the
   application's half, as applicationConfigModel() does. The kernel reads the names in both halves of
   the template, makes each a global & refuses a config.php without one, so nothing else lists them.
   php <entry point> --config --repair writes config.php from both halves the first time.

5. THE PINS, declared in verifyInstallation(), except the kernel's, which is declared before the kernel loads.
  $RequiredKernelVersion & $RequiredEngineVersion       Exact. Moved by hand, because the build runs inside both.
  $RequiredSetupCoreVersion, $RequiredDependencyCoreVersion, $RequiredPipelineCoreVersion,
  $RequiredWorkflowCoreVersion, $RequiredAuthenticationCoreVersion & $RequiredEmailCoreVersion
                                                        Exact. Every Core ships with the Engine & -v reports each,
                                                        so each is pinned whether or not the application uses it.
  $RequiredDependsVersion                               Exact, its own half of the manifest's. The Engine pins
                                                        its half itself.
  $RequiredConfigVersion                                The oldest config.php accepted. Raised when either half
                                                        of the template gains or loses a setting.
  $RequiredSecretVersion                                The install secret file it writes & accepts. Exact.
                                                        HRConvert2's is v3.7.7.
  $RequiredConfigScript                                 The bootstrap script, Documentation/Build/<slug>-setup.sh,
                                                        if it ships one. One that is absent is not a fault.
  $EngineApplicationVersion                             Its own version, handed to the Engine where it is defined.

6. WHAT IT ADDS TO THE ENGINE, each optional & each named in its contract.
  $EngineHelpProvider               What -h prints of its own, as applicationHelpInfo() returns it.
  $EngineReportProvider             Rows & sections -v prints in the places it leaves, as applicationVersionReport().
  $EngineSandboxProvider            The sandbox profile of each tool it runs, as getSandboxProfiles().
  $EngineSessionFolders             The folders every session holds beyond StreamTemp. Each is a global of its
                                    own name holding its path. HRConvert2 names ScadTemp.
  $EngineApplicationArgumentHandler Every command beginning --app. HRConvert2 names none.
  $EnginePolicyChecks               The policies it keeps on the host, each checked & repaired with the Engine's.
  $EngineRepairProvider             A repair of anything else it keeps.
  $EngineOperatorPrompt             How it asks its operator, where the terminal will not do.
  $EngineLogProvider                How a long running manager moves on to the logfile it should be writing.
  $EngineOperationProvider          The operations a workflow may run, if it offers workflows.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What Is No Longer Copied--

The Engine pass left four things in HRConvert2's convertCore.php that a new application would have
copied. v4.2.4 moved each, so none is copied & ENGINE_MIGRATION_STATUS.txt, step eighteen, says how.

  The Engine's load & what follows it      The kernel's loadEngine() & the Engine's startEngine().
  The globals verifyGlobals() set for it   The Engine's establishEngineSession(), & the kernel's
                                           $DirSep, $Lol, $Lolol, $Append & $ManagerSocketDir.
  The command line                         The kernel's runCommandLine() & the Engine's
                                           runEngineCommandLine(), -u & -h included.
  The Engine's own dependencies            Resources/Engine/depends.php.

The Engine reads no global the application alone sets but its pins. The allowed formats are read
through $EngineSettingNames as AllowedExtensions, & --File Operation Retry Count-- is the Engine's.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--The Pipeline Library--

Pipelines/ holds every pipeline HRConvert2 v4.2.6 ships, & Shared/, the modules several of them load.
A pipeline is adopted whole. Its folder carries its code, its declarations in pipelineConfig.php, a
README.md written from them & its approval record, DEPENDENCY_APPROVALS.txt. pipelineConfig.php
declares its version, its kind, its entry point, its subsystem, its shared modules, its tools & the
block of error numbers that belongs to it. Documentation/ABOUT_PIPELINE_COMPONENTS.txt says what each
declaration means.

Every Engine function a pipeline calls is in this kit's Engine. Every folder but the seven v4.2.5 &
v4.2.6 added or changed is byte for byte the one HRConvert2 v4.2.4 shipped on this Engine. Those seven,
Data, Email, LaTeX, Markup, Trace, SVG & Graph, & Shared/workFolder.php were run on this kit's kernel &
Engine, in HRConvert2 v4.2.6's tree in place of its own, & converted as they do on v4.2.6, but where
what Engine v4.2.4 lacks, below, stopped them.

An application adopts a pipeline in seven steps.

  1. Copy its folder into Resources/Pipelines, with Pipelines/index.html, every module its
     $PipelineSharedModules names from Pipelines/Shared, & Shared/index.html. Scan runs the scanner
     pipelines, so it is adopted with ClamAV, ScanCore or both. ScanCore is adopted with ScanCore/,
     copied into Resources/ScanCore.
  2. Pin it. The folder's name & its $PipelineVersion go in $EngineAcceptedPipelines, & each shared
     module & its $SharedModuleVersion in $EngineAcceptedSharedModules. A folder the contract does not
     name is never loaded.
  3. Declare its tools. Each name in $PipelineDependencies is an entry in Resources/Contract/depends.php,
     under the subsystem $PipelineSubsystem names. Example/HRConvert2's depends.php holds every entry
     but the eight v4.2.5 & v4.2.6 added, Dasel, yq, XeLaTeX, Potrace, msgconvert, Pandoc, Resvg &
     Graphviz, which HRConvert2 v4.2.6's holds.
  4. Give it its sandbox profiles, below, in the function $EngineSandboxProvider names.
     Example/HRConvert2's getSandboxProfiles() holds every one but the eight v4.2.5 & v4.2.6 added.
     xelatex & pandoc read /etc/texmf, /var/lib/texmf & /var/cache/fontconfig, graphviz reads
     /var/cache/fontconfig, & resvg, potrace, dasel, yq & msgconvert need only their operation types,
     SVG, Trace, Data, Data & Email. graphviz's operation type is Graph.
  5. Supply the application's functions it calls, below. Each is in Example/HRConvert2's convertCore.php.
  6. Declare the application's settings it reads, below, in config-template.php & the configuration
     model, & set the globals it reads, below, as convertCore.php sets them.
  7. Add its errors to ERROR_DESCRIPTIONS.txt, as the Engine's catalogue is extended. HRConvert2 v4.2.6's
     documents every block.

How an application offers a pipeline to its users is its own logic. HRConvert2 routes its conversion
families in applicationConversionFamilies() & its operations in applicationOperations(), which its
contract names in $EngineOperationProvider.

What each pipeline needs of the application, with its shared modules' needs counted as its own. A setting
is named as config.php names it, a global the application sets carries its $, & a blank needs nothing.

  Pipeline   Profiles                   Functions                         Settings & globals
  Archive    archive                    findFreeOutputName                AllowBootableIsoImage, MaxExtractedSize,
                                                                          MaxExtractedFiles, $BootableIsoArray &
                                                                          $BootloadersDir
  Archiver   archive                    verifyFile                        VirusScan
  Audio      ffmpeg
  ClamAV     clamav
  Data       dasel yq
  Document   poppler libreoffice
  Drawing    dia
  Ebook      calibre
  Email      msgconvert
  Extractor  archive                    placeSessionFile verifyFile       VirusScan, MaxExtractedSize, MaxExtractedFiles
                                                                          & $DearchiveArray
  Files
  Graph      graphviz                                                     GraphConversionTimeout
  Identify   imagemagick ffmpeg archive coverResolvedImageMagickPolicy
             poppler generic            findFreeOutputName verifyFile
  Image      imagemagick                coverResolvedImageMagickPolicy
  LaTeX      xelatex                                                      LaTeXConversionTimeout
  Markup     pandoc                                                       MarkupConversionTimeout
  Metadata   mat2                       metadataOperationFormats          VirusScan
                                        placeSessionFile verifyFile
  Model      meshlab                                                      UsePyMeshLab
  OCR        tesseract libreoffice      coverResolvedImageMagickPolicy    VirusScan
                                        verifyFile
  PDF        poppler                    placeSessionFile verifyFile       VirusScan, MaxExtractedSize, MaxExtractedFiles
  SVG        inkscape resvg
  Scad       openscad                   getFiles                          SCADConversionTimeout,
                                                                          AllowSCADIncludeResolution & $ScadTemp, a
                                                                          folder $EngineSessionFolders names
  Scan                                  verifyFile                        VirusScan
  ScanCore   scancore                                                     ScanCoreChunkSize, ScanCoreMemoryLimit,
                                                                          ScanCoreDebug & ScanCoreVerbose
  Stream     ffmpeg                                                       StreamInspectionLayers,
                                                                          StreamInspectionFilesPerLayer,
                                                                          DefaultStreamInspectionForfeitAction,
                                                                          SupportedConversionTypes, $StreamArray &
                                                                          $StreamBaseURL
  Subtitle   ffmpeg
  Trace      imagemagick potrace        coverResolvedImageMagickPolicy
  Video      ffmpeg

WHAT ENGINE v4.2.4 LACKS. HRConvert2 v4.2.5 changed its Dependency & Setup Cores three times, & the
pipelines v4.2.5 added meet all three. Each reaches this kit when its Engine is reconciled.
  --install-depends takes a program on the host that answers with no version for the tool, where it
  should make the application's own copy. Ubuntu's dasel 2 & its Python yq are such programs, so on a
  host that carries either, Dasel & yq are not fetched, & the Data pipeline refuses every file with
  error 44001, because the Dasel it finds is unidentifiable.
  --config --repair does not add a missing setting to a section it only displays. HRConvert2's format
  lists are such a section, so a config.php written before an application adopts a family is not
  given that family's lists, & is refused until they are added by hand.
  Dependency Core says it builds an own copy that it fetches, because it predates the release Method.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What Still Reads As HRConvert2's--

Nothing a new application copies but the pipelines it adopts. Three things it will notice.

THE ENGINE'S HALF OF config.php IS WRITTEN IN HRCONVERT2'S WORDS WHERE A SETTING WAS FIRST WRITTEN FOR IT.
The stream settings, the default virus scanner & the per conversion limits, whose default names
HRConvert2's conversion families. An application gives its own value in $EngineSettingDefaults, a setting
written across several lines included, & the prose is shared.

THE CHECKERS CARRY HRCONVERT2'S NAME. They are hrconvert2-check.py, hrconvert2-check.sh &
hrconvert2-doccheck.py, & they check whichever application the contract describes. See --The Checkers--.

THE PIPELINES ARE HRCONVERT2'S. Each file's header names HRConvert2, & each guard dies with
HRConvert2-34000, or HRConvert2-2 in the Files pipeline, when a file is loaded directly. Their code names
no application, & an error one raises carries the adopting application's name, as every error does. An
application keeps the headers, & may give the guards its own name with the same numbers.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--The Checkers--

Each is run from the application root, & each says what it cannot see above the function that checks.

  python3 -I Documentation/Build/hrconvert2-check.py     The checks of the code. Authoritative.
  bash Documentation/Build/hrconvert2-check.sh           The second opinion, written in shell & awk.
  python3 -I Documentation/Build/hrconvert2-doccheck.py  The documents, in the house layout.

Each reads the entry point & the application's model from the contract, $EngineEntryPoint &
$EngineConfigModelProvider, so a new application runs them unchanged.
--no-scancore leaves out a bundled ScanCore, which a new application has only where it adopts the
ScanCore pipeline.
Documentation/ABOUT_QUALITY_CONTROL.txt says what each check is for & which fault it was written after.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--Upgrading The Engine Later--

The Engine is a drop in replacement for itself. Resources/Kernel & Resources/Engine are replaced whole,
& Resources/Contract & the application's half of config.php are the application's & stay. The pins are
raised to what the new files declare. A setting a newer Engine adds arrives in its half of the template,
so $RequiredConfigVersion is raised & php <entry point> --config --repair adds it to every config.php,
keeping every value an administrator set. A dependency a newer Engine needs arrives in its half of the
manifest, which it pins itself. An adopted pipeline is upgraded the same way, its folder replaced whole &
its pin raised to the $PipelineVersion the new folder declares.
----------------------------------------------------------------------------------------------------------------------------------------------------------------
