# Resources/Engine/Cores

Detachable components. Each is version-pinned, each is verified before it loads, and each
reports its own version so a mismatch is caught at startup rather than at the point of use.

| File | What it does |
|---|---|
| `environmentCore.php` | The environment every application is given. Sanitizing a value, finding an executable, reading an extension, describing the host. |
| `dependencyCore.php` | Reads your manifest. Probes what is installed, reports what is missing, installs what you allow. Understands version windows and architectures. |
| `setupCore.php` | The configuration utility. Views, verifies, repairs and generates a configuration from your template. |

## Guarded definitions

Everything in `environmentCore.php` is wrapped in `function_exists`. An application that
already defines one of these keeps its own; an application that defines none gets all of
them. Neither redeclares, which in PHP is fatal at load.

That matters when your boot sequence reaches one of these functions *before* the Engine has
loaded — finding an executable is the usual case. Keep your own copy and the Engine steps
aside.
