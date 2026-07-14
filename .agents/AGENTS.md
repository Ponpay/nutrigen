# Engineering Validation Checklist

Whenever you finish implementing a page, you MUST perform the following checklist before considering the task complete and presenting it to the user. Do not skip these steps.

- [ ] **Blade Compile Check**: Ensure there are no syntax errors in Blade directives.
- [ ] **Undefined Variable Check**: Verify all variables used in the Blade template (e.g. `$children`) are properly defined in the dummy data block or controller, and check that no old variables from previous refactors are left orphaned.
- [ ] **Missing Component Check**: Ensure all used components (`<x-something />`) actually exist in the `resources/views/components/` directory.
- [ ] **Route Check**: Ensure the route being hit is correctly mapped in `routes/web.php`.
- [ ] **Visual QA**: Check the layout proportions, spacing, colors, and typography.
- [ ] **Responsive QA**: Verify layout on Desktop, Tablet, and Mobile.
- [ ] **Regression Test**: Ensure features that were working before the refactor are still functioning properly.
- [ ] **Backend Ready Audit**: Ensure Blade is the primary renderer, no HTML generation in JS, and data binding is straightforward.
