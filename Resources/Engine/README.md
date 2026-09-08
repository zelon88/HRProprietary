# Resources/Engine

The Engine. Everything an application of this shape needs that has nothing to do with what
the application actually does.

| Path | Owner | What it is |
|---|---|---|
| `engine.php` | Engine | The Engine itself. Loads the Cores, provides the environment, sandboxes commands, reaches the network or refuses to. |
| `engineConfig.php` | Engine | Engine defaults. Loads `Contract/app-engine-config.php` last, so your settings win. |
| `Cores/` | Engine | Dependencies, setup and configuration, the shared environment. |
| `Managers/` | Engine | Long-running processes. Resource budgets, workers, requests, environment repair. |
| `Contract/` | **You** | What your application tells the Engine about itself. |

## Upgrading

Copy `engine.php`, `engineConfig.php`, `Cores/` and `Managers/` over the old ones. Leave
`Contract/` alone. That is the whole procedure.

The split exists so that sentence stays true. Anything that starts to feel like a fourth
Contract file is worth arguing about before it is written, because the argument is really
about whether the Engine has started to know something about one application.
