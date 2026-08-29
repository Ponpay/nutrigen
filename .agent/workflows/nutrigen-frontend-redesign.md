---
description: Reusable workflow for NutriGen frontend redesign tasks, enforcing a calm operational healthcare design direction, anti-slop rules, and strict frontend/backend isolation.
---

# NutriGen Frontend Redesign Workflow

Use this workflow to perform any frontend UI/UX redesign task for the NutriGen project. This ensures the output aligns with the "Calm Operational Healthcare" design constitution, leverages the appropriate skills efficiently, and strictly preserves backend functionality.

## 1. UNDERSTAND
Before making any changes, inspect the target page and its dependencies.
- **Identify:** The framework (Laravel/Blade, Tailwind CSS), existing UI patterns, and shared components (`<x-...>`).
- **Map Boundaries:** Locate all backend contracts (Blade variables, route definitions, form names). These are strictly immutable.
- **Skill:** Use `view_file` to read the views and controllers involved.

## 2. SHAPE
Determine the structural changes needed before applying styling.
- **Analyze:** Page anatomy, information hierarchy, user goal.
- **Identify Actions:** Clarify the primary action vs. secondary actions.
- **Containment & Responsive:** Decide when to use canvas, surfaces, lists, dividers, and whitespace (do NOT default to nested cards). Plan for mobile-first (Kader/Ibu) or desktop-first (Puskesmas).
- **Skill:** `impeccable` (shape).

## 3. CRITIQUE
Evaluate the current implementation for flaws.
- **Identify Problems:** Look for UX friction, poor visual hierarchy, accessibility gaps, high cognitive load, and AI-slop patterns (e.g., purple gradients, unnecessary decorative motion).
- **Skill:** `impeccable` (critique, audit).

## 4. IMPLEMENT
Apply the targeted frontend changes to the views and CSS.
- **Action:** Modify frontend presentation only (HTML structure, Tailwind classes, Alpine state).
- **Tooling:** Apply updates using code editing tools.
- **Skill:** `redesign-existing-projects` (working within the existing stack without rewrites) and `design-taste-frontend` (enforcing the anti-generic, calm healthcare visual direction). Use `full-output-enforcement` **only** if editing a massive file that risks truncation.

## 5. AUDIT
Verify the technical quality of the implementation.
- **Checklist:**
  - Accessibility (WCAG contrast, focus rings, touch targets min 48px).
  - Responsive behavior (test across mobile, tablet, desktop).
  - Visual consistency (alignment with the NutriGen Design Constitution).
  - Component quality (proper use of shared Blade components).
- **Skill:** `impeccable` (audit, layout, typeset).

## 6. DISTILL / QUIETER
Strip away the unnecessary. The goal is clarity, not decoration.
- **Remove:** Excessive decoration, redundant wrappers, nested cards, oversized radii, excessive shadows, arbitrary colors, unnecessary badges, and generic SaaS layouts.
- **Result:** A calmer, more focused interface that reduces visual anxiety and decision fatigue.
- **Skill:** `impeccable` (distill, quieter).

## 7. POLISH
Perform targeted final refinements.
- **Action:** Fix micro-interactions (hover, active scale, focus rings), typography kerning/leading, and alignment issues. Ensure tabular data uses monospace figures.
- **Skill:** `impeccable` (polish).

## 8. VERIFY
The final quality gate to ensure zero regressions.
- **Confirm NO Changes To:**
  - Existing routes & route parameters
  - Blade variable names and structures
  - Form field names (`name="..."`)
  - Backend contracts
  - Existing functionality and dynamic data injection
- **Confirm Changes To:**
  - Layouts work across desktop/tablet/mobile as intended by the portal personality.

---

## STRICT RULES OF ENGAGEMENT

### REVIEW GATE (For Substantial Redesigns)
Do not immediately perform broad refactoring.
1. **Audit & Plan First:** Produce a concise audit of the page and an implementation plan artifact.
2. **Execute Later:** Only implement the redesign after the user explicitly approves the scope.

### FRONTEND / BACKEND ISOLATION
**NEVER modify the following during a UI redesign:**
- Controllers, Models, Migrations, or Services.
- Routes or route parameters.
- Database queries or business logic.
- Blade variable contracts passed to views.
- HTML form field names (`<input name="...">`).
*If a UX improvement requires a backend change, STOP. Do not implement it. Report it to the user as a proposed backend change instead.*

### ANTI-SLOP & CALM OPERATIONAL HEALTHCARE
Never interpret "modern", "beautiful", or "premium" as permission to add:
- Gradients (especially purple/blue).
- Excessive cards or nested white-on-white cards.
- Oversized border radii (`rounded-3xl`).
- Decorative animation or arbitrary motion.
- Arbitrary semantic colors (stick to Slate/Teal/Emerald/Amber/Rose).
- Unnecessary badges or excessive shadows.
- Generic SaaS layouts.
- Fake placeholder text (no "Lorem Ipsum").

**Goal:** Reduce cognitive load, reduce decision fatigue, ensure predictable interaction, prevent errors, project confidence, and allow for repeated daily use without visual strain.

### SKILL USAGE SUMMARY
*Do not automatically invoke every skill for every task. Use the smallest set necessary.*
- **`impeccable`:** For deep UX/visual critique, shaping, layout, typesetting, responsive adaptation, distillation, and polish.
- **`design-taste-frontend`:** For enforcing the anti-generic, anti-slop visual direction.
- **`redesign-existing-projects`:** For safely implementing improvements within the existing Laravel/Blade/Tailwind stack.
- **`full-output-enforcement`:** Reserved ONLY for when massive files must be generated or rewritten completely to prevent LLM truncation.
