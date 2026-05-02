# 🧺 Maggie — AI-Powered Pantry & Shopping Assistant

> **⚠️ Work in Progress** — This project is in active development. The architecture is defined, the foundation is laid, and the backlog is fully planned. What you see here is a snapshot of a project being built with intention, not a finished product.

---

## The Problem

Managing a home pantry is a surprisingly complex cognitive task. You need to remember what you have, what's running low, what you need to buy, how you usually consume things, and in what order your supermarket is laid out — all at once, every week.

Maggie is designed to eliminate that mental overhead entirely.

---

## What Maggie Will Do

Maggie is a personal assistant that manages your pantry and shopping list through natural language — voice messages, text, or photos of receipts — via a Telegram bot, backed by a local AI engine.

**Core features (planned):**

- 🗣️ **Natural language input** — "I just finished the olive oil" or a photo of a grocery receipt updates the pantry automatically
- 📦 **Predictive inventory** — tracks daily consumption rates and alerts you before things run out
- 🛒 **Smart shopping list** — auto-generated from predicted shortfalls, merged with manual additions; the system never overwrites what you added by hand
- 🗺️ **Supermarket routing** — shopping list sorted by aisle order for your specific supermarket, so you never backtrack
- 🍳 **Recipe-aware stock management** — cooking a recipe automatically deducts ingredients from the pantry
- 📊 **Control dashboard** — full visibility and manual control via a FilamentPHP admin interface

---

## Architecture & Stack

Maggie is built with a deliberate, opinionated stack:

| Layer | Technology | Why |
| :--- | :--- | :--- |
| **Backend** | PHP 8.5 + Laravel 12 | Mature, expressive, excellent ecosystem |
| **Database** | MySQL 8.4 | Relational integrity for inventory & mapping data |
| **Queue** | Redis | Async jobs for consumption recalculation |
| **Infrastructure** | Docker via Laravel Sail | Reproducible local environment |
| **AI Engine** | Ollama (local) + Whisper.cpp | Zero API cost, privacy-first, no external dependencies |
| **Bot Interface** | Telegram Bot API | Fast, friction-free daily input |
| **Dashboard** | FilamentPHP 5.x | Rapid, polished admin UI |

### AI Architecture decision

The initial design used OpenAI (Whisper + GPT-4o). This was replaced with a fully local stack — Ollama running on Apple Silicon (M5, 24GB RAM) with Whisper.cpp for speech recognition. The application layer is provider-agnostic: if a local model proves insufficient for semantic parsing quality, switching to an external API requires changing a single service class.

### Database design highlights

The schema was designed from the ground up to support AI-driven workflows:

- **SI unit normalisation** — all quantities stored in a base unit (grams/ml) internally; the user can say "a bag", "500 grams", or "two packs" and the system handles conversion
- **Semantic alias table** — `product_aliases` keeps natural language synonyms separate from the canonical product registry, keeping the master data clean
- **Transactional consumption log** — `inventory_logs` records every movement (restock, consumption, recipe cooking, AI prediction) as an immutable log; `avg_consumption_daily` is derived from this, not stored as a guess
- **Recipe abstraction** — recipe ingredients are linked to *categories*, not specific products; "any pasta" satisfies a pasta ingredient, regardless of brand or format
- **Human override protection** — `supermarket_mappings` has a `match_type ENUM('AUTO', 'MANUAL')` column; the AI never overwrites a mapping a human has manually corrected
- **Shopping list model** — single rolling list (no sessions); `source ENUM('auto', 'manual')` distinguishes system-generated rows from user additions; manual rows are never touched by automation

Current schema: **11 migrations, 14 tables**.

---

## Project Status

This project is tracked as a backlog of Epics and Stories on GitHub Projects, defined in Gherkin format for behavioural verification.

| Epic | Description | Status |
| :--- | :--- | :--- |
| **1** | Infrastructure & Foundation | 🟡 In progress |
| **2** | Core Pantry Engine | 🔵 In progress |
| **3** | AI Intelligence Layer | ⚪ Planned |
| **4** | Telegram Interface | ⚪ Planned |
| **5** | Control Dashboard | ⚪ Planned |
| **6** | External Integration (Shopping) | ⚪ Planned |

### What's already built

**Epic 1 — Infrastructure & Foundation** is largely complete:

- ✅ Full database schema — 11 migrations, all Eloquent models with relationships
- ✅ FilamentPHP 5.x installed and configured
- ✅ Filament CRUD resources: Products, Categories, Recipes (with ingredient repeater), Pantry
- ✅ Seeders: 16 measurement units, 17 top-level categories with ~60 subcategories
- ✅ Docker environment (Laravel Sail) — fully reproducible local setup

**Epic 2 — Core Pantry Engine** is underway:

- ✅ `shopping_list` migration, model, and Filament CRUD
- ✅ `supermarket_layouts` migration, model, seeder (default Italian supermarket aisle order), and Filament CRUD
- 🔲 Inventory movement service (load/unload → `inventory_logs`)
- 🔲 Scheduled job for `avg_consumption_daily` recalculation
- 🔲 Minimum threshold alert logic
- 🔲 Automatic shopping list generation from depletion prediction
- 🔲 Recipe cooking registration (ingredient deduction)
- 🔲 Shopping list sorting by supermarket layout

### What's next

Epic 3 (AI Layer) is blocked pending hardware: an Apple M5 MacBook Air (24GB) is the planned Ollama host. Once available, the plan is to benchmark Llama 3.3 70B Q4 against Qwen 2.5 32B on Italian-language semantic parsing tasks before committing to a model.

---

## How the AI Layer Works

Maggie acts as a translation layer between human language and SQL:

```
User input (voice/text/photo)
        ↓
  Whisper.cpp (speech-to-text, if voice)
        ↓
  Ollama (semantic parsing → structured JSON)
        ↓
  Laravel service layer (executes action on DB)
        ↓
  Telegram response to user
```

Example AI output for "the pasta is almost finished":

```json
{
  "action": "UPDATE_INVENTORY",
  "params": {
    "product": "pasta",
    "quantity": 0,
    "unit": "pacco"
  },
  "user_message": "Got it — pasta is almost out. I've added it to your shopping list!"
}
```

The `OllamaService` communicates with the local Ollama REST API (`http://localhost:11434`). The application layer is fully decoupled from the AI provider.

---

## Local Development Setup

```bash
# Clone and install dependencies
git clone https://github.com/your-username/maggie.git
cd maggie
composer install

# Copy environment file and configure your .env
cp .env.example .env

# Start Docker environment
./vendor/bin/sail up -d

# Run migrations and seeders
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed

# Access Filament dashboard
# http://localhost/admin
```

> Ollama is not required to run the application in its current state. The AI layer is not yet integrated — Epic 3 is planned but not started.

---

## Contributing

This is a personal project and not currently open to external contributions. The repository is public for visibility and portfolio purposes. Feel free to open an issue if you spot something interesting or have a question about the architecture.

---

## License

MIT
