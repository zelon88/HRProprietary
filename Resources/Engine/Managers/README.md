# Resources/Engine/Managers

Long-running processes. Each is started by the Engine, each is version-pinned, and each is
dispatched by name from a table rather than by a path built at the call site.

| File | What it does |
|---|---|
| `coreManager.php` | The listener. Starts the others and holds the socket. |
| `resourceManager.php` | Resource budgets. Decides what a workload is allowed to consume. |
| `workerManager.php` | Individual workloads. Starts them, watches them, ends them. |
| `requestManager.php` | Incoming requests, and which worker gets them. |
| `environmentManager.php` | Watches the operating environment and repairs it when told to. Calls your repair provider and nothing else. |

## Running as root

The managers are the only Engine components that run privileged, and they do it because
resource control and environment repair genuinely require it. Everything they run on your
behalf is sandboxed.

`environmentManager.php` repairs nothing unless an administrator has turned repair on. A
root process that repairs on a timer is a liability if it is wrong.
