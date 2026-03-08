# 🗺️ Maggie — Epiche di Progetto

---

## Epica 1 — Infrastructure & Foundation
**Obiettivo:** Costruire le fondamenta tecnologiche su cui poggia tutto il progetto.

### Story completate
- [x] Setup repository GitHub e workspace
- [x] Ambiente Docker locale (Laravel Sail + MySQL + Redis)
- [x] Migration database (9 file, 14 tabelle)
- [x] Model Eloquent con relazioni
- [x] Installazione e configurazione FilamentPHP 5.x
- [x] CRUD Filament per Products, Categories, Recipes, Pantry
- [x] Seeder per Units e Categories

### Story in corso / bloccate
- [ ] Setup MacBook Air M5 + Ollama *(bloccato — in attesa acquisto hardware)*
- [ ] Esposizione HTTPS locale + webhook Telegram *(bloccato — dipende da Ollama)*

---

## Epica 2 — Core Pantry Engine
**Obiettivo:** Implementare la logica di gestione della dispensa — movimenti, predizioni e lista della spesa.

### Story
- [ ] Migration e model per `shopping_list`
- [ ] Migration e model per `supermarket_layouts` (con seeder layout `__default__`)
- [ ] Service per registrazione movimenti dispensa (carico/scarico → `inventory_logs`)
- [ ] Job schedulato per ricalcolo `avg_consumption_daily`
- [ ] Logica alert soglia minima (`current_quantity_base` < `min_threshold_base`)
- [ ] Generazione automatica lista della spesa da predizione esaurimento
- [ ] Registrazione cottura ricetta (scarico ingredienti → `inventory_logs`)
- [ ] Ordinamento lista della spesa per layout supermercato (opt-in)
- [ ] CRUD Filament per `shopping_list` e `supermarket_layouts`

---

## Epica 3 — AI Intelligence Layer
**Obiettivo:** Integrare Ollama come motore di parsing semantico per trasformare linguaggio naturale in azioni sul database.

### Story
- [ ] Implementazione `OllamaService` (client HTTP verso `localhost:11434`)
- [ ] Benchmark modelli: Llama 3.3 70B vs Qwen 2.5 32B su frasi italiane
- [ ] Definizione system prompt per parsing inventario
- [ ] Parsing testo → JSON strutturato (`UPDATE_INVENTORY`, `ADD_TO_LIST`, ecc.)
- [ ] Integrazione `whisper.cpp` per riconoscimento vocale
- [ ] Gestione `ai_interactions_logs` (audit e debug)
- [ ] Gestione confidence score e fallback su input ambigui

---

## Epica 4 — Telegram Interface
**Obiettivo:** Implementare il bot Telegram come interfaccia principale di input per l'utente.

### Story
- [ ] Setup bot Telegram via @BotFather
- [ ] Ricezione e routing messaggi (testo, voce, foto)
- [ ] Gestione lista della spesa via Telegram (visualizza, spunta, aggiungi)
- [ ] Feedback all'utente dopo ogni azione ("ho segnato che la pasta è finita")
- [ ] Gestione comandi rapidi (`/lista`, `/dispensa`, `/ricette`)
- [ ] Visualizzazione lista ordinata per layout supermercato

---

## Epica 5 — Control Dashboard
**Obiettivo:** Completare e raffinare il pannello Filament come strumento di controllo e configurazione.

### Story
- [ ] Dashboard con widget: prodotti sotto soglia, prossimi esaurimenti
- [ ] Configurazione layout supermercati personalizzati
- [ ] Storico movimenti dispensa con grafici consumi
- [ ] Gestione manuale lista della spesa
- [ ] Configurazione soglie minime per prodotto

---

## Epica 6 — External Integration (Shopping)
**Obiettivo:** Integrare servizi esterni per automatizzare o semplificare la spesa online.

### Story
- [ ] Integrazione con almeno un retailer online (es. Esselunga, Conad)
- [ ] Mapping automatico prodotti interni ↔ SKU retailer (`supermarket_mappings`)
- [ ] Aggiunta automatica alla lista online partendo dalla lista Maggie
- [ ] Gestione `match_type` AUTO/MANUAL per proteggere le correzioni umane

---

## 📌 Dipendenze tra Epiche

```
Epica 1 (Foundation)
    └── Epica 2 (Pantry Engine)
            └── Epica 3 (AI Layer)        ← richiede hardware M5
                    └── Epica 4 (Telegram)
    └── Epica 5 (Dashboard)               ← può procedere in parallelo con Epica 2
    └── Epica 6 (Shopping)                ← dipende da Epica 2 + 4
```
