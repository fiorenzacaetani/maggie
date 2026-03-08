# 🤖 Project Maggie: Riepilogo Architetturale

**Maggie** è un assistente personale intelligente progettato per eliminare lo sforzo mentale della gestione della dispensa e della spesa attraverso l'uso di LLM e automazione.

---

## 👥 Il Team
* **User:** Lead Developer & Project Manager.
* **Claude (AI):** Architect & Pair Programmer.
* **Consulente Esterno:** DBA (Database Optimization).

---

## 🏗️ Stack Tecnologico
* **Backend:** PHP 8.5 + Laravel 12.
* **Infrastructure:** Docker (Laravel Sail), MySQL 8.4, Redis (Job Queues).
* **AI Engine:** Ollama in locale (modello da definire — candidati: Llama 3.3 70B Q4, Qwen 2.5 32B) su MacBook Air M5 24GB. Whisper.cpp per il riconoscimento vocale.
* **Interfacce:** Telegram Bot (Input rapido) e FilamentPHP 5.x (Dashboard di controllo).

> ⚠️ **Nota architetturale:** La scelta iniziale di OpenAI API (Whisper + GPT-4o) è stata sostituita con una soluzione **completamente locale** basata su Ollama, per eliminare costi API durante la fase di sviluppo e prototipazione. La qualità del parsing semantico è da validare con i modelli scelti — in caso di risultati insufficienti, è possibile tornare alle API OpenAI o valutare Anthropic Claude API come fallback.

---

## 📊 Struttura del Database (Versione Consolidata)
Lo schema è stato progettato per supportare calcoli predittivi e mapping AI:

1.  **Normalizzazione Unità:** La tabella `units` definisce le unità di misura disponibili. La tabella `products` ha un campo `base_unit_id` (FK → `units`) che indica l'unità in cui vengono espressi tutti i valori di quel prodotto nel sistema (quantità in dispensa, soglie, consumi). Questo permette conversioni uniformi indipendentemente da come l'utente esprime le quantità ("un pacchetto", "500 grammi", ecc.).
2.  **Mapping Semantico:** Tabella `product_aliases` separata per gestire sinonimi e linguaggio naturale senza sporcare l'anagrafica master.
3.  **Logica Predittiva:** Tabella `inventory_logs` per tracciare ogni variazione (carico/scarico) e calcolare il consumo medio giornaliero (`avg_consumption_daily`).
4.  **Astrazione Ricette:** Ingredienti legati alle `categories` e non ai singoli prodotti, per garantire flessibilità nella gestione delle giacenze.
5.  **Lista della Spesa Persistente:** Tabella `shopping_list` con campo `source ENUM('auto', 'manual')` per distinguere le righe generate dal sistema da quelle aggiunte manualmente dall'utente, e `status ENUM('pending', 'bought')` per tracciare lo stato durante la spesa. Il sistema non modifica mai le righe manuali. Modello scelto: lista unica scorrevole (no sessioni).
6.  **Ordinamento per Percorso Supermercato** *(pianificato — Epica 2)*: La struttura delle categorie supporta nativamente l'ordinamento per corsia. Implementazione prevista in tre livelli:
    - **Un solo meccanismo:** tabella `supermarket_layouts` (`retailer_name`, `category_id`, `aisle_order`) gestisce tutti gli ordinamenti, incluso il default. Non c'è nessun campo aggiuntivo sulla tabella `categories`. Il layout di default è un retailer speciale `__default__` precompilato con l'ordine tipico dei supermercati italiani (freschi → secchi → surgelati → detergenti).
    - **Layout personalizzato:** per ogni supermercato specifico, l'utente inserisce solo le categorie che differiscono dal default. La query usa `COALESCE` per fare fallback su `__default__` quando non esiste un record specifico.
    - **Opt-in per sessione:** l'ordinamento per percorso non è obbligatorio — viene proposto solo quando si genera la lista per un supermercato conosciuto. Per negozi occasionali, la lista rimane nell'ordine standard.

> **Versione attuale schema:** 9 migration, 14 tabelle. Vedere `database/migrations/` per il dettaglio.

---

## 🗺️ Roadmap (Epiche GitHub Projects)

| ID | Epica | Stato |
| :--- | :--- | :--- |
| **1** | **Infrastructure & Foundation** | 🟡 In corso |
| **2** | **Core Pantry Engine** | ⚪ Da iniziare |
| **3** | **AI Intelligence Layer** | ⚪ Da iniziare |
| **4** | **Telegram Interface** | ⚪ Da iniziare |
| **5** | **Control Dashboard** | ⚪ Da iniziare |
| **6** | **External Integration (Shopping)** | ⚪ Da iniziare |

---

## 🧠 Logica AI (System Prompt)
Maggie agisce come un'interfaccia tra il linguaggio umano e il database SQL.
* **Input:** Messaggio vocale/testuale/foto scontrino via Telegram.
* **Elaborazione:** L'AI estrae i dati e restituisce un JSON strutturato.
* **Esempio JSON:**
    ```json
    {
      "action": "UPDATE_INVENTORY",
      "params": { "product": "pasta", "quantity": 0, "unit": "pacco" },
      "user_message": "Ok, ho segnato che la pasta è finita. L'ho aggiunta alla lista della spesa!"
    }
    ```

> **Nota implementativa:** Con Ollama, il modello viene interrogato via API REST locale (`http://localhost:11434`). Laravel comunicherà con Ollama tramite un Service dedicato (`OllamaService`), mantenendo la stessa interfaccia JSON prevista — il layer applicativo è indipendente dal provider AI scelto.

---

## ✅ Milestone completate

### Milestone 0 — Setup iniziale
- [x] Definizione Vision e nome progetto.
- [x] Setup Workspace (GitHub Repo + Projects).
- [x] Approvazione Schema Database "AI-Ready".
- [x] Definizione Infrastructure Stack (Docker/Sail).

### Milestone 1 — Database & Dashboard
- [x] Migration database (9 file, 14 tabelle).
- [x] Model Eloquent con relazioni per tutte le tabelle.
- [x] Installazione e configurazione FilamentPHP 5.x.
- [x] CRUD Filament per Products, Categories, Recipes, Pantry.
- [x] Seeder per Units (16 unità) e Categories (17 padre, ~60 figlie).
- [x] Form ricette con Repeater per gli ingredienti.
- [x] View ricette con tabella ingredienti compatta.

---

## 🔜 Prossimi passi suggeriti
1. Setup ambiente staging su DigitalOcean (con supporto sistemista).
2. Acquisto MacBook Air M5 24GB + installazione Ollama.
3. Valutazione modelli Ollama per parsing semantico (benchmark con frasi tipo "ho quasi finito il latte").
4. Inizio Epica 2 — Core Pantry Engine.
